<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Item.php');
$objj=new Item();

$list='';

$list=$objj->item_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_product_stock';

?>
<script>


function getCid(pnm,pr,pp,unt)
{

	window.close();
	var pid=pnm.split("^");
	var pids=pid[1];
	window.opener.document.getElementById("prd").value=pnm;
	window.opener.document.getElementById("qn").value=1;
	window.opener.document.getElementById("lpr").innerHTML=pp;
	window.opener.document.getElementById("lph").value=pp;
	window.opener.document.getElementById("tot").value=pp;
	window.opener.document.getElementById("nettot").value=pp;
	window.opener.document.getElementById("pri_id").value=pids;
	window.opener.document.getElementById("usunit").value=unt;
	window.opener.document.getElementById("qn").focus();
	
	
}
</script>
	 <!-- Main content -->
	 <div class="main-content">
			
			<!-- Breadcrumb -->
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Product List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th>&nbsp;</th>
	   <th>Product Code </th>
		<th>Category</th>
        <th>Product Name</th>
      	<th>Purchase Price</th>
        <th>Sale Price</th>
		 <th>Mrp</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
 
  
  ?>

<tr class="gradeC record">
<td><input type="radio"  onclick="getCid('<?=$list[$i]['3']."^".$list[$i]['1'];?>','<?php echo $list[$i]['4'];?>','<?php echo $list[$i]['5'];?>','<?php echo $list[$i]['8'];?>')" name="p" /></td>
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
<th><?=$list[$i]['3'];?></th>
<th><?=$list[$i]['4'];?></th>
<th><?=$list[$i]['5'];?></th>
<th><?=$list[$i]['6'];?></th>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>