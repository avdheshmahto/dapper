<?php
$queryInspection=$this->db->query("select *from tbl_product_inspection where productionid='".$_GET['id']."'");
$getInspection=$queryInspection->row();

$queryProduct=$this->db->query("select *from tbl_product_stock where product_id='$getInspection->product_id'");
$getProduct=$queryProduct->row();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Inspection</title>
<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/po_css/style.css' />
</head>

<body>

<div id="page-wrap">
<table id="items">
<tr>
<td colspan="6"><img src="<?=base_url();?>assets/po_css/images/logo.png" alt="" /></td>
<td colspan="9" style="text-align:center;"><h2>Inspection</h2></td>
</tr>
<tr>
<td colspan="16" style="text-align:center;"><strong>D.S.I.D.C. SHED NO. 59, SCHEME III, PHASE-II, OKHLA IND. AREA, NEW DELHI-110 020<br />
  Ph. :011-26386345, 65656328</strong>
  </td>
</tr>
<tr>
<td colspan="16" style="text-align:center;"><h2>TEST REPORT OF <?=$getProduct->productname;?></h2>
  </td>
</tr>

<tr>
<td colspan="2"><strong>Item:-</strong>&nbsp;<?=$getProduct->productname;?><br /></td>
<td colspan="4"><strong>Qty:-</strong>1000<br /></td>
<td colspan="4"><strong>Date</strong></td>
<td colspan="4"><strong><?php echo date('d/m/Y');?></strong></td>
</tr>


<tr>
<th rowspan="2">S.No</th>
<th rowspan="2">Test  Parameter</th>
<th rowspan="2">Specification 1</th>
<th rowspan="2">Specification 2</th>
<th colspan="10"><center>Observation</center></th>
</tr>

<tr>
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
<td>9</td>
<td>10</td>
</tr>


<?php
$delivery_period_query=$this->db->query("select *from tbl_product_inspection where productionid='".$_GET['id']."' ");
$i=1;

foreach($delivery_period_query->result() as $getDeliveryPeriod){
	
	
$productQuery=$this->db->query("select *from tbl_product_inspection where productionid='".$_GET['id']."' and product_id='$getDeliveryPeriod->product_id' and test_param='$getDeliveryPeriod->test_param'");
$getProduction=$productQuery->row();	
	
?>
<tr>
<td><?=$i;?></td>
<td><?=$getDeliveryPeriod->test_param;?></td>
<td><?=$getDeliveryPeriod->test_param;?></td>
<td><?=$getDeliveryPeriod->test_param;?></td>
<td><?=$getDeliveryPeriod->insp1;?></td>
<td><?=$getDeliveryPeriod->insp2;?></td>
<td><?=$getDeliveryPeriod->insp3;?></td>
<td><?=$getDeliveryPeriod->insp4;?></td>
<td><?=$getDeliveryPeriod->insp5;?></td>
<td><?=$getDeliveryPeriod->insp6;?></td>
<td><?=$getDeliveryPeriod->insp7;?></td>
<td><?=$getDeliveryPeriod->insp8;?></td>
<td><?=$getDeliveryPeriod->insp9;?></td>
<td><?=$getDeliveryPeriod->insp10;?></td>
</tr>

<?php $i++; }?>







<tr>
<td colspan="2"><strong>&nbsp;</strong></td>
<td colspan="13"><strong>&nbsp;</strong><br />
&nbsp;</td>
</tr>
</table>
</div>
</body>
</html>