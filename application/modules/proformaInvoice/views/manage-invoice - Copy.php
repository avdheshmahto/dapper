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
				<li><a style="display:none" class="btn btn-success" href="<?=base_url();?>invoice/invoice/add_invoice">Add Invoice</a></li> 
				<?php }?>
				 
			</ol>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Invoice</a></li> 
				
				<li class="active"><strong><a href="#">Manage Invoice</a></strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Manage Invoice</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th>Sales Order No.</th>
	   <th>Invoice Type</th>
		<th>Date</th>
        <th>Customer Name</th>
		<th>Due Date</th>
		<th>Status</th>
      	<th>Grand Total</th>
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
<th><?=$sales->invoiceid;?></th>
<th><?php echo $sales->invoice_status;?></th>
<th><?=$sales->invoice_date;?></th>
<th><?php 
		$sqlgroup=$this->db->query("select * from tbl_contact_m where contact_id='$sales->vendor_id'");
		$res1 = $sqlgroup->row();
		echo $res1->first_name;?></th>
<th>
<?php 
$idt=$sales->invoice_date;
$date = new DateTime("$idt");
$fdate=$date->format("Y-m-d");
$dt=$sales->due_date;
echo $idate= date('Y-m-d', strtotime($fdate. " + $dt days"));

?>
</th>

<th><?php 
$cdate = date("Y-m-d");
$idate= date('Y-m-d', strtotime($fdate. " + $dt days"));
$theRequestMadeDateTime = strtotime($idate);
$theCurrentDateTime = strtotime($cdate);
$theDifferenceInSeconds = 600 - ($theCurrentDateTime - $theRequestMadeDateTime);
$minutesLeft = (floor ($theDifferenceInSeconds / (60*60*24)));
if($cdate<$idate)
{
?>
<a href="<?=base_url();?>invoice/invoice/invoice_details?id=<?=$sales->invoiceid;?>&&contact_id=<?=$res1->contact_id;?>">
<samp style="color:#2c96dd">
<?php
echo $minutesLeft." days due";
?>
</samp>
</a>
<?php
}
else
{
?>
<a href="<?=base_url();?>invoice/invoice/invoice_details?id=<?=$sales->invoiceid;?>&&contact_id=<?=$res1->contact_id;?>">
<samp style="color:#ef6f08">
<?php
echo abs($minutesLeft)." days over due";
}
?>
</samp></a></th>
<th><?=$sales->grand_total;?></th>
<th>
<a href="#" onClick="openpopup('<?=base_url();?>invoice/invoice/edit_invoice_order_1',1400,600,'view',<?=$sales->invoiceid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>invoice/invoice/edit_invoice_order_1',1400,600,'id',<?=$sales->invoiceid;?>)"><i class="glyphicon glyphicon-pencil"></i></a>
&nbsp;&nbsp;&nbsp;
<?php
if($sales->invoice_status=='GST')
{
?>
<a href="<?=base_url();?>invoice/invoice/print_invoice?id=<?=$sales->invoiceid;?>" target="blank"><i class="glyphicon glyphicon-print"></i></a>
<?php } else {?>
<a href="<?=base_url();?>invoice/invoice/case_memo?id=<?=$sales->invoiceid;?>" target="blank"><i class="glyphicon glyphicon-print"></i>
<?php }?>
<?php
$pri_col='invoiceid';
$table_name='tbl_invoice_hdr';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $sales->invoiceid."^".$table_name."^".$pri_col ; ?>" class="delbuttonInvoice icon"><i class="glyphicon glyphicon-remove"></i></a> 

</th>
</tr>
<?php } ?>
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