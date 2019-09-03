<!-- Main content -->
<div class="main-content">
  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h4 class="panel-title">RM Planing Status</h4>
          <ul class="panel-tool-options">
            <li><a href="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="" id="style-3-y">
            <div class="force-overflow-y">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover " >
                  <thead>
                    <tr>
                      <th class="tdcenter"> Sl No</th>
                      <th class="tdcenter">Item Number & Description</th>
                      <th class="tdcenter">UOM</th>
                      <th class="tdcenter">Remaining Qty</th>
                      <th class="tdcenter">Remaining Weight</th>
                    </tr>
                  </thead>
                  <?php
                    $productQuery=$this->db->query("select *from tbl_purchase_order_dtl where purchaseid='$id' ");
                    $i=1;
                    foreach($productQuery->result() as $getProduct){
                    	
                    $cntQtyQuery=$this->db->query("select SUM(receive_qty) as weightt,SUM(qn_pc) as qty_pc from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
                    $getCntT=$cntQtyQuery->row();           
                    
                    //echo $getCntT->weightt;
                    $sumQty=$getProduct->qty-$getCntT->weightt;
                    
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
                    <td class="tdcenter"><?=$getProductStock->sku_no;?>& <?=$getProductStock->productname;?>
                      <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                    </td>
                    <td class="tdcenter"><?=$getProductUOM->keyvalue;?></td>
                    <td class="tdcenter"><?=$getProduct->qn_pc - $getCntT->qty_pc;?></td>
                    <td class="tdcenter"><?php echo $sumQty;?></td>
                  </tr>
                  <?php 
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
  &nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</span></a>
  </div>
 </div>
</div>
