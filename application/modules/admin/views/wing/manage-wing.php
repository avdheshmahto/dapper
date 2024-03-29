<?php
  $this->load->view("header.php");
  $this->load->view("javascriptPage.php");
  require_once(APPPATH.'modules/admin/controllers/wing.php');
  $objj=new Wing();
  $CI =& get_instance();
  
  $list='';
  
  $list=$objj->wing_list();	
  require_once(APPPATH.'core/my_controller.php');
  $obj=new my_controller();
  $CI =& get_instance();
  $tableName='tbl_wing_mst';
  
  ?>
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2">
  <?php if($add!='')
    { ?>
  <li><a class="btn btn-success" href="<?=base_url();?>admin/wing/add_wing">Add Department/Wing</a></li>
  <?php }?> 
  <li>
    <a type="button" class="btn btn-danger delete_all">Delete Selected</a>
  </li>
</ol>
<ol class="breadcrumb breadcrumb-2">
  <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
  <li><a href="#">Admin Setup</a></li>
  <li><a href="#">Department</a></li>
  <li class="active"><strong><a href="#">Manage Department</a></strong></li>
</ol>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h4 class="panel-title"><strong>Manage Department/Wing</strong></h4>
        <ul class="panel-tool-options">
          <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
              <tr>
                <th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                <th>Wing Code</th>
                <th>Wing Name</th>
                <th>Branch Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0,$j=1;$i<count($list);$i++,$j++)
                {
                	$divnid= $list[$i]['4'];
                
                	$checkDepartment= $obj->departmentCheck($divnid);
                  ?>
              <tr class="gradeC record" data-row-id="<?php echo $list[$i]['4']; ?>">
                <td>
                  <?php
                    if($checkDepartment=='1')
                    {
                    ?>
                  <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['4']; ?>" value="<?php echo $list[$i]['4'];?>" />
                  <?php } else{
                    ?>
                  <spam data-id="" title="User already created for this Department.you can not delete ?"   />
                  *</spam>
                  <?php } ?>    
                </td>
                <th><?=$list[$i]['1'];?></th>
                <th><?=$list[$i]['2'];?></th>
                <th><?=$list[$i]['3'];?></th>
                <th>
                  <?php if($view!='')
                    { ?>
                  <a href="#" onClick="openpopup('add_wing',1200,500,'view',<?=$list[$i]['4'];?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>
                  &nbsp;&nbsp;&nbsp;
                  <?php } 
                    if($edit!='')
                    { ?>
                  <a href="#" onClick="openpopup('add_wing',1200,500,'id',<?=$list[$i]['4'];?>)"><i class="glyphicon glyphicon-pencil"></i>
                  <?php 
                    } if($delete!='')
                    { 
                    	if($checkDepartment=='1')
                    	{
                    		$pri_col='divn_id';
                    		$table_name='tbl_wing_mst';
                    		?>
                  &nbsp;&nbsp;&nbsp;
                  <a href="#" id="<?php echo $list[$i]['4']."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
                  <?php
                    }
                    else
                    {?>
                  <a href="#" onclick="return confirm('User already Created for this Department.you can not delete ?');" class="icon"><i class="glyphicon glyphicon-remove"></i></a>
                  <?php } 
                    } ?>
                </th>
              </tr>
              <?php } ?>
            </tbody>
            <input type="text" style="display:none;" id="table_name" value="tbl_wing_mst">  
            <input type="text" style="display:none;" id="pri_col" value="divn_id">
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>