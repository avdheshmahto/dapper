<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
  <thead>
    <tr>
      <th class="tdcenter"> Sl No.</th>
      <th class="tdcenter">Item Number & Description</th>
      <th class="tdcenter">UOM</th>
      <th class="tdcenter">Ordered Qty</th>
      <th class="tdcenter">Remaining Qty</th>
      <th class="tdcenter">Enter Qty</th>
    </tr>
  </thead>
  <?php
    $productQuery=$this->db->query("select SUM(qty) as poQty,productid,purchaseid from tbl_purchase_order_dtl where purchaseid='$id' group by productid ");
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
    
    ?>
  <tr class="gradeX odd" role="row">
    <td class="size-60 text-center sorting_1"><?=$i;?></td>
    <td><?=$getProductStock->productname;?>
      <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
    </td>
    <td><?=$getProductUOM->keyvalue;?></td>
    <td><?=$getProduct->poQty;?></td>
    <?php
      $inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
      $getInbound=$inbountLogQuery->row();
      
      
      ?>
    <td><?=$getProduct->poQty-$getInbound->rec_qty;?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">
      <input type="hidden" name="po_no" value="<?=$getProduct->purchaseid?>" />
    </td>
    <td><input type="number" min="1" name="receive_qty[]" id="rec_qty<?=$i;?>" onkeyup="qtyValidation(this.id);" class="form-control">
      <input type="hidden" name="validationCheck" id="validationCheck" value="0" />
    </td>
  </tr>
  <?php 
    $i++;
    }?>
</table>