<?php
  $hdrQuery=$this->db->query("select *from tbl_job_rm_return where return_no='$id'");
  $getHdr=$hdrQuery->row();
  ?>
<!-- Main content -->
<div class="main-content">
  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <label for="po_order">RM Return No.:</label>
                      <input type="text" name="invoice_no"  class="form-control" value="<?=$getHdr->return_no;?>" readonly="readonly" required />
                    </div>
                    <div class="col-sm-6" id="invoiceId" >
                      <label for="po_order">RM Return Date:</label>
                      <input type="text" name="invoice_no"  class="form-control" value="<?=$getHdr->return_date;?>" readonly="readonly" required />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="" id="style-3-y">
            <div class="force-overflow-y">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover " >
                  <thead>
                    <tr>
                      <th class="tdcenter">Sl No</th>
                      <th class="tdcenter">Item Number & Description</th>
                      <th class="tdcenter">UOM</th>
                      <th class="tdcenter">Return Weight</th>
                    </tr>
                  </thead>
                  <?php
                    $productQuery=$this->db->query("select *from tbl_job_rm_return where return_no='$id'");
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
                    <td class="tdcenter"><?=$getProductStock->sku_no;?>&<?=$getProductStock->productname;?></td>
                    <td class="tdcenter"><?=$getProductUOM->keyvalue;?></td>
                    <?php
                      $poLogQuery=$this->db->query("select SUM(qty) as po_qty from 		tbl_purchase_order_production_dtl where purchaseid='$getHdr->po_no' and productid='$getProduct->productid'");
                      $getPoQty=$poLogQuery->row();
                      ?>
                    <td class="tdcenter"><?=$getProduct->qty;?></td>
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
  </div>
</div>

<div class ="pull-right" id="saveDiv" >
&nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</span></a>
</div>
</div>