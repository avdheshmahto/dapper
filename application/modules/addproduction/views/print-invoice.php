<?php
$printQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$id'");
$getPrint=$printQuery->row();
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getPrint->contactid'");
$getContact=$contactQuery->row();

function words_repues($num)
{ 

	$numberF=$num;
	$action34=explode(".",$numberF);
	$balance10=$action34[0];
	$balance11=$action34[1];
	$no = $balance10;
	$point = $balance11;
	$hundred = null;
	$digits_1 = strlen($no);
	$i = 0;
	$str = array();
	$words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	while ($i < $digits_1) {
    	$divider = ($i == 2) ? 10 : 100;
    	$number = floor($no % $divider);
    	$no = floor($no / $divider);
    	$i += ($divider == 10) ? 1 : 2;
    if ($number) {
    	$plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
        " " . $digits[$counter] . $plural . " " . $hundred
        :
        $words[floor($number / 10) * 10]
        . " " . $words[$number % 10] . " "
        . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
	$str = array_reverse($str);
	$result = implode('', $str);
	$points = ($point) ?
	" " . $words[$point / 10] . " " . 
	$words[$point = $point % 10] : '';
	strtoupper($result . "Rupees " . $points . " Paise");
	$grandexplode=number_format((float)$num, 2, '.', '');
	$action23=explode(".",$grandexplode);
	$groundA=$action23[0];
	$groundV=$action23[1];	
	if($groundV >=1 ){
		$goundStr=strtoupper($result . " and" . $points . " ");
	}else{
		$goundStr=strtoupper($result . "");
	}	
	 return $goundStr;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>PROFORMA INVOICE</title>
<link rel="stylesheet" href="<?=base_url();?>assets/pi_css/css/style.css">
</head>
<body>

<div class="page03">
<h2>PROFORMA INVOICE</h2>

<table class="table1" align="center">
<tr>
<td rowspan="5">
<h5>Manufacturer &amp; Explorer</h5>
<h3>DAPPER EXPORTS PVT. LTD.</h3>
<h4>
LAKRI FAZALPUR INDUSTRIAL AREA,<br>
MINI BYE PASS, DELHI ROAD,<br> MORADABAD,244001(India)<br>

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
</tr><table class="table2" align="center">
<!-- DESCRIPTION -->
<tr>
<th>Item No.</th>
<th>Buyer No.</th>
<th>Description</th>
<th>Order Qty</th>
<th>Price US $</th>
<th>Amount $</th>
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
<strong>Packing:</strong>&nbsp;<?=$getProduct->packing;?>/<?=$getDtl->ord_qty;?></span><span><strong>T.CBM:</strong><?php echo round($getProduct->cbm*$getDtl->ord_qty,3);?></span>
</p>
</td>
<td class="right"><?=$getDtl->qty;?> <?=$getUnit->keyvalue;?></td>
<td class="right">$<?=$getDtl->price;?></td>
<td class="right">$<?php echo $getDtl->price*$getDtl->qty;?></td>
</tr>
<?php
$totalQty=$totalQty+$getDtl->qty;
$price=$price+$getDtl->price;
$Totalprice=$Totalprice+$getDtl->price*$getDtl->qty;
$totalCbm=$totalCbm+$getProduct->cbm;
$totalNetWeight=$totalNetWeight+$getProduct->net_weight*$getDtl->qty;
$Totalpacking=$Totalpacking+$getDtl->ord_qty;
$TotalGrossWeight=($getProduct->weight*$getProduct->packing)+5;
$finalGrossWeight=$TotalGrossWeight*$getDtl->ord_qty;


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
<li>US $<?=$price;?></li>
<li>US $<?=$Totalprice;?></li>
</ul>
<h4 class="dollar">US. Dollars <?php echo  words_repues(number_format((float)$getDtl->price*$getDtl->qty, 2, '.', '')); ?></h4>
<ol class="total">
<li>TOTAL QTY : <?=$totalQty;?> Pcs.</li>
<li>TOTAL CARTONS : <?=$Totalpacking;?></li>
<li>TOTAL NET WT. : <?=$totalNetWeight;?> KGS.</li>
<li>TOTAL GROSS WT. : <?=$finalGrossWeight?> KGS.</li>
<li>TOTAL CBM : <?php echo round($totalCbm*$getDtl->ord_qty,3);?> CBM</li>
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
