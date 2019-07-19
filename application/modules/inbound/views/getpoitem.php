<?php
  $productQuery=$this->db->query("select SUM(qty) as poQty,SUM(qn_pc) as qnPc,SUM(qn_pc) as po_qn_pc_qty,productid,purchaseid from tbl_purchase_order_dtl where purchaseid='$id' group by productid ");
  
  $getNoVal=$productQuery->row();
  
  $productValQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getNoVal->productid'");
  $getProductVal=$productValQuery->row();
  
  ?>
<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
  <thead>
    <tr>
      <th class="tdcenter"> Sl No.</th>
      <th class="tdcenter">RM Code</th>
      <th class="tdcenter">Item Number & Description</th>
      <th class="tdcenter">UOM</th>
      <?php
        if($getProductVal->usageunit=='18')
        {
        }
        else{
        ?>
      <th class="tdcenter">Ordered Qty</th>
      <?php
        }
        ?>
      <th class="tdcenter">Ordered Weight</th>
      <th class="tdcenter">Remaining Qty</th>
      <th class="tdcenter">Remaining Weight</th>
      <th class="tdcenter">Received  Qty</th>
      <th class="tdcenter">Received Weight</th>
    </tr>
  </thead>
  <?php
    $i=1;
    foreach($productQuery->result() as $getProduct){
    
    ####### get product #######
    $productStockQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getProduct->productid'");
    $getProductStock=$productStockQuery->row();
    ####### ends ########
    
    ####### get UOM #######
    $productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
    $getProductUOM=$productUOMQuery->row();
    ####### ends ########
    
    $logRmQuery=$this->db->query("select SUM(receive_qty) as poLogQty from tbl_inbound_log where po_no='$id' and productid='$getProduct->productid' ");
    
    $getRM=$logRmQuery->row();
    ?>
  <tr class="gradeX odd" role="row">
    <td class="size-60 text-center sorting_1"><?=$i;?></td>
    <td><?=$getProductStock->sku_no;?> 
      <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
    </td>
    <td><?=$getProductStock->sku_no;?>&<?=$getProductStock->productname;?></td>
    <td><?=$getProductUOM->keyvalue;?></td>
    <?php
      if($getProductVal->usageunit=='18')
      {
      }
      else{
      ?>
    <td><?=$getProduct->qnPc;?>
      <?php }?>                                  
    </td>
    <?php
      $inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty,SUM(qn_pc) as qty_qn_pc from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
      $getInbound=$inbountLogQuery->row();
      
      
      ?>
    <td><?=$getProduct->poQty?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?php echo $rmR=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">
      <input type="hidden" name="po_no" value="<?=$getProduct->purchaseid?>" />
    </td>
    <td><?=$getProduct->qnPc-$getInbound->qty_qn_pc;?>                                 
    </td>
    <td><?=$getProduct->poQty-$getInbound->rec_qty;?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?php echo $rmR=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">
    </td>
    <td><input type="number" min="1" name="qn_pc[]" id="qn_pc<?=$i;?>" step="any"  class="form-control">
    </td>
    <td>
      <input type="hidden" id="circle_w<?=$i;?>" value="<?=$getProductStock->circle_weight;?>" />
      <input type="number" min="1" step="any" name="receive_qty[]" id="rec_qty<?=$i;?>" <?php if($rmR=='0'){?> readonly="readonly" <?php }?> onkeyup="qtyValidation(this.id);" class="form-control">
      <input type="hidden" name="validationCheck" id="validationCheck" value="0" />
    </td>
  </tr>
  <?php 
    $ordQtyTot=$ordQtyTot+$getProduct->poQty;
    $remQtyTot=$remQtyTot+$getRM->poLogQty;
    $i++;
    }?>
</table>
<input type="hidden" name="qrd_qtyT" id="qrd_qtyT"  value="<?=$ordQtyTot;?>" />
<input type="hidden" id="remQyT" value="<?=$remQtyTot;?>" />
<input type="hidden" name="totToCom" id="totTocomp" />