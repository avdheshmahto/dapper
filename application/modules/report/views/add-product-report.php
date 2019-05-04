<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

?>
<!-- Main content -->
<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">PRODUCT STOCK REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="    background: #dedede;    padding: 20px 0px;    margin-bottom: 25px;">
<form class="form-horizontal" method="get">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Code</label> 
<div class="col-sm-3"> 
<input type="text" name="p_id" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="" /> 
</div>
</div>

<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Product Type</label> 
<div class="col-sm-3"> 
<select name="type" class="form-control">
<option value="">--Select--</option>
<?php 
$typeQuery=$this->db->query("select *from tbl_master_data where param_id='17'");
foreach($typeQuery->result() as $getType){
?>
<option value="<?=$getType->serial_number;?>"><?=$getType->keyvalue;?></option>
<?php }?>
</select>

</div>
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-3"> 
&nbsp;
</div>
</div>
<div class="col-sm-6" style="float:right;padding: 5px 0 0 96px;"> 
<label class="col-sm-2 control-label"><button type="submit" name="filter" value="filter" class="btn btn-sm">Search</button></label>  
<label class="col-sm-3 control-label"><a href="" class="btn btn-sm" style="margin-right: -27px;">  Clear </a></label>
</div>
</form>
</div>
<br />

<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp; Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchStock?');?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
</select>
Entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -6px;margin-left: 12px;float: right;">
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

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>

		<th>Code</th>
		<th>Product Type</th>
        <th>Product Name</th>   
		<th style="display:none">Category</th>
		<th>Unit</th>
		<th>Purchase Price</th>
		<th>Sale Price</th>
		<th>Quantity In Stock</th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;
//if(!empty($stockSearch)) {
foreach($result as $rows) {
?>
<tr class="gradeC record">

<th><?php echo $rows->sku_no; ?></th>
<th><?php 

	$sql1 = $this->db->query("select * from tbl_master_data where serial_number='".$rows->type."' ");
	$sql2 = $sql1->row();
	echo $sql2->keyvalue;
?>
</th>

<th><?php echo $rows->productname; ?></th>
<th style="display:none"><?php 
	$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$rows->category."' ");
			$sql2 = $sql1->row();
			echo $sql2->prodcatg_name;
			
		?>
</th>
<th>
<?php
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$rows->usageunit'");
		$fProQ12=$proQ1->row();
 echo $fProQ12->keyvalue;
 ?>
</th>	
<th><?php echo $rows->unitprice_purchase;?></th>	
<th><?php echo $rows->unitprice_sale;?></th>
<th>
	<?php echo round($rows->quantity,2); ?></th>
</tr>
<?php } //} ?>
</tbody>
</table>
<div class="row">
   <div class="col-md-12 text-right">
      <div class="col-md-6 text-left">  </div>
    	  <div class="col-md-6">  <?=$pagination; ?>  </div>
          <div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;">
		  <div class="popover-content" id="showParent"></div>
	  </div>
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>

<script>

function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'ProductStockReport_<?php echo date('d-m-Y');?>.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{

        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>