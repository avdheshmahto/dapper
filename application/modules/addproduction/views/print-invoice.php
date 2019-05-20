<?php
$printQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$id'");
$getPrint=$printQuery->row();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Print</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/pi_css/css/style.css">
</head>
<body>
	<!-- main heading -->
	<h2>PROFORMA INVOICE</h2>
	<table class="table1" align="center">
		<!-- manufacturer -->
		<tr>
			<td rowspan="5">
				<h5>Manufacturer &amp; Explorer</h5>
				<h3>DAPPER EXPORTS PVT. LTD.</h3>
				<h4>
				B.O. : LAKRI FAZALPUR INDUSTRIAL AREA,<br>
				<span>MINI BYE PASS, DELHI ROAD, MORADABAD.</span><br>
				H.O. : F-35 BASEMENT, EAST OF KAILASH,<br>
				<span>NEW DELHI - 110 065. [INDIA]</span><br>
				</h4>
			</td>
		</tr>
		<tr>
			<th>Proforma#</th>
			<td colspan="2"><?=$getPrint->proforma_no;?> &nbsp;&nbsp;&nbsp;&nbsp;<span><strong>Date</strong><?=$getPrint->proforma_date;?></span></td>
		</tr>
		<tr>
			<th>BuyOrder#</th>
			<td><?=$getPrint->buyer_order;?> <span><strong>Date</strong> <?=$getPrint->buyer_date;?></span></td>
		</tr>
		<tr>
			<th>Ship Date</th>
			<td><?=$getPrint->ship_date;?> &nbsp; Ex-Factory</td>
		</tr>
		<tr>
			<th>Payment terms</th>
			<td><?=$getPrint->payment_term;?></td>
		</tr>
		<!-- buyer -->
		<tr>
			<td rowspan="6">
				<h5>Buyer</h5>
				<p>
				M/S. TERRYBEAR INC.,<br>
				946 W. PIERCE BUTLER ROUTE,SUITE 101,<br> 
				DOCKS 1-3, ST.PAUL, MN 55104, [USA]<br>
				TEL : 651-641-9579 FAX :  651-917-3560<br>
				<br><br><br>
				</p>
			</td>
		</tr>
		<tr>
			<th>Delivery Terms</th>
			<td><?=$getPrint->dilivery_term?></td>
		</tr>
		<tr>
			<th>Port of Loading</th>
			<td><?=$getPrint->dilivery_term?></td>
		</tr>
		<tr>
			<th>Port of Discharge</th>
			<td><?=$getPrint->dilivery_term?></td>
		</tr>
		<tr>
			<th>Partshipment</th>
			<td><?=$getPrint->partshipment?></td>
		</tr>
		<tr>
			<th>Forwarder</th>
			<td><?=$getPrint->forwarder?> </td>
		</tr>
		<!-- Cosignee -->
		<tr>
			<td rowspan="3">
				<h5>Consignee</h5>
				<p>
				M/S. TERRYBEAR INC.,<br>
				946 W. PIERCE BUTLER ROUTE,SUITE 101,<br> 
				DOCKS 1-3, ST.PAUL, MN 55104, [USA]<br>
				TEL : 651-641-9579 FAX :  651-917-3560<br>
				<br><br>
				</p>
			</td>
			<td rowspan="3" colspan="2">
				<h5>Our Bankers</h5>
				<p>
				KOTAK MAHINDRA BANK LTD.<br> 
				KALKAJI BRANCH, GROUND FLOOR, L-9,<br> 
				KALKAJI, NEW DELHI - 110019 , INDIA<br>
				A/C #  :  9612506573<br>
				IFSC CODE  :  KKBK0000218<br>
				SWIFT CODE :  KKBKINBBXXX<br>
				</p>
			</td>
		</tr>
	</table>
	<table class="table2" align="center">
		<tr>
			<th>Item No.</th>
			<th>Buyer No.</th>
			<th>Description</th>
			<th>Order Qty</th>
			<th>Price US $</th>
			<th>Amount</th>
		</tr>
        
       <?php
	   $dtlQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='$getPrint->purchaseid'");
	   foreach($dtlQuery->result() as $getDtl){
		   
		   $productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getDtl->productid'");
		   $getProduct=$productQuery->row();
	   
	   ?> 
		<tr>
			<td><?=$getProduct->sku_no;?></td>
			<td></td>
			<td><p><?=$getProduct->productname;?><br>
				<strong>Packing:</strong>&nbsp;<?=$getDtl->per_crt_qn;?>/<?=$getDtl->ord_qty;?> <span><strong>T.CBM:</strong><?=$getProduct->cbm;?></span>
				</p>
			</td>
			<td class="right"><?=$getDtl->qty;?> PC</td>
			<td class="right"><?=$getDtl->price;?></td>
			<td class="right"><?=$getDtl->net_price;?></td>
		</tr>
		
		<?php }?>
	</table>
	<div class="sign">
		<h5>Amount in Figure</h5>
		<h4>Continued on Page 2</h4>
		<div class="auth">
			<p>Signature &amp; date</p>
			<h5>FOR DAPPER EXPORTS PVT. LTD.</h5>
			<h6>AUTH. SIGN.</h6>
		</div>
	</div>
</body>
</html>
