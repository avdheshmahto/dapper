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

<style type="text/css">
  .select2-container--open {
  z-index: 99999999 !important;
  }
  .select2-container {
  min-width: 256px !important;
  }
</style>


<script>
 
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
  
  
 
  
  function qtyFillPO(v)
  {
  
  var cntV=document.getElementById("cntVal").value;
  
  for(i=1;i<=cntV;i++)
  {
  
    document.getElementById("entQty"+i).value=v;
  
  
  
  }
  
  }
  
  //*******************************************************************************************************
  
  
  //starts order repair  query
  
  function submitorderTransferToModule() {
  
    var form_data = new FormData(document.getElementById("myProduction_order_transfer_to_module"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "productionModule/productionOrderTransferToModule",
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
              $("#OrderTransferToModuleresultarea").text(msg);
              setTimeout(function() {   //calls click event after a certain time
                         $("#modal-order-repair").click();
                         $("#OrderTransferToModuleresultarea").text(" ");
                         $('#myProduction_order_transfer_to_module')[0].reset();
               //$("#quotationTable").text(" ");
  
                         //$("#id").val("");
  
                      }, 1000);
                    }else{
                      $("#OrderTransferToModuleresultarea").text(data);
  
                   }
           ajex_LoadTransferData();
  
  
      console.log(data);
      //Perform ANy action after successfuly post data
  
    });
    return false;
  }
  // ends
  
</script>


<script>
  function addpricemapPoOrder(){
  
    var shapeid =  $('#shapePO').val();
    var shapeVal     =  $("#shapePO option:selected").text();
    var part=$('#part').val();
    var PartId     = [];
    var qtyy  = [];
    var part_c  =[];
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
  
  
  function Order_transfer(viewId,joId){
  
  var order_type=document.getElementById("order_type").innerHTML;
  var lot_no=document.getElementById("lot_no").innerHTML;
  
    $.ajax({
          type: "POST",
        url: "order_transfer",
        cache:false,
        data: {'id':viewId,'jo_no':joId,'order_type':order_type,'lot_no':lot_no},
        success: function(data)
        {
  
         $("#orderTransfer").empty().append(data).fadeIn();
        //referesh table
        }
    });
  
   }
  
  function viewWorkOrder(v){
  
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "productionModule/view_work_order?ID="+pro, false);
  xhttp.send();
   document.getElementById("viewWork").innerHTML = xhttp.responseText;
  }
  

  
  function ajex_LoadTransferData()
  {
  
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
        <div class="panel-body_____">
          <div class="row centered-form">
            <div class="col-xs-12 col-sm-12">
              <div class="panel panel-default____">
                <div class="panel-heading" style="background-color: #F5F5F5; color:#fff; border-color:#DDDDDD;">
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Production Details:-</span><?=$getsched->inboundid;?>
                    <a href="<?=base_url();?>productionModule/manage_jobwork_view?id=<?=$_GET['id']?>" class="btn  btn-sm pull-right" type="button"><i class="icon-left-bold"></i> back</a>
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
                        <?php
                          /*$queryType=$this->db->query("select *from tbl_facilities where id='$getsched->m_type'");
                          $getType=$queryType->row();
                          */
                          ?>
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
              <li class="active"><a href="#home" data-toggle="tab">Order</a></li>
              <li style="display:none1;"><a href="#Transfer" data-toggle="tab">Transfer</a></li>
              <li style="display:none1;"><a href="#store" data-toggle="tab">Stock</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
                      <thead>
                        <tr>
                          <th>Order Type</th>
                          <th>Shape</th>
                          <th>Order no.</th>
                          <th>Vendor Name</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $queryData=$this->db->query("select *from tbl_job_work where production_id='".$_GET['id']."' AND job_order_no='".$_GET['jo_no']."' ");
                            foreach($queryData->result() as $fetch_list)
                            {
                          
                          ?>
                        <tr class="gradeU record">
                          <td>
                            <p style="display:none" id="lot_no"><?=$fetch_list->lot_no;?></p>
                            <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
                            <?=$fetch_list->order_type;?>
                            <button style="display:none" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$fetch_list->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><?=$fetch_list->order_type;?></button>
                          </td>
                          <td>
                            <?php 
                              $shp=$this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->shape_id'");
                              $getShape=$shp->row();
                              //echo $getShape->sku_no;
                              ?>
                              <a href="<?=base_url();?>productionModule/manage_jobwork_map_details?id=<?=$fetch_list->id;?>&&p_id=<?=$_GET['id'];?>"><?=$getShape->sku_no;?></a>
                          </td>
                          <td>
                            <?=$fetch_list->job_order_no;?>
                          </td>
                          <?php
                            $sqlQueryMachineIdview=$this->db->query("select * from tbl_contact_m where contact_id ='$fetch_list->vendor_id'  and status = 'A' ");
                            
                            $getMachineIdview=$sqlQueryMachineIdview->row();
                            
                            ?>
                          <td>
                            <?=$getMachineIdview->first_name;?>
                          </td>
                          <td><?=$fetch_list->date;?></td>
                          <td>Pending</td>
                          <td>
                            <button class="btn btn-default" onclick="viewWorkOrder(<?=$fetch_list->id;?>);" data-toggle="modal" data-target="#modal-3" type="button" ><i class="fa fa-eye"></i></button>
                            <?php
                              $pri_coll   = 'job_order_no';
                              $table_namee = 'tbl_work_order';
                              
                              $poquery=$this->db->query("select *from tbl_issuematrial_hdr where job_order_no='$fetch_list->job_order_no'");
                              $cntData=$poquery->num_rows();
                                           if($cntData>0){
                              
                              
                                           ?>
                            <button class="btn btn-default" onclick="return confirm('Please Delete Child Data First');" type="button"><i class="icon-trash"></i></button>
                            <?php
                              }
                              else{
                              ?>
                            <button class="btn btn-default delbuttonOrder" id="<?=$fetch_list->job_order_no ?>" type="button"><i class="icon-trash"></i></button>
                            <?php }?>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>
                          </td>
                        </tr>
                        <?php  }?>
                        
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
              <!-- starts-->
              <div class="tab-pane" id="Transfer">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
                      <thead>
                        <tr>
                          <th style="width:150px;">Transfer No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and lot_no='$getsched->lot_no' and module_name='Kora'  group by transfer_no desc");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->transfer_no;?></th>
                          <th><?=$getPo->transfer_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                            // tbl_receive_matrial_grn_log query
                            
                            
                            //echo "select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->inboundid'";
                            
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
                            <button class="btn btn-default" onclick="viewTransferOrder('<?=$getPo->transfer_no;?>');" data-toggle="modal" data-target="#modal-view-transfer" type="button" ><i class="fa fa-eye"></i></button>
                            <!-- <a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a> -->
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default" onclick="Order_transfer('<?=$_GET['id'];?>','<?=$_GET['jo_no'];?>');" data-toggle="modal" data-target="#modal-order-transfer"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- ends -->
              <div class="tab-pane" id="store">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingAjexRequestRM">
                      <thead>
                        <tr>
                          <th>
                            <div style="width:100px;">Product Code </div>
                          </th>
                          <th>
                            <div style="width:100px;">Product Type</div>
                          </th>
                          <th>
                            <div style="width:100px;">Category</div>
                          </th>
                          <th>
                            <div style="width:100px;">Product Name</div>
                          </th>
                          <th>
                            <div style="width:100px;">Usages Unit</div>
                          </th>
                          <th>
                            <div style="width:120px;">Total Stock</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $joStock=$this->db->query("select * from tbl_issuematrial_hdr where job_order_no='".$_GET['jo_no']."' and lot_no='$getsched->lot_no' ");
                          foreach($joStock->result() as $getJoStock){
                            $inbnd_id[]=$getJoStock->inboundid;
                          }

                          if($inbnd_id != '')
                          {
                            $inbndId=implode(',', $inbnd_id);
                          }
                          else
                          {
                            $inbndId='9999999';
                          }


                          $joStockDtl=$this->db->query("select *,SUM(rem_order_qty) as issueQty, SUM(remaining_qty) as issueWeight from tbl_issuematrial_dtl where inboundrhdr in ($inbndId) group by productid");

                          foreach($joStockDtl->result() as $getJoStockDtl){
                            ####### get product #######
                            $poquery=$this->db->query("select * from tbl_product_stock where status='A' and Product_id='$getJoStockDtl->productid' ");
                            $getPo=$poquery->row();
                              $productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getPo->productid'");
                              $getProductStock=$productStockQuery->row();
                              ####### ends ########
                          
                          
                              $productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getPo->usageunit'");
                              $getProductUOM=$productUOMQuery->row();
                              ####### ends ########
                          
                          ?>
                        <tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
                          <?php
                            $queryType=$this->db->query("select *from tbl_master_data where serial_number='$getPo->type'");
                            $getType=$queryType->row();
                            ?>
                          <th><?=$getPo->sku_no;?></th>
                          <th><?=$getType->keyvalue;?></th>
                          <th>
                            <?php
                              $compQuery = $this ->db
                                   -> select('*')
                                   -> where('id',$getPo->category)
                                   -> get('tbl_category');
                                  $compRow = $compQuery->row();
                              echo $compRow->name;
                              ?>
                          </th>
                          <th><?=$getPo->productname;?></th>
                          <th><?php
                            $compQuery1 = $this -> db
                                   -> select('*')
                                   -> where('serial_number',$fetch_list->usageunit)
                                   -> get('tbl_master_data');
                                  $keyvalue1 = $compQuery1->row();
                            echo $getProductUOM->keyvalue;
                            ?></th>
                          <?php                            
                              $totalStockQty=round($getJoStockDtl->issueQty,3);
                              $totalStockWgt=round($getJoStockDtl->issueWeight,3);
                            ?>
                          <th><?=$totalStockQty."/".$totalStockWgt;?></th>
                        </tr>
                        <?php } ?>
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

<!-- transfer -->
<div id="modal-order-transfer" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order Transfer(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="OrderTransferToModuleresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_order_transfer_to_module" action="#"
            onsubmit="return submitorderTransferToModule();"method="POST">
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
<!-- // transfer starts -->
<div id="modal-4" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Transfer </h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="WorkTransfer">
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- view production raw request here -->
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
<!-- // ends -->
<!-- view view transfer order here -->
<div id="modal-view-transfer" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Transfer Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewTransferDiv">
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
<div id="modal-4" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Transfer(Lot No.:-<?=$getsched->lot_no;?>) </h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="WorkTransfer"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ends -->
<!-- order module starts here-->
<div id="modal-order" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
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
<!-- ends -->
<!-- raw material receive starts here -->
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
                <input name="request_no" type="text" value="" class="form-control" >
              </div>
              <label class="col-sm-2 control-label"> Date: </label>
              <div class="col-sm-4">
                <input name="date" type="date" value="" class="form-control" >
              </div>
            </div>
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
                
                
                $mQuery=$this->db->query("select *from tbl_machine where machine_name in($issueDataa)");
                foreach($mQuery->result() as $getM){
                $getMachine[]=$getM->code;
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
        <table class="table table-bordered table-hover" >
          <br>
          <tbody>
            <tr class="gradeA">
              <th>Raw Material Name</th>
              <th>UOM</th>
              <th>QTY</th>
              <th>Action</th>
            </tr>
          </tbody>
          <tbody id="quotationTable1">
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
<!-- ends -->
<!-- ends-->
<!-- raw material request ends here -->
<!-- purchase order model starts here -->
<div id="modal-5" class="modal fade" tabindex="-1" role="dialog">
  <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#"
    onsubmit="return submitProductionPurchase();"method="POST">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Purchase Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
          <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group">
              <label class="col-sm-2 control-label">Purchase Order No.:</label>
              <div class="col-sm-4">
                <input name="job_order_no" type="text" value="" class="form-control" id="thickness">
              </div>
              &nbsp;
              <div class="col-sm-4">
                &nbsp;
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="production_id" id="production_id" value="<?=$_GET['id'];?>" />
              <label class="col-sm-2 control-label">Vendor:</label>
              <div class="col-sm-4">
                <select class="form-control" name="vendor_id" required>
                  <option value="">--Select--</option>
                  <?php
                    $queryProductShape=$this->db->query("select *from tbl_contact_m where group_name='5' and vendor_type='Production' ");
                    foreach($queryProductShape->result() as $getProductShape){
                    
                    ?>
                  <option value="<?=$getProductShape->contact_id;?>"><?=$getProductShape->first_name;?></option>
                  <?php }?>
                </select>
              </div>
              <label class="col-sm-2 control-label">Date:</label>
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
                <input name="shape_qty" type="text" value="" id="fillQtyPO" onchange="qtyFillPO(this.value);" class="form-control" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Shape:</label>
              <div class="col-sm-4">
                <select class="form-control" name="shape" id="shapePO" onchange="getPartPo(this.value);">
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
                <div class="table-responsive" id="getPartPoView">
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
                    <tbody id="quotationTablePO">
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
<!-- purchase order model close here -- >
  <!-- purchase grn starts here -->
<div id="modal-GRN" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> GRN Purchase Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="PoGRNresultarea" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase_grn" action="#"
        onsubmit="return submitProductionPurchaseGrn();"method="POST">
        <div class="modal-body">
          <div class="form-group">
            <div class="form-group">
              <label class="col-sm-2 control-label"> *Vendor Name: </label>
              <div class="col-sm-4">
                <input type="hidden" name="GRNproduction_id" id="production_id" value="<?=$_GET['id'];?>" />
                <select name="vendor_id" class="form-control" onchange="getPo(this.value);" >
                  <option value="">----Select Vendor----</option>
                  <?php
                    $vendorQuery=$this->db->query("select *from tbl_contact_m where group_name='5'");
                    foreach($vendorQuery->result() as $getVendor){
                    ?>
                  <option value="<?=$getVendor->contact_id;?>"><?=$getVendor->first_name;?></option>
                  <?php }?>
                </select>
              </div>
              <label class="col-sm-2 control-label"> Po Number: </label>
              <div class="col-sm-4">
                <select name="po_no" class="form-control" id="divPo" onchange="getPodtl(this.value)">
                  <option value="">--Select--</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-hover" id="" >
          <br>
          <tbody>
            <tr>
              <th class="tdcenter"> Sl No.</th>
              <th class="tdcenter">Item Number & Description</th>
              <th class="tdcenter">UOM</th>
              <th class="tdcenter">Ordered Qty</th>
              <th class="tdcenter">Remaining Qty</th>
              <th class="tdcenter">Enter Qty</th>
            </tr>
          </tbody>
          <tbody id="divPoDtl" >
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
<!-- ends here -->
<!-- starts -->
<div id="modal-6" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Purchase Order</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <div class="row" id="viewPurchaseOrder"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- // ends -->
<div id="modal-rawReceive" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Receive Raw Material Order(Lot No.:-<?=$getsched->lot_no;?>)</h4>
        <div id="viewrawReceive" class="text-center " style="font-size: 15px;color: red;"></div>
        <div class="modal-body">
          <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="rawMaterialReceive" action="#"
            onsubmit="return submitrawMaterialReceive();" method="POST">
            <div class="row" id="viewrawReceiveDiv"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
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