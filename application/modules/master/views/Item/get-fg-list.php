<?php 

$i=0;

$shp=$this->db->query("select * from tbl_shape_part_mapping where product_id='$id' ");
foreach ($shp->result() as $getShp) 
{


  $ppm=$this->db->query("select * from tbl_part_price_mapping where part_id='$getShp->part_id' ");
  $dtP=$ppm->row();

  $part=$this->db->query("select * from tbl_product_stock where Product_id='$dtP->part_id' ");
  $getPart=$part->row();

  $rm=$this->db->query("select * from tbl_product_stock where Product_id='$dtP->rowmatial' ");
  $getRm=$rm->row();

  $scrp=$this->db->query("select * from tbl_product_stock where Product_id='$getRm->scrap_id' ");
  $getScrp=$scrp->row();

  $master=$this->db->query("select * from tbl_master_data where serial_number='$dtP->unit'");
  $getMaster=$master->row();


?>

     <tr>
    
  		<td></td>

       <td><input type="hidden" id="partFg<?=$i?>" value="<?=$getPart->sku_no?>"><?=$getPart->sku_no?>
       <input type="hidden" name="rowCount[]" id="rowCount" value="<?=$i?>">
      </td>

      <td><input type="hidden" id="rmFg<?=$i?>" value="<?=$getRm->sku_no?>"><?=$getRm->sku_no?>
      </td>

      <td><input type="hidden" id="unitFg<?=$i?>" value="<?=$getMaster->keyvalue?>"><?=$getMaster->keyvalue?>
      </td>

      <td>
        <input type="hidden" id="cwgtFg<?=$i?>" value="<?=$dtP->EPrice?>" ><?=$dtP->EPrice?>
      </td>

      <td>
        <input type="hidden" id="nwgtFg<?=$i?>" value="<?=$dtP->qty?>"><?=$dtP->qty?>
      </td>

      <td><input type="hidden" id="scrapFg<?=$i?>" value="<?=$getScrp->productname?>"><?=$getScrp->productname?>        
      </td>     
  		<td></td>
		</tr> 

      <?php $i++; } ?>