<?php
  $this->load->view("header.php");
  
  $obj=new my_controller();
  $CI =& get_instance();
  
  $scheQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where purchaseid='".$_GET['id']."' and status = 'A'");
  $getsched=$scheQuery->row();
  
  $dtlQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='$getsched->purchaseid'");
  foreach($dtlQuery->result() as $getDtl){
    $getDtl->productid;
    $pId[]=$getDtl->productid;
  }
  
  @$getP=implode(",",$pId);
  
  ?>
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
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Production Details:-</span><?=$getsched->inboundid;?>
                    <a href="<?=base_url();?>productionModule/manage_production" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
                  </h3>
                </div>
                <div class="panel-body" style="padding:15px 0px;">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Lot No.</h4>
                        <input type="text" name="lot_number" value="<?=$getsched->lot_no;?>" id="first_name" class="form-control" readonly >
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h4>Date</h4>
                      <div class="form-group">
                        <input type="text" name="" value="<?=$getsched->invoice_date;?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Customer Name</h4>
                        <?php
                          $queryVendor=$this->db->query("select *from tbl_contact_m where contact_id='$getsched->contactid'");
                          $getVendor=$queryVendor->row();
                          ?>
                        <input type="text" name="" class="form-control" value="<?=$getVendor->first_name;?>" readonly >
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Status</h4>
                        <?php
                          $queryIssueMat=$this->db->query("select SUM(qty) as qty from tbl_quotation_purchase_order_dtl where purchaseid='$getsched->purchaseid'");
                          $getIssueMat=$queryIssueMat->row();
                          ?>
                        <input type="text" name="" value="Pending" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <h4>Dispatch Date</h4>
                        <input type="text" name="" class="form-control" value="<?php echo $obj->explode_date($getsched->edd);?>" readonly >
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
              <li class="active"><a href="#home" data-toggle="tab">Order List</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
                      <thead>
                        <tr>
                          <th>Order Type</th>
                          <th>Order No.</th>
                          <th>Vendor Name</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $queryData=$this->db->query("select *from tbl_job_work where production_id='".$_GET['id']."'  group by job_order_no ");
                            foreach($queryData->result() as $fetch_list)
                            {
                          
                          ?>
                        <tr class="gradeU record">
                          <td>
                            <?=$fetch_list->order_type;?>
                          </td>
                          <td>
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map?id=<?=$_GET['id'];?>&&jo_no=<?=$fetch_list->job_order_no;?>"><?=$fetch_list->job_order_no;?></a>
                          </td>
                          <?php
                            $sqlQueryMachineIdview=$this->db->query("select * from tbl_contact_m where contact_id ='$fetch_list->vendor_id'  and status = 'A' ");
                            
                            $getMachineIdview=$sqlQueryMachineIdview->row();
                            
                            ?>
                          <td>
                            <?=$getMachineIdview->first_name;?>
                          </td>
                          <td><?=$fetch_list->date;?></td>
                        </tr>
                        <?php  } ?>   
                        <tr class="gradeU">
                          <td>
                            <button type="button" formid="#myform" id="formreset" class="btn btn-default" data-toggle="modal" data-target="#modal-2"><img src="<?=base_url();?>assets/images/plus.png" title="Create Order"></button>
                          </td>
                          <td>&nbsp;</td>
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
<!--Large Modal-->
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
              <label class="col-sm-2 control-label">Type:</label>
              <div class="col-sm-4">
                <select class="form-control" name="order_type"  required>
                  <option value="">--Select--</option>
                  <option value="Job Order">Job Order</option>
                  <option value="Purchase Oder">Purchase Oder</option>
                </select>
              </div>
              <input type="hidden" name="lot_number" id="lot_number" value="<?=$getsched->lot_no;?>" />
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
                <select class="form-control" name="type" id="select_id" required onchange="checkQtyVal();">
                  <option value="">--Select--</option>
                  <option value="Shape">Shape Complete</option>
                  <option value="ShapePart">Shape in Parts</option>
                </select>
              </div>
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
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" id="qtyn" style="display:none">Qty:</label>
              <div class="col-sm-4">
                <input name="shape_qty" type="number" value="" id="fillQty" onkeyup="qtyFill(this.value);" onchange="qtyFill(this.value);" class="form-control" style="display:none" >
              </div>
              <label class="col-sm-12 control-label">
                <div class="table-responsive" id="getPartView" >
                </div>
              </label>
              <div class="col-sm-12">
                <br />
                <div class="modal-header table-responsive">
                  <table class="table table-bordered table-hover" >
                    <tbody>
                      <tr class="gradeA">
                        <th>Shape Name</th>
                        <th>Part</th>
                        <th>Qty</th>
                        <th>Cast Weight</th>
                        <th>Total Weight</th>
                        <th>RM Rate Per Kg</th>
                        <th>Total RM Amount</th>
                        <th>Labour Rate Per Kg</th>
                        <th>Total Labour Amount</th>
                        <th>Total Cost</th>
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
                      <tr >
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
          <input type="submit" id="saveId" class="btn btn-sm" value="Save">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>

<!-- /.modal -->
<!--End Large Modal-->

<script type="text/javascript">
  
  function getPart(v)
  {
    var production_id=document.getElementById("lot_number").value;
  
    var select_id=document.getElementById("select_id").value;
    var ur = '<?=base_url();?>productionModule/getPart';
    $.ajax({
    type: "POST",
    url: ur,
    data: {'shape':v,'production_id':production_id,'shapeName':select_id},
    success: function(data){
      // console.log(data);
      $("#getPartView").empty().append(data).fadeIn();
  
  
    // $("#btn").prop('disabled', false);
      }
      });
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
  
  function addpricemap(){
  
    var shapeid =  $('#shape').val();
    var shapeVal     =  $("#shape option:selected").text();
    var part=$('#part').val();
    var weight=$('#weight').val();
    var total_weight=$('#total_weight').val();
    var rate=$('#rate').val();
    var total_rm_rate=$('#total_rm_rate').val();
    var labour_rate=$('#labour_rate').val();
    var total_labour_rate=$('#total_labour_rate').val();
    var total_cost=$('#total_cost').val();
  
    var PartId     = [];
    var qtyy  = [];
    var part_c  =[];
    var rm_c = [];
    var rate_c  =[];
    var weight_c  =[];
    var total_weight_c  =[];
    var total_rm_rate_c =[];
    var labour_rate_c =[];
    var total_labour_rate_c =[];
    var total_cost_c  =[];
  
  
  
    j=0;i=0;k=0;m=0;n=0;o=0;p=0;q=0;r=0;a=0;z=0;
  
    $('input[name="part[]"]').each(function(){
    PartId[i++]  = $(this).val();
    });
  
    $('input[name="qty[]"]').each(function(){
    qtyy[j++]  = $(this).val();
    });
  
    $('input[name="part_code[]"]').each(function(){
    part_c[k++]  = $(this).val();
    });
  
    $('input[name="rm_code[]"]').each(function(){
    rm_c[z++]  = $(this).val();
    });
  
    $('input[name="weight[]"]').each(function(){
    weight_c[m++]  = $(this).val();
    });
    $('input[name="total_weight[]"]').each(function(){
    total_weight_c[a++]  = $(this).val();
    });
  
    $('input[name="rate[]"]').each(function(){
    rate_c[n++]  = $(this).val();
    });
  
    $('input[name="total_rm_rate[]"]').each(function(){
    total_rm_rate_c[o++]  = $(this).val();
    });
  
    $('input[name="labour_rate[]"]').each(function(){
    labour_rate_c[p++]  = $(this).val();
    });
  
    $('input[name="total_labour_rate[]"]').each(function(){
    total_labour_rate_c[q++]  = $(this).val();
    });
  
    $('input[name="total_cost[]"]').each(function(){
    total_cost_c[r++]  = $(this).val();
    });
  
  
    var myObject  = new Object();
      // myObject.productId = $('#quotationPro').val();
    var pa=myObject.part = PartId;
    var qt=qtyy;
    var pa_co=part_c;
    var rm_id=rm_c;
    var weight_co=weight_c;
    var rate_co=rate_c;
    var total_rm_rate_co=total_rm_rate_c;
    var labour_rate_co=labour_rate_c;
    var total_labour_rate_co=total_labour_rate_c;
    var total_cost_co=total_cost_c;
  
  
    var myString = JSON.stringify(myObject);
  
     // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
        //$('#QuotationMap').val(myString);
  
  
       $('#quotationTable').append('<tr><td><input type ="hidden" name="shapeId[]" value="'+shapeid+'">'+shapeVal+'</td><td><input type ="hidden" name="part_c[]" value="'+pa_co+'"><input type ="hidden" name="rm_code[]" value="'+rm_id+'"><input type ="hidden" name="partId[]" value="'+pa+'">'+pa+'</td><td><input type ="hidden" name="qtyy[]" value="'+qt+'">'+qt+'</td><td><input type ="hidden" name="weight_qty[]" value="'+weight_co+'">'+weight_co+'</td><td><input type ="hidden" name="total_weight[]" value="'+total_weight_c+'">'+total_weight_c+'</td><td><input type ="hidden" name="rate_rs[]" value="'+rate_co+'">'+rate_co+'</td><td><input type ="hidden" name="total_rm_rate_rs[]" value="'+total_rm_rate_co+'">'+total_rm_rate_co+'</td><td><input type ="hidden" name="labour_rate_rs[]" value="'+labour_rate_co+'">'+labour_rate_co+'</td><td><input type ="hidden" name="total_labour_rate[]" value="'+total_labour_rate_co+'">'+total_labour_rate_co+'</td><td><input type ="hidden" name="total_cost[]" value="'+total_cost_co+'">'+total_cost_co+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');
  
    $("#shape").val("");
   $("#fillQty").val("");
  
    $("#getPartView").text("");
  
  
  
  
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
  document.getElementById("total_weight"+asx).value=totWeight.toFixed(3);
  
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
  
  var totalRMRate=Number(total_weight)*Number(rate);
  var t = Number(totalRMRate).toFixed(3);
  document.getElementById("total_rm_rate"+asx).value=t;
  document.getElementById("total_cost"+asx).value=t;
  
  
  }
  
  function labourRateCal(d)
  {
  
  var zz=document.getElementById(d).id;
  var myarra = zz.split("labour_rate");
  var asx= myarra[1];
  //alert(asx);
  var total_weight=document.getElementById("total_weight"+asx).value;
  var labour_rate=document.getElementById("labour_rate"+asx).value;
  
  var totalRMRate=Number(total_weight)*Number(labour_rate);
  var y = Number(totalRMRate).toFixed(3);
  document.getElementById("total_labour_rate"+asx).value=y;
  
  var total_cost=document.getElementById("total_cost"+asx).value;
  var x = Number(total_cost).toFixed(3);
  var z = Number(y)+Number(x);
  document.getElementById("total_cost"+asx).value=z.toFixed(3);
  
  }


  function checkQtyVal()
  {
  
  var shapePart=document.getElementById("select_id").value;
  if(shapePart=='Shape')
  {
  
    document.getElementById("fillQty").style.display = "block";
    document.getElementById("qtyn").style.display = "block";
  document.getElementById("shape").value = "";
  document.getElementById("fillQty").value = "";
    $('#getPartView').empty();
  
    for(i=1;i<=cntVal;i++)
    {
  
  
    document.getElementById("entQty"+i).readOnly = true;
  
  
  
    }
  
  }
  else
  {
  document.getElementById("fillQty").style.display = "none";
  document.getElementById("shape").value = "";
  document.getElementById("qtyn").style.display = "none";
  
    $('#getPartView').empty();
  
  
  for(i=1;i<=10;i++)
    {
  
    document.getElementById("entQty"+i).value = "";
  
    }
  }
  
  }

  function qtyFill(v)
  {
  
  
  var cntV=document.getElementById("cntVal").value;
  var fillQty=document.getElementById("fillQty").value;
  var remQ=[];
  for(i=1;i<=cntV;i++)
  {
  var remQty=document.getElementById("remQty"+i).value;
    remQ.push(remQty);
  
  }
  
  minVal=Math.min(...remQ);
  
  if(fillQty<minVal)
  {
  
  for(i=1;i<=cntV;i++)
  {
  var weight=document.getElementById("weight"+i).value;
  var weightTotal=Number(weight)*Number(v);
  var xyz = Number(weightTotal).toFixed(3);
  document.getElementById("total_weight"+i).value=Number(xyz).toFixed(3);
    document.getElementById("entQty"+i).value=v;
  if(v=='ShapePart')
  {
  document.getElementById("total_weight"+i).value="";
  }
  }
  }
  else
  {
  alert("Enter Qty must be less then remaining qty");
  for(i=1;i<=cntV;i++)
  {
  document.getElementById("total_weight"+i).value="";
  document.getElementById("entQty"+i).value="";
  }
  }
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