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
              <input type="text" name="invoice_no"  class="form-control" value="<?=$getOrder->date;?>" readonly="readonly" required />
            </div>
            <!--  <div class="col-sm-6" id="grnId" >
              <label for="po_order">GRN No.:</label>
                <input type="text" name="grn_no" class="form-control" required readonly="readonly" value="<?=$getHdr->grn_no;?>"  />
                             </div> -->
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <label for="po_order">Repair No.:</label>
              <input type="text" name="repair_no"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
            <div class="col-sm-6" id="invoiceId" >
              <label for="po_order">Repair Date</label>
              <input type="date" name="repair_date"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
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
              <th class="tdcenter">Receive Qty</th>
            </tr>
          </thead>
          <?php
            $productQuery=$this->db->query("select SUM(repair_qty) as qty,productid from tbl_production_order_check where order_no='$id' and repair_qty!='' group by productid");
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
              $inbountLogGRNLogQuery=$this->db->query("select SUM(qty) as rec_qty from tbl_production_order_repair where productid='$getProduct->productid' AND job_order_id = '$lot_no' and order_no='$id'");
              			$getInboundGRNLog=$inbountLogGRNLogQuery->row();
              
              
              			?>
            <input type="hidden" min="0" name="ord_qty[]" value="<?=$getProduct->qty;?>" class="form-control">
            <input type="hidden" min="0" name="rm_qty[]" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" class="form-control">
            <td><?=$getProduct->qty;?></td>
            <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" />
            <td><?php echo $reci_qty=$getProduct->qty-$getInboundGRNLog->rec_qty;?></td>
            <td style="display:none"><?=$getProductSerialStock->quantity;?></td>
            <td><input name="qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="number" min="0" class="form-control"<?php if($reci_qty==0){?> readonly="readonly" <?php }?> /></td>
          </tr>
          <?php 
            $i++;
            }?>
        </table>
      </div>
    </div>
  </div>
  <!--scrollbar-y close-->		
  <!-- <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid "> -->
  <!-- <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
    <table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >
    
    <tr></tr>
    </table> -->
  <!-- </div> -->
</div>
<div class="modal-footer">
  <input type="submit" class="btn btn-sm" id="add_req" value="Save">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>