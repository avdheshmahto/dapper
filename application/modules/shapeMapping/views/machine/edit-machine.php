<?php
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update Shape</h4>
</div>
<div class="modal-body overflow">
<?php
	 $ItemQuery=$this->db->query("select * from tbl_machine where id='$ID'");
     $fetch_list=$ItemQuery->row();

?>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Item Name:</label> 
<div class="col-sm-4"> 
<select  class="form-control"  required name="item_name" id="item_name" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=14");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" <?php if($fetch_list->machine_name == $sdt['Product_id']){?>selected="selected"<?php }  ?>><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>	
<input type="hidden"  name="id" value="<?=$fetch_list->id;?>" /> 
</div> 

<label class="col-sm-2 control-label">*Shape Name</label> 
<div class="col-sm-4"> 
<select  class="form-control" required name="shape_name" id="shape_name" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=33");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" <?php if($fetch_list->code == $sdt['Product_id']) { ?>selected<?php } ?> ><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>			
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label" >Description:</label> 
<div class="col-sm-4"> 
<textarea name="shape_desc" class="form-control" id="shape_desc"><?=$fetch_list->machine_des;?></textarea>
</div>  
</div>

<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save" ></button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>