<?php
$poViewQuery=$this->db->query("select *from tbl_purchase_order_production_hdr where purchaseid='$id'");
$getPoView=$poViewQuery->row();

?>
<form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#" 
        onsubmit="return submitProductionPurchase();"method="POST"> 
		  	<div class="modal-body">
		  	<div class="form-group"> 


<div class="form-group"> 
<label class="col-sm-2 control-label"> *Vendor Name: </label> 
<div class="col-sm-4"> 
<select name="vendor_id" class="form-control" >
			<option value="">----Select Vendor----</option>
            <?php
			$vendorQuery=$this->db->query("select *from tbl_contact_m where group_name='5'");
			foreach($vendorQuery->result() as $getVendor){
			?>
							<option value="<?=$getVendor->contact_id;?>" <?php if($getVendor->contact_id==$getPoView->vendor_id){?> selected <?php }?>><?=$getVendor->first_name;?></option>
								<?php }?>
						</select>
</div>
<label class="col-sm-2 control-label"> Date: </label> 
<div class="col-sm-4"> 
    <input name="date" type="date" value="<?=$getPoView->date;?>" class="form-control" > 
</div> 
</div>

  
          
           
          
          
          
          
		  
		  
		  
		  
           
        </div>
        
        
    </div>
            
            
             <table class="table table-bordered table-hover" >
       	<br>
       	  <tbody>
       	  	<tr class="gradeA">
				<th>Product Name</th>
				<th>UOM</th>
				<th>QTY</th>
				
			
			</tr>
       	  </tbody>
          
          
          <tbody id="quotationTable1">
          <?php
		  $queryViewPo=$this->db->query("select *from tbl_purchase_order_production_dtl where purchaseid='$getPoView->purchaseid'");
		  foreach($queryViewPo->result() as $getViewPo){
			  //start product query
		  $productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getViewPo->productid'");
		  $getProduct=$productQuery->row();
		  // ends product
		  
		  
		  //start usages unit
		  $unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
		  $getunit=$unitQuery->row();
		  // ends usages unit
		  ?>
          <tr>
          
          <td><?=$getProduct->productname;?></td>
          <td><?=$getunit->keyvalue;?></td>
          <td><?=$getViewPo->qty;?></td>
          </tr>
          <?php }?>
          </tbody>
          </table>
