<?php
  $this->load->view("header.php");
  $entries = "";
  
   if($this->input->get('entries')!="")
   {
    $entries = $this->input->get('entries');
   }
  
  ?>
<div id="mapSpare" class="modal fade modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-contentMap" id="modal-contentMap">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Part List</h4>
        <div id="getPartMappingData" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
    </div>
  </div>
</div>
<div id="modal-10" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> View Material Quantity Mapping</h4>
        <div id="productqtymap" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div id="getsparepartqtymappingView"></div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Main content -->
<div class="main-content">
  <div class="panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Super Admin</a></li>
      <li class="active"><strong><?php if($_GET['p_type']=='13'){?>Manage Raw material<?php } elseif($_GET['p_type']=='32'){?>Manage Product Parts <?php } elseif($_GET['p_type']=='33'){ echo "Manage Shape";} elseif($_GET['p_type']=='35'){ echo "Manage Accessories";} elseif($_GET['p_type']=='34'){ echo "Manage Packaging Material";} elseif($_GET['p_type']=='50'){ echo "Manage Scrap";} else{ echo "Manage Finish Goods";}?></strong></li>
      <div class="pull-right">
        <button type="button" onclick="getFG();" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" formid="#ItemForm" id="formreset"><i class="fa fa-plus"></i><?php if($_GET['p_type']=='13'){?>Add Raw Material<?php } elseif($_GET['p_type']=='32'){?>Add Part<?php } elseif($_GET['p_type']=='33'){ echo "Add Shape";} elseif($_GET['p_type']=='35'){ echo "Add Accessories";} elseif($_GET['p_type']=='34'){ echo "Add Packaging Material ";} elseif($_GET['p_type']=='50'){ echo "Add Scrap";} else{ echo "Add Finish Goods";}?></button>
        <a class="btn btn-secondary btn-sm delete_two_all"><i class="fa fa-trash-o"></i> Delete All</a>
      </div>
    </ol>
    <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <input type="hidden" id="headerType" value="<?=$_GET['p_type']?>">
            <h4 class="modal-title"><span class="top_title"></span></h4>
            <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
          </div>
          <form class="form-horizontal" role="form" id="ItemForm" >
            <div class="modal-body overflow">
              <div class="form-group">
                <input type="hidden" name="type" value="<?=$_GET['p_type'];?>" />
                <?php if($_GET['p_type']!='14'){?> 
                <label class="col-sm-2 control-label"> *Category</label> 
                <div class="col-sm-4">                  
                  <!-- <select name="type1" style="display:none"  class="form-control" id="type" onchange="getCat(this.value);">
                    <option value="">----Select ----</option>
                    <?php 
                      //$sqlprotype=$this->db->query("select * from tbl_master_data where //param_id=17");
                      //foreach ($sqlprotype->result() as $fetch_protype){
                      ?>
                    <option value="<?php //echo $fetch_protype->serial_number;?>" ><?php //echo $fetch_protype->keyvalue; ?></option>
                    <?php //} ?>
                  </select> -->
                  <select name="category"  class="form-control" onchange1="changing(this.value)" id="category">
                    <option value="">----Select ----</option>
                    <?php 
                      $sqlgroup=$this->db->query("select * from tbl_category where inside_cat = 0 and type='".$_GET['p_type']."'");
                      foreach ($sqlgroup->result() as $fetchgroup){						
                      ?>					
                    <option value="<?php echo $fetchgroup->id; ?>"<?php if($fetchgroup->id==$fetch_list->category){?>selected<?php }?>><?php echo $fetchgroup->name ; ?></option>
                    <?php } ?>
                  </select>
                </div>
              <?php } ?>
               <label class="col-sm-2 control-label" > *<?php if($_GET['p_type']=='13'){?>RM Code<?php } elseif($_GET['p_type']=='32'){?>Part Code <?php } elseif($_GET['p_type']=='33'){ echo "Shape Code";} elseif($_GET['p_type']=='35'){ echo "Accessories Code";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Code";} elseif($_GET['p_type']=='50'){ echo "Scrap Codde";} else{ echo "Item Code";}?> </label> 
                <div class="col-sm-4">
                    <input type="hidden" class="hiddenField" id="Product_id" name="Product_id" value="" />
                    <input type="text" class="form-control" name="sku_no" value=""  id="sku_no"> 
                </div>
                <?php if($_GET['p_type']=='14') { ?> 
                <label class="col-sm-2 control-label">Price</label> 
                <div class="col-sm-4">                   
                  <input type="number" step="any" name="unitprice_sale" id="unitprice_sale" class="form-control" >
                </div>
                <?php } ?>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">*<?php if($_GET['p_type']=='13'){?>Raw Material Name<?php } elseif($_GET['p_type']=='32'){?>Part Name <?php } elseif($_GET['p_type']=='33'){ echo "Shape Name";} elseif($_GET['p_type']=='35'){ echo "Accessories Name";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Name";} elseif($_GET['p_type']=='50'){ echo "Scrap Name";} else{ echo "Item Name";}?>:</label> 
                <div class="col-sm-4"> 
                  <input name="productname"  type="text" value="" class="form-control" id="productname" > 
                </div>
                  <label class="col-sm-2 control-label"> *Unit: </label> 
                <div class="col-sm-4">
                  <select name="unit"  class="form-control" id="unit" onchange="showBox(this.value);">
                    <option value="" >----Select Unit----</option>
                    <?php 
                      $sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
                      foreach ($sqlunit->result() as $fetchunit){
                      
                      ?>
                    <option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <?php if($_GET['p_type']=='14') { ?> 
              <div class="form-group">                
                <label class="col-sm-2 control-label">Qty/Box</label> 
                <div class="col-sm-4"> 
                  <input type="text" name="qty_box" id="qty_box" class="form-control" />
                </div>
                <div id="useSet" style="display: none;">                
                  <label class="col-sm-2 control-label">Qty/Set</label> 
                  <div class="col-sm-4"> 
                    <input type="text" name="qty_set" id="qty_set" class="form-control" />
                  </div>
                </div>
                <div id="userCircle" style="display: none;">
                  <label class="col-sm-2 control-label">Circle Weight</label> 
                  <div class="col-sm-4" id="regid">  
                    <input type="text" name="circle_weight" id="circle_weight" class="form-control"  />
                  </div>
                </div>
              </div>            
            <?php } ?>

              <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label">Size:</label> 
                <div class="col-sm-4">
                  <input name="size"  type="text" value="" class="form-control" id = "size"  > 
                </div>
                <label class="col-sm-2 control-label">Thickness:</label> 
                <div class="col-sm-4"> 
                  <input name="thickness"  type="text" value="" class="form-control" id="thickness" > 
                </div>
              </div>

              <div class="form-group" style="display: none;">
                
                <label class="col-sm-2 control-label">Purchase Price:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="grade_code" id="grade_code" class="form-control"/>
                  <input type="number" step="any" name="unitprice_purchase" value="" id="unitprice_purchase" class="form-control" >
                </div>
              </div>

              <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label">GST Tax:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" step="any" name="gst_tax" value="" id="gst_tax" class="form-control" >
                </div>
                <label class="col-sm-2 control-label">HSN Code:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" step="any" name="hsn_code" value="" id="hsn_code" class="form-control" >
                </div>
              </div>

              <?php if($_GET['p_type']=='14'){?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Cartoon Length:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="ctn_lenght" value="" id="ctn_lenght" class="form-control"  >
                </div>
                <label class="col-sm-2 control-label">Cartoon Width:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="ctn_width" value="" id="ctn_width" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Cartoon Height:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="ctn_height" onkeyup="cbmCalculation();" onchange="cbmCalculation();" value="" id="ctn_height" class="form-control" >
                </div>
                <label class="col-sm-2 control-label">CBM:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="cbm" value="" id="cbm" class="form-control" readonly="readonly" >
                </div>                
              </div>
            <?php } ?>

              <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label">MST:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="mst" value="" id="mst" class="form-control" >
                </div>
                <label class="col-sm-2 control-label">Lead Time:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="lead_time" value="" id="lead_time" class="form-control" >
                </div>
              </div>

              
               <?php if($_GET['p_type']=='14') { ?>
                <div class="form-group">
                <label class="col-sm-2 control-label">Additional Percentage:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" min="0" max="100"  name="percentage" value="" id="percentage" class="form-control" >
                </div>
                <label class="col-sm-2 control-label">Volume Weight:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text"  name="volume_weight" id="volume_weight" class="form-control" readonly="readonly" >
                </div> 
              </div>
              <?php } ?>

              <?php if($_GET['p_type']=='32') { ?>
              <div class="form-group">
              <label class="col-sm-2 control-label">Tolerance Percentage:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" name="tolerance_percentage" value="" id="tolerance_percentage" class="form-control" >
                </div>
                <label class="col-sm-2 control-label"></label> 
                <div class="col-sm-4" id="regid"> 
                  &nbsp;
                </div>
              </div>                
              <?php } ?>


              <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label">Cast Weight:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" name="cast_weight" id="cast_weight" class="form-control" />
                </div>
                <label class="col-sm-2 control-label">Net Weight:</label> 
                <div class="col-sm-4" > 
                  <input type="number" name="net_weight" id="net_weight" class="form-control" />
                </div>
              </div>

              <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label"></label> 
                <div class="col-sm-4" id="regid"> 
                  &nbsp;
                </div>
                <label class="col-sm-2 control-label">Opening Stock</label> 
                <div class="col-sm-4"> 
                  <input type="number" min="0" name="opening_stock" id="opening_stock" value="" class="form-control" />
                </div>
              </div>

              
               <?php if($_GET['p_type']=='14'){?>     
               <div class="form-group">            
                <label class="col-sm-2 control-label">Qty/Crtn</label> 
                <div class="col-sm-4" > 
                  <input type="number" name="packing" value="" id="packing" class="form-control" >
                </div>
                <label class="col-sm-2 control-label">Gross Weight:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" name="weight" value="" id="weight" class="form-control" >
                </div>                
              </div>
              <?php } ?>

              <?php if($_GET['p_type']=='13'){?>   
              <div class="form-group">              
              <label class="col-sm-2 control-label">Scrap Name:</label> 
                <div class="col-sm-4" id="regid">
                  <select name="scrap_id" id="scrap_id" class="form-control" >
                    <option value="">--Select--</option>
                    <?php
                      $scrapQuery=$this->db->query("select *from tbl_product_stock where type='50'");
                      foreach($scrapQuery->result() as $getScrap){
                      ?>
                    <option value="<?=$getScrap->Product_id?>"><?=$getScrap->productname;?></option>
                    <?php }?>
                  </select>
                </div>
                <label class="col-sm-2 control-label"></label> 
                <div class="col-sm-4" id="regid"> 
                  &nbsp;
                </div>
                </div>
                <?php } ?>                
              

            </div>

            
            <?php if($_GET['p_type']=='14') { ?>
            <div class="form-group" id="consigneeMappingShape" style="padding:10px;" <?php if($_GET['p_type']=='14'){?>
              style="display:none1" <?php } else {?> style="display:none" <?php }?>>
              <div class="col-sm-12" >
                <table class="table table-bordered table-hover">
                  <tbody>
                    <tr class="gradeA">
                      <th>Shape Code</th>
                      <th>Part Code</th>
                      <th>RM Code</th>
                      <th>Usage Unit</th>
                      <th>Cast Weight</th>                      
                      <th>Net Weight</th>
                      <th>Scrap Name</th>
                      <th>Action</th>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr>
                      <td>
                        <input type="hidden" id="rowFg" class="form-control">
                        <select  class="select2 form-control" id="entityShape" onchange="selectFgList(this.value);">
                          <option value="">----Select ----</option>
                          <?php 
                            $sqlprotype=$this->db->query("SELECT * FROM tbl_product_stock where type = '33'");
                            foreach ($sqlprotype->result() as $fetch_protype){
                            ?>
                          <option value="<?=$fetch_protype->Product_id;?>"><?=$fetch_protype->sku_no; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td colspan="6">
                      </td>                      
                      <td>
                        <button type="button" onclick="addconsigneeShape()" class="btn btn-sm btn-black btn-outline">Add</button>
                      </td>                      
                    </tr>
                  </tbody>
                  <tbody id="fgTable"></tbody>
                </table>
                <div class="col-sm-12" >
                <table class="table table-bordered table-hover" >
                  <br>
                  <tbody>
                    <tr class="gradeA">
                      <th>Shape Code</th>
                      <th>Part Code</th>
                      <th>RM Code</th>
                      <th>Usage Unit</th>
                      <th>Cast Weight</th>                      
                      <th>Net Weight</th>
                      <th>Scrap Name</th>
                      <th>Action</th>
                    </tr>
                  </tbody>
                  <tbody id="consigneeTableShape"></tbody>
                </table>
              </div>
              </div>
            </div>
            <?php }?>

            <?php
              if($_GET['p_type']=='33')
              {
              ?>
            <div class="form-group" id="consigneeMapping" style="padding:10px;" <?php if($_GET['p_type']=='33'){?>
              style="display:none1" <?php } else {?> style="display:none" <?php }?>>
              <div class="col-sm-12" >
                <table class="table table-bordered table-hover">
                  <tbody>
                    <tr class="gradeA">
                      <th>Part Code</th>
                      <th>RM Code</th>
                      <th>Usage Unit</th>
                      <th>Cast Weight</th>
                      <th>Net Weight</th>
                      <th>Scrap Name</th>
                      <th>Action</th>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr>
                      <td>
                        <input type="hidden" class="form-control input-sm" id="shapeId"> 
                        <input type="hidden" class="form-control input-sm" id="shapeName"> 
                        <select  class="select2 form-control" id="entity" onchange="selectShapeList(this);">
                          <option value="" selected disabled>----Select ----</option>
                          <?php 
                            $sqlprotype=$this->db->query("SELECT * FROM tbl_product_stock where type = '32'");
                            	foreach ($sqlprotype->result() as $fetch_protype){

                              $ppm=$this->db->query("select * from tbl_part_price_mapping where part_id='$fetch_protype->Product_id' ");
                              $dtP=$ppm->row();
                              $scp=$this->db->query("select * from tbl_product_stock where Product_id='$dtP->rowmatial' ");
                              $getScId=$scp->row();

                              $prodIdShape   = $dtP->rowmatial;
                              $uomShape      = $dtP->unit;
                              $Cwght         = $dtP->EPrice;
                              $Nwght         = $dtP->qty;
                              $scrpIdShape   = $getScId->scrap_id;
                            ?>
                          <option value="<?=$fetch_protype->Product_id;?>^<?=$fetch_protype->sku_no;?>^<?=$prodIdShape;?>^<?=$uomShape;?>^<?=$Cwght;?>^<?=$Nwght;?>^<?=$scrpIdShape;?>"><?=$fetch_protype->sku_no; ?></option>
                          <?php } ?>
                        </select>
                      </td>

                      <td>
                        <select id="rmShape"  class="select2 form-control">
                        <option value="" selected disabled> </option>
                        <?php
                          $contQuery=$this->db->query("select * from tbl_product_stock where type = '13'");
                          foreach($contQuery->result() as $dt) {
                          ?>
                        <option value="<?=$dt->Product_id?>" ><?=$dt->sku_no;?></option>
                        <?php } ?>
                      </select>
                      </td>

                      <td>
                        <select class="form-control" id="shapeUnit" disabled>
                        <option value=""></option>
                        <?php 
                          $sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
                          foreach ($sqlunit->result() as $fetchunit){
                          ?>
                        <option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
                        <?php } ?>
                      </select>
                      </td>

                      <td>
                        <input type="number" class="form-control" id="shapeCweight" >
                      </td>

                      <td>
                        <input type="number" class="form-control" id="shapeNweight">
                      </td>

                      <td>
                        <select id="shapeScrap" class="form-control" disabled>
                        <option value=""></option>
                        <?php
                          $scrapQuery=$this->db->query("select * from tbl_product_stock where type='50'");
                          foreach($scrapQuery->result() as $getScrap){
                          ?>
                        <option value="<?=$getScrap->Product_id?>"><?=$getScrap->productname;?></option>
                        <?php }?>
                      </select>
                      </td>

                      <td>
                      <button type="button" onclick="Toaddconsignee()" class="btn btn-sm btn-black btn-outline">Add</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-12" >
                <table class="table table-bordered table-hover" >
                  <br>
                  <tbody>
                    <tr class="gradeA">
                      <th>Part Code</th>
                      <th>RM Code</th>
                      <th>Usage Unit</th>
                      <th>Cast Weight</th>                      
                      <th>Net Weight</th>
                      <th>Scrap Name</th>
                      <th>Action</th>
                    </tr>
                  </tbody>
                  <tbody id="consigneeTable"></tbody>
                </table>
              </div>
            </div>
            <?php }?>
            <?php
              if($_GET['p_type']=='32')
              {
              ?>
            <div class="form-group" id="consigneeMappingPart" style="padding:10px;" <?php if($_GET['p_type']=='32'){?>
              style="display:none1" <?php } else {?> style="display:none" <?php }?>>
              <div class="col-sm-12" >
                <div class="form-group" id="rawdisp">
                  <div class="col-sm-3">
                    <input type="hidden" class="form-control input-sm" value="" id="mproductname"> 
                    <input type="hidden" class="form-control input-sm" id="rowparts"> 
                    <input type="hidden"  class="form-control" value="" id="mproductid" >
                    <label class="control-label">RM Code:</label> <br>
                    <select id="prodetails"  class="select2 form-control" onchange="selectListdata(this);">
                      <option value="" selected disabled> --Select-- </option>
                      <?php
                        $contQuery=$this->db->query("select * from tbl_product_stock where type = '13'");
                        foreach($contQuery->result() as $dt)
                        	{
                        		$prodId   = $dt->Product_id;
                        		$prodName = $dt->productname;
                        		$uom      = $dt->usageunit;
                            $scrpId   = $dt->scrap_id;
                        ?>
                      <option value="<?=$prodId;?>^<?=$dt->sku_no;?>^<?=$uom;?>^<?=$scrpId;?>" ><?=$dt->sku_no;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label class="control-label">Usage Unit:</label> 
                    <select name="muom"  class="form-control" id="muom" disabled>
                      <option value=""></option>
                      <?php 
                        $sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
                        foreach ($sqlunit->result() as $fetchunit){
                        ?>
                      <option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-sm-2" > 
                    <label class="control-label">Cast Weight:</label> 
                    <input type="number" class="form-control" value="" id="EPrice" >
                  </div>

                  <div class="col-sm-2" > 
                    <label class="control-label">Net Weight:</label> 
                    <input type="number" class="form-control" value="" id="mPrice" onkeyup="checkWeight();">
                    <input type="hidden" name = "partid" class="form-control" value="" id="partid">
                    <input type="hidden" name = "itemid" class="form-control" value="" id="itemid">
                    <input type="hidden" name = "mapType" class="form-control" value="" id="mapType">
                  </div>
                  
                  <div class="col-sm-2" > 
                    <label class="control-label">Scrap Name:</label> 
                    <select name="scrapname" id="scrapname" class="form-control" disabled>
                    <option value=""></option>
                    <?php
                      $scrapQuery=$this->db->query("select * from tbl_product_stock where type='50'");
                      foreach($scrapQuery->result() as $getScrap){
                      ?>
                    <option value="<?=$getScrap->Product_id?>"><?=$getScrap->productname;?></option>
                    <?php }?>
                  </select>
                  </div>
                  <div class="col-sm-1" > 
                    <button  style = "margin-top: 25px;" class="btn btn-default" id="partsMapButton"  type="button" onclick="addpricemap()"><img src="<?=base_url();?>assets/images/plus.png" />
                    </button>
                  </div>
                </div>
                <table class="table table-bordered table-hover" >
                  <br>
                  <tbody>
                    <tr class="gradeA">
                      <th>RM Code</th>
                      <th>Usage Unit</th>
                      <th>Cast Weight</th>
                      <th>Net Weight</th>                      
                      <th>Scrap Name</th>
                      <th id="partTh">Action</th>
                    </tr>
                  </tbody>
                  <tbody id="partTable"></tbody>
                </table>
              </div>
            </div>
            <?php }?>
            <div class="modal-footer" id="button">
              <button type="submit" class="btn btn-sm">Save</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="listingData">
      <div class="row">
        <div class="col-sm-12">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="html5buttons">
              <div class="dt-buttons">
                <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 5px 0px 0px;">Excel</button>
                <button style="display:none"  id="btnExport" onclick="javascript:xport.toCSV('tblData');"> Export to CSV</button>
              </div>
            </div>
            <div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 5px;">
              <label>
                Show
                <select name="DataTables_Table_0_length" url="<?=base_url('master/Item/manage_item').'?p_type='.$_GET['p_type'].'&sku_no='.$_GET['sku_no'].'&type='.$_GET['type'].'&category='.$_GET['category'].'&productname='.$_GET['productname'].'&usages_unit='.$_GET['usages_unit'].'&size='.$_GET['size'].'&thickness='.$_GET['thickness'].'&gradecode='.$_GET['gradecode'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
                  <option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
                  <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                  <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                  <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                  <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                  <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
                </select>
                entries
              </label>
              <br />
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                Showing <?=$dataConfig['page']+1;?> to 
                <?php
                  $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                  echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                  ?> of <?=$dataConfig['total'];?> entries
              </div>
            </div>
            <div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
              <label>Search:
              <input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="panel-body">
          <div class="table-responsive" style="padding: 4px;">
            <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
              <thead>
                <tr>
                  <th id="ab"><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                  <th>
                    <div style="width:100px;"><?php if($_GET['p_type']=='13'){?>RM Code<?php } elseif($_GET['p_type']=='32'){?>Part Code <?php } elseif($_GET['p_type']=='33'){ echo "Shape Code";} elseif($_GET['p_type']=='35'){ echo "Accessories Code";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Code";} else{ echo "Item Code";}?></div>
                  </th>
                  <th style="display:none1;">
                    <div style="width:100px;">Product Type</div>
                  </th>
                  <th>
                    <div style="width:100px;">Category</div>
                  </th>
                  <th>
                    <div style="width:100px;"><?php if($_GET['p_type']=='13'){?>Raw Material Name<?php } elseif($_GET['p_type']=='32'){?>Part Name <?php } elseif($_GET['p_type']=='33'){ echo "Shape Name";} elseif($_GET['p_type']=='35'){ echo "Accessories Name";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Name";} elseif($_GET['p_type']=='50'){ echo "Scrap";} else{ echo "Finish Goods";}?></div>
                  </th>
                  <th>
                    <div style="width:100px;">Usage Unit</div>
                  </th>
                  <th style="display: none;">
                    <div style="width:50px;">Size</div>
                  </th>
                  <?php if($_GET['p_type']=='13'){?>
                  <th style="display: none;">
                    <div style="width:100px;">Thickness</div>
                  </th>
                  <?php }?>
                  <th style="display:none;">
                    <div style="width:100px;">Grade Code</div>
                  </th>
                  <th>
                    <div style="width:150px;">Action</div>
                  </th>
                </tr>
              </thead>
              <tbody id="getDataTable" >
                <form method="get">
                  <tr>
                    <td>&nbsp;</td>
                    <input name="p_type"  type="hidden"  class="search_box form-control input-sm"  value="<?=$_GET['p_type'];?>" />
                    <td><input name="sku_no"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="type"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="category"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="productname"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="usages_unit"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td style="display: none;"><input name="size" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <?php if($_GET['p_type']=='13'){?>
                    <td style="display: none;"><input name="thickness" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <?php }?>
                    <td style="display:none;"><input name="gradecode" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                  </tr>
                </form>
                <?php  
                  $i=1;
                  foreach($result as $fetch_list)
                  {
                  ?>
                <tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
                  <th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" /></th>
                  <?php
                    $queryType=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->type'");
                    $getType=$queryType->row();
                    ?>
                  <th><?=$fetch_list->sku_no;?></th>
                  <th style="display:none1;"><?=$getType->keyvalue;?></th>
                  <th>
                    <?php 
                      $compQuery = $this ->db
                      	   -> select('*')
                      	   -> where('id',$fetch_list->category)
                      	   -> get('tbl_category');
                      	  $compRow = $compQuery->row();
                      echo $compRow->name;
                      ?>
                  </th>
                  <th><?=$fetch_list->productname;?></th>
                  <th><?php
                    $compQuery1 = $this -> db
                    		   -> select('*')
                    		   -> where('serial_number',$fetch_list->usageunit)
                    		   -> get('tbl_master_data');
                    		  $keyvalue1 = $compQuery1->row();
                    echo $keyvalue1->keyvalue;		  
                    ?></th>
                  <th style="display: none;"><?=$fetch_list->pro_size;?></th>
                  <?php if($_GET['p_type']=='13'){?>
                  <th style="display: none;"><?=$fetch_list->thickness;?></th>
                  <?php }?>
                  <th style="display:none;"><?=$fetch_list->grade_code;?></th>
                  <th class="bs-example">
                    <?php if($view!=''){ ?>
                    <button class="btn btn-default" property="view" arrt= '<?=json_encode($fetch_list);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
                    <?php } if($edit!=''){ ?>
                    <button type="button" property="edit" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editItem(this)"><i class="icon-pencil"></i></button>
                    <?php }
                      $pri_col='Product_id';
                      $table_name='tbl_product_stock';
                      ?>
                    <button class="btn btn-default delbutton" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" type="button">
                    <i class="icon-trash"></i></button>		
                    <?php
                      if($fetch_list->type=='33')
                      {
                       ?>
                    <button  class="btn btn-default" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" onclick="viewPartCode(<?=$fetch_list->Product_id;?>)" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><i class="icon-flow-tree"></i></button>
                    <?php }?>
                  </th>
                </tr>
                <?php $i++; } ?>
              </tbody>
              <input type="text" style="display:none;" id="table_name" value="tbl_product_stock"> 
              <input type="text" style="display:none;" id="pri_col" value="Product_id">
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="col-md-6 text-left"></div>
          <div class="col-md-6"> <?php echo $pagination; ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>
<script>
  function changing(v)
  {
  	//alert(v);
   	var pro=v;
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "changesubcatg?ID="+pro, false);
  	xhttp.send();
  	//alert(xhttp.responseText);
  	document.getElementById("subcategory1").innerHTML = xhttp.responseText;
  	 // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
  }
  function getCat(v)
  {
  	var pro=v;
  	var xhttp = new XMLHttpRequest();
  	if(v=='33')
  	{
  	$("#consigneeMapping").show();
  	}
  	else
  	{
  		$("#consigneeMapping").hide();
  	}
  	xhttp.open("GET", "getCat?ID="+pro, false);
  	xhttp.send();
  	//alert(xhttp.responseText);
  	document.getElementById("category").innerHTML = xhttp.responseText;
  	// document.getElementById("subcategory11").innerHTML = xhttp.responseText;
  }
</script>	
<script>
  function exportTableToExcel(tableID, filename = ''){
   
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      
      // Specify file name
      filename = filename?filename+'.xls':'ProductList_<?php echo date('d-m-Y');?>.xls';
      
      // Create download link element
      downloadLink = document.createElement("a");
      
      document.body.appendChild(downloadLink);
      
      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      }else{
  
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
      
          // Setting the file name
          downloadLink.download = filename;
          
          //triggering the function
          downloadLink.click();
      }
  }
</script>
<script>
  
  function viewPartCode(partid){
  
  var ur = 'ajex_getPartCode';
  	$.ajax({
  		type: "POST",
  		url: ur,
  		data: {'partid':partid},
  		success: function(data){
          $("#getPartMappingData").empty().append(data).fadeIn();
  	}
      });
  }
  function mapiingPartRowMat(partid,machineid,mtype){
  	var ur = 'ajex_getPartRowMat';
  	$.ajax({
      	type: "POST",
      	url: ur,
  		data: {'partid':partid,'machineid':machineid},
  		success: function(data){
  		$("#getsparepartqtymapping").empty().append(data).fadeIn();
  		$('#partid').val(partid);
          $('#itemid').val(machineid);
          $('#mapType').val(mtype);
        }
      });
  }
  function mapiingPartRowMatView(partid,machineid,mtype){
  	
  	var ur = 'ajex_getPartRowMatView';
  	$.ajax({
  		type: "POST",
  		url: ur,
  		data: {'partid':partid,'machineid':machineid},
  		success: function(data){
          $("#getsparepartqtymappingView").empty().append(data).fadeIn();
  		$('#partid').val(partid);
          $('#itemid').val(machineid);
          $('#mapType').val(mtype);
  	}
      });
  }
  
  function selectListdata(ths){
  
    	 $("#muom").attr('disabled',false);
       $("#scrapname").attr('disabled',false);
       $('#productListData').css('display','none');

       res = ths.value.split("^");
       //alert(res[3]);
       $('#mproductid').val(res[0]);
       $('#mproductname').val(res[1]);
       $("#muom").val(res[2]);
       $("#scrapname").val(res[3]);

       $("#muom").attr('disabled',true);
       $("#scrapname").attr('disabled',true);
  
  }

  
  function addpricemap()
  {
  
  	var mproductname =  $('#mproductname').val();
  	var mproductid   =  $('#mproductid').val();
  	var price        =  $('#mPrice').val();
  	var Eprice        =  $('#EPrice').val();

  	var muom         =  $('#muom').val();
  	var muomval      =  $("#muom option:selected").text();

    var scrapID       = $('#scrapname').val();
    var scrapval      =  $("#scrapname option:selected").text();

    var row = $('#rowparts').val();

    if(row == 1) {
      alert("You can't add more than one raw material !");
    } else if(mproductid != '' && price != '' && Eprice != '' && muom != ''   ) {

    	$('#resultarea').text("");
    	$('#prodetails option:selected').remove();
    	$('#partTable').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="EPrice[]" value="'+Eprice+'">'+Eprice+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><input type ="hidden" name="scrapname[]" value="'+scrapID+'">'+scrapval+'</td><td><i class="fa fa-trash  fa-2x" mproductid="'+mproductid+'" mproductname="'+mproductname+'" uom="'+muom+'" scraps="'+scrapID+'"  id="quotationdel" aria-hidden="true"></i></td></tr>');

      $("#rowparts").val(1);
    	
      $('#mproductname').val("");
    	$('#mproductid').val("");
    	$('#mPrice').val("");
    	$('#EPrice').val("");
    	$("#muom").val("");
      $("#scrapname").val("");
    	$("#prodetails").val("");
      $("#select2-prodetails-container").text("--select--");

    } else {
      alert("Nothing to add !");
    }
  
  }
  
  $("#productpriceMapped").validate({
  	rules: {},
      submitHandler: function(form) {
      ur = "ajex_insertMapping";
      var formData = new FormData(form);
      $.ajax({
      	type : "POST",
  		url  :  ur, 
  		data : formData, // serializes the form's elements.
  		success : function (data) {
  		if(data == 1){
  			if(data == 1)
  				var msg = "Mapping Process Successful !";
  				$("#resultarea").text(msg); 
  				setTimeout(function() {   //calls click event after a certain time
  				$("#modal-2 .close").click();
  				$("#resultarea").text(" "); 
                  $('#myform')[0].reset(); 
                  $("#id").val("");
                  }, 1000);
                  }else{
                      $("#resultarea").text(data);
                  }
                  },
                  error: function(data){
                  alert(data);
                  },
                  cache: false,
                  contentType: false,
                  processData: false
              });
            return false;
          //form.preventDefault();
        }
    });
  
  
  function getEntityRow(thsValue){
  
  $.ajax({  
  	type: "POST",  
  	url: "ajax_getentityRows",  
  	cache:false,  
  	data: {'id':thsValue},  
  	success: function(data)  
  	{
  		$("#consigneeTable").empty().append(data).fadeIn();
  		//amazonEntity();
  	}   
  	});
  }
  function getEntityRowOfPartCode(thsValue){
  	$.ajax({  
  		type: "POST",  
  		url: "ajax_getentityRowsOfPart",  
  		cache:false,  
  		data: {'id':thsValue},  
  		success: function(data)  
  		{
        if(data == 0) {
          $("#rowparts").val(0);
        }else {
          $("#partTable").empty().append(data).fadeIn();
          $("#rowparts").val(1);
        }  			
  			//amazonEntity();
  		}   
  	    });
  }
  
  function getEntityRowOfShape(thsValue){
  
  $.ajax({  
  	type: "POST",  
  	url: "ajax_getentityShape",  
  	cache:false,  
  	data: {'id':thsValue},  
  	success: function(data)  
  	{
      if(data == 0) {
        $("#rowFg").val(0);
      } else {
        $("#rowFg").val(1);
        $("#consigneeTableShape").empty().append(data).fadeIn();
      }  		
  		//amazonEntity();
  	}   
  	});
  }

  function selectFgList(v)
  {
    
    var ul ="<?=base_url();?>master/Item/ajax_get_shape_list"
    //lert(ul);

    $.ajax({
      type : "POST",
      url  : ul,
      data : {'id':v},
      success : function(data)
      {
        //alert(data);
        $("#fgTable").empty().append(data).fadeIn();
      }

    });

  }


  function getFG()
  {
  $("#status").val("13").trigger('chosen:updated');
  
  }
  
  function cbmCalculation()
  {
  var ctn_height=document.getElementById("ctn_height").value;
  var ctn_lenght=document.getElementById("ctn_lenght").value;
  var ctn_width=document.getElementById("ctn_width").value;
  var calcbm=Number(ctn_height)*Number(ctn_lenght)*Number(ctn_width)/1000000;
  var vlmwgt=Number(ctn_height)*Number(ctn_lenght)*Number(ctn_width)/5000;
  document.getElementById("cbm").value=calcbm.toFixed(3);
  document.getElementById("volume_weight").value=vlmwgt.toFixed(3);
  }
  

function selectShapeList(ths){

    $("#rmShape").attr('disabled',false);
    $("#shapeUnit").attr('disabled',false);
    $("#shapeScrap").attr('disabled',false);
    $("#shapeCweight").prop('readonly', false);
    $("#shapeNweight").prop('readonly', false);

    res = ths.value.split("^");
    //alert(res[3]);
    $('#shapeId').val(res[0]);
    $('#shapeName').val(res[1]);
    $("#rmShape").val(res[2]);
    $("#shapeUnit").val(res[3]);
    $("#shapeCweight").val(res[4]);
    $("#shapeNweight").val(res[5]);
    $("#shapeScrap").val(res[6]);

    $("#rmShape").attr('disabled',true);
    $("#shapeUnit").attr('disabled',true);
    $("#shapeScrap").attr('disabled',true);
    $("#shapeCweight").prop('readonly', true);
    $("#shapeNweight").prop('readonly', true);

}

  function Toaddconsignee()
  {
  
    var value        =  0;
    var entity       =  $('#entity').val();
    var shape        =  $('#shapeId').val();
      
    var e = document.getElementById("rmShape");
    var rmCd = e.options[e.selectedIndex].text;

    var f = document.getElementById("shapeUnit");
    var rmUt = f.options[f.selectedIndex].text;

    var g = document.getElementById("shapeScrap");
    var rmScrp = g.options[g.selectedIndex].text;

    //var h = document.getElementById("shapeCweight");
    var rmCw = $("#shapeCweight").val();

    //var k = document.getElementById("shapeNweight");
    var rmNw = $("#shapeNweight").val();
    //alert(entity) ;

    var prodIdShape   = $("#rmShape").val();
    var uomShape      = $("#shapeUnit").val();
    var scrpIdShape   = $("#shapeScrap").val();

    if(shape != null)
    {
      
      var x        = document.getElementById("entity").selectedIndex;
      var y        = document.getElementById("entity").options;
      var indexVal =  y[x].text;

      $('#entity option:selected').remove();
      
      $('#consigneeTable').append('<tr class="'+'row_'+value+'"><td><input type ="hidden" class="form-control" name="entity[]" value="'+shape+'">'+indexVal+'</td><td>'+rmCd+'</td><td>'+rmUt+'</td><td>'+rmCw+'</td><td>'+rmNw+'</td><td>'+rmScrp+'</td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel_shape" attrVal="'+shape+'" val="'+indexVal+'" prodIdShape="'+prodIdShape+'" uomShape="'+uomShape+'"  rcwgt="'+rmCw+'" rnwgt="'+rmNw+'" scrpIdShape="'+scrpIdShape+'" aria-hidden="true"></i></td></tr>');
      
      //amazonEntity();
      $("#entity").val("");
      $('#shapeId').val("");
      $('#shapeName').val("");
      $("#rmShape").val("");
      $("#shapeUnit").val("");
      $("#shapeCweight").val("");
      $("#shapeNweight").val("");
      $("#shapeScrap").val("");
      $("#select2-entity-container").text("--select--");

    }
    else
    {
      
      alert('Please Select Part Code');
      //$('#entity').focus();

    }
    
  
  }
  
  function amazonEntity(){
  
  
  $("select#entity").prop('selectedIndex', 0);
  var selectedentity = document.getElementsByName('entity[]'); 
  // alert(selectedentity);
  var selectboxes = [];
  for(var i=0; i < selectedentity.length; i++){
  
  if(selectedentity[i] != ""){
  selectboxes.push(selectedentity[i].value);
  }
  }
  
  $('select#entity').find('option').each(function() {
  // alert($(this).val());
  if(selectboxes.includes($(this).val()) == true){
  // // alert(arrayloc.includes(checkboxes[i].value));
  // checkboxes[i].checked = true;
  //  alert($(this).val());
  $(this).css("visibility", "hidden");
  }
  });
  
  $("#entity_code").empty().append('<option value="">--Select--</option>').fadeIn();
  
  }
  

  function addconsigneeShape()
  {
  
     var value        =  0;
     var entityShape       =  $('#entityShape').val();
     var row  =  $('#rowFg').val();
  
  
     if(entityShape == ""){
      alert('Please Select Shape Name');
      $('#entityShape').focus();
      //return false;
     } else if(row==1) {
      alert("You can't add more than one shape !");
      $("#fgTable").empty();
     } else {
      
      var x        = document.getElementById("entityShape").selectedIndex;
      var y        = document.getElementById("entityShape").options;
      var indexVal =  y[x].text;
     
      $('#entityShape option:selected').remove();
     
      var count = document.getElementsByName('rowCount[]'); 
      var tcount = count.length;
      //alert(tcount);
      for(var i=0; i < tcount; i++){

        var part = $("#partFg"+i).val();
        var rm   = $("#rmFg"+i).val();
        var unit = $("#unitFg"+i).val();
        var cwgt = $("#cwgtFg"+i).val();
        var nwgt = $("#nwgtFg"+i).val();
        var scrp = $("#scrapFg"+i).val();
      if(i==0){
        $('#consigneeTableShape').append('<tr class="'+'row_'+value+'"><td><input type ="hidden" class="form-control" name="entityShape[]" value="'+entityShape+'">'+indexVal+'</td><td>'+part+'</td><td>'+rm+'</td><td>'+unit+'</td><td>'+cwgt+'</td><td>'+nwgt+'</td><td>'+scrp+'</td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel_fg" attrVal="'+entityShape+'" val="'+indexVal+'" aria-hidden="true"></i></td></tr>');
      }else{
        $('#consigneeTableShape').append('<tr class="'+'row_'+value+'"><td></td><td>'+part+'</td><td>'+rm+'</td><td>'+unit+'</td><td>'+cwgt+'</td><td>'+nwgt+'</td><td>'+scrp+'</td><td></td></tr>');
      }      

      }
      $("#fgTable").empty();
      $("#rowFg").val(1);
     
     }

    //amazonEntity();
    //$('#entity option:selected').remove();  

   }



   function showBox(v){
    //alert(v);
    if(v==41){
      $("#userCircle").css("display", "none");      
      $("#useSet").css("display","block");
      $("#qty_set").val('');
    }else if(v==42){
      $("#userCircle").css("display", "block");
      $("#useSet").css("display","none");
      $("#circle_weight").val('');
    }else{
      $("#userCircle").css("display", "none");
      $("#useSet").css("display","none");
    }

   }

function checkWeight(){

  var cw=$("#EPrice").val();
  var nw=$("#mPrice").val();

  if(Number(nw) > Number(cw))
  {
    alert("Net weight can't be greater than cast weight");
    $("#partsMapButton").attr("disabled",true);
  }
  else
  {
    $("#partsMapButton").attr("disabled",false);
  }

}

</script>