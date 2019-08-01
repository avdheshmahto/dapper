<?php
  $hdrQuery=$this->db->query("select * from tbl_issuematrial_hdr where inboundid='$id'");
  $getHdr=$hdrQuery->row();
  //echo $po_id;
  ?>
<!-- Main content -->
<div class="main-content">
  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4 class="panel-title">Raw Material Issue</h4>
          <ul class="panel-tool-options">
            <li><a href="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <label for="po_order">REQUEST ID:</label>
                      <input type="text" class="form-control" readonly="readonly" name="request_no" value="<?=$getHdr->request_no?>" />
                      <input type="hidden" name="req_production_id" value="<?=$po_id;?>" />
                      <input type="hidden" name="ismHdrid" value="<?=$id;?>" />
                      <select name="po_no" style="display:none"  class="form-control"  disabled="disabled"  required>
                        <?php $sqlPoQuery=$this->db->query("select * from tbl_quotation_purchase_order_hdr where purchaseid='$getHdr->po_no'");
                          $getPO=$sqlPoQuery->row();?>
                        <option value=""><?=$getPO->purchase_no;?></option>
                      </select>
                    </div>
                    <div class="col-sm-6" id="invoiceId" >
                      <label for="po_order">Date.:</label>
                      <input type="text" name="invoice_no"  class="form-control" value="<?=$getHdr->date;?>" readonly="readonly" required />
                    </div>
                    <div class="col-sm-6" id="invoiceId" >
                      <label for="po_order">Challan No.:</label>
                      <input type="text" name="challan_no"  class="form-control" value=""  required />
                    </div>
                    <div class="col-sm-6" id="invoiceId" >
                      <label for="po_order">Challan Date.:</label>
                      <input type="date" name="challan_date"  class="form-control" value=""  required />
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
                      <th class="tdcenter">Qty In Stock</th>
                      <th class="tdcenter">Issue Qty</th>
                      <th class="tdcenter">Weight Qty</th>
                    </tr>
                  </thead>
                  <?php
                    
                    	//$productQuery=$this->db->query("select productid,inboundrhdr,receive_qty,remaining_qty,order_qty,rem_order_qty from tbl_issuematrial_dtl where inboundrhdr='$id' group by productid");
                  $productQuery=$this->db->query("select * from tbl_issuematrial_dtl where inboundrhdr='$id' ");
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
                    	
                    	?>
                  <tr class="gradeX odd" role="row">
                    <td class="size-60 text-center sorting_1"><?=$i;?></td>
                    <td><?=$getProductStock->sku_no;?>
                      <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                    </td>
                    <td><?=$getProductUOM->keyvalue;?></td>
        
                    <td><?=$getProduct->order_qty;?></td>
                    <td><?php echo round($getProduct->receive_qty,3);?></td>
                    
                    <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->receive_qty-$getProduct->remaining_qty;?>" />
                    <td><?php echo $rmRR=$getProduct->order_qty-$getProduct->rem_order_qty;?></td>
                    <td><?php echo $rmR=round($getProduct->receive_qty-$getProduct->remaining_qty,3);?></td>
                    <td>
                      <p id="qtyInStcok<?=$i;?>"><?=$getProductStock->quantity;?></p>
                    </td>
                    <td><input name="order_qty[]" id="order_qty<?=$i;?>"  type="number" min="0" class="form-control"  /> 
                    <td><input name="qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="number" min="0" class="form-control" <?php if($$rmR=='0'){?> readonly="readonly" <?php }?> />
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
       
      </div>
      <div class ="pull-right" id="saveDiv" >
        <input type="submit" class="btn btn-sm" id="add" value="Save">
        &nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
      </div>

    </div>
  </div>
</div>