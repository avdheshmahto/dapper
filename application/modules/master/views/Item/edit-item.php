
      <div class="row">
        <div class="col-sm-12">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="html5buttons">
              <div class="dt-buttons">
                <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 5px 0px 0px;">Excel</button>
                <button style="display:none"  id="btnExport" onclick="javascript:xport.toCSV('tblData');"> Export to CSV</button>
              </div>
            </div>
            <div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 5px;">
              <label>
                Show
                <select name="DataTables_Table_0_length" url="<?=base_url('master/Item/manage_item').'?p_type='.$_GET['p_type'].'&sku_no='.$_GET['sku_no'].'&type='.$_GET['type'].'&category='.$_GET['category'].'&productname='.$_GET['productname'].'&usages_unit='.$_GET['usages_unit'].'&size='.$_GET['size'].'&thickness='.$_GET['thickness'].'&gradecode='.$_GET['gradecode'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
                  <option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
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
                  ?> of <?=$dataConfig['total'];?> entries
              </div>
            </div>
            <div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
              <label>Search:
              <input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="panel-body">
          <div class="table-responsive" style="padding: 4px;">
            <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
              <thead>
                <tr>
                  <th id="ab"><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                  <th>
                    <div style="width:100px;"><?php if($_GET['p_type']=='13'){?>RM Code<?php } elseif($_GET['p_type']=='32'){?>Part Code <?php } elseif($_GET['p_type']=='33'){ echo "Shape Code";} elseif($_GET['p_type']=='35'){ echo "Accessories Code";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Code";} else{ echo "Item Code";}?></div>
                  </th>
                  <th style="display:none1;">
                    <div style="width:100px;">Product Type</div>
                  </th>
                  <th>
                    <div style="width:100px;">Category</div>
                  </th>
                  <th>
                    <div style="width:100px;"><?php if($_GET['p_type']=='13'){?>Raw Material Name<?php } elseif($_GET['p_type']=='32'){?>Part Name <?php } elseif($_GET['p_type']=='33'){ echo "Shape Name";} elseif($_GET['p_type']=='35'){ echo "Accessories Name";} elseif($_GET['p_type']=='34'){ echo "Packaging Material Name";} elseif($_GET['p_type']=='50'){ echo "Scrap";} else{ echo "Finish Goods";}?></div>
                  </th>
                  <th>
                    <div style="width:100px;">Usage Unit</div>
                  </th>
                  <th style="display: none;">
                    <div style="width:50px;">Size</div>
                  </th>
                  <?php if($_GET['p_type']=='13'){?>
                  <th style="display: none;">
                    <div style="width:100px;">Thickness</div>
                  </th>
                  <?php }?>
                  <th style="display:none;">
                    <div style="width:100px;">Grade Code</div>
                  </th>
                  <th>
                    <div style="width:150px;">Action</div>
                  </th>
                </tr>
              </thead>
              <tbody id="getDataTable" >
                <form method="get">
                  <tr>
                    <td>&nbsp;</td>
                    <input name="p_type"  type="hidden"  class="search_box form-control input-sm"  value="<?=$_GET['p_type'];?>" />
                    <td><input name="sku_no"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="type"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="category"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="productname"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="usages_unit"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td style="display: none;"><input name="size" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <?php if($_GET['p_type']=='13'){?>
                    <td style="display: none;"><input name="thickness" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <?php }?>
                    <td style="display:none;"><input name="gradecode" type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                  </tr>
                </form>
                <?php  
                  $i=1;
                  foreach($result as $fetch_list)
                  {
                  ?>
                <tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
                  <th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" /></th>
                  <?php
                    $queryType=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->type'");
                    $getType=$queryType->row();
                    ?>
                  <th><?=$fetch_list->sku_no;?></th>
                  <th style="display:none1;"><?=$getType->keyvalue;?></th>
                  <th>
                    <?php 
                      $compQuery = $this ->db
                           -> select('*')
                           -> where('id',$fetch_list->category)
                           -> get('tbl_category');
                          $compRow = $compQuery->row();
                      echo $compRow->name;
                      ?>
                  </th>
                  <th><?=$fetch_list->productname;?></th>
                  <th><?php
                    $compQuery1 = $this -> db
                           -> select('*')
                           -> where('serial_number',$fetch_list->usageunit)
                           -> get('tbl_master_data');
                          $keyvalue1 = $compQuery1->row();
                    echo $keyvalue1->keyvalue;      
                    ?></th>
                  <th style="display: none;"><?=$fetch_list->pro_size;?></th>
                  <?php if($_GET['p_type']=='13'){?>
                  <th style="display: none;"><?=$fetch_list->thickness;?></th>
                  <?php }?>
                  <th style="display:none;"><?=$fetch_list->grade_code;?></th>
                  <th class="bs-example">
                    <?php if($view!=''){ ?>
                    <button class="btn btn-default" property="view" arrt= '<?=json_encode($fetch_list);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
                    <?php } if($edit!=''){ ?>
                    <button type="button" property="edit" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editItem(this)"><i class="icon-pencil"></i></button>
                    <?php }
                      $pri_col='Product_id';
                      $table_name='tbl_product_stock';
                      ?>
                    <button class="btn btn-default delbutton" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" type="button">
                    <i class="icon-trash"></i></button>   
                    <?php
                      if($fetch_list->type=='33')
                      {
                       ?>
                    <button  class="btn btn-default" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" onclick="viewPartCode(<?=$fetch_list->Product_id;?>)" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><i class="icon-flow-tree"></i></button>
                    <?php }?>
                  </th>
                </tr>
                <?php $i++; } ?>
              </tbody>
              <input type="text" style="display:none;" id="table_name" value="tbl_product_stock"> 
              <input type="text" style="display:none;" id="pri_col" value="Product_id">
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="col-md-6 text-left"></div>
          <div class="col-md-6"> <?php echo $pagination; ?> </div>
        </div>
      </div>
    