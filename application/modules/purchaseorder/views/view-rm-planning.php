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
<a href="<?=base_url('purchaseorder/manage_purchase_order');?>" class="btn  btn-sm pull-right"><i class="icon-left-bold"></i>Back</a>

</div>
</ol>
<div class="row">
<div class="col-lg-12" id="listingData">

<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="form-group">

<div class="col-sm-6">
<label for="po_order">Vendor Name:</label>
<select name="vendor_id" required id="vendor_id"  class="form-control" onchange="getPO__();" disabled="">
<option value="">---select---</option>
<?php

$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='5' order by first_name");
foreach($contQuery->result() as $contRow)
{
?>
<option value="<?php echo $contRow->contact_id; ?>" <?php if($contRow->contact_id == $_GET['vid']) { ?> selected <?php } ?> >
<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?></option>
<?php } ?>
</select>
</div>

<div class="col-sm-6">
<label for="po_order">RM Planning No.:</label>
<select name="po_no"  class="form-control" id="loc" onchange="getPoItem__();"  disabled=""> 
<option value="">----Select ----</option>
<?php
$queryPo=$this->db->query("select *from tbl_purchase_order_hdr ");
foreach($queryPo->result() as $getPO){ ?>

<!-- echo '<option value='.$getPO->purchaseid.'>'.$getPO->purchase_no.'</option>'; -->

<option value="<?=$getPO->purchaseid?>" <?php if($getPO->purchaseid == $_GET['pid']) { ?>selected <?php } ?> > <?php echo $getPO->purchase_no ?> </option>
<?php }?> 
</select>

</div>

<div class="col-sm-6" id="invoiceId">
<label for="po_order">GRN No.:</label>
<input type="text" name="grn_no"  class="form-control" required />
</div>

<div class="col-sm-6" id="grnId">
<label for="po_order">GRN Date.:</label>
<input type="date" name="grn_date" class="form-control" required  />
</div>

</div>

</div>
</div>
</div>
</div>

<?php

$productQuery=$this->db->query("select SUM(qty) as poQty,SUM(qn_pc) as qnPc,SUM(qn_pc) as po_qn_pc_qty,productid,purchaseid from tbl_purchase_order_dtl where purchaseid='".$_GET['pid']."' group by productid ");
$getNoVal=$productQuery->row();

$productValQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getNoVal->productid'");
$getProductVal=$productValQuery->row();

?>
<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
<thead>
<tr>
<th class="tdcenter">Sl No.</th>
<th class="tdcenter">RM Code</th>
<th class="tdcenter">Item Number & Description</th>
<th class="tdcenter">UOM</th>
<?php
if($getProductVal->usageunit=='18')
{
}
else{
?>
<th class="tdcenter">Ordered Qty</th>
<?php
}
?>
<th class="tdcenter">Ordered Weight</th>
<th class="tdcenter">Remaining Qty</th>
<th class="tdcenter">Remaining Weight</th>
<th class="tdcenter">Received  Qty</th>
<th class="tdcenter">Received Weight</th>

</tr>
</thead>
<?php
$i=1;
foreach($productQuery->result() as $getProduct){

####### get product #######
$productStockQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getProduct->productid'");
$getProductStock=$productStockQuery->row();
####### ends ########

####### get UOM #######
$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
$getProductUOM=$productUOMQuery->row();
####### ends ########

$logRmQuery=$this->db->query("select SUM(receive_qty) as poLogQty from tbl_inbound_log where po_no='".$_GET['pid']."' and productid='$getProduct->productid' ");

$getRM=$logRmQuery->row();
?>
<tr class="gradeX odd" role="row">
<td class="size-60 text-center sorting_1"><?=$i;?></td>
													 
<td><?=$getProductStock->sku_no;?> 


<input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
</td>
<td><?=$getProductStock->sku_no;?>&<?=$getProductStock->productname;?></td>
<td><?=$getProductUOM->keyvalue;?></td>
 <?php
if($getProductVal->usageunit=='18')
{
}
else{
?>
<td><?=$getProduct->qnPc;?>
<?php }?>                                  
    </td>
    
    <?php

	$inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty,SUM(qn_pc) as qty_qn_pc from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
	$getInbound=$inbountLogQuery->row();
	
	
	?>
	<td><?=$getProduct->poQty?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?php echo $rmR=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">
    
    <input type="hidden" name="po_no" value="<?=$getProduct->purchaseid?>" />
   
    
    </td>
    <td><?=$getProduct->qnPc-$getInbound->qty_qn_pc;?>                                 
    
   
    
    </td>
    
    <td><?=$getProduct->poQty-$getInbound->rec_qty;?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?php echo $rmR=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">
    
    
   
    
    </td>
    <td><input type="number" min="1" name="qn_pc[]" id="qn_pc<?=$i;?>" step="any"  class="form-control">
    
    
    </td>
    
    <td>
<input type="hidden" id="circle_w<?=$i;?>" value="<?=$getProductStock->circle_weight;?>" />
    
    <input type="number" min="1" step="any" name="receive_qty[]" id="rec_qty<?=$i;?>" <?php if($rmR=='0'){?> readonly="readonly" <?php }?> onkeyup="qtyValidation(this.id);" class="form-control">
    
    <input type="hidden" name="validationCheck" id="validationCheck" value="0" />
    </td>
</tr>
<?php 

$ordQtyTot=$ordQtyTot+$getProduct->poQty;
$remQtyTot=$remQtyTot+$getRM->poLogQty;
$i++;
}?>

            
</table>
<input type="hidden" name="qrd_qtyT" id="qrd_qtyT"  value="<?=$ordQtyTot;?>" />
<input type="hidden" id="remQyT" value="<?=$remQtyTot;?>" />
<input type="hidden" name="totToCom" id="totTocomp" />



</div>
<!--//////////ADDING TEST/////////-->

<!-- <input type="hidden" name="rows" id="rows">
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>

</tr>
</tbody>
</table>
</div>
</div> -->

<div class ="pull-right" id="saveDiv" style="display:none1">
<input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
&nbsp;<a href="<?=base_url();?>purchaseorder/manage_purchase_order" class="btn btn-sm btn-black btn-outline">Cancel</a>
</div>

</div>
</div>
</div>

</form>


<div class="tabs-container">

<ul class="nav nav-tabs">
<li class="active"><a href="#home" data-toggle="tab">Grn Log</a></li>
<li><a href="#Return" data-toggle="tab">Return</a></li>
<li style="display:none;" ><a href="#store" data-toggle="tab">store</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane  active" id="home">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
<thead>
	<tr>
    <th>Order Type</th>
		<th>Order no.</th>
		<th>Vendor Name</th>
		<th>Date</th>
        <th>Status</th>
		
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php

$queryData=$this->db->query("select *from tbl_job_work where production_id='".$_GET['id']."' ");
  foreach($queryData->result() as $fetch_list)
  {
  
?>



    <tr class="gradeU record">
	<td>
    <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
    <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
    
    
    
    <a href="<?=base_url();?>productionModule/manage_jobwork_map_details?id=<?=$fetch_list->id;?>&&p_id=<?=$_GET['id'];?>"><?=$fetch_list->order_type;?></a>
   
    <button style="display:none" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$fetch_list->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><?=$fetch_list->order_type;?></button></td>
	 <td>
     
     
     <?=$fetch_list->job_order_no;?></td>
    
    <?php 
	
	$sqlQueryMachineIdview=$this->db->query("select * from tbl_contact_m where contact_id ='$fetch_list->vendor_id'  and status = 'A' ");
	
	$getMachineIdview=$sqlQueryMachineIdview->row();
	
?>
        <td>
		<?=$getMachineIdview->first_name;?></td>
	
	
	
	
<td><?=$fetch_list->date;?></td>
<td>Pending</td>
	
	
        
        <td><?php $pri_col='id';
                  $table_name='tbl_schedule_triggering';
         ?>
       
       
       <a title="Job Work" href="<?=base_url();?>productionModule/manage_jobwork_map_details?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
        <button class="btn btn-default" onclick="viewWorkOrder(<?=$fetch_list->id;?>);" data-toggle="modal" data-target="#modal-3" type="button" ><i class="fa fa-eye"></i></button>
        
        <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
        </td>
    </tr>
<?php  }?>
<tr class="gradeU">
<td>

 
 
<button type="button" class="btn btn-default modalMapSpare" data-toggle="modal" data-target="#modal-2"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
 
 
</td>
<td>&nbsp;</td>
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

















<!-- starts-->


<div class="tab-pane" id="Return">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
<thead>
	<tr>

		<th style="width:150px;">Transfer No.</th>
	   
		  <th>Date</th>
      
	<th style="display:none">Status</th>
        <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$poquery=$this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and lot_no='$getsched->lot_no' and module_name='Kora'  group by transfer_no desc");
foreach($poquery->result() as $getPo){
?>
<tr class="gradeC record">

<th><?=$getPo->transfer_no;?></th>
<th><?=$getPo->transfer_date;?></th>


<?php

$poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
$getQty=$poquery->row();

// tbl_receive_matrial_grn_log query


//echo "select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->inboundid'";

$poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
$getQtygrnLog=$poquerygrnLog->row();


?>


<th style="display:none">
<?php
if($getQty->qty==$getQtygrnLog->qty)
{
	echo "Completed";
}
elseif($getQty->qty<$getQtygrnLog->qty)
{
	echo "Partial Completed";
}
else
{
	echo "Pending";
}

?>
</th>
<th>


 <?php /*?><button class="btn btn-default" onclick="viewPurchaseOrder(<?=$getPo->purchaseid;?>);" data-toggle="modal" data-target="#modal-6" type="button" ><i class="fa fa-eye"></i></button><?php */?>
 <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />

<button class="btn btn-default" onclick="viewTransferOrder('<?=$getPo->transfer_no;?>');" data-toggle="modal" data-target="#modal-view-transfer" type="button" ><i class="fa fa-eye"></i></button>
<a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>

 
  <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
</th>
</tr>
<?php }?>

<tr class="gradeU">
<td>

 
 
 <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order_transfer('<?=$getsched->lot_no;?>');" data-toggle="modal" data-target="#modal-order-transfer"><img src="<?=base_url();?>assets/images/plus.png" /></button>
 
 
</td>
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


<!-- ends -->









<div class="tab-pane" id="store">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
<thead>
	<tr>

		<th><div style="width:100px;">Product Code </div></th>
	<th><div style="width:100px;">Product Type</div> </th>
	<th><div style="width:100px;">Category</div></th>
	<th><div style="width:100px;">Product Name</div></th>
	<th><div style="width:100px;">Usages Unit</div></th>
<!-- 	<th><div style="width:50px;">Size</div></th>
	<th><div style="width:100px;">Thickness</div></th>
	<th><div style="width:100px;">Grade Code</div></th> -->
	<th><div style="width:120px;">Total Stock</div></th>
	<!-- <th><div style="width:120px;">Action</div></th> -->  
          
      
	
        
</tr>
</thead>
<tbody>
<?php
$poquery=$this->db->query("select * from tbl_product_stock where status='A' and type in(13) ");
foreach($poquery->result() as $getPo){
	####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getPo->productid'");
		$getProductStock=$productStockQuery->row();
		####### ends ########
		
		
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getPo->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########
		
?>
<tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">

<?php
$queryType=$this->db->query("select *from tbl_master_data where serial_number='$getPo->type'");
$getType=$queryType->row();
?>
<th><?=$getPo->sku_no;?></th>
<th><?=$getType->keyvalue;?></th>
<th>
<?php 
 $compQuery = $this ->db
		   -> select('*')
		   -> where('id',$getPo->category)
		   -> get('tbl_category');
		  $compRow = $compQuery->row();
echo $compRow->name;
?>
</th>
<th><?=$getPo->productname;?></th>
<th><?php
$compQuery1 = $this -> db
		   -> select('*')
		   -> where('serial_number',$fetch_list->usageunit)
		   -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
echo $getProductUOM->keyvalue;		  
?></th>
<!-- <th><?=$fetch_list->pro_size;?></th>
<th><?=$fetch_list->thickness;?></th>
<th><?=$fetch_list->grade_code;?></th> -->

<?php
//echo "select *from tbl_issuematrial_dtl where productid='$fetch_list->Product_id'";
$issueMat=$this->db->query("select *from tbl_issuematrial_dtl where productid='$fetch_list->Product_id'");
$getIssueMat=$issueMat->row();


?>
<th><?=$getIssueMat->receive_qty;?></th>

<!-- <th class="bs-example">
<?php if($view!=''){ ?>
<button class="btn btn-default" property="view" arrt= '<?=json_encode($fetch_list);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>

<?php } if($edit!=''){ ?>
<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editItem(this)"><i class="icon-pencil"></i></button>

<?php }
$pri_col='Product_id';
$table_name='tbl_product_stock';
?>
<button class="btn btn-default delbutton" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" type="button">
 <i class="icon-trash"></i></button>		
<?php ?>
 
</th> -->
</tr>
<?php }?>



</tbody>
<tfoot>
<!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
</tfoot>
</table>
</div>

</div>
</div>






</div>

</div>	

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
	v.type="submit";
	
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
		alert("Enter Qty must be less then reaminng qty");
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

        
        