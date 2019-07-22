<?php if($result != ""){ 
  foreach($result as $dt){ ?>
<h4 style="    margin-bottom: 1px;"><?=$dt['productname'];?> </h4>
<p style="margin: 0 0 0px;">Production Quantity: <?=$dt['dtlqty'];?></p>
<br>
<?php 
  if($dt['rowmatrial'] != ""){ 
     foreach($dt['rowmatrial'] as  $rdata1){
  ?>
<p style="margin-top:-13px; ">Part Name :- <b><?=$rdata1['partname'];?></b></p>
<br>
<table class="table table-striped" style="margin-top: -15px;">
  <thead>
    <tr>
      <th class="text-center">S.No</th>
      <th class="text-center">Product Name</th>
      <th class="text-center">UMO</th>
      <th class="text-center">Rowmatial Qty</th>
      <th class="text-center">Required Qty</th>
      <th class="text-center">Issue Qty</th>
      <th class="text-center">Remaining Qty</th>
      <th class="text-center">Enter Qty</th>
    </tr>
  </thead>
  <tbody>
    <?php  
      if(sizeof($rdata1['partdetails']) >0){ 
         $i=1;
         foreach($rdata1['partdetails'] as  $rdata){
      ?>
    <tr>
      <td class="text-center"><?=$i++;?></td>
      <td class="text-center"><?=$rdata['name'];?></td>
      <td class="text-center"><?=$rdata['unit'];?></td>
      <td class="text-center"><?=$rdata['mqty'];?></td>
      <td class="text-center"><?=$rdata['mqty']*$rdata['dtlqty'];?></td>
      <td class="text-center"><?=$rdata['rec_qty']!=""?$rdata['rec_qty']:'0';?></td>
      <td class="text-center"><?='0';?>
        <input type="hidden" id="rem_qty<?=$i;?>" min="0" name="remaining_qty[]" value="<?=$rdata['rec_qty'];?>" class="form-control">
      </td>
      <td>
        <input type="number" min="1" name="receive_qty[]" id="rec_qty<?=$i;?>" onkeyup="qtyValidation(this.id);" class="form-control">
        <input type="hidden" name="validationCheck" id="validationCheck" value="0">
      </td>
    </tr>
    <?php }}else{ ?>
    <tr>
      <td colspan="7"><b><?=$dt['empty'];?></b></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php }}
  echo "<b>".$dt['empty']."</b>";
  }} ?>