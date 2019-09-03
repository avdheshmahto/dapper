<?php
  $queryData=$this->db->query("select *from tbl_production_order_log where grn_no='$id'");
  $getHdr=$queryData->row();
  
  ?>
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
                    <label for="company">Order No.:</label>
                    <?php 
                      ?>
                    <input type="text"  class="form-control" value="<?=$getHdr->order_no;?>" readonly="readonly"  />
                  </div>
                  <div class="col-sm-6">
                    <label for="po_order">GRN No..:</label>
                    <input type="text"  class="form-control" value="<?=$getHdr->grn_no;?>" readonly="readonly"  />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label for="company">Grn Date.:</label>
                    <?php 
                      ?>
                    <input type="text"  class="form-control" value="<?=$getHdr->grn_date;?>" readonly="readonly"  />
                  </div>
                  <div class="col-sm-6">
                    <label for="po_order">&nbsp;</label>
                    &nbsp;
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
                    <th class="tdcenter"> Sl No</th>
                    <th class="tdcenter">Item Number & Description</th>
                    <th class="tdcenter">Usage Unit</th>
                    <th class="tdcenter">GRN Date</th>
                    <th class="tdcenter">Receive Qty</th>
                  </tr>
                </thead>
                <?php
                  // and order_no='$ord'
                  $productQuery=$this->db->query("select * from tbl_production_order_log where grn_no='$id' ");
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
                  <td class="tdcenter"><?=$getProductStock->productname;?>(<?=$getProductStock->sku_no;?>)
                    <input type="hidden"  value="<?=$getProduct->productid;?>" class="form-control">
                  </td>
                  <td class="tdcenter"><?=$getProductUOM->keyvalue;?></td>
                  <?php
                    ?>
                  <td class="tdcenter"><?=$getProduct->grn_date;?></td>
                  <td class="tdcenter"><?=$getProduct->qty;?></td>
                  <?php $qtySum=$qtySum+$getProduct->qty;?>
                </tr>
                <?php 
                  $i++;
                  } ?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td class="tdcenter"><strong>Total Receive Qty</strong></td>
                  <td class="tdcenter"><strong><?=$qtySum;?></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>        
  </div>

<div class ="pull-right" id="saveDiv" >
&nbsp;<a  class="btn btn-sm btn-black btn-outline"  data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">Cancel</span></a>
</div>
</div>
</div>