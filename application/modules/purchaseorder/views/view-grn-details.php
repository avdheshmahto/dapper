 <!-- Main content -->
  <div class="main-content">
	<!-- Breadcrumb -->
		
        <div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">RM Planing Status</h4>
						      <ul class="panel-tool-options"> 
								<li><a href="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></a></li> 
							  </ul> 
						 </div>
		
		 <div class="panel-body">
          
	<!-- <div class="table-responsive-">
   </div> -->
        
		
		<div class="" id="style-3-y">
		<div class="force-overflow-y">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover " >
			<thead>
				<tr>
					<th class="tdcenter"> Sl No</th>
					<th class="tdcenter">Item Number & Description</th>
					<th class="tdcenter">UOM</th>
					<th class="tdcenter">Remaining Qty</th>
                    <th class="tdcenter">Remaining Weight</th>
                   
				</tr>
			</thead>
        
      <?php
	
		$productQuery=$this->db->query("select *from tbl_purchase_order_dtl where purchaseid='$id' ");
		$i=1;
		foreach($productQuery->result() as $getProduct){
			
			
						
$cntQtyQuery=$this->db->query("select SUM(receive_qty) as weightt,SUM(qn_pc) as qty_pc from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getProduct->purchaseid'");
$getCntT=$cntQtyQuery->row();           

//echo $getCntT->weightt;
$sumQty=$getProduct->qty-$getCntT->weightt;

		####### get product #######
		$productStockQuery=$this->db->query("select * from tbl_product_stock where Product_id='$getProduct->productid'");
		$getProductStock=$productStockQuery->row();
		####### ends ########
		
		####### get UOM #######
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########
		
		?>
       <tr class="gradeX odd" role="row">
            <td class="size-60 text-center sorting_1"><?=$i;?></td>
			<td><?=$getProductStock->sku_no;?>& <?=$getProductStock->productname;?>
              <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
              
            </td>
			<td><?=$getProductUOM->keyvalue;?></td>
            <td><?=$getProduct->qn_pc - $getCntT->qty_pc;?></td>
			<td>
			<?php echo $sumQty;?>
			</td>
            
                                           
		</tr>
	        <?php 
			
			}?>
            
            <input type="hidden" name="qrd_qtyT" id="qrd_qtyT"  value="<?=$ordQtyTot;?>" />
          <input type="hidden" id="remQyT" value="<?=$remQtyTot;?>" />
          
          <input type="hidden" name="totToCom" id="totTocomp" />
        
		</table>
		</div>	  

		</div>
		</div><!--scrollbar-y close-->		

		


		<!-- <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid "> -->
		


				<!-- <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
				<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

				<tr></tr>
				</table> -->
			<!-- </div> -->
		</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover" >
	<tbody>
	<!-- 	<tr class="gradeA">
		<th>Sub Total</th>
		<th>&nbsp;</th>
		<th>
		<input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
		</th>
		</tr>

		

        <tr class="gradeA">
		<th>Grand Total</th>
		<th>&nbsp;</th>
		<th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
		</tr>
		<tr class="gradeA">
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		</tr>
		<tr class="gradeA">
		<th> -->

		<!-- <th>&nbsp;</th>
		<th >
		
		</th></th> -->
		</tr>
	  </tbody>
    </table>
   </div>
   
   </div>
   <div class ="pull-right" id="saveDiv" >
   
		&nbsp;<a  class="btn btn-sm"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
   </div>

  </div>
  </div>
</div>

