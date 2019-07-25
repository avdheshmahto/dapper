<?php
  $dtlQuery=$this->db->query("select *from tbl_machine where machine_name='$id'");
  foreach($dtlQuery->result() as $getDtl){
  $hdrQuery=$this->db->query("select * from tbl_quotation_purchase_order_hdr where lot_no='$production_id'");
  $getHdr=$hdrQuery->row();
  
  $queryProductShape=$this->db->query("select SUM(total_price) as qty from tbl_quotation_purchase_order_dtl where productid ='$getDtl->code' and purchaseid='$getHdr->purchaseid'  ");
  $shapeCnt=$queryProductShape->row();
  $qtySum=$qtySum+$shapeCnt->qty."<br>";
  }
  
 
  
  ?>
<table class="table table-striped table-bordered table-hover dataTables-example1" >
  <thead>
    <tr>
      <th>Part Code</th>
      <th>Order Qty</th>
      <th>Net Weight</th>
      <th>Total Weight</th>
      <th>RM Rate per Kg</th>
      <th>Total Rm Amount</th>
      <th>Labour Rate per kg</th>
      <th>Total Labour Amount</th>
      <th>Total Cost</th>
      <th>Placed Qty</th>
      <th>Remaining Qty</th>
    </tr>
  </thead>
  <tbody>
    <?php     
      $productionqty=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$production_id'");
      $getProduction=$productionqty->row();
      
      $queryProductShape=$this->db->query("select *from tbl_shape_part_mapping where product_id='$id' group by part_id ");
      $cnt=$queryProductShape->num_rows();
      $i=1;
      foreach($queryProductShape->result() as $getProductShape){
        
        
		
      $jobQuery=$this->db->query("select sum(qty) as partQty from tbl_job_work_log where lot_no='$production_id' and shape_id='$id' and part_id='$getProductShape->part_id'");
      $getJob=$jobQuery->row();
      $getJob->partQty;
        
      
      $queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->part_id'");
      $getProduct=$queryProduct->row();
      ?>
    <tr class="gradeU record">
      <td> <input class="form-control" readonly="readonly" style="margin-bottom:10px; border:none; width:100px;" value="<?=$getProduct->sku_no;?>" name="part[]"/>
        <input class="form-control" type="hidden" style="margin-bottom:10px;" value="<?=$getProduct->Product_id;?>" name="part_code[]"/>
      </td>
      <td> <input type="number" min="0" class="form-control" style="margin-bottom:10px;width:55px;" value="" name="qty[]" id="entQty<?=$i;?>" onchange="val(this.id)" <?php if($shapeName=='Shape'){?> readonly="readonly"<?php } ?> /></td>
      <td> <input class="form-control" readonly="" style="margin-bottom:10px;width:55px;" value="<?=$getProduct->net_weight;?>" name="weight[]" id="weight<?=$i;?>"  /></td>
      <td> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="total_weight[]" id="total_weight<?=$i;?>" readonly="readonly"  /></td>
      <td> <input type="number" min="0" class="form-control" style="margin-bottom:10px;width:55px;" value="" name="rate[]" id="rate<?=$i;?>" onchange="RateCal(this.id)"  /></td>
      <td> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="total_rm_rate[]" id="total_rm_rate<?=$i;?>"  readonly="readonly" /></td>
      <td> <input type="number" min="0" class="form-control" style="margin-bottom:10px;width:55px;" value="" name="labour_rate[]" id="labour_rate<?=$i;?>" onchange="labourRateCal(this.id)"  /></td>
      <td> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="total_labour_rate[]" id="total_labour_rate<?=$i;?>" readonly="readonly"  /></td>
      <td>  <input class="form-control" style="margin-bottom:10px; width:55px;" value="<?=$getJob->total_cost;?>" id="total_cost<?=$i;?>" name="total_cost[]" readonly="readonly"  /></td>
      <td>  <input class="form-control" style="margin-bottom:10px; width:55px;" value="<?=$getJob->partQty;?>" id="orderQty<?=$i;?>" name="qtyy[]" readonly="readonly" /></td>
      <td><?php
        $remQty=$qtySum-$getJob->partQty;
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
  <input type="button" class="btn btn-sm" id="add" onclick="addpricemap()" value="Add">
</div>