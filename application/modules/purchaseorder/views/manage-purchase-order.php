<?php
  $this->load->view("header.php");  
  require_once(APPPATH.'core/my_controller.php');
  $obj=new my_controller();
  $CI =& get_instance();
  $tableName='tbl_sales_order_hdr';
  
  $entries = "";
  if($this->input->get('entries')!="")
  {
    $entries = $this->input->get('entries');
  }
  
  
  ?>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id ="inboundData">
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Main content -->
<div class="main-content">
  <div class="panel panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">RM Planning</a></li>
      <li class="active"><strong>Manage RM Planning</strong></li>
      <div class="pull-right">
        <a class="btn btn-sm" href="<?=base_url();?>purchaseorder/add_purchase_order"><i class="fa fa-plus"></i>Add RM Planning</a>
      </div>
    </ol>
    <?php
      if($this->session->flashdata('flash_msg')!='')
      {
      ?>
    <div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
    </div>
    <?php }?>
    <div class="row">
      <div class="col-sm-12">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="html5buttons">
            <div class="dt-buttons">
              <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 15px 15px 0px 0px;">Excel</button>
              <a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
            </div>
          </div>
          <div class="dataTables_length" id="DataTables_Table_0_length"  style="margin: 15px 0px -30px 15px;">
            <label>
              Show
              <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('/purchaseorder/manage_purchase_order').'?purchaseid='.$_GET['purchaseid'].'&date='.$_GET['date'].'&cust_name='.$_GET['cust_name'].'&grand_total='.$_GET['grand_total'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
              </select>
              entries
            </label>
            <br />
            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
              Showing <?=$dataConfig['page']+1;?> to 
              <?php
                $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                ?> of <?php echo $dataConfig['total'];?> entries
            </div>
          </div>
          <div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
            <label>Search:
            <input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
            </label>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body">
          <div class="table-responsive__">
            <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData">
              <thead>
                <tr>
                  <th style="display:none"><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                  <th>RM Planning No.</th>
                  <th style="display:none">Invoice Type</th>
                  <th>Date</th>
                  <th>Vendor Name</th>
                  <th style="display:none">Due Date</th>
                  <th style="display:none">Status</th>
                  <th style="display:none">Grand Total</th>
                  <th>Status</th>
                  <!-- <th>Reason</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="getDataTable">
                <form method="get">
                  <tr>
                    <td><input name="purchase_no"  type="text"  class="search_box form-control input-sm" style="width:100px;"  value="" /></td>
                    <td><input name="date"  type="date"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="cust_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td style="display:none">&nbsp;</td>
                    <td style="display:none">&nbsp;</td>
                    <td style="display:none"><input name="grand_total"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="force_close_status"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <!-- <td><input name="reason"  type="text"  class="search_box form-control input-sm"  value="" /></td> -->
                    <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                  </tr>
                </form>
                <?php
                  $i=1;
                  foreach($result as $sales)
                  {
                  ?>
                <tr class="gradeC record">
                  <th style="display:none;"><input type="checkbox" /></th>
                  <th><a href="<?=base_url();?>purchaseorder/view_rm_planning?vid=<?=$sales->vendor_id?>&pid=<?=$sales->purchaseid;?>" ><?=$sales->purchase_no;?></a></th>
                  <th style="display:none"><?php echo $sales->invoice_status;?></th>
                  <th><?=$sales->invoice_date;?></th>
                  <th><?php 
                    $sqlgroup=$this->db->query("select * from tbl_contact_m where contact_id='$sales->vendor_id'");
                    $res1 = $sqlgroup->row();
                    echo $res1->first_name;?></th>
                  <th style="display:none">
                    <?php 
                      $idt=$sales->invoice_date;
                      $date = new DateTime("$idt");
                      $fdate=$date->format("Y-m-d");
                      $dt=$sales->due_date;
                      if($dt!=''){
                      echo $idate= date('Y-m-d', strtotime($fdate. " + $dt days"));
                      }else{
                      echo $fdate;
                      }
                      ?>
                  </th>
                  <th style="display:none"><?php 
                    $cdate = date("Y-m-d");
                    if($dt!=''){
                    $idate= date('Y-m-d', strtotime($fdate. " + $dt days"));
                    }else{
                    $idate=$fdate;
                    }
                    $theRequestMadeDateTime = strtotime($idate);
                    $theCurrentDateTime = strtotime($cdate);
                    $theDifferenceInSeconds = 600 - ($theCurrentDateTime - $theRequestMadeDateTime);
                    $minutesLeft = (floor ($theDifferenceInSeconds / (60*60*24)));
                    if($cdate<$idate)
                    {
                    ?>
                    <samp style="color:#2c96dd">
                    <?php
                      echo $minutesLeft." days due";
                      ?>
                    </samp>
                    <?php
                      }elseif($cdate>$idate){
                      ?>
                    <samp style="color:#ef6f08">
                    <?php
                      echo abs($minutesLeft)." days over due";
                      
                      ?>
                    </samp>
                    <?php }else
                      {
                      ?>
                    <samp style="color:#ef6f08">
                    <?php
                      echo " Today's due";
                      }
                      ?>
                    </samp>
                  </th>
                  <th style="display:none"><?=$sales->grand_total;?></th>
                  <th><?php
                    if($sales->force_close_status=='0')
                    {
                    echo "Open";
                    }
                    if($sales->force_close_status=='1')
                    {
                    echo "Force Close";
                    }
                    if($sales->force_close_status=='2')
                    {
                      echo "Completed";
                    }
                    
                    if($sales->force_close_status=='3')
                    {
                      echo "Partial Completed";
                    }
                    
                    ?></th>
                  <!-- <th><?=$sales->reason;?></th> -->
                  <th>
                    <button class="btn btn-default"  type="button" data-toggle="modal" data-target="#modal-0" onclick="viewGrn('<?=$sales->purchaseid;?>');"> <i class="icon-eye"></i></button>
                    <?php
                      $purchaseOrderQuery=$this->db->query("select *from tbl_inbound_log where po_no='$sales->purchaseid'");
                      $countPO=$purchaseOrderQuery->num_rows();
                      if($countPO>0)
                      {
                      ?>
                    <button class="btn btn-default" onClick="openpopup('<?=base_url();?>purchaseorder/purchaseorder/edit_purchase_order_1',1400,600,'view',<?=$sales->purchaseid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="fa fa-eye"></i></button>
                    <a style="display:none1" href="<?=base_url();?>purchaseorder/purchaseorder/print_invoice?id=<?=$sales->purchaseid;?>" class="btn btn-default" target="blank">
                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-print"></i></button></a>
                    <?php
                      }
                      else
                      {
                      ?>
                    <button class="btn btn-default" onClick="openpopup('<?=base_url();?>purchaseorder/purchaseorder/edit_purchase_order_1',1400,600,'view',<?=$sales->purchaseid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="fa fa-eye"></i></button>
                    <button class="btn btn-default" onClick="openpopup('<?=base_url();?>purchaseorder/purchaseorder/edit_purchase_order_1',1400,600,'id',<?=$sales->purchaseid;?>)" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>
                    <?php
                      $pri_col='purchaseid';
                      $table_name='tbl_purchase_order_hdr';
                      ?>
                    <button style="display:none" class="btn btn-default delbuttonPurchase" id="<?=$sales->purchaseid."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
                    <a style="display:none1" href="<?=base_url();?>purchaseorder/purchaseorder/print_invoice?id=<?=$sales->purchaseid;?>" class="btn btn-default" target="blank">
                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-print"></i></button></a>
                    <?php }?>
                    <button type="button" class="btn btn-default" onclick="getId(<?php echo $sales->purchaseid;?>)" data-toggle="modal" data-target="#modal-2"><i class="icon-trash"></i></button> 
                  </th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
              <form name="myForm" class="form-horizontal" id ="fClose" action="#" 
                onsubmit="return forceClose();"method="POST" enctype="multipart/form-datam">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Force Close</h4>
                      <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group">
                          <input type="hidden" name='id' id="p_id" value="" />
                          <label class="col-sm-2 control-label">Reason:</label> 
                          <div class="col-sm-4">
                            <textarea class="form-control" name="reason"></textarea>
                          </div>
                          <label class="col-sm-2 control-label">date:</label> 
                          <div class="col-sm-4"> 
                            <input name="date" type="date" value="" class="form-control" id="thickness"> 
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
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="col-md-6"> 
                  <?=$pagination; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>
<script>
  function exportTableToExcel(tableID, filename = ''){
   
    //alert();
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      
      // Specify file name
      filename = filename?filename+'.xls':'PurchaseOrder_<?php echo date('d-m-Y'); ?>.xls';
      
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
  
  
  function forceClose() {
              
    var form_data = new FormData(document.getElementById("fClose"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "purchaseorder/force_close",
        type: "POST",
        data: form_data,
        processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
    
    
    
      if(data == 1 || data == 2){
      
                        if(data == 1)
                
                          var msg = "Force Close Successfully!";
                        else
                          var msg = "Data Successfully Updated !";
              $("#resultarea").text(msg);
              setTimeout(function() {   //calls click event after a certain time
                         $("#modal-2 .close").click();
                         $("#resultarea").text(" "); 
                         $('#fClose')[0].reset(); 
              
       
                      }, 1000);
                    }else{
                      $("#resultarea").text(data);
            
                   }
           
   
     
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  
  function getId(c)
  {
    document.getElementById("p_id").value=c;
  }
  
  function viewGrn(viewId){
  
    $.ajax({   
          type: "POST",  
        url: "view_grn_details",  
        cache:false,  
        data: {'id':viewId},  
        success: function(data)  
        {  
        // /alert(data); 
        // $("#loading").hide();  
         $("#inboundData").empty().append(data).fadeIn();
        //referesh table
        }   
    });
  
   }
  
</script>