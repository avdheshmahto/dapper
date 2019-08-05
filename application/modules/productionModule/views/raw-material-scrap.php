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
                  <h3 class="panel-title" style="float: initial;"><span style="color:#000;">Raw Material Scrap Order
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
                              $vendor_query=$this->db->query("select *from tbl_contact_m where group_name='5'");
                              foreach($vendor_query->result() as $getVendor){
                              ?>
                            <option value="<?=$getVendor->contact_id;?>" <?php if($_GET['vendor_id'] == $getVendor->contact_id) { ?> selected <?php } ?> ><?=$getVendor->first_name;?></option>
                            <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <h4>Search</h4>
                        <div class="form-group">
                          <input type="submit" name="Search" value="Search" class="btn btn-sm">
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
                          <th class="tdcenter"> Sl No</th>
                          <th class="tdcenter">Item Number</th>
                          <th class="tdcenter">Description</th>
                          <th class="tdcenter">Usage Unit</th>
                          <th class="tdcenter">Net Weight</th>
                          <th class="tdcenter">Cast Weight</th>
                          <th class="tdcenter">Total Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          @extract($_GET);
                          if($Search!='')
                          {
                
                					  $qry = "select *from tbl_product_stock where type='13'";
                						$queryData=$this->db->query($qry); 

                          	$i=1;		 
                            foreach($queryData->result() as $fetch_list)
                            {
                          	  $unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$fetch_list->usageunit'");
                          	  $getUnit=$unitQuery->row();
                           
                          
                          ?>
                        <tr class="gradeX odd" role="row">
                          <td class="size-60 text-center sorting_1"><?=$i;?></td>
                          <td><a href="productionModule/manage_scrap_job_work?scrap_id=<?=$fetch_list->Product_id;?>&vendor_id=<?=$_GET['vendor_id'];?>"><?=$fetch_list->sku_no;?></a>
                          <td><?=$fetch_list->productname;?>
                            <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                          </td>
                          <td><?=$getUnit->keyvalue;?></td>
                          <?php
                            $netWeightQuery=$this->db->query("select *from tbl_issuematrial_dtl where productid='$fetch_list->Product_id'");
                            $getNetWeight=$netWeightQuery->row();
                            
                            ?>
                          <td><?=$getNetWeight->receive_qty;?></td>
                          <td><?=$getNetWeight->receive_qty;?>                                            </td>
                          <td><?=$getNetWeight->order_qty;?></td>
                        </tr>
                        <?php 
                          $i++;
                          
                          }}
                          ?>
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
