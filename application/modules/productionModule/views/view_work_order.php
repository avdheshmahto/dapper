<?php
  $queryData=$this->db->query("select *from tbl_job_work where id='$id'");
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
  <div class="form-group">
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
              <th>Net Weight</th>
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
            $selectQuery=$this->db->query("select *from tbl_job_work where id='$id'");
            foreach ($selectQuery->result() as  $dt) {
            $shapeQuery=$this->db->query("select * from tbl_product_stock where Product_id='$dt->shape_id'");
            $getShape=$shapeQuery->row();

            $joQty=explode(",",$dt->qty);            
              //echo $imp[$i]."<br>";
              
            ?>
            <tr <?php if( $joQty[$j++] == '' ) { ?> style="display: none;" <?php } ?> >
              <?php
                print_r($joQty);
                if($getData->type=='Shape')
                {
                ?>
              <td><?=$getShape->productname;?>&nbsp;<?=$getShape->sku_no;?></td>
              <?php }?>	
              <?php
                if($getData->type=='ShapePart')
                {
                ?>
              <td>
                <?php
                  $productQ=$this->db->query("select *from tbl_product_stock where Product_id in ($dt->part_id)");
                  foreach($productQ->result() as $getPQ){
                  ?>
                <?=$getPQ->productname."&nbsp;".$getPQ->sku_no."<br>";
                  }
                  				?>
              </td>
              <?php }?>
              <td>
                <?php
                  $imp=explode(",",$dt->qty);
                  for($i=0;$i<count($imp);$i++)
                  {
                  	echo $imp[$i]."<br>";
                  }
                  ?>
              </td>
              <td><?php
                $wt=explode(",",$dt->weight);
                for($i=0;$i<count($wt);$i++)
                {
                echo $wt[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $totalWt=explode(",",$dt->total_weight);
                for($i=0;$i<count($totalWt);$i++)
                {
                echo $totalWt[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $rmRatePerKg=explode(",",$dt->rate);
                for($i=0;$i<count($rmRatePerKg);$i++)
                {
                echo $rmRatePerKg[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $totalRmAmount=explode(",",$dt->total_rm_rate_rs);
                for($i=0;$i<count($totalRmAmount);$i++)
                {
                echo $totalRmAmount[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $labourRatePerKg=explode(",",$dt->labour_rate_co);
                for($i=0;$i<count($labourRatePerKg);$i++)
                {
                echo $labourRatePerKg[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $totalLabourRate=explode(",",$dt->total_labour_rate);
                for($i=0;$i<count($totalLabourRate);$i++)
                {
                echo $totalLabourRate[$i]."<br>";
                }
                
                ?></td>
              <td><?php
                $totalCost=explode(",",$dt->total_cost);
                for($i=0;$i<count($totalCost);$i++)
                {
                echo $totalCost[$i]."<br>";
                }
                
                ?></td>
            </tr>
            <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>