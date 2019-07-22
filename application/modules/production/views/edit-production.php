<?php
  $this->load->view("header.php");
  $id=$_GET['id'];
  
   if($_GET['id']!='' or $_GET['view']!=''){
  	$query=$this->db->query("select * from tbl_production_hdr where productionid='$id' or productionid='".$_GET['view']."'");	
  	$fetchq=$query->row();
   }
  ?>
<form id="f1" name="f1" method="POST" action="updateProduction" onSubmit="return checkKeyPressed(a)" enctype="multipart/form-data">
  <!-- Main content -->
  <div class="main-content">
  <!-- Breadcrumb -->
  <?php if(@$_GET['popup'] == 'True') {} else {?>
  <ol class="breadcrumb breadcrumb-2">
    <li><a class="btn btn-success" href="<?=base_url();?>master/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
    <li><a class="btn btn-success" href="<?=base_url();?>template/manage_template">Manage Production </a></li>
  </ol>
  <?php }?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4 class="panel-title"><strong>Update Production</strong></h4>
          <ul class="panel-tool-options">
            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?> >
              <thead>
                <tr>
                  <th>Production Goods</th>
                  <th>
                    <div class="field">
                      <select name="product_id"  required id="contact_id_copy" class="form-control ui fluid search dropdown email" onChange="document.getElementsByName('contactid')[0].value=this.value;"   <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
                        <option value="" selected disabled>Select</option>
                        <?php
                          $contQuery=$this->db->query("select * from tbl_product_stock where status='A' and type='14'");
                          foreach($contQuery->result() as $contRow)
                          {
                          ?>
                        <option value="<?php echo $contRow->Product_id; ?>" <?php if($contRow->Product_id==$fetchq->product_id){ ?> selected="selected" <?php }?>>
                          <?php echo $contRow->productname; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                  </th>
                  <th>Qty</th>
                  <th>
                    <input type="number" step="any"  class="form-control" required name="qty" value="<?php echo $fetchq->qty;?>" />
                  </th>
                  <th>Date</th>
                  <th>
                    <input type="date"  class="form-control" required name="date" value="<?php echo $fetchq->date;?>" />
                    <input type="hidden"  class="form-control" required name="id" value="<?php echo $_GET['id'];?>" />
                  </th>
                  <th>
                    <select name="machine"  required class="form-control"<?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
                      <option value="" selected disabled>Select</option>
                      <?php
                        $contQuery=$this->db->query("select * from tbl_master_data where status='A' and param_id='21'");
                        foreach($contQuery->result() as $contRow)
                        {
                        ?>
                      <option value="<?php echo $contRow->serial_number; ?>" <?php if($fetchq->machine==$contRow->serial_number){?> selected="selected" <?php }?>>
                        <?php echo $contRow->keyvalue; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?> >
              <tbody>
                <tr class="gradeA">
                  <th>Item</th>
                  <th>Usages Unit</th>
                  <th>Qty</th>
                  <th style="display:none">Grams</th>
                  <th>Total Qty</th>
                </tr>
                <?php
                  @extract($_POST);
                  
                  if($search!='')
                  {
                  
                  $productionDtlQuery=$this->db->query("select * from tbl_production_dtl where productionhdr='$getProduct->templateid'");
                  }
                  else
                  {
                  $productionDtlQuery=$this->db->query("select * from tbl_production_dtl where productionhdr='".$_GET['id']."' or productionhdr='".$_GET['view']."'");
                  	
                  }
                  $i=1;
                  foreach($productionDtlQuery->result() as $getProduction){
                  	
                  
                  $productQuery=$this->db->query("select * from tbl_product_stock where product_id='$getProduction->product_id'");
                  $getProduct=$productQuery->row();
                  
                  $unitQuery=$this->db->query("select * from tbl_master_data where serial_number='$getProduct->usageunit'");
                  $getUnit=$unitQuery->row();
                  
                  
                  $phdr=$this->db->query("select * from tbl_production_hdr where productionid='$getProduction->productionhdr'");
                  $phdrdata=$phdr->row();
                  $templatehdr=$this->db->query("select * from tbl_template_hdr where product_id='$phdrdata->product_id'");
                  $usespercent=$templatehdr->row();
                  $templatedtl=$this->db->query("select * from tbl_template_dtl where templatehdr='$usespercent->templateid' and product_id='$getProduction->product_id' ");
                  $tempdata=$templatedtl->row();
                  ?>
                <tr class="gradeA">
                  <th style="width:280px;">
                    <input type="text" name="prd" value="<?=$getProduct->productname;?>"   class="form-control"  style=" width:230px;"  tabindex="5" >
                  </th>
                  <input type="hidden" name="product_idd[]" value="<?=$getProduct->Product_id;?>" />
                  <th>
                    <input type="text" readonly="" id="usunit" value="<?=$getUnit->keyvalue;?>" style="width:70px;" class="form-control"> 
                  </th>
                  <th><input type="text" readonly="" id="useper" value="<?=$tempdata->quantity;?>" style="width:70px;" class="form-control"> </th>
                  <th style="display:none"><input type="number" step="any" value="<?=$getProduction->grams;?>" id="gram" min="1" style="width:90px;" name="gram[]"   class="form-control"></th>
                  <th><input type="number" name="tot_gram[]" step="any" id="tot_gram" min="1" style="width:90px;" value="<?=$getProduction->tot_qty;?>"   class="form-control"></th>
                </tr>
                <?php
                  $sum=$sum+$i;
                  $i++;
                  
                    } ?>
                <input type="hidden" name="rows" value="<?=$sum;?>" />
              </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?> >
              <tbody>
                <tr class="gradeA">
                  <th>
                  <th>&nbsp;</th>
                  <th>
                    <?php if($_GET['view']!='')
                      {} else {?>
                    <input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >&nbsp;
                    <?php }?>
                    <a onclick="popupclose(this.value)" class="btn btn-secondary  btn-sm">Cancel</a>
                  </th>
                  </th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function fsv(v)
    {
    
    v.type="submit";
    }
          
  </script>
</form>
<?php
  $this->load->view("footer.php");
  ?>