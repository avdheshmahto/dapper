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
<h4 class="panel-title">PACKING REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="searchPacking">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Packing Id</label> 
<div class="col-sm-3"> 
<input type="text" name="p_id" class="form-control" value="" />
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
		<th>Packing Id</th>
	    <th>Production Id</th>		
        <th>Product Name </th>
        <th>Date</th>
        <th>Qty</th>
		<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($packingSearch)) {
foreach($packingSearch as $sales) {
?>
<th><?php 
$sql1 = $this->db->query("select * from tbl_packing where qc_id = '$sales->qc_id' ");
			$sql2 = $sql1->row();	
		echo $sql2->packing_id;
		?>
</th>
<th><?php 
$queryfetch=$this->db->query("select * from tbl_qualitiy_check where qc_id='$sales->qc_id'");	
	$fetchqrow=$queryfetch->row();
	$query=$this->db->query("select * from tbl_tailor where tailor_id='$fetchqrow->tailor_id'");	
	$fetchq=$query->row();
	echo $fetchq->production_id;
?></th>
<th><?php 
$queryfetch=$this->db->query("select * from tbl_qualitiy_check where qc_id='$sales->qc_id'");	
	$fetchqrow=$queryfetch->row();
$query=$this->db->query("select * from tbl_tailor where tailor_id='$fetchqrow->tailor_id'");	
	$fetchq=$query->row();
$queryfetch1=$this->db->query("select * from tbl_production_hdr where productionid='$fetchq->production_id'");	
	$fetchqrow1=$queryfetch1->row();
$queryfetch11=$this->db->query("select * from tbl_product_stock where Product_id='$fetchqrow1->product_id'");	
	$fetchqrow11=$queryfetch11->row();
	echo $fetchqrow11->productname;
?></th>
<th><?=$sales->date;?></th>
<th><?=$sales->qty;?></th>
<th><button class="btn btn-default" type="button" data-toggle="modal" onClick="openpopup('<?=base_url();?>report/Report/view_packing',1400,600,'ID',<?=$sales->qc_id;?>)" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button></th>
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