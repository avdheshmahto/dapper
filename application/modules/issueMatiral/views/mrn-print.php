<?php
$hdrQuery=$this->db->query("select *from tbl_inbound_hdr where inboundid='".$_GET['id']."'");
$getHdr=$hdrQuery->row();

$obj=new my_controller();
$CI =& get_instance();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>MRN</title>
	
	<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/mrn-print/css/style.css' />
</head>

<body>
<div id="page-wrap">
<div id="identity">
<div id="address"> <img id="image" src="<?=base_url();?>assets/images/logo.png" alt="logo" /></div>

<div class="header"><br />
<h2>GOODS RECEIVED NOTE</h2>
<h3>(PHYSICALLY RECD AT W/H)</h3>
</div>
		
</div>
		
		<div style="clear:both"></div>
		
<div id="customer">
<table id="meta">
<tr>
<td><strong>GRN Date</strong></td>
<td><?php echo $obj->explode_date($getHdr->grn_date);?></td>
</tr>




<tr>
<td><strong>GRN No. :</strong></td>
<td><?=$getHdr->grn_no;?></td>
</tr>

<?php
$poQuery=$this->db->query("select *from tbl_purchase_order_hdr where purchaseid='$getHdr->po_no'");
$getPONO=$poQuery->row();
?>


</table>



<table id="meta_left">
<tr>
<td width="84" valign="top"><strong>Address:</strong></td>
<td width="324">Flat No. 1, 101, Local Shopping Centre Ram Pratap House, Guru Ravidas Marg, Block K, Kalkaji,New Delhi, Delhi 110019</td>
</tr>

<tr>
<td width="84"><strong>Phone No:</strong></td>
<td width="324">011 4104 2424</td>
</tr>

<tr>
<td><strong>Website:</strong></td>
<td>www.dapperexports.com</td>
</tr>


</table>
		
	  </div>
		
<table id="items">
<tr>
<th>Sr. No.</th>

<th>DESCRIPTION</th>
<th>UOM</th>
<th>QTY</th>
</tr>
<?php
$dtlQuery=$this->db->query("select *from tbl_inbound_dtl where inboundrhdr='".$_GET['id']."'");
$i=1;
foreach($dtlQuery->result() as $getDtl)
{
	

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getDtl->productid'");
$getProduct=$productQuery->row();	


$productUnitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
$getProductUnit=$productUnitQuery->row();	

	
?>		  
<tr class="item-row">
<td><?=$i;?></td>
<td><?=$getProduct->productname;?></td>

<td><?=$getProductUnit->keyvalue;?></td>
<td><?=$getDtl->receive_qty;?></td>
</tr>
		  
<?php $i++;}?>





<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>
<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

<tr class="item-row">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>
</table>
</div>
</body>
</html>