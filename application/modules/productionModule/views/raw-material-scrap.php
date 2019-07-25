<?php
  $this->load->view("header.php");
  $scheQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='".$_GET['id']."' and status = 'A'");
  $getsched=$scheQuery->row();
  
  $dtlQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='$getsched->purchaseid'");
  foreach($dtlQuery->result() as $getDtl){
  $getDtl->productid;
  	$pId[]=$getDtl->productid;
  }
  
  @$getP=implode(",",$pId);
  
  ?>
<style type="text/css">
  .select2-container--open {
  z-index: 99999999 !important;
  }
  .select2-container {
  min-width: 256px !important;
  }
</style>

<!-- Main content -->
<div class="main-content">
  <div class="panel-body panel panel-default">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body_____">
          <div class="row centered-form">
            <div class="col-xs-12 col-sm-12">
              <div class="panel panel-default____">
                <div class="panel-heading" style="background-color: #F5F5F5; color:#fff; border-color:#DDDDDD;">
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Raw Material Order : -</span><?=$getsched->inboundid;?>
                  </h3>
                </div>
                <form method="get">
                  <div class="panel-body" style="padding:15px 0px;">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <h4>Vendor Name</h4>
                          <select name="vendor_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                              $vendor_query=$this->db->query("select *from tbl_contact_m where group_name='5'");
                              foreach($vendor_query->result() as $getVendor){
                              ?>
                            <option value="<?=$getVendor->contact_id;?>"><?=$getVendor->first_name;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <h4>Search</h4>
                        <div class="form-group">
                          <input type="submit" name="Search" value="Search" class="btn btn-sm">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Order</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
                      <thead>
                        <tr>
                          <th class="tdcenter"> Sl No</th>
                          <th class="tdcenter">Item Number</th>
                          <th class="tdcenter">Description</th>
                          <th class="tdcenter">Usage Unit</th>
                          <th class="tdcenter">Net Weight</th>
                          <th class="tdcenter">Cast Weight</th>
                          <th class="tdcenter">Total Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          @extract($_GET);
                          if($Search!='')
                          {
                
                					  $qry = "select *from tbl_product_stock where type='13'";
                						$queryData=$this->db->query($qry); 

                          	$i=1;		 
                            foreach($queryData->result() as $fetch_list)
                            {
                          	  $unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->usageunit'");
                          	  $getUnit=$unitQuery->row();
                           
                          
                          ?>
                        <tr class="gradeX odd" role="row">
                          <td class="size-60 text-center sorting_1"><?=$i;?></td>
                          <td><a href="productionModule/manage_scrap_job_work?scrap_id=<?=$fetch_list->Product_id;?>&vendor_id=<?=$_GET['vendor_id'];?>"><?=$fetch_list->sku_no;?></a>
                          <td><?=$fetch_list->productname;?>
                            <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                          </td>
                          <td><?=$getUnit->keyvalue;?></td>
                          <?php
                            $netWeightQuery=$this->db->query("select *from tbl_issuematrial_dtl where productid='$fetch_list->Product_id'");
                            $getNetWeight=$netWeightQuery->row();
                            
                            ?>
                          <td><?=$getNetWeight->receive_qty;?></td>
                          <td><?=$getNetWeight->receive_qty;?>                                            </td>
                          <td><?=$getNetWeight->order_qty;?></td>
                        </tr>
                        <?php 
                          $i++;
                          
                          }}
                          ?>
                      </tbody>                      
                    </table>
                  </div>
                </div>
              </div>
              <!-- starts-->
              <!-- ends -->
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



<!-- view production Starts here -->
<div id="modal-3" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Job Order Issue(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div class="modal-body">
        <div class="row" id="viewWork">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
<!-- // ends -->
<!-- // transfer starts -->
<!-- // ends -->
<script>
  //starts production purchase query
  
  
  function submitProductionPurchase() {
              
    var form_data = new FormData(document.getElementById("myProduction_purchase"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/insert_po_production_order",
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
  						$("#Poresultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-5 .close").click();
                         $("#Poresultarea").text(" "); 
                         //$('#myform')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#Poresultarea").text(data);
  					
                   }
  				 ajex_PurchaseListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
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
  						$("#resultarea").text(msg);
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
  				 ajex_RawMatData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  //starts production purchase Grn  query
  
  function submitProductionPurchaseGrn() {
              
    var form_data = new FormData(document.getElementById("myProduction_purchase_grn"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productPoGrn",
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
  						$("#PoGRNresultarea").text(msg);
  						setTimeout(function() {   //calls click event after a certain time
                         $("#modal-GRN").click();
                         $("#PoGRNresultarea").text(" "); 
                         $('#modal-GRN')[0].reset(); 
  					   //$("#quotationTable").text(" "); 
  					   
                         //$("#id").val("");
       
                      }, 1000);
                    }else{
                      $("#PoGRNresultarea").text(data);
  					
                   }
  				 ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  function ajex_PurchaseListData(production_id){
  
    ur = "<?=base_url('productionModule/getPurchaseOrder');?>";
      $.ajax({
        url: ur,
        data: { 'id' : production_id },
        type: "POST",
        success: function(data){
         // alert(data);
          //alert("jkhkjh"+type);
          //$("#listingData").hide();
          $("#listingPurchaseData").empty().append(data).fadeIn();
                
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
  
  function transferModule(v){
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/transfer_work_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("WorkTransfer").innerHTML = xhttp.responseText;
  }
  
  
  function viewPurchaseOrder(v){
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_purchase_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewPurchaseOrder").innerHTML = xhttp.responseText;
  }
  
  
  function viewPurchaseOrderGRN(v){
  	
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_inbound?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewPurchaseOrderGRN").innerHTML = xhttp.responseText;
  }
  
  function viewRawRequest(v){
  	
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_request_raw?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewRequest").innerHTML = xhttp.responseText;
  }
  
  
  
  function viewTransferOrder(v){
  	
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_transfer_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewTransferDiv").innerHTML = xhttp.responseText;
  }
  
  
  
  function val(d)
  {
  var zz=document.getElementById(d).id;
  var myarra = zz.split("entQty");
  var asx= myarra[1];
  //alert(asx);
  var entQty=document.getElementById("entQty"+asx).value;	
  var orderQty=document.getElementById("orderQty"+asx).value;	
  var remQty=document.getElementById("remQty"+asx).value;	
  var weightQty=document.getElementById("weight"+asx).value;
  var totWeight=Number(entQty)*Number(weightQty);
  document.getElementById("total_weight"+asx).value=totWeight;
  	
  if(Number(remQty)<Number(entQty))	
  {
  alert("Enter Qty should be less then remaining Qty");
  	document.getElementById("entQty"+asx).focus();	
  	document.getElementById("add").disabled = true;
  	
  	return false;
  }
  else
  {
  document.getElementById("add").disabled = false;
  	
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
  
  function addpricemapPo(){
  
     var mproductname =  $('#purmproductname').val();
     var mproductid   =  $('#purmproductid').val();
     var price        =  $('#purmPrice').val();
     var muom         =  $('#Umuom').val();
     var muomval      =  $("#Umuom option:selected").text();
  
  
     $('#resultarea').text("");
  
      if(mproductid == "" || price == ""){
  		
        if(mproductid == "")
          var msg = 'Please Enter Right Product Name';
  	     else
  		 var msg = 'Please Enter  Product Price';
  		 //$('#resultarea').text(msg);
  
      }else{
  		
  
  	$('#purprodetails option:selected').remove();
         $('#quotationTable12').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><i class="fa fa-trash  fa-2x" mproductid="'+mproductid+'" mproductname="'+mproductname+'" id="quotationdel2" aria-hidden="true"></i></td></tr>');
  
         $('#mproductname').val("");
         $('#mproductid').val("");
         $('#mPrice').val("");
  	   
         $("#muom").val("");
  	   $("#prodetails").val("");
  	   
       //  $("#select2-prodetails-container").text("--select--");
  	   
         
      }
    }
  
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
  
  
  function selectListdataPurchase(ths){
  
    	 
    	 $("#Umuom").attr('disabled',false);
       $('#productListData').css('display','none');
       res = ths.value.split("^");
      
       $('#purmproductname').val(res[1]);
       $('#purmproductid').val(res[0]);
       // $('').val();
       $("#Umuom").val(res[2]);
       $("#Umuom").attr('disabled',true);
  
    }
  
  
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
  				 ajex_RawMatData(<?=$_GET['id'];?>);
   
  	 
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
  				 //ajex_PurchaseGRNListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  function view_production_log(poid){
  	
  	
      $.ajax({   
  	    type: "POST",  
  		url: "view_production_log_cont",  
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
  
  
</script>