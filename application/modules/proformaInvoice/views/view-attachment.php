<?php
$this->load->view("header.php");
$qry=$this->db->query("select * from tbl_performa_attchment where qut_ref_id='".$_GET['id']."'");
$fetchQ=$qry->row();
?>
	 <!-- Main content -->
	 <div class="main-content">
	 
	 
<div class="row">
<div class="col-sm-12">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="/shashi-india/master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Proforma Invoice</a></li> 
<li class="active"><strong><a href="#">Attachments</a></strong></li> 
<div class="pull-right">
<a class="btn btn-sm" href="/shashi-india/proformaInvoice/add_invoice">Add Proforma Invoice</a>
</div>
</ol>
<hr />



<div class="row">
<?php 
		if($fetchQ1->customer_id!=$_GET['id']){
      		$query=$this->db->query("select * from tbl_performa_attchment where qut_ref_id='".$_GET['id']."'");
			foreach($query->result() as $datafetch){
	  		?>
<div class="col-sm-3">
<div class="house">
<a class="fancybox" href="<?php echo base_url().'assets/performa_attchment/'.$datafetch->image;?>" data-fancybox-group="gallery" title=""><div class="imgWrap"><img src="<?php echo base_url().'assets/performa_attchment/'.$datafetch->image;?>" alt="" style="width:100%;" /></div></a>
</div>

</div>
<?php } }?>








</div>
</div><!--row close-->	
</div>
<?php

$this->load->view("footer.php");
?>