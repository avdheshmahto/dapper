<body>
<?php
$this->load->view("header.php");
		$userQuery = $this -> db
           -> select('*')
		   -> where('productionid',$_GET['id'])
		   -> or_where('productionid',$_GET['view'])
           -> get('tbl_production_hdr');
		  $branchFetch = $userQuery->row();
		  
		  
		  

?>


<form action="insert_insepction" method="post">
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			
			<li><a class="btn btn-success" href="<?=base_url();?>master/Item/manage_item">Manage Product</a></li> 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Master</a></li> 
				<li><a href="#">Product</a></li> 
				<li class="active"><strong><a href="#">Add Product</a></strong></li> 
			</ol>
		<?php }?>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title">Add Inspection</h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title">View Inspection</h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Inspection</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>





<div class="clearfix"></div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th rowspan="2">Sr. No.</th>
<th rowspan="2">Test Parameter</th>
<th rowspan="2" >Specification 1</th>
<th rowspan="2" >Specification 2</th>

<th colspan="10" ><center>Observation</center></th>
</tr>

<tr class="gradeA">
<input type="hidden" name="productionid" value="<?=$_GET['id'];?>">
<input type="hidden" name="type" value="production">
<th >1</th>
<th >2</th>
<th >3</th>
<th >4</th>
<th >5</th>
<th >6</th>
<th >7</th>
<th >8</th>
<th >9</th>
<th >10</th>
</tr>


<?php
$m=0;
$delivery_period_query=$this->db->query("select *from tbl_product_test_para where product_id='$branchFetch->product_id' or product_id='$branchFetch->product_id'");

$numCnt=$delivery_period_query->num_rows();
if($numCnt==0)
{
	?>
	

<?php }
	
	$i=1;

foreach($delivery_period_query->result() as $getDeliveryPeriod){
	
	
$productQuery=$this->db->query("select *from tbl_product_inspection where productionid='".$_GET['id']."' and product_id='$getDeliveryPeriod->product_id' and test_param='$getDeliveryPeriod->test_param' and type='production'");
$getProduction=$productQuery->row();	
	
?>
<tr class="gradeA" data-row-id="<?php echo $getProduction->purchaseorderid; ?>">
<th >
<?=$i;?></th>

<th style="width:180px;">

<input type="hidden" name="p_id[]" value="<?php echo $getDeliveryPeriod->product_id; ?>">
<input type="text" name="test_param[]" value="<?=$getDeliveryPeriod->test_param;?>"      tabindex="5" class="form-control" ></th>

<th style="width:200px;" >
<input type="text" name="specification[]" value="<?=$getDeliveryPeriod->specification;?>"  class="form-control"></th>

<th style="width:200px;" >
<input type="text" name="specification2[]" value="<?=$getDeliveryPeriod->specification2;?>"  class="form-control"></th>

<th >
<input type="text" name="insp1[]" value="<?=$getProduction->insp1;?>"  class="form-control"></th>
<th >
<input type="text" name="insp2[]" value="<?=$getProduction->insp2;?>"  class="form-control"></th>
<th >
<input type="text" name="insp3[]" value="<?=$getProduction->insp3;?>"  class="form-control"></th>
<th >
<input type="text" name="insp4[]" value="<?=$getProduction->insp4;?>"  class="form-control"></th>
<th >
<input type="text" name="insp5[]" value="<?=$getProduction->insp5;?>"  class="form-control"></th>
<th >
<input type="text" name="insp6[]" value="<?=$getProduction->insp6;?>"  class="form-control"></th>
<th >
<input type="text" name="insp7[]" value="<?=$getProduction->insp7;?>"  class="form-control"></th>
<th >
<input type="text" name="insp8[]" value="<?=$getProduction->insp8;?>"  class="form-control"></th>
<th >
<input type="text" name="insp9[]" value="<?=$getProduction->insp9;?>"  class="form-control"></th>
<th >
<input type="text" name="insp10[]" value="<?=$getProduction->insp10;?>"  class="form-control"></th>
</tr>
<?php $i++; }?>
</tbody>
</table>
 <input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">

<div class="form-group">
<div class="col-sm-4">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!=''){
?>
<input type="submit" class="btn btn-primary" value="Save">
<?php } ?>
<a href="" onClick="popupclose(this.value)"  title="Cancel" class="btn btn-blue"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary" value="Save">
       <a href="<?=base_url();?>master/Item/manage_item" class="btn btn-blue">Cancel</a>

       <?php } ?>

</div>
</div>

</div>

</div>
</div>
</div>

</form>
<?php
$this->load->view("footer.php");

?>
</body>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

function abc(val)
{

if(val=='new')
{
  newwindow=window.open('<?=base_url();?>SalesOrder/all_product_function?&popup=True&id='+val,'name','height=500,width=1200');
if (window.focus) {newwindow.focus()}
return false;

 // openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)
  //alert();
}
}

function getCat(cat_id)
{
	
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getCat_fun?con="+cat_id, false);
  xhttp.send();
  document.getElementById("div_cat_id").innerHTML = xhttp.responseText;
 
	
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
			

			
			var cell3 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "test_param[]";
			element2.className="form-control";
			cell3.appendChild(element2);

var cell4 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.type = "text";
			element3.className="form-control"
			element3.name = "specification[]";
			cell4.appendChild(element3);

		


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

	</SCRIPT>