<table class="table table-striped table-bordered table-hover dataTables-example1"  id="">
  <thead>
    <tr>
      <th style="width:150px;">Request No.</th>
      <th>Date</th>
      <th>Qty</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $poquery=$this->db->query("select *from tbl_issuematrial_hdr where status='A' and po_no='$id'");
      foreach($poquery->result() as $getPo){
      ?>
    <tr class="gradeC record">
      <th><?=$getPo->request_no;?></th>
      <th><?=$getPo->date;?></th>
      <th>
        <?php
          $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
          $getQty=$poquery->row();
          
          // tbl_receive_matrial_grn_log query
          
          
          //echo "select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->inboundid'";
          
          $poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
          $getQtygrnLog=$poquerygrnLog->row();
          
          
          ?>
        <?=$getQty->qty;?>
      </th>
      <th>
        <?php
          if($getQty->qty==$getQtygrnLog->qty)
          {
          	echo "Completed";
          }
          elseif($getQty->qty<$getQtygrnLog->qty)
          {
          	echo "Partial Completed";
          }
          else
          {
          	echo "Pending";
          }
          
          ?>
      </th>
      <th>
        <?php /*?><button class="btn btn-default" onclick="viewPurchaseOrder(<?=$getPo->purchaseid;?>);" data-toggle="modal" data-target="#modal-6" type="button" ><i class="fa fa-eye"></i></button><?php */?>
        <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
        <button class="btn btn-default" onclick="viewRawRequest(<?=$getPo->inboundid;?>);" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
        <a href="<?=base_url();?>productionModule/manage_jobwork_map_rm_details?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
        <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
      </th>
    </tr>
    <?php }?>
    <tr class="gradeU">
      <td>
        <button type="button" class="btn btn-default modalMapSpare1" data-toggle="modal" data-target="#modal-6"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
  <tfoot>
    <!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
  </tfoot>
</table>