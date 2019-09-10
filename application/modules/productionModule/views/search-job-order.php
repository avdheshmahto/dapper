<?php
  $this->load->view("header.php");
?>

<!-- Main content -->
<div class="main-content">
  <div class="panel-body panel panel-default">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body_____">
          <div class="row centered-form">
            <div class="col-xs-12 col-sm-12">
              <div class="panel panel-default____">
                <div class="panel-heading" style="background-color: #F5F5F5; color:#fff; border-color:#DDDDDD;">
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Job Order Search:-</span>
                  </h3>
                </div>
                <form method="get">
                  <div class="panel-body" style="padding:15px 0px;">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <h4>Vendor Name</h4>
                          <select name="vendor_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                              $vendor_query=$this->db->query("select *from tbl_contact_m where group_name='5' AND vendor_type='Production' ");
                              foreach($vendor_query->result() as $getVendor){
                              ?>
                            <option value="<?=$getVendor->contact_id;?>" <?php if($_GET['vendor_id'] == $getVendor->contact_id ) { ?> selected <?php } ?> ><?=$getVendor->first_name;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <h4>Shape</h4>
                        <div class="form-group">
                          <select name="shape_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                              $product_query=$this->db->query("select *from tbl_product_stock where type='33'");
                              foreach($product_query->result() as $getProduct){
                              ?>
                            <option value="<?=$getProduct->Product_id;?>" <?php if($_GET['shape_id'] == $getProduct->Product_id ) { ?> selected <?php } ?> ><?=$getProduct->productname;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6" style="display: none;">
                        <h4>Select</h4>
                        <div class="form-group">
                          <select class="form-control" name="type" id="select_id" >
                            <option value="">--Select--</option>
                            <option value="Shape" <?php if($_GET['type'] == 'Shape') { ?> selected <?php } ?> >Shape Complete</option>
                            <option value="ShapePart" <?php if($_GET['type'] == 'ShapePart') { ?> selected <?php } ?> >Shape in Parts</option>
                          </select>
                        </div>
                      </div>                      
                      <div class="col-xs-6 col-sm-6 col-md-6" style="display: none;">
                        <div class="form-group">
                          <h4>Part Name</h4>
                          <select name="part_id" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                              $part_query=$this->db->query("select *from tbl_product_stock where type='32'");
                              foreach($part_query->result() as $getPart){
                              ?>
                            <option value="<?=$getPart->Product_id;?>" <?php if($_GET['part_id'] == $getPart->Product_id) { ?> selected <?php } ?> ><?=$getPart->productname;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                          &nbsp;
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <h4>&nbsp;</h4>
                          &nbsp;
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                        <input type="submit" name="Search" value="Search" class="btn btn-sm">
                        <button type="reset" class="btn btn-sm" onclick="resetPageUrl();">Reset</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Order</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane  active" id="home">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example1"  id="listingData">
                      <thead>
                        <tr>
                          <th>Order Type</th>
                          <th>Shape/Part</th>
                          <th>Order no.</th>
                          <th>Vendor Name</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          @extract($_GET);
                          if($Search!='')
                          {
                          
                					$qry = "select * from tbl_job_work where order_type='Job Order' ";
                	         
                             if($vendor_id != "")                                   
                               $qry .= " AND vendor_id = '$vendor_id'";
                					
                             if($type!= "")
                              $qry .= " AND type = '$type'";

                					   if($shape_id!= "")
                						  $qry .= " AND shape_id = '$shape_id'";
                					                            					                             						
                						 if($part_id != "")
                					     $qry .= " AND part_id LIKE '%".$part_id."%'";
                						 
                						 
                						 
                						 
                						$queryData=$this->db->query($qry); 
                						 
                            foreach($queryData->result() as $fetch_list)
                            {
                            
                          ?>
                        <tr class="gradeU record">
                          <td>
                            <p style="display:none" id="lot_no"><?=$_GET['id'];?></p>
                            <p style="display:none" id="order_type"><?=$fetch_list->order_type;?></p>
                            <a target="_blank" href="<?=base_url();?>productionModule/manage_jobwork_map_details?id=<?=$fetch_list->id;?>&&p_id=<?=$fetch_list->production_id;?>"><?=$fetch_list->order_type;?></a>
                            
                            <!-- <button style="display:none" type="button" class="btn btn-default modalMapSpare" onclick="Order('<?=$fetch_list->job_order_no;?>');" data-toggle="modal" data-target="#modal-order"><?=$fetch_list->order_type;?></button> -->

                          </td>
                          <td><?=$fetch_list->type;?></td>
                          <td>
                            <?=$fetch_list->job_order_no;?>
                          </td>
                          <?php 
                            $sqlQueryMachineIdview=$this->db->query("select * from tbl_contact_m where contact_id ='$fetch_list->vendor_id'  and status = 'A' ");                            
                            $getMachineIdview=$sqlQueryMachineIdview->row();
                            
                          ?>
                          <td>
                            <?=$getMachineIdview->first_name;?>
                          </td>
                          <td><?=$fetch_list->date;?></td>
                          <td>Pending</td>
                          <td><?php $pri_col='id';
                            $table_name='tbl_schedule_triggering';
                            ?>
                            <button class="btn btn-default" onclick="viewWorkOrder(<?=$fetch_list->id;?>);" data-toggle="modal" data-target="#modal-3" type="button" ><i class="fa fa-eye"></i></button>
                            <a target="_blank" href="<?=base_url();?>productionModule/print_challan?id=<?=$fetch_list->id;?>"><img src="<?=base_url();?>assets/images/print1.png" /></a>		
                          </td>
                        </tr>
                        <?php  } }?>
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
              <!-- starts-->
              <!-- ends -->
            </div>
          </div>
          <!--tabs-container close-->
        </div>
      </div>
    </div>
  </div>
</div>
<!--main-content close-->
<?php
  $this->load->view("footer.php");
  ?>
<!-- view production Starts here -->
<div id="modal-3" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Job Order Issue</h4>
        <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div class="modal-body">
        <div class="row" id="viewWork">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

<script type="text/javascript">
  
  function viewWorkOrder(v)
  {
    
    var pro=v;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "productionModule/view_work_order?ID="+pro, false);
    xhttp.send();
     document.getElementById("viewWork").innerHTML = xhttp.responseText;
  }

  function resetPageUrl()
  {
      location.href="<?=base_url();?>productionModule/search_job_order";
  }

</script>