<?php
$queryData=$this->db->query("select *from tbl_job_work where id='$id'");
$getData=$queryData->row();
?>
<form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myFinish_inspection" action="#" 
onsubmit="return submitFinishInspection();"method="POST"> 
<div class="modal-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th rowspan="2">Check Point</th>
<th rowspan="2" >Description</th>
</tr>
<tr class="gradeA">
<input type="hidden" name="productionid" value="<?=$_GET['id'];?>">
</tr>
<tr class="gradeA" data-row-id="<?php echo $getProduction->purchaseorderid; ?>">
<th style="width:180px;">
<input type="hidden" name="p_id[]" value="<?php echo $getDeliveryPeriod->product_id; ?>">
<select class="form-control" name="check_point" required>
<option value="">--Select--</option>
<option value="Pass">Pass</option>
<option value="Fail">Fail</option>
</select></th>
<th style="width:200px;" >
<input type="text" name="specification[]" value="<?=$getDeliveryPeriod->specification;?>"  class="form-control"></th>
</tr>
</tbody>
</table>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" id="add_req" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>   
</div>
</div>
