<?php
$this->load->view("header.php");
?>
<form action="insertInboundOrder" method="post">
<!-- Main content -->
<div class="main-content">
<div class="panel panel-default">
<!-- Breadcrumb -->
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Purchase Order</a></li> 
<li class="active"><strong>Add GRN</strong></li>

<div class="pull-right">
<a href="<?=base_url('inbound/manage_inbound');?>" class="btn btn-sm"><i class="fa fa-list" aria-hidden="true"></i>Manage GRN</a>
<!--  <button type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button> -->
</div>
</ol>
<div class="row">
<div class="col-lg-12" id="listingData">

<!--<div class="panel-heading clearfix">
<h4 class="panel-title">Add GRN</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
<li><a data-rel="reload"><i class="icon-arrows-ccw"></i></a></li>
<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> 
</ul> 
</div>
-->

<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="form-group">

<div class="col-sm-6">
<label for="po_order">Buyer Name:</label>
<select name="vendor_id" required id="vendor_id"  class="form-control" onchange="getPO();">
<option value="">---select---</option>
<?php

$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='4' order by first_name");
foreach($contQuery->result() as $contRow)
{
?>
<option value="<?php echo $contRow->contact_id; ?>" >
<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?></option>
<?php } ?>
</select>
</div>

<div class="col-sm-6">
<label for="po_order">PURCHASE ORDER NO.:</label>
<select name="po_no"  class="form-control" id="loc" onchange="getPoItem();"  required>
<option value="">----Select ----</option>
<?php
$queryPo=$this->db->query("select *from tbl_purchase_order_hdr ");
foreach($queryPo->result() as $getPO){

echo '<option value='.$getPO->purchaseid.'>'.$getPO->purchase_no.'</option>';

}
?>
</select>

</div>

<div class="col-sm-6" id="invoiceId" style="display:none">
<label for="po_order">GRN No.:</label>
<input type="text" name="grn_no"  class="form-control" required />

</div>

<div class="col-sm-6" id="grnId" style="display:none">
<label for="po_order">GRN Date.:</label>
<input type="date" name="grn_date" class="form-control" required  />

</div>

</div>

</div>
</div>
</div>
</div>
<!-- <div class="table-responsive-">
</div> -->


<div class="" id="style-3-y">
<div class="force-overflow-y">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example_1" id="itemDiv" style="display:none">
<thead>
<tr>
<th class="tdcenter"> Sl No</th>
<th class="tdcenter">Item Number & Description</th>
<th class="tdcenter">UOM</th>
<th class="tdcenter">Ordered Qty</th>
<th class="tdcenter">Remaining Qty</th>
<th class="tdcenter">Receive Qty</th>

</tr>
</thead>

<tr class="gradeX odd" role="row">
<td class="size-60 text-center sorting_1">1</td>

<td>Company</td>
<td>ATSPL-LM</td>
<td>sdfsd</td>
<td></td>
<td>
iioi

</td>
</tr>
</table>
</div>	  

</div>
</div><!--scrollbar-y close-->		


<!-- <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid "> -->
<!-- <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
</table> -->
<!-- </div> -->
</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<!-- 	<tr class="gradeA">
<th>Sub Total</th>
<th>&nbsp;</th>
<th>
<input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
</th>
</tr>


<tr class="gradeA">
<th>Grand Total</th>
<th>&nbsp;</th>
<th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
</tr>
<tr class="gradeA">
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
<tr class="gradeA">
<th> -->

<!-- <th>&nbsp;</th>
<th >

</th></th> -->
</tr>
</tbody>
</table>
</div>

</div>
<div class ="pull-right" id="saveDiv" style="display:none">
<input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
&nbsp;<a href="<?=base_url();?>inbound/manage_inbound" class="btn btn-sm btn-black btn-outline">Cancel</a>
</div>

</div>
</div>
</div>

</form>
<!-- /.modal-dialog -->
<script>
function getPO()
{

var loc=document.getElementById("vendor_id").value;
var xhttp = new XMLHttpRequest();
xhttp.open("GET", "getPo?loc="+loc, false);
xhttp.send();
document.getElementById("loc").innerHTML = xhttp.responseText;
}

function getPoItem()
{

var loc=document.getElementById("loc").value;


var xhttp = new XMLHttpRequest();
xhttp.open("GET", "getPoItem?poId="+loc, false);
document.getElementById('invoiceId').style.display = "";
document.getElementById('grnId').style.display = "";
document.getElementById('itemDiv').style.display = "";
document.getElementById('saveDiv').style.display = "";




xhttp.send();


document.getElementById("itemDiv").innerHTML = xhttp.responseText;
}

function fsv(v)
{
	
	var validationCheck=document.getElementById("validationCheck").value;
	
	
	if(Number(validationCheck)=='0')
	{
		alert("Please Eneter qty");
		document.getElementById("sv1").disabled = true;
		return false;
	}
	else
	{
v.type="submit";
	}
}

function qtyValidation(v)
{
	
	var zz=document.getElementById(v).id;
	
	var myarra = zz.split("rec_qty");
	var asx= myarra[1];
	var rec_qty=document.getElementById("rec_qty"+asx).value;
	var rem_qty=document.getElementById("rem_qty"+asx).value;
	
	var validationCheck=document.getElementById("validationCheck").value;
	
	document.getElementById("validationCheck").value=rec_qty;
	
	
	


	
if(rec_qty)
{

	if(Number(rec_qty)==0)
	{
		alert("Qty must be grater than 0");
		document.getElementById("sv1").disabled = true;
		return false;
	}
	
}
	if(Number(rem_qty)<Number(rec_qty))
	{
		alert("Enter Qty must be less then enter qty");
		document.getElementById("sv1").disabled = true;
		
		
	}
	else
	{
		document.getElementById("sv1").disabled = false;
	}
	
	
	
}

</script>	
<?php
$this->load->view("footer.php");
?>