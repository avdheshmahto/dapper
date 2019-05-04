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
<?php
$p_name = "";$p_id="";$f_date="";$t_date="";
 if($this->input->post() != "") { 
 $p_name = $this->input->post('p_name');
 $p_id   = $this->input->post('p_id');
 $f_date = $this->input->post('f_date');
 $t_date = $this->input->post('t_date');
 } ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">PRODUCTION PACKING REPORT  </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!-- <i class="icon-arrows-ccw"></i> --><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<div class="panel-body" style="    background: #dedede;    padding: 20px 0px;    margin-bottom: 25px;">
<form class="form-horizontal" method="post" action="">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Contact Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="<?php echo $p_name;?>" Placeholder="Contact Name"/>
</div>
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
	<select class="form-control" name="p_id">
		<option value="">-- Select Finish Good --</option>
	<?php	
    if($getfinishgood != ""){
	foreach($getfinishgood as $dt){ ?>
	<option value="<?=$dt['Product_id'];?>" <?php if($p_id == $dt['Product_id']){ ?> selected <?php } ?> ><?=$dt['productname'];?></option>
	<?php }} ?>
	</select>
<!-- <input type="text" name="p_id" class="form-control" value="" /> 
 --></div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control" value="<?php echo $f_date;?>" /> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" value="<?php echo $t_date;?>" /> 
</div>
<div class="col-sm-6" > 
<!-- <label class="col-sm-3 control-label" style="float:right;"><button type="submit" name="Show" class="btn btn-sm" value="Show">Show</button></label>  --> 
</div>
<div class="col-sm-6" style="float:right;padding: 18px 0 0 74px;"> 
<label class="col-sm-3 control-label" ><button type="submit" name="Show" class="btn btn-sm" value="Show"> Search </button></label>
<label class="col-sm-3 control-label"><a href=""  class="btn btn-sm" style="margin-right: 27px;"> Clear </a></label>  </div>
</div>
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	    <th>Contact Name</th>		
        <th>Date</th>
        <th>Finish Good</th>
        <th>Qty</th>
		<!-- <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($masterCuttingSearch)) {
foreach($masterCuttingSearch as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $rows['first_name'];?></th>
<th><?php echo $rows['log_date'];?></th>
<th><?php echo $rows['productname'];?></th>
<th><?php echo $rows['log_qty'];?></th>
<!-- <th><button class="btn btn-default" type="button" data-toggle="modal" onClick="openpopup('<?=base_url();?>report/Report/view_production',1400,600,'id',<?=$rows->productionid;?>)" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button></th> -->
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