<b style="display:none">
<?php
$this->load->view("header.php");
?>
</b>

<div class="modal-header">
<h4 class="modal-title">View Packing</h4>
</div>
<div class="modal-body overflow">
<?php 

	$query=$this->db->query("select * from tbl_qualitiy_check where qc_id='".$_GET['ID']."'");	
	$fetchq=$query->row();
	
	$queryfetch=$this->db->query("select * from tbl_packing where qc_id='".$_GET['ID']."'");	
	$fetchqrow=$queryfetch->row();
	$rows=$queryfetch->num_rows();
	
	$query111=$this->db->query("select * from tbl_tailor where tailor_id='$fetchq->tailor_id'");	
	$fetchqrow111=$query111->row();
	$fetchqrow111->production_id;
?>
<input type="hidden"  class="form-control" name="production_id" value="<?php echo $fetchqrow111->production_id;?>" />
<input type="hidden"  class="form-control" name="packing_id" value="<?php echo $fetchqrow->packing_id;?>" />
<input type="hidden"  class="form-control" name="qc_id" value="<?php echo $_GET['ID'];?>" />
<table class="table table-striped table-bordered table-hover"  >
<thead>
<tr>
<th>Packed Qty</th>
<th>Remaining Qty</th>
</tr>
</thead>
<tr>
<th><?php 
//echo $rows;
if($rows==0){?>0<?php }else{echo $check=$fetchqrow->qty;}
$tot=$fetchq->qty;
$rest=$tot-$check;
?></th>
<th><?php echo $rest;?></th>
</tr>
</table>

</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th><a onclick="popupclose(this.value)" class="btn btn-secondary  btn-sm">Cancel</a></th>
</tr>
</tbody>
</table>
</div>


