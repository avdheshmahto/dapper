<table class="table table-striped table-bordered table-hover dataTables-example1">
<input type="hidden" name="module_name" value="Kora" />
<input type="hidden" name="order_type" value="Kora" />
<thead>
	<tr>
		<th>Part Code</th>
		<th>Finish Goods</th>
        <th>Order Qty</th>
        <th>Placed Qty</th>
        <th>Remaining Qty</th>
	</tr>
</thead>
<tbody>
<?php  	  
$queryProductShape=$this->db->query("select *from tbl_shape_part_mapping where product_id='$id' ");
$cnt=$queryProductShape->num_rows();
$i=1;
foreach($queryProductShape->result() as $getProductShape){

$jobQuery=$this->db->query("select sum(qty) as partQty from tbl_production_order_transfer_another_module where productid='$getProductShape->part_id' and module_name='Finish'");


$getJob=$jobQuery->row();
$getJob->partQty;
	
$queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->part_id'");
$getProduct=$queryProduct->row();



$queryTotRem=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_transfer_another_module where lot_no='$production_id' and productid='$getProductShape->part_id' and module_name='Finish'");
$getTotRem=$queryTotRem->row();

// grn part plus in quantity query

$queryGrn=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_log where lot_no='$production_id' and productid='$getProductShape->part_id' and grn_type='Finish Order' and process_ends='1'");
$getGrnQty=$queryGrn->row();
?>
<tr class="gradeU record">
	<td> <input class="form-control" style="margin-bottom:10px; border:none; width:80px;" value="<?=$getProduct->sku_no;?>" name="part[]"/>
         <input class="form-control" type="hidden" style="margin-bottom:10px;" value="<?=$getProduct->Product_id;?>" name="part_code[]"/>
</td>
<td>
<?php

$fgHdrQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where lot_no='$production_id' ");
$getfgHdr=$fgHdrQuery->row();
?>
<select name="fg[]" id="fg<?=$i;?>" class="form-control">
	<option value="">--Select--</option>
<?php
$fgQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='$getfgHdr->purchaseid' ");
	foreach($fgQuery->result() as $getFg){
		$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getFg->productid'");
		$getProduct=$productQuery->row();
?>
<option value="<?=$getProduct->Product_id?>"><?=$getProduct->sku_no;?></option>
<?php }?>
</select>
</td>
<td> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="qty[]" id="entQty<?=$i;?>" onchange="val(this.id)" /></td>
<td>  <input class="form-control" style="margin-bottom:10px; width:55px;" value="<?=$getJob->partQty;?>" id="orderQty<?=$i;?>" name="qtyy[]" readonly="readonly" /></td>
<td><?php
$remQty=$getJob->partQty-$getGrnQty->qty+$getTotRem->qty;
?>          <input class="form-control" style="margin-bottom:10px;width:55px;" value="<?=$remQty;?>" name="qtyy[]" id="remQty<?=$i;?>" readonly="readonly" />
</td>
</tr>
<?php $i++;}?>
</tbody>
<tfoot>
</tfoot>
</table>
<input type="hidden" name="cntVal" id="cntVal" value="<?=$cnt;?>" />
<div class="modal-footer_" id="button" style="display: block;text-align: right;">
<input type="button" class="btn btn-sm" id="add" onclick="addpricemap()" value="Add">
</div>  