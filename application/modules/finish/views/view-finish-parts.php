<div class="panel-body">
   <div class="" id="style-3-y">
      <div class="force-overflow-y">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover " >
               <thead>
                  <tr>
                     <th>Code</th>
                     <th style="display:none">Production Qty</th>
                     <th>Total Recieve Qty</th>
                     <th  style="display:none">Action</th>
                  </tr>
               </thead>
               <?php
                                    
                    $mQuery=$this->db->query("select *from tbl_machine where code ='$id'");
                    foreach($mQuery->result() as $getM){
                  	  $getMachine[]=$getM->machine_name;
                    }
                    
                    @$dataMac=implode(",",$getMachine);
                    if($dataMac!='')
                    {
                  	  $dataMacc=$dataMac;
                    }
                    else
                    {
                  	  $dataMacc='0';
                    }
                    
                     $contQuery=$this->db->query("select distinct(part_id) from tbl_shape_part_mapping where product_id in ($dataMacc) ");
                     foreach($contQuery->result() as $rt)
                     {
                  	  
                  	    $part_data_id[]=$dt->part_id;  
                  		  //foreach ($rowQuery->result() as  $rt) {		  
                  			$productNameQuery=$this->db->query("select *from tbl_product_stock where Product_id='$rt->part_id'");
                  	    $getProduct=$productNameQuery->row();
                  	  
                  	    $usagesUnitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
                  	    $getUsagesUnit=$usagesUnitQuery->row();
                                            ?>
               <tr>
                  <td><?=$getProduct->sku_no;?></td>
                  <td  style="display:none"><?=$productionQty;?> Pcs.   </td>
                  <td>
                     <?php
                        $partQuery=$this->db->query("select SUM(transfer_qty) as qty from tbl_production_order_check where lot_no='003' and transfer_qty!='' and productid='$rt->part_id' and order_type='Finish Order'");
                        $getPartSum=$partQuery->row();
                        echo $getPartSum->qty;
                        ?>
                     <?=$getUsagesUnit->keyvalue;?> 
                  </td>
                  <td  style="display:none">
                     <?php
                        if($productionQty==$getPartSum->qty)
                        {
                        ?>
                     <i class="fa fa-check" style='font-size:28px; color:green' aria-hidden="true"></i>
                     <?php }else{?>
                     <i class="fa fa-close" style="font-size:28px;color:red"></i><?php }?>
                  </td>
               </tr>
               <?php } ?>
            </table>
         </div>
      </div>
   </div>   
</div>

<div class="modal-footer">
   <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>