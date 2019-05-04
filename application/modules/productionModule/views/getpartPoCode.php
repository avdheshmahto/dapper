<table class="table table-striped table-bordered table-hover dataTables-example1" >
    <thead>
      <tr>
        <th>Part Code</th>
        <th>Order Qty</th>
        <th>Placed Qty</th>
        <th>Remaining Qty</th>
      </tr>
    </thead>
    <tbody>
  <?php  	  


$productionqty=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$production_id'");
$getProduction=$productionqty->row();

$queryProductShape=$this->db->query("select *from tbl_shape_part_mapping where product_id='$id' ");
$cnt=$queryProductShape->num_rows();
$i=1;
foreach($queryProductShape->result() as $getProductShape){
	
	
$jobQuery=$this->db->query("select sum(qty) as partQty from tbl_job_work_log where production_id='$production_id' and shape_id='$id' and part_id='$getProductShape->part_id'");
$getJob=$jobQuery->row();
$getJob->partQty;
	

$queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->part_id'");
$getProduct=$queryProduct->row();
?>
      <tr class="gradeU record">
        <td> <input class="form-control" style="margin-bottom:10px; border:none; width:80px;" value="<?=$getProduct->sku_no;?>" name="part[]"/>
         <input class="form-control" type="hidden" style="margin-bottom:10px;" value="<?=$getProduct->Product_id;?>" name="part_code[]"/>
        </td>
        <td> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="qty[]" id="entQty<?=$i;?>" onchange="val(this.id)" /></td>
        <td>  <input class="form-control" style="margin-bottom:10px; width:55px;" value="<?=$getJob->partQty;?>" id="orderQty<?=$i;?>" name="qtyy[]" readonly="readonly" /></td>
        <td><?php
$remQty=$getProduction->sub_total-$getJob->partQty;
?>
      <input class="form-control" style="margin-bottom:10px;width:55px;" value="<?=$remQty;?>" name="qtyy[]" id="remQty<?=$i;?>" readonly="readonly" />
      
    </td>
      </tr>
      <?php $i++;}?>
    </tbody>
    <tfoot>
    </tfoot>
  </table>
  
  <input type="hidden" name="cntVal" id="cntVal" value="<?=$cnt;?>" />
<div class="modal-footer_" id="button" style="display: block;text-align: right;">
<input type="button" class="btn btn-sm" id="add" onclick="addpricemapPoOrder()" value="Add">
</div>  