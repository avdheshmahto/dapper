<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Product</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Product Code:</label> 
<div class="col-sm-4"> 
	<?php 
					$query=$this->db->query("select * from tbl_product_stock order by Product_id desc");
					$fetchR=$query->row();
					
					$productId=$fetchR->Product_id+1;
	?>
			
<input type="hidden"  id="Product_id" value="<?php echo $branchFetch->Product_id; ?>" />
<input id="add_new_product" type="hidden" class="span6 " value="<?php echo $_GET['add'];?>" />
<input type="text" class="form-control" id="sku_no" value="<?php echo $productId; ?>" readonly> 
</div> 
<label class="col-sm-2 control-label">*Product Name:</label> 
<div class="col-sm-4"> 
<input id="item_name"  type="text" value="<?php echo $branchFetch->productname; ?>" class="form-control" required> 
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Category:</label> 
<div class="col-sm-4"> 
<select id="category" required  class="form-control ui fluid search dropdown email">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where main_prodcatg_id='121'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"><?php echo $fetchgroup->prodcatg_name ; ?></option>

    <?php } ?></select>
</div> 
<label class="col-sm-2 control-label">*Usages Unit:</label> 
<div class="col-sm-4" id="regid"> 
<select id="contact_id_copy1" required class="form-control"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
					<option value="" selected disabled>----Select Unit----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
				<option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Size:</label> 
<div class="col-sm-4"> 
<input id="size[]"  type="text" value="<?php echo $branchFetch->size; ?>" class="form-control" required> 
</div>
 
<label class="col-sm-2 control-label">*Sale Price:</label> 
<div class="col-sm-4"> 
<select id="color[]"  required class="form-control" multiple>
					<option value="" selected disabled>----Select Unit----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=23");
						foreach ($sqlunit->result() as $fetchunit){
						$explode=explode(",",$branchFetch->color);
					?>
				<option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div> 
</div>

<div class="form-group"> 

<label class="col-sm-2 control-label">*Purchase Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" id="unitprice_purchase" min="1" step="any" value="<?php echo $branchFetch->unitprice_purchase; ?>" class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Sale Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" id="unitprice_sale" min="1" step="any" value="<?php echo $branchFetch->unitprice_sale; ?>" class="form-control" required>
</div> 
</div>


<div class="form-group"> 

<label class="col-sm-2 control-label">*HSN Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" id="hsn_code"  value="<?php echo $branchFetch->hsn_code; ?>" class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*GST Tax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" id="gst_tax" min="1" step="any" value="<?php echo $branchFetch->gst_tax; ?>" class="form-control" required>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4" id="regid"> 
<input type="file" id="image_name" accept="image/*" onchange="loadFile(event)" />
</div> 
<label class="col-sm-2 control-label">Minimum Reorder Level:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" id="min_re_order_level" min="1" step="any" value="<?php echo $branchFetch->min_re_order_level; ?>" class="form-control" >
</div> 
</div>

</div>
<div class="modal-footer">
<input type="button" onClick="return formSubmit();" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>