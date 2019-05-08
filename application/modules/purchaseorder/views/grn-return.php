<div class="panel-body">
<div class="" id="style-3-y">
<div class="force-overflow-y">
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover " >
		<thead>
			<tr>
				<th class="tdcenter">Sl No</th>
				<th class="tdcenter">Item Number & Description</th>
		   		<th class="tdcenter">Receive Qty</th>
		   		<th class="tdcenter">Receive Weight</th>
		   		<th class="tdcenter">Remaining Qty</th>
                <th class="tdcenter">Remaining Weight</th>
                <th class="tdcenter">Enter Return QTY</th>
                <th class="tdcenter">Enter Return Weight</th>
			</tr>
		</thead>
    	<input type="hidden"  name="po_no" value="<?=$id?>">
      <?php
		$productQuery=$this->db->query("select *,SUM(receive_qty) as rcqty,SUM(qn_pc) as rcwght from tbl_inbound_log where po_no='$id' GROUP BY productid");
		$i=1;
		foreach($productQuery->result() as $getProduct){

		####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->productid'");
		$getProductStock=$productStockQuery->row();
		####### ends ########
		
		$grnrt=$this->db->query("select * from tbl_grn_return_hdr where po_no='$getProduct->po_no' ");
		$getRt=$grnrt->row();

		$grndtl=$this->db->query("select *,SUM(return_weight) as rtwght,SUM(return_qty) as rtqty from tbl_grn_return_dtl where grnhdr='$getRt->grnhdr'");
		$getDtl=$grndtl->row();

		?>
       	<tr class="gradeX odd" role="row">
            <td class="size-60 text-center sorting_1"><?=$i;?></td>
			<td><?=$getProductStock->sku_no.' '.$getProductStock->productname;?>
              <input type="hidden"  name="productid[]" id="productid[]<?=$i;?>" value="<?=$getProduct->productid;?>" class="form-control">
            </td>
			<td><?=$getProduct->rcqty;?>                 
            <input type="hidden" min="0" name="rec_qty[]" id="rec_qty[]<?=$i;?>" value="<?=$getProduct->rcqty;?>" class="form-control">
            </td>

			<td><?=$getProduct->rcwght;?>
            <input type="hidden" name="recevd_wght[]" id="recevd_wght<?=$i;?>" value="<?=$getProduct->rcwght;?>" />
            </td>
            
            <td><?=$getProduct->rcqty-$getDtl->rtqty;?>
            <input type="hidden" name="rem_qty" id="rem_qty<?=$i;?>" value="<?=$getProduct->rcqty-$getDtl->rtqty;?>" />
        	</td>
            
            <td><?=$getProduct->rcwght-$getDtl->rtwght;?>
            <input type="hidden" name="rem_wght" id="rem_wght<?=$i;?>" value="<?=$getProduct->rcwght-$getDtl->rtwght;?>" />
        	</td>

 			<td><input type="Number" min="0" name="return_qty[]" id="return_qty<?=$i;?>" onkeyup="chkQty(this.id)" class="form-control">
 			</td>
            
            <td><input type="Number" min="0" name="retrn_weight[]" id="retrn_weight<?=$i;?>" onkeyup="chkWeight(this.id)" class="form-control">
            </td>                                         			
		</tr>
    <?php 
	  $i++;
	}?>
	</table>
	</div>	  

</div>
</div><!--scrollbar-y close-->		
</div>
        
<div class="modal-footer">
<input type="submit" class="btn btn-sm" id="add_req" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>        