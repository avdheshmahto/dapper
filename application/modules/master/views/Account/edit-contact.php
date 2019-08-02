
      <div class="row">
        <div class="col-sm-12">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="html5buttons">
              <div class="dt-buttons">
                <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToCSV('members.csv')" style="margin: 15px 15px 0px 0px;">Excel</button> 
                <a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
              </div>
            </div>
            <div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 15px;">
              <label>
                Show
                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Account/manage_contact').'?con_type='.$_GET['con_type'].'&name='.$_GET['name'].'&grp_name='.$_GET['grp_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
                  <option value="10">10</option>
                  <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                  <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                  <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                  <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                  <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
                </select>
                entries
              </label>
              <br />
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                Showing <?=$dataConfig['page']+1;?> to 
                <?php
                  $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                  echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                  ?> of <?php echo $dataConfig['total'];?> entries
              </div>
            </div>
            <div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
              <label>Search:
              <input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel-body">
            <div class="table-responsive__">
              <table class="table table-striped table-bordered table-hover dataTables-example11" id="tblData" >
                <thead>
                  <tr id="abc">
                    <th ><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                    <th>Name</th>
                    <th>Group Name</th>
                    <th>Email Id</th>
                    <th>Mobile No.</th>
                    <th>Phone No.</th>
                    <th style="width: 16%;">
                      <div style="width:100px;">Action</div>
                    </th>
                  </tr>
                </thead>
                <tbody id="getDataTable">
                  <form method="get">
                    <tr>
                      <td>&nbsp;</td>
                      <input name="con_type" type="hidden" class="search_box form-control input-sm"  value="<?=$_GET['con_type'];?>" />
                      <td><input name="name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="grp_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="email"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="mobile"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="phone"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                    </tr>
                  </form>
                  <?php
                    $i=1;
                    foreach($result as $fetch_list)
                     {
                    ?>
                  <tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
                    <th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>
                    <th><?=$fetch_list->first_name;?></th>
                    <?php
                      $contactQuery=$this->db->query("select *from tbl_account_mst where account_id='$fetch_list->group_name'");
                      $getContact=$contactQuery->row();
                      ?>
                    <th>
                      <?=$getContact->account_name;?>
                    </th>
                    <th><?=$fetch_list->email;?></th>
                    <th><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
                    <th><?=$fetch_list->phone;?></th>
                    <th>
                      <button class="btn btn-default" type="button" data-toggle="modal" property="view" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);"  data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                      <button class="btn btn-default" type="button" data-toggle="modal" property="edit" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);"  data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
                      <?php
                        $pri_col='contact_id';
                        $table_name='tbl_contact_m';
                        ?>
                      <button class="btn btn-default delbutton" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>                       
                    </th>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
                <input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
                <input type="text" style="display:none;" id="pri_col" value="contact_id">
              </table>
              <div class="row">
                <div class="col-md-12 text-right">
                  <div class="col-md-6 text-left"> </div>
                  <div class="col-md-6">  <?=$pagination; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" >
            <div class="modal-header">
              <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Contact Mapping</h4>
              <div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div>
            </div>
            <form  class="form-horizontal" role="form" id="insertProductMapping"  >
              <div class="panel-body" id ="mappingData2">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    