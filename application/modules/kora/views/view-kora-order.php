<?php
  $queryData=$this->db->query("select *from tbl_production_order_transfer_another_module where lot_no='$id'");
  $getData=$queryData->row();
  
  ?>
<form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#" 
  onsubmit="return submitProductionPurchase();"method="POST">
<div class="modal-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">Lot No.:</label> 
    <div class="col-sm-4">
      <input name="date" type="text" value="<?=$id;?>" class="form-control" id="thickness" readonly> 
    </div>
    <label class="col-sm-2 control-label">Date:</label> 
    <div class="col-sm-4"> 
      <input name="date" type="date" value="<?=$getData->transfer_date;?>" class="form-control" id="thickness" readonly> 
    </div>
  </div>
  <div class="form-group">
    <div class="" id="style-3-y">
      <div class="force-overflow-y">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover " >
            <thead>
              <tr>
                <th class="tdcenter"> Sl No</th>
                <th class="tdcenter">Item Number & Description</th>
                <th class="tdcenter">UOM</th>
                <th class="tdcenter">Qty</th>
              </tr>
            </thead>
            <?php
              $productQuery=$this->db->query("select SUM(qty) as qty,productid from tbl_production_order_transfer_another_module where lot_no='$id' group by productid");
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
              <td class="tdcenter"><?=$getProductStock->sku_no;?>
                <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
              </td>
              <td><?=$getProductUOM->keyvalue;?></td>
              <?php
                $poLogQuery=$this->db->query("select SUM(qty) as po_qty from tbl_purchase_order_production_dtl where purchaseid='$getHdr->po_no' and productid='$getProduct->productid'");
                $getPoQty=$poLogQuery->row();
                ?>
              <td><?=$getProduct->qty;?></td>
            </tr>
            <?php 
              $i++;
              }?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>