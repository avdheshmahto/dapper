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
<div class="panel-default">		

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Store</a></li> 
	<li class="active"><strong>Stock Details</strong></li>

</ol>




<?php
if($this->session->flashdata('flash_msg')!='')
 {
?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>
<?php }?>	

<div id="listingData">
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
	<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 5px 0px 0px;">Excel</button>
	<a class="dt-button buttons-excel buttons-html5" style="display:none;" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 5px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('purchaseorder/item_Stock').'?sku_no='.$_GET['sku_no'].'&type='.$_GET['type'].'&category='.$_GET['category'].'&productname='.$_GET['productname'].'&usages_unit='.$_GET['usages_unit'].'&size='.$_GET['size'].'&thickness='.$_GET['thickness'].'&gradecode='.$_GET['gradecode'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
Entries</label>
<br />
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
	Showing <?=$dataConfig['page']+1;?> to 
	<?php
		$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
		echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
	?> of <?=$dataConfig['total'];?> Entries
</div>
</div>

<div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
<label>Search:
<input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
</label>
</div>
</div>

</div>
</div>

<div class="row">
<div class="panel-body">
<div class="table-responsive" style="padding: 4px;">
				
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
	<th id="ab"><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	<th><div style="width:100px;">Product Code </div></th>
	<th><div style="width:100px;">Product Type</div> </th>
	<th><div style="width:100px;">Category</div></th>
	<th><div style="width:100px;">Product Name</div></th>
	<th><div style="width:100px;">Usages Unit</div></th>
	<th><div style="width:170px;">Physical stock<br />No./Kg.</div></th>
	<th><div style="width:100px;">Block Stock<br />No./Kg.</div></th>
	
	<th><div style="width:120px;">Available Stock<br />No./Kg.</div></th>
	<th><div style="width:120px;">Action</div></th> 
</tr>
</thead>

<tbody id="getDataTable" >
<form method="get">
<tr>
	<td>&nbsp;</td>
	<td><input name="sku_no"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="type"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="category"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="productname"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="usages_unit"  type="text"  class="search_box form-control input-sm"  value="" /></td>
<td><input name="size" type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="thickness" type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="gradecode" type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php  
$i=1;

 foreach($result as $fetch_list)
 {
?>

<tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" /></th>
<?php
$queryType=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->type'");
$getType=$queryType->row();

$querySerial=$this->db->query("select *from tbl_product_serial where product_id='$fetch_list->Product_id'");
$getSerial=$querySerial->row();



?>
<th><?=$fetch_list->sku_no;?></th>
<th><?=$getType->keyvalue;?></th>
<th>
<?php 
 $compQuery = $this ->db
		   -> select('*')
		   -> where('id',$fetch_list->category)
		   -> get('tbl_category');
		  $compRow = $compQuery->row();
echo $compRow->name;
?>
 <?php
//echo "select SUM(receive_qty) as qty,SUM(order_qty) as ordQty,SUM(remaining_qty) as remQty,SUM(rem_order_qty) as rem_order_qty from tbl_issuematrial_dtl where productid='$fetch_list->Product_id' group by productid";
 $blockQtyQuery=$this->db->query("select SUM(receive_qty) as qty,SUM(order_qty) as ordQty,SUM(remaining_qty) as remQty,SUM(rem_order_qty) as rem_order_qtyy from tbl_issuematrial_dtl where productid='$fetch_list->Product_id' group by productid");
 $getBlockQty=$blockQtyQuery->row();
 //
 //
 $issueQtyQuery=$this->db->query("select SUM(receive_qty) as issue_qty from tbl_receivematrial_dtl where productid='$fetch_list->Product_id' group by productid");
 $getIssueQty=$issueQtyQuery->row();
 //
 
 
 ?>
</th>
<th><?=$fetch_list->productname;?></th>
<th><?php
$compQuery1 = $this -> db
		   -> select('*')
		   -> where('serial_number',$fetch_list->usageunit)
		   -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
echo $keyvalue1->keyvalue;		  
?></th>
 <th><?=$getSerial->qn_pc;?>/<?=$fetch_list->quantity;?></th>
 

 
<th><?php

echo $bQ=$getBlockQty->ordQty-$getBlockQty->rem_order_qtyy;?>/<?php echo $bQK=$getBlockQty->qty-$getBlockQty->remQty;?></th>

<th><?=$getSerial->qn_pc-$bQ;?>/<?=$fetch_list->quantity-$bQK;?></th>
<th>&nbsp;</th>

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
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>

</div>
</div>
</div>

<div class="row">
<div class="col-md-12 text-right">
   <div class="col-md-6 text-left"></div>
   <div class="col-md-6"> <?php echo $pagination; ?> </div>
</div>
</div>


</div>

</div>
</div>

<?php
$this->load->view("footer.php");
?>


<script>

// function editItem(v){
// //alert(v);
// var pro=v;
//  var xhttp = new XMLHttpRequest();
//   xhttp.open("GET", "updateItem?ID="+pro, false);
//   xhttp.send();
//   document.getElementById("contentitem").innerHTML = xhttp.responseText;
// }


function changing(v)
{
	//alert(v);
 	var pro=v;
	var xhttp = new XMLHttpRequest();
	  xhttp.open("GET", "changesubcatg?ID="+pro, false);
	  xhttp.send();
	  //alert(xhttp.responseText);
	  document.getElementById("subcategory1").innerHTML = xhttp.responseText;
	 // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
}

</script>	


<script>

function exportTableToExcel(tableID, filename = ''){
 
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'ProductList_<?php echo date('d-m-Y');?>.xls';
    
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
