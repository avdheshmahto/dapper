
                      <thead>
                        <tr>
                          <th style="width:150px;">Repair No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_production_order_repair where status='A' and job_order_id='$id'  group by repair_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->repair_no;?></th>
                          <th><?=$getPo->repair_date;?></th>
                          <?php
                            $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                            $getQty=$poquery->row();
                            
                            
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
                          
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button class="btn btn-default" onclick="viewRepairOrder('<?=$getPo->repair_no;?>');" data-toggle="modal" data-target="#modal-view_order_repair" type="button" ><i class="fa fa-eye"></i></button>
                            
                               <button class="btn btn-default delbuttonOrderRepair" id="<?=$getPo->repair_no; ?>" type="button"><i class="icon-trash"></i></button>
                            <a href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>&check_no=<?=$getPo->check_no;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                          <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order_repair('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order-repair"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                      <tfoot>
                     
                      </tfoot>
                    