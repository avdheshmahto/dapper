<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/ProductCategory.php');
$objj=new ProductCategory();
$CI =& get_instance();

$list='';

$list=$objj->pcategory_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_prodcatg_mst';
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
//$filtername$filterdate
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
<!-- Page container -->
   <div class="page-container">
     <div class="main-container">
      <!-- Main content -->
       <div class="main-content">
         <div class="row">



   <div class="col-sm-12">
	 <ol class="breadcrumb"> 
       <li class="active">Manage Category Data </li> 
     </ol>
	<div class="panel-body" style="background: #f7f7f7;">
		<!-- <div style="    margin-bottom: 47px;">
			<button type="button" class="btn btn-sm pull-right" data-toggle="modal" data-target="#modal-1" ><i class="fa fa-arrow-circle-left"></i> Add Category</button>
            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal-2" style="margin-right: 10px;" data-rel="reload">
			<i class="icon-flow-tree"></i> Category Tree	</button>
			
	    </div> -->
	    <div id="loadProductData">
		<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<div class="html5buttons">
			  <div class="dt-buttons">
				<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
				<a id="TreeShowId" class="dt-button" tabindex="0" data-toggle="modal" data-target="#modal-2"><span><i class="icon-flow-tree"></i>Category Tree</span></a>
				<a class="btn btn-sm" data-toggle="modal" formid = "#formId" data-target="#modal-1" id="formreset"><i class="fa fa-arrow-circle-left" onclick="inputdisable();"></i> Add Category</a>
				<a class="btn btn-secondary btn-sm delete_all" ><span><i class="fa fa-trash-o"></i> Delete</span></a>
				  </div>
				    </div>
                     
					<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" url="<?=base_url('master/ProductCategory/manage_itemctg');?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">

						<option value="10">10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						</select>
						entries</label>
						<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -5px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
							<?php
							$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
							echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
							?> of <?=$dataConfig['total'];?> entries
						</div>
						</div>

						<div id="DataTables_Table_0_filter" class="dataTables_filter">
						<label>Search:
						<input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
						</label>
						</div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover dataTables-example1" >
							<thead>
								<tr>
                                <th></th>
								<th><br>Category Name</th>		
								<th>Date</th>
								<th>Action</th>
								<!-- <th>Action</th> -->
								</tr>
								<tr>
							    
                                <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                                <form action="" method="get">
								<th><input type="text" name="filtername" id="searchTerm" value="<?=$filtername;?>"  class="search_box form-control input-sm"  placeholder="Please Enter Category Name"></th>		
								<th><input type="date" name="filterdate" id="searchTerm" value="<?=$filterdate;?>"  class="search_box form-control input-sm"  placeholder="Please Enter Category Date"></th>
								<th><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Filter</span></button>
								<!-- <a href="<?=base_url('master/ProductCategory/manage_itemctg');?>"  class="btn btn-sm"  value="filter"><span>All</span></a> -->
								</th>
							    </form>
								<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody id="getDataTable">
							<?php
							$yy=1;
							if(!empty($result_list)) {
							  foreach($result_list as $rows) {
							?>
							<tr class="gradeC record" data-row-id="<?=$rows['id'];?>">

								<th>
								<input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?=$rows['id'];?>" value="<?=$rows['id'];?>" />
							    </th>
								<th id="row<?=$rows['id'];?>" onmouseover="showRowtree(<?=$rows['id'];?>)" style="cursor: pointer;"><?php echo $rows['name'];?>
								</th>
								<th><?php echo $rows['create_on'];?></th>
								<th>
								<?php $pri_col='id';
                                      $table_name='tbl_category';
                                ?>
                                
                         <?php if($view!=''){ ?>
                             <button class="btn btn-default modalEditItem" type="button" data-toggle="modal" data-target="#modal-1" data-backdrop='static'  arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" onclick ="editRow(this.id);"  id="<?=$rows['id'];?>" data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                         <?php } if($edit==''){ ?>  
                         <a  id="<?=$rows['id'];?>"  arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" onclick ="editRow(this.id);" class="btn btn-default modalEditItem"  data-toggle="modal" data-target="#modal-1" >&nbsp; <i class="icon-pencil"></i> &nbsp; </a> 
                          <?php } ?>      
                           <button class="btn btn-default delbutton" id="<?php echo $rows['id']."^".$table_name."^".$pri_col ; ?>" ><i class="icon-trash"></i></button>	
                       
						</th>
					</tr>
				<?php } } ?>
              </tbody>
            </table>
		  </div>
		  <div class="row">
	       <div class="col-md-12 text-right">
	    	  <div class="col-md-6 text-left"> 
	    		<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
	    	  </div>
	    	  <div class="col-md-6"> 
	          <?php echo $pagination; ?>
	          </div>

	          <div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;"><!-- <div class="arrow" style="top: 50%;"></div>  -->
			<div class="popover-content" id="showParent"></div>
			</div>
	       </div>
	     </div>
        </div>  
				<!--Large Modal-->
		<div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content" style="top: 38px;left: 45px;">
			    <div class="modal-header">
			      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      <h4 class="modal-title">Add Category</h4>
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
				<label class="col-sm-3 control-label">Enter Tree Value </label>
				<div class="col-sm-6"> 
				<input type="text"  name="category" class="form-control" id="category" placeholder="Enter input" value="<?=$name;?>" required>
			    </div>
			  </div>
			  <div class="form-group"> 
				<label class="col-sm-3 control-label">Select Category</label> 
				  <div class="col-sm-6"> 
					 <select class=" form-control" required name="selectCategory" id="selectCategory"> <!-- //select2 -->
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
			     	<a class="btn btn-sm" style="padding:4px;"  submit_value = "save" id="target"> Save </a>
			      <?php } ?>	
			        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="padding: 4px;">Cancel</button>
			     </div>
			     </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		<!--End Large Modal-->
     </div>

<!--Large Modal-->
	<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content" style="top: 38px;left: 45px;" >
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"> Show Category Tree </h4>
	      </div>
	      <div class="modal-body">
	       <!--  <p>One fine body&hellip;</p> -->
	         <!-- Card list view -->
				<div class="cards-container">
                   <!-- Card -->
					<div class="card">
						<div class="card-header panel-heading clearfix">
						     <div class="content_wrap">
								<div class="zTreeDemoBackground left">
									<ul id="treeDemo" class="ztree">
									</ul>
								</div>
								<div class="right">
								</div>
							 </div> 
							<a  arr='<?=$result;?>' class="treeAncor" id="content_wrap"></a>
						</div>
					</div>
					<!-- /card -->
				</div>
				<!-- /card container -->
	      </div>
	      <!-- <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	       </div> -->
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!--End Large Modal-->
            <!-- /main content -->
<input type="text" style="display:none;" id="table_name" value="tbl_category">  
<input type="text" style="display:none;" id="pri_col" value="id">
    
</div>

<?php

$this->load->view("footer.php");
?>