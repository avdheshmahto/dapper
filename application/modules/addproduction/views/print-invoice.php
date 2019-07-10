<?php
$printQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$id'");
$getPrint=$printQuery->row();


$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getPrint->contactid'");
$getContact=$contactQuery->row();


?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFORMA INVOICE</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/pi_css/css/style.css">
</head>
<body>
	<!-- PAGE 01 -->
	<div class="page01">
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
			<td><?=$getPrint->ship_date;?> &nbsp; </td>
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
				<?=$getContact->first_name;?>,<br>
				946 W. PIERCE BUTLER ROUTE,SUITE 101,<br> 
				DOCKS 1-3, ST.PAUL, MN 55104, [USA]<br>
				TEL : 651-641-9579 FAX :  651-917-3560<br>
				<br><br><br>
				</p>
			</td>
		</tr>
		<tr>
			<th>Delivery Terms</th>
			<td><?=$getPrint->dilivery_term;?></td>
		</tr>
		<tr>
        
        <?php
		$portOfLoading=$this->db->query("select *from tbl_master_data where serial_number='$getPrint->port_loading'");
		$getPortOfLoading=$portOfLoading->row();
		
		?>
			<th>Port of Loading</th>
			<td><?=$getPortOfLoading->keyvalue;?></td>
		</tr>
		<tr>
         <?php
		$portOfDischarge=$this->db->query("select *from tbl_master_data where serial_number='$getPrint->port_loading'");
		$getPortOfDischarge=$portOfDischarge->row();
		
		?>
			<th>Port of Discharge</th>
			<td><?=$getPortOfDischarge->keyvalue;?></td>
		</tr>
		<tr>
			<th>Partshipment</th>
			<td><?=$getPrint->partshipment;?></td>
		</tr>
		<tr>
			<th>Forwarder</th>
			<td><?=$getPrint->forwarder;?> </td>
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
		<table class="table2" align="center">
			<!-- DESCRIPTION -->
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


	$usagesQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
	$getUnit=$usagesQuery->row();

?>
			<tr>
				<td><?=$getProduct->sku_no;?></td>
				<td></td>
				<td><p><?=$getProduct->productname;?><br>
					<strong>Packing:</strong>&nbsp;<?=$getProduct->packing;?>/<?=$getDtl->ord_qty;?> <span><strong>T.CBM:</strong><?=$getProduct->cbm;?></span>
					</p>
				</td>
				<td class="right"><?=$getDtl->qty;?> <?=$getUnit->keyvalue;?></td>
				<td class="right"><?=$getDtl->price;?></td>
				<td class="right"><?php echo $getDtl->price*$getDtl->qty;?></td>
			</tr>
<?php }?>
			<tr>
				<td rowspan="3" class="space"></td>
				<td rowspan="3" class="space"></td>
				<td rowspan="3" class="space"></td>
				<td rowspan="3" class="space"></td>
				<td rowspan="3" class="space"></td>
				<td rowspan="3" class="space"></td>
			</tr>
		</table>
		<table class="table3">
			<tr>
				<td rowspan="6" colspan="6">
					<h5>Amount in Figure</h5>
					<h4>Continued on Page 2</h4>
					<div class="signature">
						<p>Signature &amp; Date</p>
						<ol>
							<li>FOR DAPPER EXPOSRTS PVT. LTD.</li>
							<li>AUTH. SIGN.</li>
						</ol>
					</div>
				</td>
			</tr>
		</table>
	</table>
	</div>
	<!-- PAGE 02 -->
	
	<!-- PAGE 03 -->
	<div class="page03">
	<h2>PROFORMA INVOICE</h2>
	<p class="page-no">Page: 2</p>
	<table class="table6" align="center">
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
			<td colspan="2">TB570 &nbsp;&nbsp;&nbsp;&nbsp;<span><strong>Date</strong>03/04/2019</span></td>
		</tr>
		<tr>
			<th>BuyOrder#</th>
			<td>0001511 <span><strong>Date</strong> 02/04/2019</span></td>
		</tr>
		<tr>
			<th>Ship Date</th>
			<td>30/06/2019 &nbsp; Ex-Factory</td>
		</tr>
		<tr>
			<th>Payment terms</th>
			<td>DP</td>
		</tr>
		<table class="table2" align="center">
		<!-- DESCRIPTION -->
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


	$usagesQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
	$getUnit=$usagesQuery->row();

?>
		
		<tr>
			<td><?=$getProduct->sku_no;?></td>
			<td></td>
			<td><p><?=$getProduct->productname;?><br>
				<strong>Packing:</strong>&nbsp;<?=$getProduct->packing;?>/<?=$getDtl->ord_qty;?></span>
				</p>
			</td>
			<td class="right"><?=$getDtl->qty;?> <?=$getUnit->keyvalue;?></td>
			<td class="right"><?=$getDtl->price;?></td>
			<td class="right"><?php echo $getDtl->price*$getDtl->qty;?></td>
		</tr>
		<?php
		$totalQty=$totalQty+$getDtl->qty;
		$price=$price+$getDtl->price;
		$Totalprice=$Totalprice+$getDtl->price*$getDtl->qty;
		
		 }?>
		
		<tr>
			<td rowspan="3" class="space"></td>
			<td rowspan="3" class="space"></td>
			<td rowspan="3" class="space"></td>
			<td rowspan="3" class="space"></td>
			<td rowspan="3" class="space"></td>
			<td rowspan="3" class="space"></td>
		</tr>
		</table>
		<table class="table3">
			<tr>
				<td rowspan="6" colspan="3">
					<h5>Amount in Figure</h5>
					<ul>
						<li>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$totalQty;?></li>
						<li>US <?=$price;?></li>
						<li><?=$Totalprice;?></li>
					</ul>
					<h4 class="dollar">US. Dollars One Lakh Sixty Nine Thousand Three Hundred Forty  And  Cents Twelve Only</h4>
					<ol class="total">
						<li>TOTAL QTY : 11608 Pcs.</li>
						<li>TOTAL CARTONS : 796</li>
						<li>CARTONS TOTAL NET WT. : 9541.040 KGS.</li>
						<li>TOTAL GROSS WT. : 13000.000 KGS.</li>
						<li>TOTAL CBM : 70.209 CBM</li>
					</ol>
					<span>Please send us a copy of Proforma Invoice duly signed and stamped.</span>
					<div class="signature1">
						<p>Signature &amp; Date</p>
						<ol>
							<li>FOR DAPPER EXPOSRTS PVT. LTD.</li>
							<li>AUTH. SIGN.</li>
						</ol>
					</div>
				</td>
			</tr>
		</table>
	</table>
	</div>
</body>
</html>
