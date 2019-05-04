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
	<li><a href="#">Super Admin</a></li> 
	<li class="active"><strong>Unit Conversion</strong></li>
<div class="pull-right">
	<button type="button" onclick="getFG();" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" formid="#unitForm" id="formreset"><i class="fa fa-plus"></i>Add Unit Conversion</button>
	<a class="btn btn-secondary btn-sm delete_two_all"><i class="fa fa-trash-o"></i> Delete All</a>
</div>
</ol>

<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title"><span class="top_title" >Add </span> Unit Conversion</h4>
<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
</div>

<form class="form-horizontal" role="form" id="unitForm" >	
<div class="modal-body overflow">




	




















<div class="form-group"> 
<label class="col-sm-2 control-label">Main Unit:</label> 
<div class="col-sm-4" id="regid"> 

<input type="hidden" name="id" id="id" />
<select class="form-control" name="main_unit" id="main_unit">

<option value="">--Select--</option>
<?php
$unitQuery=$this->db->query("select *from tbl_master_data where param_id='16'");
foreach($unitQuery->result() as $getUnit){
?>
<option value="<?=$getUnit->serial_number;?>"><?=$getUnit->keyvalue;?></option>
<?php
}
?>
</select>
</div> 
<label class="col-sm-2 control-label">Sub Unit:</label> 
<div class="col-sm-4" id="regid"> 

<select class="form-control" name="sub_unit" id="sub_unit">

<option value="">--Select--</option>
<?php
$unitQuery=$this->db->query("select *from tbl_master_data where param_id='16'");
foreach($unitQuery->result() as $getUnit){
?>
<option value="<?=$getUnit->serial_number;?>"><?=$getUnit->keyvalue;?></option>
<?php
}
?>
</select>

</div> 

</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Con.Factor:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" step="any"  max="100"  name="con_fact" value="" id="con_fact"  class="form-control" >
</div> 
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4" > 
&nbsp;
</div> 

</div>
</div>
<div class="modal-footer" id="button">
	<input type="submit" class="btn btn-sm" value="Save">
	<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</form>
</div>
</div>
</div>


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
	<button  id="btnExport" onclick="javascript:xport.toCSV('tblData');"> Export to CSV</button>
	<!--<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>-->
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 5px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('master/Item/manage_item').'?p_type='.$_GET['p_type'].'&sku_no='.$_GET['sku_no'].'&type='.$_GET['type'].'&category='.$_GET['category'].'&productname='.$_GET['productname'].'&usages_unit='.$_GET['usages_unit'].'&size='.$_GET['size'].'&thickness='.$_GET['thickness'].'&gradecode='.$_GET['gradecode'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
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
	?> of <?=$dataConfig['total'];?> entries
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
	<th><div style="width:100px;">Main Unit</div></th>
	<th><div style="width:100px;">Sub Unit</div></th>
	<th><div style="width:100px;">Conversion Factor</div></th>
	
	<th><div style="width:120px;">Action</div></th>
</tr>
</thead>

<tbody id="getDataTable" >
<form method="get">
<tr>
	<td>&nbsp;</td>
	
	<td><input name="main_unit"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="sub_unit"  type="text"  class="search_box form-control input-sm"  value="" /></td>
	<td><input name="con_fact"  type="text"  class="search_box form-control input-sm"  value="" /></td>
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
$queryType=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->unit_name'");
$getType=$queryType->row();
?>

<?php
$querySubUnit=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->unit_conversion_name'");
$getSubUnit=$querySubUnit->row();
?>



<th><?=$getType->keyvalue;?></th>
<th><?=$getSubUnit->keyvalue;?></th>
<th><?=$fetch_list->unit_conversion_value;?></th>


<th class="bs-example">
<?php if($view!=''){ ?>
<button class="btn btn-default" property="view" arrt= '<?=json_encode($fetch_list);?>' onclick ="editUnit(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>

<?php } if($edit!=''){ ?>
<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editUnit(this)"><i class="icon-pencil"></i></button>

<?php }
$pri_col='id';
$table_name='tbl_unit_conversion';
?>
<button class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col ; ?>" type="button">
 <i class="icon-trash"></i></button>		
</th>
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






function getCat(v)
{
	
 	var pro=v;
	var xhttp = new XMLHttpRequest();
	if(v=='33')
	{
	$("#consigneeMapping").show();
	}
	else
	{
		$("#consigneeMapping").hide();
	}
	  xhttp.open("GET", "getCat?ID="+pro, false);
	  xhttp.send();
	  //alert(xhttp.responseText);
	  document.getElementById("category").innerHTML = xhttp.responseText;
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
<script>
var xport = {
  _fallbacktoCSV: true,  
  toXLS: function(tableId, filename) {   
    this._filename = (typeof filename == 'undefined') ? tableId : filename;
    
    //var ieVersion = this._getMsieVersion();
    //Fallback to CSV for IE & Edge
    if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
      return this.toCSV(tableId);
    } else if (this._getMsieVersion() || this._isFirefox()) {
      alert("Not supported browser");
    }

    //Other Browser can download xls
    var htmltable = document.getElementById(tableId);
    var html = htmltable.outerHTML;

    this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls'); 
  },
  toCSV: function(tableId, filename) {
    this._filename = (typeof filename === 'undefined') ? tableId : filename;
    // Generate our CSV string from out HTML Table
    var csv = this._tableToCSV(document.getElementById(tableId));
    // Create a CSV Blob
    var blob = new Blob([csv], { type: "text/csv" });

    // Determine which approach to take for the download
    if (navigator.msSaveOrOpenBlob) {
      // Works for Internet Explorer and Microsoft Edge
      navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
    } else {      
      this._downloadAnchor(URL.createObjectURL(blob), 'csv');      
    }
  },
  _getMsieVersion: function() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf("MSIE ");
    if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
    }

    var trident = ua.indexOf("Trident/");
    if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf("rv:");
      return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
    }

    var edge = ua.indexOf("Edge/");
    if (edge > 0) {
      // Edge (IE 12+) => return version number
      return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
    }

    // other browser
    return false;
  },
  _isFirefox: function(){
    if (navigator.userAgent.indexOf("Firefox") > 0) {
      return 1;
    }
    
    return 0;
  },
  _downloadAnchor: function(content, ext) {
      var anchor = document.createElement("a");
      anchor.style = "display:none !important";
      anchor.id = "downloadanchor";
      document.body.appendChild(anchor);

      // If the [download] attribute is supported, try to use it
      
      if ("download" in anchor) {
        anchor.download = this._filename + "." + ext;
      }
      anchor.href = content;
      anchor.click();
      anchor.remove();
  },
  _tableToCSV: function(table) {
    // We'll be co-opting `slice` to create arrays
    var slice = Array.prototype.slice;

    return slice
      .call(table.rows)
      .map(function(row) {
        return slice
          .call(row.cells)
          .map(function(cell) {
            return '"t"'.replace("t", cell.textContent);
          })
          .join(",");
      })
      .join("\r\n");
  }
};






function viewPartCode(partid){
   
   var ur = 'ajex_getPartCode';
   
   $.ajax({
      type: "POST",
      url: ur,
      data: {'partid':partid},
      success: function(data){
       // alert('sdfsdf');
       // console.log(data);
        $("#getPartMappingData").empty().append(data).fadeIn();
        //$('#partid').val(partid);
        //$('#itemid').val(machineid);
        //$('#mapType').val(mtype);
      }
    });

   
}



function mapiingPartRowMat(partid,machineid,mtype){
	
   var ur = 'ajex_getPartRowMat';
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



function mapiingPartRowMatView(partid,machineid,mtype){
	
   var ur = 'ajex_getPartRowMatView';
   $.ajax({
      type: "POST",
      url: ur,
      data: {'partid':partid,'machineid':machineid},
      success: function(data){
       // alert('sdfsdf');
       // console.log(data);
        $("#getsparepartqtymappingView").empty().append(data).fadeIn();
		 $('#partid').val(partid);
        $('#itemid').val(machineid);
        $('#mapType').val(mtype);
		

		// $("#btn").prop('disabled', false);

		
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

function addpricemap(){
   var mproductname =  $('#mproductname').val();
   var mproductid   =  $('#mproductid').val();
   var price        =  $('#mPrice').val();
    var Eprice        =  $('#EPrice').val();
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
	$('#prodetails option:selected').remove();
       $('#quotationTable').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><input type ="hidden" name="EPrice[]" value="'+Eprice+'">'+Eprice+'</td><td><i class="fa fa-trash  fa-2x" mproductid="'+mproductid+'" mproductname="'+mproductname+'" id="quotationdel" aria-hidden="true"></i></td></tr>');

       $('#mproductname').val("");
       $('#mproductid').val("");
       $('#mPrice').val("");
	   $('#EPrice').val("");
       $("#muom").val("");
	   $("#prodetails").val("");
	   
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


function getEntityRow(thsValue){
    	//alert(thsValue+'sdsdf');
    	$.ajax({  
		    type: "POST",  
			url: "ajax_getentityRows",  
			cache:false,  
			data: {'id':thsValue},  
			success: function(data)  
			{
             // alert(data);
              //console.log(data);
			  $("#consigneeTable").empty().append(data).fadeIn();
			  amazonEntity();
			}   
	    });
    }

function getFG()
{
$("#status").val("13").trigger('chosen:updated');

}
</script>