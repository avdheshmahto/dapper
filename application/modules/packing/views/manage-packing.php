<?php
$this->load->view("header.php");	
$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}
?>
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Packing</a></li> 
<li class="active"><strong><a href="#">Manage Packing</a></strong></li> 
<div class="pull-right">
<?php 
if($add!='')
{?>
<li style="display:none"><a class="btn btn-sm" href="<?=base_url();?>production/add_production">Add Master Cutting</a></li> 
<?php }?>
</div>
</ol>
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
</div>
</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/packing/manage_packing');?>" class="form-control input-sm">
<option value="10">10</option>
<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
</select>
Entries</label>
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -8px;margin-left: 12px;float: right;">
Showing <?=$dataConfig['page']+1;?> to 
<?php
$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
?> of <?php echo $dataConfig['total'];?> Entries
</div>
</div>
<div id="DataTables_Table_0_filter" class="dataTables_filter">
<label>Search:
<input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
</label>
</div>
</div>
</div>
</div>
<br />
<div class="row">
<div class="col-lg-12">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
<th><div style="width:70px;">Lot. No.</div> </th>	
<th><div style="width:100px;">Date</div></th>
<th><div style="width:130px;">Action</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<form method="get">
<tr>
<td><input name="production_id"  type="text"  class="search_box form-control input-sm"  value="" /></td>
<td><input name="productname"  type="text"  class="search_box form-control input-sm"value=""  /></td>
<td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>
<?php
$i=1;
foreach($result as $sales)
{
?>
<tr class="gradeC record" >
<th><a href="packing/manage_packing_map?id=<?=$sales->lot_no;?>"><?php echo $sales->lot_no;?></a></th>
<th><?php echo $sales->maker_date;?></th>
<th><button class="btn btn-default" style="display:none" onClick="openpopup('<?=base_url();?>production/edit_production',1400,600,'view',<?=$sales->productionid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-eye"></i></button>
<button class="btn btn-default" style="display:none" onClick="openpopup('<?=base_url();?>production/edit_production',1400,600,'id',<?=$sales->productionid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>
<button class="btn btn-default delbuttonpacking" id="<?php echo $sales->cutting_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
</th>
</tr>
<?php }  ?>
</tbody>
</table>
<div class="row">
<div class="col-md-12 text-right">
<div class="col-md-6"> 
<?=$pagination; ?>
</div>
<div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;">
<div class="popover-content" id="showParent"></div>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="insert_packing" enctype="multipart/form-data">			
<div id="editPacking" class="modal fade modal" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-contentProduction" id="modal-contentProduction">
</div>
</div>	 
</div>
</form>
<?php
$this->load->view("footer.php");
?>
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename?filename+'.xls':'PackingList_<?php echo date('d-m-Y'); ?>.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
    var blob = new Blob(['\ufeff', tableHTML], {
    type: dataType
    });
    navigator.msSaveOrOpenBlob( blob, filename);
    }else{
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    downloadLink.download = filename;
    downloadLink.click();
   }
}
</script>