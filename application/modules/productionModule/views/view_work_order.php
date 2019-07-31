<?php
  $queryData=$this->db->query("select * from tbl_job_work where id='$id'");
  $getData=$queryData->row();
  
  ?>

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

  <div class="form-group" style="margin-top: 50px;">
    <div class="col-sm-12">
      <div class="modal-header">
        <br>
        <table class="table table-bordered table-hover" >
          <br>
          <tbody>
            <tr class="gradeA">
              <?php
                if($getData->type=='Shape')
                {
                ?>
              <th>Shape Name & Code </th>
              <?php }?>
              <?php
                if($getData->type=='ShapePart')
                {
                ?>
              <th>Part Name & code</th>
              <?php }?>
              <th>Order Qty</th>
              <th>Cast Weight</th>
              <th>Total Weight</th>
              <th>RM Rate Per Kg</th>
              <th>Total RM Amount</th>
              <th>Labour Rate Per Kg</th>
              <th>Total Labour Amount</th>
              <th>Total Cost</th>
            </tr>
          </tbody>
          <tbody id="quotationTable">
            <?php 
            $j=0;
            $selectQuery=$this->db->query("select * from tbl_job_work_log where lot_no='$getData->lot_no' AND job_order_no='$getData->job_order_no' AND shape_id='$getData->shape_id' ");
            $count=$selectQuery->num_rows();
            foreach ($selectQuery->result() as  $dt) {
            $shapeQuery=$this->db->query("select * from tbl_product_stock where Product_id='$dt->shape_id'");
            $getShape=$shapeQuery->row();
              
            ?>
            <tr>
              <?php if($getData->type=='Shape' && $j == 0 ) { ?>
                <td rowspan="<?=$count?>"><?=$getShape->productname;?>&nbsp;<?=$getShape->sku_no;?></td>
              <?php } ?> 
              
              <?php if($getData->type=='ShapePart') { ?>
              <td>
                <?php
                  $productQ=$this->db->query("select *from tbl_product_stock where Product_id = '$dt->part_id' ");
                  $getPQ=$productQ->row();
                  echo $getPQ->productname."&nbsp;".$getPQ->sku_no; ?>
              </td>
              <?php } ?>

              <td><?php echo $dt->qty; ?></td>
              <td><?php echo $dt->weight; ?></td>
              <td><?php echo $dt->total_weight; ?></td>
              <td><?php echo $dt->rate; ?></td>
              <td><?php echo $dt->total_rm_rate_rs; ?></td>
              <td><?php echo $dt->labour_rate_co; ?></td>
              <td><?php echo $dt->total_labour_rate; ?></td>
              <td><?php echo $dt->total_cost; ?></td>
            </tr>
            <?php  $j++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>