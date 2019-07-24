<?php
  $this->load->view("header.php");
  
  $scheQuery=$this->db->query("select *from tbl_job_work where id='".$_GET['id']."' ");
  $getsched=$scheQuery->row();
  
  
  $input = $getsched->qty;
  $res = explode(',',$input);
  $sumRm= array_sum($res);
  
  
  
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
  						$("#Orderresultarea").text(msg);
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
  				// ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
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
        url: "<?=base_url();?>productionModule/productionOrderCheck",
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
  				// ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
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
        url: "<?=base_url();?>productionModule/productionOrderInsert",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
  	alert(data);
  	
  	
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
  				 ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  
  function Order_check(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "order_check",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderCheck").empty().append(data).fadeIn();
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
  xhttp.open("GET", "<?=base_url();?>productionModule/view_check_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewCheck").innerHTML = xhttp.responseText;
  }
  
  
  
  function view_production_log(poid){
  	
  	//alert(poid);
      $.ajax({   
  	    type: "POST",  
  		url: "<?=base_url();?>productionModule/view_production_log_cont",  
  		cache:false,  
  		data: {'id':poid},  
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
  
  //*********************************************************************************************************************************
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
  	
  	 // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
        //$('#QuotationMap').val(myString);
  	  
  	  
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
  	
  	 // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
        //$('#QuotationMap').val(myString);
  	  
  	  
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
  
    ur = "<?=base_url('productionModule/getWorkOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
          //alert(data);
          //alert("jkhkjh"+type);
          //$("#listingData").hide();
          $("#listingData").empty().append(data).fadeIn();
                
       }
      });
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
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Oder Details:-</span><?=$getsched->inboundid;?>
                    <a href="<?=base_url();?>kora/manage_kora_map?id=<?=$getsched->production_id;?>" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
                  </h3>
                </div>
                <div class="panel-body" style="padding:15px 0px;">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Lot No.</h4>
                        <input type="text" name="" value="<?=$getsched->lot_no;?>" id="first_name" class="form-control" readonly >
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
                          if($getsched->status=='0')
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
              <li style="display:none;"  ><a href="#receiveJobWork" data-toggle="tab">RM Request</a></li>
              <li ><a href="#home" data-toggle="tab" class="active">GRN</a></li>
              <li ><a href="#check" data-toggle="tab">Checking</a></li>
              <li style="display:none1;"><a href="#returnOrder" data-toggle="tab">Order Repair</a></li>
              <li style="display:none1;"><a href="#scrap" data-toggle="tab">Scrap</a></li>
              <li style="display:none" class=""><a href="#four" data-toggle="tab">Request Raw Material</a></li>
              <li style="display:none" class=""><a href="#receiveRaw" data-toggle="tab">Receive Raw Material</a></li>
              <li style="display:none" class=""><a href="#work_order" data-toggle="tab">Transfer to Module</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane " id="receiveJobWork">
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
                          $poquery=$this->db->query("select *from tbl_issuematrial_hdr where status!='A' and po_no='".$_GET['id']."'");
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
                            <?=$getQty->qty;?>
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
                            <button class="btn btn-default" onclick="viewRawRequest(<?=$getPo->inboundid;?>);" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map_rm_details?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button type="button" class="btn btn-default modalMapSpare1" data-toggle="modal" data-target="#modal-6"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
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
              <div class="tab-pane active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingPurchaseGRNData">
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
                          $queryData=$this->db->query("select *from tbl_production_order_log where job_order_id='".$_GET['id']."' and grn_type='Kora Order' group by grn_no");
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
                          <td><?php $pri_col='id';
                            $table_name='tbl_schedule_triggering';
                            ?>
                            <a href="#" title="GRN VIEW" data-toggle="modal" data-target="#model-view-production-log" onclick="view_production_log('<?=$fetch_list->grn_no;?>');"><i class="fa fa-eye"></i></a>&nbsp;
                            <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </td>
                        </tr>
                        <?php  }?>
                        <tr class="gradeU">
                          <td style="display:none">&nbsp;</td>
                          <td>
                            <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
                            <p style="display:none" id="order_type"><?=$getsched->order_type;?></p>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                      
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="check">
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
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order_check('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order-checking"><img src="<?=base_url();?>assets/images/plus.png" /></button>
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
                            <button class="btn btn-default" onclick="viewRawRequest('<?=$getPo->check_no;?>');" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
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
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
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
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>&check_no=<?=$getPo->check_no;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
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
        <div id="OrderRepairresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
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
<!-- view checking -->
<div id="modal-checking" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Check Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
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
                  $selectIssuematQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='".$_GET['id']."'");
                  
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
              <th>Cast Weight</th>
              <th>Total Cast Weight</th>
            </tr>
          </tbody>
          <tbody id="quotationTable1">
            <?php
              $contQuery=$this->db->query("select SUM(EPrice) as RMSUM,EPrice,rowmatial from tbl_part_price_mapping where part_id in ($dataPartt) group by rowmatial ");
                 foreach($contQuery->result() as $dt)
                 {
              $productNameQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->rowmatial'");
              $getProduct=$productNameQuery->row();
              
                    $prodId   = $getProduct->Product_id;
              $sku   = $getProduct->sku_no;
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
              <td><?php echo $sumRm;?></td>
              <td><?php echo round($dt->RMSUM,3);?></td>
              <input type="hidden" name="mproPrice[]" value="<?php echo round($dt->RMSUM+$sumRm,3);?>" />
              <td><?php echo round($dt->RMSUM+$sumRm,3);?></td>
            </tr>
            <?php }?>
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
<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
  <form name="myForm" class="form-horizontal" id ="myform" action="#" 
    onsubmit="return submitForm();"method="POST" enctype="multipart/form-datam">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
          <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group">
              <label class="col-sm-2 control-label">Process:</label> 
              <div class="col-sm-4">
                <select name="process" class="form-control">
                  <option value="">--Select--</option>
                  <?php 
                    $processQuery=$this->db->query("select *from tbl_master_data where param_id='20'");
                    foreach($processQuery->result() as $getProcess){
                    ?>
                  <option value="<?=$getProcess->serial_number;?>"><?=$getProcess->keyvalue;?></option>
                  <?php }?>
                </select>
              </div>
              <input type="hidden" name="lot_number" value="<?=$getsched->lot_no;?>" />
              <label class="col-sm-2 control-label">Order No.:</label> 
              <div class="col-sm-4"> 
                <input name="job_order_no" type="text" value="" class="form-control" id="thickness">
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="production_id" id="production_id" value="<?=$_GET['id'];?>" />
              <label class="col-sm-2 control-label">Vendor:</label> 
              <div class="col-sm-4">
                <select class="form-control" name="vendor_id" required>
                  <option value="">--Select--</option>
                  <?php
                    $queryProductShape=$this->db->query("select *from tbl_contact_m where group_name='5'");
                    foreach($queryProductShape->result() as $getProductShape){
                    
                    ?>
                  <option value="<?=$getProductShape->contact_id;?>"><?=$getProductShape->first_name;?></option>
                  <?php }?>
                </select>
              </div>
              <label class="col-sm-2 control-label">date:</label> 
              <div class="col-sm-4"> 
                <input name="date" type="date" value="" class="form-control" id="thickness"> 
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="production_id" id="production_id" value="<?=$_GET['id'];?>" />
              <label class="col-sm-2 control-label">Select:</label> 
              <div class="col-sm-4">
                <select class="form-control" name="type" id="select_id" required>
                  <option value="">--Select--</option>
                  <option value="Shape">Shape Complete</option>
                  <option value="ShapePart">Shape in Parts</option>
                </select>
              </div>
              <label class="col-sm-2 control-label">Qty:</label> 
              <div class="col-sm-4"> 
                <input name="shape_qty" type="text" value="" id="fillQty" onchange="qtyFill(this.value);" class="form-control" > 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Shape:</label> 
              <div class="col-sm-4">
                <select class="form-control" name="shape" id="shape" onchange="getPart(this.value);">
                  <option value="">--Select--</option>
                  <?php
                    $queryProductShape=$this->db->query("select distinct(machine_name) from tbl_machine where code in($getP)");
                    foreach($queryProductShape->result() as $getProductShape){
                    $queryProduct=$this->db->query("select *from tbl_product_stock where Product_id='$getProductShape->machine_name'");
                    $getProduct=$queryProduct->row();
                    
                    ?>
                  <option value="<?=$getProduct->Product_id;?>"><?=$getProduct->sku_no;?></option>
                  <?php }?>
                </select>
              </div>
              <label class="col-sm-6 control-label">
                <div class="table-responsive" id="getPartView">
                </div>
              </label>
              <div class="col-sm-12">
                <br />
                <div class="modal-header">
                  <table class="table table-bordered table-hover" >
                    <tbody>
                      <tr class="gradeA">
                        <th>Shape Name</th>
                        <th>Part</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                    </tbody>
                    <tbody id="quotationTable">
                      <?php if($result != ""){
                        foreach ($result as  $dt) {
                           $query11    = $this->db->query("select * from tbl_product_stock where Product_id = '".$dt['rowmatial']."'");
                           $rowmatrial = $query11->row(); 
                        
                           $uom        = $this->db->query("select * from tbl_master_data where serial_number = '".$dt['unit']."'");
                           $rowmatrialuom = $uom->row();
                        ?>
                      <tr>
                        <td><input type ="hidden" name="prodcId[]" value="<?=$dt['rowmatial'];?>"><?=$rowmatrial->productname;?></td>
                        <td><input type ="hidden" name="mproPrice[]" value="<?=$dt['qty'];?>"><?=$dt['qty'];?></td>
                        <td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td>
                      </tr>
                      <?php  }
                        } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-sm" value="Save">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
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
  		alert("Enter Qty must be less then enter qty");
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
  
  if(Number(remQty)<Number(entQty))	
  {
  alert("Enter Qty should be less then remaining Qty");
  	document.getElementById("qty"+asx).focus();	
  	document.getElementById("add_req").disabled = true;
  	
  	return false;
  }
  else
  {
  document.getElementById("add_req").disabled = false;
  	
  }
  }
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
  
  
  
  function ajex_RawMatData(production_id){
  
    ur = "<?=base_url('productionModule/getPurchaseRawOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
         // alert(data);
          //alert("jkhkjh"+type);
          //$("#listingData").hide();
          $("#listingPurchaseRawData").empty().append(data).fadeIn();
                
       }
      });
  }
  
  
  function ajex_PurchaseGRNListData(production_id){
  
    ur = "<?=base_url('productionModule/getPurchaseGRNOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
         // alert(data);
          //alert("jkhkjh"+type);
          //$("#listingData").hide();
          $("#listingPurchaseGRNData").empty().append(data).fadeIn();
                
       }
      });
  }
  
  
  function ajex_requestRM(production_id){
  
    ur = "<?=base_url('productionModule/ajexRequestRM');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
         // alert(data);
          //alert("jkhkjh"+type);
          //$("#listingData").hide();
          $("#listingAjexRequestRM").empty().append(data).fadeIn();
                
       }
      });
  }
  
  

</script>