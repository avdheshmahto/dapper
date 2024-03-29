<?php
  $this->load->view("header.php");
?>

<!-- Main content -->
<div class="main-content">
  <div class="panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Admin Setup</a></li>
      <li><a href="#">Master Data</a></li>
      <li class="active"><strong>Manage Master Data</strong></li>
      <div class="pull-right">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" formid="#masterDataForm" id="formreset"><i class="fa fa-plus"></i>Add Master Data</button>
        <a class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i>Delete all</a>
      </div>
    </ol>
    <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="top_title">Add</span>&nbsp;Master Data</h4>
            <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
          </div>
          <form class="form-horizontal" role="form" id="masterDataForm">
            <div class="modal-body overflow">
              <div class="form-group">
                <label class="col-sm-2 control-label">*Value Name:</label> 
                <div class="col-sm-4">
                  <input type="hidden" name="serial_number" id="serial_number" value="" />
                  <select name="param_id" id="param_id" class="form-control" >
                    <option value="">----Select----</option>
                    <?php 
                      $comp_sql = $this->db->query("select * FROM tbl_master_data_mst where status='A'");
                      foreach ($comp_sql->result() as $comp_fetch){
                      ?>
                    <option value="<?php echo @$comp_fetch->param_id;?>"><?php echo @$comp_fetch->keyname;?></option>
                    <?php } ?>
                  </select>
                </div>
                <label class="col-sm-2 control-label">*Key Value</label> 
                <div class="col-sm-4"> 
                  <input type="text" name="keyvalue" id="keyvalue" value="" class="form-control" > 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Description:</label> 
                <div class="col-sm-4"> 
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer" id="button">
              <input type="submit" class="btn btn-sm" value="Save">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
                <tr>
                  <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                  <th>Value Name</th>
                  <th>Added value</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="listingData">
                <?php
                  $i=1;
                  foreach($result as $fetch_list)
                  {
                  ?>
                <tr class="gradeC record" data-row-id="<?php echo $fetch_list->serial_number; ?>">
                  <td><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->serial_number; ?>" value="<?php echo $fetch_list->serial_number;?>" /></td>
                  <?php 
                    $compQuery = $this -> db
                              -> select('*')
                              -> where('param_id',$fetch_list->param_id)
                              -> get('tbl_master_data_mst');
                    	  $compRow = $compQuery->row();
                    ?>
                  <th><?=$compRow->keyname;?></th>
                  <th><?=$fetch_list->keyvalue;?></th>
                  <th><?=$fetch_list->description;?></th>
                  <th>                    
                    <?php if($view!=''){ ?>
                    <button class="btn btn-default" property="view" arrt= '<?=json_encode($fetch_list);?>' onclick="editMaster(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
                    <?php } if($edit!=''){ ?>
                    <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editMaster(this)"><i class="icon-pencil"></i></button>
                    <?php } if($delete!=''){
                      $pri_col='serial_number';
                      $table_name='tbl_master_data';
                      ?>
                    <button class="btn btn-default delbutton" id="<?=$fetch_list->serial_number."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
                    <?php } ?>
                  </th>
                </tr>
                <?php $i++;} ?>
              </tbody>
              <input type="text" style="display:none;" id="table_name" value="tbl_master_data">  
              <input type="text" style="display:none;" id="pri_col" value="serial_number">
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  $this->load->view("footer.php");
?>