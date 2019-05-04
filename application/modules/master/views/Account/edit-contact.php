
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 15px 0px 0px;">Excel</button> 
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 15px;">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Account/manage_contact');?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
</select>
entries</label>
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
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover dataTables-example11" id="tblData" >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>Name</th>
		<th>Group Name</th>
        <th>Email Id</th>
		<th>Mobile No.</th>
		<th>Phone No.</th>        
		<th><div style="width:100px;">Action</div></th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td>&nbsp;</td>
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

<th onClick="openpopup('update_contact',1200,500,'view',<?=$fetch_list->contact_id;?>)"><?=$fetch_list->first_name;?></th>

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
<button class="btn btn-xs btn-black" data-toggle="modal" data-target="#modal-2" type="button" style="margin-top: 4px;" data-backdrop='static' data-keyboard='false' onclick="mappingproduct(<?=$fetch_list->contact_id;?>);"><?=$alreadyMapped != ""?'Mapped !':'Mapping';?>
						      </button>
						      
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
