
                      <thead>
                        <tr>
                          <th style="width:150px;">RM Return No.</th>
                          <th>Date</th>
                          <th style="display:none">Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *  from tbl_job_rm_return where  job_order_id='$id' group by return_no");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->return_no;?></th>
                          <th><?=$getPo->return_date;?></th>
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
                            <button class="btn btn-default" onclick="viewRMOrderDetails('<?=$getPo->return_no;?>');" data-toggle="modal" data-target="#modal-checking" type="button" ><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_order_repair?id=<?=$getPo->job_order_id;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_rm_return?id=<?=$getPo->return_no;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <button  type="button" class="btn btn-default modalMapSpare" onclick="RM_return('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-purchase-return"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                      <tfoot>
                     
                      </tfoot>
                    