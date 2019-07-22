<table class="table table-striped table-bordered table-hover dataTables-example1" id="loadData" >
  <thead>
    <tr>
      <th>Code </th>
      <th>Shape Name</th>
      <th>Item Name</th>
      <th>Shape Description</th>
      <!-- <th>Capacity</th> -->
      <th>Action</th>
    </tr>
  </thead>
  <tbody id="getDataTable">
    <?php  
      $i=1;
        foreach($result as $fetch_list)
        {
      
          $machinQuery1=$this->db->query("select productname,sku_no from tbl_product_stock where Product_id='".$fetch_list->code."'");
          $getMachine1=$machinQuery1->row(); 
      
          $machinQuery2=$this->db->query("select productname,sku_no from tbl_product_stock where Product_id='".$fetch_list->machine_name."'");
          $getMachine2=$machinQuery2->row();
      
        ?>
    <tr class="gradeC record " data-row-id="<?php echo $fetch_list->id; ?>">
      <th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->id; ?>" value="<?php echo $fetch_list->id;?>" /></th>
      <th><?php echo $getMachine1->productname;
        ?> (<?=$getMachine1->sku_no;?>)</th>
      <th><a href="<?=base_url();?>shapeMapping/manage_spare_map?id=<?php echo $fetch_list->id; ?>">
        <?php  echo $getMachine2->productname;?> (<?=$getMachine2->sku_no;?>)</a>
      </th>
      <th>
        <?=$fetch_list->machine_des;?>
      </th>
      <!-- <th><?=$fetch_list->capacity;?></th> -->
      <th class="bs-example">
        <?php if($view!=''){ ?>
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i;?>" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
        <?php } if($edit!=''){ ?>
        <button class="btn btn-default modalEditItem" data-a="<?php echo $fetch_list->id;?>" href='#editItem' onclick="getEditItem('<?php echo $fetch_list->id;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
        <?php }
          $pri_col='id';
          $table_name='tbl_machine';
          ?>
        <button class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>   
        <?php
          ?>
        <button style="display:none" class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>MAP SPARE</button>
      </th>
    </tr>
    <div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">VIew Shape</h4>
          </div>
          <div class="modal-body overflow">
            <div class="form-group">
              <label class="col-sm-2 control-label">*Code:</label> 
              <div class="col-sm-4">  
                <input type="text" class="form-control" name="sku_no[]" value="<?php echo $fetch_list->code; ?>" readonly> 
              </div>
              <label class="col-sm-2 control-label">*Shape Name:</label> 
              <div class="col-sm-4"> 
                <input name="item_name[]"  type="text" value="<?php echo $fetch_list->machine_name; ?>" readonly class="form-control" required> 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">*Shape Description:</label> 
              <div class="col-sm-4" id="regid"> 
                <input type="text" step="any" name="unitprice_purchase[]" value="<?php echo $fetch_list->machine_des; ?>" readonly="" class="form-control" required>
              </div>
              <label class="col-sm-2 control-label">Capacity:</label> 
              <div class="col-sm-4" id="regid"> 
                <input type="text" name="min_re_order_level[]" value="<?php echo $fetch_list->capacity; ?>" readonly="" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php $i++; } ?>
  </tbody>
  <input type="text" style="display:none;" id="table_name" value="tbl_machine">  
  <input type="text" style="display:none;" id="pri_col" value="id">
</table>