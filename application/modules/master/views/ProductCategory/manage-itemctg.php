<?php
  $this->load->view("header.php");
  
  $entries = "";
  if($this->input->get('entries')!="")
  {
    $entries = $this->input->get('entries');
  }
  
  ?>
<style type="text/css">
  .ztree * {font-size: 10pt;font-family:"Microsoft Yahei",Verdana,Simsun,"Segoe UI Web Light","Segoe UI Light","Segoe UI Web Regular","Segoe UI","Segoe UI Symbol","Helvetica Neue",Arial}
  .ztree li ul{ margin:0; padding:0;margin-left: 31px;}
  .ztree li {line-height:30px;}
  .ztree li a {width:200px;height:30px;padding-top: 0px;}
  .ztree li a:hover {text-decoration:none; background-color: #E7E7E7;}
  .ztree li a span.button.switch {visibility:visible}        /*hidden*/
  .ztree.showIcon li a span.button.switch {visibility:visible}
  .ztree li a.curSelectedNode {background-color:#D4D4D4;border:0;height:30px;}
  .ztree li span {line-height:30px;}
  .ztree li span.button {margin-top: -7px;}
  .ztree li span.button.switch {width: 16px;height: 16px;}
  .ztree li a.level0 span {font-size: 110%;font-weight: bold;}
  .ztree li span.button {background-image:url("../../img/left_menuForOutLook.png"); *background-image:url("../../img/left_menuForOutLook.gif")}
  .ztree li span.button.switch.level0 {width: 20px; height:20px}
  .ztree li span.button.switch.level1 {width: 20px; height:20px}
  .ztree li span.button.noline_open {background-position: 0 0;}
  .ztree li span.button.noline_close {background-position: -18px 0;}
  .ztree li span.button.noline_open.level0 {background-position: 0 -18px;}
  .ztree li span.button.noline_close.level0 {background-position: -18px -18px;}
  .listClass{position: relative;right: 12px font-size: 15px;    font-weight: 600;
  height: 90px !important;border-left: 2px solid red; padding: 14px 20px 14px 20px; }
  .displayclass{display: none;}
</style>
<!-- Main content -->
<div class="main-content">
  <div class="panel-body panel panel-default" style="padding: 10px;">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb breadcrumb-2">
          <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
          <li><a href="#">Master</a></li>
          <li><a href="#">Product Group</a></li>
          <li class="active"><strong>Manage Product Group </strong> </li>
          <div class="pull-right" >
            <a style="display:none" id="TreeShowId" class="dt-button" tabindex="0" data-toggle="modal" data-target="#modal-2" onclick="showtree();" ><span><i class="icon-flow-tree"></i>Category Tree</span></a>
            <a class="btn btn-sm" data-toggle="modal" formid = "#formId" data-target="#modal-1" id="formreset" style="margin-top: -18px;"><i class="fa fa-plus" aria-hidden="true" onclick="inputdisable();" ></i> Add Product Type</a>
            <a class="btn btn-secondary btn-sm delete_all" style="margin-top: -18px;"><span><i class="fa fa-trash-o"></i> Delete All</span></a>
          </div>
        </ol>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
                <tr>
                  <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                  <th>Product Type</th>
                  <th>Category Name</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="loadProductData">
                <?php
                  $yy=1;
                  if(!empty($result_list)) {
                  foreach($result_list as $rows) {
                  ?>
                <tr class="gradeC record" data-row-id="<?=$rows['id'];?>">
                  <th>
                    <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?=$rows['id'];?>" value="<?=$rows['id'];?>" />
                  </th>
                  <th>
                    <?php
                      $typeQuery=$this->db->query("select *from tbl_master_data where serial_number='".$rows['type']."'");
                      $getType=$typeQuery->row();
                      ?>
                    <?=$getType->keyvalue;?>
                  </th>
                  <th id="row<?=$rows['id'];?>" onmouseover="showRowtree(<?=$rows['id'];?>)" style="cursor: pointer;"><?php echo $rows['name'];?></th>
                  <th><?=$rows['create_on'];?></th>
                  <th>
                    <?php 
                      $pri_col='id';
                      $table_name='tbl_category';
                      ?>
                    <?php if($view!=''){ ?>
                    <button class="btn btn-default modalEditItem" property = "view" type="button" data-toggle="modal" data-target="#modal-1" data-backdrop='static'   arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" onclick ="editRowCategory(this.id,this,<?=$rows['type'];?>);"  id="<?=$rows['id'];?>" data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                    <?php } if($edit==''){ ?>  
                    <a  id="<?=$rows['id'];?>" property ="edit"  arrt = "<?=$rows['type'];?>"  cat_id ="<?=$rows['parent_id'];?>" typ="<?=$rows['parent_id'];?>"   onclick ="editRowCategory(this.id,this,<?=$rows['type'];?>);" class="btn btn-default modalEditItem"  data-toggle="modal" data-target="#modal-1" >&nbsp; <i class="icon-pencil"></i> &nbsp; </a> 
                    <?php } ?>      
                    <button class="btn btn-default delbutton" id="<?php echo $rows['id']."^".$table_name."^".$pri_col ; ?>" ><i class="icon-trash"></i></button>	
                  </th>
                </tr>
                <?php } } ?>
              </tbody>
              <input type="text" style="display:none;" id="table_name" value="tbl_category">  
              <input type="text" style="display:none;" id="pri_col" value="id">
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 text-right">
    <div class="col-md-6 text-left"> </div>
    <div class="col-md-6"> 
      <?php echo $pagination; ?>
    </div>
    <div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;">
      <div class="popover-content" id="showParent"></div>
    </div>
  </div>
</div>
<!--Large Modal-->
<div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="top: 30px;left: 5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="top_title"></span></h4>
        <div id="resultarea" class="text-center" style="font-size: 15px;color: red;"></div>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formId">
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-6" >
              <p class="text-danger" id="error"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Product Type</label>
            <div class="col-sm-6">
              <select name="type" id="typee"  class="form-control">
                <option value="">----Select ----</option>
                <?php 
                  $sqlprotype=$this->db->query("select * from tbl_master_data where param_id=17");
                  foreach ($sqlprotype->result() as $fetch_protype){
                  ?>
                <option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Category Name </label>
            <div class="col-sm-6"> 
              <input type="text"  name="category" class="form-control" id="category" placeholder="Enter input" value="<?=$name;?>" required>
            </div>
          </div>
          <div class="form-group" style="display:none">
            <label class="col-sm-3 control-label">Select Category</label> 
            <div class="col-sm-6">
              <select class=" form-control" required name="selectCategory" id="selectCategory">
                <!-- //select2 -->
                <option value="0" class="listClass">Category</option>
                <?php
                  foreach ($categorySelectbox as $key => $dt) { ?>
                <option id="<?=$dt['id'];?>" value = "<?=$dt['id'];?>" class="<?=$dt['praent']==0 ? 'listClass':'';?>" > <?=$dt['name'];?></option>
                <?php } ?>
              </select>
            </div>
            <input type="hidden" class="hiddenField" name="editvalue" value="" id="editvalue">
          </div>
        </form>
        <div class="modal-footer" id="button">
          <?php	if($edit==''){  ?>
          <a class="btn btn-sm" style1="padding:4px;"  submit_value = "save" id="target"> Save </a>
          <?php } ?>	
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="padding: 4px;">Cancel</button>
        </div>
        <a  arr='<?=$result;?>' class="treeAncor" id="content_wrap"></a>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!--End Large Modal-->
</div>
<!--Large Modal-->
<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="top: 30px;left: 5px;" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> Show Category Tree </h4>
      </div>
      <div class="modal-body">
        <!-- Card list view -->
        <div class="cards-container">
          <!-- Card -->
          <div class="card_">
            <div class="card-header panel-heading clearfix">
              <div class="content_wrap">
                <div class="zTreeDemoBackground left">
                  <ul id="treeDemo" class="ztree">
                  </ul>
                </div>
                <div class="right">
                </div>
              </div>
            </div>
          </div>
          <!-- /card -->
        </div>
        <!-- /card container -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $this->load->view("footer.php");
  ?>