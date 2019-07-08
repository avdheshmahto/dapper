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
        <th class="tdcenter">Set Of</th>
        <th class="tdcenter">Cash Qty</th>
        <th class="tdcenter">Case Pack</th>
        <th class="tdcenter">Remaining Qty</th>
		<th class="tdcenter">Enter Qty</th>
        <th class="tdcenter">Packing Qty</th>
		
	</tr>
</thead>
<?php

		$productQuery=$this->db->query("select *from tbl_product_transfer_to_packing where lot_no='$lot_no'");
		$i=1;
		foreach($productQuery->result() as $getProduct){
		####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->frm_fg'");
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
<td>
<input type="hidden" name="productid[]" value="<?=$getProductStock->Product_id;?>" class="form-control" />

<input type="hidden" name="lot_no" value="<?=$lot_no;?>" class="form-control" />

<?=$getProductStock->sku_no;?>&<?=$getProductStock->productname;?>
</td>
<td><?=$getProductStock->qty_box;?></td>
<td><?=$getProductStock->packing;?></td>
<td id="sets<?=$i;?>"><?=$getProductStock->packing*$getProductStock->qty_box;?></td>
<td><input type="text" readonly="readonly"  class="form-control" value="<?=$getProduct->qty;?>" /></td>
<td><input type="text" id="qty<?=$i;?>" name="qty[]" onchange="calPacking(this.id);" class="form-control" /></td>
<td><input type="text" id="packing_qty<?=$i;?>" name="packing_qty[]" readonly="readonly" class="form-control" /></td>
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
        
        