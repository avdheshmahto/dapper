<?php if($result != ""){
  $i = 0; 
  ?>
<div class="row">
  <div class="col-lg-12">
    <!--  <h5 class="title"><?=$dt['item'];?></h5> -->
    <div class="accordion" id="accordion2">
      <?php  foreach ($result as $key => $dt) { ?>
      <div class="panel accordion-group">
        <div class="accordion-heading">
          <h6 class="title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$i;?>" aria-expanded="false"><?=$dt['sku_no'];?> <span class="pull-right"style="color:red;font-size:12px"><?php if($dt['part'] == ""){ ?><?php $productionQty=$dt['productionQty']?> <?php } ?></span></a> </h6>
        </div>
        <div id="collapse<?=$i;?>" class="accordion-body collapse" aria-expanded="false" style="height: 0px;">
          <div class="accordion-inner">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>RM Code</th>
                  <th>Net Weight</th>
                  <th>Cast Weight</th>
                  <th>Production Qty</th>
                  <th>RM Required</th>
                  <th>RM IN Stock</th>
                </tr>
              </thead>
              <tbody>
                <?php 	//if($dt['part'] != ""){
                  // echo "select *from tbl_machine where machine_name ='".$dt['itemid']."'";
                   
                   $mQuery=$this->db->query("select *from tbl_machine where code ='".$dt['itemid']."'");
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
                            foreach($contQuery->result() as $dt)
                            {
                    
                  $part_data_id[]=$dt->part_id;  
                    
                   }
                   
                   @$dataPart=implode(",",$part_data_id);
                   if($dataPart!='')
                   {
                    $dataPartt=$dataPart;
                   }
                   else
                   {
                    $dataPartt='0';
                   }
                   
                   $rowQuery=$this->db->query("select sum(qty) as Netqty,sum(EPrice) as Castqty,rowmatial from tbl_part_price_mapping where part_id in ($dataPartt) group by rowmatial");
                   
                  			  foreach ($rowQuery->result() as  $rt) {
                  				  
                  				   $productNameQuery=$this->db->query("select *from tbl_product_stock where Product_id='$rt->rowmatial'");
                    $getProduct=$productNameQuery->row();
                    
                    
                    
                    
                    
                   
                    $usagesUnitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
                    $getUsagesUnit=$usagesUnitQuery->row();
                                           ?>
                <tr>
                  <td><?=$getProduct->sku_no;?></td>
                  <td><?php echo round($rt->Netqty, 3);?>  <?=$getUsagesUnit->keyvalue;?> </td>
                  <td><?php echo round($rt->Castqty,3);?> <?=$getUsagesUnit->keyvalue;?> </td>
                  <td><?=$productionQty;?> Pcs.</td>
                  <td>(<?=$rt->Netqty*$productionQty;?>)(<?=$rt->Castqty*$productionQty;?>) <?=$getUsagesUnit->keyvalue;?></td>
                  <td><?php
                    //      	  echo "select *from tbl_product_serial where product_id='$rt->rowmatial'";
                    $productNameSerialQtyQuery=$this->db->query("select *from tbl_product_serial where product_id='$rt->rowmatial'");
                    $getProductSerialQty=$productNameSerialQtyQuery->row();
                    
                    
                    if($getProductSerialQty->quantity!='')
                    {
                    echo $getProductSerialQty->quantity;
                    }
                    else
                    {
                    echo "0";
                    }?></td>
                </tr>
                <?php } //}else{ ?>
                <?php  //} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php $i++;} ?>
    </div>
  </div>
</div>
<?php } ?>