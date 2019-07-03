<?php
$orderQuery=$this->db->query("select *from tbl_assemble_fg where lot_no='$lot_no'");
$getOrder=$orderQuery->row();
?>
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="form-group">
<div class="col-sm-6">
<input type="hidden" name="grn_type" value="<?=$getOrder->order_type;?>" />
<input type="hidden" name="job_order_id" value="<?=$getOrder->id;?>" />
<input type="hidden" name="vendor_id" value="<?=$getOrder->vendor_id;?>" />
<label for="po_order">Order No.:</label>
<input type="hidden" name="lot_no" value="<?=$getOrder->lot_no;?>" />
<input type="hidden" name="order_type" value="<?=$order_type;?>" />
<input type="hidden" name="request_no" value="<?=$getHdr->request_no?>" />
<input type="hidden" name="req_production_id" value="<?=$po_no;?>" />
<input type="text" name="order_no"  class="form-control" value="<?=$getOrder->job_order_no;?>" readonly="readonly" required />
</div>
<div class="col-sm-6" id="invoiceId" >
<label for="po_order">Order Date:</label>
<input type="text" name="invoice_no"  class="form-control" value="<?=$getOrder->date;?>" readonly="readonly" required />
</div>
</div>
<div class="form-group">
<div class="col-sm-6">
<label for="po_order">GRN No.:</label>
<input type="text" name="grn_no"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
</div>
<div class="col-sm-6" id="invoiceId" >
<label for="po_order">GRN Date</label>
<input type="date" name="grn_date"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
</div>
</div>
</div>
</div>
</div>
</div>
<div class="" id="style-3-y">
<div class="force-overflow-y">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover " >
<thead>
	<tr>
		<th class="tdcenter"> Sl No</th>
		<th class="tdcenter">Item Number & Description</th>
        <th class="tdcenter">Item Number & Description</th>
		<th class="tdcenter">Qty</th>
		
	</tr>
</thead>
<?php
		
		$productQuery=$this->db->query("select *from tbl_product_inspection where lot_no='$lot_no' and type='Inspection' group by lot_no");
		$i=1;
		foreach($productQuery->result() as $getProduct){
		####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->part_id'");
		$getProductStock=$productStockQuery->row();
		####### ends ########
		
		####### get UOM #######
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########

		####### get product serial #######
		$productStockSerialQuery=$this->db->query("select * from tbl_product_serial where product_id='$getProduct->part_id'");
		$getProductSerialStock=$productStockSerialQuery->row();
		####### ends ########
?>
<tr class="gradeX odd" role="row">
<td class="size-60 text-center sorting_1"><?=$i;?></td>
<td><select name="" class="form-control">
<option value="">--select--</option>
<?php
$queryData=$this->db->query("select *from tbl_product_inspection where lot_no='$lot_no' and type='Inspection' group by lot_no ");
foreach($queryData->result() as $fetch_list)
{
//product query
$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$fetch_list->product_id'");
$getProduct=$productQuery->row();	
?>
<option value="<?=$getProduct->Product_id;?>"><?=$getProduct->productname;?></option>
<?php
}?>
</select>
</td>
<td><select name="" class="form-control">
<option value="">--select--</option>
<?php
$queryData=$this->db->query("select *from tbl_product_inspection where lot_no='$lot_no' and type='Inspection' group by lot_no ");
foreach($queryData->result() as $fetch_list)
{
//product query
$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$fetch_list->product_id'");
$getProduct=$productQuery->row();	
?>
<option value="<?=$getProduct->Product_id;?>"><?=$getProduct->productname;?></option>
<?php
}?>
</select>
</td>
<td><input type="text" class="form-control" /></td>
</td>
</tr>
<?php 
$i++;
}?>
</table>
</div>	  
</div>
</div><!--scrollbar-y close-->		
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" id="add_req" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>       
        
        