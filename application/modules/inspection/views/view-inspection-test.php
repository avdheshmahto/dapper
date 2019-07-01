<?php
$queryData=$this->db->query("select *from tbl_job_work where id='$id'");
$getData=$queryData->row();
?>
<div class="modal-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th rowspan="2">Testing Qty.</th>
<th rowspan="2">Remaining Qty.</th>
<th rowspan="2">Enter Tested Qty</th>
<th rowspan="2">Check Point</th>
<th rowspan="2" >Description</th>
</tr>
<tr class="gradeA">
<input type="hidden" name="lot_no" value="<?=$lot_no;?>">
<input type="hidden" name="order_no" value="<?=$order_no;?>">

<input type="hidden" name="type" value="Inspection" />
</tr>
<tr class="gradeA">
<th><input type="text" readonly="readonly"  value="<?=$qty;?>" class="form-control" /></th>
<?php
// this query is for geeting remaning qty
$queryRem=$this->db->query("select SUM(qty) as qty from tbl_product_inspection where lot_no='$lot_no' and product_id='$p_id' and order_no='$order_no' and type='Inspection'");
$getRem=$queryRem->row();
//
?>
<th><input type="text" readonly="readonly" id="rem_qty"  value="<?=$qty-$getRem->qty;?>" class="form-control" /></th>
<th><input type="text"  name="qty" id="qty" value="" class="form-control" onkeyup="qtyValidation();" required /></th>
<th>
<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
<select class="form-control" name="check_point" required>
<option value="">--Select--</option>
<option value="Pass">Pass</option>
<option value="Fail">Fail</option>
</select></th>
<th>
<textarea name="description"  class="form-control"></textarea></th>
</tr>
</tbody>
</table>


<div class="modal-footer">
<?php
if($qty-$getRem->qty=='0')
{
?>

<?php
}
else
{?>
<input type="submit" class="btn btn-sm" id="submit_btn" value="Save">
<?php }?>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>   
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<caption>Test List</caption>
<tbody>
<tr class="gradeA">
<th rowspan="2">Tested Qty</th>
<th rowspan="2">Check Point</th>
<th rowspan="2" >Description</th>
</tr>
<?php
$testList=$this->db->query("select *from tbl_product_inspection where lot_no='$lot_no' and product_id='$p_id' and order_no='$order_no'");
foreach($testList->result() as $getList){
?>
<tr class="gradeA">
</tr>
<tr class="gradeA" >
<th><?=$getList->qty;?></th>
<th>
<?=$getList->check_point;?></th>
<th>
<?=$getList->description;?></th>
</tr>
<?php }?>
</tbody>
</table>

</div>

</div>
