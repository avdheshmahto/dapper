<?php
  $hdrQuery=$this->db->query("select * from tbl_receive_matrial_hdr where po_no='$po_id'");
  
  foreach($hdrQuery->result() as $getHdrQ)
  
  {
    $hdrPo[]=$getHdrQ->inboundid;
  }
  
  
  @$getHdrId=implode(",",$hdrPo);
  
  if($getHdrId!=''){
    $getHdrIdd=$getHdrId;
    
  }
  else
  {
    $getHdrIdd='0';
  }
  
  $getHdr=$hdrQuery->row();
  
  ?>
<!-- Main content -->
<div class="main-content">
  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4 class="panel-title">Challan Log</h4>
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
                      <th class="tdcenter">Challan No</th>
                      <th class="tdcenter">Item Number & Description</th>
                      <th class="tdcenter">UOM</th>
                      <th class="tdcenter">Issue Qty</th>
                      <th class="tdcenter">Issue Weight</th>
                      <th class="tdcenter" style="display:none">Remaining Qty</th>
                      <th class="tdcenter" style="display:none">Remaining Weight</th>
                    </tr>
                  </thead>
                  <?php
                    $productQuery=$this->db->query("select * from tbl_receivematrial_dtl where inboundrhdr in ($getHdrIdd) ");
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
                    <td class="tdcenter"><?php 
                      $hdrQuery=$this->db->query("select * from tbl_receive_matrial_hdr where inboundid='$getProduct->inboundrhdr'");
                      $getChno=$hdrQuery->row();
                      echo $getChno->challan_no;?>                      
                    </td>
                    <td class="tdcenter"><?=$getProductStock->sku_no;?>
                      <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                    </td>
                    <td class="tdcenter"><?=$getProductUOM->keyvalue;?></td>
                    <td class="tdcenter"><?=$getProduct->order_qty;?></td>
                    <td class="tdcenter"><?php echo round($getProduct->receive_qty,3);?></td>
                    <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->receive_qty-$getProduct->remaining_qty;?>" />
                    <td style="display:none"><?php echo $rmRR=$getProduct->order_qty-$getProduct->rem_order_qty;?></td>
                    <td style="display:none"><?php echo $rmR=round($getProduct->receive_qty-$getProduct->remaining_qty,3);?></td>
                  </tr>
                  <?php 
                    $ordQtyTot=$ordQtyTot+$getProduct->receive_qty;
                    
                    $remQtyTot=$remQtyTot+$getProduct->remaining_qty;
                    $i++;
                    } ?>
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
        &nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</a>
      </div>
    </div>
  </div>
</div>