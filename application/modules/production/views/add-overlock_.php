<?php
  $id=$_GET['ID'];
  ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Add Over Locking</h4>
</div>
<div class="modal-body overflow">
  <?php 
    $queryfetch=$this->db->query("select * from tbl_production_hdr where productionid='".$_GET['ID']."'");
    $rowfetch=$queryfetch->row();
    ?>
  <input type="hidden" name="production_id" class="form-control" value="<?php echo $_GET['ID'];?>" >
  <INPUT type="button" value="Add Row" class="btn btn-sm" onclick="addRow('dataTable')" />
  <INPUT type="button" class="btn btn-secondary btn-sm" value="Delete Row" onclick="deleteRow('dataTable')" />
  <div class="form-group">
    <table class="table table-striped table-bordered table-hover"  id="dataTable" >
      <thead>
        <tr class="gradeA">
          <th>Check</th>
          <th width="200px">Item</th>
          <th>Filled Qty</th>
          <th>Enter Qty</th>
          <th>Date</th>
        </tr>
      </thead>
      <?php
        /*$query=$this->db->query("select * from tbl_overlock where production_id='".$_GET['ID']."'");
        $j=1;
        $sum1=0;
        foreach($query->result() as $fetchRow){*/
        ?>
      <tr class="gradeA">
        <th>
          <input type="checkbox" name="chkbox[]"  />
        </th>
        <th>
          <select name="contact_id[]"  id="contact_id_copy" class="form-control ui fluid search dropdown email">
            <option value="" >Select</option>
            <?php
              $contQuery=$this->db->query("select * from tbl_product_stock where category='218'");
              foreach($contQuery->result() as $contRow)
              {
              ?>
            <option value="<?php echo $contRow->Product_id; ?>"<?php if($contRow->Product_id==$fetchRow->customer_name){?>selected<?php }?>>
              <?php echo $contRow->productname; ?>
            </option>
            <?php } ?>
          </select>
          <input type="hidden" name="tailor_id[]" class="form-control" value="<?php echo $fetchRow->tailor_id;?>" >
        </th>
        <th>
          <?php echo $fetchRow->qty;?>
        </th>
        <th>
          <input type="number" step="any" min="0" onkeyup="checkvalue(this.id)" id="qty1" name="qty[]"   class="form-control" value=""> 
          <?php $sum1=$sum1+$fetchRow->qty;?>
          <p id="error1" style="display:none">*Qty Not Greater Than Rest Value.</p>
        </th>
        <th>
          <input type="date" name="date[]" class="form-control" value="<?php echo $fetchRow->date;?>" >
        </th>
      </tr>
      <?php 
        //$j++; }
        ?>
    </table>
    <table class="table table-striped table-bordered table-hover">
      <tr>
        <th width="200px">Rest Quantity</th>
        <th><?php 
          $tot=$rowfetch->qty;
          //echo $sum1;
          $rest=$tot-$sum1;
          echo $rest;?></th>
      </tr>
      <input type="hidden" name="rest" id="rest" class="form-control" value="<?php echo $rest;?>" >
    </table>
  </div>
</div>
<input type="hidden" name="totQty" id="totQty" class="form-control" value="<?php echo $rowfetch->qty;?>" >
<input type="hidden" name="rows" id="rows" class="form-control" value="<?php echo $j-1;?>" >
<div class="modal-footer">
  <input type="button" class="btn btn-sm" id="sv1" data-dismiss="modal1" onclick="fsv(this)" value="Save">
  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>