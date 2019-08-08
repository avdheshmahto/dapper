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
  <!-- Breadcrumb -->
  <ol class="breadcrumb breadcrumb-2">
    <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
    <li ><a href="#">Purchase Order</a></li>
    <li><strong class="active">Manage Challan</strong></li>
    <div class="pull-right" style="display:none">
      <a class="btn btn-sm" href="<?=base_url();?>issueMaterialproduction/inbound/add_inbound"><i class="fa fa-plus" aria-hidden="true"></i>Isuue Material</a>
      <button style="display:none;" type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button>
    </div>
  </ol>
  <div class="row">
    <div class="col-lg-12" id="listingData">
     
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-5" style="margin: 0px -3px -15px 0px;">
            <label>
              Show 
              <select   name="DataTables_Table_0_length" url="<?=base_url();?>issueMaterialproduction/inbound/manage_inbound?<?='po_no='.$_GET['po_no'].'&date='.$_GET['date'].'&grn_no='.$_GET['grn_no'].'&filter='.$_GET['filter'];?>" id="entries" class="form-control" style="width: 65px;">
                <option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
                <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
              </select>
              entries
            </label>
            <p>Showing <?=$dataConfig['page']+1;?>  to  <?php
              $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
              echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
              ?> of <?=$dataConfig['total'];?> entries</p>
          </div>
          <div class="col-sm-7">
            <div class="pull-right">
              <label>Search : <input type="text" id="searchTerm" class="form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?" aria-controls="" style="float:right;width:auto;margin: -2px 0px 0px 5px;"></label>
              <button type="button" class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')" style="margin: 10px 0px 0px 5px;">Excel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
            <thead>
              <tr>
                <th>Request Id</th>
                <th>Date</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="dataTable">
              <tr>
                <form method="get">
                  
                  <td><input  name="request_no"  type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td><input name="date"  type="date"  class="search_box form-control input-sm" value="" /></td>
                  <td><input name="grn_no"  type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td>&nbsp;</td>
                  <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                </form>
              </tr>
              <?php
                $i=1;
                foreach($result as $sales)
                {
                ?>
              <tr class="gradeC record">
               
                <td><?=$sales->request_no;?></td>
                <?php 
                  $sqlpoContact  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$getPoNumber->vendor_id."'");
                  $sqlporesult  = $sqlpoContact->row();
                   ?>
                <?php 
                  $sqlpoSupplier  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->supplier_contact."'");
                  $getSupplier  = $sqlpoSupplier->row();
                   ?>
                <td><?=$sales->maker_date;?></td>
                <td>
                  <?php
                    $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$sales->inboundid'");
                    $getQt=$poquery->row();
                    echo (round($getQt->qty,3));
                    ?>
                </td>
                <td>
                  <?php
                    $poqueryC=$this->db->query("select SUM(remaining_qty) as qtyC from tbl_issuematrial_dtl where status='A' and inboundrhdr='$sales->inboundid'");
                    $getQtC=$poqueryC->row();
                    
                    if($sales->status=='2')
                    {
                    echo "Completed";
                    }
                    elseif($sales->status=='3')
                    {
                    	echo "Partital Completed";
                    }
                    elseif($sales->status=='1')
                    {
                    echo "Force Close";	
                    }
                    else
                    {
                    	echo "Open";
                    	}
                    ?>
                </td>
                <!-- 	<td><?=$sales->ship_vip;?></td> -->
                <td>
                  <button class="btn btn-default"  type="button" data-toggle="modal" data-target="#modal-0" onclick="viewInbound('<?=$sales->inboundid;?>^<?=$sales->po_no;?>');"> <img src="<?=base_url();?>assets/images/plus.png" /></button>
                  <button class="btn btn-default"  type="button" data-toggle="modal" data-target="#modal-ChallanLog" onclick="viewChallanLog('<?=$sales->inboundid;?>^<?=$sales->po_no;?>');"> <i class="icon-eye"></i></button>
                  <button style="display:none" class="btn btn-default" id="<?=$sales->purchaseid."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
                 
                </td>
                <?php } ?>
              </tr>
            </tbody>
            <input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
            <input type="text" style="display:none;" id="pri_col" value="Product_id">
          </table>
        </div>
        <nav aria-label="Page navigation" class="pull-right">
          <?php echo $pagination; ?>
        </nav>
      </div>
    </div>
  </div>
</div>

<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="issueQty__" action="insert_issue_row_material" 
      method="POST">
      <div class="modal-content" id ="inboundData">
       
      </div>
      <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="modal-ChallanLog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="issueQty__" action="insert_issue_row_material" 
      method="POST">
      <div class="modal-content" id ="viewChallanDiv">
        
      </div>
      <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>

</div>


<script>

  function submitissueQty() {
              
    var form_data = new FormData(document.getElementById("issueQty"));
    form_data.append("label", "WEBUPLOAD");
  
    $.ajax({
        url: "inbound/insert_issue_row_material",
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
  			//	 ajex_PurchaseListData(<?=$_GET['id'];?>);
   
  	 
      console.log(data);
      //Perform ANy action after successfuly post data
         
    });
    return false;     
  }
  // ends
  
  

  function getVendor()
  {
  
  var state=document.getElementById("state").value;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getVendor?state="+state, false);
  xhttp.send();
  document.getElementById("contact_id_copy").innerHTML = xhttp.responseText;
  	
  	
  }
  
        
</script>

<?php
  $this->load->view("footer.php");
?>

<script>
  function viewChallanLog(viewId){
  var res = viewId.split("^");
  var id=res[0];
  var po_id=res[1];
  	$.ajax({   
  		type: "POST",  
  		url: "view_challan_log",  
  		cache:false,  
  		data: {'id':id,'po_id':po_id},  
  		success: function(data)  
  		{  
  			$("#viewChallanDiv").empty().append(data).fadeIn();
  			//referesh table
  		}   
  	});
  }
  
  
  
  function viewInbound(viewId){
  var res = viewId.split("^");
  var id=res[0];
  var po_id=res[1];
  	$.ajax({   
  		type: "POST",  
  		url: "view_inbound",  
  		cache:false,  
  		data: {'id':id,'po_id':po_id},  
  		success: function(data)  
  		{  
  			$("#inboundData").empty().append(data).fadeIn();
  			//referesh table
  		}   
  	});
  }
  
  
  function exportTableToExcel(tableID, filename = ''){
  
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
  
  
  function qtyVal(d)
  {
  	
  	var zz=document.getElementById(d).id;
  	var myarra = zz.split("qty");
  	var asx= myarra[1];
  	//alert(asx);
  	var entQty=document.getElementById("qty"+asx).value;	
  	var remQty=document.getElementById("rem_qty"+asx).value;	
    var qtyInStcok=document.getElementById("qtyInStcok"+asx).innerHTML;
  
    var qrd_qtyT=document.getElementById("qrd_qtyT").value;
  
  	var remQyT=document.getElementById("remQyT").value;
  
  	var sumT=Number(remQyT)+Number(entQty);
  	
    document.getElementById("totTocomp").value=sumT;

    /*var count = document.getElementsByName('qty[]'); 
    var tcount = count.length;

    for(var i=1; i<=tcount; i++)
    { 
      if(entQty[i]==undefined)
      {
        enterWgt=0;
      }
      else
      {
        enterWgt=entQty[i];
      }
      var sum=sum+enterWgt;
    }

    alert(sum);*/
  
  	if(Number(qtyInStcok)<Number(entQty) )	
  	{
  		alert("Enter weight should be less than weight in stock !");
  		document.getElementById("qty"+asx).focus();	
  		document.getElementById("add").disabled = true;
  		return false;
  	}
  	else
  	{
  	  document.getElementById("add").disabled = false;
  	}

  }
  
</script>