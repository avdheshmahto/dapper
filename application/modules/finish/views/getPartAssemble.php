<table class="table table-striped table-bordered table-hover dataTables-example1">
  <input type="hidden" name="module_name" value="Assemble" />
  <input type="hidden" name="order_type" value="Assemble" />
  <thead>
    <tr>
      <th>Part Code</th>
      <th>Buyer Order Qty</th>
      <th>Finish Stock Qty</th>
      <th>Receive Qty</th>
    </tr>
  </thead>
  <tbody>
    <?php     
      $queryProductShape=$this->db->query("select *from tbl_shape_part_mapping where product_id='$id' ");
      $cnt=$queryProductShape->num_rows();
      $i=1;
      foreach($queryProductShape->result() as $getProductShape){
                     
      $jobQuery=$this->db->query("select sum(qty) as partQty from tbl_production_order_transfer_another_module where productid='$getProductShape->part_id' and module_name='Assemble'");
      $getJob=$jobQuery->row();

      $queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->part_id'");
      $getProduct=$queryProduct->row();
            
      $queryTotRem=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_transfer_another_module where lot_no='$production_id' and productid='$getProductShape->part_id' and module_name='Finish'");
      $getTotRem=$queryTotRem->row();
      
      // grn part plus in quantity query
      
      $queryGrn=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_log where lot_no='$production_id' and productid='$getProductShape->part_id' and grn_type='Finish Order' and process_ends='1'");
      $getGrnQty=$queryGrn->row();

      $boHdr=$this->db->query("select * from tbl_quotation_purchase_order_hdr where lot_no='$production_id'");
      $getBo=$boHdr->row();

      $boDtl=$this->db->query("select * from tbl_quotation_purchase_order_dtl where purchaseid='$getBo->purchaseid' AND productid='$fg' ");
      $getDtl=$boDtl->row();

      
    ?>
    <tr class="gradeU record">
      <td>
        <input class="form-control" style="margin-bottom:10px; border:none; width:100%;" value="<?=$getProduct->sku_no;?>" name="part[]" readonly>
        <input class="form-control" type="hidden" style="margin-bottom:10px;" value="<?=$getProduct->Product_id;?>" name="part_code[]">
      </td>          
      <td>
        <input class="form-control" style="margin-bottom:10px; width:100%;" value="<?=$getDtl->qty;?>" id="orderQty<?=$i;?>" name="qtyy[]" readonly="readonly" />
      </td>
      <td>
        <?php
        //$remQty=$getJob->partQty-$getGrnQty->qty+$getTotRem->qty;
        ?>          
        <input class="form-control" style="margin-bottom:10px;width:100%;" value="<?=$getJob->partQty;?>" name="qtyy[]" id="remQty<?=$i;?>" readonly="readonly" />
      </td>
      <td>
        <input class="form-control" style="margin-bottom:10px;width:100%;" value="" name="qty[]" id="entQty<?=$i;?>" onkeyup="val(this.id)" readonly="readonly" />
      </td>
    </tr>
    <?php $i++;}?>
  </tbody>
</table>
<input type="hidden" name="cntVal" id="cntVal" value="<?=$cnt;?>" />
<div class="modal-footer_" id="button" style="display: block;text-align: right;">
  <input type="button" class="btn btn-sm" id="add" onclick="addpricemap()" value="Add">
</div>