<?php
$this->load->view("header.php");
$scheQuery=$this->db->query("select *from tbl_issuematrial_hdr where inboundid='".$_GET['id']."' and status = 'A'");
$getsched=$scheQuery->row();

?>

<style type="text/css">

	.select2-container--open {
       z-index: 99999999 !important;
	 }
	 .select2-container {
       min-width: 256px !important;
     }
</style>

<script>



function saveData_metering()
 {
//alert("wf");
 myFunction_meter();
 var pri_id_meter= document.getElementById("pri_id_meter").value;
 //var prdd= document.getElementById("prdd").value;
 //var qty= document.getElementById("qty").value;
 var datetimepicker_mask= document.getElementById("datetimepicker_mask").value;
 var unit_metering= document.getElementById("unit_metering").value;
 var readingmeter= document.getElementById("readingmeter").value;
 // var machine_name= document.getElementById("machine_name").value;

if(unit_metering=='')
{
alert("Please Enter Unit");
return false;
}
if(datetimepicker_mask=='')
{
alert("Please Enter Date");
}


if(readingmeter=='')
{
alert("Please Enter Reading");
return false;
}

// var machine_name= document.getElementById("machine_name").value;
 //alert(machine_name);
 var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "insert_spare_unit?pri_id_meter="+pri_id_meter+"&unit_metering="+unit_metering+"&readingmeter="+readingmeter+"&datetimepicker_mask="+datetimepicker_mask, false);
 xhttp.send();
 $("#mapSpareunit .close").click();	   
  document.getElementById("loadSpareMetering").innerHTML = xhttp.responseText;

  console.log(xhttp.responseText);

 } 
//******************************************************************************************************************************************************************************************************************************************************************************************************

//*********************************************************************************************************************************************************************************************************************************************************************************************************
</script>

<script>
function test()
{
//alert();
var readtype = document.getElementById("readtype").value;

if(readtype=='End By')
{
document.getElementById("end_by_reading").style.display = "";


}else{

document.getElementById("end_by_reading").style.display = "none";

}
}


function test_meter()
{
//alert();
var readtype_meter = document.getElementById("readtype_meter").value;

if(readtype_meter=='End By')
{
document.getElementById("end_by_reading_meter").style.display = "";
	
  

}else{

document.getElementById("end_by_reading_meter").style.display = "none";

}
}


function checkdata(v)
{
	var testa = document.getElementById("yuttt").value;
}



</script>


<!-- Main content -->
<div class="main-content">
<div class="panel-body panel panel-default">		
<div class="row">
<div class="col-lg-12">
<div class="panel-body">
<div class="row centered-form">
<div class="col-xs-12 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading" style="background-color: #F5F5F5; color:#000000; border-color:#DDDDDD;">
<h3 class="panel-title" style="float: initial;">Production Details:-<?=$getsched->inboundid;?>
	
	<a href="#" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
</h3>
</div>
<div class="panel-body">
<form role="form">
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<h4>Production Id</h4>
<?php 
/*$queryType101=$this->db->query("select *from tbl_machine where id='$getsched->machine_name'");
$getType101=$queryType101->row();
*/
?>
<input type="text" name="" value="<?=$getsched->inboundid;?>" id="first_name" class="form-control" readonly >
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
<h4>Date</h4>
<div class="form-group">
<?php 
/*$queryType=$this->db->query("select *from tbl_facilities where id='$getsched->m_type'");
$getType=$queryType->row();
*/
?>
<input type="text" name="" value="<?=$getsched->grn_date;?>" class="form-control" readonly>

</div>
</div>
</div>


<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<h4>Vendor Name</h4>
<?php 
$queryPo=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='$getsched->po_no'");
$getTypePo=$queryPo->row();


$queryVendor=$this->db->query("select *from tbl_contact_m where contact_id='$getTypePo->vendor_id'");
$getVendor=$queryVendor->row();
?>
<input type="text" name="" class="form-control" value="<?=$getVendor->first_name;?>" readonly >
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6">
<div class="form-group">
<h4>Total Qty</h4>

<?php

$queryIssueMat=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where inboundrhdr='$getsched->inboundid'");
$getIssueMat=$queryIssueMat->row();
?>
<input type="text" name="" value="<?=$getIssueMat->qty;?>" class="form-control" readonly>
</div>
</div>
</div>



</form>
</div>
</div>
</div>
</div>


<div class="tabs-container">
<ul class="nav nav-tabs">
<li class="active"><a href="#home" data-toggle="tab">Job Work</a></li>
<li><a href="#spare" data-toggle="tab">Purchase Order</a></li>
<li style="display:none" class=""><a href="#work_order" data-toggle="tab">Work Order Log</a></li>
<li style="display:none" class=""><a href="#four" data-toggle="tab">Four</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane  active" id="home">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="loadSpare">
<thead>
	<tr>
		<th>Job Work Code</th>
		<th>Job Work name</th>
		<th>co</th>
		<th>Co</th>
		<!--<th>Purchase Price</th>-->
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php
/*
$i=1;
  foreach($result as $fetch_list)
  {
   $unitName=$this->db->query("select *from  tbl_master_data where serial_number='$fetch_list->unit'");
   $getunitD=$unitName->row();
   */
?>

    <tr class="gradeU record">
	
	 <td>1</td>
        <td>
		Test</td>
	
	<?php 
	/*
	$sqlQueryMachineIdview=$this->db->query("select * from tbl_machine_spare_unit_map where machine_id ='$getType101->id'  and status = 'A' order by id desc limit 0,1");
	
	$getMachineIdview=$sqlQueryMachineIdview->row();
	*/
?>
	
	
<td>&nbsp;</td>
	
		  <td><?=$fetch_list->next_trigger_reading;?></td>
        
        <td><?php $pri_col='id';
                  $table_name='tbl_schedule_triggering';
         ?>
       
        <button class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col ; ?>" type="button" title="Delete Schedule Trigger"><i class="icon-trash"></i></button>		
        </td>
    </tr>
<?php // }?>
<tr class="gradeU">
<td>

 
 
<button type="button" class="btn btn-default modalMapSpare" data-toggle="modal" data-target="#modal-2"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
 
 
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>

</tbody>
<tfoot>
<!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
</tfoot>
</table>
</div>
</div>
</div>
<div class="tab-pane" id="spare">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="listingData" >
<thead>
<tr>
<th>Po Code</th>

<th>Action</th>
<!--<th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th>-->
</tr>
</thead>

<tbody>
<?php
/*
$i=1;
	 $sparemapName=$this->db->query("select * from tbl_schedule_spare_triggering where schedule_id = '$getsched->id' and status = 'A' GROUP BY trigger_code ");
  foreach($sparemapName->result() as $fetch_map_spare)
  {
   $sparemapNamestock=$this->db->query("select *from tbl_product_stock where Product_id='$fetch_map_spare->spare_id'");
   $getSparemapstock=$sparemapNamestock->row();
   $sparemaptrigName=$this->db->query("select * from tbl_schedule_triggering where id='$fetch_map_spare->trigger_code' and status = 'A'");
	$getSparetrigmap=$sparemaptrigName->row();
  // echo "select * from tbl_schedule_triggering where id='$fetch_map_spare->trigger_code' and status = 'A' GROUP BY trigger_code ";
$sparemapNamemul=$this->db->query("select T.spare_id,T.quantity,S.productname from tbl_schedule_spare_triggering T ,tbl_product_stock S where T.trigger_code = '$fetch_map_spare->trigger_code'  and T.status = 'A' AND S.Product_id = T.spare_id ");

 $ssss =  $sparemapNamemul->result();
 if($ssss != "")
 	$ssss  =  json_encode($ssss);

  */
?>

    <tr class="gradeU record">
       
	   <td>1</td>
		     
		
   

    </tr>
<?php //}?>
<tr class="gradeU">
<td>

</td>
<td>&nbsp;</td>


</tr>

</tbody>


<!--<tbody>





<tr class="gradeX">
<td>Misc</td>
<td>Lynx</td>
<td>Text only</td>
<td>-</td>
<td>X</td>
</tr>



</tbody>-->

</table>
</div>

</div>
</div>
<div class="tab-pane" id="work_order">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
<th>Trigger Code</th>
<th>Updated Trigger Value</th>
<th>Date Of Created Work Order</th>
<!--<th>Serail No.</th>
<th>Description</th>
--></tr>
</thead>
<?php
 /*$triggerlog=$this->db->query("select * from tbl_schedule_triggering_log where schedule_id = '$getsched->id' and status = 'A' ORDER BY next_trigger_reading DESC ");
  foreach($triggerlog->result() as $fetch_map_triggerlog)
  {
  */
?>
<tbody>
<tr class="gradeA">
<td><?="TR".$fetch_map_triggerlog->trigger_code;?></td>
<td><?=$fetch_map_triggerlog->next_trigger_reading;?></td>
<td><?=$fetch_map_triggerlog->author_date;?></td>
<!--<td>Serail No.</td>
<td>Description</td>-->
</tr>
</tbody>
<?php /*}*/?>
<tfoot>

</tfoot>
</table>
</div>
</div>
</div>
<div class="tab-pane" id="four">
<div class="panel-body">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
<th>Rendering engine</th>
<th>Browser</th>
<th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th>
</tr>
</thead>
<tbody>
<tr class="gradeC">
<td>Misc</td>
<td>PSP browser</td>
<td>PSP</td>
<td>-</td>
<td>C</td>
</tr>
<tr class="gradeU">
<td>Other browsers</td>
<td>All others</td>
<td>-</td>
<td>-</td>
<td>U</td>
</tr>
</tbody>
<tfoot>
<tr>
<th>11Rendering engine</th>
<th>Browser</th>
<th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div><!--tabs-container close-->
</div>
</div>
</div>
</div>
</div><!--main-content close-->

<?php

$this->load->view("footer.php");
?>


	

<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.name="chkbox[]";
			cell1.appendChild(element1);
			
var cell2 = row.insertCell(1);
			var element2 = document.createElement("select");
			element2.name = "spare_id[]";
			element2.className="form-control";
			element2.style.width="250px";
			var option1 = document.createElement("option");
			option1.innerHTML = "--Select--";
    option1.value = "";
    element2.appendChild(option1, null);
	<?php
	$contactQuery=$this->db->query("select *from tbl_product_stock where status='A'");
	foreach($contactQuery->result() as $getContact){
	?>
	
    var option2 = document.createElement("option");
    option2.innerHTML = "<?=$getContact->productname;?>";
    option2.value = "<?=$getContact->Product_id;?>";
    element2.appendChild(option2, null);
    
	<?php }?>
			cell2.appendChild(element2);
			

		}



		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

// function saveData()
// {
// 	  var code= document.getElementById("code").value;
// 	  var machine_name= document.getElementById("machine_name").value;
// 	  var machine_des= document.getElementById("machine_des").value;
// 	  var capacity= document.getElementById("capacity").value;
	  
// 	  if(code=='')
// 	  {
// 	   document.getElementById("codemsg").innerHTML = "Please Enter Code";
// 	   return false;
// 	  }
// 	 var xhttp = new XMLHttpRequest();
// 	 xhttp.open("GET", "insert_machine?code="+code+"&machine_name="+machine_name+"&machine_des="+machine_des+"&capacity="+capacity, false);
// 	 xhttp.send();
	 
// 	 $("#modal-0 .close").click();	   
// 	 document.getElementById("loadData").innerHTML = xhttp.responseText;
// 	 document.getElementById("code").value='';
// }


	
    </SCRIPT>

<script>
/*$(document).ready(function() {
  $.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
  setInterval(function() {
    //$('#getDataTable').load('get_machine');
  }, 3000); // the "3000" 
});
*/
</script>


<style>
.c-error .c-validation{ 
  background: #c51244 !important;
  padding: 10px !important;
  border-radius: 0 !important;
  position: relative; 
  display: inline-block !important;
  box-shadow: 1px 1px 1px #aaaaaa;
  margin-top: 10px;
}
.c-error  .c-validation:before{ 
  content: ''; 
  width: 0; 
  height: 0; 
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 10px solid #c51244;
  position: absolute; 
  top: -10px; 
}
.c-label:after{
  color: #c51244 !important;
}
.c-error input, .c-error select, .c-error .c-choice-option{ 
  background: #fff0f4; 
  color: #c51244;
}
.c-error input, .c-error select{ 
  border: 1px solid #c51244 !important; 
}

</style>



<!--Large Modal-->
<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Production</h4>
</div>

<div class="modal-body">
<div class="row">
<form class="form-horizontal" role="form" id="ItemForm" novalidate="novalidate">	
<div class="form-group">
<label class="col-sm-2 control-label">Vendor:</label> 
<div class="col-sm-4">
<input name="size" type="text" value="" class="form-control" id="size"> 
</div>
<label class="col-sm-2 control-label">date:</label> 
<div class="col-sm-4"> 
<input name="thickness" type="text" value="" class="form-control" id="thickness"> 
</div>
</div>

</div>

<div class="row">
<div class="col-sm-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">Shape:</label>
    <div class="col-sm-10">
      <select class="form-control" name="shape" id="shape" onchange="getPart(this.value);">
        <option value="">--Select--</option>
        <?php
$queryProductShape=$this->db->query("select *from tbl_machine where code='3'");
foreach($queryProductShape->result() as $getProductShape){
$queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->code'");
$getProduct=$queryProduct->row();

?>
        <option value="<?=$getProduct->Product_id;?>"><?=$getProduct->productname;?></option>
        <?php }?>
      </select>
    </div>
 

    
   
  </div>



</div>

<div class="col-sm-6" id="getPartView">

</div>
<div class="modal-header">
       <br>
       <table class="table table-bordered table-hover" >
       	<br>
       	  <tbody>
       	  	<tr class="gradeA">
				<th>Shape Name</th>
				
				<th>Part</th>
				<th>Qty</th>
				<th>Action</th>
			</tr>
       	  </tbody>
       	  <tbody id="quotationTable">
       	  	<?php if($result != ""){
              foreach ($result as  $dt) {
                 $query11    = $this->db->query("select * from tbl_product_stock where Product_id = '".$dt['rowmatial']."'");
                 $rowmatrial = $query11->row(); 

                 $uom        = $this->db->query("select * from tbl_master_data where serial_number = '".$dt['unit']."'");
                 $rowmatrialuom = $uom->row();
            ?>
              	<tr>
              	<td><input type ="hidden" name="prodcId[]" value="<?=$dt['rowmatial'];?>"><?=$rowmatrial->productname;?></td>
              	
              	
				<td><input type ="hidden" name="mproPrice[]" value="<?=$dt['qty'];?>"><?=$dt['qty'];?></td>
              	<td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td>
              	</tr>
              	
            <?php  }
       	  	} ?>
       	  </tbody>
       </table>

     </div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End Large Modal-->



<script>
function addpricemap(){

	var shapeid =  $('#shape').val();
	var shapeVal     =  $("#shape option:selected").text();   
	var part=$('#part').val();
	var PartId     = [];
	var qty= []; 
	j=0;i=0;
	$('input[name="part[]"]').each(function(){
	PartId[i++]  = $(this).val();
	});

$('input[name="qty[]"]').each(function(){
	qty[j++]  = $(this).val();
	});
      
	var myObject  = new Object();
     // myObject.productId = $('#quotationPro').val();
	 
	var pa=myObject.part = PartId;
	var qt=myObject.qty = qty;
	
	var myString = JSON.stringify(myObject);    
     
     // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
      //$('#QuotationMap').val(myString);
	  
	  
       $('#quotationTable').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+shape+'">'+shapeVal+'</td><td>'+pa+'</td><td>'+qt+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');
    
	$("#shape").val("");
	$("#getPartView").text("");




  }
function getPart(v)
{

   var ur = '<?=base_url();?>productionModule/getPart';
   $.ajax({
      type: "POST",
      url: ur,
      data: {'shape':v},
      success: function(data){
       
       // console.log(data);
        $("#getPartView").empty().append(data).fadeIn();
		 

		// $("#btn").prop('disabled', false);

		
      }
    });



}
</script>


