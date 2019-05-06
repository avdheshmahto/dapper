 <?php
$this->load->view("header.php");
?>

<form action="insertInboundOrderGrn" method="post">
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
foreach($productQuery->result() as $getProduct)
{

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
	{  }
	else{
	?>
	<td><?=$getProduct->qnPc;?> <?php }?></td>
	    
    <?php

	$inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty,SUM(qn_pc) as qty_qn_pc from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
	$getInbound=$inbountLogQuery->row();

	?>

	<td><?=$getProduct->poQty?><input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?php echo $rmR=$getProduct->poQty-$getInbound->rec_qty;?>" class="form-control">    
    <input type="hidden" name="po_no" value="<?=$getProduct->purchaseid?>" />
    </td>

    <td><?=$getProduct->qnPc-$getInbound->qty_qn_pc;?></td>
    
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

<div class ="pull-right" id="saveDiv" style="display:none1">
<input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
&nbsp;<a href="<?=base_url();?>purchaseorder/manage_purchase_order" class="btn btn-sm btn-black btn-outline">Cancel</a>
</div>

</div>
</div>
</div>

</form>


<div class="tabs-container" id="ajaxData">

<ul class="nav nav-tabs">
<li class="active"><a href="#home" data-toggle="tab">Grn Log</a></li>
<li><a href="#Return" data-toggle="tab">Return Log</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane  active" id="home">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
<thead>
	<tr>
    	<th>Item Number & Description</th>
		<th>GRN No.</th>
		<th>GRN Date</th>
        <th>Receive QTY</th>		
		<th>Receive Weight</th>
	</tr>
</thead>
<tbody>
<?php

$queryData=$this->db->query("select *from tbl_inbound_log where po_no='".$_GET['pid']."' ");
foreach($queryData->result() as $fetch_list)
{
  
?>



    <tr class="gradeU record">
	<td>
		<?php
		$prd=$this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->productid'");	
		$getPrd=$prd->row();
		echo $getPrd->sku_no.' '.$getPrd->productname;

		 ?>
	</td>
	
	<td><?=$fetch_list->grn_no;?></td>
    <td><?=$fetch_list->grn_date;?></td>
	<td><?=$fetch_list->receive_qty;?></td>
	<td><?=$fetch_list->qn_pc;?></td>
    </tr>
<?php } ?>

</tbody>
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
    	<th>Item Number & Description</th>
        <th>Receive QTY</th>		
		<th>Receive Weight</th>
		<th>Return QTY</th>		
		<th>Return Weight</th>
	</tr>
</thead>
<tbody>

<?php

// $hdr=$this->db->query("select * from tbl_grn_return_hdr where po_no='".$_GET['pid']."'");
// $getHdr=$hdr->row();

$poquery=$this->db->query("select * from tbl_grn_return_dtl where po_no='".$_GET['pid']."'");
foreach($poquery->result() as $getPo)
{

?>
<tr class="gradeC record">
	<td>
		<?php
		$prd=$this->db->query("select * from tbl_product_stock where Product_id='$getPo->productid'");	
		$getPrd=$prd->row();
		echo $getPrd->sku_no.' '.$getPrd->productname;

		 ?>
	</td>	
	<td><?=$getPo->receive_qty;?></td>
	<td><?=$getPo->receive_weight;?></td>
	<td><?=$getPo->return_qty;?></td>
    <td><?=$getPo->return_weight;?></td>
</tr>

<?php }?>

<tr class="gradeU">
	<td>
	<button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="grn_return('<?=$_GET['pid'];?>');" data-toggle="modal" data-target="#modal-grn-return"><img src="<?=base_url();?>assets/images/plus.png" /></button>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

</tbody>
</table>

</div>
</div>
</div>


<!-- ends -->


</div>
</div>	


<div id="modal-grn-return" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">GRN Return</h4>
<div id="grnresultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
<div class="modal-body">
<form class="form-horizontal" role="form" enctype="multipart/form-data" id ="grn_return_form" action="#" onsubmit="return submitGrnReturn();"method="POST">
<div class="row" id="returnDetails">




</div>
</form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
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


function chkQty(v)
{

	var zz=document.getElementById(v).id;
	
	var myarra = zz.split("return_qty");
	var asx= myarra[1];
	var rem_qty=document.getElementById("rem_qty"+asx).value;
	var ret_qty=document.getElementById("return_qty"+asx).value;

	if(Number(ret_qty) > Number(rem_qty))
	{
		alert("Return qty can not be greater than remaining qty !")
		$("#add_req").prop('disabled',true);
	}
	else
	{
		$("#add_req").prop('disabled',false);
	}

}

function chkWeight(v)
{

	var zz=document.getElementById(v).id;
	
	var myarra = zz.split("retrn_weight");
	var asx= myarra[1];
	var rem_qty=document.getElementById("rem_wght"+asx).value;
	var ret_qty=document.getElementById("retrn_weight"+asx).value;

	if(Number(ret_qty) > Number(rem_qty))
	{
		alert("Return weight can not be greater than remaining weight !")
		$("#add_req").prop('disabled',true);
	}
	else
	{
		$("#add_req").prop('disabled',false);
	}

}

function grn_return(viewId)
{

 	$.ajax({   
		    type: "POST",  
			url: "grn_return",  
			cache:false,  
			data: {'id':viewId },  
			success: function(data)  
			{  
			  
			 	$("#returnDetails").empty().append(data).fadeIn();
				//referesh table

			}   
	});

}


function submitGrnReturn() {
            
  var form_data = new FormData(document.getElementById("grn_return_form"));
  form_data.append("label", "WEBUPLOAD");

  $.ajax({
      url: "<?=base_url();?>purchaseorder/insert_retun_grn",
      type: "POST",
      data: form_data,
      processData: false,  // tell jQuery not to process the data
      contentType: false   // tell jQuery not to set contentType
 	 }).done(function( data ) {
	//alert(data);
	
	
	  		if(data == 1 || data == 2){
		
                if(data == 1)					    
                    var msg = "Data Successfully Add !";
                else
                    var msg = "Data Successfully Updated !";
				$("#grnresultarea").text(msg);
				setTimeout(function() {   //calls click event after a certain time
                $("#modal-grn-return").click();
                $("#grnresultarea").text(" "); 
                $('#grn_return_form')[0].reset(); 
				//$("#quotationTable").text(" "); 				   
                //$("#id").val("");     
                }, 1000);

                }
                else
                {
                	$("#grnresultarea").text(data);					
                }

				 ajex_Order_Grn_Data(<?php echo $_GET['pid']?>);	 
   			// console.log(data);
    	//Perform ANy action after successfuly post data
       
  });
  return false;     
}
// ends

function ajex_Order_Grn_Data(viewId)
{
	$.ajax({   
		    type: "POST",  
			url: "ajax_post_grn",  
			cache:false,  
			data: {'id':viewId },  
			success: function(data)  
			{  
			  
			 	$("#ajaxData").empty().append(data).fadeIn();
				//referesh table

			}   
	});
}

</script>	
<?php
$this->load->view("footer.php");
?>

        
        