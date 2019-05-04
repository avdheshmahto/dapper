<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Payment extends my_controller {

public function payment_amount(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/invoice-payment');
	}
	else
	{
	redirect('index');
	}	
}




public function insert_payment()
{
@extract($_POST);
if($save!='')
{

	if($date123==''){
$date123=date('d-m-y');}
	$sqlinsert="insert into tbl_invoice_payment set contact_id='$customerfname',receive_billing_mount='$rec_amount12',date='$date123',payment_mode='$payment_mode',maker_id='".$this->session->userdata('user_id')."',maker_date=NOW(),comp_id='".$this->session->userdata('comp_id')."', status='payment'";
$this->db->query($sqlinsert);
$lastHdrId=$this->db->insert_id();
if($invId!='')
{
	$invoiceId=$invId;
}
else
{
	$invoiceId=0;
}
$this->software_log_insert($invoiceId,$customerfname,$rec_amount12,'Payments Received added');

} 






$querySalesQuery=$this->db->query("select *from tbl_sales_order_hdr where salesid='$invId'");
			
		$getSales=$querySalesQuery->row();
			$cont=$getSales->content;
			$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getSales->vendor_id'");
			$getContactName=$contactQuery->row();
			
		$cont1=" 	
<p>&nbsp;</p>
<div style='font-family: 'Times New Roman'; font-size: medium; background: #fbfbfb;'>
<div style='padding: 25.6094px; text-align: center; background: #4190f2;'>
<div style='color: #ffffff; font-size: 20px;'>Invoice # $lastHdrId</div>
</div>
<div style='max-width: 560px; margin: auto; padding: 0px 25.6094px;'>
<div style='padding: 30px 0px; color: #555555; line-height: 1.7;'>Dear $getContact->safi,&nbsp;<br /><br />Your invoice $lastHdrId is attached.

Thank you for your business.&nbsp;</div>
<br />
<div style='padding: 16.7969px 0px; line-height: 1.6;'>Thanks & Regards
<div style='color: #8c8c8c;'>Gaurav Taneja</div>
<div style='color: #b1b1b1;'>Tech Vyas Solutions Pvt Ltd.</div>
<div style='color: #b1b1b1;'>9990455812</div>
</div>
</div>
</div>
<p>&nbsp;</p>";	
			
		
$data = array(
'id' => $invId,
'payment_date' => $date123,
'payment_mode' => $payment_mode,
'amount' => $rec_amount12,
'contact_id' => $customerfname

);

	





 $url="assets/sales_order_pdf/invoice_order'".$id."'.pdf";

	//load the view and saved it into $html variable

		$html=$this->load->view('email', $data, true);



        //this the the PDF filename that user will get to download

		$pdfFilePath =$url;



        //load mPDF library

		$this->load->library('m_pdf');



       //generate the PDF from the given html

		$this->m_pdf->pdf->WriteHTML($html);



        //download it.

		$this->m_pdf->pdf->Output($pdfFilePath, "f");	
$config = Array(
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'wordwrap' => TRUE
		);
		$contName=$getContactName->email;
		$this->load->library('email', $config);
		$this->email->from('info@techvyaserp.in');
		$this->email->to($contName);
		$this->email->to("collestbablu@gmail.com");
		 $this->email->cc('collestbablu@gmail.com');
		$this->email->subject("Payment");
		$this->email->message($cont);
		 $this->email->attach($url);
		$this->email->send();
			





echo "
<script>
alert('Payment Done');
window.location.href='payment_amount';
window.close();
</script>

";

}





public function invoicereport(){

	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Payment/invoice-payment-report');
}
else{
redirect('index');

}
}
public function invoice_correction(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Payment/invoice-payment-correction');
}

else{
redirect('index');

}

}

}
?>