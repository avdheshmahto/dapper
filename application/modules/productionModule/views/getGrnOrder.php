<table class="table table-striped table-bordered table-hover dataTables-example1" >
  <thead>
    <tr>
      <th style="display:none">Lot No.</th>
      <th>Grn No.</th>
      <th>Grn Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $queryData=$this->db->query("select *from tbl_production_order_log where job_order_id='$id' and grn_type='Job Order' group by grn_no");
        foreach($queryData->result() as $fetch_list)
        {
        
      ?>
    <tr class="gradeU record">
      <td style="display:none">
        <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
        <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
        <?=$fetch_list->lot_no;?>
      </td>
      <td><?=$fetch_list->grn_no;?></td>
      <td><?=$fetch_list->grn_date;?></td>
      <td><?php $pri_col='id';
        $table_name='tbl_schedule_triggering';
        ?>
        <a href="#" title="GRN VIEW" data-toggle="modal" data-target="#model-view-production-log" onclick="view_production_log('<?=$fetch_list->grn_no;?>');"><i class="fa fa-eye"></i></a>&nbsp;
        <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>    
      </td>
    </tr>
    <?php  }?>
    <tr class="gradeU">
      <td style="display:none">&nbsp;</td>
      <td>
        <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
        <p style="display:none" id="order_type"><?=$getsched->order_type;?></p>
        <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><img src="<?=base_url();?>assets/images/plus.png" /></button>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>