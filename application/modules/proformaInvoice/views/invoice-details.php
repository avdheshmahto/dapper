<?php
$this->load->view("header.php");
require_once(APPPATH.'core/my_controller.php');
$invoiceID=$_GET['id'];
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
$invoiceQuery=$this->db->query("select *from tbl_invoice_hdr where vendor_id='".$_GET['contact_id']."' ");
foreach($invoiceQuery->result() as $getInvoice)
  {
  ?>

<li>
<a href="<?=base_url();?>invoice/invoice/invoice_details?id=<?=$getInvoice->invoiceid;?>&&contact_id=<?=$getInvoice->vendor_id;?>"><i class="fa fa-inbox"></i> <?=$getInvoice->invoice_date;?><b>(<?=$getInvoice->invoiceid;?>)</b></a>					
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
<a href="<?=base_url();?>PaymentReceived/payment_amount_invoice?id=<?php echo $_GET['id']?>&&contact_id=<?php echo $_GET['contact_id'];?>" class="btn btn-sm" target="_blank">Record Payment</a>

<button class="btn btn-default" type="button" onClick="openpopup('<?=base_url();?>invoice/edit_invoice_order_1',1200,500,'id',<?php echo $_GET['id'];?>)"> <i class="icon-pencil"></i> </button>

<a href="<?=base_url();?>invoice/invoice/print_invoice?id=<?php echo $_GET['id'];?>" class="btn btn-default" target="blank"><i class="glyphicon glyphicon-print"></i></a>



<button class="btn btn-primary" style="display:none" type="button" onClick="openpopup('<?=base_url();?>salesorder/SalesOrder/salesOrder_details_mail',1200,500,'id',<?php echo $_GET['id'];?>)">Mail Invoice</button>



</div>
</div>
</div><!--row-->
<br>
<?php 
$softwareLog=$this->db->query("select *from tbl_software_log where contact_id='".$_GET['contact_id']."' and log_id='".$_GET['id']."' and type='Invoice added' order by id desc");
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
} elseif($getSoftware->type=='Invoice added' || $getSoftware->type=='Invoice Updated' ){
?>
  Invoice No. <?=$getSoftware->log_id?> of amount ₹ <?=$getSoftware->total; if($getSoftware->type=='Invoice added'){?> created by <?php }if($getSoftware->type=='Invoice Updated'){ echo "update by";} echo $this->session->userdata('user_name');?> <a style="color:#ec407a" href='#' onclick="openpopup('<?=base_url();?>invoice/invoice/edit_invoice_order_1',1200,500,'view',<?=$getSoftware->log_id;?>)">View</a> 
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
<div class="col-sm-12">
<div class="table-responsive">
<table id="items">
<tbody><tr>
<td colspan="2" class="blank" align="center">
<img src="/klu/assets/inv_css/images/2805747.png" alt=""></td>
<td colspan="14" align="center" class="blank">
 <h1>Karamchari Laghu Udyog</h1>  
 <h2>Manufacturer of high quality melamine</h2>
 <h3>Plot No.3, Thakur Complex, Mujessar (Opp. Escort Crane Shart Div.) <br>Sector-24, Faridabad
   GSTIN No. 06ARFPS0542R1ZB  </h3></td>
</tr>


<tr>
  <td colspan="16" class="blank">  </td>
</tr>



<tr class="tr-t">
<td colspan="12" rowspan="3" class="td-r"><h2>Invoice</h2></td>
<td colspan="4"><strong>Original for Receipient</strong></td>
</tr>
<tr class="tr-t">
<td colspan="4"><strong>Duplicate for Supplier/Transporter</strong></td>
</tr>
<tr class="tr-t">
<td colspan="4"><strong>Triplicate for Supplier</strong></td>
</tr>



<tr class="tr-t">
  <td colspan="2"><strong>Reverse Charge: </strong></td>
  <td colspan="3">Yes/No</td>
  <td colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="3" class="td-l"><strong>Transportation:</strong></td>
  <td colspan="2">66</td>
  <td colspan="3">&nbsp;</td>
</tr>

<tr>
<td colspan="2"><strong>Invoice No. :</strong></td>
<td colspan="3">1</td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td colspan="3" class="td-l"><strong>Vehicle Number :</strong></td>
<td colspan="2">66</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>

<tr>
<td colspan="2"><strong>Invoice Date:</strong></td>
<td colspan="3">05-January-2018</td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td colspan="3" class="td-l"><strong>Date of Supply :</strong></td>
<td colspan="2"></td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>

<tr>
<td colspan="2"><strong>State:</strong></td>
<td colspan="3">DELHI</td>
<td colspan="2" class="td-rl tr-t"><strong>State Code:</strong></td>
<td class="td-rl tr-t">06</td>
<td colspan="3"><strong>Place of Supply :</strong></td>
<td colspan="2">77</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>

<tr>
<td colspan="16" class="tr-t tr-b">&nbsp;</td>
</tr>

<tr id="bg" class="tr-b">
<td colspan="8"><strong>Details of Receiver</strong></td>
<td colspan="8"><strong>Details of Consignee Shipped to</strong></td>
</tr>

<tr>
<td class="td-r"><strong>Name:</strong></td>
<td colspan="7">shivam Saini  </td>
<td class="td-rl"><strong>Name:</strong></td>
<td colspan="7">shivam Saini  </td>
</tr>

<tr>
<td class="td-r"><strong>Address:</strong></td>
<td colspan="7">  <br/></td>

<td class="td-rl"><strong>Address:</strong></td>
<td colspan="7">
  <br/></td>
</tr>

<tr>
<td class="td-r"><strong>GSTIN:</strong></td>
<td colspan="7"></td>
<td class="td-rl"><strong>GSTIN:</strong></td>
<td colspan="7"></td>
</tr>
<tr>
<td class="td-r"><strong>State:</strong></td>
<td colspan="3">Arunachal Pradesh</td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td class="td-rl tr-t">3</td>
<td class="td-rl"><strong>State:</strong></td>
<td colspan="3">Arunachal Pradesh</td>
<td colspan="3" class="td-rl tr-t">State Code:</td>
<td class="tr-t">3</td>
</tr>

<tr id="bg" class="tr-t tr-b">
<td rowspan="2" class="td-rl"><strong>Sr.No.</strong></td>
<td rowspan="2" class="td-rl"><strong>Name of Product/Service</strong></td>
<td rowspan="2" class="td-rl"><strong>HSN/ACS</strong></td>
<td rowspan="2" class="td-rl"><strong>UOM</strong></td>
<td rowspan="2" class="td-rl"><strong>Qty</strong></td>
<td rowspan="2" class="td-rl"><strong>Rate</strong></td>
<td rowspan="2" class="td-rl"><strong>Amount</strong></td>
<td rowspan="2" class="td-rl"><strong>Less:Discount</strong></td>
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
 <tr class="th-border">
<td class="td-rl">1</td>
<td class="td-rl">Dinner Set</td>
<td class="td-rl">76576</td>
<td class="td-rl">Piece </td>
<td class="td-rl">1</td>
<td class="td-rl">78</td>
<td class="td-rl">78.00</td>
<td class="td-rl">0</td>
<td class="td-rl">78</td>
<td class="td-rl"></td>
<td class="td-rl"></td>
<td class="td-rl"></td>
<td class="td-rl"></td>
<td class="td-rl">6</td>
<td class="td-rl">4.68</td>
<td class="td-rl">82.68</td>
</tr>

<tr class="tr-t tr-b">
<td colspan="4" align="right" class="td-rl"><strong>Total</strong></td>
<td class="td-rl"><strong>1</strong></td>
<td>&nbsp;</td>
<td class="td-rl"><strong>78</strong></td>
<td>&nbsp;</td>
<td class="td-rl"><strong>78</strong></td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td class="td-rl"><strong>82.68</strong></td>
</tr>

<tr>
<td colspan="9" rowspan="4" class="td-r tr-b"><p>Total Gst Amount in Words: </p>
  <p>FOUR  RUPEES AND SIX EIGHT PAISE</p>
  <p>Total Invoice In Worrds:EIGHTY TWO  RUPEES AND SIX EIGHT PAISE</p></td>
<td colspan="5" class="tr-b"><strong>Total Amount Before Tax:</strong></td>
<td colspan="2" align="right" class="tr-b td-l"><strong>78</strong></td>
</tr>

<tr>
<td colspan="5" class="tr-b">Add: CGST</td>
<td colspan="2" align="right" class="tr-b td-l"><strong>0.00</strong></td>
</tr>

<tr>
<td colspan="5"  class="tr-b">Add: SGST</td>
<td colspan="2" align="right" class="tr-b td-l"><strong>0.00</strong></td>
</tr>



<tr>
<td colspan="5" class="tr-b">Add:IGST</td>
<td colspan="2" align="right" class="tr-b td-l"><strong>4.68</strong></td>
</tr>

<tr>
<td colspan="6" align="center"><strong>Our Bank: Punjab National Bank. </strong><br></td>
<td colspan="3" rowspan="6" align="center" valign="bottom" class="td-r td-l">(Common Seal)</td>
<td colspan="5" class="tr-b">Tax Amount: GST</td>
<td colspan="2" align="right" class="tr-b td-l"><strong>4.68</strong></td>
</tr>

<tr>
<td colspan="2"><strong>Bank Account Name</strong></td>
<td colspan="4">M/S SHANTI TRADERS</td>


<td colspan="5" class="tr-b">Total Amount After Tax</td>
<td colspan="2" align="right" class="tr-b td-l"><strong>82.68</strong></td>
</tr>

<tr>
<td colspan="2"><strong>Bank Account Number</strong></td>
<td colspan="4">1111005501005305</td>
<td colspan="7">&nbsp;</td>
</tr>

<tr>
<td colspan="2"><strong>IFSC CODE</strong></td>
<td colspan="4">PUNB0111100</td>
<td colspan="7">&nbsp;</td>
</tr>

<tr>
<td colspan="6" rowspan="2" align="center" class="tr-t">SUBJECT TO FARIDABAD JURISDITION<br />
This is a Computer Generated Invoice</td>
<td colspan="5" class="tr-b tr-t">GST Payable on Charge:</td>
<td colspan="2" align="right" class="tr-b tr-t td-l">&nbsp;</td>
</tr>

<tr>
<td colspan="7" align="center">Certified that the particulars given above are true and correct<br>
  <strong>For, KARAMCHARI LAGHU UDHYOG</strong><br><br><br>
  Authorised Signatory</td>
</tr>
<tr class="tr-t">
<td colspan="16" align="right"><strong>[E&amp;OE]</strong></td>
</tr>
</tbody>
</table>
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