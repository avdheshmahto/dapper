<thead>
  <tr>
    <th>Order Type</th>
    <th>order no.</th>
    <th>Vendor Name</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php
    $queryData=$this->db->query("select *from tbl_job_work  where production_id='$id'");
      foreach($queryData->result() as $fetch_list)
      {
      
    ?>
  <tr class="gradeU record">
    <td>
      <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
      <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
      <a href="<?=base_url();?>productionModule/manage_jobwork_map_details?id=<?=$fetch_list->id;?>"><?=$fetch_list->order_type;?></a></button>
    </td>
    <td><?=$fetch_list->job_order_no;?></td>
    <?php 
      $sqlQueryMachineIdview=$this->db->query("select * from tbl_contact_m where contact_id ='$fetch_list->vendor_id'  and status = 'A' ");
      
      $getMachineIdview=$sqlQueryMachineIdview->row();
      
      ?>
    <td>
      <?=$getMachineIdview->first_name;?>
    </td>
    <td><?=$fetch_list->date;?></td>
    <td>Pending</td>
    <td><?php $pri_col='id';
      $table_name='tbl_schedule_triggering';
      ?>
      <button class="btn btn-default" onclick="viewWorkOrder(<?=$fetch_list->id;?>);" data-toggle="modal" data-target="#modal-3" type="button" ><i class="fa fa-eye"></i></button>
      <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
    </td>
  </tr>
  <?php  }?>
  <tr class="gradeU">
    <td>
      <button type="button" class="btn btn-default modalMapSpare" data-toggle="modal" data-target="#modal-2"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</tbody>
<tfoot>
  <!--<button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>-->
</tfoot>