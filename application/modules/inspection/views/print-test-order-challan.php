<?php
$hdrQuery=$this->db->query("select *from tbl_production_order_transfer_another_module where transfer_no='$id'");
$getHdr=$hdrQuery->row();
$vendorQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getHdr->vendor_id'");
$getVendor=$vendorQuery->row();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Dapper</title>
<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/challan_css/css/style.css' />
</head>
<body>
<div id="page-wrap">
<div style="clear:both"></div>
<table id="items">
<tr>
<th colspan="4"><center>Order test Order Challan</center></th>
</tr>

<tr>
<th>Tested Qty</th>
<th>Check Point	</th>
<th>Description</th>
</tr>
<?php 
$selectQuery=$this->db->query("select *from tbl_product_inspection");
$i=1;
foreach ($selectQuery->result() as  $dt) {
// product query
$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->product_id'");
$getProduct=$productQuery->row();
?>
<tr>
<td><?=$dt->qty;?></td>
<td>
<?=$dt->check_point;?>
</td>
<td>
<?=$dt->description;?>
</td>
</tr>
<?php 
$i++;
}
$a="test";
$b="safi";
echo $a+$b;
?>
</table>
</div>
</body>
</html>
