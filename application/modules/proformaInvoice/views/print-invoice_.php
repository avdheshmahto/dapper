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
 
$fetchcomp=$this->db->query("select * from tbl_contact_m where contact_id='".$fetchrecords->company_id."'");
$fetchcompany=$fetchcomp->row(); 
  
$fetchaddress=$this->db->query("select * from tbl_address_m where entityid='".$inviceres->vendor_id."'");
$fetchaddresss=$fetchaddress->row();


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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

<div id="page-wrap">

<table id="items">
<tbody><tr>
<td colspan="2" class="blank" align="center">
<img src="<?=base_url();?>assets/inv_css/images/2805747.png" alt=""></td>
<td colspan="16" align="center" class="blank">
 <h1>Shashi India Private Limited</h1> 
 <h3>AN ISO 9001-2008 Company</h3>
 <h2>Manufacturers, Traders and Exporters an extensive array <br> of Knitted Hand Gloves, Glove Knitting Machines, Colored Glitter. </h2> 
  <h3>E-208, Flatted Factory Complex Okhla,  <br>
    Phase III, Delhi - 110020, India  </h3></td>
</tr>

<tr class="tr-t">
  <td colspan="18" class="td-r"><h2>Proforma INVOICE</h2></td>
  </tr>
<tr class="tr-t">
  <td colspan="8">&nbsp;</td>
  <td colspan="3" class="td-l"><strong>Expected Delivery Date:</strong></td>
  <td colspan="7"><?=$inviceres->expected_delivery_date;?></td>
</tr>

<tr>
<td colspan="3"><strong>Proforma Invoice Number :</strong></td>
<td colspan="4"><?=$inviceres->invoice_no;?></td>
<td>&nbsp;</td>
<td colspan="3" class="td-l"><strong>Transit Insurance :</strong></td>
<td colspan="7"><?=$inviceres->transit_insurance;?></td>
</tr>

<tr>
<td colspan="3"><strong>Proforma Invoice Date:</strong></td>
<td colspan="4"><?php 
echo $inviceres->invoice_date;
$date_in=explode("-",$inviceres->invoice_date); 
  echo $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?></td>
<td>&nbsp;</td>
<td colspan="3" class="td-l"><strong>Date of Supply:</strong></td>
<td colspan="7"><?=$inviceres->Date_of_Supply;?></td>
</tr>

<tr>
<td colspan="2"><strong>State:</strong></td>
<td colspan="1"><?=$getBaseStateCode->stateName;?></td>
<td colspan="4" class="td-rl tr-t"><strong>State Code:</strong></td>
<td class="td-rl tr-t"><?=$inviceres->state_id?></td>
<td colspan="3"><strong>Place of Supply :</strong></td>
<td colspan="7"><?=$inviceres->Place_of_Supply;?></td>
</tr>
<tr>
<td colspan="8" rowspan="2" valign="top" class="td-rl tr-t">&nbsp;</td>
<td colspan="3"><strong>Payment Term:</strong></td>
<td colspan="7"><?=$inviceres->due_date;?></td>
</tr>
<tr>
  <td colspan="3">&nbsp;</td>
  <td colspan="7">&nbsp;</td>
</tr>
<tr>
  <td colspan="18" class="tr-t tr-b">&nbsp;</td>
</tr>

<tr id="bg" class="tr-b">
<td colspan="8"><strong>Details of Receiver</strong></td>
<td colspan="10"><strong>Details of Consignee Shipped to</strong></td>
</tr>

<tr>
<td class="td-r"><strong>Name:</strong></td>
<td colspan="7"><?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?></td>
<td class="td-rl"><strong>Name:</strong></td>
<td colspan="9"><?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?></td>
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
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?></td>
</tr>

<tr>
<td class="td-r"><strong>GSTIN:</strong></td>
<td colspan="7"><?php echo $fetchrecords->gst;?></td>
<td class="td-rl"><strong>GSTIN:</strong></td>
<td colspan="9"><?php echo $fetchrecords->gst;?></td>
</tr>
<tr>
<td class="td-r"><strong>Phone No.:</strong></td>
<td colspan="7"><?php echo $fetchrecords->mobile;?></td>
<td class="td-rl"><strong>Phone No.</strong></td>
<td colspan="9"><?php echo $fetchrecords->mobile;?></td>
</tr>
<tr>
<td class="td-r"><strong>Email Id:</strong></td>
<td colspan="7"><?php echo $fetchrecords->email;?></td>
<td class="td-rl"><strong>Email Id</strong></td>
<td colspan="9"><?php echo $fetchrecords->email;?></td>
</tr>
<tr>
<td class="td-r"><strong>Vendor Code:</strong></td>
<td colspan="7">&nbsp;</td>
<td class="td-rl"><strong>Vendor Code:</strong></td>
<td colspan="9">&nbsp;</td>
</tr>
<?php

$stateQuery=$this->db->query("select *from tbl_state_m where stateid='$fetchrecords->state_id' ");
$getState=$stateQuery->row();
?>
<tr>
<td class="td-r"><strong>State:</strong></td>
<td colspan="3"><?=$getState->stateName;?></td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td class="td-rl tr-t"><?php echo $getState->code;?></td>
<td class="td-rl"><strong>State:</strong></td>
<td colspan="3"><?=$getState->stateName;?></td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td colspan="3" class="tr-t"><?php echo $getState->code;?></td>
</tr>


<tr id="bg" class="tr-t tr-b">
<td rowspan="2" class="td-rl"><strong>Sr.No.</strong></td>
<td rowspan="2" class="td-rl"><strong>Item Code</strong></td>
<td rowspan="2" class="td-rl" style="width:200px;"><strong>Product/Description</strong></td>
<td rowspan="2" class="td-rl"><strong>HSN CODE</strong></td>
<td rowspan="2" class="td-rl"><strong>UOM</strong></td>
<td rowspan="2" class="td-rl"><strong>Qty</strong></td>
<td rowspan="2" class="td-rl"><strong>Rate</strong></td>
<td rowspan="2" class="td-rl"><strong>Amount</strong></td>
<td rowspan="2" class="td-rl"><strong>Disc</strong></td>
<td rowspan="2" class="td-rl"><strong>Taxable Value</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>CGST</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>SGST</strong></td>
<td colspan="2" class="td-rl" align="center"><strong>IGST</strong></td>
<td rowspan="2" class="td-rl" ><strong>Total</strong></td>
</tr>

<tr>
<td id="bg" class="tr-b"><strong>Rate</strong></td>
<td id="bg" class="tr-b"><strong>Amount</strong></td>
<td id="bg" class="tr-b"><strong>Rate</strong></td>
<td id="bg" class="tr-b"><strong>Amount</strong></td>
<td id="bg" class="tr-b"><strong>Rate</strong></td>
<td id="bg" class="tr-b"><strong>Amount</strong></td>
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
<td class="td-rl"><?=$n;?></td>
<td class="td-rl"><?php echo $pfetch->productname;?></td>
<td class="td-rl"><?php
echo $pfetch->productname;
?></td>
<td align="center" class="td-rl"><?php
echo $pfetch->hsn_code;
?></td>
<td class="td-rl"><?=$pfetch1->keyvalue;?></td>
<td class="td-rl"><?php echo  $invoiceFetch->qty;?></td>
<td class="td-rl"><?php echo  $invoiceFetch->list_price;?></td>
<td class="td-rl"><?php echo number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '');  ?></td>
<td class="td-rl"><?php echo  $invoiceFetch->discount_amount;?></td>
<td class="td-rl"><?php echo number_format( $invoiceFetch->list_price*$invoiceFetch->qty,2, '.', '')-$invoiceFetch->discount_amount;?></td>
<td class="td-rl"><?php echo  $invoiceFetch->cgst;?>%</td>
<td class="td-rl"><?php   if($invoiceFetch->cgst!=''){ echo $invoiceFetch->gstTotal/2; }?></td>
<td class="td-rl"><?php echo  $invoiceFetch->sgst;?>%</td>
<td class="td-rl"><?php if($invoiceFetch->sgst!=''){  echo $invoiceFetch->gstTotal/2; }?></td>
<td class="td-rl"><?php echo  $invoiceFetch->igst;?>%</td>
<td class="td-rl"><?php if($invoiceFetch->igst!=''){  echo number_format($invoiceFetch->gstTotal,2, '.', '');}?></td>
<td class="td-rl"><?php echo number_format( $invoiceFetch->net_price,2, '.', ''); ?></td>
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

<tr>
<td colspan="2"><strong>Our Bank :  </strong><br></td>
<td colspan="4"><strong>Central Bank Of India</strong><br></td>
<td colspan="3" rowspan="6" style="font-size:11px" align="left" valign="bottom" class="td-r td-l">Customer Seal & signature</td>
<td colspan="5" class="tr-b">Tax Amount: GST</td>
<td colspan="4" align="right" class="tr-b td-l"><span><i style="font-size:16px" class="fa">&#xf156;</i></span> <strong><?php echo number_format((float)$inviceres->total_gst_tax_amt, 2, '.', '')?></strong></td>
</tr>

<tr>
<td colspan="2"><strong>Bank Account Name : </strong></td>
<td colspan="4">Shashi India Private Limited</td>


<td colspan="5" class="tr-b">Total Amount After Tax</td>
<td colspan="4" align="right" class="tr-b td-l"><span><i style="font-size:16px" class="fa">&#xf156;</i></span>
<strong>  <?php echo number_format((float)$inviceres->grand_total, 2, '.', '')?></strong></td>
</tr>

<tr>
<td colspan="2"><strong>Bank Account Number : </strong></td>
<td colspan="4">1021002371</td>
<td colspan="9" rowspan="3">&nbsp;</td>
</tr>

<tr>
<td colspan="2"><strong>Branch & IFSC Code : </strong></td>
<td colspan="4">Okhla Industrial Estate & CBIN0283177</td>
</tr>

<tr>
<td colspan="6" rowspan="2" class="tr-t">
  <h4>Terms and conditions:</h4>
  <p>1. All disputes are subject to Faridabad Jurisdiction only.</p>
  <p>2. Goods are at buyer’s risk. after removal from our premises.</p>
  
  <p>3. Goods once sold will not be taken back.</p></td>
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

<div id="terms">
<div id="terms-l">
<h5>Contributed by <strong>Shashi India Private Limited</strong><br />
Certified that the particulars given above are true and correct
</h5>
</div>
<div id="terms-r"><h5><strong>E-mail: demo@gmail.com</strong></h5></div>
</div>

</div>

</body>
</html>