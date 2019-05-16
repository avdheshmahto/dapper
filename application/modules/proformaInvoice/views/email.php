<?php

if($id!="")
{
$invice12=$this->db->query("select * from tbl_sales_order_hdr where salesid='$id'");
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title></title>

<!-- Bootstrap core CSS -->
<link href="<?=base_url();?>assets/invoice_css/css/bootstrap.min.css" rel="stylesheet">
</head>

  <body>




<div class="container">
<div id="page-wrap">
<div class="invoice-bg">
<div class="row">
<div class="col-sm-4">
<div id="logo">
<img src="<?=base_url();?>assets/invoice_css/images/logo-to.png" alt=""><br>
<h4>Tech Vyas Solutions Pvt. Ltd.</h4>
<p>
B-6, Shop Plot, Shankar Garden, <br>
Vikaspuri, New Delhi (110018)<br>
</p>
</div>
</div>

<div class="col-sm-4"></div>

<div class="col-sm-4">
<div id="invoice-right">
<h2>INVOICE</h2>
#<?php echo $inviceres->salesid; ?><div id="invoice-bil">
<span>Balance Due</span>
<br>
<strong>Rs <?php echo  @number_format((float)$inviceres->grand_total, 0, '.', ''); ?></strong>
</div>
</div>
</div>

</div><!--row-->
<div id="height"></div>

<div class="row">
<div class="col-sm-4">
<div id="logo">
<p>
<strong>M/s:&nbsp;&nbsp;<?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?>  </strong><br>
  <?php  
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?> </p>
</div>
</div>

<div class="col-sm-4"></div>

<div class="col-sm-4">
<table id="meta">
<tbody><tr>
<td class="meta-head">Invoice Date :</td>
<td><?php $date_in=explode("-",$inviceres->maker_date); 
  $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?></td>
</tr>


</tbody></table>
</div>
</div><!--row close-->
<div id="height"></div>

<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table id="items">
<tbody><tr>
<th>#</th>
<th>Item &amp; Description</th>

<th>Rate</th>
<th>Amount</th>
</tr>
 <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$invoiceFetch->unit'");

$pfetch1=$productQ1->row();


?>
<tr class="item-row">
<td><?=$n?></td>
<td class="description"><?=$pfetch->productname?></td>

<td><?php echo number_format( $invoiceFetch->list_price,2, '.', '');  ?></td>
<td><?php echo $ntp=number_format( $invoiceFetch->total,2, '.', ''); ?></td>
</tr>
<?php } }?>

<tr>


<td colspan="3" class="total-line"><strong>Total</strong></td>
<td class="total-value"><div id="total"><strong>Rs <?php echo  @number_format((float)$inviceres->grand_total, 0, '.', ''); ?></strong></div></td>
</tr>


</tbody></table>
<div id="height"></div>
<div id="terms">
<h5>Notes</h5>
<p>Thanks for your business.</p>
</div>
</div>
</div>
</div><!--row close-->
<div id="height"></div>


</div>


</div>

</div><!-- /container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
