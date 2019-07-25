<?php
  $orderQuery=$this->db->query("select *from tbl_job_work where job_order_no='$id'");
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
              <label for="po_order">Order Date.:</label>
              <input type="text" name="check_date"  class="form-control" value="<?=$getOrder->date;?>" readonly="readonly" required />
            </div>
            <!--  <div class="col-sm-6" id="grnId" >
              <label for="po_order">GRN No.:</label>
                <input type="text" name="grn_no" class="form-control" required readonly="readonly" value="<?=$getHdr->grn_no;?>"  />
                             </div> -->
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <label for="po_order">Check No.:</label>
              <input type="text" name="check_no"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
            <div class="col-sm-6" id="invoiceId" >
              <label for="po_order">Check Date</label>
              <input type="date" name="check_date"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
            <!--  <div class="col-sm-6" id="grnId" >
              <label for="po_order">GRN No.:</label>
                <input type="text" name="grn_no" class="form-control" required readonly="readonly" value="<?=$getHdr->grn_no;?>"  />
                             </div> -->
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
              <th class="tdcenter"> Sl No</th>
              <th class="tdcenter">Item Number & Description</th>
              <th class="tdcenter">UOM</th>
              <th class="tdcenter">Ordered Qty</th>
              <th class="tdcenter">Remaining Qty</th>
              <th style="display:none" class="tdcenter">Qty In Stock</th>
              <th class="tdcenter">Transfer Qty</th>
              <th class="tdcenter">Repair Qty</th>
              <th class="tdcenter">Scrap Qty</th>
              <th class="tdcenter">Checked By</th>
            </tr>
          </thead>
          <?php
            $productQuery=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_log where order_no='$id' and grn_type='Job Order' group by productid");
            $i=1;
            foreach($productQuery->result() as $getProduct){
            ####### get product #######
            $productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->productid'");
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
            <td><?=$getProductStock->sku_no;?>
              <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
            </td>
            <td><?=$getProductUOM->keyvalue;?></td>
            <?php
              // select M.*,S.Product_id,S.quantity,S.usageunit,S.productname,S.Product_id from tbl_part_price_mapping M,tbl_product_stock S,tbl_machine MM where M.rowmatial = S.Product_id AND MM.id = M.machine_id AND MM.machine_name = $pid 
              
              $poLogQuery=$this->db->query("select D.qty as po_qty,SUM(M.qty) as mqty from tbl_quotation_purchase_order_dtl D,tbl_part_price_mapping M,tbl_machine MM where MM.machine_name = D.productid AND MM.id = M.machine_id AND D.purchaseid='$getHdr->po_no' and M.rowmatial='$getProduct->productid' AND M.type ='part'");
              $getPoQty=$poLogQuery->row();
              
              
              ?>
            <?php
              $inbountLogGRNLogQuery=$this->db->query("select SUM(transfer_qty) as rec_qty from tbl_production_order_check where productid='$getProduct->productid' AND job_order_id = '$lot_no' and order_no='$id'");
              			$getInboundGRNLog=$inbountLogGRNLogQuery->row();
              
              
              			?>
            <input type="hidden" min="0" name="ord_qty[]" value="<?=$getProduct->qty;?>" class="form-control">
            <input type="hidden" min="0" name="rm_qty[]" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" class="form-control">
            <td><?=$getProduct->qty;?></td>
            <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" />
            <td><?php echo $reci_qty=$getProduct->qty-$getInboundGRNLog->rec_qty;?></td>
            <td style="display:none"><?=$getProductSerialStock->quantity;?></td>
            <td><input name="transfer_qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="text" class="form-control"<?php if($reci_qty==0){?> readonly="readonly" <?php }?> /></td>
            <td><input name="repair_qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="text" class="form-control"<?php if($reci_qty==0){?> readonly="readonly" <?php }?> /></td>
            <td><input name="scrap_qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="text" class="form-control"<?php if($reci_qty==0){?> readonly="readonly" <?php }?> />
            
           <input name="test_qty[]" type="hidden"    class="form-control" /> 
            </td>
            <td><input name="name[]"   type="text" class="form-control" /></td>
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