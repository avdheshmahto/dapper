<table class="table table-striped table-bordered table-hover dataTables-example1"  >
  <thead>
    <tr>
      <th style="width:150px;">Purchase Order No.</th>
      <th>Date</th>
      <th>Vendor Name</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $poquery=$this->db->query("select *from tbl_po_order where status='A' and production_id='$id'");
      foreach($poquery->result() as $getPo){
      ?>
    <tr class="gradeC record" id="listingPurchaseData">
      <th><?=$getPo->purchaseid;?></th>
      <th><?=$getPo->date;?></th>
      <th>
        <?php
          $vendorQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getPo->vendor_id'");
          $getVendor=$vendorQuery->row();
          
          ?>
        <?=$getVendor->first_name;?>
      </th>
      <th>Pending</th>
      <th>
        <button class="btn btn-default" onclick="viewPurchaseOrder(<?=$getPo->purchaseid;?>);" data-toggle="modal" data-target="#modal-6" type="button" ><i class="fa fa-eye"></i></button>
        <a style="display:none" href="<?=base_url();?>addproduction/print_invoice?id=<?=$getPo->purchaseid;?>" class="btn btn-default" target="blank"><i class="glyphicon glyphicon-print"></i></a>
        <a target="_blank" href="<?=base_url();?>productionModule/print_po_challan?id=<?=$getPo->purchaseid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
      </th>
    </tr>
    <?php }?>
    <tr class="gradeU">
      <td>
        <button type="button" class="btn btn-default modalMapSpare" data-toggle="modal" data-target="#modal-5"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
  <!--<tbody>
    <tr class="gradeX">
    <td>Misc</td>
    <td>Lynx</td>
    <td>Text only</td>
    <td>-</td>
    <td>X</td>
    </tr>
    
    
    
    </tbody>-->
</table>