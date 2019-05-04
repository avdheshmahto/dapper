<?php
$this->load->view("header.php");	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_sales_order_hdr';

?>
	 <!-- Main content -->
	 <div class="main-content">
			
			<ol class="breadcrumb breadcrumb-2"> 
				
				<?php 
				if($add!='')
				{ ?>
				<li><a class="btn btn-success" href="<?=base_url();?>salesorder/SalesOrder/salesOrderNew">Add Sales Order</a></li> 
				<?php }?>
				 
			</ol>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Sales Order</a></li> 
				
				<li class="active"><strong><a href="#">Manage Sales Order</a></strong></li> 
			</ol>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Sales Order</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
<form method="post">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th>Sales Order No.</th>
	   <th>Sales Type</th>
		<th>Date</th>
        <th>Customer Name</th>
		<th style="display:none">Due Date</th>
      	<th>Grand Total</th>
		<th>Invoice Status</th>
         <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
	foreach($result as $sales)
  {
  ?>

<tr class="gradeC record">
<th><?php echo $sales->salesid;?></th>
<th><?php echo $sales->invoice_type;?></th>
<th><?php echo $sales->invoice_date;?></th>
<th><?php 
		$sqlgroup=$this->db->query("select * from tbl_contact_m where contact_id='$sales->vendor_id'");
		$res1 = $sqlgroup->row();
echo $res1->first_name;?></th>
<th style="display:none">
<?php 
$idt=$sales->invoice_date;
$date = new DateTime("$idt");
$fdate=$date->format("Y-m-d");
$dt=$sales->due_date;
echo $idate= date('Y-m-d', strtotime($fdate. " + $dt days"));

?>
</th>
<th><?=$sales->grand_total;?></th>
<th><?php 
		$sqlgroup=$this->db->query("select * from tbl_invoice_hdr where sales_id='$sales->salesid'");
		$res1 = $sqlgroup->row();
		$ttol=$res1->sales_id;
		if($ttol!=$sales->salesid){
			echo "NO";
		}else{
			echo "YES";
		}
?></th>
<th>
<a href="#" onClick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1400,600,'view',<?=$sales->salesid;?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>
<?php 
		if($ttol!=$sales->salesid){
?>
&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1400,600,'id',<?=$sales->salesid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='salesid';
$table_name='tbl_sales_order_hdr';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $sales->salesid."^".$table_name."^".$pri_col ; ?>" class="delbuttonSales icon"><i class="glyphicon glyphicon-remove"></i></a> 
<a onclick="return confirm('Are you sure you want to convert sales order in invoice?');" href="<?=base_url();?>invoice/invoice/edit_invoice_order?id=<?=$sales->salesid;?>" class="btn btn-success">Convert To Invoice</a>
<?php }else{?>
<a onclick="return confirm('This sales order is allready created an invoice?');" href="<?=base_url();?>invoice/invoice/manage_invoice" class="btn btn-success">Invoice Created</a>
<?php }?>
</th>
</tr>
<?php } ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>