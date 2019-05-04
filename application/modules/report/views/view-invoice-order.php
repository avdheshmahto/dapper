<?php
$this->load->view("header.php");
$id=$_GET['id'];

if($_GET['id']!='' or $_GET['view']!=''){
	$query=$this->db->query("select * from tbl_proforma_invoice_hdr where invoiceid='$id' or invoiceid='".$_GET['view']."'");	
	$fetchq=$query->row();
}

?>
<form id="f1" name="f1" method="POST" action="updateInvoice" onSubmit="return checkKeyPressed(a)">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong><center>Proforma Invoice</center></strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
<div class="panel-body">


<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:11%;"><div align="center"><u>Item</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rate</u></div></td>
<td style="width:3%;"><div align="center"><u>Quantity</u></div></td>
<td style="width:3%;"> <div align="center"><u>Dis.%</u></div></td>
<td style="width:3%;"> <div align="center"><u>Discount Amt</u></div></td>
<td style="width:3%;"> <div align="center"><u>CGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>SGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>IGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>GST TOTAL</u></div></td>


<td style="width:3%;"> <div align="center"><u>Total</u></div></td>
<td style="width:3%;"> <div align="center"><u>Net Price</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_proforma_invoice_dtl where invoiceid='".$_GET['id']."' or invoiceid='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->productid'");
$getProductName=$productQuery->row();

?>
<tr>
<td align="center" style="width: 0.2%;"><?php echo $z;?></td>

<td align="center" style="width: 11%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName->productname;?>^<?php echo $invoiceFetch->productid;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">
<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch->productid;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"><input type="hidden" value="Box" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">
<input type="text" name="list_price[]" id="lph<?php echo $z;?>" value="<?php echo $invoiceFetch->list_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="qty[]" id="qnty<?php echo $z;?>" value="<?php echo $invoiceFetch->qty;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="discount[]" id="dis<?php echo $z;?>" value="<?php echo $invoiceFetch->discount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;"><input type="text" name="disAmount[]" id="disAmount<?php echo $z;?>" value="<?php echo $invoiceFetch->discount_amount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>


<td align="center" style="width: 3%;"><input type="text" name="cgst[]" id="cgst<?php echo $z;?>" value="<?php echo $invoiceFetch->cgst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="sgst[]" id="sgst<?php echo $z;?>" value="<?php echo $invoiceFetch->sgst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="igst[]" id="igst<?php echo $z;?>" value="<?php echo $invoiceFetch->igst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="gstTotal[]" id="gstTotal<?php echo $z;?>" value="<?php echo $invoiceFetch->gstTotal;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">
<input type="text" name="tot[]" id="tot<?php echo $z;?>" value="<?php echo $invoiceFetch->total_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">

</td>

<td align="center" style="width: 3%;">

<input type="text" name="nettot[]" id="nettot<?php echo $z;?>" value="<?php echo $invoiceFetch->net_price;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">




<img src="<?php echo base_url();?>assets/images/delete.png" border="0" name="dlt" id="dlt<?php echo $z;?>" onclick="deleteselectrow(this.id,this);"  readonly style="width:auto; height:auto; border: hidden;"><img src="<?php echo base_url();?>assets/images/edit.png" border="0" name="ed" id="ed<?php echo $z;?>" onclick="editselectrow(this.id,this);" style="width:auto; height:auto; border: hidden;"></td>
</tr>
<?php $row=$z; $z++;  } ?>

</table>



</div>


</div>

<input type="hidden" name="rows" id="rows" value="<?php echo $row;?>">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />


</div>
</div>
</div>
</div>

</form>


<?php

///////////////////////////////Invoice Start////////////////////////



//$id=$_GET['id'];

if($_GET['id']!='' or $_GET['view']!=''){
	$query1=$this->db->query("select * from tbl_invoice_hdr where invoiceid='$id' or invoiceid='".$_GET['view']."'");	
	$fetchq1=$query1->row();
}

?>
<form id="f1" name="f1" method="POST" action="updateInvoice" onSubmit="return checkKeyPressed(a)">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Invoice</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
<div class="panel-body">

<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:11%;"><div align="center"><u>Item</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rate</u></div></td>
<td style="width:3%;"><div align="center"><u>Quantity</u></div></td>
<td style="width:3%;"> <div align="center"><u>Dis.%</u></div></td>
<td style="width:3%;"> <div align="center"><u>Discount Amt</u></div></td>
<td style="width:3%;"> <div align="center"><u>CGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>SGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>IGST</u></div></td>
<td style="width:3%;"> <div align="center"><u>GST TOTAL</u></div></td>


<td style="width:3%;"> <div align="center"><u>Total</u></div></td>
<td style="width:3%;"> <div align="center"><u>Net Price</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
<?php
$z=1;
$query_dtl2=$this->db->query("select * from tbl_invoice_dtl where invoiceid='".$_GET['id']."' or invoiceid='".$_GET['view']."' ");
foreach($query_dtl2->result() as $invoiceFetch2)
{

$productQuery2=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch2->productid'");
$getProductName2=$productQuery2->row();

?>
<tr>
<td align="center" style="width: 0.2%;"><?php echo $z;?></td>

<td align="center" style="width: 11%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName2->productname;?>^<?php echo $invoiceFetch2->productid;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">
<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch2->productid;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"><input type="hidden" value="Box" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">
<input type="text" name="list_price[]" id="lph<?php echo $z;?>" value="<?php echo $invoiceFetch2->list_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="qty[]" id="qnty<?php echo $z;?>" value="<?php echo $invoiceFetch2->qty;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="discount[]" id="dis<?php echo $z;?>" value="<?php echo $invoiceFetch2->discount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;"><input type="text" name="disAmount[]" id="disAmount<?php echo $z;?>" value="<?php echo $invoiceFetch2->discount_amount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>


<td align="center" style="width: 3%;"><input type="text" name="cgst[]" id="cgst<?php echo $z;?>" value="<?php echo $invoiceFetch2->cgst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="sgst[]" id="sgst<?php echo $z;?>" value="<?php echo $invoiceFetch2->sgst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="igst[]" id="igst<?php echo $z;?>" value="<?php echo $invoiceFetch2->igst;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;"><input type="text" name="gstTotal[]" id="gstTotal<?php echo $z;?>" value="<?php echo $invoiceFetch2->gstTotal;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">
<input type="text" name="tot[]" id="tot<?php echo $z;?>" value="<?php echo $invoiceFetch2->total_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">

</td>

<td align="center" style="width: 3%;">

<input type="text" name="nettot[]" id="nettot<?php echo $z;?>" value="<?php echo $invoiceFetch2->net_price;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">




<img src="<?php echo base_url();?>assets/images/delete.png" border="0" name="dlt" id="dlt<?php echo $z;?>" onclick="deleteselectrow(this.id,this);"  readonly style="width:auto; height:auto; border: hidden;"><img src="<?php echo base_url();?>assets/images/edit.png" border="0" name="ed" id="ed<?php echo $z;?>" onclick="editselectrow(this.id,this);" style="width:auto; height:auto; border: hidden;"></td>
</tr>
<?php $row=$z; $z++;  } ?>

</table>

</div>
</div>

<input type="hidden" name="rows" id="rows" value="<?php echo $row;?>">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />
<br />

<center>
	<a onclick="popupclose(this.value)" class="btn btn-secondary btn-sm">Cancel</a></th></th>
</center>
<br />

</div>
</div>
</div>
</div>

</form>



<?php
$this->load->view("footer.php");
?>