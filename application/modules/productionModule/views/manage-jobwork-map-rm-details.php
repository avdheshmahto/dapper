<?php
  $this->load->view("header.php");
  
  $scheQuery=$this->db->query("select *from tbl_issuematrial_hdr where inboundid='".$_GET['id']."' ");
  $getsched=$scheQuery->row();
  
  
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
  
  function Order(viewId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
   	$.ajax({   
  		    type: "POST",  
  			url: "order_details_rm",  
  			cache:false,  
  			data: {'id':viewId,'order_type':order_type,'lot_no':lot_no},  
  			success: function(data)  
  			{  
  			  
  			 $("#orderDetails").empty().append(data).fadeIn();
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
  
  
  function view_production_log(poid){
  	
  	//alert(poid);
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
  
  //******************************************************************************************************************************************************************************************************************************************************************************************************
  
  //*********************************************************************************************************************************************************************************************************************************************************************************************************
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
        <div class="panel-body___">
          <div class="row centered-form">
            <div class="col-xs-12 col-sm-12">
              <div class="panel panel-default____">
                <div class="panel-heading" style="background-color: #F5F5F5; color:#fff; border-color:#DDDDDD;">
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Oder Details:-</span><?=$getsched->inboundid;?>
                    <a href="<?=base_url();?>productionModule/manage_jobwork_map?id=<?=$getsched->production_id;?>" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
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
                        <h4>Request Date</h4>
                        <input type="text" name="" class="form-control" value="<?=$getsched->date;?>" readonly >
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Request NO.</h4>
                        <input type="text" name="" class="form-control" value="<?=$getsched->request_no;?>" readonly >
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
                        <input type="text" name="" class="form-control" value="Pending" readonly >
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
              <li class="active"><a href="#home" data-toggle="tab">RM GRN</a></li>
              <li style="display:none;" ><a href="#receiveJobWork" data-toggle="tab">RM Request</a></li>
              <li style="display:none;"><a href="#spare" data-toggle="tab">Purchase Order</a></li>
              <li style="display:none;"><a href="#PurchaseGRN" data-toggle="tab">Purchase GRN</a></li>
              <li style="display:none" class=""><a href="#four" data-toggle="tab">Request Raw Material</a></li>
              <li style="display:none" class=""><a href="#receiveRaw" data-toggle="tab">Receive Raw Material</a></li>
              <li style="display:none" class=""><a href="#work_order" data-toggle="tab">Transfer to Module</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
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
                          $queryData=$this->db->query("select *from tbl_production_order_log where job_order_id='".$_GET['id']."' and grn_type='rm_receive' group by grn_no");
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
                          <td>
                            <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
                            <p style="display:none" id="order_type"><?=$getsched->order_type;?></p>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$_GET['id'];?>');" data-toggle="modal" data-target="#modal-order"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="receiveJobWork">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingPurchaseRawData">
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
                          $poquery=$this->db->query("select *from tbl_issuematrial_hdr where status='A' and po_no='".$_GET['id']."'");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->request_no;?></th>
                          <th><?=$getPo->date;?></th>
                          <th>
                            <?php
                              $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                              $getQty=$poquery->row();
                              
                              // tbl_receive_matrial_grn_log query
                              
                              
                              //echo "select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->inboundid'";
                              
                              $poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
                              $getQtygrnLog=$poquerygrnLog->row();
                              
                              
                              ?>
                            <?=$getQty->qty;?>
                          </th>
                          <th>
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
                            <?php /*?><button class="btn btn-default" onclick="viewPurchaseOrder(<?=$getPo->purchaseid;?>);" data-toggle="modal" data-target="#modal-6" type="button" ><i class="fa fa-eye"></i></button><?php */?>
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewRawRequest(<?=$getPo->inboundid;?>);" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map?id=<?=$sales->purchaseid;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
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
                      <tfoot>
                        <!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
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
  // 	  var code= document.getElementById("code").value;
  // 	  var machine_name= document.getElementById("machine_name").value;
  // 	  var machine_des= document.getElementById("machine_des").value;
  // 	  var capacity= document.getElementById("capacity").value;
   
  // 	  if(code=='')
  // 	  {
  // 	   document.getElementById("codemsg").innerHTML = "Please Enter Code";
  // 	   return false;
  // 	  }
  // 	 var xhttp = new XMLHttpRequest();
  // 	 xhttp.open("GET", "insert_machine?code="+code+"&machine_name="+machine_name+"&machine_des="+machine_des+"&capacity="+capacity, false);
  // 	 xhttp.send();
  
  // 	 $("#modal-0 .close").click();	   
  // 	 document.getElementById("loadData").innerHTML = xhttp.responseText;
  // 	 document.getElementById("code").value='';
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
        <h4 class="modal-title">GRN(Lot No.:-<?=$getsched->lot_no;?>)</h4>
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
<div id="modal-rawRequest" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Request Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
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
                <!--<label class="control-label">Product Name:</label> 
                  <input type="text" class="form-control input-sm" value="" id="mproductname" onkeyup="getdatarowmatrial(this.value);" autocomplete="off"> 
                  <ul style="position: absolute;z-index: 999999;top: 50px; width: 179%; margin-left: -39px;" id="productListData">
                  </ul> -->
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
              <td><?php echo 10;?></td>
              <td><?php echo round($dt->RMSUM,3);?></td>
              <input type="hidden" name="mproPrice[]" value="<?php echo 10*$dt->EPrice;?>" />
              <td><?php echo round($dt->RMSUM+10,3);?></td>
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
  				 //ajex_RawMatData(<?=$_GET['id'];?>);
   
  	 
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
  
  
  
  
  /*
  window.onbeforeunload = function (e) {
  // Your logic to prepare for 'Stay on this Page' goes here 
  
      return "Please click 'Stay on this Page' and we will give you candy";
  };
  */
</script>