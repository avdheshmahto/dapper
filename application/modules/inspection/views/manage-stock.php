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
  <div class="panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Store</a></li>
      <li class="active"><strong>Stock Details</strong></li>
    </ol>
    <?php
      if($this->session->flashdata('flash_msg')!='')
       {
      ?>
    <div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
      <strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
    </div>
    <?php }?>	
    <div id="listingData">
      <div class="row">
      </div>
      <div class="row">
        <div class="panel-body">
          <div class="table-responsive" style="padding: 4px;">
            <table class="table table-striped table-bordered table-hover dataTables-example"  id="listingAjexRequestRM">
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
                  $poquery=$this->db->query("select * from tbl_product_stock where status='A' and type in(14) ");
                  foreach($poquery->result() as $getPo){
                  	####### get product #######
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
                    		   -> where('serial_number',$getPo->usageunit)
                    		   -> get('tbl_master_data');
                    		  $keyvalue1 = $compQuery1->row();
                    echo $keyvalue1->keyvalue;		  
                    ?></th>
                 
                  <?php
                    $queryQty=$this->db->query("select SUM(qty) as qty from tbl_production_order_transfer_another_module where module_name='Inspection' and  productid='$getPo->Product_id'");
                    $getQty=$queryQty->row();
                    
                    
                    ?>
                  <th><?php echo $getQty->qty;?></th>
                  
                </tr>
                <?php }?>
              </tbody>
             
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="col-md-6 text-left"></div>
          <div class="col-md-6"> <?php echo $pagination; ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>
<script>
  
  
  function changing(v)
  {
  	//alert(v);
   	var pro=v;
  	var xhttp = new XMLHttpRequest();
  	  xhttp.open("GET", "changesubcatg?ID="+pro, false);
  	  xhttp.send();
  	  //alert(xhttp.responseText);
  	  document.getElementById("subcategory1").innerHTML = xhttp.responseText;
  	 // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
  }
  
</script>	
<script>
  function exportTableToExcel(tableID, filename = ''){
   
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      
      // Specify file name
      filename = filename?filename+'.xls':'ProductList_<?php echo date('d-m-Y');?>.xls';
      
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
</script>