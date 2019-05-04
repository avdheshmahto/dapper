<?php
$this->load->view("header.php");
$quryinv=$this->db->query("select *from tbl_sales_order_hdr where salesid='".$_GET['id']."'");
$getInv=$quryinv->row();


?>
<div class="main-content">
<h1 class="page-title">Email</h1>
<!-- Breadcrumb -->
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Email Invoice</a></li> 

</ol>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">Email To Ramu</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
</ul>
</div>
<div class="panel-body">	
<form class="form-horizontal" method="post" action="insert_invoice">
<div class="form-group"> 
<label class="col-sm-2 control-label">From</label> 
<div class="col-sm-10"> 
<input type="hidden" placeholder="" name="id" class="form-control" readonly="" value="<?php echo $getInv->salesid?>" >
<input type="text" placeholder="" name="from" class="form-control" readonly="" value="info@techvyaserp.in" >
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Send To</label> 
<div class="col-sm-10"> 
<input type="text" placeholder="" name="send_to" class="form-control" required>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Cc</label> 
<div class="col-sm-10"> 
<input type="text" placeholder="" name="cc" class="form-control" >
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Subject</label> 
<div class="col-sm-10"> 
<input type="text" placeholder="" name="subject" class="form-control" value="Invoice-<?=$getInv->salesid?> from Tech Vyas" required > 
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Content</label> 
<div class="col-sm-10"> 
<textarea  placeholder="" id="tem" name="content" style="height:400px;" class="form-control"><?=$getInv->termandcondition;?>
</textarea>
</div> 
</div>



<div class="form-group"> 
<label class="col-sm-2 control-label">Pdf Attachment</label> 
<div class="col-sm-10"> 
<input type="checkbox" placeholder="" class="form-control" value="" required > 
</div> 
</div>






<div class="form-group">
<div class="col-sm-4"></div>
<button type="submit" class="btn btn-white">Cancel</button>
<button type="submit" class="btn btn-primary">Send</button>
</div>

</form>
</div>

</div><!--row close-->


<?php $this->load->view("footer.php");?>
<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=42epwf1jarbwose89sqt3dztyfu7961g4cs5xoib4kordvbd"></script>
  <script>tinymce.init({ selector:'#tem' });</script>