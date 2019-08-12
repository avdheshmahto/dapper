<?php
  $queryData=$this->db->query("select * from tbl_job_work where id='$id'");
  $getData=$queryData->row();
  
  ?>
<form class="form-horizontal">
<div class="modal-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">Vendor:</label> 
    <div class="col-sm-4">
      <select class="form-control" name="vendor_id" disabled required>
        <option value="">--Select--</option>
        <?php
          $queryProductShape=$this->db->query("select *from tbl_contact_m where group_name='5'");
          foreach($queryProductShape->result() as $getProductShape){
          
          ?>
        <option value="<?=$getProductShape->contact_id;?>" <?php if($getProductShape->contact_id==$getData->vendor_id){?> selected <?php }?>><?=$getProductShape->first_name;?></option>
        <?php }?>
      </select>
    </div>
    <label class="col-sm-2 control-label">date:</label> 
    <div class="col-sm-4"> 
      <input name="date" type="date" value="<?=$getData->date;?>" class="form-control" id="thickness" readonly> 
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <div class="modal-header">
        <br>
        <table class="table table-bordered table-hover" >
          <br>
          <tbody>
            <tr class="gradeA">
              <th>Part Name & code</th>
              <th>Order Qty</th>
            </tr>
          </tbody>
          <tbody id="quotationTable">
            <?php 
              $selectQuery=$this->db->query("select * from tbl_job_work_log where lot_no='$getData->lot_no' AND job_order_no='$getData->job_order_no' AND shape_id='$getData->shape_id'");
                  foreach ($selectQuery->result() as  $dt) {

                  // $shapeQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->shape_id'");
                  // $getShape=$shapeQuery->row();
                            
                       ?>
            <tr>
              <td>
                <?php
                  $productQ=$this->db->query("select * from tbl_product_stock where Product_id='$dt->part_id' ");
                  $getPQ=$productQ->row();
                    echo $getPQ->productname."&nbsp;".$getPQ->sku_no;              
                ?>
              </td>
              <td>
                <?php
                  // $imp=explode(",",$dt->qty);
                  // for($i=0;$i<count($imp);$i++)
                  // {
                  //   echo $imp[$i]."<br>";
                  // }
                  ?>
                <?= $dt->qty;?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</form>