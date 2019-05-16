<?php
$id=$_GET['id'];
if($id!="")
{
$invice12=$this->db->query("select * from tbl_invoice_hdr where invoiceid='$id'");
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
}

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Invoice</title>

<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/inv_css/css/invoice-to.css' />

</head>
<body>


<?php 

for($k=0;$k<2;$k++)
{

?>
<div id="page-wrap" style="margin-bottom:20px;">
<div id="customer">
<div id="header-to">
<h1>CASH MEMO</h1>
<h3 style="display:none">E-29,Gali-No.-12,Shashi Garden,Mayur Vihar,Phose-1,Delhi-91.<br />E-mail: rohitinteriorcraft@yahoo.in</h3>
</div><!--header-to close-->


<div style="clear:both"></div>

<div id="customer-left">
To<br />
<?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?><br />
<?php  
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?>
</div>

<div style="clear:both"></div>

<div id="customer-left">
<strong>INVOICE NO.: <?=$id;?></strong>
</div>

<div id="customer-right" style="text-align: right;">
DATE: <?php $date_in=explode("-",$inviceres->maker_date); 
  $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?>
</div>

<div style="clear:both"></div>
</div>

<table id="items">
<tr>
<th>S.NO</th>

<th>Product</th>
<th>Qty</th>
<th>Rate</th>
<th>Amount</th>
</tr>
 <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_invoice_dtl where invoiceid='$id'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->productid'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();


?>

<tr class="item-row">
<td><?=$n;?></td>

<td><?php
echo $pfetch->productname;
?></td>
<td><?php
echo $invoiceFetch->qty;
?>&nbsp;<?=$pfetch1->keyvalue;?></td>
<td><?php echo number_format( $invoiceFetch->list_price,2, '.', '');  ?></td>
<td><?php echo $ntp=number_format( $invoiceFetch->net_price,2, '.', ''); ?></td>
</tr>
<?php $n++;}?>


<tr class="item-row">

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr class="item-row">

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><strong>Sub Total</strong></td>
<td><?php echo number_format($inviceres->sub_total,2, '.', ''); ?></td>
</tr>

<tr class="item-row">
<td colspan="3"><strong><?php echo  words_repues(number_format((float)$inviceres->grand_total, 2, '.', '')); ?></strong></td>

<td><strong>Grand Total</strong></td>
<td><strong><?php echo  @number_format((float)$inviceres->grand_total, 0, '.', ''); ?></strong></td>
</tr>
</table>

<div style="clear:both"></div>



<div style="clear:both"></div>


<div style="clear:both"></div>


</div>
<?php }?>

</html>