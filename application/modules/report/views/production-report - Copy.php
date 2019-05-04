<?php
$this->load->view("header.php");
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$table_name_1='tbl_product_stock';
$pri_id='Product_id';
$field_name='productname';
?>
	<!-- Main content -->
	<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">PRODUCTION REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="searchProduction">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Production Id</label> 
<div class="col-sm-3"> 
<input type="text" name="p_id" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="" /> 
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label"><button type="submit" name="Show" class="btn btn-sm" value="Show">Show</button></label>  
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th>Production Id</th>		
        <th>Date</th>
        <th>Product Name </th>
        <th>Qty</th>
		<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($masterCuttingSearch)) {
foreach($masterCuttingSearch as $rows) {
?>
<tr class="gradeC record">
<th><?=$rows->productionid;?></th>
<th><?=$rows->date;?></th>
<?php
$id=$rows->product_id;
?>
<th><?php echo $obj->getManagePageData($table_name_1,$pri_id,$id,$field_name);?></th>
<th><?=$rows->qty;?></th>
<th><button class="btn btn-default" type="button" data-toggle="modal" onClick="openpopup('<?=base_url();?>report/Report/view_production',1400,600,'id',<?=$rows->productionid;?>)" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button></th>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>