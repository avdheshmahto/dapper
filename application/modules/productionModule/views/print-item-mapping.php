<?php
  $selectIssuematQuery=$this->db->query("select *from tbl_quotation_purchase_order_dtl where purchaseid='".$_GET['id']."' ");
  
  foreach($selectIssuematQuery->result() as $getMat){
  $issProduct[]=$getMat->productid;
  $sumQty=$sumQty+$getMat->total_price;
  }
  
  $issueData=implode(",",$issProduct);
  if($issueData!='')
  {
  $issueDataa=$issueData;
  }
  else
  {
  $issueDataa='0';
  }
  
  
  $mQuery=$this->db->query("select *from tbl_machine where code in($issueDataa)");
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
  $partId[]=$dt->part_id;  
  }
  @$dataPart=implode(",",$partId);
  
  
  if($dataPart!='')
  {
  $dataPartt=$dataPart;
  }
  else
  {
  $dataPartt='0';
  }
  
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Dapper</title>
    <link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/challan_css/css/style.css' />
  </head>
  <body>
    <div id="page-wrap">
      <div style="clear:both"></div>
      <table id="items">
        <tr>
          <th colspan="4">
            <center>RM Details</center>
          </th>
        </tr>
            <tr>
              <th>RM Code</th>
              <th>Description</th>
              <th style="display:none">Net Weight</th>
              <th style="display:none">Cast Weight</th>
              <th>Production Qty</th>
              <th>RM Required<br />No./Kg</th>
              <th style="display:none">RM IN Stock</th>
            </tr>
            <?php
              $contQuery=$this->db->query("select SUM(EPrice) as RMSUM,SUM(qty) as sumqty,EPrice,rowmatial from tbl_part_price_mapping where part_id in ($dataPartt) group by rowmatial ");
                 foreach($contQuery->result() as $dt)
                 {
              $productNameQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->rowmatial'");
              $getProduct=$productNameQuery->row();
              
                    $prodId   = $getProduct->Product_id;
                    $sku   = $getProduct->sku_no;
                    $prodName = $getProduct->productname;
                    $uom      = $getProduct->usageunit;
              
              
              $usagesUnitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProduct->usageunit'");
              $getUsagesUnit=$usagesUnitQuery->row();
              
                 ?>
            <tr>
              <td><?=$sku;?></td>
              <td><?=$prodName;?></td>
              <td style="display:none"><?php echo round($dt->RMSUM,3);?>(<?=$getUsagesUnit->keyvalue;?>) </td>
              <td style="display:none"><?php echo round($dt->sumqty,3) ?> <?=$getUsagesUnit->keyvalue;?> </td>
              <td><?php echo $productionQty=$sumQty;?></td>
              <td>(<?php echo $productionQty=$sumQty;?>)(<?=$dt->RMSUM*$productionQty;?>)</td>
              <td style="display:none"><?php
                $productNameSerialQtyQuery=$this->db->query("select * from tbl_product_serial where product_id='$dt->rowmatial'");
                $getProductSerialQty=$productNameSerialQtyQuery->row();
                if($getProductSerialQty->quantity!='')
                {
                  echo $getProductSerialQty->quantity;
                }
                else
                {
                  echo "0";
                }?>    
              </td>
            </tr>
            <?php }  ?>
        </table>
    </div>
  </body>
</html>