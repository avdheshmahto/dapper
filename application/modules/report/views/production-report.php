<?php
  $this->load->view("header.php");
  require_once(APPPATH.'core/my_controller.php');
  $obj=new my_controller();
  $CI =& get_instance();
  $table_name_1='tbl_product_stock';
  $pri_id='Product_id';
  $field_name='productname';
  ?>
<!-- Main content -->
<div class="main-content">
<?php
  $this->load->view("reportheader");
  ?>
<?php
  $p_name = "";$p_id="";$f_date="";$t_date="";
   if($this->input->post() != "") { 
   $p_name = $this->input->get('p_name');
   $p_id   = $this->input->get('p_id');
   $f_date = $this->input->get('f_date');
   $t_date = $this->input->get('t_date');
   $type = $this->input->get('type');
   } ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h4 class="panel-title">PRODUCTION REPORT  </h4>
        <ul class="panel-tool-options">
          <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
        </ul>
      </div>
      <div class="panel-body" style="padding: 20px 0px;margin-bottom:25px;">
        <form class="form-horizontal" method="get" action="<?=base_url('report/Report/searchProduction');?>">
          <div class="form-group ">
            <label class="col-sm-2 control-label">Contact Name</label> 
            <div class="col-sm-3"> 
              <input type="text" name="p_name" class="form-control" value="<?php echo $p_name;?>" Placeholder="Contact Name"/>
            </div>
            <label class="col-sm-2 control-label">Product Name</label> 
            <div class="col-sm-3">
              <select class="form-control" name="p_id">
                <option value="">-- Select Finish Good --</option>
                <?php   
                  if($getfinishgood != ""){
                  foreach($getfinishgood as $dt){ ?>
                <option value="<?=$dt['Product_id'];?>" <?php if($p_id == $dt['Product_id']){ ?> selected <?php } ?> ><?=$dt['productname'];?></option>
                <?php }} ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">From Date</label> 
            <div class="col-sm-3"> 
              <input type="date" name="f_date" class="form-control" value="<?php echo $f_date;?>" /> 
            </div>
            <label class="col-sm-2 control-label">To Date</label> 
            <div class="col-sm-3"> 
              <input type="date" name="t_date" class="form-control" value="<?php echo $t_date;?>" /> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Production Type</label> 
            <div class="col-sm-3">
              <select class="form-control" name="type">
                <option value="">-- Select Type --</option>
                <option value="Overlock" <?php if($type == 'Overlock'){ ?> selected <?php } ?> >Overlocking</option>
                <option value="Cutting" <?php if($type == 'Cutting'){ ?> selected <?php } ?> >Cutting</option>
                <option value="Raphu" <?php if($type == 'Raphu'){ ?> selected <?php } ?> >Raphu</option>
                <option value="Packing" <?php if($type == 'Packing'){ ?> selected <?php } ?> >Packing</option>
              </select>
            </div>
            <div class="col-sm-3" > 
              <button type="submit" name="Show" class="btn btn-sm" value="Show" style="float: right;    margin-right: -104px;"> Search </button>
              <a href="<?=base_url('report/Report/searchProduction');?>"  class="btn btn-sm" style="float: right;"> Clear </a>
            </div>
          </div>
        </form>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover dataTables-example1" >
            <thead>
              <tr>
                <th>Contact Name</th>
                <th>Date</th>
                <th>Finish Good</th>
                <th>Type</th>
                <th>Qty</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
                $yy=1;
                if(!empty($masterCuttingSearch)) {
                foreach($masterCuttingSearch as $rows) {
                ?>
              <tr class="gradeC record">
                <th><?php echo $rows['first_name'];?></th>
                <th><?php echo $rows['log_date'];?></th>
                <th><?php echo $rows['productname'];?></th>
                <th><?php if($rows['production_status'] == 'Cutting'){ 
                  echo $rows['production_status'].' ( '.$rows['log_qty'].' ) &nbsp;&nbsp; Raphu ( '.$rows['raphu'].' ) '; 
                  }else{
                    echo $rows['production_status'];
                  } ?></th>
                <th><?php if($rows['production_status'] == 'Raphu'){ 
                  echo $rows['raphu'];
                     }elseif($rows['production_status'] == 'Cutting'){
                     echo $rows['log_qty']+$rows['raphu'];
                     }else{
                     echo $rows['log_qty']; 
                     } ?></th>
                <!-- <th><button class="btn btn-default" type="button" data-toggle="modal" onClick="openpopup('<?=base_url();?>report/Report/view_production',1400,600,'id',<?=$rows->productionid;?>)" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button></th> -->
              </tr>
              <?php } } ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="col-md-6 text-left">
              <!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
            </div>
            <div class="col-md-6"> 
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>