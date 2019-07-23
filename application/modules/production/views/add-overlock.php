<?php
  $id=$_GET['ID'];
  ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Add Overlocking</h4>
</div>
<div class="modal-body overflow">
  <?php 
    $queryfetch=$this->db->query("select * from tbl_production_hdr where productionid='".$_GET['ID']."'");
    $rowfetch=$queryfetch->row();
    ?>
  <div style="text-align:-webkit-right;">
    <input type="hidden" name="production_id" class="form-control" value="<?php echo $_GET['ID'];?>" >
    <input type="hidden" name="finishProduct" class="form-control" value="<?=$rowfetch->product_id;?>" >
    <input type="hidden" name="pdate" id="pdate" class="form-control" value="<?=$rowfetch->date;?>" >
    <INPUT type="button" value="Add Row" class="btn btn-sm" onclick="addRow('dataTable')" />
    <INPUT type="button" class="btn btn-secondary btn-sm" value="Delete Row" onclick="deleteRow('dataTable')" /><br /><br />
  </div>
  <div class="form-group-">
    <table class="table table-striped table-bordered table-hover"  id="dataTable" >
      <thead>
        <tr class="gradeA">
          <th>Check</th>
          <th width="200px">Employee Name</th>
          <th>Filled Qty</th>
          <th style="display:none">Cutting Value</th>
          <th style="display:none">Enter Qty</th>
          <th>Date</th>
        </tr>
      </thead>
      <?php 
        $j=1;
        $sum1=0;
        $query=$this->db->query("select * from tbl_overlock where production_id='".$_GET['ID']."'");
        $check=$query->num_rows();
        if($check==0){ ?>
      <tr class="gradeA">
        <th>
          <input type="checkbox" name="chkbox[]"  />
        </th>
        <th>
          <select name="contact_id[]"  id="contact_id_copy1" class="form-control" required>
            <option value="" selected disabled >--Select--</option>
            <?php
              $contQuery=$this->db->query("select * from tbl_contact_m where group_name='6'");
              foreach($contQuery->result() as $contRow)
              {
              ?>
            <option value="<?php echo $contRow->contact_id; ?>"><?php echo $contRow->first_name; ?>	</option>
            <?php } ?>
          </select>
          <input type="hidden" name="overlock_id[]" class="form-control" value="" >
        </th>
        <th style="display:none">
          <?php echo $fetchRow->qty;?>
        </th>
        <th style="display:none">
          <?php 
            $queryfetch=$this->db->query("select * from tbl_cutting where finishProductId='".$_GET['ID']."'");	
            $fetchqrow=$queryfetch->row();
            echo $fetchqrow->qty;
            ?>
        </th>
        <th>
          <input type="number" step="any" min="0" onkeyup="checkvalue(this.id,'add')" id="qty1" name="qty[]"   class="form-control" value=""> 
          <?php $sum1=$sum1+$fetchRow->qty;?>
          <p id="error<?=$j;?>" style="display:none">*Qty Not Greater Than Rest Value.</p>
        </th>
        <th>
          <input type="date" name="date[]" id="date" onchange="CompareDate(this.value)" class="form-control" value=""  required>
        </th>
      </tr>
      <?php
        }else{
        foreach($query->result() as $fetchRow){
        ?>
      <tr class="gradeA">
        <th>
          <input type="checkbox" name="chkbox[]"  />
        </th>
        <th>
          <select name="contact_id[]"  id="contact_id_copy" class="form-control ui fluid search dropdown email">
            <option value="" >Select</option>
            <?php
              $contQuery=$this->db->query("select * from tbl_contact_m where group_name='6'");
              foreach($contQuery->result() as $contRow)
              {
              ?>
            <option value="<?php echo $contRow->contact_id; ?>"<?php if($contRow->contact_id==$fetchRow->customer_name){?>selected<?php }?>>
              <?php echo $contRow->first_name; ?>
            </option>
            <?php } ?>
          </select>
          <input type="hidden" name="overlock_id[]" class="form-control" value="<?php echo $fetchRow->overlock_id;?>" >
        </th>
        <th>
          <?php echo $fetchRow->qty;?>
          <input type="hidden" name="ed" id="ed<?=$j;?>" class="form-control" value="<?php echo $fetchRow->qty;?>" >
        </th>
        <th style="display:none">
          <?php 
            $queryfetch=$this->db->query("select * from tbl_cutting where finishProductId='".$fetchRow->finishProductId."'");	
            $fetchqrow=$queryfetch->row();
            echo $fetchqrow->qty;
            ?>
        </th>
        <th style="display:none">
          <div id="forfun<?=$j;?>" >
            <INPUT type="button" value="Edit Row" id="btn<?=$j;?>" class="btn btn-sm" onclick="changethevalue(this.id)" />
          </div>
          <div id="forfun1<?=$j;?>" style="display:none">
            <input type="number" step="any" min="0" onkeyup="checkvalue(this.id,'edit')" id="qty<?=$j;?>" name="qty[]"   class="form-control" value=""> 
            <?php $sum1=$sum1+$fetchRow->qty;?>
            <p id="error<?=$j;?>" style="display:none">*Qty Not Greater Than Rest Value.</p>
          </div>
        </th>
        <th>
          <input type="date" name="date[]" id="date" onchange="CompareDate(this.value)" class="form-control" value="<?php echo $fetchRow->date;?>"  >
        </th>
      </tr>
      <?php 
        $j++; } }?>
    </table>
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <th width="200px"> Rest Quantity </th>
        <th>
          <?php $tot=$rowfetch->qty;
            //echo $sum1;
            $rest= $tot-$sum1;
            echo $rest;
            ?>
          <!-- <p id="error1" style="display:none">*Qty Not Greater Than Total Quantity Value.</p> -->	
        </th>
      </tr>
      <input type="hidden" name="rest" id="rest" class="form-control" value="<?php echo $rest;?>" >
      <input type="hidden" name="restttt" id="restttt" class="form-control" value="<?php echo $rest;?>" >
      <input type="hidden" name="actuvalrest" id="actuvalrest" class="form-control" value="<?php echo $rest;?>" >
    </table>
  </div>
</div>
<input type="hidden" name="totQty" id="totQty" class="form-control" value="<?php echo $rowfetch->qty;?>" >
<input type="hidden" name="rows" id="rows" class="form-control" value="<?php if($j==1){echo "1";}else{echo $j-1;} ?>" >
<div class="modal-footer">
  <input type="button" class="btn btn-sm" id="sv1" data-dismiss="modal1" onclick="fsv(this)" value="Save">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>