<?php
$orderQuery=$this->db->query("select *from tbl_job_work where job_order_no='$id'");
$getOrder=$orderQuery->row();
//echo $getOrder->qty."-".$getOrder->part_id;
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
<label for="po_order">Order Date.:</label>
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
	<th class="tdcenter">Scrap Name</th>
	<th class="tdcenter">UOM</th>
	<th class="tdcenter">Ordered Qty</th>
    <th class="tdcenter">Weight Qty</th>
	<th class="tdcenter">Remaining Qty</th>
	<th class="tdcenter" style="display:none">Qty In Stock</th>
	<th class="tdcenter">Receive Qty</th>
</tr>
</thead>
        
      <?php
		$productQuery=$this->db->query("select *from tbl_job_work_log where job_order_no='$id'");
		$i=1;
		foreach($productQuery->result() as $getProduct){
		
		####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->part_id'");
		$getProductStock=$productStockQuery->row();
		####### ends ########
		
		###### get Part #####
		
		$productPartQuery=$this->db->query("select * from tbl_part_price_mapping where part_id='$getProductStock->Product_id'");
		$getProductPart=$productPartQuery->row();
		
		##### ends #####

		####### get RM #######
		
		$productStockRMQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProductPart->rowmatial'");
		$getProductRMStock=$productStockRMQuery->row();
		####### ends ########
		
		
		
		####### get product serial #######
		$productScrapQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProductPart->rowmatial'");
		$getProductScrapStock=$productScrapQuery->row();
		####### ends ########
		
		
		####### get product serial #######
		
		$producttScrapQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProductScrapStock->scrap_id'");
		$getProducttScrapStock=$producttScrapQuery->row();
		####### ends ########
		
			####### get UOM #######
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProducttScrapStock->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########
		?>
<tr class="gradeX odd" role="row">
	<td class="size-60 text-center sorting_1"><?=$i;?></td>
	<td><?=$getProductRMStock->sku_no;?>
	<input type="hidden"  name="productid[]" value="<?=$getProducttScrapStock->Product_id;?>" class="form-control">
	</td>
	<td><?=$getProducttScrapStock->sku_no;?>
	<td><?=$getProductUOM->keyvalue;?></td>
<?php
			  $poLogQuery=$this->db->query("select D.qty as po_qty,SUM(M.qty) as mqty from tbl_quotation_purchase_order_dtl D,tbl_part_price_mapping M,tbl_machine MM where MM.machine_name = D.productid AND MM.id = M.machine_id AND D.purchaseid='$getHdr->po_no' and M.rowmatial='$getProduct->productid' AND M.type ='part'");
			  $getPoQty=$poLogQuery->row();
?>
<?php
$inbountLogGRNLogQuery=$this->db->query("select SUM(qty) as rec_qty from tbl_production_order_log where productid='$getProduct->part_id' AND job_order_id = '$lot_no' and order_no='$id'");
$getInboundGRNLog=$inbountLogGRNLogQuery->row();

$jobQuery=$this->db->query("select *from tbl_job_work where job_order_no = '$id' ");
$getJob=$jobQuery->row();
$getJob->qty;
?>
<input type="hidden" min="0" name="ord_qty[]" value="<?=$getProduct->qty;?>" class="form-control">
<input type="hidden" min="0" name="rm_qty[]" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" class="form-control">
<td><?=$getProduct->qty;?></td>
<td><?=$getProductPart->qty*$getProduct->qty;?></td>
<input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" />

<?php
####### get remaining qty #######
$productRemainingQuery=$this->db->query("select * from tbl_job_work_scrap where order_no='$id' and productid='$getProducttScrapStock->Product_id'");
$getProductRemainingQty=$productRemainingQuery->row();
####### ends ########

?>


<td><?=$getProductPart->qty*$getProduct->qty-$getProductRemainingQty->qty;?></td>
<td style="display:none"><?=$getProductSerialStock->quantity;?></td>
<td>
<input name="tolerance_percentage[]" id="tolerance_percentage<?=$i;?>"  type="hidden" class="form-control" value="<?=$getProductStock->tolerance_percentage;?>"/>
<input name="qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="text" class="form-control" />
<input type="text" style="display:none" name="process_ends[]" value="1" />
</td>
</tr>
<?php 
$i++;
}?>
</table>
</div>	  
</div>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" id="add_req" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>       
        
        