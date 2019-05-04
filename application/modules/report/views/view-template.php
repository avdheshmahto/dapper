<?php
$this->load->view("header.php");
$id=$_GET['id'];


	$query=$this->db->query("select * from tbl_template_hdr where templateid='$id'");	
	$fetchq=$query->row();

?>
<form >
<!-- Main content -->
	<div class="main-content">		
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>View Template</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
<div class="panel-body">

<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:9%;"><div align="center"><u>Item</u></div></td>

<td style="width:3%; display:none;"> <div align="center"><u>Rate</u></div></td>

<td style="width:3%;"><div align="center"><u>Type</u></div></td>
<td style="width:3%;"><div align="center"><u>Uses %</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_template_dtl where templatehdr='".$_GET['id']."' or templatehdr='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");
$getProductName=$productQuery->row();

$typeQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductName->type'");
$gettype=$typeQuery->row();


?>
<tr>
<td align="center" style="width: 1%;"><?php echo $z;?></td>

<td align="center" style="width: 9%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName->productname;?>^<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">
<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"><input type="hidden" value="Box" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%; display:none;">
<input type="text" name="list_price[]" id="lph<?php echo $z;?>" value="<?php echo $invoiceFetch->list_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;"></td>

<td align="center" style="width: 3%;"><input type="text" name="typ[]" id="typ<?php echo $z;?>" value="<?php echo $gettype->keyvalue;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>

<td align="center" style="width: 3%;"><input type="text" name="perct[]" id="perct<?php echo $z;?>" value="<?php echo $invoiceFetch->uses_percent;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>


</tr>
<?php $row=$z; $z++;  } ?>

</table>



</div>
</div>

</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th><a onclick="popupclose(this.value)" class="btn btn-secondary  btn-sm">Cancel</a></th>
</tr>
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</form>
<?php
$this->load->view("footer.php");
?>