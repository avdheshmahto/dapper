<?php
$id=$_GET['id'];
if($id!="")
{
$invice12=$this->db->query("select * from tbl_proforma_invoice_hdr where invoiceid='$id'");
$inviceres=$invice12->row();


$baseStateNameQuery=$this->db->query("select * from tbl_state_m where code='$inviceres->state_id'");
$getBaseStateCode=$baseStateNameQuery->row();




$fetchrecord=$this->db->query("select * from tbl_contact_m where contact_id='".$inviceres->vendor_id."'");
$fetchrecords=$fetchrecord->row();
 
$fetchcomp=$this->db->query("select * from tbl_contact_m where contact_id='".$inviceres->vendor_id."'");
$fetchcompany=$fetchcomp->row(); 
  
$queryStateN=$this->db->query("select * from tbl_state_m where code='".$fetchcompany->state_id."'");
$fetchStateN=$queryStateN->row();


function tax($tax_retail){
if($tax_retail=='retail_invoice') {  $tax="Retail Invoice";  }
if($tax_retail=='tax_invoice') {  $tax="Tax Invoice";  }
if($tax_retail=='normal_invoice') {  $tax="Normal Invoice";  }
if($tax_retail=='performa_invoice') {  $tax="Performa Invoice";  }
if($tax_retail=='delivery_invoice') {  $tax="Delivery Invoice";  }
if($tax_retail=='sale_invoice') {  $tax="Sale Invoice";  }
return $tax;
}


function getSingleResult($sql){
 	$ci =& get_instance();
	$class = $ci->db->query($sql);
    $class = $class->result_array();
    $ac =$class->keyvalue;
	return $ac;
}



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
	$goundStr=strtoupper($result . "Rupees and" . $points . " Paise");
			
	}else{
		  $goundStr=strtoupper($result . "Rupees");
	}	
	 return $goundStr;
	}
}

?>  



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Invoice</title>

<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/inv_css/css/style.css' />
<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/inv_css/css/print.css' media="print" />
<script type='text/javascript' src='<?=base_url();?>assets/inv_css/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='<?=base_url();?>assets/inv_css/js/example.js'></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></head>

<body>

<div id="page-wrap">

<table id="items">
<tbody><tr>
<td colspan="2" class="blank" align="center">
<img src="<?=base_url();?>assets/inv_css/images/2805747.png" style="height:90px;" alt=""></td>
<td colspan="16" align="center" class="blank">
 <h1>Shashi India Private Limited</h1> 
 <h3>AN ISO 9001-2008 Company</h3>
 <h2>Manufacturers, Traders and Exporters an extensive array <br> of Knitted Hand Gloves, Glove Knitting Machines, Colored Glitter. </h2> 
  <h3>Head Office- E-208, Flatted Factory Complex Okhla,  <br>
    Phase III, Delhi - 110020, India  </h3></td>
</tr>

<tr class="tr-t">
<td colspan="12" class="td-r"><h2>Proforma Invoice</h2></td>
<td colspan="6"><strong>Original for Receipient</strong></td>
</tr>




<tr class="tr-t">
  <td colspan="8">&nbsp;</td>
  <td colspan="3" class="td-l"><strong>Dispatch Through:</strong></td>
  <td colspan="7"><?=$inviceres->Transportation;?></td>
  </tr>

<tr>
<td colspan="3"><strong>Invoice Number :</strong></td>
<td colspan="4"><?=$inviceres->invoice_no;?></td>
<td width="52">&nbsp;</td>
<td colspan="3" class="td-l"><strong>Vehicle Number :</strong></td>
<td colspan="7"><?=$inviceres->Vehicle_Number;?></td>
</tr>

<tr>
<td colspan="3"><strong>Invoice Date:</strong></td>
<td colspan="4"><?php $date_in=explode("-",$inviceres->maker_date); 
  $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?></td>
<td>&nbsp;</td>
<td colspan="3" class="td-l"><strong>Date of Supply :</strong></td>
<td colspan="7"><?=$inviceres->Date_of_Supply;?></td>
</tr>

<tr>
<td colspan="2"><strong>No. Of Bags:</strong></td>
<td width="200" colspan="1">&nbsp;</td>
<td colspan="4"><strong><?=$inviceres->no_of_begs;?></strong></td>
<td class="td-rl tr-t-" style="border-left:none;">&nbsp;</td>
<td colspan="3"><strong>Place of Supply :</strong></td>
<td colspan="7"><?=$inviceres->Place_of_Supply;?></td>
</tr>
<tr>
<td colspan="3"><strong>Weight:</strong></td>
<td colspan="5" class="td-rl" style="border-left:none;"><strong><?=$inviceres->weight;?></strong></td>
<td colspan="3"><strong>Store Number  :</strong></td>
<td colspan="7"><?=$inviceres->store_no;?></td>
</tr>
<tr>
<td colspan="3"><strong>Dispatch Document No.:</strong></td>
<td colspan="5" class="td-rl" style="border-left:none;"><strong><?=$inviceres->dispatch_document_no;?></strong></td>
<td colspan="3"><strong>PO Number :</strong></td>
<td colspan="7"><?=$inviceres->po_no;?></td>
</tr>
<tr>
<td colspan="3"><strong>Dispatch Document Date:</strong></td>
<td colspan="5" class="td-rl" style="border-left:none;"><strong><?=$inviceres->dispatch_document_date;?></strong></td>
<td colspan="3"><strong>PO Date :</strong></td>
<td colspan="7"><?=$inviceres->po_date;?></td>
</tr>

<tr>
<td colspan="3"><strong>Payment Term :</strong></td>
<td colspan="5" class="td-rl" style="border-left:none;"><?=$inviceres->due_date;?></td>
<td colspan="3"><strong>Eway Bill Number :</strong></td>
<td colspan="7"><?=$inviceres->eway_bill_no;?></td>
</tr>
<tr>
<td colspan="3"><strong>Remarks:</strong></td>
<td colspan="5" class="td-rl" style="border-left:none;"><strong><?=$inviceres->remarks;?></strong></td>
<td colspan="3"><strong>Eway Bill Date :</strong></td>
<td colspan="7"><?=$inviceres->eway_bill_date;?></td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
<td colspan="5" class="td-rl" style="border-left:none;">&nbsp;</td>
<td colspan="3">&nbsp;</td>
<td colspan="2">&nbsp;</td>
<td width="79">&nbsp;</td>
<td colspan="4">&nbsp;</td>
</tr>

<tr>
<td colspan="18" class="tr-t tr-b">&nbsp;</td>
</tr>

<tr id="bg" class="tr-b">
<td colspan="8"><strong>Bill To</strong></td>
<td colspan="10"><strong>Bill From</strong></td>
</tr>

<tr>
<td width="60" class="td-r"><strong>Name:</strong></td>
<td colspan="7"><?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?></td>
<td width="67" class="td-rl"><strong>Company Name:</strong></td>
<td colspan="9">Shashi India Private Limited</td>
</tr>

<tr>
<td class="td-r"><strong>Address:</strong></td>
<td colspan="7"><?php  
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?></td>

<td class="td-rl"><strong>Address:</strong></td>
<td colspan="9">
<?php
if($inviceres->state_id=='24')
{
?>

GODOWN-7,Block B,Golden enclave,village-vithalapur,mandal,Ahmdabad,Gujrat,382120.
<?php }
if($inviceres->state_id=='07')
{
?>
E-208, FLATTED FACTORY COMPLEX, OKHLA, PHASE-III,South East Delhi, Delhi, 110020.
<?php }
if($inviceres->state_id=='06'){
?>
6, HSIIDC, GROUND FLOOR, Sonipat, Haryana, 131029
<?php } if($inviceres->state_id=='08'){?>

SHOP NO. 11, MALLO COMPLEX, HERO CHOWK NH8,

<?php }
if($inviceres->state_id=='29'){
?>
GROUND FLOOR, 137, VINOD COMPLEX, NARASAPURA,INDUSTRIAL AREA, ACHATANAHALLI VILLAGE, Kolar,


<?php }
if($inviceres->state_id=='09'){

?>
KHASRA NO. 520, VILLAGE ACHHRONDA, MEERUT,Meerut, Uttar Pradesh, 250103


<?php
}
?>

</td>
</tr>

<tr>
<td class="td-r"><strong>GSTIN:</strong></td>
<td colspan="7"><?php echo $fetchrecords->gst;?></td>
<td class="td-rl"><strong>GSTIN:</strong></td>
<td colspan="9">
<?php
if($inviceres->state_id=='24')
{
?>

24AABCS7624L1Z6
<?php }
if($inviceres->state_id=='07')
{

?>
07AABCS7624L1Z2
<?php }
if($inviceres->state_id=='06'){
?>
06AABCS7624L1Z4
<?php }
if($inviceres->state_id=='08'){
?>
08AABCS7624L1Z0
<?php }
if($inviceres->state_id=='29'){
?>
29AABCS7624L1ZW
<?php }?>

<?php
if($inviceres->state_id=='09'){
?>
09AABCS7624L1ZY
<?php }?>
</td>
</tr>
<tr>
<td class="td-r"><strong>Vendor Code:</strong></td>
<td colspan="7">&nbsp;</td>
<td class="td-rl">&nbsp;</td>
<td colspan="9">&nbsp;</td>
</tr>

<?php

$stateQuery=$this->db->query("select *from tbl_state_m where stateid='$fetchrecords->state_id' ");
$getState=$stateQuery->row();
?>
<tr>
<td class="td-r"><strong>State:</strong></td>
<td colspan="3"><?=$fetchStateN->stateName;?></td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td class="td-rl tr-t"><?php echo $fetchStateN->code;?></td>
<td class="td-rl"><strong>State:</strong></td>
<td colspan="3"><?=$getBaseStateCode->stateName;?></td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td colspan="3" class="tr-t"><?=$inviceres->state_id?></td>
</tr>


<tr id="bg" class="tr-t tr-b">
<td rowspan="2" class="td-rl"><strong>Sr.No.</strong></td>
<td width="162" rowspan="2" class="td-rl"><strong>Item Code</strong></td>
<td rowspan="2" class="td-rl" style="width:200px;"><strong>Product/Description</strong></td>
<td width="45" rowspan="2" class="td-rl"><strong>HSN CODE</strong></td>
<td width="39" rowspan="2" class="td-rl"><strong>UOM</strong></td>
<td width="25" rowspan="2" class="td-rl"><strong>Qty</strong></td>
<td width="33" rowspan="2" class="td-rl"><strong>Rate</strong></td>
<td rowspan="2" class="td-rl"><strong>Amount</strong></td>
<td rowspan="2" class="td-rl"><strong>Disc</strong></td>
<td width="97" rowspan="2" class="td-rl"><strong>Taxable Value</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>CGST</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>SGST</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>IGST</strong></td>
<td width="58" rowspan="2" class="td-rl" ><strong>Total</strong></td>
</tr>

<tr>
<td width="51" class="tr-b" id="bg"><strong>Rate</strong></td>
<td width="79" class="tr-b" id="bg"><strong>Amount</strong></td>
<td width="51" class="tr-b" id="bg"><strong>Rate</strong></td>
<td id="bg" class="tr-b"><strong>Amount</strong></td>
<td width="51" class="tr-b" id="bg"><strong>Rate</strong></td>
<td width="79" class="tr-b" id="bg"><strong>Amount</strong></td>
</tr>
 <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_proforma_invoice_dtl where invoiceid='$id'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->productid'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();


?>
<tr class="th-border">
<td valign="top" class="td-rl"><?=$n;?></td>
<td valign="top" class="td-rl"><?=$pfetch->sku_no;?></td>
<td valign="top" class="td-rl"><?php
echo $pfetch->productname;
?></td>
<td align="center" valign="top" class="td-rl"><?php
echo $pfetch->hsn_code;
?></td>
<td valign="top" class="td-rl"><?=$pfetch1->keyvalue;?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->qty;?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->list_price;?></td>
<td valign="top" class="td-rl"><?php echo number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '');  ?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->discount_amount;?></td>
<td valign="top" class="td-rl"><?php echo number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '')-$invoiceFetch->discount_amount;?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->cgst;?>%</td>
<td valign="top" class="td-rl"><?php   if($invoiceFetch->cgst!=''){ echo $invoiceFetch->gstTotal/2; }?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->sgst;?>%</td>
<td valign="top" class="td-rl"><?php if($invoiceFetch->sgst!=''){  echo $invoiceFetch->gstTotal/2; }?></td>
<td valign="top" class="td-rl"><?php echo  $invoiceFetch->igst;?>%</td>
<td valign="top" class="td-rl"><?php if($invoiceFetch->igst!=''){  echo number_format($invoiceFetch->gstTotal,2, '.', '');}?></td>
<td valign="top" class="td-rl"><?php echo number_format( $invoiceFetch->net_price,2, '.', ''); ?></td>
</tr>

<?php
$listPrice=$listPrice+number_format( $invoiceFetch->net_price,2, '.', '');
$taxableVal=$taxableVal+number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '')-$invoiceFetch->discount_amount;
$total=$total+number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '');
$totQty=$totQty+$invoiceFetch->qty;
//$n++;

?>
<?php
$n++;
}
?>









<tr class="tr-t tr-b">
<td colspan="5" align="right"><strong>Total</strong></td>
<td class="td-rl"><strong><?=$totQty;?></strong></td>
<td>&nbsp;</td>
<td class="td-rl"><strong><?=$total;?></strong></td>
<td>&nbsp;</td>
<td class="td-rl"><strong><?=$taxableVal;?></strong></td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td class="td-rl"><strong><?=$listPrice;?></strong></td>
</tr>

<tr>
<td colspan="9" rowspan="4" class="td-r tr-b">
<p>Total Gst Amount in Words: <?php echo  words_repues(number_format((float)$inviceres->total_gst_tax_amt, 2, '.', '')); ?></p>
<p>Total Invoice In Words: <?php echo  words_repues(number_format((float)$inviceres->grand_total, 2, '.', '')); ?></p>  </td>
<td colspan="5" class="tr-b"><strong>Total Amount Before Tax:</strong></td>
<td colspan="4" align="right" class="tr-b td-l"><strong><?=$total;?></strong></td>
</tr>

<tr>
<td colspan="5" class="tr-b">Add: CGST</td>
<td colspan="4" align="right" class="tr-b td-l"><strong><?php echo number_format((float)$inviceres->total_tax_cgst_amt, 2, '.', '')?></strong></td>
</tr>

<tr>
<td colspan="5"  class="tr-b">Add: SGST</td>
<td colspan="4" align="right" class="tr-b td-l"><strong><?php  echo number_format((float)$inviceres->total_tax_sgst_amt, 2, '.', '')?></strong></td>
</tr>



<tr>
<td colspan="5" class="tr-b">Add:IGST</td>
<td colspan="4" align="right" class="tr-b td-l"><strong><?php echo number_format((float)$inviceres->total_tax_igst_amt, 2, '.', '')?></strong></td>
</tr>

<tr style="border-right:1px solid;">
<td colspan="9" rowspan="4" valign="top" style="border-right: 1px solid;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="31%"><strong>Our Bank : </strong></td>
    <td width="69%"><strong>Central Bank Of India</strong></td>
  </tr>
  <tr>
    <td><strong>Bank Account Name : </strong></td>
    <td>Shashi India Private Limited</td>
  </tr>
  <tr>
    <td><strong>Bank Account Number :</strong></td>
    <td>1021002371</td>
  </tr>
  <tr>
    <td><strong>Branch &amp; IFSC Code : </strong></td>
    <td>Okhla Industrial Estate &amp; CBIN0283177</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
<td colspan="2" style="border-top: 1px solid;">
<h4>Terms and conditions:</h4>
  <p>1. All disputes are subject to Delhi Jurisdiction only.</p>
  <p>2. Goods are at buyer’s risk. after removal from our premises.</p>
  <p>3. Interest @36% P.A. will be charged if not paid at the time on the presentation of the bill.</p>
  <p>4. Goods once sold will not be taken back.</p>	
	</td>
    </tr>
</table>

</td>
<td colspan="5" class="tr-b">Tax Amount: GST</td>
<td colspan="4" align="right" class="tr-b td-l"><span><i style="font-size:16px" class="fa">&#xf156;</i></span> <strong><?php echo number_format((float)$inviceres->total_gst_tax_amt, 2, '.', '')?></strong></td>
</tr>

<tr>
<td colspan="5" class="tr-b">Total Amount After Tax</td>
<td colspan="4" align="right" class="tr-b td-l"><span><i style="font-size:16px" class="fa">&#xf156;</i></span>
<strong>  <?php echo number_format((float)$inviceres->grand_total, 2, '.', '')?></strong></td>
</tr>

<tr>
<td colspan="9">&nbsp;</td>
</tr>


<tr>
<td colspan="9" align="center">
  <strong>For, Shashi India Private Limited</strong><br><br><br>
  Authorised Signatory</td>
</tr>
<tr class="tr-t">
<td colspan="18" align="right"><strong>[E&amp;OE]</strong></td>
</tr>
</tbody>
</table>

<table width="90%" style="margin:auto;" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<h5>Contributed by <strong>Shashi India Private Limited</strong><br />
Certified that the particulars given above are true and correct
</h5>
<p style="text-align:left;">This is computer generated invoice no signature required.</p>
</td>

<td><h5 style="text-align:right;"><strong>E-mail: glitz03@rediffmail.com</strong></h5></td>
</tr>
</table>
</div>

</body>
</html>