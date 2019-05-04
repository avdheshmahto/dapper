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
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Stock Refill</a></li> 
<li class="active"><strong><a href="#">Add Multiple Product Quantity</a></strong></li> 
<div class="pull-right">
<li><a class="btn btn-sm" href="<?=base_url();?>StockRefill/add_product_qty">Add Stock Refill</a></li> 
</div>
</ol>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title"><strong>Product List</strong></h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<br />                        
                        
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="    background: #dedede;    padding: 20px 0px;    margin-bottom: 25px;">
<form class="form-horizontal" method="get" >
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Category Name</label> 
<div class="col-sm-3"> 
<select name="cat" class="form-control">
<option value="">--Select--</option>
<?php
$catQuery=$this->db->query("select * from tbl_category where status = 1");
foreach($catQuery->result() as $getCat){
	
?>
<option value="<?=$getCat->id;?>"><?=$getCat->name;?></option>
<?php }?>
</select>
</div>
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="productname" class="form-control" value=""> 
</div>
<label class="col-sm-2 control-label"><button type="submit" class="btn btn-secondary btn-sm" name="filter" value="filter"><span>Search</span></button></label>  
</div>
</form>
</div>      
<br />
<br />

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
<label>&nbsp;&nbsp;&nbsp;&nbsp;Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/StockRefill/add_multiple_qty');?>" class="form-control input-sm">
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
                        
<form method="post" action="insertstockreff">
<div class="table-responsive">
<div class="clearfix"></div>
<hr />
<p class="pull-right"><input type="submit" class="btn btn-sm"  name="save" value="Save"  /></p>
<div class="clearfix"></div>
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >

<thead>
<tr><th style="display:none">Id</th>
		<th>Category Name</th>
        <th>Product Name</th>
		<th>Product Type</th>
        <th style="width:180px;">Location</th>
		<th style="width:150px;">New Quantity</th>
      	<th style="width:150px;">Total Quantity</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php
/*
@extract($_POST);

if($Show!='')
{
	
		$query="select * from tbl_product_stock where status='A' and type!='14'";
		
		if($cat!='')
		{				
			$query.=" and category  = '$cat'";	  
		}
		
		if($productname!='')
		{				
			
			 $query.=" and productname like '%$productname%'";	  
		}
}
else
{
	$query=("select * from tbl_product_stock where status='A' and type!='14'");
}
$seQu=$this->db->query($query);

*/
$i=1;
foreach($result as $fetch){


$rp = "SELECT * FROM tbl_product_serial WHERE Product_id ='".$Product_id."' and  comp_id='".$this->session->userdata('comp_id')."' and location_id='".$location_id1."'"; 
$leadSourceQuery=$this->db->query($rp);
$leadSourceRow=$leadSourceQuery -> row();

$industry_idQuery=$this->db->query("select * from tbl_location where status='A' and comp_id = '".$this->session->userdata('comp_id')."' limit 0,1");
$industry_idFetch=$industry_idQuery -> row();	


$fetchschool="select *from tbl_category where id='$fetch->category'";
$fetchschool2=$this->db->query($fetchschool);
$school3=$fetchschool2->row();
							

?>

<tr class="gradeC record">
 <th style="display:none;"><input type="checkbox" name="product_id[]" value="<?php echo $fetch->Product_id; ?>" checked="checked" style="display:none;" /></th>
<th><?php echo $school3->name;  ?></th>
<?php 
$size=$this->db->query("select *from tbl_master_data where serial_number='$fetch->size'");
$psize=$size->row();
if($psize->keyvalue !='')
{
?>
<th><?php echo $fetch->productname .'   ( '.$psize->keyvalue .')' ; } else { ?></th>
<th><?php echo $fetch->productname; }?></th>

<th><?php 
$qry=$this->db->query("select * from tbl_master_data where  serial_number='$fetch->type'");
$fetch11=$qry -> row();
echo $fetch11->keyvalue;  ?></th>
<th><select name="location_id[]" class="form-control">
<option value="">--Select--</option>
<?php
$locationQuery=$this->db->query("select *from tbl_location");
foreach($locationQuery->result() as $getLocation)
{

?>
<option value="<?=$getLocation->id;?>"><?=$getLocation->location_name;?></option>

<?php }?>
</select></th>
<th><input type="text" class="form-control" name="new_quantity[]" onChange="qun(this.id)" id="newquantity<?php echo $i;?>"  value="" /></th>
   
    <?php $selid=$this->db->query("select * from tbl_product_stock where  Product_id='$fetch->Product_id'");
     $selfetch=$selid -> row();
	
	// print_r($selfetch);
 ?>
<th><input type="hidden" name="quantity[]" id="quantity<?php echo $i;?>_" value="<?php echo $selfetch->quantity;?>"><?php echo round($selfetch->quantity,2);?>
</th>
</tr>
<?php $i++; }  ?>
</tbody>
</table>
</form>

<div class="row">
  <div class="col-md-12 text-right">
       <div class="col-md-6-"> <?=$pagination; ?> </div>
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
</div>
<?php
$this->load->view("footer.php");
?>

<script>
function qun(q)

  {	

  	//var abq=document.getElementById("abqt").value; 
//alert(q);
	var zz=document.getElementById(q).id;
//alert(zz);
	var myarra = zz.split("newquantity");

	var asx= myarra[1];

	//alert(asx);

	var pri=document.getElementById("newquantity"+asx).value;

	var qnty=document.getElementById("quantity"+asx).value;
	//alert(qnty);
//	alert(pri);

if(Number(pri)>Number(qnty)){
alert("***New Quantity Exceed The Actual Quantity In Stock***");
document.getElementById("newquantity"+asx).focus();
}
}

</script>


<script>

function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'StockRefill_<?php echo date('d-m-Y'); ?>.xls';
    
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