
		  
         
         <div class="modal-header">
       <br>
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
       	  <tbody id="quotationTable">
       	  	<?php if($result != ""){
              foreach ($result as  $dt) {
                 $query11    = $this->db->query("select * from tbl_product_stock where Product_id = '".$dt['rowmatial']."'");
                 $rowmatrial = $query11->row(); 

                 $uom        = $this->db->query("select * from tbl_master_data where serial_number = '".$dt['unit']."'");
                 $rowmatrialuom = $uom->row();
            ?>
              	<tr>
              	<td><input type ="hidden" name="prodcId[]" value="<?=$dt['rowmatial'];?>"><?=$rowmatrial->productname;?></td>
              	<td><input type ="hidden" name="uom[]" value="<?=$rowmatrialuom->serial_number;?>"><?=$rowmatrialuom->keyvalue;?></td>
              	<td><input type ="hidden" name="mproPrice[]" value="<?=$dt['qty'];?>"><?=$dt['qty'];?></td>
              	<td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td>
              	</tr>
              	
            <?php  }
       	  	} ?>
       	  </tbody>
       </table>

     </div>
       
   
		<div class="modal-footer" style="display:none">
	    <button type="submit" class="btn btn-sm" >Add</button>
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
		</div>
   
		