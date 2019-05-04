<table class="table table-striped table-bordered table-hover dataTables-example1"  >
<thead>
	<tr>

		<th style="width:150px;">Check No.</th>
	   
		  <th>Date</th>
     
	<th style="display:none">Status</th>
        <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$poquery=$this->db->query("select *  from tbl_production_order_check where status='A' and job_order_id='$id' group by check_no");
foreach($poquery->result() as $getPo){
?>
<tr class="gradeC record">

<th><?=$getPo->check_no;?></th>
<th><?=$getPo->check_date;?></th>


<?php

$poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
$getQty=$poquery->row();

// tbl_receive_matrial_grn_log query


//echo "select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->inboundid'";

$poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
$getQtygrnLog=$poquerygrnLog->row();


?>


<th style="display:none">
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

<button class="btn btn-default" onclick="viewChecking('<?=$getPo->check_no;?>');" data-toggle="modal" data-target="#modal-checking" type="button" ><i class="fa fa-eye"></i></button>
<a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>

 
  <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
</th>
</tr>
<?php }?>

<tr class="gradeU">
<td>

 
 
 <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order_check('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order-checking"><img src="<?=base_url();?>assets/images/plus.png" /></button>
 
 
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