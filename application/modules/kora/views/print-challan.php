<?php
  $hdrQuery=$this->db->query("select *from tbl_job_work where id='$id'");
  $getHdr=$hdrQuery->row();
  
  
  $vendorQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getHdr->vendor_id'");
  $getVendor=$vendorQuery->row();
  
  
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
            <center>Order Challan</center>
          </th>
        </tr>
        <tr class="item-row">
          <td colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="15%"><strong>Challan No. :</strong></td>
                <td width="55%"><?=$getHdr->id;?></td>
                <td width="18%"><strong>Vendor Name:</strong></td>
                <td width="12%"><?=$getVendor->first_name;?></td>
              </tr>
              <tr>
                <td><strong>Date:</strong></td>
                <td><?=$getHdr->date;?></td>
                <td><strong>&nbsp;</strong></td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <th>Sr. No.</th>
          <th>Shape</th>
          <th>Part Name</th>
          <th>Quantity</th>
        </tr>
        <?php 
          $selectQuery=$this->db->query("select *from tbl_job_work where id='$id'");
                     foreach ($selectQuery->result() as  $dt) {
              $i=1;
              $shapeQuery=$this->db->query("select *from tbl_product_stock where Product_id='$dt->shape_id'");
              $getShape=$shapeQuery->row();
                        
                   ?>
        <tr>
          <td><?=$i;?></td>
          <td><?=$getShape->productname;?></td>
          <td>
            <?php
              $jLog=$this->db->query("select * from tbl_job_work_log where lot_no='$dt->lot_no' AND job_order_no='$dt->job_order_no' AND shape_id='$dt->shape_id' ");
              foreach($jLog->result() as $imp)
              {
                $productQ=$this->db->query("select * from tbl_product_stock where Product_id='$imp->part_id' ");
                $getPQ=$productQ->row();
                echo $getPQ->productname."<br>";
              }
            ?>
          </td>
          <td>
            <?php
              $jLog=$this->db->query("select * from tbl_job_work_log where lot_no='$dt->lot_no' AND job_order_no='$dt->job_order_no' AND shape_id='$dt->shape_id' ");
              foreach($jLog->result() as $imp)
              {
                echo $imp->qty."<br>";
              }
            ?>
          </td>
        </tr>
        <?php 
          $i++;
          } ?>
      </table>
    </div>
  </body>
</html>