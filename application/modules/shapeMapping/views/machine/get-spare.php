<thead>
  <tr>
    <th>Code</th>
    <th>Part  Name</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php
    $i=1;
    foreach($result as $fetch_list)
     {
     // echo $fetch_list->spare_id;
      $spareName = $this->db->query("select * from tbl_product_stock where Product_id='$fetch_list->spare_id'");
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
    <td>
      <?php 
        $pri_col='id';
        $table_name='tbl_machine_spare_map';
        ?>
      <?php if($edit!=''){ ?>
      <!--<a arrt='<?=json_encode($getSpareD);?>' onclick ="editRow(this);" class="btn btn-default"  data-toggle="modal" data-target="#modal-0" >&nbsp; <i class="fa fa-eye"></i>&nbsp; </a> -->
      <!-- <button class="btn btn-default" property="view" arrt= '<?=json_encode($getSpareD);?>' onclick ="editItem(this);" type="button" data-toggle="modal" data-target="#modal-0" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i></button>
        --><?php }?>
      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop="static" data-keyboard="false" title=" View Contact Mapping" onclick="mappingQtybyproduct(<?=$fetch_list->spare_id;?>,<?=$_GET['id'];?>,'part');"><i class="icon-flow-tree"></i></button> 
      <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-3" type="button" data-backdrop="static" data-keyboard="false" title=" fa fa-eye" onclick="viewmappingQtybyproduct(<?=$getMachine1->Product_id;?>,<?=$_GET['id'];?>);"><i class="fa fa-eye"></i></button>
      <button class="btn btn-default delbutton" id="<?php echo $fetch_list->id."^".$table_name."^".$pri_col; ?>" type="button"><i class="icon-trash"></i></button>
      <!--  -->
    </td>
  </tr>
  <?php }?>
  <tr class="gradeU">
    <td>
      <button  class="btn btn-default modalMapSpare" data-a="<?php echo $fetch_list->id;?>" href='#mapSpare'  type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false' formid = "#mapSpareForm" id="formreset"><img src="<?=base_url();?>assets/images/plus.png" /></button>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</tbody>
<tfoot>
</tfoot>