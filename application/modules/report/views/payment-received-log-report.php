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
<h4 class="panel-title">PAYMENT RECEIVED LOG REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>

<!--<div class="panel-body">-->
<div class="panel-body" style="    background: #dedede;    padding: 20px 0px;    margin-bottom: 25px;">
<form class="form-horizontal" method="get">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Customer Name</label> 
<div class="col-sm-3"> 
<select id="contactid" class='form-control' name="contactid">
 <?php
 $contQuery=$this->db->query("select * from tbl_contact_m where comp_id='".$this->session->userdata('comp_id')."' and group_name='4' order by first_name");
 ?>
 <option value=''>Please Select</option>
 <?php 
 foreach($contQuery->result() as $contRow)
{

  ?>
    <option value="<?php echo $contRow->contact_id; ?>" <?php if($contRow->contact_id==$customerfname){?> selected="selected" <?php }?>>
    <?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?></option>
    <?php } ?>
</select>
</div>
<label class="col-sm-2 control-label">Payment Mode</label> 
<div class="col-sm-3"> 
<select name="payment_mode" id="payment_mode_id" class="form-control">
<option value="">--Select--</option>
<option value="Cash">Cash</option>
<option value="Bank">Bank</option>
<option value="Cheque">cheque</option>

</select>
</div>
</div>
<div class="form-group panel-body-to">
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" value="" /> 
</div>
</div>
<div class="col-sm-6" style="float:right;padding: 5px 0 0 96px;"> 
<label class="col-sm-2 control-label"><button type="submit" name="filter" value="filter" onsubmit="trfun()" class="btn btn-sm">Search</button></label>  
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
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchPaymentReceivedLogReport');?>" class="form-control input-sm">
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
 		<th>SERIAL No.</th>
		<th>CUSTOMER NAME</th>
        <th>RECEIVED AMOUNT</th>
		<th>DATE</th>   
		<th>PAYMENT MODE</th>
		
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;
//if(!empty($SearchPaymentReceivedLog)) {
foreach($result as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php 
$contQuery=$this->db->query("select * from tbl_contact_m where group_name='4' and contact_id='$rows->contact_id'");
$getInv=$contQuery->row();
echo $getInv->first_name; ?></th>
<th><?php echo $rows->receive_billing_mount; ?></th>
<th><?php echo $rows->date; ?></th>
<th><?php echo $rows->payment_mode;?></th>
</tr>
<?php
@extract($_POST);

if(@$Show!='')
{
  $queryy1=$this->db->query("select * from tbl_invoice_payment where status='invoice' and contact_id='$rows->contact_id' ");
}
if(@$Show=='')
{
	$queryy1=$this->db->query("select * from tbl_invoice_payment where status='invoice' ");
}
$total_bill=0;
foreach($queryy1->result() as $line1)
{
	$total_bill=$total_bill + $line1->receive_billing_mount;
} 
 
//$sum1=0;
$sum1 = $total_bill;
$sum2 = $sum2 + $rows->receive_billing_mount;
$sum3 = $sum1 - $sum2;
} //} ?>

<input type="hidden" name="totalbill" id="totalbill" class="form-control" value="<?php echo $sum1;?>" readonly />
 <input type="hidden" name="recamt" id="recamt" class="form-control" value="<?php echo $sum2;?>" readonly />
 <input type="hidden" name="dueamt" id="dueamt" class="form-control" value="<?php echo $sum3;?>" readonly />
<tr id="trid" style="display:none">
 		<th>Total Billing Amount =</th>
		<th><input type="text" name="ttl_bill_amt" id="ttl_bill_amt" class="form-control" style="width:100px;" value=""  readonly=""/></th>
        <th>Received Amount =</th>
		<th><input type="text" name="recvd_amt" id="recvd_amt" class="form-control" style="width:100px;" value=""  readonly=""/></th>   
		<th>Due Amount = <input type="text" name="due_amt" id="due_amt" class="form-control" style="width:100px;" value=""  readonly=""/></th>
		
</tr>
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
<script>
var id1=document.getElementById("totalbill").value;
document.getElementById("ttl_bill_amt").value = id1;
//alert(id);
var id2=document.getElementById("recamt").value;
document.getElementById("recvd_amt").value = id2;
//alert(id);
var id3=document.getElementById("dueamt").value;
document.getElementById("due_amt").value = id3;
//alert(id);

</script>
<script>

function trfun()
{
	var contactid=document.getElementById("contactid").value;
	//alert(contactid);
	if(contactid!=''){
		document.getElementById("trid").style.display= "Block";
	}else{
		document.getElementById("trid").style.display = "none";
	}

}

</script>
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
    filename = filename?filename+'.xls':'PaymentReceivedLogReport_<?php echo date('d-m-Y');?>.xls';
    
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