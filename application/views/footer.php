<!-- Footer -->
<footer class="footer-main"> 
Copyright &copy; <?php echo date(Y);?> <a target="_blank" href="http://www.techvyas.com/"> Tech Vyas Pvt Ltd </a> All Rights Reserved.
</footer>	
<!-- /footer -->
</div>
<!-- /main content -->
</div>
  <!-- /main container -->
</div>
<!-- /page container -->
    
<!--Load JQuery-->


<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/metismenu/js/jquery.metisMenu.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery.blockUI.js"></script>
<!--Knob Charts-->
<script src="<?=base_url();?>assets/plugins/knob/js/jquery.knob.min.js"></script>
<!--Jvector Map-->
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
<!--ChartJs-->
<script src="<?=base_url();?>assets/plugins/chartjs/js/Chart.min.js"></script>
<!--Morris Charts-->
<script src="<?=base_url();?>assets/plugins/morris/js/raphael-min.js"></script>
<script src="<?=base_url();?>assets/plugins/morris/js/morris.min.js"></script>
<!--Float Charts-->
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.resize.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.pie.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.time.min.js"></script>
<!--Functions Js-->
<script src="<?=base_url();?>assets/js/functions.js"></script>
<!--Dashboard Js-->
<script src="<?=base_url();?>assets/js/dashboard.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<!-- Select2-->
<!-- <script src="<?php echo base_url();?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>plugins/select2/js/select2-script.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

 <script type="text/javascript" src="<?=base_url();?>js/jquery.ztree.core.js"></script>
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
 
 <script type="text/javascript">

          var setting = { };
          var da      = "";
          var title   =  $("#content_wrap").attr('arr');
      if(title !== undefined)
          var da      = JSON.parse(title);
        
          var zNodes  = da;
          var curMenu = null, zTree_Menu = null;
          var setting = {
            view:{
              showLine: false,
              showIcon: false,
              selectedMulti: false,
              dblClickExpand: false,
              addDiyDom: addDiyDom
             },
            data: {
              simpleData: {
                enable: true
              }
            },
            callback: {
              beforeClick: beforeClick
            }
          };
  
  function showtree(){


 }
  /* $(".delbutton11").click(function(){
    alert('sdfsdfcvzxcvzxcv');
  });*/
  function mapcategory(ths,id,name,code){
   // alert(name);
  
     $('#proId').val(id);
     $('#prdname').val(name);
     $('#prdcode').val(code);
     var checkval = $(ths).attr('checked_cat');
      if(checkval !== undefined)
          var checkval      = JSON.parse(checkval); 
    
     $("input.check").each(function ()
       {
        $(this).attr('checked', false);
        if(jQuery.inArray($(this).val(), checkval) != -1) {
           $(this).attr('checked', true);
          // alert($(this).val());
       } 
     });

  }
  
//---------------------------------------------Term and Condition-------------------------------------

 $("#TermForm").validate({
    rules: {
      // type: "required",
      // tem:"required"
    },
      submitHandler: function(form) {
        ur = "<?=base_url('master/termandcondition/insert_termandcondition');?>";
        var b = $('#tem').val();
        editorData= CKEDITOR.instances['tem'].getData();
        var formData = new FormData(form);
        formData.append('tem',  editorData);

        // alert('$(this)[0]');
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                 // alert(data); // show response from the php script.
                    
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-0 .close").click();
                      $("#resultarea").text(" "); 
                      $('#contactForm')[0].reset(); 
                      $("#Product_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
                 ajex_termListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function ajex_termListData(){
  ur = "<?=base_url('master/termandcondition/ajex_TermListData');?>";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
      }
  });

}


function editTermandcondition(ths){
   
  // alert('sdfsdf');
  $('.error').css('display','none');
 var jsonVal = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(jsonVal !== undefined)
     var editVal = JSON.parse(jsonVal);
  
  if(button_property != 'view')
     $('#id').val(editVal.id);

    
    CKEDITOR.instances['tem'].setData(editVal.des);
    $('#type').val(editVal.type);

     if(button_property == 'view'){
       $('#button').css('display','none');
       $("#TermForm :input").prop("disabled", true);
      }else{
       $('#button').css('display','block');
       $("#TermForm :input").prop("disabled", false);
      }
}

//---------------------------------------------------

function selectList(ths){
 var data =  $(ths).attr('jsvalue');
  if(data !== undefined)
    var data = JSON.parse(data);
    $('#productList').css('display','none');
    $('#prd').val(data.productname);
    $('#pri_id').val(data.Product_id);
}

$("#mapSpareForm").validate({
    rules: {},
      submitHandler: function(form) {
        ur = "<?=base_url('shapeMapping/insert_spare');?>";
        var formData = new FormData(form);
            $.ajax({
                type : "POST",
                url  :  ur, 
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                 alert(data); // show response from the php script.
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#mapSpare .close").click();
                       $("#resultarea").text(" "); 
                       $('#ItemForm')[0].reset(); 
                       $("#pri_id").val("");
                    }, 1000);
                  }else{
                    $("#resultarea").text(data);
                 }
                 //ajex_ItemListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //form.preventDefault();
      }
  });

  function getdataSP(val){
    //alert(val);
    $('#productList').css('display','block');
    ur = "<?=base_url('shapeMapping/ajax_productlist');?>"
    $.ajax({
      type: "POST",
      url: ur,
      data: {'value':val},
      success: function(data){
          console.log(data);
          $('#productList').html(data);
      }
    });
  }

//----------------------------------------------Master Data-----------------------------------

  $("#masterDataForm").validate({
    rules: {
      param_id: "required",
      keyvalue:"required"
    },
      submitHandler: function(e) {
        ur = "<?=base_url('/admin/masterdata/insert_master_data');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#masterDataForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                    
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-0 .close").click();
                      $("#resultarea").text(" "); 
                      $('#masterDataForm')[0].reset(); 
                      $("#serial_number").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
    			 ajex_masterDataList();
               }
            });
          return false;
        //e.preventDefault();
      }
  });


function ajex_masterDataList(){
  ur = "<?=base_url('/admin/masterdata/ajax_masterDataList');?>";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        // $("#listingDataremove").hide();
        // $("#listingData").append(data);
        // $("#listingData").fadeIn();
        $("#listingData").empty().append(data).fadeIn();

        //console.log(data);
     }
  });

}

function editMaster(ths) {
  //console.log('edit ready !');
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
      //alert(editVal.contact_id);
    if(button_property != 'view')
      $('#serial_number').val(editVal.serial_number);
      $('#param_id').val(editVal.param_id).prop('selected', true);
      $('#keyvalue').val(editVal.keyvalue);	  
      $('#description').val(editVal.description);
	  
      if(button_property == 'view'){
	  	$('.top_title').html('View');
       $('#button').css('display','none');
       $("#masterDataForm :input").prop("disabled", true);
      }else {
	  	$('.top_title').html('Update');	  
       $('#button').css('display','block');
       $("#masterDataForm :input").prop("disabled", false);
      }
}


//--------------------------------------------Contact Form--------------------------------------------

  $("#contactForm").validate({
    rules:{
        first_name: "required",
        maingroupname:"required"
      },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Account/insert_contact');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#contactForm').serialize(), // serializes the form's elements.
                success : function (data) {
                   //alert(data); // show response from the php script.
                    
				var res = data.split("^");
                  var nData=res[0];
                  var type=res[1];

                    if(nData == 1 || nData == 2){
                      if(nData == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-0 .close").click();
                      $("#resultarea").text(" "); 
                      $('#contactForm')[0].reset(); 
                      $("#contact_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
    			 ajex_contactListData(type);
               }
            });
          return false;
        //e.preventDefault();
      }
  });


function ajex_contactListData(type){
  ur = "<?=base_url('/master/Account/ajax_ContactListData');?>";
  
    $.ajax({
      url: ur,
      data: { 'id' : type },
      type: "POST",
      success: function(data){
      	
        // $("#listingDataremove").hide();
        // $("#listingData").append(data);
        // $("#listingData").fadeIn();
        $("#listingData").empty().append(data).fadeIn();

        //console.log(data);
     }
  });

}

function editContact(ths) {
  //console.log('edit ready !');
  
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
    if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);

      //alert(editVal.contact_id);
    if(button_property != 'view')
      $('#contact_id').val(editVal.contact_id);
      $('#maingroupname').val(editVal.group_name).prop('selected', true);
      $('#first_name').val(editVal.first_name);
      $('#contact_person').val(editVal.contact_person);
      $('#email').val(editVal.email);	  	  
      $('#mobile').val(editVal.mobile);
      $('#phone').val(editVal.phone);
      $('#pan_no').val(editVal.IT_Pan);	  
      $('#gst_no').val(editVal.gst);	  
      $('#address1').val(editVal.address1);	  
      $('#address3').val(editVal.address3);
      $('#city').val(editVal.city);
      
      $('#finalDestination').val(editVal.finalDestination);   
      $('#countryDestination').val(editVal.countryDestination);   
      $('#portDischarge').val(editVal.portDischarge);
      $('#norify').val(editVal.norify);

      $('#state').val(editVal.state_id).prop('selected', true);	  
      $('#printname').val(editVal.printname);
      $('#pin_code').val(editVal.pincode);
      $('#code').val(editVal.code);	  

      getEntityRow(editVal.contact_id);
      showconsigneemap(editVal.group_name);

      if(button_property == 'view'){
		  
	  	 $('.top_title').html('View');
       $('#button').css('display','none');
       $("#contactForm :input").prop("disabled", true);
      }else {
		  
		  <?php if($_GET['con_type']=='4'){?>$('.top_title').html('Update Buyer');	  <?php }?>

		  <?php if($_GET['con_type']=='7'){?>$('.top_title').html('Update Buyer');	  <?php }?>

	  	 
       $('#button').css('display','block');
       $("#contactForm :input").prop("disabled", false);
      }
}

//--------------------------------------------Product Form--------------------------------------------------------------

  $("#ItemForm").validate({
    rules: {
       //category:"required",
      sku_no: "required",
      productname:"required",
	  unit:"required"

    },
      submitHandler: function(form) {
        ur = "<?=base_url('master/Item/insert_item');?>";
        var formData = new FormData(form);
        //console.log(formData);
        //console.log( $().serialize(formData) );
            $.ajax({
                type : "POST",
                url  :  ur, 
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
				//data : $('#contactForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
                  
                  var res = data.split("^");
                  var nData=res[0];
                  var type=res[1];
                    if(nData == 1 || nData == 2){
                      if(nData == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-0 .close").click();
                       $("#resultarea").text(" "); 
                       $('#ItemForm')[0].reset(); 
                       $("#Product_id").val("");
                    }, 1000);
                  }else{
                    $("#resultarea").text(data);
                 }
                 ajex_ItemListData(type);
               },
                error: function(data){
                    alert("error");
              },
              cache: false,
              contentType: false,
              processData: false
            });
          return false;

        //form.preventDefault();
      }
  });
  

function ajex_ItemListData(type){

  ur = "<?=base_url('master/Item/ajex_ItemListData');?>";
    $.ajax({
      url: ur,
      data: { 'id' : type },
      type: "POST",
      success: function(data){
        //alert(data);
        //alert("jkhkjh"+type);
        //$("#listingData").hide();
        $("#listingData").empty().append(data).fadeIn();
              
     }
    });
}

function editItem(ths) {
 // var image_url = "<?=base_url('assets/scope_document');?>"+'/';
 // console.log('edit ready !');
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //alert(rowValue);
  console.log(rowValue);
   if(rowValue !== undefined)
    var editVal = JSON.parse(rowValue);

    if(button_property != 'view')
      $('#Product_id').val(editVal.Product_id);
      $('#type').val(editVal.type);
      $('#category').val(editVal.category).prop('selected', true);
  	  $('#sku_no').val(editVal.sku_no);
	  $('#circle_weight').val(editVal.circle_weight);
  	  $('#productname').val(editVal.productname);
      $('#unit').val(editVal.usageunit);	  
      $('#opening_stock').val(editVal.opening_stock);    

      // $('#scope').val(editVal.scope_doc).prop('selected', true);
  	  //$('#industry').val(editVal.industry).prop('selected', true);
      /* var valArr  = editVal.color; 
      if(valArr != null)
  	   {
        var dataarray=valArr.split(",");
       }*/
      //$('#color').val(dataarray);
	  $('#percentage').val(editVal.percentage);
	  $('#size').val(editVal.pro_size);
	  $('#thickness').val(editVal.thickness);
	  $('#grade_code').val(editVal.grade_code);
    $('#unitprice_sale').val(editVal.unitprice_sale);
    $('#unitprice_purchase').val(editVal.unitprice_purchase);	  
    $('#hsn_code').val(editVal.hsn_code);
    $('#gst_tax').val(editVal.gst_tax);
	  $('#weight').val(editVal.weight);
	  $('#ctn_lenght').val(editVal.ctn_lenght);
    $('#ctn_width').val(editVal.ctn_width);
	  $('#ctn_height').val(editVal.ctn_height);
	  $('#mst').val(editVal.mst);
	  $('#cbm').val(editVal.cbm);
	  $('#lead_time').val(editVal.lead_time);
    $('#net_weight').val(editVal.net_weight);
    $('#cast_weight').val(editVal.cast_weight);
	$('#tolerance_percentage').val(editVal.tolerance_percentage);
	$('#packing').val(editVal.packing);
	$('#qty_box').val(editVal.qty_box);
	
	
	
	 
	   getEntityRow(editVal.Product_id);
 
     getEntityRowOfPartCode(editVal.Product_id);
	 
	 getEntityRowOfShape(editVal.Product_id);
     
	  if(editVal.category != "")
        changing(editVal.category);
     
     $('#subcategory').val(editVal.subcategory).prop('selected', true);

    /*if(editVal.scope_doc != ""){
      $('#image').attr('href',image_url+editVal.scope_doc);
      $('#image').attr('title',editVal.scope_doc);
    }*/
     
      
      if(button_property == 'view'){
		  
		  
		  <?php
		  if($_GET['p_type']=='13'){
		  ?>
	   $('.top_title').html('View Raw Material');
	   <?php }
	   if($_GET['p_type']=='32'){
	   ?>
	   $('.top_title').html('View Part Name');
	   $("#rawdisp").css("display", "none");
	  
	   
	   
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='33'){
	   ?>
	   $('.top_title').html('View Shape');
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='14'){
	   ?>
	   $('.top_title').html('View Finish Goods');
	   <?php }?>
	    <?php 
	   if($_GET['p_type']=='15'){
	   ?>
	   $('.top_title').html('View Accessories');
	   <?php }?>
	   
	    <?php 
	   if($_GET['p_type']=='34'){
	   ?>
	   $('.top_title').html('View Packaging Material');
	   <?php }?>
	   
       $('#button').css('display','none');
       $("#ItemForm :input").prop("disabled", true);
      }else{
		  <?php
		  if($_GET['p_type']=='13'){
		  ?>
	   $('.top_title').html('Update Raw Material');
	   <?php }
	   if($_GET['p_type']=='32'){
	   ?>
	   $('.top_title').html('Update Part Name');
	   $("#rawdisp").css("display", "block");
	   
	   
	   
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='33'){
	   ?>
	   $('.top_title').html('Update Shape ');
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='14'){
	   ?>
	   $('.top_title').html('Update Finish Goods');
	   <?php }?>
	    <?php 
	   if($_GET['p_type']=='15'){
	   ?>
	   $('.top_title').html('Update Accessories');
	   <?php }?>
	   
	    <?php 
	   if($_GET['p_type']=='34'){
	   ?>
	   $('.top_title').html('Update Packaging Material');
	   <?php }?>
       $('#button').css('display','block');
       $("#ItemForm :input").prop("disabled", false);
      }


    var thsVal =editVal.type;
	
if(thsVal=='33')
{
	$("#consigneeMapping").show();	
}
else
{
	$("#consigneeMapping").hide();	
}



if(thsVal=='14')
{
  $("#consigneeTableShape").show();  
}

if(thsVal=='32')
{
  $("#consigneeMappingPart").show();  
}

else
{
  $("#consigneeMappingPart").hide();  
}


}
  
  
//-----------------------------------------------=

function addconsignee(){
   var value        =  0;
   var entity       =  $('#entity').val();
   // var entity_code  =  $('#entity_code').val();


   if(entity == ""){
    alert('Please Part Name');
    $('#entity').focus();
    return false;
   }
   
   // if(entity_code == ""){
   //  alert('Please Select Location code');
   //  $('#entity_code').focus();
   //  return false;
   // }


  
   // alert(indexVal);
   // alert(entity);
   // var entityCodeValuearr = [];
   // var entityCodeTextarr  = [];
   // $('select#entity_code').find('option:selected').each(function() {
   //  entityCodeValue =  $(this).val();
   //  entityCodeText  =  $(this).text();
   //  entityCodeValuearr.push(entityCodeValue);
   //  entityCodeTextarr.push(entityCodeText);
   // });

   // var entityCodeCommaValue = entityCodeValuearr.join(",");
   // var entityCodeComma      = entityCodeTextarr.join(",");

   //alert($("#entity_code option:selected").index());
   //alert($("select[name='entity_code'] option:selected").index());
 	var x        = document.getElementById("entity").selectedIndex;
   	var y        = document.getElementById("entity").options;
   	var indexVal =  y[x].text;
   $('#entity option:selected').remove();
   
   $('#consigneeTable').append('<tr class="'+'row_'+value+'"><td><input  type ="hidden" class="form-control" name="entity[]" value="'+entity+'"><input   type ="text" readonly class="form-control"  value="'+indexVal+'"></td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel" attrVal="'+entity+'" aria-hidden="true"></i></td></tr>');

  amazonEntity();
//$('#entity option:selected').remove();  
 }

 function amazonEntity(){
  
  
   $("select#entity").prop('selectedIndex', 0);
  var selectedentity = document.getElementsByName('entity[]'); 
 // alert(selectedentity);
  var selectboxes = [];
  for(var i=0; i < selectedentity.length; i++){
  
    if(selectedentity[i] != ""){
     selectboxes.push(selectedentity[i].value);
    }
   }
 
  $('select#entity').find('option').each(function() {
     // alert($(this).val());
    if(selectboxes.includes($(this).val()) == true){
        // // alert(arrayloc.includes(checkboxes[i].value));
        // checkboxes[i].checked = true;
       //  alert($(this).val());
      $(this).css("visibility", "hidden");
    }
  });

   $("#entity_code").empty().append('<option value="">--Select--</option>').fadeIn();
 }


function loadFile(ths) {
  if (ths.files && ths.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image').attr('src', e.target.result);
            };
          reader.readAsDataURL(ths.files[0]);
        }
}




$("#ItemMapping").validate({
    rules: {},
      submitHandler: function(form) {
        ur = "<?=base_url('master/Item/mappingPro');?>";
        var formData = new FormData(form);
            $.ajax({
                type : "POST",
                url  :  ur, 
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                //  alert(data); // show response from the php script.
                    if(data == 1){
                      if(data == 1)
                        var msg = "Mapping Process Successful !";
                     

                     $("#msgdata").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-1 .close").click();
                       $("#msgdata").text(" "); 
                       $('#ItemMapping')[0].reset(); 
                       $("#proId").val("");
                    }, 1000);
                  }else{
                    $("#msgdata").text(data);
                 }
                 ajex_ItemListData();
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


//---


function addDiyDom(treeId, treeNode) {
      var spaceWidth = 5;
      var switchObj = $("#" + treeNode.tId + "_switch"),
      icoObj = $("#" + treeNode.tId + "_ico");
      switchObj.remove();
      icoObj.before(switchObj);

      if (treeNode.level > 1) {
        var spaceStr = "<span style='display: inline-block;width:" + (spaceWidth * treeNode.level)+ "px'></span>";
        switchObj.before(spaceStr);
      }
  }

    function beforeClick(treeId, treeNode) {
      if (treeNode.level == 0 ) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.expandNode(treeNode);
        return false;
      }
      return true;
    }
    

$(document).ready(function(){
 
  if(zNodes != ""){
      var treeObj = $("#treeDemo");
      $.fn.zTree.init(treeObj, setting, zNodes);
      zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
      curMenu = zTree_Menu.getNodes()[0].children[0].children[0];
      zTree_Menu.selectNode(curMenu);

      treeObj.hover(function () {
        if (!treeObj.hasClass("showIcon")) {
          treeObj.addClass("showIcon");
        }
      }, function() {
        treeObj.removeClass("showIcon");
      });
     }

    $(document).delegate("#quotationdel","click",function(){
       var attrSelectValue = $(this).attr('attrVal');
       $('select#entity').find('option').each(function() {
          if($(this).val() == attrSelectValue){
            //alert($(this).val());
            $(this).css("visibility", "visible");
          }
        });
       var mproductname = $(this).attr('mproductname');
    var mproductid = $(this).attr('mproductid');
    
       $(this).parent().parent().remove();
	  $("#prodetails").append('<option value="'+mproductid+'">'+mproductname+'</option>'); 
    });

$(document).delegate("#QuotationMap","click",function(){
      var quoId     = [];
      var priceQuot =  [];
      j=0;i=0;
      $('input[name="quotation[]"]').each(function(){
           quoId[i++]  = $(this).val();
      });
      
      $('input[name="quotationPrice[]"]').each(function(){
           priceQuot[j++] = $(this).val();
      });
      
      var myObject  = new Object();
     // myObject.productId = $('#quotationPro').val();
      myObject.quotation = quoId;
      myObject.price = priceQuot;
      var myString = JSON.stringify(myObject);    
     
     // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
      $('#QuotationMap').val(myString);
      $("#QuotationMapForm")[0].reset();
      $('#quotationTable').empty();
      document.getElementById("lph").focus();
      $("#myModal .close").click();
      
  });


});

    
  function openmodelPopup(){
    //alert();
     $("#openPopup").click();
  }

 
  function addQuotation(){

   var qname =  $('#quotation').val();
   var qid   =  $('#qid').val();
   var price =  $('#quotationPrice').val();
   $('#resultarea').text("");
    //alert(price);
    if(qid == "" || price == ""){
      if(qid == "")
        var msg = 'Please Enter Right Quotation Name';
      else
        var msg = 'Please Enter  Quotation Price';

     $('#resultarea').text(msg);


    }else{
       $('#quotationTable').append('<tr><td><input type ="hidden" name="quotation[]" value="'+qid+'">'+qname+'</td><td><input type ="hidden" name="quotationPrice[]" value="'+price+'">'+price+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');

       $('#quotation').val("");
       $('#qid').val("");
       $('#quotationPrice').val("");
    }
  }
</script>

<script>
$("#target").click(function(event){
    event.preventDefault();
    $("#error").text(" ");
    $('#button').css('display','block');
   
    $("#category").prop("disabled", false);
  
    $("#selectCategory").prop("disabled", false);
$("#typee").prop("disabled", false);


    var ur   = "<?php echo base_url('master/ProductCategory/ajex_formsubmit');?>";
    var name = $("#category").val();
    var id   = $("#selectCategory").val();
	 var typee   = $("#typee").val();
  
    var submit_type = $('#target').attr("submit_value");
    var editId = $('#editvalue').val();
    
    if(name != "" && id != ""){
        $.ajax({
        type: "POST",
        url: ur,
        data: {'typee':typee,'category':name,'selectCategory':id,'type':submit_type,'edit':editId},
        cache: false,
        success: function(data){
          $("#resultarea").text(data);
          ajex_loadListData(); //// load add table listing // 
          setTimeout(function() {   //calls click event after a certain time
          $("#modal-1 .close").click();
          $("#resultarea").text(" "); 
          }, 1000);
          $('#formId')[0].reset(); 
         
        } 
        });
    }else if(name == ""){
     $("#error").text('Please Enter Category !');
    }else if(id == ""){
     $("#error").text('Please Select Category !');
    }
});



function deleterow(ths){
 var element = $(ths);
 var del_id = element.attr("id");
 var info = 'id=' + del_id;

   if(confirm("Are you sure you want to delete ?"))
    {
      $.ajax({
       type: "GET",
       url: "delete_data",
       data: info,
       success: function(data){}
      });
      $(ths).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
   }
return false;
}

/*$('.email.dropdown').dropdown();

$('.emails.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});
*/

function inputdisable(){
   $('#formId')[0].reset(); 
}

/*function editRow(ths){
   var value  =  $('#'+ths).attr("arrt");
   var cat_id =  $('#'+ths).attr("cat_id");
   var type =  $('#'+ths).attr("typeid");
   var grade =  $('#'+ths).attr("grade");
   //alert(cat_id);
    $('#selectCategory').val(cat_id).prop('selected', true);
    $('#category').val(value);
    $('#type').val(type).prop('selected', true);
    $('#grade').val(grade).prop('selected', true);
    $('#target').attr("submit_value","edit");
    $('#editvalue').val(ths);
}
*/

function editRowCategory(ths,thisvalue,typee){  
	
	var value  =  $('#'+ths).attr("arrt");
	var cat_id =  $('#'+ths).attr("cat_id");
	
	$('#typee').val(typee);
    $('#selectCategory').val(cat_id).prop('selected', true);
	$('#category').val(value);
	$('#target').attr("submit_value","edit");
    $('#editvalue').val(ths);
    var property  =  $(thisvalue).attr("property");
	
    if(property == "view"){
		$('.top_title').html('View Product Type');
		$('#button').css("display",'none'); 
		$('#category').attr('readonly', 'true'); 
		$('#selectCategory').attr('disabled', 'true'); 
		$('#typee').attr('disabled', 'true'); 
		$(' #save').hide(); 
     	}else{
		$('.top_title').html('Update Product Type');
		$('#button').css("display",'block');
		$('#category').attr("readonly",false); 
		$('#selectCategory').attr("disabled",false); 
		$('#typee').attr("disabled",false); 
		$(' #save').show();
     }
    

}


function showRowtree(val){
  
	var ur   = "<?php echo base_url('master/ProductCategory/ajaxShowParent');?>";
	$(".displayclass").css("display", "none");
	$("th").css("color", "black");
	$.ajax({
		type: "POST",
			url: ur,
			data: {'id':val },
			success: function(data){
			$("#showParent").html(data);
			$("#row"+val).css("color", "red");
			$("#popover").css("display", "block");
	}
	});
}



function ajex_loadListData(){
	ur = "<?=base_url('master/ProductCategory/ajex_loadListData');?>";
  	$.ajax({
		url: ur,
		type: "POST",
		success: function(data){
		$("#loadProductData").html(data);
        // console.log(data);
		},
        // error: function(data){
        //     alert("error");
        // },
		cache: false,
		contentType: false,
		processData: false
	});
}

function saveData(){
	var code= document.getElementById("code").value;
	var machine_name= document.getElementById("machine_name").value;
	var machine_des= document.getElementById("machine_des").value;
	var capacity= document.getElementById("capacity").value;

	if(code=='')
	{
		document.getElementById("codemsg").innerHTML = "Please Enter Code";
		return false;
	}

	ur = "<?=base_url('shapeMapping/insert_machine');?>";
	$.ajax({
		url: ur,
		type: "POST",
		data: {'code':code,'machine_name':machine_name,'machine_des':machine_des,'capacity':capacity},
		success: function(data){
		$("#modal-0 .close").click();
		$("#loadData").html(data);
		document.getElementById("code").value='';
		console.log(data);
	}
	});
}


function getdataQuotation(val){
    //alert(val);
	var selectQuotation = $('#pri_id').val();
	if(selectQuotation != ""){
		$('#quotationPro').val(selectQuotation);
		$('#productList').css('display','block');
		ur = "<?=base_url('quotation/ajax_productlist');?>"
		$.ajax({
			type: "POST",
			url: ur,
			data: {'value':val},
			success: function(data){
			console.log(data);
			$('#productList').html(data);
	}
	});
	}else{
     alert('Please Select Product !');
   }
}




$(document).delegate("#mapingbutton","click",function(){
     $("#insertProductMapping").submit();
});


$("#insertProductMapping").validate({
	submitHandler: function(form){
	ur = 'insertProductMapping';
	var formData = new FormData(form);
	$.ajax({
		type : "POST",
		url  :  ur, 
		cache: false,
            //dataType : 'json', // Notice json here
		data : formData, // serializes the form's elements.
		success : function (data) {
            //alert(data);   // show response from the php script.
		console.log(data);
		if(data == 1){
			var msg = "Data Successfully Add !";
				$("#msgdata").text(msg); 
					setTimeout(function() {   //calls click event after a certain time
						$("#modal-2 .close").click();
						$("#msgdata").text(" "); 
						$('#ItemForm')[0].reset(); 
						$("#contact_id").val("");
					}, 1000);
                   }else{
					$("#msgdata").text(data);
					}
                //  ajex_ItemListData();
                },
                error: function(data){
                     alert("error");
                },
                contentType: false,
                processData: false
            });
          return false;
        form.preventDefault();
      }
  });



// function selectList(ths){
//  var data =  $(ths).attr('jsvalue');
//    if(data !== undefined)
//      var data = JSON.parse(data);
//   $('#productList').css('display','none');
//   $('#quotation').val(data.name);
//   $('#qid').val(data.id);
// }

/*function ajexShowTree(){
  ur = "<?=base_url('master/ProductCategory/ajexShowTree');?>";
  $.ajax({url: ur,success:function(data){
      $(".treeAncor").attr(arr,data);
        var setting = { };
        var title   =  $("#content_wrap").attr('arr');
        var da      = JSON.parse(title);
        var zNodes  = da;
        var curMenu = null, zTree_Menu = null;
        var setting = {
          view:{
            showLine: false,
            showIcon: false,
            selectedMulti: false,
            dblClickExpand: false,
            addDiyDom: addDiyDom
           },
          data: {
            simpleData: {
              enable: true
            }
          },
          callback: {
            beforeClick: beforeClick
          }
        };

    }
  });
}*/

</script>


</body>

</html>
<!-- starts here this javascript code is for multiple delete -->


<script type="text/javascript">
$(document).ready(function(){

$(document).delegate("#formreset","click",function(){
     //  alert('ssdfsdf');
    //var url = "<?=base_url()?>"+'assets/images/no_image.png';
	var formid =  $('#formreset').attr('formid');
	$(formid)[0].reset();
	$("#getPartView").empty();
	
	$(".hiddenField").val('');
	
	
	<?php 
	   if($_GET['con_type']=='4'){
	   ?>
	   $('.top_title').html('Add Buyer');
	<?php }?>


	<?php 
	   if($_GET['con_type']=='7'){
	   ?>
	   $('.top_title').html('Add Consignee');
	<?php }?>
	
	<?php 
	   if($_GET['con_type']=='5'){
	   ?>
	   $('.top_title').html('Add Vendor');
	<?php }?>
	
	<?php 
	   if($_GET['con_type']=='6'){
	   ?>
	   $('.top_title').html('Add Employee');
	<?php }?>
	

	  <?php
		  if($_GET['p_type']=='13'){
		  ?>
	   $('.top_title').html('Add Raw Material');
	   <?php }
	   if($_GET['p_type']=='32'){
	   ?>
	   $('.top_title').html('Add Part Name');
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='33'){
	   ?>
	   $('.top_title').html('Add Shape Name');
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='14'){
	   ?>
	   $('.top_title').html('Add Finish Goods');
	   <?php }?>
	    <?php 
	   if($_GET['p_type']=='15'){
	   ?>
	   $('.top_title').html('Add Accessories');
	   <?php }?>
	   
	    <?php 
	   if($_GET['p_type']=='34'){
	   ?>
	   $('.top_title').html('Add Packaging Material');
	   <?php }?>
	   
	   <?php 
	   if($_GET['p_type']=='35'){
	   ?>
	   $('.top_title').html('Add Accessories');
	   <?php }?>
    $(formid+" :input").prop("disabled", false);
    $("#button").css("display", "block");
    //CKEDITOR.instances['tem'].setData("");
    //$('#image').attr('src',url);
	$("#consigneeTable").empty();
	showconsigneemap(thsVal = "");
});
//-----------------Entries-------------------

$("#entries").change(function()
	{
	var value=$(this).val();
	var pageurl  = $(this).attr('url');
	url = pageurl+"&entries="+value;
	window.location.href = url;
	});

//-----------------End-------------------------

jQuery('#master').on('click', function(e) {
	if($(this).is(':checked',true))  
	{
		$(".sub_chk").prop('checked', true);  
	}  
	else  
	{  
	$(".sub_chk").prop('checked',false);  
	}  
});
	$(document).delegate(".classname","click",function(){
	alert("ok");
});
	
//------------------------Multiple Delete Single  table---------------------
	
	//$('.delete_all').on('click', function(e) { 
    $(document).delegate(".delete_all","click",function(e){
		var allVals = [];  
		$(".sub_chk:checked").each(function() {  
			allVals.push($(this).attr('data-id'));
		});  

		//alert(allVals.length); return false;  
		if(allVals.length <=0)  
		{  
			alert("Please select row.");  
		}  
		else {  
			//$("#loading").show(); 
			WRN_PROFILE_DELETE = "Are you sure? You want to delete this row!";  
			var check = confirm(WRN_PROFILE_DELETE);  
			//alert(check);
			if(check == true){  
				//for server side
				var table_name=document.getElementById("table_name").value;
				var pri_col=document.getElementById("pri_col").value;
				var join_selected_values = allVals.join(","); 
				//alert(join_selected_values);
	
				$.ajax({   
				  type: "POST",  
					url: "multiple_delete_table",  
					cache:false,  
					data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
					//alert(data);
					success: function(response)  
					{   
						$("#loading").hide();  
						$("#msgdiv").html(response);
           //referesh table
					}   
				});
      //for client side
			  $.each(allVals, function( index, value ) {
				  $('table tr').filter("[data-row-id='" + value + "']").remove();
			  });
				

			}  
		}  
	});

//----------------Multiple Delete Two Table ---------------------

	//$('.delete_two_all').on('click', function(e) { 
    $(document).delegate(".delete_two_all","click",function(e){
		var allVals = [];  
		$(".sub_chk:checked").each(function() {  
			allVals.push($(this).attr('data-id'));
		});  

		//alert(allVals.length); return false;  
		if(allVals.length <=0)  
		{  
			alert("Please select row.");  
		}  
		else {  
			//$("#loading").show(); 
			WRN_PROFILE_DELETE = "Are you sure? You want to delete this row!";  
			var check = confirm(WRN_PROFILE_DELETE);  
			//alert(check);
			if(check == true){  
				//for server side
				var table_name=document.getElementById("table_name").value;
				var pri_col=document.getElementById("pri_col").value;
				var join_selected_values = allVals.join(","); 
				//alert(join_selected_values);
	
				$.ajax({   
				  type: "POST",  
					url: "multiple_delete_two_table",  
					cache:false,  
					data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
					//alert(data);
					success: function(response)  
					{   
						$("#loading").hide();  
						$("#msgdiv").html(response);
           //referesh table
					}   
				});
      //for client side
			  $.each(allVals, function( index, value ) {
				  $('table tr').filter("[data-row-id='" + value + "']").remove();
			  });
				

			}  
		}  
	});

//-----------------------------------------------------end---------------------------
	jQuery('.remove-row').on('click', function(e) {
		WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){
				$('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
			}
	});
});
</script> 

<!-- ends here this javascript code is for multiple delete -->

<!-- starts here this javascript code is for single delete -->
<script type="text/javascript">
$(function() {


//$( ".delbutton" ).on( "click",function(){
 $(document).delegate(".delbutton","click",function(){  
 //Save the link in a variable called element
 var element = $(this);
 //Find the id of the link that was clicked
 var del_id = element.attr("id");
 //Built a url to send
 var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete ?"))
		  {
 $.ajax({
   type: "GET",
   url: "delete_data",
   data: info,
   success: function(){
    
   }
 });

 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});

</script>
<!-- ends here this javascript code is for single delete -->


<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {
	$(".delbuttonSales").click(function(){
	//Save the link in a variable called element
	var element = $(this);
	//Find the id of the link that was clicked
	var del_id = element.attr("id");
	//Built a url to send
	var info = 'id=' + del_id;
	if(confirm("Are you sure you want to delete ?"))
	{
	$.ajax({
		type: "GET",
		url: "delete_sales_order_data",
		data: info,
		success: function(){
	}
});
	$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->
<!-- starts here this javascript code is for  invoice delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonInvoice").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_invoice_data",
   data: info,
   success: function(){
  
   }
 });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for invoice delete -->

<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonPurchase").click(function(){

  //Save the link in a variable called element
  var element = $(this);
  //Find the id of the link that was clicked
  var del_id = element.attr("id");
  //Built a url to send
  var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete ?"))
		  {
       $.ajax({
         type: "GET",
         url: "delete_purchase_order_data",
         data: info,
         success: function(){
          }
         });
    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->






<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}
</script>



<!-----------------drop down select start here------------->

<script type="text/javascript" src="<?=base_url();?>assets/dropdown-customer/mock.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.css">
<script src="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.js"></script>
<script>

    var Random = Mock.Random;
    var json1 = Mock.mock({
      "data|10-50": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled|1-2": true,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-1').dropdown({
      data: json1.data,
      limitCount: 40,
      multipleMode: 'label',
      choice: function () {
        // console.log(arguments,this);
      }
    });

    var json2 = Mock.mock({
      "data|10000-10000": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled": false,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-2').dropdown({
      limitCount: 5,
      searchable: false
    });

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

    $('.dropdown-sin-2').dropdown({
      data: json2.data,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });
</script>
<!--Loader Js-->
<script src="<?=base_url();?>assets/js/loader.js"></script>

<script src="<?=base_url();?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/vfs_fonts.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables-script.js"></script>

<link href="<?=base_url();?>assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">



<!-----------------drop down select ends here------------->


<!-----------------flash timmer code starts here------------->
<script>
$(document).ready(function(){

    setTimeout(function(){

        $('#success-alert').fadeOut();}, 4000);

});

</script>


<!-----------------ends timmer code starts here------------->


<!-- starts here this javascript code is for  template delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonTemplate").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_template",
   data: info,
   success: function(){
  
   }
 });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for template delete -->

<script type="text/javascript">
$(function() {

$(".delbuttonProduction").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_production_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>

<script type="text/javascript">
$(function() {


$(".delbuttonCutting").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
//alert(info);
 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_cutting_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<script type="text/javascript">
$(function() {

$(".delbuttonpacking").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_packing_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>


<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<script>
    //CKEDITOR.replace('tem');
   /// CKEDITOR.instances['tem'].setData();

</script> 

<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}



//manage page search script//


function doSearch() {
    //alert('afsdfasdf');
   var abc = document.getElementById('searchTerm').value;
   var searchText=abc.toLowerCase();
   
   var targetTable = document.getElementById('getDataTable');
   var targetTableColCount;
          // alert('aadf');
   //Loop through table rows
   for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
       var rowData = '';

       //Get column count from header row
       if (rowIndex == 0) {
          targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
          continue; //do not execute further code for header row.
       }
               
       //Process data rows. (rowIndex >= 1)
       for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
           rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent.toLowerCase();
       }

       //If search term is not found in row data
       //then hide the row, else show
       if (rowData.indexOf(searchText) == -1)
           targetTable.rows.item(rowIndex).style.display = 'none';
       else
           targetTable.rows.item(rowIndex).style.display = 'table-row';
   }
}

// ends

//unitForm








//---------------unit conversion Form---------------------------

  $("#unitForm").validate({
    rules: {
      
      category:"required",
      sku_no: "required",
      productname:"required",
    

    },
      submitHandler: function(form) {
        ur = "<?=base_url('master/Item/insert_unit_conversion');?>";
        var formData = new FormData(form);
        //console.log(formData);
        //console.log( $().serialize(formData) );
            $.ajax({
                type : "POST",
                url  :  ur, 
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
        //data : $('#contactForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  //alert(data); // show response from the php script.
              
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-0 .close").click();
                       $("#resultarea").text(" "); 
                       $('#unitForm')[0].reset(); 
                       $("#id").val("");
                       


                    }, 1000);
                  }else{
                    $("#resultarea").text(data);
                 }
                 ajex_UnitListData();
               },
                error: function(data){
                    alert("error");
              },
              cache: false,
              contentType: false,
              processData: false
            });
          return false;

        //form.preventDefault();
      }
  });
  

function ajex_UnitListData(){

  ur = "<?=base_url('master/Item/ajex_UnitListData');?>";
    $.ajax({
      url: ur,
      //data: { 'id' : type },
      type: "POST",
      success: function(data){
        //alert(data);
        //alert("jkhkjh"+type);
        //$("#listingData").hide();
        $("#listingData").empty().append(data).fadeIn();
              
     }
    });
}

function editUnit(ths) {
 // var image_url = "<?php //echo base_url('assets/scope_document');?>"+'/';
 // console.log('edit ready !');
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //alert(rowValue);
  console.log(rowValue);
  //alert(rowValue);
   if(rowValue !== undefined)
    var editVal = JSON.parse(rowValue);

    if(button_property != 'view')
      $('#id').val(editVal.id);
      $('#con_fact').val(editVal.unit_conversion_value);
      $('#main_unit').val(editVal.unit_name).prop('selected', true);
      $('#sub_unit').val(editVal.unit_conversion_name).prop('selected', true);
    
     
      
      if(button_property == 'view'){
     $('.top_title').html('View');
       $('#button').css('display','none');
       $("#unitForm :input").prop("disabled", true);
      }else{
     $('.top_title').html('Update');
       $('#button').css('display','block');
       $("#unitForm :input").prop("disabled", false);
      }

}


//-----------------------------------------------=

function addconsigneeShape(){
   var value        =  0;
   var entityShape       =  $('#entityShape').val();
   // var entity_code  =  $('#entity_code').val();


   if(entityShape == ""){
    alert('Please Shape Name');
    $('#entityShape').focus();
    return false;
   }
   
   // if(entity_code == ""){
   //  alert('Please Select Location code');
   //  $('#entity_code').focus();
   //  return false;
   // }


  
   // alert(indexVal);
   // alert(entity);
   // var entityCodeValuearr = [];
   // var entityCodeTextarr  = [];
   // $('select#entity_code').find('option:selected').each(function() {
   //  entityCodeValue =  $(this).val();
   //  entityCodeText  =  $(this).text();
   //  entityCodeValuearr.push(entityCodeValue);
   //  entityCodeTextarr.push(entityCodeText);
   // });

   // var entityCodeCommaValue = entityCodeValuearr.join(",");
   // var entityCodeComma      = entityCodeTextarr.join(",");

   //alert($("#entity_code option:selected").index());
   //alert($("select[name='entity_code'] option:selected").index());
 	var x        = document.getElementById("entityShape").selectedIndex;
   	var y        = document.getElementById("entityShape").options;
   	var indexVal =  y[x].text;
   $('#entityShape option:selected').remove();
   
   $('#consigneeTableShape').append('<tr class="'+'row_'+value+'"><td><input  type ="hidden" class="form-control" name="entityShape[]" value="'+entityShape+'"><input   type ="text" readonly class="form-control"  value="'+indexVal+'"></td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel" attrVal="'+entityShape+'" aria-hidden="true"></i></td></tr>');

  amazonEntity();
//$('#entity option:selected').remove();  
 }


</script>

<?php
$this->load->view("javascriptPage.php");
?>