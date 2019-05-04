<b style="display:none">
<?php
$this->load->view("header.php");
?>
</b>
<div class="modal-header">

<h4 class="modal-title">View QC</h4>
</div>
<div class="modal-body overflow">
<?php 
$id=$_GET['ID'];
	$query=$this->db->query("select * from tbl_tailor where tailor_id='".$_GET['ID']."'");	
	$fetchq=$query->row();
	
	$queryfetch=$this->db->query("select * from tbl_qualitiy_check where tailor_id='".$_GET['ID']."'");	
	$fetchqrow=$queryfetch->row();
	$rows=$queryfetch->num_rows();
	

?>
<input type="hidden"  class="form-control" name="qc_id" value="<?php echo $fetchqrow->qc_id;?>" />
<input type="hidden"  class="form-control" name="tailor_id" value="<?php echo $_GET['ID'];?>" />
<table class="table table-striped table-bordered table-hover"  >
<thead>
<tr>
<th>Tailor Name</th>
<th>Checked Qty</th>
<th>Remaning Qty</th>
</tr>
</thead>
<tr>
<th>
<input type="hidden" name="contact_id" value="<?php echo $fetchq->customer_name;?>" />
<select name="contact_id1"  required id="contact_id_copy" class="form-control ui fluid search dropdown email" disabled="disabled">
		<option value="">Select</option>
		<?php
		$contQuery=$this->db->query("select * from tbl_contact_m where group_name='6'");
		foreach($contQuery->result() as $contRow)
		{
		?>
			<option value="<?php echo $contRow->contact_id; ?>" <?php if($contRow->contact_id==$fetchq->customer_name){ ?> selected="selected" <?php }?>>
			<?php echo $contRow->first_name; ?>
			</option>
			<?php } ?>
	</select>
</th>
<th>
<?php 
//echo $rows;
if($rows==0){?>0<?php }else{echo $check=$fetchqrow->qty;}
$tot=$fetchq->qty;
$rest=$tot-$check;
?>
</th>
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
