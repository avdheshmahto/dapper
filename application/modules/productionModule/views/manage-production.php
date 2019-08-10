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
  <div class="panel panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Production</a></li>
      <li class="active"><strong>Manage Production</strong></li>
      <div class="pull-right">
      </div>
    </ol>
    <div class="row">
      <div class="col-sm-12">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="html5buttons">
            <div class="dt-buttons">
              <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
              <a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
            </div>
          </div>
          <div class="dataTables_length" id="DataTables_Table_0_length">
            <label>
              Show
              <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('productionModule/manage_production?');?>" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
              </select>
              Entries
            </label>
            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style=" margin-top: -6px;margin-left: 12px;float: right;">
              Showing <?=$dataConfig['page']+1;?> to
              <?php
                $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                ?> of <?php echo $dataConfig['total'];?> Entries
            </div>
          </div>
          <div id="DataTables_Table_0_filter" class="dataTables_filter">
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
            <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
              <thead>
                <tr>
                  <th>Lot No.</th>
                  <th>Date</th>
                  <th>Customer Name</th>
                  <th style="display:none">Production Qty</th>
                  <th>Status</th>
                  <th>
                    <div style="width: 210px;">Action</div>
                  </th>
                </tr>
              </thead>
              <tbody id="getDataTable">
                <form method="get">
                  <tr>
                    <td><input name="p_id"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="date"  type="date"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="vendor_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td style="display:none"><input name="qty"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td>&nbsp;</td>
                    <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                  </tr>
                </form>
                <?php
                  $i=1;
                  foreach($result as $sales) {
                ?>
                <tr class="gradeC record">
                  <th><a href="<?=base_url();?>productionModule/manage_jobwork_view?id=<?=$sales->purchaseid;?>"><?=$sales->lot_no;?></a></th>
                  <th><?=$sales->maker_date;?></th>
                  <th>
                    <?php
                      $queryVendor=$this->db->query("select * from tbl_contact_m where status='A' and contact_id='$sales->contactid'");
                      $getVendor=$queryVendor->row();

                      echo $getVendor->first_name;
                      ?>
                  </th>
                  <th style="display:none">
                    <?php
                      $selectProductionQty=$this->db->query("select SUM(qty) as Sqty from tbl_quotation_purchase_order_dtl where purchaseid='$sales->purchaseid' ");
                      $qtyTot=$selectProductionQty->row();
                      echo $sales->sub_total;
                      ?>
                  </th>
                  <th>Pending</th>
                  <th>
                    <button class="btn btn-xs btn-black" data-toggle="modal" data-target="#modal-0" onclick="getspharemap(<?=$sales->purchaseid;?>);"  type="button"><i class="icon-eye"></i></button>
                    <button class="btn btn-xs btn-black" data-toggle="modal" data-target="#modal-RM" onclick="viewRMFun(<?=$sales->purchaseid;?>);"  type="button"><i class="icon-eye"></i></button>
                  </th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="col-md-6 text-left"> </div>
                <div class="col-md-6"> <?=$pagination; ?> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form class="form-horizontal" role="form" method="post" action="insert_overlock" enctype="multipart/form-data">
  <div id="editProduction" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-contentProduction"  id="modal-contentProduction" style="background: #FFF;">
      </div>
    </div>
  </div>
</form>
<div id="modal-RM" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View RM Details: </h4>
        <div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div class="panel-body" id ="view_RmD">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">

  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Production Details: </h4>
        <div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div class="panel-body" id ="purchaseData">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<?php	$this->load->view("footer.php"); ?>
<script>
  function exportTableToExcel(tableID, filename = ''){

   	//alert();
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

      // Specify file name
      filename = filename?filename+'.xls':'Production_<?php echo date('d-m-Y'); ?>.xls';

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


   function viewRMFun(v){

     var ur = "view_rm";
     $.ajax({
       url:ur,
       method:"POST",
       data:{id:v},
       success:function(data){
        //alert(data);
        console.log(data);
         $('#view_RmD').empty().append(data);
       }
     });
   }
   function getspharemap(idVal){
     //alert(idVal);
     var ur = "ajax_getitemmapping";
     $.ajax({
       url:ur,
       method:"POST",
       data:{id:idVal},
       success:function(data){
        // alert(data);
        // console.log(data);
         $('#purchaseData').empty().append(data);
       }
     });
   }

</script>
