<link href="<?=base_url();?>assets/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/select2/css/select2.css" rel="stylesheet">
<style type="text/css">
	.select2-container--open {
       z-index: 99999999 !important;
	 }
	 .select2-container {
       min-width: 256px !important;
     }
</style>
<?php
$this->load->view("header.php");

$machinQuery=$this->db->query("select * from tbl_machine where code='".$_GET['id']."'");
$getMachine=$machinQuery->row();

    $machinQuery1=$this->db->query("select productname,sku_no,Product_id from tbl_product_stock where Product_id='".$getMachine->code."'");
  	$getMachine1=$machinQuery1->row(); 

  	$machinQuery2=$this->db->query("select productname,sku_no,Product_id from tbl_product_stock where Product_id='".$getMachine->machine_name."'");
    $getMachine2=$machinQuery2->row();
?>

<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">View Product</h4>
	<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
  </div>

<form class="form-horizontal" role="form" id="ItemForm" >
<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label"> *Product Type: </label> 
<div class="col-sm-4"> 
<select name="type"  class="form-control" id="type">
		
		<option value="">----Select ----</option>
			<?php 
			
				$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=17");
				foreach ($sqlprotype->result() as $fetch_protype){
				
			?>
		<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
			<?php } ?>

</select>
</div> 
<label class="col-sm-2 control-label"> *Category: </label> 
<div class="col-sm-4"> 
<select name="category"  class="form-control" onchange="changing(this.value)" id="category">

	<option value="">----Select ----</option>
	<?php 
		$sqlgroup=$this->db->query("select * from tbl_category where status = 1 ");
		foreach ($sqlgroup->result() as $fetchgroup){						
	?>					
    <option value="<?php echo $fetchgroup->id; ?>"<?php if($fetchgroup->id==$fetch_list->category){?>selected<?php }?>><?php echo $fetchgroup->name ; ?></option>
	<?php } ?>

</select>
</div>  
</div>

<div class="form-group">
<label class="col-sm-2 control-label" > Sub Category: </label> 
<div class="col-sm-4"> 
<div id="subcategory1">
<select name="subcategory" class="form-control" id="subcategory">
	<option value=""> ----Select---- </option>
		<?php 
		//	$sqlgroup11=$this->db->query("select * from tbl_prodcatg_m where status='B'");
		//	foreach ($sqlgroup11->result() as $fetchgroup11){						
		?>					
            <option value="<?php //echo $fetchgroup11->product_Catid; ?>"><?php //echo $fetchgroup11->categoryName ; ?></option> 
        <?php //} ?>
</select>
</div>  
</div>
<label class="col-sm-2 control-label">*Product Code:</label> 
<div class="col-sm-4"> 
<input type="hidden" class="hiddenField" id="Product_id"   name="Product_id" value="" />
<input type="text" class="form-control" name="sku_no" value=""  id="sku_no"> 
</div> 
</div>
	
<div class="form-group"> 
<label class="col-sm-2 control-label"> *Product Name: </label> 
<div class="col-sm-4"> 
<input name="productname"  type="text" value="" class="form-control" id="productname" > 
</div>
<label class="col-sm-2 control-label"> Usages Unit: </label> 
<div class="col-sm-4"> 
    <select name="unit"  class="form-control" id="unit">
			<option value="" >----Select Unit----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
			<option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
	</select>
</div> 
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Size:</label> 
<div class="col-sm-4">
<input name="size"  type="text" value="" class="form-control" id = "size"  > 
</div>
<label class="col-sm-2 control-label">Thickness:</label> 
<div class="col-sm-4"> 
<input name="thickness"  type="text" value="" class="form-control" id="thickness" > 
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Grade Code</label> 
<div class="col-sm-4"> 
<input type="text" name="grade_code" id="grade_code" class="form-control"/>
</div> 
<label class="col-sm-2 control-label">Sale Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any" name="unitprice_sale" value="" id="unitprice_sale" class="form-control" >
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Purchase Price:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any" name="unitprice_purchase" value="" id="unitprice_purchase" class="form-control" >
</div> 
<label class="col-sm-2 control-label">HSN Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" step="any" name="hsn_code" value="" id="hsn_code" class="form-control" >
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">GST Tax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any" name="gst_tax" value="" id="gst_tax" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Weight:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" step="any" name="weight" value="" id="weight" class="form-control" >
</div> 

</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Cartoon Length:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="ctn_lenght" value="" id="ctn_lenght" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Cartoon Width:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="ctn_width" value="" id="ctn_width" class="form-control" >
</div> 

</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Cartoon Height:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="ctn_height" value="" id="ctn_height" class="form-control" >
</div> 
<label class="col-sm-2 control-label">MST:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="mst" value="" id="mst" class="form-control" >
</div> 

</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">CBM:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="cbm" value="" id="cbm" class="form-control" >
</div> 
<label class="col-sm-2 control-label">Lead Time:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="lead_time" value="" id="lead_time" class="form-control" >
</div> 
</div>

</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


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
<h3 class="panel-title" style="float: initial;"><?=$getMachine2->productname."(".$getMachine2->sku_no.")";?>
	<a href="<?=base_url('shapeMapping/manage_shape');?>" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a></h3>

</div>
<br><br>
<div class="panel-body" >
	<div class="col-lg-12">
				<div class="panel ">
					
					<div class="panel-body">
						 <form role="form">
							   <div class="form-group">
								 <label for="emailaddress">Item Name:</label>
								 <input type="text" name="" value="<?=$getMachine2->productname;?>" id="first_name" class="form-control" disabled>
							   </div>
							   <div class="form-group">
								 <label for="password">Item Code Name:</label>
								 <input type="text" name="" id="" class="form-control" value="<?=$getMachine2->sku_no;?>" disabled>
							   </div>
							  <!--  <div class="form-group">
								 <label for="password"> Description:</label>
								 <textarea class="form-control" disabled><?=$getMachine->machine_des;?></textarea>
							   </div> -->
							  <!-- <div class="checkbox">
								<label><input type="checkbox">Check me out</label>
							  </div>
							  <button type="submit" class="btn btn-primary">Submit</button> -->
						</form>
					</div>
				</div>
			</div>
	
	<!-- 	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-4">
		<div class="form-group">
		<input type="text" name="" value="<?=$getMachine2->productname;?>" id="first_name" class="form-control" >
		</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-4">
		<div class="form-group">
		<input type="text" name="" id="last_name" class="form-control" value="<?=$getMachine2->productname;?>" >
		</div>
		</div>
		</div>
	    <div class="form-group">
		   <textarea class="form-control"><?=$getMachine->machine_des;?></textarea>
	    </div> -->
    <!-- </form> -->

</div>
</div>
</div>
</div>


<div class="tabs-container">
<ul class="nav nav-tabs">
<li class="active"><a href="#home" data-toggle="tab">Part </a></li>
<li><a href="#profile" data-toggle="tab">Shape</a></li>
<li style="display:none"><a href="#three" data-toggle="tab">Assembling Point</a></li>
<li class=""><a href="#four" data-toggle="tab">Packaging</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane  active" id="home">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1"  id="loadSpare">
<thead>
<tr>
<th>Code</th>
<th>Part  Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
  $i=1;
  foreach($result as $fetch_list)
   {
   //	echo $fetch_list->spare_id;
    $spareName = $this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->part_id'");
    $getSpareD = $spareName->row();
?>
<tr class="gradeU record">
  <td><?=$getSpareD->sku_no;?></td>
  <td><?=$getSpareD->productname;?></td>
  <!--
  <td><?php 
	$compQuery = $this -> db
	-> select('*')
		           -> where('id',$getSpareD->category)
		           -> get('tbl_category');
		 $compRow = $compQuery->row();
         echo $compRow->name;
    ?></td>
   <td><?=$getSpareD->unitprice_purchase;?></td>
   -->

<td>
<?php 
	$pri_col='id';
	$table_name='tbl_machine_spare_map';
?>
<?php if($edit!=''){ ?>

<!--<a arrt='<?=json_encode($getSpareD);?>' onclick ="editRow(this);" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" >&nbsp; <i class="fa fa-eye"></i>&nbsp; </a> -->
<!-- <button class="btn btn-default" property="view" arrt= '<?=json_encode($getSpareD);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
 --><?php }?>

<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop="static" data-keyboard="false" title=" View Contact Mapping" onclick="mappingQtybyproduct(<?=$fetch_list->part_id;?>,<?=$fetch_list->product_id;?>,'part');"><i class="icon-flow-tree"></i></button>	

<button style="display:none;" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-3" type="button" data-backdrop="static" data-keyboard="false" title=" fa fa-eye" onclick="viewmappingQtybyproduct(<?=$fetch_list->spare_id;?>,70,'partview');"><i class="fa fa-eye"></i></button>

<button style="display:none;" class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col; ?>" type="button"><i class="icon-trash"></i></button>

	
<!--  -->
</td>
</tr>
<?php }?>
<tr class="gradeU" style="display:none">
<td>
 <button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>

</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

</tbody>
<tfoot>

</tfoot>
</table>
</div>
</div>
</div>
<div class="tab-pane" id="profile">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
<th>Shape Name</th>
<th>Shape SKU Code</th>
<!-- <th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th> --> 
<th>Action</th>
</tr>
</thead>
<tbody>





<tr class="gradeX">
  <td><?=$getMachine1->productname;?></td>
  <td><?=$getMachine1->sku_no;?></td>
  <td><!-- <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop="static" data-keyboard="false" title=" View Contact Mapping" onclick="mappingQtybyproduct(<?=$getMachine1->Product_id;?>,<?=$_GET['id'];?>,'shape');"><i class="icon-flow-tree"></i></button> -->
  <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-3" type="button" data-backdrop="static" data-keyboard="false" title="View quantity Mapping" onclick="viewmappingQtybyproduct(<?=$getMachine1->Product_id;?>,<?=$_GET['id'];?>,'shapeview');"><i class="fa fa-eye"></i></button>
  </td>
</tr>



</tbody>

</table>
</div>

</div>
</div>
<div class="tab-pane" id="three">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
	<th>Module Name</th>
	<th>Module Type</th>
	<!-- <th>Vendor</th>
	<th>Date Of expiry</th>
	<th>Serail No.</th>
	<th>Description</th> -->
</tr>
</thead>
<tbody>
	<tr class="gradeA">
		<td>name</td>
		<td>Type</td>
		<!-- <td>Vendor</td>
		<td>Date Of expiry</td>
		<td>Serial No.</td>
		<td>Description</td> -->
	</tr>
	<tr class="gradeA">
	<!-- <td>
	 <button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare1'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset" ><img src="<?=base_url();?>assets/images/plus.png" /></button>
	</td> -->
	<!-- <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td> -->
</tr>
</tbody>
<tfoot>

</tfoot>
</table>
</div>
</div>
</div>
<div class="tab-pane" id="four">
<div class="panel-body">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
<th>Package Name</th>
<th>Package Type</th>
<!-- <th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th> -->
</tr>
</thead>

<tbody>
<tr>
<th>name</th>
<th>type</th>
<!-- <th>Platform(s)</th>
<th>Engine version</th>
<th>CSS grade</th> -->
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div><!--tabs-container close-->
</div>
</div>
</div>
</div>
<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<div class="modal-header">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
		   
			<h4 class="modal-title"> Product Quantity Mapping</h4>
			<div id="productqtymap" class="text-center " style="font-size: 15px;color: red;"></div> 
            
		  </div>

		  <form class="form-horizontal" role="form"  enctype="multipart/form-data"  id="productpriceMapped"> 
		  	<div class="modal-body" style="display:none">
		  	<div class="form-group"> 
          
           <div class="col-sm-4"> 
           	<!--<label class="control-label">Product Name:</label> 
               <input type="text" class="form-control input-sm" value="" id="mproductname" onkeyup="getdatarowmatrial(this.value);" autocomplete="off"> 
               <ul style="position: absolute;z-index: 999999;top: 50px; width: 179%; margin-left: -39px;" id="productListData">
		       </ul> -->
		      <input type="hidden" class="form-control input-sm" value="" id="mproductname"> 
		      <input type="hidden"  class="form-control" value="" id="mproductid" >
              <label class="control-label">Product Name:</label> <br>
              <select id="prodetails"  class="select2 form-control" onchange="selectListdata(this);">
              <option value="" selected disabled> --Select-- </option>
              <?php
              $contQuery=$this->db->query("select productname,Product_id,usageunit from tbl_product_stock where type = '13'");
              foreach($contQuery->result() as $dt)
              {
                 $prodId   = $dt->Product_id;
                 $prodName = $dt->productname;
                 $uom      = $dt->usageunit;
              ?>
               <option value="<?=$prodId;?>^<?=$prodName;?>^<?=$uom;?>" ><?=$prodName;?></option>
             <?php } ?>
             </select> 
          </div>
          
          <div class="col-sm-2"> 
          <label class="control-label">UOM:</label> 
            <!-- <input type="text" class="form-control input-sm" value="" > -->
            
               <select name="unit"  class="form-control" id="muom" disabled>
			       <option value="" >----Select Unit----</option>
				    <?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
					?>
			    <option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
				<?php } ?>
	           </select>
           
          </div>
          
          <div class="col-sm-3" > 
          <label class="control-label">Enter QTY:</label> 
          <input type="text" class="form-control input-sm" value="" id="mPrice" >
          <input type="hidden" name = "partid" class="form-control" value="" id="partid">
          <input type="hidden" name = "itemid" class="form-control" value="" id="itemid">
          <input type="hidden" name = "mapType" class="form-control" value="" id="mapType">
          </div>
           <div class="col-sm-2" > 
           	
           	 <button  style = "margin-top: 20px;" class="btn btn-default"  type="button" onclick="addpricemap()"><img src="<?=base_url();?>assets/images/plus.png" />
           	</button>
           </div>
        </div>
    </div>
           <div id="getsparepartqtymapping">
           	
           </div>
         </form>

		</div>
	</div><!-- /.modal-content -->
</div>

  <div id="modal-3" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
		   <div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
			   	<span aria-hidden="true">&times;</span>
			   </button>
			   <h4 class="modal-title"> View Product Quantity Mapping</h4>
			   <div id="productqtymap" class="text-center " style="font-size: 15px;color: red;"></div> 
		   </div>
           <div id="viewgetsparepartqtymapping">
           	
           </div>
        </div>
	</div><!-- /.modal-content -->
  </div>

</div><!--main-content close-->

<?php
$this->load->view("footer.php");
?>


<form class="form-horizontal" role="form" method="post" action="insert_machine" enctype="multipart/form-data">			
    <div id="editItem" class="modal fade modal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-contentitem" id="modal-contentitem">

        </div>
      </div>	 
    </div>
</form>

<script>
function getEditItem(v){
  var pro=v;
  var xhttp = new XMLHttpRequest();
 
  xhttp.open("GET", "getMachinePage?ID="+pro, false);
  xhttp.send();
  document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
 } 	


function getSpareMap(v){
  var pro=v;
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

function mappingQtybyproduct(partid,machineid,mtype){
   var ur = 'ajex_getsparemapedQty';
   $.ajax({
      type: "POST",
      url: ur,
      data: {'partid':partid,'machineid':machineid},
      success: function(data){
       // alert('sdfsdf');
       // console.log(data);
        $("#getsparepartqtymapping").empty().append(data).fadeIn();
        $('#partid').val(partid);
        $('#itemid').val(machineid);
        $('#mapType').val(mtype);
      }
    });

   
}

function viewmappingQtybyproduct(partid,machineid,type){
   var ur = 'ajex_viewgetsparemapedQty';
   $.ajax({
      type: "POST",
      url: ur,
      data: {'partid':partid,'machineid':machineid,'typee':type},
      success: function(data){
       // alert('sdfsdf');
       // console.log(data);
        $("#viewgetsparepartqtymapping").empty().append(data).fadeIn();
        // $('#partid').val(partid);
        // $('#itemid').val(machineid);
        // $('#mapType').val(mtype);
      }
    });
}


   function selectListdata(ths){

  	 
  	 $("#muom").attr('disabled',false);
     $('#productListData').css('display','none');
     res = ths.value.split("^");
    // alert(res[2]);
     $('#mproductname').val(res[1]);
     $('#mproductid').val(res[0]);
     // $('').val();
     $("#muom").val(res[2]);
     $("#muom").attr('disabled',true);

  }

 function getdatarowmatrial(val){
    ur = "ajax_rowmatiral";
    $.ajax({
      type: "POST",
      url: ur,
      data: {'value':val},
      success: function(data){
       // alert('sdfsdf');
          console.log(data);
          $('#productListData').css('display','Block');
          $('#productListData').html(data);
      }
    });
  }

 function addpricemap(){
   var mproductname =  $('#mproductname').val();
   var mproductid   =  $('#mproductid').val();
   var price        =  $('#mPrice').val();
   var muom         =  $('#muom').val();
   var muomval      =  $("#muom option:selected").text();

   $('#resultarea').text("");
    
    if(mproductid == "" || price == ""){
      if(mproductid == "")
        var msg = 'Please Enter Right Product Name';
      else
        var msg = 'Please Enter  Product Price';

     $('#resultarea').text(msg);
    }else{
       $('#quotationTable').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');

       $('#mproductname').val("");
       $('#mproductid').val("");
       $('#mPrice').val("");
       $("#muom").val("");
       $("#select2-prodetails-container").text("--select--");
       
    }
  }

$("#productpriceMapped").validate({
    rules: {},
      submitHandler: function(form) {
        ur = "ajex_insertMapping";
        var formData = new FormData(form);
            $.ajax({
                 type : "POST",
                 url  :  ur, 
                 //dataType : 'json', // Notice json here
                 data : formData, // serializes the form's elements.
                 success : function (data) {
                // alert(data);
                // console.log(data); // show response from the php script.
                 if(data == 1){
                  if(data == 1)
                    var msg = "Mapping Process Successful !";
                     

                     $("#productqtymap").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                       $("#modal-2 .close").click();
                       $("#productqtymap").text(" "); 
                      // $('#TechnicalMapping')[0].reset(); 
                      // $("#proId").val("");
                    }, 1000);
                  }else{
                    $("#productqtymap").text(data);
                 }
                 //ajex_ItemListData();
               },
                error: function(data){
                    alert(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //form.preventDefault();
      }
  });



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

// function saveData()
// {
//   var code= document.getElementById("code").value;
//   var machine_name= document.getElementById("machine_name").value;
//   var machine_des= document.getElementById("machine_des").value;
//   var capacity= document.getElementById("capacity").value;
//     if(code=='')
//      {
//   	  document.getElementById("codemsg").innerHTML = "Please Enter Code";
//  	  return false;
//     }
//     var xhttp = new XMLHttpRequest();
//     xhttp.open("GET", "insert_machine?code="+code+"&machine_name="+machine_name+"&machine_des="+machine_des+"&capacity="+capacity, false);
//     xhttp.send();
//     $("#modal-0 .close").click();
//     console.log(xhttp.responseText);	   
//  	document.getElementById("loadData").innerHTML = xhttp.responseText;
// 	document.getElementById("code").value='';
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


			
<div id="mapSpare" class="modal fade modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-contentMap" id="modal-contentMap">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Map Part</h4>
			<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
				<table class="table table-striped table-bordered table-hover" >
				 <tbody>
					<tr class="gradeA">
						<th>Part Name</th>
						<th>Action</th>
					</tr>
					<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="mapSpareForm">
					<tr class="gradeA">
						<th>
                        <select name="pri_id" id='pri_id'  class="select2 form-control col-lg-12" style="    width: 100% !important;">
						<option value="" selected disabled> --Select-- </option>
						<?php 
						$sel=$this->db->query("select * from tbl_product_stock where type=32");
						  foreach($sel->result() as $arr)
						  {
			             ?>
			              <option value="<?=$arr->Product_id;?>"><?=$arr->productname;?> - <?=$arr->sku_no;?></option>
		                  <?php } ?>
						  </select>  
						  <input type="hidden" class=""  name="machine_name1" id='machine_name1'  value="<?=$_GET['id'];?>" style="width:80px;"/> 
						   <!--<div class="input-group"> 
								  <div style="width:100%; height:28px;" >
								  <input type="text" name="prd"  onkeyup="getdataSP(this.value);" onClick="getdataSP(this.value);" id="prd" style=" width:230px;" class="form-control"  placeholder=" Search Items..." tabindex="5" autocomplete="off" >
								  <input type="hidden" class=""  name="pri_id" id='pri_id'  value="" style="width:80px;"  /> 
                                  <input type="hidden" class=""  name="machine_name1" id='machine_name1'  value="<?=$_GET['id'];?>" style="width:80px;"  /> 
								</div>
							   <div style="color:black;padding-left:0px; width:117%; height:100px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute; margin:4px 0px 0px -40px;">
                                <ul style="position: absolute;z-index: 999999;" id="productList"></ul>
                              <?php
						        //$this->load->view('getproduct');
                              ?>
						    </div> -->
						  </th>
                        <th>
						<input type="button"  id="qn" style="width:70px;" onclick="addSaveData();" value="Add" class="form-control"> 
                       </th>
					</tr>
			     </form>
			  </tbody>
		  </table>
		</div>
	</div>	 
</div>
</div>
</div>






<!--<div id="mapSpare1" class="modal fade modal" role="dialog">-->
	<!-- <div class="modal-dialog modal-lg">
		<div class="modal-contentMap" id="modal-contentMap">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Map Spare
			</h4>
			<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
				<table class="table table-striped table-bordered table-hover" >
					<tbody>
					<tr class="gradeA">
						<th>Spare Name</th>
						<th>Action</th>
					</tr>
					<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="mapSpareForm">
					<tr class="gradeA">
						<th style="width:280px;">
							<div class="input-group"> 
								<div style="width:100%; height:28px;" >
								<input type="text" name="prd"  onkeyup="getdataSP(this.value);" onClick="getdataSP(this.value);" id="prd" style=" width:230px;" class="form-control"  placeholder=" Search Items..." tabindex="5" autocomplete="off" >
								 <input type="hidden" class="hiddenField"  name="pri_id" id='pri_id'  value="" style="width:80px;"  /> 
                                 <input type="hidden" class="hiddenField"  name="pri_id" id='machine_name'  value="<?=$_GET['id'];?>" style="width:80px;"  /> 
								<ul style="position: absolute;z-index: 999999;top: 31px;" id="productList">
									
								</ul>
							</div>
							<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
                             <?php
						      $this->load->view('getproduct');
                             ?>
						    </div>
						  </th>
                        <th>
						<input type="button"  id="qn" style="width:70px;" onclick="saveData();" value="Add" class="form-control"> 
                       

					   </th>
					</tr>
			     </form>
			  </tbody>
		  </table>
		</div>
	</div>	 
</div> -->

<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/form-advanced-script.js"></script>
<script>


function addSaveData()
{

var pri_id= document.getElementById("pri_id").value;
var machine_name= document.getElementById("machine_name1").value;
var xhttp = new XMLHttpRequest();
xhttp.open("GET", "insert_spare?code="+pri_id+"&machine_name="+machine_name, false);
xhttp.send();
$("#mapSpare .close").click();	   
document.getElementById("select2-pri_id-container").value = "";
document.getElementById("loadSpare").innerHTML = xhttp.responseText;
 

}

function getEditItem(v){

 var pro=v;
 var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "getMachinePage?ID="+pro, false);
 xhttp.send();
 document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;

 } 	


</script>




