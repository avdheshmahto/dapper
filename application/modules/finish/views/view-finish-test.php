<?php
$queryData=$this->db->query("select *from tbl_job_work where id='$id'");
$getData=$queryData->row();
?><form class="form-horizontal" role="form"  enctype="multipart/form-data"   id ="myProduction_purchase" action="#" 
        onsubmit="return submitProductionPurchase();"method="POST"> 
<div class="modal-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th rowspan="2">Sr. No.</th>
<th rowspan="2">Check Point</th>
<th rowspan="2" >Requirement</th>
<th rowspan="2" >Method of inspection</th>
<th colspan="10" ><center>Observation</center></th>
</tr>
<tr class="gradeA">
<input type="hidden" name="productionid" value="<?=$_GET['id'];?>">
<input type="hidden" name="type" value="Purchase Order">
<th >1</th>
<th >2</th>
<th >3</th>
<th >4</th>
<th >5</th>
<th >6</th>
<th >7</th>
<th >8</th>
<th >9</th>
<th >10</th>
</tr>
<?php
/*$m=0;
$delivery_period_query=$this->db->query("select *from tbl_product_test_para where product_id='".$_GET['p_id']."' or product_id='$branchFetch->product_id'");

$numCnt=$delivery_period_query->num_rows();
if($numCnt==0)
{
	?>
	

<?php }
	
	$i=1;

foreach($delivery_period_query->result() as $getDeliveryPeriod){
	
	
$productQuery=$this->db->query("select *from tbl_product_inspection where productionid='".$_GET['id']."' and product_id='$getDeliveryPeriod->product_id' and test_param='$getDeliveryPeriod->test_param' and type='Purchase Order'");
$getProduction=$productQuery->row();	
*/
?>
<tr class="gradeA" data-row-id="<?php echo $getProduction->purchaseorderid; ?>">
<th >
<?=$i;?></th>

<th style="width:180px;">

<input type="hidden" name="p_id[]" value="<?php echo $getDeliveryPeriod->product_id; ?>">
<input type="text" name="test_param[]" value="<?=$getDeliveryPeriod->test_param;?>"      tabindex="5" class="form-control" ></th>

<th style="width:200px;" >
<input type="text" name="specification[]" value="<?=$getDeliveryPeriod->specification;?>"  class="form-control"></th>

<th style="width:200px;" >
<input type="text" name="specification2[]" value="<?=$getDeliveryPeriod->specification2;?>"  class="form-control"></th>

<th >
<input type="text" name="insp1[]" value="<?=$getProduction->insp1;?>"  class="form-control"></th>
<th >
<input type="text" name="insp2[]" value="<?=$getProduction->insp2;?>"  class="form-control"></th>
<th >
<input type="text" name="insp3[]" value="<?=$getProduction->insp3;?>"  class="form-control"></th>
<th >
<input type="text" name="insp4[]" value="<?=$getProduction->insp4;?>"  class="form-control"></th>
<th >
<input type="text" name="insp5[]" value="<?=$getProduction->insp5;?>"  class="form-control"></th>
<th >
<input type="text" name="insp6[]" value="<?=$getProduction->insp6;?>"  class="form-control"></th>
<th >
<input type="text" name="insp7[]" value="<?=$getProduction->insp7;?>"  class="form-control"></th>
<th >
<input type="text" name="insp8[]" value="<?=$getProduction->insp8;?>"  class="form-control"></th>
<th >
<input type="text" name="insp9[]" value="<?=$getProduction->insp9;?>"  class="form-control"></th>
<th >
<input type="text" name="insp10[]" value="<?=$getProduction->insp10;?>"  class="form-control"></th>
</tr>
<?php //$i++; }?>


<tr class="gradeA" >
<th >&nbsp;</th>
<th style="width:180px;">&nbsp;</th>
<th style="width:200px;" >&nbsp;</th>
<th style="width:200px;" >&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th >&nbsp;</th>
<th >&nbsp;</th>
<th >&nbsp;</th>
<th >&nbsp;<th></tr>

<input type="hidden" name="poid" value="<?php echo $getDtl->purchaseorderdtlid;?>">



</tbody>
</table>
 <input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">

<div class="modal-footer">
<input type="submit" class="btn btn-sm" id="add_req" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
</div>   

</div>



</div>
