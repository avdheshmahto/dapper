<?php
  $orderQuery=$this->db->query("select * from tbl_job_work where id='$id'");
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
              <input type="hidden" name="storage_location" value="1" />
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
              <label for="po_order">GRN No.:</label>
              <input type="text" name="grn_no"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
            <div class="col-sm-6" id="invoiceId" >
              <label for="po_order">GRN Date</label>
              <input type="date" name="grn_date"  class="form-control" value="<?=$getOrder->order_receive_date;?>"  required />
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <?php
              $productQuery=$this->db->query("select * from tbl_job_work_log where lot_no='$getOrder->lot_no' AND job_order_no='$getOrder->job_order_no' AND shape_id='$getOrder->shape_id' group by rm_id");
              $j=1;
              foreach($productQuery->result() as $getProduct) { ?>
            <tr>
              <th><?php 
              $rm=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->rm_id'");
              $getRm=$rm->row();              
              ?>
              <input type="text" value="<?=$getRm->sku_no;?>" class="form-control" readonly>
              <input type="text" id="rmIssueId<?=$j?>" name="rmIssueId[]" value="<?=$getProduct->rm_id;?>" style="display: none;">
              </th>
              <?php

              $PoLog=$this->db->query("select SUM(total_weight) as rec_weight from tbl_production_order_log where lot_no='$getOrder->lot_no' AND job_order_id='$getOrder->id' AND order_no='$getOrder->job_order_no' AND rm_id='$getProduct->rm_id' ");
                $getPoLog=$PoLog->row();

                $rmRtrn=$this->db->query("select SUM(order_qty) as rt_qty, SUM(qty) as rt_wgt from tbl_job_rm_return where lot_no='$getOrder->lot_no' AND order_no='$getOrder->job_order_no' AND job_order_id='$getOrder->id' AND productid='$getProduct->rm_id' ");
                $getRMrtrn=$rmRtrn->row();

              $isRM=$this->db->query("select * from tbl_issuematrial_hdr where job_order_no='$getProduct->job_order_no' ");
              $getIsRM=$isRM->row();

              $isRMdtl=$this->db->query("select * from tbl_issuematrial_dtl where inboundrhdr='$getIsRM->inboundid' AND productid='$getProduct->rm_id' ");
              $getRmDtl=$isRMdtl->row();
              if($getRmDtl->remaining_qty != '')
              {
                $jobIssueWeight=$getRmDtl->remaining_qty-$getPoLog->rec_weight-$getRMrtrn->rt_wgt;
              }
              else
              {
                $jobIssueWeight=0; 
              }

              ?>
               <td><input type="text" id="rmIssueWgt<?=$j?>" class="form-control" value="<?=$jobIssueWeight?>"  readonly></td> 
             </tr>
           <?php $j++; } ?>
          </thead>
        </table>
      </div>
    </div>
  </div>


    <div class="" id="style-3-y">
      <div class="force-overflow-y__">
        <div class="table-responsive__">
          <table class="table table-striped table-bordered table-hover" >
            <thead>
              <tr>
                <th class="tdcenter">Sl No</th>
                <th class="tdcenter">Item Number & Description</th>
                <th class="tdcenter">UOM</th>
                <th class="tdcenter">Ordered Qty</th>
                <!-- <th class="tdcenter">Issue Qty</th>
                <th class="tdcenter">Return Qty</th> -->
                <th class="tdcenter">GRN Qty
                <th class="tdcenter">Remaining GRN Qty</th>
                <th style="display:none" class="tdcenter">Qty In Stock</th>
                <th class="tdcenter">Receive Qty</th>
                <th class="tdcenter">Total Weight</th>
                <th class="tdcenter">Ideal Net Weight</th>
                <th class="tdcenter">Net Weight</th>
                <th style="display:none" class="tdcenter">RM rate per kg</th>
                <th style="display:none" class="tdcenter">Total Rm Amount</th>
                <th style="display:none" class="tdcenter">Labour rate per kg</th>
                <th style="display:none" class="tdcenter">Total labour amount</th>
                <th style="display:none" class="tdcenter">Total cost</th>
              </tr>
            </thead>
            <?php
              $productQuery=$this->db->query("select * from tbl_job_work_log where lot_no='$getOrder->lot_no' AND job_order_no='$getOrder->job_order_no' AND shape_id='$getOrder->shape_id' ");
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
              $productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->part_id'");
              $getProductStock=$productStockQuery->row();
              ####### ends ########

              ###### get Part #####

              $productPartQuery=$this->db->query("select * from tbl_part_price_mapping where part_id='$getProductStock->Product_id'");
              $getProductPart=$productPartQuery->row();


              ##### ends #####

              ####### get UOM #######
              $productUOMQuery=$this->db->query("select * from tbl_master_data where serial_number='$getProductStock->usageunit'");
              $getProductUOM=$productUOMQuery->row();
              ####### ends ########


              ####### get product serial #######
              $productStockSerialQuery=$this->db->query("select * from tbl_product_serial where product_id='$getProduct->part_id'");
              $getProductSerialStock=$productStockSerialQuery->row();
              ####### ends ########

              $rm=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->rm_id'");
              $getRm=$rm->row();

              ?>
            <tr class="gradeX odd" role="row">
              <td class="size-60 text-center sorting_1"><?=$i;?></td>
              <td class="tdcenter" style="width: 20%;"><?=$getProductStock->sku_no ."  (".$getRm->sku_no.")";?>
                <input type="hidden"  name="productid[]" value="<?=$getProduct->part_id;?>" class="form-control">
                <input type="hidden"  name="rmOrdId[]" id="rmOrdId<?=$i?>" value="<?=$getProduct->rm_id;?>" class="form-control">
              </td>
              <td class="tdcenter"><?=$getProductUOM->keyvalue;?></td>
              <?php
                $inbountLogGRNLogQuery=$this->db->query("select SUM(qty) as rec_qty from tbl_production_order_log where productid='$getProduct->part_id' AND job_order_id = '$getOrder->id' and order_no='$getOrder->job_order_no'");
                $getInboundGRNLog=$inbountLogGRNLogQuery->row();

                $rmReturn=$this->db->query("select SUM(order_qty) as rt_qty, SUM(qty) as rt_wgt from tbl_job_rm_return where lot_no='$getOrder->lot_no' AND order_no='$getOrder->job_order_no' AND job_order_id='$getOrder->id' ");
                $getRMreturn=$rmReturn->row();

                ?>
              <input type="hidden" min="0" name="ord_qty[]" value="<?=$getProduct->qty;?>" class="form-control">
              <input type="hidden" min="0" name="rm_qty[]" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" class="form-control">
              <td class="tdcenter"><?=$getProduct->qty;?></td>
              <!-- <td><?=$getChallan->cIssueQty;?></td>
              <td><?=$getRMreturn->rt_qty;?></td> -->
              <td class="tdcenter"><?=$getInboundGRNLog->rec_qty;?></td>
              <input type="hidden" id="rem_qty<?=$i;?>" value="<?=$getProduct->qty-$getInboundGRNLog->rec_qty;?>" />
              <td class="tdcenter"><?php echo $reci_qty=$getProduct->qty-$getInboundGRNLog->rec_qty;?></td>
              <td style="display:none"><?=$getProductSerialStock->quantity;?></td>
              <td class="tdcenter">
                <input name="tolerance_percentage[]" id="tolerance_percentage<?=$i;?>"  type="hidden" class="form-control" value="<?=$getProductStock->tolerance_percentage;?>"/>
                <input name="qty[]" id="qty<?=$i;?>" onkeyup="qtyVal(this.id)" type="text" class="form-control"<?php if($reci_qty==0){?> style="width:75px;" readonly="readonly" <?php } ?> />
                <input type="text" style="display:none" name="process_ends[]" value="1" />
              </td>
              <td class="tdcenter"> <input class="form-control" onkeyup="totalWeightCal(this.id)" onchange="totalWeightCal(this.id)"  style="margin-bottom:10px;width:100px;" value="" type="text"  name="total_weight[]" id="total_weight<?=$i;?>" <?php if($reci_qty==0){?> readonly="readonly" <?php }?>  /></td>
              <td class="tdcenter"> <input class="form-control"   style="margin-bottom:10px;width:105px;" value="<?=$getProductPart->qty;?>" readonly="readonly" name="ideal_total_weight[]" id="ideal_total_weight<?=$i;?>"  /></td>
              <td class="tdcenter"> <input class="form-control"   style="margin-bottom:10px;width:95px;" readonly="readonly" value="" name="weight[]" id="weight<?=$i;?>"  /></td>
              <input type="hidden" id="net_weight_cal<?=$i;?>" value="<?=$getProductStock->net_weight;?>" />
              <td style="display:none"> <input class="form-control" style="margin-bottom:10px;width:55px;" value="<?=$getProduct->rate?>" name="rate[]" id="rate<?=$i;?>" onchange="RateCal(this.id)"  /></td>
              <td style="display:none"> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="total_rm_rate[]" id="total_rm_rate<?=$i;?>"  /></td>
              <td style="display:none"> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="labour_rate[]" id="labour_rate<?=$i;?>" onchange="labourRateCal(this.id)"  /></td>
              <td style="display:none"> <input class="form-control" style="margin-bottom:10px;width:55px;" value="" name="total_labour_rate[]" id="total_labour_rate<?=$i;?>"  /></td>
              <td style="display:none">  <input class="form-control" style="margin-bottom:10px; width:55px;" value="<?=$getJob->total_cost;?>" id="total_cost<?=$i;?>" name="total_cost[]"  /></td>
            </tr>
            <?php
              $i++;
              } ?>
          </table>
          <!-- <input type="text" name="cIssueQty" value="<?=$getChallan->cIssueQty;?>">
          <input type="text" name="getRMreturn" value="<?=$getRMreturn->rt_qty;?>"> -->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <input type="submit" class="btn btn-sm" id="add_req" value="Save">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>
