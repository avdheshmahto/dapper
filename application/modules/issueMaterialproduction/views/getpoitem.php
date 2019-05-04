<style type="text/css">
	thead tr {
    background-color: #abacad;
    color: #080808;
   }
</style>

<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
		<thead>
		<tr>
		<th class="tdcenter">Sl No.</th>
		<th class="tdcenter">Item Number & Description</th>
		<th class="tdcenter">UOM</th>
		<!-- <th class="tdcenter">In Stock Qty</th> -->
		<th class="tdcenter">Ordered Qty</th>
        <th class="tdcenter">Remaining Qty</th>
		<th class="tdcenter">Enter Qty</th>
		
		</tr>
		</thead>
      <?php if($result != "") {
       
		
		foreach($result as $val){
		$i=1;
		
		$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$val->productid'");
		$getProduct=$productQuery->row();
		
        
      ?>
        <tr class="gradeX odd" role="row">
            <td class="size-60 text-center sorting_1"><?=$i;?></td>
			<td class="size-60 text-center sorting_1">
			  <?=$getProduct->productname;?>
              <input type="hidden"  name="productid[]" value="<?=$val->productid;?>" class="form-control">
            </td>
			<td class="size-60 text-center sorting_1"><?=$dt['unit'];?></td>
			<!-- <td class="size-60 text-center sorting_1"><?=$val->qty;?></td> -->
			<td class="size-60 text-center sorting_1"><?=$val->qty-$remaining_qty;?></td>
            <td class="size-60 text-center sorting_1">
             <?=$val->qty-$val->receiveQty;?>
             <input type="hidden" id="instock<?=$i;?>" min="0"  value="<?=$dt['stockqty'];?>" class="form-control">
             <input type="hidden" id="required_qty<?=$i;?>" min="0"  value="<?=$dt['required']-$receiveQty;?>" class="form-control">
             <input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?=$val->qty-$remaining_qty;?>" class="form-control">
             <input type="hidden" name="po_no" value="<?=$dt['proid'];?>" />
            </td>
            <td class="size-60 text-center sorting_1">
              <input type="number" min="1" name="receive_qty[]" id="rec_qty<?=$i;?>" onkeyup="qtyValidation(this.id);" class="form-control">
              <input type="hidden" name="validationCheck" id="validationCheck" value="0" />
            </td>
		</tr>
        <?php 
		$i++;
  	  }
	} ?>

		</table>
        
        
        