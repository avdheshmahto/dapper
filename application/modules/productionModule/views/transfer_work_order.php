<?php
  $queryData=$this->db->query("select *from tbl_job_work where id='$id'");
  $getData=$queryData->row();
  
  ?>
<form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#" 
  onsubmit="return submitProductionPurchase();"method="POST">
  <div class="row">
    <div class="form-group">
      <label class="col-sm-2 control-label">Transfer Module:</label> 
      <div class="col-sm-4">
        <select class="form-control" name="transfer_module"  required>
          <option value="">--Select--</option>
          <option value="Kora" >Kora</option>
          <option value="Finish" >Finish</option>
          <option value="Inspection" >Inspection</option>
        </select>
      </div>
      <label class="col-sm-2 control-label">Assemble:</label> 
      <div class="col-sm-4 checkbox"> 
        <input name="date" type="checkbox"  class="form-control1"  > 
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Date:</label> 
      <div class="col-sm-4">
        <input name="date" type="date" value="<?=$getData->date;?>" class="form-control" id="thickness" > 
      </div>
      <label class="col-sm-2 control-label">&nbsp;</label> 
      <div class="col-sm-4"> 
        &nbsp;
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <input type="submit" class="btn btn-sm" value="Save">
    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
  </div>
</form>