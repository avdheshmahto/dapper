<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Grn Log</a></li>
  <li><a href="#Return" data-toggle="tab">Return Log</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane  active" id="home">
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
          <thead>
            <tr>
              <th>Item Number & Description</th>
              <th>GRN No.</th>
              <th>GRN Date</th>
              <th>Receive QTY</th>
              <th>Receive Weight</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $queryData=$this->db->query("select *from tbl_inbound_log where po_no='$pid' ");
              foreach($queryData->result() as $fetch_list)
              {
                
              ?>
            <tr class="gradeU record">
              <td>
                <?php
                  $prd=$this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->productid'");	
                  $getPrd=$prd->row();
                  echo $getPrd->sku_no.' '.$getPrd->productname;
                  
                   ?>
              </td>
              <td><?=$fetch_list->grn_no;?></td>
              <td><?=$fetch_list->grn_date;?></td>
              <td><?=$fetch_list->receive_qty;?></td>
              <td><?=$fetch_list->qn_pc;?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- starts-->
  <div class="tab-pane" id="Return">
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
          <thead>
            <tr>
              <th>Item Number & Description</th>
              <th>Receive QTY</th>
              <th>Receive Weight</th>
              <th>Return QTY</th>
              <th>Return Weight</th>
            </tr>
          </thead>
          <tbody>
            <?php             
              
              $poquery=$this->db->query("select * from tbl_grn_return_dtl where po_no='$pid' ");
              foreach($poquery->result() as $getPo)
              {
              
              ?>
            <tr class="gradeC record">
              <td>
                <?php
                  $prd=$this->db->query("select * from tbl_product_stock where Product_id='$getPo->productid'");	
                  $getPrd=$prd->row();
                  echo $getPrd->sku_no.' '.$getPrd->productname;
                  
                   ?>
              </td>
              <td><?=$getPo->receive_qty;?></td>
              <td><?=$getPo->receive_weight;?></td>
              <td><?=$getPo->return_qty;?></td>
              <td><?=$getPo->return_weight;?></td>
            </tr>
            <?php }?>
            <tr class="gradeU">
              <td>
                <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="grn_return('<?=$pid;?>');" data-toggle="modal" data-target="#modal-grn-return"><img src="<?=base_url();?>assets/images/plus.png" /></button>
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- ends -->
</div>