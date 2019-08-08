<?php
  $orderQuery=$this->db->query("select *from tbl_job_work where id='$id'");
  $getOrder=$orderQuery->row();
  
  $issueQueryHdr=$this->db->query("select *from tbl_issuematrial_hdr where po_no='$id'");
  $getIssueHdr=$issueQueryHdr->row();
  
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
              <label for="po_order">RM Return No.:</label>
              <input type="text" name="return_no"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
            <div class="col-sm-6" id="invoiceId" >
              <label for="po_order">RM Return Date</label>
              <input type="date" name="return_date"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="table-responsive-">
    </div> -->
  <div class="" id="style-3-y">
    <div class="force-overflow-y">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover " >
          <thead>
            <tr>
              <th class="tdcenter">Sl No</th>
              <th class="tdcenter">Item Number & Description</th>
              <th class="tdcenter">UOM</th>
              <th class="tdcenter">Ordered Qty</th>
              <th class="tdcenter">Ordered Weight</th>
              <th class="tdcenter">Remaining Qty</th>
              <th class="tdcenter">Remaining Weight</th>
              <th class="tdcenter">Weight In Stock</th>
              <th class="tdcenter">Return Qty</th>
              <th class="tdcenter">Return Weight</th>
            </tr>
          </thead>
          <?php
 
            	$productQuery=$this->db->query("select * from tbl_issuematrial_dtl where inboundrhdr='$getIssueHdr->inboundid' group by productid");
            	$i=1;
            	foreach($productQuery->result() as $getProduct){

              ####issue Qty #############
              $rmHdr=$this->db->query("select * from tbl_receive_matrial_hdr where po_no='$getOrder->id' ");
              foreach ($rmHdr->result() as $rmDtl) 
              {
                $hdrPo[]=$rmDtl->inboundid;
              }
                            
              @$getHdrId=implode(",",$hdrPo);
              
              if($getHdrId!='')
              {
                $getHdrIdd=$getHdrId;              
              }
              else
              {
                $getHdrIdd='0';
              }
              
              $rmQtyDtl=$this->db->query("select SUM(order_qty) as cIssueQty, SUM(receive_qty) as cIssueWeight from tbl_receivematrial_dtl where inboundrhdr in ($getHdrIdd) ");
              $getChallan=$rmQtyDtl->row();


            	####### get product #######
            	$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->productid'");
            	$getProductStock=$productStockQuery->row();
            	####### ends ########
            	
            	####### get UOM #######
            	$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
            	$getProductUOM=$productUOMQuery->row();
            	####### ends ########
            	
            	?>
          <tr class="gradeX odd" role="row">
            <td class="size-60 text-center sorting_1"><?=$i;?></td>
            <td><?=$getProductStock->sku_no;?>
              <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
            </td>
            <td><?=$getProductUOM->keyvalue;?></td>            
            <td><?=$getProduct->order_qty;?></td>
            <td><?=$getProduct->receive_qty;?></td>
            <?php
                $inbountLogGRNLogQuery=$this->db->query("select SUM(qty) as rec_qty, SUM(total_weight) as rec_wgt from tbl_production_order_log where job_order_id = '$getOrder->id' and order_no='$getOrder->job_order_no'");
                $getInboundGRNLog=$inbountLogGRNLogQuery->row();
                
                $rmReturn=$this->db->query("select SUM(order_qty) as rt_qty, SUM(qty) as rt_wgt from tbl_job_rm_return where lot_no='$getOrder->lot_no' AND order_no='$getOrder->job_order_no' AND job_order_id='$getOrder->id' ");
                $getRMreturn=$rmReturn->row();
                ?>
            <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$rmRR=$getChallan->cIssueQty-$getInboundGRNLog->rec_qty-$getRMreturn->rt_qty;?>" />
            <td><?php 
              //echo $rmRR=$getProduct->order_qty-$getProduct->rem_order_qty;
              echo $rmRR=$getChallan->cIssueQty-$getInboundGRNLog->rec_qty-$getRMreturn->rt_qty;

              ?></td>
              <input type="hidden" id="rem_wgt<?=$i;?>" value="<?=$rmRR=$getChallan->cIssueWeight-$getInboundGRNLog->rec_wgt-$getRMreturn->rt_wgt;?>" />
            <td><?php 
              //echo $rmR=$getProduct->receive_qty-$getProduct->remaining_qty;
              echo $rmR=$getChallan->cIssueWeight-$getInboundGRNLog->rec_wgt-$getRMreturn->rt_wgt;

            ?></td>
            <td>
              <p id="qtyInStcok<?=$i;?>"><?=$getProductStock->quantity;?></p>
            </td>
            <td><input name="order_qty[]" id="order_qty<?=$i;?>" onkeyup="qtyValRmReturn(this.id)"  type="number" min="0" class="form-control"  /></td> 
            <td><input name="qty[]"  type="number" step="any"  id="qty<?=$i;?>" onchange="wgtValRmReturn(this.id)"  class="form-control" <?php if($$rmR=='0'){?> readonly="readonly" <?php }?> />
            </td>
          </tr>
          <?php 
            $ordQtyTot=$ordQtyTot+$getProduct->receive_qty;
            			$remQtyTot=$remQtyTot+$getProduct->remaining_qty;
              $i++;
            }?>
          <input type="hidden" name="qrd_qtyT" id="qrd_qtyT"  value="<?=$ordQtyTot;?>" />
          <input type="hidden" id="remQyT" value="<?=$remQtyTot;?>" />
          <input type="hidden" name="totToCom" id="totTocomp" />
        </table>
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <input type="submit" class="btn btn-sm" id="add_req" value="Save">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>