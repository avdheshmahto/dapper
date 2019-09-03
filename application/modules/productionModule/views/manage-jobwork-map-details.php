<?php
  $this->load->view("header.php");

  $scheQuery=$this->db->query("select * from tbl_job_work where id='".$_GET['id']."' ");
  $getsched=$scheQuery->row();


  $scheQueryJob=$this->db->query("select * from tbl_job_work where job_order_no='$getsched->job_order_no' ");
  $getschedJob=$scheQueryJob->row();


  $input = $getschedJob->qty;
  $res = explode(',',$input);
  $sumRm= array_sum($res);
  $sumRmShape=$getschedJob->shape_qty;
    
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
  //starts purchase return  query
  
  function SubmitmyProduction_purchase_return() {
          
    var form_data = new FormData(document.getElementById("productionOrderPurchaseReturn"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionPurchaseReturn",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
  //	alert(data);
  	
  	
  	  if(data == 1 || data == 2){
  		
                        if(data == 1)
  					    
                          var msg = "Data Successfully Add !";
                        else
                          var msg = "Data Successfully Updated !";
  						$("#OrderPurchaseReturnResult").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-purchase-return .close").click();
                         $("#OrderPurchaseReturnResult").text(" "); 
                         $('#myProduction_order_repair')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#OrderRepairresultarea").text(data);
  					
                   }
  				// ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  //starts purchase return  query
  
  function SubmitmyProduction_RM_return() {
        
    var form_data = new FormData(document.getElementById("productionOrderRMReturn"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionRMReturn",
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
  						$("#OrderPurchaseReturnResult").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-purchase-return .close").click();
                         $("#OrderPurchaseReturnResult").text(" "); 
                         $('#myProduction_order_repair')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#OrderRepairresultarea").text(data);
  					
                   }
  				ajex_RmReturnListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  
  
  //starts order repair  query
  
  function submitProductionOrderRepaire() {
             
    var form_data = new FormData(document.getElementById("myProduction_order_repair"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionOrderRepair",
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
  						$("#OrderRepairresultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-order-repair").click();
                         $("#OrderRepairresultarea").text(" "); 
                         $('#myProduction_order_repair')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#OrderRepairresultarea").text(data);
  					
                   }
  				 ajex_OrderRepairListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  
  
  //starts order check  query
  
  function submitProductionOrderCheck() {
           
    var form_data = new FormData(document.getElementById("myProduction_order_check"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionOrderCheck",
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
  						$("#OrderCheckresultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-order-checking").click();
                         $("#OrderRepairresultarea").text(" "); 
                         $('#myProduction_order_check')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#OrderRepairresultarea").text(data);
  					
                   }
  				ajex_CheckingListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  
  
  //starts order receive  query
  
  function submitProductionOrderReceive() {
              
    var form_data = new FormData(document.getElementById("myProduction_order_receive"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionOrderInsert",
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
  						          $("#Orderresultarea").text(msg);
  						          setTimeout(function() {   //calls click event after a certain time
                         $("#modal-order").click();
                         $("#Orderresultarea").text(" "); 
                         $('#myProduction_order_receive')[0].reset(); 
  					             //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#Orderresultarea").text(data);
  					
                   }
  				 ajex_Order_Grn_Data(<?=$_GET['id'];?>);
   
  	 
     // console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  function Order_check(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  var job_lot_no=document.getElementById("job_lot_no").value;
   	$.ajax({   
  		    type: "POST",  
  			url: "order_check",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no,'job_lot_no':job_lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderCheck").empty().append(data).fadeIn();
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  
  function purchase_return(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "purchase_order_return",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#purchaseReturnDiv").empty().append(data).fadeIn();
  			 //alert(data);
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  
  function RM_return(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "rm_return",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#purchaseReturnDiv").empty().append(data).fadeIn();
  			 //alert(data);
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  
  
  function Order(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "order_details",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderDetails").empty().append(data).fadeIn();
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  
  
  function Order_transfer(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "order_transfer",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderTransfer").empty().append(data).fadeIn();
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  function Order_repair(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "order_repair",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderRepair").empty().append(data).fadeIn();
  			//referesh table
  			}   
  	});
  
   }
  
  
  
  function viewRawRequest(v){
  
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_request_raw?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewRequest").innerHTML = xhttp.responseText;
  }
  
  
  
  function viewScrap(v){
  
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_scrap_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewScrap").innerHTML = xhttp.responseText;
  }
  
  
  
  
  function viewRepairOrder(v){
  
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_repair_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewRepairOrder").innerHTML = xhttp.responseText;
  }
  
  
  
  function viewChecking(v){
  
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_check_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewCheck").innerHTML = xhttp.responseText;
  }
  
  
  
  function viewRMOrderDetails(v){
  	var pro=v;
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "productionModule/view_rm_order_details?ID="+pro, false);
  	xhttp.send();
   	document.getElementById("viewCheck").innerHTML = xhttp.responseText;
  }
  
  
  
  
  
  function view_production_log(poid){
  	
  	
  	//alert(poid);
  	var res = poid.split(",");
  	var poidd=res[0];
  	var ord=res[1];
      $.ajax({   
  	    type: "POST",  
  		url: "view_production_log_cont",  
  		cache:false,  
  		data: {'id':poidd,'ord':ord},  
  		success: function(data)  
  		{  
  		// /alert(data); 
  		// $("#loading").hide();  
  		 $("#view-production-log").empty().append(data).fadeIn();
  		//referesh table
  		}   
  	});
  }
  
  function getPart(v)
  {
  	
  	var ur = '<?=base_url();?>productionModule/getPart';
  	$.ajax({
  	type: "POST",
  	url: ur,
  	data: {'shape':v,'production_id':<?=$_GET['id'];?>},
  	success: function(data){
      // console.log(data);
      $("#getPartView").empty().append(data).fadeIn();
  	// $("#btn").prop('disabled', false);
      }
      });
  }
  
  
  
  
  
  function getPartPo(v)
  {
  	
  	var ur = '<?=base_url();?>productionModule/getPartPo';
  	$.ajax({
  	type: "POST",
  	url: ur,
  	data: {'shape':v,'production_id':<?=$_GET['id'];?>},
  	success: function(data){
      // console.log(data);
      $("#getPartPoView").empty().append(data).fadeIn();
  	// $("#btn").prop('disabled', false);
      }
      });
  }
  
  
  function qtyFill(v)
  {
  	
  var cntV=document.getElementById("cntVal").value;
  
  for(i=1;i<=cntV;i++)
  {
  	
  	document.getElementById("entQty"+i).value=v;
  	
  }
  	
  }
  
  
  function qtyFillPO(v)
  {
  
  var cntV=document.getElementById("cntVal").value;
  
  for(i=1;i<=cntV;i++)
  {
  	
  	document.getElementById("entQty"+i).value=v;
  	
  }
  
  }
  
  //****************************************************************************************************************
</script>
<script>
  function addpricemapPoOrder(){
  
  	var shapeid =  $('#shapePO').val();
  	var shapeVal     =  $("#shapePO option:selected").text();   
  	var part=$('#part').val();
  	var PartId     = [];
  	var qtyy	= []; 
  	var part_c	=[];
  	j=0;i=0;k=0;
  	
  	$('input[name="part[]"]').each(function(){
  	PartId[i++]  = $(this).val();
  	});
  
  	$('input[name="qty[]"]').each(function(){
  	qtyy[j++]  = $(this).val();
  	});
  
  	$('input[name="part_code[]"]').each(function(){
  	part_c[k++]  = $(this).val();
  	});
        
  	var myObject  = new Object();
      // myObject.productId = $('#quotationPro').val();
  	var pa=myObject.part = PartId;
  	var qt=qtyy;
  	var pa_co=part_c;
  	var myString = JSON.stringify(myObject);    
  	
  	  
  	   $('#quotationTablePO').append('<tr><td><input type ="hidden" name="shapeId[]" value="'+shapeid+'">'+shapeVal+'</td><td><input type ="hidden" name="part_c[]" value="'+pa_co+'"><input type ="hidden" name="partId[]" value="'+pa+'">'+pa+'</td><td><input type ="hidden" name="qtyy[]" value="'+qt+'">'+qt+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');
      
  	$("#shapePO").val("");
  	$("#getPartPoView").text("");
    }
  
  
  function addpricemap(){
  
  	var shapeid =  $('#shape').val();
  	var shapeVal     =  $("#shape option:selected").text();   
  	var part=$('#part').val();
  	var PartId     = [];
  	var qtyy	= []; 
  	var part_c	=[];
  	j=0;i=0;k=0;
  	
  	$('input[name="part[]"]').each(function(){
  	PartId[i++]  = $(this).val();
  	});
  
  	$('input[name="qty[]"]').each(function(){
  	qtyy[j++]  = $(this).val();
  	});
  
  	$('input[name="part_code[]"]').each(function(){
  	part_c[k++]  = $(this).val();
  	});
        
  	var myObject  = new Object();
      // myObject.productId = $('#quotationPro').val();
  	var pa=myObject.part = PartId;
  	var qt=qtyy;
  	var pa_co=part_c;
  	var myString = JSON.stringify(myObject);    
  	
  	  
  	   $('#quotationTable').append('<tr><td><input type ="hidden" name="shapeId[]" value="'+shapeid+'">'+shapeVal+'</td><td><input type ="hidden" name="part_c[]" value="'+pa_co+'"><input type ="hidden" name="partId[]" value="'+pa+'">'+pa+'</td><td><input type ="hidden" name="qtyy[]" value="'+qt+'">'+qt+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');
      
  	$("#shape").val("");
  	$("#getPartView").text("");
  
  
  
  
    }
    function submitForm() {
              
    var form_data = new FormData(document.getElementById("myform"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/insert_jobwork",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
  	
  	
  	
  	  if(data == 1 || data == 2){
  		
                        if(data == 1)
  					    
                          var msg = "Data Successfully Add !";
                        else
                          var msg = "Data Successfully Updated !";
  						$("#resultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-2 .close").click();
                         $("#resultarea").text(" "); 
                         $('#myform')[0].reset(); 
  					   $("#quotationTable").text(" "); 
  					   
                         $("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#resultarea").text(data);
  					
                   }
  				 ajex_JobWorkListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  
  function viewWorkOrder(v){
  	
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_work_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewWork").innerHTML = xhttp.responseText;
  }
  
  function ajex_JobWorkListData(production_id){
    
    window.location.reload();

    /*ur = "<?=base_url('productionModule/getWorkOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){

          $("#listingData").empty().append(data).fadeIn();
                
       }
      });*/
  }
  
</script>
<!-- Main content -->
<div class="main-content">
  <div class="panel-body panel panel-default">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body__">
          <div class="row centered-form">
            <div class="col-xs-12 col-sm-12">
              <div class="panel panel-default___">
                <div class="panel-heading" style="background-color: #F5F5F5; color:#fff; border-color:#DDDDDD;">
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Order Details:-</span><?=$getsched->inboundid;?>
                    <a href="<?=base_url();?>productionModule/manage_jobwork_map?id=<?=$getsched->production_id;?>&&jo_no=<?=$getsched->job_order_no?>" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
                  </h3>
                </div>
                <div class="panel-body" style="padding:15px 0px;">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Lot No.</h4>
                        <input type="text" name="" id="job_lot_no" value="<?=$getsched->lot_no;?>" id="first_name" class="form-control" readonly >
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h4>Order No.</h4>
                      <div class="form-group">
                        <input type="text" name="" value="<?=$getsched->job_order_no;?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Date</h4>
                        <input type="text" name="" class="form-control" value="<?=$getsched->date;?>" readonly >
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Vendor Name</h4>
                        <?php 
                          $queryVendor=$this->db->query("select *from tbl_contact_m where contact_id='$getsched->vendor_id'");
                          $getVendor=$queryVendor->row();
                          ?>
                        <input type="text" name="" value="<?=$getVendor->first_name;?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <?php
                    $queryIssueMat=$this->db->query("select SUM(qty) as qty from tbl_quotation_purchase_order_dtl where purchaseid='$getsched->purchaseid'");
                    $getIssueMat=$queryIssueMat->row();
                    ?>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Status</h4>
                        <?php
                          if($getsched->status=='')
                          {
                          echo "<input type='text'  class='form-control' value='Open' readonly >";
                          }
                          if($getsched->status=='1')
                          {
                          	echo "<input type='text'  class='form-control' value='Force Close' readonly >";
                          
                          }
                          if($getsched->status=='2')
                          {
                          	echo "<input type='text'  class='form-control' value='Completed' readonly >";
                          	
                          }
                          
                          if($getsched->status=='3')
                          {
                          	echo "<input type='text'  class='form-control' value='Partial Completed' readonly >";
                          
                          }
                          ?>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>&nbsp;</h4>
                        &nbsp;
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <?php if($getsched->order_type=='Job Order') { ?>
              <li class="active"><a href="#receiveJobWork" data-toggle="tab">RM Request</a></li>
              <?php } ?>
              <li <?php if($getsched->order_type=='Purchase Oder') { ?> class="active" <?php } else { ?> class="" <?php } ?>  ><a href="#home" data-toggle="tab">GRN</a></li>
              <li><a href="#check" data-toggle="tab">Checking</a></li>
              <li><a href="#returnOrder" data-toggle="tab">Order Repair</a></li>
              <li><a href="#scrap" data-toggle="tab">Scrap</a></li>
              <?php if($getsched->order_type!='Job Order') { ?>
              <li><a href="#purchaseReturn" data-toggle="tab">Purchase Return</a></li>
              <?php } ?>
              <?php if($getsched->order_type=='Job Order') { ?>
              <li><a href="#RMReturn" data-toggle="tab">RM  Return</a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              
              <?php if($getsched->order_type=='Job Order') { ?>
              <div class="tab-pane active" id="receiveJobWork">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
                      <thead>
                        <tr>
                          <th style="width:150px;">Request No.</th>
                          <th>Date</th>
                          <th>Qty</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *from tbl_issuematrial_hdr where po_no='".$_GET['id']."'");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->request_no;?></th>
                          <th><?=$getPo->date;?></th>
                          <th>
                            <?php
                              $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                              $getQty=$poquery->row();
                              
                              
                              $poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
                              $getQtygrnLog=$poquerygrnLog->row();
                              
                              
                              ?>
                            <?php echo (round($getQty->qty,3));?>
                          </th>
                          <th>
                            <?php
                              $poqueryC=$this->db->query("select SUM(remaining_qty) as qtyC from tbl_issuematrial_dtl where status='A' and inboundrhdr='$sales->inboundid'");
                              $getQtC=$poqueryC->row();
                              
                              if($getPo->status=='2')
                              {
                              echo "Completed";
                              }
                              elseif($getPo->status=='3')
                              {
                              	echo "Partital Completed";
                              }
                              elseif($getPo->status=='1')
                              {
                              echo "Force Close";	
                              }
                              else
                              {
                              	echo "Open";
                              	}
                              ?>
                          </th>
                          <th>
                         
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button title="View RM request" class="btn btn-default" onclick="viewRawRequest(<?=$getPo->inboundid;?>);" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
                            <button title="View RM Receive Log" class="btn btn-default" onclick="viewChallanLog('<?=$getPo->inboundid;?>^<?=$getPo->po_no;?>');" data-toggle="modal" data-target="#modal-ChallanLog" type="button" ><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_rm_details?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <?php
                              $issueHdrQuery=$this->db->query("select *from tbl_issuematrial_hdr where po_no='".$_GET['id']."'");
                              $getIssueHdr=$issueHdrQuery->row();
                              
                              
                              $issueHdrValQuery=$this->db->query("select *from tbl_issuematrial_hdr where job_order_no='$getIssueHdr->job_order_no'");
                              $getIssuValeCnt=$issueHdrValQuery->num_rows();
                              
                              if($getIssuValeCnt=='0')
                              {
                              ?>
                            <button type="button" class="btn btn-default modalMapSpare1" data-toggle="modal" data-target="#modal-6"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
                            <?php }?>
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
              <?php }?>
              <div <?php if($getsched->order_type=='Purchase Oder') { ?> class="tab-pane active" <?php } else { ?> class="tab-pane" <?php } ?> id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingOrderGrnData">
                      <thead>
                        <tr>
                          <th style="display:none">Lot No.</th>
                          <th>Grn No.</th>
                          <th>Grn Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $queryData=$this->db->query("select *from tbl_production_order_log where job_order_id='".$_GET['id']."' and grn_type='Job Order' group by grn_no");
                            foreach($queryData->result() as $fetch_list)
                            {
                            
                          ?>
                        <tr class="gradeU record">
                          <td style="display:none">
                            <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
                            <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
                            <?=$fetch_list->lot_no;?>
                          </td>
                          <td><?=$fetch_list->grn_no;?></td>
                          <td><?=$fetch_list->grn_date;?></td>
                          <td>
                            <button class="btn btn-default" href="#" title="GRN VIEW" data-toggle="modal" data-target="#model-view-production-log" onclick="view_production_log('<?=$fetch_list->grn_no;?>,<?=$fetch_list->order_no;?>');"><i class="fa fa-eye"></i></button>&nbsp;
                            
                         
                      <?php
                       $poquery=$this->db->query("select *  from tbl_production_order_check where status='A' and order_no='$fetch_list->order_no'");
                         $cntData=$poquery->num_rows();
						 
                          if($cntData>0)
						              {
                          ?>
                       <button class="btn btn-default" onclick="return confirm('Please Delete Child Data First');" type="button"><i class="icon-trash"></i></button>
                          <?php }else{?>
                          <button class="btn btn-default delbuttonOrderGrn" id="<?=$fetch_list->grn_no ?>" type="button"><i class="icon-trash"></i></button>
                          <?php }?>
                         
                            <a target="_blank" href="<?=base_url();?>productionModule/print_challan_grn?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </td>
                        </tr>
                        <?php  }?>
                        <tr class="gradeU">
                          <td style="display:none">&nbsp;</td>
                          <td>
                            <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
                            <p style="display:none" id="order_type"><?=$getsched->order_type;?></p>
                            <button style="display:none1" type="button" class="btn btn-default" onclick="Order('<?=$getsched->id;?>');" data-toggle="modal" data-target="#modal-order"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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

              <div class="tab-pane" id="check">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingCheckingGrnData">
                      <thead>
                        <tr>
                          <th style="width:150px;">Check No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_production_order_check where status='A' and job_order_id='".$_GET['id']."' group by check_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->check_no;?></th>
                          <th><?=$getPo->check_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                        
                            
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
                           
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewChecking('<?=$getPo->check_no;?>');" data-toggle="modal" data-target="#modal-checking" type="button" ><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            
             
                  
                           <button class="btn btn-default delbuttonOrderCheck" id="<?=$getPo->check_no; ?>" type="button"><i class="icon-trash"></i></button>
                          
                          
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default" onclick="Order_check('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order-checking"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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
              <div class="tab-pane" id="purchaseReturn">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingCheckingGrnData">
                      <thead>
                        <tr>
                          <th style="width:150px;">Return No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_job_purchase_order_return where status='A' and job_order_id='".$_GET['id']."' group by order_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->return_no;?></th>
                          <th><?=$getPo->return_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                          
                            
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
                          
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewChecking('<?=$getPo->check_no;?>');" data-toggle="modal" data-target="#modal-checking" type="button" ><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="purchase_return('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-purchase-return"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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
              <div class="tab-pane" id="RMReturn">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingRMreturnData">
                      <thead>
                        <tr>
                          <th style="width:150px;">RM Return No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_job_rm_return where  job_order_id='".$_GET['id']."' group by return_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->return_no;?></th>
                          <th><?=$getPo->return_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                       
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
                         
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewRMOrderDetails('<?=$getPo->return_no;?>');" data-toggle="modal" data-target="#modal-checking" type="button" title="Return Log"><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_rm_return?id=<?=$getPo->return_no;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button  type="button" class="btn btn-default modalMapSpare" onclick="RM_return('<?=$getsched->id;?>');" data-toggle="modal" data-target="#modal-purchase-return"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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
              <div class="tab-pane" id="scrap">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
                      <thead>
                        <tr>
                          <th style="width:150px;">Check No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_production_order_check where status='A' and job_order_id='".$_GET['id']."' and scrap_qty!='' group by check_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->check_no;?></th>
                          <th><?=$getPo->check_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                     
                            
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
                         
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewScrap('<?=$getPo->check_no;?>');" data-toggle="modal" data-target="#modal-viewScrap" type="button" ><i class="fa fa-eye"></i></button>
                 
                 
                 
                           <button class="btn btn-default delbuttonOrderScrap" id="<?=$getPo->check_no; ?>" type="button"><i class="icon-trash"></i></button>       
                            
                            
                            
                       
                            
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->check_no;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                          <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button type="button" style="display:none" class="btn btn-default modalMapSpare1" data-toggle="modal" data-target="#modal-6"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="returnOrder">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRepair">
                      <thead>
                        <tr>
                          <th style="width:150px;">Repair No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_production_order_repair where status='A' and job_order_id='".$_GET['id']."'  group by repair_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->repair_no;?></th>
                          <th><?=$getPo->repair_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                            
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
                          
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewRepairOrder('<?=$getPo->repair_no;?>');" data-toggle="modal" data-target="#modal-view_order_repair" type="button" ><i class="fa fa-eye"></i></button>
                            
                               <button class="btn btn-default delbuttonOrderRepair" id="<?=$getPo->repair_no; ?>" type="button"><i class="icon-trash"></i></button>
                            <!-- <a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>&check_no=<?=$getPo->check_no;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a> -->
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                          <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order_repair('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order-repair"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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
              
            </div>
          </div>
          <!--tabs-container close-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--main-content close-->
<?php
  $this->load->view("footer.php");
?>

<!-- view production GRN here -->
<div id="modal-PurchaseGRN" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Purchase Order GRN(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewPurchaseOrderGRN">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- // ends -->
<!-- order module starts here-->
<div id="modal-order" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order GRN(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="Orderresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_receive" action="#" 
            onsubmit="return submitProductionOrderReceive();"method="POST">
            <div class="row" id="orderDetails">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- order repair -->
<div id="modal-order-repair" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order Repair(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="OrderRepairresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_repair" action="#" 
            onsubmit="return submitProductionOrderRepaire();"method="POST">
            <div class="row" id="orderRepair">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- Purchase Return -->
<div id="modal-purchase-return" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">RM Return(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="OrderPurchaseReturnResult" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="productionOrderRMReturn" action="#" 
            onsubmit="return SubmitmyProduction_RM_return();"method="POST">
            <div class="row" id="purchaseReturnDiv">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- checking starts here -->
<div id="modal-order-checking" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order Checking(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="OrderCheckresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_check" action="#" 
            onsubmit="return submitProductionOrderCheck();"method="POST">
            <div class="row" id="orderCheck">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- transfer -->
<div id="modal-order-transfer" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order Transfer(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="OrderRepairresultarea1" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_repair" action="#" 
            onsubmit="return submitProductionOrderRepaire();"method="POST">
            <div class="row" id="orderTransfer">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!--Production log view starts here-->
<div id="model-view-production-log" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Production Log(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="Orderresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_receive" action="#" 
            onsubmit="return submitProductionOrderReceive();"method="POST">
            <div class="row" id="view-production-log">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends-->
<!-- starts -->
<div id="modal-rawRequest" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Check Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewRequest">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- start scrap view -->
<div id="modal-viewScrap" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Check Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewScrap">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends-->
<!-- view repair order -->
<div id="modal-view_order_repair" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Repair Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewRepairOrder">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends-->
<!-- view RM Details -->
<div id="modal-checking" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View RM Details(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewCheck">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<div id="modal-ChallanLog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="issueQty__" action="insert_issue_row_material" 
      method="POST">
      <div class="modal-content" id ="viewChallanDiv">
     
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </form>
</div>
<!-- rm request starts here -->
<div id="modal-6" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> Request Raw Material(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultareaRaw" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="requestRawMat" action="#" 
        onsubmit="return submitRequestRawMat();"method="POST">
        <div class="modal-body">
          <div class="form-group">
            <div class="form-group">
              <label class="col-sm-2 control-label"> Request No.: </label> 
              <div class="col-sm-4"> 
                <input type="hidden" name="req_production_id" id="production_id" value="<?=$_GET['id'];?>" />
                <input type="hidden" name="lot_no" value="<?=$getsched->lot_no;?>" />
                <input type="hidden" name="job_order_no" value="<?=$getsched->job_order_no;?>" />
                <input name="request_no" id="request_no" type="text" value="" class="form-control" > 
              </div>
              <label class="col-sm-2 control-label"> Date: </label> 
              <div class="col-sm-4"> 
                <input name="date" type="date" id="date" value="" class="form-control" > 
              </div>
            </div>
            <?php
              ?>
            <div style="display:none">
              <div class="col-sm-4">
              
                <input type="hidden" class="form-control input-sm" value="" id="mproductname"> 
                <input type="hidden"  class="form-control" value="" id="mproductid" >
                <label class="control-label">Raw Material:</label> <br>
                <?php
                  $selectIssuematQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='".$_GET['p_id']."'");
                  
                  foreach($selectIssuematQuery->result() as $getMat){
                  $issProduct[]=$getMat->productid;
                  }
                  
                  $issueData=implode(",",$issProduct);
                  if($issueData!='')
                  {
                  $issueDataa=$issueData;
                  }
                  else
                  {
                  $issueDataa='0';
                  }
                  
                  
                  $mQuery=$this->db->query("select *from tbl_machine where code in($issueDataa)");
                  foreach($mQuery->result() as $getM){
                  $getMachine[]=$getM->machine_name;
                  }
                  
                  @$dataMac=implode(",",$getMachine);
                  if($dataMac!='')
                  {
                  $dataMacc=$dataMac;
                  }
                  else
                  {
                  $dataMacc='0';
                  }
                  
                  $contQuery=$this->db->query("select distinct(part_id) from tbl_shape_part_mapping where product_id in ($dataMacc) ");
                          foreach($contQuery->result() as $dt)
                          {
                  $partId[]=$dt->part_id;  
                  }
                  @$dataPart=implode(",",$partId);
                  
                  
                  if($dataPart!='')
                  {
                  $dataPartt=$dataPart;
                  }
                  else
                  {
                  $dataPartt='0';
                  }
                  ?>
                <select id="prodetails"  class="select2 form-control" onchange="selectListdata(this);">
                  <option value="" selected disabled> --Select-- </option>
                  <?php
                    $contQuery=$this->db->query("select distinct(rowmatial) from tbl_part_price_mapping where part_id in ($dataPartt) ");
                       foreach($contQuery->result() as $dt)
                       {
                    $productNameQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->rowmatial'");
                    $getProduct=$productNameQuery->row();
                    
                          $prodId   = $getProduct->Product_id;
                    $sku   = $getProduct->sku_no;
                          $prodName = $getProduct->productname;
                          $uom      = $getProduct->usageunit;
                       ?>
                  <option value="<?=$prodId;?>^<?=$sku;?>^<?=$uom;?>" ><?=$sku;?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label">Usage Unit:</label> 
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
                <label class="control-label">QTY:</label> 
                <input type="text" class="form-control" value="" id="mPrice" >
                <input type="hidden" name = "partid" class="form-control" value="" id="partid">
                <input type="hidden" name = "itemid" class="form-control" value="" id="itemid">
                <input type="hidden" name = "mapType" class="form-control" value="" id="mapType">
              </div>
              <div class="col-sm-1" > 
                <button  style = "margin-top: 20px;" class="btn btn-default"  type="button" onclick="addpricemap1()"><img src="<?=base_url();?>assets/images/plus.png" />
                </button>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-hover" >
          <br>
          <tbody>
            <tr class="gradeA">
              <th>Raw Material Name</th>
              <th>UOM</th>
              <th>Order QTY</th>
              <!-- <th>Cast Weight</th> -->
              <th>Total Cast Weight</th>
            </tr>
          </tbody>
          <tbody id="quotationTable1">
              <?php
            
                //$contQuery=$this->db->query("select SUM(EPrice) as RMSUM,EPrice,rowmatial,SUM(qty) as sumqty from tbl_part_price_mapping where part_id in ($dataPartt) group by rowmatial ");
              $contQuery=$this->db->query("select *,SUM(qty) as orderQty, SUM(total_weight) as ttlordrWgt from tbl_job_work_log where lot_no='$getsched->lot_no' AND job_order_no='$getsched->job_order_no' AND shape_id='$getsched->shape_id' group by rm_id ");
                foreach($contQuery->result() as $dt)
                {

                $productNameQuery=$this->db->query("select * from tbl_product_stock where Product_id='$dt->rm_id'");
                $getProduct=$productNameQuery->row();
                
                $prodId   = $getProduct->Product_id;
                $sku      = $getProduct->sku_no;
                $prodName = $getProduct->productname;
                $uom      = $getProduct->usageunit;
               
               
              $uomQuery=$this->db->query("select *from tbl_master_data where serial_number='$uom'");
              $getUOM=$uomQuery->row();

                  
            ?>
            <tr>
              <td>
                <input type="hidden" name="prodcId[]" value="<?=$prodId;?>" />
                <?=$sku;?>                
              </td>
              <td><?=$getUOM->keyvalue;?></td>
              <td><input type="hidden" name="order_qty[]" value="<?php echo $dt->orderQty;; //$ordQ;?>" />
                <?php echo  $dt->orderQty; //$ordQ; ?>
              </td>
              
              <!-- <td><?php echo (round($dt->weight,3));?></td> -->

              <input type="hidden" name="mproPrice[]" value="<?php echo round($dt->ttlordrWgt,3);?>" />
              <td><?php echo (round($dt->ttlordrWgt,3));?></td>
            </tr>
            <?php  } ?>
          </tbody>
        </table>
        <div class="modal-footer" id="button" style="display: block;">
          <input type="submit" class="btn btn-sm" value="Save">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- end-->
<script>
  function getPo(v)
  {
  var pro=v;
  
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/getPo?ID="+pro, false);
  xhttp.send();
  document.getElementById("divPo").innerHTML = xhttp.responseText;
  
  }
  
  
  function getPodtl(v)
  {
  var pro=v;
  
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/getPoDtl?ID="+pro, false);
  xhttp.send();
  document.getElementById("divPoDtl").innerHTML = xhttp.responseText;
  	
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
  		alert("Enter qty must be less than remaining qty");
  		document.getElementById("sv1").disabled = true;
  		
  		
  	}
  	else
  	{
  		document.getElementById("sv1").disabled = false;
  	}
  	
  	
  	
  }
  
  function viewrawReceiveFun(viewId){
  var po_no=document.getElementById("p_n").value;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "view_raw_receive",  
  			cache:false,  
  			data: {'id':viewId,'po_id':po_no,},  
  			success: function(data)  
  			{  
  			  
  			 $("#viewrawReceiveDiv").empty().append(data).fadeIn();
  			//referesh table
  			}   
  	});
  
   }
  
  
  //starts receive raw Material query
  
  
  function submitrawMaterialReceive() {
          
    var form_data = new FormData(document.getElementById("rawMaterialReceive"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/insert_receive_row_material",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
  	
  	
  	
  	  if(data == 1 || data == 2){
  		
                        if(data == 1)
  					    
                          var msg = "Data Successfully Add !";
                        else
                          var msg = "Data Successfully Updated !";
  						$("#resultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-rawReceive .close").click();
  					   
  					   
  					   
                         $("#resultareaRaw").text(" "); 
                         $('#requestRawMat')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#resultareaRaw").text(data);
  					
                   }
  				 ajex_requestRM(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  
  
  
  function qtyVal(d)
  {
	 
    var zz=document.getElementById(d).id;
    var myarra = zz.split("qty");
    var asx= myarra[1];
    //alert(asx);
    var entQty=document.getElementById("qty"+asx).value;	
    var remQty=document.getElementById("rem_qty"+asx).value;	
    var netWgt=document.getElementById("ideal_total_weight"+asx).value;
    var tWgt=Number(entQty) * Number(netWgt);
    if(Number(remQty)<Number(entQty))	
    {

      alert("Enter Qty should be less than remaining Qty");
    	document.getElementById("qty"+asx).focus();	
    	document.getElementById("add_req").disabled = true;
    	
    	return false;
    }
    else
    {

      document.getElementById("add_req").disabled = false;
      document.getElementById("total_weight"+asx).value=tWgt.toFixed(3);
    
    }

  }
  
  function qtyValRmReturn(d)
  {
   
    var zz=document.getElementById(d).id;
    var myarra = zz.split("order_qty");
    var asx= myarra[1];
    //alert(asx);
    var entQty=document.getElementById("order_qty"+asx).value;  
    var remQty=document.getElementById("rem_qty"+asx).value;  

    if(Number(remQty)<Number(entQty)) 
    {

      alert("Return Qty should be less than remaining Qty");
      document.getElementById("order_qty"+asx).focus(); 
      document.getElementById("add_req").disabled = true;
      
      return false;
    }
    else
    {

      document.getElementById("add_req").disabled = false;
    
    }

  }

  function wgtValRmReturn(d)
  {
   
    var zz=document.getElementById(d).id;
    var myarra = zz.split("qty");
    var asx= myarra[1];
    //alert(asx);
    var entWgt=document.getElementById("qty"+asx).value;  
    var remWgt=document.getElementById("rem_wgt"+asx).value;
  
    if(Number(remWgt)<Number(entWgt))
    {
      alert("Return weight should be less than remaining weight");
      document.getElementById("qty"+asx).focus(); 
      document.getElementById("add_req").disabled = true;
      return false;
    }
    else
    {

      document.getElementById("add_req").disabled = false;
    
    }

  }
  
  
  // start checking qty validation
  
  function checkQtyVal(d)
  {
  var zz= $(d).attr('id');
  var rowValue = $(d).attr('arrt');
  var myarra = zz.split(rowValue);
  var asx= myarra[1];
  var transfer_qty=document.getElementById("transfer_qty"+asx).value;	
  var repair_qty=document.getElementById("repair_qty"+asx).value;	
  var scrap_qty=document.getElementById("scrap_qty"+asx).value;	
  
  var remQty=document.getElementById("remQty"+asx).value;	
  var sumQty=Number(transfer_qty)+Number(repair_qty)+Number(scrap_qty);

  if(Number(remQty)<Number(sumQty))	
  {
  alert("Enter Qty should be less then remaining Qty");
  	document.getElementById(rowValue+asx).focus();	
		
  	
	document.getElementById("add_req").disabled = true;
  	
  	return false;
  }
  else
  {
  document.getElementById("add_req").disabled = false;
  
  }
  }
  
  //ends
  
  
  
</script>
<script>
  function selectListdata(ths){
    	 
    	 $("#muom").attr('disabled',false);
       $('#productListData').css('display','none');
       res = ths.value.split("^");
      
       $('#mproductname').val(res[1]);
       $('#mproductid').val(res[0]);
       // $('').val();
       $("#muom").val(res[2]);
       $("#muom").attr('disabled',true);
  
    }
  
  function addpricemap1(){
  	
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
  		
  	
  	$('#prodetails option:selected').remove();
         $('#quotationTable1').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><i class="fa fa-trash  fa-2x" mproductid="'+mproductid+'" mproductname="'+mproductname+'" id="quotationdel" aria-hidden="true"></i></td></tr>');
  
         $('#mproductname').val("");
         $('#mproductid').val("");
         $('#mPrice').val("");
  	   
         $("#muom").val("");
  	   $("#prodetails").val("");
  	   
         $("#select2-prodetails-container").text("--select--");
  	   
         
      }
    }
    
    //starts request raw Material query
  
  function submitRequestRawMat() {
            
  		 
    var form_data = new FormData(document.getElementById("requestRawMat"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/insert_issue_row_material",
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
  						$("#resultareaRaw").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
              $("#modal-6 .close").click();
   
             $("#resultareaRaw").text(" "); 
             $('#requestRawMat')[0].reset(); 

          }, 1000);
        }else{
          $("#resultareaRaw").text(data);

       }
ajex_requestRM(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  
  function ajex_RawMatData(production_id){
  
    window.location.reload();
   /* ur = "<?=base_url('productionModule/getPurchaseRawOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
  
          $("#listingPurchaseRawData").empty().append(data).fadeIn();
                
       }
      });*/
  }


function ajex_RmReturnListData(production_id){
  
    window.location.reload();
   /* ur = "<?=base_url('productionModule/getRmReturn');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
          $("#listingRMreturnData").empty().append(data).fadeIn();
                
       }
      });*/
  }  
  
  
  function ajex_Order_Grn_Data(production_id){

      window.location.reload();
  
    // ur = "<?=base_url('productionModule/getGRNOrder');?>";
    //   $.ajax({
    //     url: ur,
    //     data: { 'id' : production_id },
    //     type: "POST",
    //     success: function(data){

    //       $("#listingOrderGrnData").empty().append(data).fadeIn();
                
    //    }
    //   });
  }
  
  
  function ajex_CheckingListData(production_id){
    
    window.location.reload();

    /*ur = "<?=base_url('productionModule/getCheckingOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){

          $("#listingCheckingGrnData").empty().append(data).fadeIn();
                
       }
      });*/
  }
  
  
  function ajex_OrderRepairListData(production_id){
    
    window.location.reload();

    /*ur = "<?=base_url('productionModule/ajexRequestRepair');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){

          $("#listingAjexRepair").empty().append(data).fadeIn();
                
       }
      });*/
  }  
  
  
  
  function ajex_requestRM(production_id){
  
     window.location.reload();

    /*ur = "<?=base_url('productionModule/ajexRequestRM');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){

          $("#listingAjexRequestRM").empty().append(data).fadeIn();
                
       }
      });*/
  }
  
  
  function viewChallanLog(viewId){
  	
  var res = viewId.split("^");
  var id=res[0];
  var po_id=res[1];
  	$.ajax({   
  		type: "POST",  
  		url: "<?=base_url();?>issueMaterialproduction/inbound/view_challan_log",  
  		cache:false,  
  		data: {'id':id,'po_id':po_id},  
  		success: function(data)  
  		{  
  			$("#viewChallanDiv").empty().append(data).fadeIn();
  			//referesh table
  		}   
  	});
  }
  

// function issweightcalc(v)
// {

//     var weightVal=document.getElementById(v).id;
//     var weightData = weightVal.split("weight");
//     var asx= weightData[1];
    
//     var weight=document.getElementById("weight"+asx).value;
    

// }


  function totalWeightCal(v)
  {
    var weightVal=document.getElementById(v).id;
    var weightData = weightVal.split("weight");
    var asx= weightData[1];
    
    var qty=document.getElementById("qty"+asx).value;
    var weight=document.getElementById("weight"+asx).value;
    var total_weight=document.getElementById("total_weight"+asx).value;
    var ideal_total_weight=document.getElementById("ideal_total_weight"+asx).value;
    
    
    var totalWeight=Number(total_weight)/Number(qty);
    var tolerance_percentage=document.getElementById("tolerance_percentage"+asx).value;
    document.getElementById("weight"+asx).value=totalWeight.toFixed(3);;
    var netweightCal=document.getElementById("net_weight_cal"+asx).value;
    var netWeightToatl=Number(ideal_total_weight)*Number(qty);
    
    var fivePercentageCal=Number(netWeightToatl)*Number(tolerance_percentage)/100;
    
    var totalFivePluspercentageVal=Number(netWeightToatl)+Number(fivePercentageCal);
    
    var totalFiveMinuspercentageVal=Number(netWeightToatl)-Number(fivePercentageCal);
    
    
    
    //=================issue weight calc================
    var enrmid=document.getElementById("rmOrdId"+asx).value;
    //alert(enrmid);

    var isrmid=$("#rmIssueId"+asx).val();
    
    var count = document.getElementsByName('rmIssueId[]'); 
    var tcount = count.length;

    //alert(tcount);

    //alert(isrmid);

    var isrmwt=$("#rmIssueWgt"+asx).val();    


    if(Number(totalFivePluspercentageVal)<Number(total_weight))
    {
    
    alert("Enter Weight is greater then Net Weight");	
    document.getElementById("total_weight"+asx).focus();
    document.getElementById("add_req").disabled = true;	
    }
    else if(Number(totalFiveMinuspercentageVal)>Number(total_weight))
    {
    
    alert("Enter Weight is less then Net Weight");
    document.getElementById("total_weight"+asx).focus();
    document.getElementById("add_req").disabled = true;	
    
    }
    else if(Number(enrmid)==Number(isrmid))
    {
      if(total_weight > isrmwt)
      {
        alert("Grn weight can't be greater than issue weight!");
        document.getElementById("add_req").disabled = true;  
      }
      else
      {
        var finalWgt=Number(isrmwt)-Number(total_weight);
        document.getElementById("rmIssueWgt"+asx).value=finalWgt.toFixed(3);
        document.getElementById("add_req").disabled = false;   
      }
    }
    
    else if(Number(enrmid)!=Number(isrmid))
    {

      for(var i=1; i<=tcount; i++)
      {

        var gnrIssId=$("#rmIssueId"+i).val();
        var grnIssWt=$("#rmIssueWgt"+i).val();
        if(Number(enrmid) == Number(gnrIssId))
        {

          if(total_weight > grnIssWt)
          {
            alert("grn weight can't be greater than issue weight!");
            document.getElementById("add_req").disabled = true;  
          }
          else
          {
            var finalWgt=Number(grnIssWt)-Number(total_weight);
            document.getElementById("rmIssueWgt"+i).value=finalWgt.toFixed(3);
            document.getElementById("add_req").disabled = false;   
          }

        }        

      }

    }

    else
    {
    document.getElementById("weight"+asx).value=totalWeight.toFixed(3);
    document.getElementById("add_req").disabled = false;	
    }
  }
  
  function RateCal(d)
  {
  
  var zz=document.getElementById(d).id;
  var myarra = zz.split("rate");
  var asx= myarra[1];
  //alert(asx);
  var total_weight=document.getElementById("total_weight"+asx).value;	
  var rate=document.getElementById("rate"+asx).value;	
  
  totalRMRate=Number(total_weight)*Number(rate);
  document.getElementById("total_rm_rate"+asx).value=totalRMRate;
  document.getElementById("total_cost"+asx).value=totalRMRate;
  
  
  }
  
  function labourRateCal(d)
  {
  
  var zz=document.getElementById(d).id;
  var myarra = zz.split("labour_rate");
  var asx= myarra[1];
  //alert(asx);
  var total_weight=document.getElementById("total_weight"+asx).value;	
  var labour_rate=document.getElementById("labour_rate"+asx).value;	
  
  totalRMRate=Number(total_weight)*Number(labour_rate);
  document.getElementById("total_labour_rate"+asx).value=totalRMRate;
  
  var total_cost=document.getElementById("total_cost"+asx).value;
  
  document.getElementById("total_cost"+asx).value=Number(totalRMRate)+Number(total_cost);
  
  }
 
</script>