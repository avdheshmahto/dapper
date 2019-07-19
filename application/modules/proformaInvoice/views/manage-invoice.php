<?php
$this->load->view("header.php");	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_sales_order_hdr';

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}


?>
<!-- Main content -->
<div class="main-content">			
	<ol class="breadcrumb breadcrumb-2"> 
		<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
		<li><a href="#">Proforma Invoice</a></li> 
		
		<li class="active"><strong><a href="#">Manage Proforma Invoice</a></strong></li> 
		<div class="pull-right">
		<a class="btn btn-sm" href="<?=base_url();?>proformaInvoice/add_invoice">Add Proforma Invoice</a>
		</div>
	</ol>
<?php
if($this->session->flashdata('flash_msg')!='')
{
?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>	
<?php }?>

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
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/proformaInvoice/manage_invoice').'?invoiceid='.$_GET['invoiceid'].'&invoice_status='.$_GET['invoice_status'].'&invoice_date='.$_GET['invoice_date'].'&cust_name='.$_GET['cust_name'].'&grand_total='.$_GET['grand_total'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
Entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top: -6px;margin-left: 12px;float: right;">
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
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData">
<thead>
<tr>
	   <th><div style="width:100px;">Invoice No.</div></th>
	   
	   <th><div style="width:100px;">Date</div></th>
       <th><div style="width:130px;">Customer Name</div></th>
	   
	   <th style="display:none;"><div style="width:100px;">Status</div></th>
       <th><div style="width:100px;">Grand Total</div></th>
       <th><div >Action</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<form method="get">
<tr>
	
	<td><input name="invoiceid"  type="text"  class="search_box form-control input-sm" style="width:100px;"  value="" /></td>
	
	<td><input name="invoice_date"  type="date"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="cust_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	
	<td style="display:none" >&nbsp;</td>
	<td><input name="grand_total"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php
$i=1;
	foreach($result as $sales)
  {
  ?>

<tr class="gradeC record">
<th><?=$sales->invoiceid;?></th>

<th><?=$sales->buyer_date;?></th>
<th><?php 
		$sqlgroup=$this->db->query("select * from tbl_contact_m where group_name='4' and contact_id='$sales->contactid'");
		$res1 = $sqlgroup->row();
		echo $res1->first_name;?></th>

<th style="display:none" ><?php 
$cdate = date("Y-m-d");
if($dt!=''){
$idate= date('Y-m-d', strtotime($fdate. " + $dt days"));
}else{
$idate=$fdate;
}
$theRequestMadeDateTime = strtotime($idate);
$theCurrentDateTime = strtotime($cdate);
$theDifferenceInSeconds = 600 - ($theCurrentDateTime - $theRequestMadeDateTime);
$minutesLeft = (floor ($theDifferenceInSeconds / (60*60*24)));
if($cdate<$idate)
{
?>
<a href="<?=base_url();?>invoice/invoice/invoice_details?id=<?=$sales->invoiceid;?>&&contact_id=<?=$res1->contact_id;?>">
<samp style="color:#2c96dd">
<?php
echo $minutesLeft." days due";
?>
</samp>
</a>
<?php
}
else
{
?>
<a href="<?=base_url();?>invoice/invoice/invoice_details?id=<?=$sales->invoiceid;?>&&contact_id=<?=$res1->contact_id;?>">
<samp style="color:#ef6f08">
<?php
echo abs($minutesLeft)." days over due";
}
?>
</samp></a></th>
<th><?=$sales->grand_total;?></th>
<th>
<button class="btn btn-default" onClick="openpopup('<?=base_url();?>proformaInvoice/edit_invoice_order',1400,600,'view',<?=$sales->invoiceid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="fa fa-eye"></i> </button>

<button class="btn btn-default" onClick="openpopup('<?=base_url();?>proformaInvoice/edit_invoice_order',1400,600,'id',<?=$sales->invoiceid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>

	<button class="btn btn-default delbutton" id="<?=$sales->invoiceid."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
	




<?php
$pri_col='invoiceid';
$table_name='tbl_invoice_hdr';
	
	?>
    


</th>
</tr>
<?php } ?>
</tbody>
</table>
<div class="row">
  <div class="col-md-12 text-right">
       <div class="col-md-6"> 
             <?=$pagination; ?>
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
    filename = filename?filename+'.xls':'ProformaInvoice_<?php echo date('d-m-Y'); ?>.xls';
    
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