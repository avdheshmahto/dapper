<?php
$this->load->view("header.php");
?>

<!-- Main content -->
<div class="main-content">
<div class="panel-default">

	<ol class="breadcrumb breadcrumb-2"> 
		<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
		<li><a href="#">Shape Mapping</a></li> 
		<li class="active"><strong>Manage Shape Mapping</strong></li>
	 <div class="pull-right">
		<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" > <i class="fa fa-plus"></i>Add Shape</button>
		<a class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i> Delete All</a>
	 </div>
	</ol>
<form class="form-horizontal" role="form" method="post" action="insert_machine" enctype="multipart/form-data">

<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content" >

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Shape</h4>
</div>


<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Item Name:</label> 
<div class="col-sm-4"> 
<select  class="form-control"  required name="item_name" id="item_name" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=14");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" ><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>	
</div> 

<label class="col-sm-2 control-label">*Shape Name</label> 
<div class="col-sm-4"> 
<select  class="form-control" required name="shape_name" id="shape_name" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=33");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" ><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>			
<input type="hidden"  name="id" value="" /> 
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Description:</label> 
<div class="col-sm-4"> 
<textarea name="shape_desc" class="form-control" id="shape_desc"></textarea>
</div>  
</div>

</div>

<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save" ></button> 
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>


</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</form>	

<?php
if($this->session->flashdata('flash_msg')!='')
{
?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>	
<?php }?>		

<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 15px 0px 0px;">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length"  style="margin: 15px 0px -30px 15px;">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('/shapeMapping/manage_shape').'?item_name='.$_GET['item_name'].'&shape_name='.$_GET['shape_name'].'&shape_desc='.$_GET['shape_desc'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
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
<br />

<div class="row">
<div class="col-lg-12">
<div class="panel-body">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover dataTables-example11" id="loadData" >
<thead>
<tr>
		
	   <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	   <th>Item Name</th>
       <th>Shape Name</th>
	   <th>Description</th>
       <!-- <th>Capacity</th> -->
	   <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td>&nbsp;</td>
	<td><input name="item_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="shape_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="shape_desc"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>
<?php  

$i=1;
  foreach($result as $fetch_list)
  {

  	$machinQuery1=$this->db->query("select productname,sku_no from tbl_product_stock where Product_id='".$fetch_list->code."'");
  	$getMachine1=$machinQuery1->row(); 

  	$machinQuery2=$this->db->query("select productname,sku_no from tbl_product_stock where Product_id='".$fetch_list->machine_name."'");
    $getMachine2=$machinQuery2->row();

 ?>

<tr class="gradeC record " data-row-id="<?php echo $fetch_list->id; ?>">

<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->id; ?>" value="<?php echo $fetch_list->id;?>" /></th>

<th><a href="<?=base_url();?>shapeMapping/manage_spare_map?id=<?php echo $fetch_list->code; ?>">
<?php echo $getMachine2->productname;?> (<?=$getMachine2->sku_no;?>)</a></th>

<th> <?php echo $getMachine1->productname; ?> (<?=$getMachine1->sku_no;?>)</th>

<th> <?=$fetch_list->machine_des;?> </th>

<!-- <th><?=$fetch_list->capacity;?></th> -->

<th class="bs-example">
<?php if($view!=''){ ?>

<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i;?>" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>

<?php } if($edit!=''){ ?>

<button class="btn btn-default modalEditItem" data-a="<?php echo $fetch_list->id;?>" href='#editItem' onclick="getEditItem('<?php echo $fetch_list->id;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php }
$pri_col='id';
$table_name='tbl_machine';
?>
<button class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>		
<?php
?>
<!--<button style="display:none" class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'>MAP SPARE</button>-->
</th>
</tr>

<div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">VIew Shape</h4>
</div>


<div class="modal-body overflow" style="margin: 0 0 100px 0px;">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Item Name:</label> 
<div class="col-sm-4"> 
<select  class="form-control"  required name="item_name" id="item_name" disabled="disabled" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=14");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" <?php if($fetch_list->machine_name == $sdt['Product_id']){?>selected="selected"<?php }  ?>><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>	
</div> 

<label class="col-sm-2 control-label">*Shape Name</label> 
<div class="col-sm-4"> 
<select  class="form-control" required name="shape_name" id="shape_name" disabled="disabled" >
	<option value="">-- Select --</option>
	<?php $machinQuery=$this->db->query("select * from tbl_product_stock where type=33");
	$getMachine=$machinQuery->result_array(); 
	foreach ($getMachine as $sdt) {
	?>
	<option value="<?=$sdt['Product_id'];?>" <?php if($fetch_list->code == $sdt['Product_id']) { ?>selected<?php } ?> ><?=$sdt['productname'].'('.$sdt['sku_no'].')';?></option>
	<?php } ?>
</select>			
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label" style="margin: 20px 0 0 0;">Description:</label> 
<div class="col-sm-4" style="margin: 20px 0 0 0;"> 
<textarea name="shape_desc" class="form-control" id="shape_desc" readonly="readonly"><?=$fetch_list->machine_des;?></textarea>
</div>  
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_machine">  
<input type="text" style="display:none;" id="pri_col" value="id">
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
</div>

<?php
$this->load->view("footer.php");
?>


<form class="form-horizontal" role="form" method="post" action="insert_machine" enctype="multipart/form-data">			
<div id="editItem" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contentitem" id="modal-contentitem" style="background: #FFF;">

        </div>
    </div>	 
</div>
</form>


<form class="form-horizontal" role="form" method="post" action="insert_spare" enctype="multipart/form-data">			
<div id="mapSpare" class="modal fade modal" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-contentMap" id="modal-contentMap">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Map Spare</h4>
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>Spare Name</th>
<th>Action</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd"  onkeyup="getdata()" onClick="getdata()" id="prd" style=" width:230px;" class="form-control"  placeholder=" Search Items..." tabindex="5" >
<input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />


</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
//include("getproduct.php");
$this->load->view('getproduct');

?>
</div>
</th>

<th>
<input type="button"  id="qn" style="width:70px;" onclick="adda()" value="Add" class="form-control"> 
</th>
</tr>
</tbody>
</table>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:11%;"><div align="center"><u>Item</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_machine_spare_map   ");
foreach($query_dtl->result() as $invoiceFetch)
{
   $productQuery   = $this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->spare_id'");
   $getProductName = $productQuery->row();

?>
<tr>
<td align="center" style="width: 0.2%;"><?php echo $z;?></td>

<td align="center" style="width: 11%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName->productname;?>^<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">
<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"><input type="hidden" value="Box" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>


<td align="center" style="width: 3%;"><img src="<?php echo base_url();?>assets/images/delete.png" border="0" name="dlt" id="dlt<?php echo $z;?>" onclick="deleteselectrow(this.id,this);"  readonly style="border: hidden;"><img src="<?php echo base_url();?>assets/images/edit.png" border="0" name="ed" id="ed<?php echo $z;?>" onclick="editselectrow(this.id,this);" style=" border: hidden;"></td>
</tr>
<?php $row=$z; $z++;  } ?>

</table>

</div>

<input type="hidden" name="rows" id="rows" value="<?php echo $row;?>">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

</div>
</div>
</div>	 
</div>
</form>



<script>


function getEditItem(v){
  var pro   = v;
  var xhttp = new XMLHttpRequest();
 
   xhttp.open("GET", "getMachinePage?ID="+pro, false);
   xhttp.send();
   
   document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
 } 	


function getSpareMap(v){
 var pro   = v;
 var xhttp = new XMLHttpRequest();
 
 xhttp.open("GET", "getSpare?ID="+pro, false);
 xhttp.send();
 document.getElementById("modal-contentMap").innerHTML = xhttp.responseText;
} 	

function showviatype(v)
{
//alert(v);
	if(v==14){
		document.getElementById("viatype").style.display="Block";
	}else{
		document.getElementById("viatype").style.display="none";
	}
}

function showviatype11(v)
{
//alert(v);
	if(v==14){
		document.getElementById("viatypeeee").style.display="Block";
    }else{
		document.getElementById("viatypeeee").style.display="none";
		document.getElementById("via_type").value='';

	}
}
</script>	

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

/*function saveData()
{

var code= document.getElementById("code").value;
var machine_name= document.getElementById("machine_name").value;
var machine_des= document.getElementById("machine_des").value;
var capacity= document.getElementById("capacity").value;

if(machine_name == ''){
  document.getElementById("codemsg1").innerHTML = "Please Select Item Name ";
  return false;	
}


if(code=='')
{
document.getElementById("codemsg").innerHTML = "Please Select Shape Name ";


return false;
}
 var xhttp = new XMLHttpRequest();
 
  xhttp.open("GET", "insert_machine?code="+code+"&machine_name="+machine_name+"&machine_des="+machine_des+"&capacity="+capacity, false);
  xhttp.send();


$("#modal-0 .close").click();	   
 document.getElementById("loadData").innerHTML = xhttp.responseText;
	
 document.getElementById("code").value='';
	
}
*/
	
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
<script>
//add item into showling list
window.addEventListener("keydown", checkKeyPressed, false);
//funtion to select product
function checkKeyPressed(e) {
var s=e.keyCode;

var ppp=document.getElementById("prd").value;
var sspp=document.getElementById("spid").value;//
var ef=document.getElementById("ef").value;
		ef=Number(ef);
		
var countids=document.getElementById("countid").value;

//if(countids==''){
//countids=1;
//}

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup  = function (e) {
var entr =(e.keyCode);
if(entr==13){
document.getElementById("qn").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}


document.getElementById("qn").onkeyup = function (e) {
var entr =(e.keyCode);
if(document.getElementById("qn").value=="" && entr==08){

}
   if (e.keyCode == "13")
	 {
	
	 e.preventDefault();
     e.stopPropagation();
	
	  if(ppp!=='' || ef==1)
	 {

	
			adda();	  	
			
		
			
		
		var ddid=document.getElementById("spid").value;
		var ddi=document.getElementById(ddid);
		ddi.id="d";
		
			}
	       else
			{
	   alert("Enter Correct Product");
			}
		return false;
    }
	}
}
/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;

if(rc!=0)
{
v.type="submit";
}
else
{
	alert('No Item To Save..');	
}
}


////////////////////////////////// ######################## starts edit code ############################## ////////////////////////////////


function editselectrow(d,r) 
{
 
	var regex = /(\d+)/g;
	nn= d.match(regex)
	id=nn;
		if(document.getElementById("prd").value!=''){
			document.getElementById("qn").focus();
			alert("Product already in edit Mode");
			return false;
		}


		// ####### starts ##############//
		
		var pd=document.getElementById("pd"+id).value;
		var pri_id=document.getElementById("main_id"+id).value;
		
		
		// ####### ends ##############//

		// ####### starts ##############//
		
		document.getElementById("pri_id").value=pri_id;
		document.getElementById("qn").focus();
		document.getElementById("prd").value=pd;
		
		// ####### ends ##############//
		
		// ####   EDIT CALCULATION      ##############//
		
		
        //####    EDIT CALCULATION       ############//
		
    	var i = r.parentNode.parentNode.rowIndex;
		document.getElementById("invoice").deleteRow(i);
}

////////////////////////////////// ########################## ends edit code ###########################################////////////////////////////////




//////////////////////////////////################################ starts delete code ##################################////////////////////////////////

function deleteselectrow(d,r) //
{
		var regex = /(\d+)/g;
		nn= d.match(regex)
		id=nn;
		if(document.getElementById("prd").value!=''){
 			document.getElementById("prd").focus();
     		alert("Product already in edit Mode");
			return false;
		}

		var pd=document.getElementById("pd"+id).value;
		var pri_id=document.getElementById("main_id"+id).value;
	    var i = r.parentNode.parentNode.rowIndex;
	    var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
		if (cnf== true)
 		{
 			document.getElementById("invoice").deleteRow(i);
			slr();
		}
	
}
////////////////////////////////// #################################### ends delete code #########################################////////////////////////////////


function getdata()
		  {
		  
		 currentCell = 0;
		 var product1=document.getElementById("prd").value;	 
		 var product=product1;
		 	
		    if(xobj)
			 {
			 var obj=document.getElementById("prdsrch");
			
			 xobj.open("GET","getproduct?con="+product,true);
			 xobj.onreadystatechange=function()
			  {
			  if(xobj.readyState==4 && xobj.status==200)
			   {
			    obj.innerHTML=xobj.responseText;
			   }
			  }
			 }
			 xobj.send(null);
		  }
  
////////////////////////////////////////////////////

 function slr(){
		var table = document.getElementById('invoice');
        var rowCount = table.rows.length;
		  for(var i=1;i<rowCount;i++)
		  {    
              table.rows[i].cells[0].innerHTML=i;
		  }
			 
			  
}  

//////////////////////////////////////////////////////////////

     var rw=0;
	 
 function adda()
		  { 
		 
		  		 

				var qn=document.getElementById("qn").value;
				
				//default
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
						
		     				clear();
				
					 currentCell = 0;
	if(pd!="" && qn!=0)
					{
				     var indexcell=0;
								var row = table.insertRow(-1);
						rw=rw+0;
						
						//cell 0st
	 var cell=cell+indexcell;		
 	 cell = row.insertCell(0);
	 cell.style.width=".20%";
	 cell.align="center"
	cell.innerHTML=rid;
				
				
				//cell 1st item name
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
			
	    cell = row.insertCell(indexcell);
				cell.style.width="11%";
				cell.align="center";
				
				
				
				
				//============================item text ============================
				var prd = document.createElement("input");
							prd.type="text";
							prd.border ="0";
							prd.value=pd;	
							prd.name='pd[]';//
							prd.id='pd'+rid;//
							prd.readOnly = true;
							prd.style="text-align:center";  
							prd.style.width="100%";
							prd.style.border="hidden"; 
							cell.appendChild(prd);
				var priidid = document.createElement("input");
							priidid.type="hidden";
							priidid.border ="0";
							priidid.value=pri_id;	
							priidid.name='main_id[]';//
							priidid.id='main_id'+rid;//
							priidid.readOnly = true;
							priidid.style="text-align:center";  
							priidid.style.width="100%";
							priidid.style.border="hidden"; 
							cell.appendChild(priidid);
							
		
		//======================================close net price====================================							
		//cell 3st
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
	var imageloc="/mr_bajaj/";
	var cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center";
				var delt =document.createElement("img");
						delt.src ="<?=base_url();?>assets/images/delete.png";
						delt.class ="icon";
						delt.border ="0";
						delt.style.width="30%";
						delt.style.height="20%";
						delt.name ='dlt';
						delt.id='dlt'+rid;
						delt.style.border="hidden"; 
						delt.onclick= function() { deleteselectrow(delt.id,delt); };
					    cell.appendChild(delt);
	var edt = document.createElement("img");
						edt.src ="<?=base_url();?>/assets/images/edit.png";
						edt.class ="icon";
						//edt.style.width="60%";
						//edt.style.height="40%";
						edt.border ="0";
						edt.name ='ed';
						edt.id='ed'+rid;
						edt.style.border="hidden"; 
						edt.onclick= function() { editselectrow(delt.id,edt); };
						cell.appendChild(edt);
			

			
			}
			else
			{
			if(qn==0)
				{
					alert('***Quantity Can not be Zero ***');
					
					
				}
				else
				{
				
			alert('***Please Select PRODUCT ***');
			
			}
			}

function clear()
{

// this finction is use for clear data after adding invoice
		document.getElementById("prd").value='';
		document.getElementById("pri_id").value='';
		
		
		document.getElementById("prd").focus();	
		
}


function totalSum(){

var subb=document.getElementById("sub_total").value;
			var tol=(Number(nettot));
			var total=Number(tol)+Number(subb);
	
			document.getElementById("sub_total").value=total.toFixed(2);
			document.getElementById("grand_total").value=total.toFixed(2);	

}

// ###### starts when item we edit or delete ##########//
function editDeleteCalculation()
{
var sub_total=document.getElementById("sub_total").value;

sub_total_cal=sub_total-nettot;

document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
document.getElementById("grand_total").value=sub_total_cal.toFixed(2);
}
// ##### ends ###########

}

// ###### starts service charge calculation ##########//
function serviceChargeCal()
{

var sub_total=document.getElementById("sub_total").value;
var service_charge=document.getElementById("service_charge").value;

service_total_per=Number(sub_total)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

document.getElementById("service_charge_total").value=service_total_per.toFixed(2);
document.getElementById("grand_total").value=service_total_cal.toFixed(2);
return service_total_cal.toFixed(2);
}
// ##### ends ###########
  

// ###### starts gross discount calculation ##########//
function grossDiscountCal()
{

var serviceTotl=serviceChargeCal();

var gross_discount_per=document.getElementById("gross_discount_per").value;
var gross_discount_total=document.getElementById("gross_discount_total").value;
var grand_total=document.getElementById("grand_total").value;


service_total_per=Number(serviceTotl)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

var totalGross=Number(serviceTotl)*Number(gross_discount_per)/100;
var totalGrossCal=Number(grand_total)-Number(totalGross);

document.getElementById("gross_discount_total").value=totalGross.toFixed(2);
document.getElementById("grand_total").value=totalGrossCal.toFixed(2);
}
// ##### ends ###########

      
</script>