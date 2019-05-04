<table class="table table-striped table-bordered table-hover dataTables-example1"  id="loadSpare">
<thead>
<tr>
<th>Code</th>
<th>Part  Name</th>
<th style="display:none;">Action</th>
</tr>
</thead>
<tbody>
<?php
  $i=1;
  $queryPart=$this->db->query("select *from tbl_shape_part_mapping where product_id='$part_id'");
  foreach($queryPart->result() as $fetch_list)
   {
   //	echo $fetch_list->spare_id;
    $spareName = $this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->part_id'");
    $getSpareD = $spareName->row();
?>
<tr class="gradeU record">
  <td><?=$getSpareD->sku_no;?></td>
  <td><?=$getSpareD->productname;?></td>
  <!--
  <td><?php 
	$compQuery = $this -> db
	-> select('*')
		           -> where('id',$getSpareD->category)
		           -> get('tbl_category');
		 $compRow = $compQuery->row();
         echo $compRow->name;
    ?></td>
   <td><?=$getSpareD->unitprice_purchase;?></td>
   -->

<td style="display:none">
<?php 
	$pri_col='id';
	$table_name='tbl_machine_spare_map';
?>
<?php if($edit!=''){ ?>

<!--<a arrt='<?=json_encode($getSpareD);?>' onclick ="editRow(this);" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" >&nbsp; <i class="fa fa-eye"></i>&nbsp; </a> -->
<!-- <button class="btn btn-default" property="view" arrt= '<?=json_encode($getSpareD);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
 --><?php }?>

<button  class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop="static" data-keyboard="false" title=" View Contact Mapping" onclick="mapiingPartRowMat(<?=$fetch_list->part_id;?>,<?=$fetch_list->product_id;?>,'part');"><i class="icon-flow-tree"></i></button>	

	<button  class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-10" type="button" data-backdrop="static" data-keyboard="false" title=" fa fa-eye" onclick="mapiingPartRowMatView(<?=$fetch_list->part_id;?>,<?=$fetch_list->product_id;?>,'part');"><i class="fa fa-eye"></i></button>
<!--  -->
</td>
</tr>
<?php }?>


</tbody>
<tfoot>

</tfoot>
</table>