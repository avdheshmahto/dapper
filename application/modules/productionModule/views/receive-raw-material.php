<?php
  $hdrQuery=$this->db->query("select * from tbl_receive_matrial_hdr where inboundid='$id'");
  $getHdr=$hdrQuery->row();
  ?>
<!-- Main content -->
<div class="main-content">
  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4 class="panel-title">Receive Qty</h4>
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
                      <label for="po_order">Production ORDER NO.:</label>
                      <input type="hidden" name="request_no" value="<?=$getHdr->request_no?>" />
                      <input type="hidden" name="req_production_id" value="<?=$po_no;?>" />
                      <select name="po_no"  class="form-control"  disabled="disabled"  required>
                        <?php $sqlPoQuery=$this->db->query("select * from tbl_quotation_purchase_order_hdr where purchaseid='$getHdr->po_no'");
                          $getPO=$sqlPoQuery->row();?>
                        <option value=""><?=$getPO->purchase_no;?></option>
                      </select>
                    </div>
                    <div class="col-sm-6" id="invoiceId" >
                      <label for="po_order">Date.:</label>
                      <input type="text" name="invoice_no"  class="form-control" value="<?=$getHdr->date;?>" readonly="readonly" required />
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
                      <th class="tdcenter">Qty In Stock</th>
                      <th class="tdcenter">Receive Qty</th>
                    </tr>
                  </thead>
                  <?php
                    $productQuery=$this->db->query("select productid,inboundrhdr,receive_qty from tbl_receivematrial_dtl where inboundrhdr='$id' group by productid");
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
                    $productStockSerialQuery=$this->db->query("select * from tbl_product_serial where product_id='$getProduct->productid'");
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
                    <td><?=$getProduct->receive_qty;?></td>
                    <?php
                      $inbountLogQuery=$this->db->query("select SUM(D.receive_qty) as rec_qty from tbl_issuematrial_dtl D,tbl_issuematrial_hdr H where D.inboundrhdr = H.inboundid AND D.productid='$getProduct->productid' AND H.po_no='$getHdr->po_no'");
                      	$getInbound=$inbountLogQuery->row();
                      
                            $inbountLogGRNQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_receivematrial_dtl where productid='$getProduct->productid' AND inboundrhdr = '$getProduct->inboundrhdr'");
                      	$getInboundGRN=$inbountLogGRNQuery->row();
                      
                      
                      
                      
                      $inbountLogGRNLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_receive_matrial_grn_log where productid='$getProduct->productid' AND po_no = '$po_no'");
                      	$getInboundGRNLog=$inbountLogGRNLogQuery->row();
                      
                      
                      	?>
                    <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getInboundGRN->rec_qty-$getInboundGRNLog->rec_qty;?>" />
                    <td><?=$getInboundGRN->rec_qty-$getInboundGRNLog->rec_qty;?></td>
                    <td><?=$getProductSerialStock->quantity;?></td>
                    <td><input name="qty[]" id="qty<?=$i;?>" onchange="qtyVal(this.id)" type="text" class="form-control" /></td>
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
        <input type="hidden" name="rows" id="rows">
        <!--//////////ADDING TEST/////////-->
        <input type="hidden" name="spid" id="spid" value="d1"/>
        <input type="hidden" name="ef" id="ef" value="0" />
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" >
            <tbody>
              <!-- 	<tr class="gradeA">
                <th>Sub Total</th>
                <th>&nbsp;</th>
                <th>
                <input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
                </th>
                </tr>
                
                
                
                      <tr class="gradeA">
                <th>Grand Total</th>
                <th>&nbsp;</th>
                <th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr class="gradeA">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                </tr>
                <tr class="gradeA">
                <th> -->
              <!-- <th>&nbsp;</th>
                <th >
                
                </th></th> -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class ="pull-right" id="saveDiv" >
        <input type="submit" class="btn btn-sm" id="add_req" value="Save">
        &nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
      </div>
    </div>
  </div>
</div>