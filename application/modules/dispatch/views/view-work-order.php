<?php

$queryData=$this->db->query("select *from tbl_job_work where id='$id'");
$getData=$queryData->row();

?><form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#" 
        onsubmit="return submitProductionPurchase();"method="POST"> 


<div class="modal-body">
		  	



<div class="form-group">
<label class="col-sm-2 control-label">Customer Name:</label> 
<div class="col-sm-4">
<select class="form-control" name="vendor_id" disabled required>
        <option value="">--Select--</option>
        <?php
$queryProductShape=$this->db->query("select *from tbl_contact_m where group_name='5'");
foreach($queryProductShape->result() as $getProductShape){

?>
        <option value="<?=$getProductShape->contact_id;?>" <?php if($getProductShape->contact_id==$getData->vendor_id){?> selected <?php }?>><?=$getProductShape->first_name;?></option>
        <?php }?>
      </select> 
</div>
<label class="col-sm-2 control-label">date:</label> 
<div class="col-sm-4"> 
<input name="date" type="date" value="<?=$getData->date;?>" class="form-control" id="thickness" readonly> 
</div>
</div>

<div class="form-group">


<div class="col-sm-12"> 

<div class="modal-header">
       <br>
       <table class="table table-bordered table-hover" >
       	<br>
       	  <tbody>
       	  	<tr class="gradeA">
           				<th>Finish Goods Name & code</th>
			
                <th>Qty</th>
				
			</tr>
       	  </tbody>
       	  <tbody id="quotationTable">
       	  	<?php 
			$selectQuery=$this->db->query("select *from tbl_production_dispatch where id='$id'");
              foreach ($selectQuery->result() as  $dt) {
				  $shapeQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->productid'");
				  $getShape=$shapeQuery->row();
                 
            ?>
              	<tr>
            
            
				<td>           
               <?=$getShape->productname;?>&<?=$getShape->sku_no;?>
                
                </td>
            
                <td><?=$dt->qty;?></td>
              	</tr>
              	
            <?php 
       	  	} ?>
       	  </tbody>
       </table>

     </div>
</div>
</div>



</div>
