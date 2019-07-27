
                      <thead>
                        <tr>
                          <th style="display:none">Lot No.</th>
                          <th>Grn No.</th>
                          <th>Grn Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $queryData=$this->db->query("select *from tbl_production_order_log where job_order_id='$id' and grn_type='Job Order' group by grn_no");
                            foreach($queryData->result() as $fetch_list)
                            {
                            
                          ?>
                        <tr class="gradeU record">
                          <td style="display:none">
                            <p style="display:none" id="lot_no"><?=$id;?></p>
                            <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
                            <?=$fetch_list->lot_no;?>
                          </td>
                          <td><?=$fetch_list->grn_no;?></td>
                          <td><?=$fetch_list->grn_date;?></td>
                          <td>
                            <a href="#" title="GRN VIEW" data-toggle="modal" data-target="#model-view-production-log" onclick="view_production_log('<?=$fetch_list->grn_no;?>,<?=$fetch_list->order_no;?>');"><i class="fa fa-eye"></i></a>&nbsp;
                            
                         
                      <?php
                       $poquery=$this->db->query("select *  from tbl_production_order_check where status='A' and order_no='$fetch_list->order_no'");
                         $cntData=$poquery->num_rows();
             
                          if($cntData>0)
              {
                          ?>
                       <button class="btn btn-default" onclick="return confirm('Please Delete Child Data First');" type="button"><i class="icon-trash"></i></button>
                          <?php }else{?>
                          <button class="btn btn-default delbuttonOrderGrn" id="<?=$fetch_list->grn_no ?>" type="button"><i class="icon-trash"></i></button>
                          <?php }?>
                         
                            <a target="_blank" href="<?=base_url();?>productionModule/print_challan_grn?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>    
                          </td>
                        </tr>
                        <?php  }?>
                        <tr class="gradeU">
                          <td style="display:none">&nbsp;</td>
                          <td>
                            <p style="display:none" id="lot_no"><?=$id;?></p>
                            <p style="display:none" id="order_type"><?=$getsched->order_type;?></p>
                            <button style="display:none1" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$getsched->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><img src="<?=base_url();?>assets/images/plus.png" /></button>
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                      <tfoot>
                  
                      </tfoot>
                    