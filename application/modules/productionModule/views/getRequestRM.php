
                      <thead>
                        <tr>
                          <th style="width:150px;">Request No.</th>
                          <th>Date</th>
                          <th>Qty</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $poquery=$this->db->query("select *from tbl_issuematrial_hdr where po_no='$id'");
                          foreach($poquery->result() as $getPo){
                          ?>
                        <tr class="gradeC record">
                          <th><?=$getPo->request_no;?></th>
                          <th><?=$getPo->date;?></th>
                          <th>
                            <?php
                              $poquery=$this->db->query("select SUM(receive_qty) as qty from tbl_issuematrial_dtl where status='A' and inboundrhdr='$getPo->inboundid'");
                              $getQty=$poquery->row();
                              
                              
                              $poquerygrnLog=$this->db->query("select SUM(receive_qty) as qty from tbl_receive_matrial_grn_log where status='A' and po_no='$getPo->po_no'");
                              $getQtygrnLog=$poquerygrnLog->row();
                              
                              
                              ?>
                            <?php echo (round($getQty->qty,3));?>
                          </th>
                          <th>
                            <?php
                              $poqueryC=$this->db->query("select SUM(remaining_qty) as qtyC from tbl_issuematrial_dtl where status='A' and inboundrhdr='$sales->inboundid'");
                              $getQtC=$poqueryC->row();
                              
                              if($getPo->status=='2')
                              {
                              echo "Completed";
                              }
                              elseif($getPo->status=='3')
                              {
                                echo "Partital Completed";
                              }
                              elseif($getPo->status=='1')
                              {
                              echo "Force Close"; 
                              }
                              else
                              {
                                echo "Open";
                                }
                              ?>
                          </th>
                          <th>
                         
                            <input type="hidden" id="p_n" value="<?=$getPo->po_no;?>" />
                            <button title="View RM request" class="btn btn-default" onclick="viewRawRequest(<?=$getPo->inboundid;?>);" data-toggle="modal" data-target="#modal-rawRequest" type="button" ><i class="fa fa-eye"></i></button>
                            <button title="View RM Receive Log" class="btn btn-default" onclick="viewChallanLog('<?=$getPo->inboundid;?>^<?=$getPo->po_no;?>');" data-toggle="modal" data-target="#modal-ChallanLog" type="button" ><i class="fa fa-eye"></i></button>
                            <a style="display:none" href="<?=base_url();?>productionModule/manage_jobwork_map_rm_details?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/click.png" height="25" width="50" /></a>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_request_challan?id=<?=$getPo->inboundid;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>    
                          </th>
                        </tr>
                        <?php }?>
                        <tr class="gradeU">
                          <td>
                            <?php
                              $issueHdrQuery=$this->db->query("select *from tbl_issuematrial_hdr where po_no='$id'");
                              $getIssueHdr=$issueHdrQuery->row();
                              
                              
                              $issueHdrValQuery=$this->db->query("select *from tbl_issuematrial_hdr where job_order_no='$getIssueHdr->job_order_no'");
                              $getIssuValeCnt=$issueHdrValQuery->num_rows();
                              
                              if($getIssuValeCnt=='0')
                              {
                              ?>
                            <button type="button" class="btn btn-default modalMapSpare1" data-toggle="modal" data-target="#modal-6"><img src="<?=base_url();?>assets/images/plus.png" /></button> 
                            <?php }?>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    
                    