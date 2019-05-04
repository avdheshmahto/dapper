<?php
$this->load->view("header.php");
require_once(APPPATH.'core/my_controller.php');
echo $invoiceID=$_GET['id'];
if($invoiceID!="")
{
$invice12=$this->db->query("select * from tbl_invoice_hdr where invoiceid='".$_GET['id']."'");
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

<div class="main-content">
<div class="row">
<div class="col-lg-3">
<div class="panel panel-default">
<p><a class="btn btn-block btn-secondary" href="#">All Invoices</a></p>
<ul class="list-unstyled mail-list">
<?php
$invoiceQuery=$this->db->query("select *from tbl_invoice_hdr where invoiceid='".$_GET['contact_id']."' ");
foreach($invoiceQuery->result() as $getInvoice)
  {
  ?>

<li class="active">
<a href="<?=base_url();?>salesorder/SalesOrder/invoice_details?id=<?=$getInvoice->invoiceid;?>&&contact_id=<?=$getInvoice->vendor_id;?>"><i class="fa fa-inbox"></i> <?=$getInvoice->invoice_date;?><b>(<?=$getInvoice->invoiceid;?>)</b></a>					
</li>
<?php }?>
</ul>


</div>
</div>

<div class="col-lg-9">
<div class="invoice-bg-top">
<div class="row">
<div class="col-sm-12">
<div class="bs-example">
<button class="btn btn-primary"  onClick="openpopup('<?=base_url();?>Payment/payment_amount',1200,500,'id',<?php echo $_GET['id'];?>)" type="button">Record Payment</button><button class="btn btn-primary" type="button" onClick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1200,500,'id',<?php echo $_GET['id'];?>)">Edit Invoice</button><button class="btn btn-primary" type="button" onClick="openpopup('<?=base_url();?>salesorder/SalesOrder/salesOrder_details_mail',1200,500,'id',<?php echo $_GET['id'];?>)">Mail Invoice</button></div>
</div>
</div><!--row-->
<br>
<?php 
$softwareLog=$this->db->query("select *from tbl_software_log where contact_id='".$_GET['contact_id']."' and log_id='".$_GET['id']."' order by id desc");
foreach($softwareLog->result() as $getSoftware){
?>

<div class="row">
<div class="col-sm-3">
<?=$getInvoice->invoice_date;?>&nbsp;<?=$getSoftware->author_id;?>
</div>
<div class="col-sm-9">
<i class="fa fa-edit"></i><?php
if($getSoftware->type=='Payments Received added')
{
?>
Payment of amount ₹<?=$getSoftware->total;?> received by <?php echo $this->session->userdata('user_name');?> <a href='#' style="color:#ec407a" onclick="openpopup('<?=base_url();?>Payment/invoicereport',1200,500,'id',<?=$getSoftware->contact_id;?>)">View</a>

<?php
} elseif($getSoftware->type=='Sales Order added' || $getSoftware->type=='Sales Order Updated' ){
?>
Invoice No. <?=$getSoftware->log_id?> of amount ₹ <?=$getSoftware->total;?> created by <?php echo $this->session->userdata('user_name');?> <a style="color:#ec407a" href='#' onclick="openpopup('<?=base_url();?>salesorder/SalesOrder/edit_sales_order',1200,500,'view',<?=$getSoftware->log_id;?>)">View</a> 
<?php
}
else
{}
?>

</div>
</div><!--row-->
<?php }?>

<!--row-->

<!--row-->
</div><!--invoice-bg-top close-->

<div class="invoice-bg">
<div class="row">
<div class="col-sm-4" >
<div id="logo">
<img src="<?=base_url();?>assets/images/logo-to.png" alt=""><br>
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
#<?php echo $_GET['id'];?>
<div id="invoice-bil">
<span>Balance Due</span>
<br>
<strong>Rs <?=$getPayment= $obj->payment_due($_GET['contact_id']);?></strong>
</div>
</div>
</div>

</div><!--row-->
<div id="height"></div>

<div class="row">
<div class="col-sm-4">
<div id="logo">
<p>
<strong>M/s:&nbsp;&nbsp;<?php echo $inviceres->vendor_id." ".$fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?></strong><br>
 <?php $newout= array();
echo  $outtext=  $fetchrecords->address1?></p>
</div>
</div>

<div class="col-sm-4"></div>

<div class="col-sm-4">
<table id="meta">
<tr>
<td class="meta-head">Invoice Date :</td>
<td><?php $date_in=explode("-",$inviceres->invoice_date); 
  $monthNum  = $date_in[1];
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F');	  echo $date_in[2].'-'.$monthName.'-'.$date_in[0]; ?></td>
</tr>
<tr>

<td class="meta-head">Terms :</td>
<td>Due on Receipt</td>
</tr>
<tr>
<td class="meta-head">Due Date :</td>
<td><div class="due"><?php 
$idt=$inviceres->invoice_date;
$date = new DateTime("$idt");
$fdate=$date->format("Y-m-d");
$dt=$inviceres->due_date;
echo $idate= date('d-F-Y', strtotime($fdate. " + $dt days"));

?></div></td>
</tr>
</table>
</div>
</div><!--row close-->
<div id="height"></div>

<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table id="items">
<tr>
<th>#</th>
<th>Item & Description</th>
<th>Qty</th>
<th>Rate</th>
<th>Amount</th>
</tr>
<?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_invoice_dtl where invoiceid='$invoiceID'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();


//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();






?>

<tr class="item-row">
<td>1</td>
<td class="description"><?php echo $pfetch->productname;?></td>
<td><?php echo  $invoiceFetch->quantity;?>(<?php echo $pfetch1->keyvalue ;?>)</td>
<td><?php echo number_format( $invoiceFetch->list_price,2, '.', '');  ?></td>
<td><?php echo $ntp=number_format( $invoiceFetch->total,2, '.', ''); ?></td>
</tr>
<?php }?>
<tr>
<td colspan="2" class="blank"> </td>
<td colspan="2" class="total-line">Sub Total</td>
<td class="total-value"><div id="subtotal"><?php echo number_format($inviceres->sub_total,2, '.', ''); ?></div></td>
</tr>
<tr>

<td colspan="2" class="blank"> </td>
<td colspan="2" class="total-line"><strong>Total</strong></td>
<td class="total-value"><div id="total"><strong>Rs <?php echo  @number_format((float)$inviceres->grand_total, 2, '.', ''); ?></strong></div></td>
</tr>

<tr>
<td colspan="2" class="blank"> </td>
<td colspan="2" class="total-line balance"><strong>Balance Due</strong></td>
<td class="total-value balance"><div class="due"><strong>Rs <?=$getPayment= $obj->payment_due($_GET['contact_id']);?></strong></div></td>
</tr>
</table>
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
</div><!--col-lg-9 close-->

</div>
<?php
$this->load->view("footer.php");

?>