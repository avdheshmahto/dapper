<?php
extract($_POST);
$invoiceID=$_REQUEST['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="<?php //echo base_url();?>/assets/css/crm1.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/assets/css/featherlight.min.css" />
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Invoice</title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/assets/invoicecss/style.css' />
	<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>

 <style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
      div.page
      {
        page-break-after: always;
      }
td{
font-size: 14px;
}
th{
font-size: 13px;
}
select {
  -webkit-appearance: button;
  -webkit-border-radius: 2px;
  -webkit-padding-end: 20px;
  -webkit-padding-start: 2px;
  -webkit-user-select: none;
  background-repeat: no-repeat;
  border: 1px solid #AAA;
  color: #555;
  font-size: inherit;
  margin: 0;
  overflow: hidden;
  padding-top: 2px;
  padding-bottom: 2px;
  text-overflow: ellipsis;
  white-space: nowrap;
  }
</style>
</head>
<body >
<?php
$invoiceID=$_GET['id'];
if($invoiceID!="")
{
$invice12=$this->db->query("select * from tbl_sales_order_hdr where salesid='".$_GET['id']."'");
$inviceres=$invice12->row();

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


?>  
<form method="post">
<div id="page-wrap" style="margin-top:13%">
<!--<input type="submit" name="update" value="print" onClick="window.print()" class="no-print submit">--><h1 style="text-align:center;"><?php echo tax($inviceres->tax_retail);?> </h1>

      <!--Deltail part started-->
<table id="items" style="">
<tr>
<td colspan="" style="padding:0px;width:20%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" style="border:none;">

<p align="center"><strong>INVOICE</strong></p>
<p align="center">(ISSUE OF INVOICE UNDER RULE 11 OF CENTRAL EXCISE RULES 2002)</p></td>
</tr>
</table>
</td>
<td colspan="5" style="vertical-align:top; padding:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" style="border:none;"></td>
<td width="50%" style="border:none;"><select style="border:hidden" name="dropDown">
          <option value="Original For Buyer" <?php if($inviceres->dropDown =='Original For Buyer'){ ?> selected="selected" <?php }?>>Original For Buyer</option>
          <option value="Duplicate for Transporter" <?php if($inviceres->dropDown=='Duplicate for Transporter'){ ?> selected="selected" <?php }?>>Duplicate for Transporter</option>
          <option value="Triplicate for Assesse" <?php if($inviceres->dropDown=='Triplicate for Assesse'){ ?> selected="selected" <?php }?>>Triplicate for Assesse</option>
          <option value="Fix Copy  Office Record" <?php if($inviceres->dropDown=='Fix Copy  Office Record'){ ?> selected="selected" <?php }?>>Fix Copy  Office Record</option>
        </select></td>
</tr>

</table>

</td>
</tr>
<tr>
<td colspan="5" style="padding:0px; vertical-align:top;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">

</table>
</td>
</tr>

<tr>
<td colspan= style="padding:0px; vertical-align:top;">

<p align="center"><strong>DELIVERY CHALLAN CUM </strong></p>											
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" style="border:none;"> VAT TIN		    :   XXXXXXXXXXX&nbsp;&nbsp;&nbsp;	
      CST No.		    :   XXXXXXXXXXX <br />
      Excise Regn No  :   XXXXXXXXXXX </td>
  </tr>
</table>
</td>
<td colspan="3" style="border-right:hidden">
<p style="font-size:18px"><b>Invoice No :<?php echo $_GET['id'];?></b></p>	
</td>
<td style="border-left: hidden">
<b>Date : <?php $date_in=explode("-",$inviceres->maker_date); 
  $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?>	</b>
</td>
</tr>

<tr>

<!--customer detail information started-->
<td colspan="1" style="padding:0px; vertical-align:top;width:50%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  style="border:none;">
Contact Name:&nbsp; <b>M/s:&nbsp;&nbsp;<?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?></b><br />
          Address:&nbsp;&nbsp;
          <?php  
  $newout= array();
echo  $outtext=  $fetchaddresss->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?> 
							
<b>TIN/CST/Excise:&nbsp;&nbsp;<? //echo $fetchrecords['tin_no'];?></b>							
</td>
</tr>
</table>
</td>
<td colspan="3" style="border-right:hidden">
</td>
<td style="border-left: hidden">
</td>
<!--customer detail information ended-->



<!--extra information started-->

<!--extra information ended-->


</tr>




<tr>

<!--company information started-->
<td colspan="" style="padding:0px; vertical-align:top;width:50%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" style="border:none;">
<!--Company Name:&nbsp; <b>&nbsp;&nbsp;
                    <?php 
// echo  $fetchcompany->first_name;
?>
</b><br />
                Address:&nbsp;&nbsp;
                <?php /*$newout= array();
echo  $outtext=  $fetchaddresss->address1.",".$fetchaddresss->Street.",".$fetchaddresss->City."<br/>";
 echo $fetchaddresss->state.",".$fetchaddresss->pincode.",".$fetchaddresss->country;
echo "<br/><br/>";
	echo  $outtext1=  $fetchaddresss->address3.",".$fetchaddresss->Street1.",".$fetchaddresss->City1."<br/>";
echo $fetchaddresss->state1.",".$fetchaddresss->pincode1.",".$fetchaddresss->country1;*/
?>	<br />		
<b>TIN/CST/Excise:&nbsp;&nbsp;<? //echo $fetchrecords['tin_no'];?></b>	-->						

</td>
</tr>

</table>
</td>
<!--company information ended-->


<!--company extra information ended-->
<td colspan="4" style="vertical-align:top; padding:0px;">
					
</td>
<!--company extracompany information ended-->


  </tr>
</table>
</td>
</tr>
</table>

	  
	  
	  
	  
 <!--Deltail part started-->	  
	  
  <table width="100%" id="items" style="">
  <tr>
    <th width="3%" >S.NO</th>
    <th colspan="2">Product</th>
    <th width="8%">Quantity</th>
	<th width="13%" colspan="2">Unit</th>
    <th width="14%">List Price</th>
    <th width="16%">Total</th>
    
    <th width="12%" colspan="2">Net price</th>
  </tr>
  <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_sales_order_dtl where salesid='$invoiceID'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$invoiceFetch->unit'");

$pfetch1=$productQ1->row();


?>
  <tr>
    <td style= "border: none;border-left:1px solid black; text-align:center"><?php echo $n;?>
        <input type="checkbox"  checked="checked" name="invoice_dtl_id1[]" id='quantity<?php echo $j?>' value="<?php echo $invoice_dtl_id;?>" readonly onblur='testRate<?php echo $i?>();' style="width:4em;border:none;display:none" /></td>
    <td style= "border: none;border-left:1px solid black;" colspan="2"><?php
echo $pfetch->productname;
?></td>
    <td style="text-align:center; border: none; border-left:1px solid black;"><?php echo  $invoiceFetch->quantity;?></td>
	<td class="total-line" style= "border: none;border-left:1px solid black;text-align:center;" colspan="2"><?php echo $pfetch1->keyvalue ;?></td>
    <td class="total-line" style= "border: none;border-left:1px solid black;text-align:center;"><?php echo number_format( $invoiceFetch->list_price,2, '.', '');  ?></td>
    <td class="total-line" style= "border: none;border-left:1px solid black;text-align:center;"><?php echo number_format( $invoiceFetch->total,2, '.', '');  ?></td>
    
    <td class="total-line" style= "border: none;border-left:1px solid black;text-align:center;"colspan="2"><span class="total-line" style="border: none;border-right:1px ;text-align:center;"><?php echo $ntp=number_format( $invoiceFetch->total,2, '.', ''); ?></span></td>
    <?php $n++;}?>
  </tr>
  <!--Deltail part ended-->
    <!--sub total and discount print part star-->
  <tr>
    <td colspan="6" rowspan="3"><?php //echo  words_repues(number_format((float)$inviceres->sub_total, 2, '.', '')); ?></td>
    <?php ?>
    <td class="total-line" colspan="2">Sub Total</td>
    <td class="total-line" colspan="2"><span class="total-line" style="border: 1px;border-right:1px;border-left:1px;text-align:center;"><?php echo number_format($inviceres->sub_total,2, '.', ''); ?></span></td>


  <tr>
    <td class="total-line"  colspan="2">Service Chg %<br/>Amount
	
	</td>
    <td class="total-line" colspan="2"><strong><?php echo @number_format($inviceres->service_charge_percentage,2, '.', ''); ?></strong><br/>
	<?php echo $inviceres->service_charge ;?></td>
  </tr>
  

  <tr>
    <td class="total-line"  colspan="2">Discount%<br/>Amount</td>
    <td class="total-line" colspan="2"><strong><?php echo @number_format($inviceres->gross_discount_percentage ,2, '.', ''); ?></strong><br/><?php echo @number_format($inviceres->gross_discount ,2, '.', ''); ?></td>
	  </tr>
	  </td>
  </tr>
  <!--tax print part start-->
  <tr style="display:none";>
    <td colspan="6" rowspan="2"><span style="font-weight:bold" >Tax(<i class="fa fa-inr" style="font-size:12px"></i>):&nbsp;</span><?php 
	/*if($inviceres->tax_type_app=="vat_charge"){ echo  words_repues(number_format((float)$inviceres->vat_sum, 2, '.', ''));}
	if($inviceres->tax_type_app=="cst_tax"){ echo  words_repues(number_format((float)$inviceres->cst_amnt, 2, '.', ''));}


if($inviceres->tax_type_app=="vat_charge"){
$vatchg=$inviceres->per;
$vatchgamtr=$inviceres->vat_per_amnt;
 }*/ ?>
 <p align="right">asd</p>
 <p align="right">asd</p>
 </td>
    <?php /*if($inviceres->tax_type_app=="vat_charge"){
$vatchgamtr=$inviceres->vat_per_amnt;
*/?>
    <td class="total-line">Tax</td>
    <td class="total-line"><?php /*echo number_format($inviceres->vat_sum,2, '.', ''); */?></td>
    <?php /*}
 if($inviceres->tax_type_app=="cst_tax"){?>
    <td class="total-line">Cst(<?php echo $inviceres->cst_per."%";?>)</td>
    <td class="total-line"><?php echo number_format($inviceres->cst_amnt,2, '.', ''); ?></td>
    <?php }*/?>
  </tr>
  <tr>
    <?php
 /*if($inviceres->sur_per>"0"){?>
    <td class="total-line"  >Sur (<?php echo $inviceres->sur_per."%";?>)</td>
    <td class="total-line"><?php echo number_format($inviceres->sur_amnt,2, '.', '');*/ ?></td>
 <?php //}
?>
  </tr>
  <!--tax print part entd-->
  <!--grand total print part start-->
  <tr>
    <td colspan="6" class="total-line total-line balance" style="text-align:left"><span style="font-weight:bold" >GRAND TOTAL(<i class="fa fa-inr" style="font-size:12px"></i>):</span><?php echo  words_repues(number_format((float)$inviceres->grand_total, 2, '.', ''));?></td>
    <td  class="total-line total-line balance" colspan="2"><b>GRAND TOTAL</b></td>
    <td class="total-line total-line balance" colspan="2"><b><?php echo  @number_format((float)$inviceres->grand_total, 0, '.', ''); ?></b></td>
  </tr>
  <tr>
<td colspan="4" rowspan="3" >
<b>Declaration:</b>						
<p>We declare to the best of  our knowledge and belief that the						
particulars stated herein are true and correct and there is no						
additional consideration accruing to us either directly or						
indirectly in any manner other than the amounts indicated						
here</p>
<p align="center">SUBJECT TO NEW DELHI JURISDICTION</p>
<p>This is a computer generated invoice</p></td>
<td colspan="6" class="total-line" style=" border-bottom:hidden">
<p>E &O.E</p> </td>
<tr>
<td colspan="6">
  <p align="center"><b>			
For  <?php 
 echo  $fetchcompany->first_name;
?>			
			
</b></p><br /><br /><br />
<p align="center">AUTHORISED SIGNATORY</p></td>
</tr>
  <!--grand total print part entd-->
  <?php }?>
</table>
</form>

<?php  ////return rupee in words
	?>
</body>

</html>