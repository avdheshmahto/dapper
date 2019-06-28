<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class kora extends my_controller {
	
function __construct(){
   parent::__construct();
   $this->load->library('pagination'); 
   $this->load->model('model_kora');
}     

public function manage_stock()
{

  $this->load->view('manage-stock');	
	
}


public function manage_kora(){

	if($this->session->userdata('is_logged_in')){
		$data =  $this->manage_koraJoin();
		$this->load->view('manage-kora',$data);
	}
	else
	{
	redirect('index');
	}		
}



public function view_work_order(){

  $data=array(
    'id' => $_GET['ID']);

  if($this->session->userdata('is_logged_in')){
   
    $this->load->view('view-work-order',$data);
  }
  else
  {
  redirect('index');
  }   
}


public function order_transfer()
{

@extract($_POST);
  $data=array('id' => $id,
    'order_type' => $order_type,
    'lot_no' => $lot_no
  );
  $this->load->view("order-transfer",$data);
}

public function view_transfer_order()
{

  @extract($_POST);
  $data=array('id' => $id,
    'order_type' => $order_type,
    'lot_no' => $lot_no
  );
  $this->load->view("view-transfer-order",$data);
}

public function manage_kora_jobwork_map_details(){

	if($this->session->userdata('is_logged_in')){
		
		$this->load->view('manage-kora-jobwork-map-details');
	}
	else
	{
	redirect('index');
	}		
}


public function order_details()
{

  @extract($_POST);
  $data=array('id' => $id,
  	'order_type' => $order_type,
	 'lot_no' => $lot_no
  );
  $this->load->view("order-details",$data);
}

public function getPart()
{

  @extract($_POST);
  $data=array('id' => $shape,
  'production_id' => $production_id,
  );
  $this->load->view("getpartCode",$data);
}

public function view_kora_order(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('view-kora-order',$data);
  }
  else
  {
  redirect('index');
  }   
}


public function manage_kora_map(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('manage-kora-map',$data);
  }
  else
  {
  redirect('index');
  }   
}


public function order_kora(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('order-kora',$data);
  }
  else
  {
  redirect('index');
  }   
}



function manage_koraJoin(){
  $data['result'] = "";
  $table_name  = 'tbl_production_order_log';
	$url        = site_url('/kora/manage_kora?');
	$sgmnt      = "4";
	$showEntries= 10;
  $totalData  = $this->model_kora->count_kora($table_name,'A',$this->input->get());
  if($_GET['entries']!=""){
    $showEntries = $_GET['entries'];
    $url     = site_url('/kora/manage_kora?entries='.$_GET['entries']);
  }
  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
       //////Pagination end ///
  $data=$this->user_function();      // call permission fnctn
  $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);	
  $data['pagination']        = $this->pagination->create_links();
	
  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_kora->filterProductionList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_kora->getkora($pagination['per_page'],$pagination['page']);
			
     return $data;
  }

public function insert_jobwork()
{

@extract($_POST);
$table_name='tbl_job_work';
$cnt=count($shapeId);
for($i=0;$i<$cnt;$i++){

$data=array(
'vendor_id' => $vendor_id,  
'job_order_no' => $job_order_no,
'lot_no' => $lot_number,
'order_type' => 'Kora Order',
'process' => $process,
'date' => $date,
'shape_id' => $shapeId[$i],
'part_id' => $part_c[$i],
'qty' => $qtyy[$i],
'production_id' => $production_id,
//'type' => $type,
'shape_qty' => $shape_qty,
'module_name' => 'Kora'

);

$sesio = array(
          'comp_id' => $this->session->userdata('comp_id'),
          'zone_id' => $this->session->userdata('zone_id'),
          
          'maker_date'=> date('y-m-d'),
          'author_date'=> date('y-m-d')
        );

//print_r($data);die;
$dataall = array_merge($data,$sesio);
$this->Model_admin_login->insert_user($table_name,$dataall);
$dataP=explode(",",$part_c[$i]);
$dataQ=explode(",",$qtyy[$i]);
$cntP=count($dataP);

for($j=0;$j<$cntP;$j++)
{

$data=array(
'vendor_id' => $vendor_id,  
'date' => $date,
'job_order_no' => $job_order_no,
'lot_no' => $lot_number,
'order_type' => 'Kora Order',
'process' => $process,
'shape_id' => $shapeId[$i],
'part_id' => $dataP[$j],
'qty' => $dataQ[$j],
'production_id' => $production_id,
//'type' => $type,
'shape_qty' => $shape_qty,
'module_name' => 'Kora'
);

$sesio = array(
          'comp_id' => $this->session->userdata('comp_id'),
          'zone_id' => $this->session->userdata('zone_id'),
    
          'maker_date'=> date('y-m-d'),
          'author_date'=> date('y-m-d')
        );


$dataall = array_merge($data,$sesio);
$this->Model_admin_login->insert_user(tbl_job_work_log,$dataall);


}
}
echo "1";


}


public function order_check()
{

@extract($_POST);
$data=array('id' => $id,

  'order_type' => $order_type,
  'lot_no' => $lot_no
);
$this->load->view("order-check",$data);
}



public function order_repair()
{

@extract($_POST);
$data=array('id' => $id,

	'order_type' => $order_type,
	'lot_no' => $lot_no
);
$this->load->view("order-repair",$data);
}

public function print_challan()
{
  $data=array('id' => $_GET['id']);
  $this->load->view("print-challan",$data);
}

public function print_repair_challan()
{
  $data=array('id' => $_GET['id']);
  $this->load->view("print-repair-challan",$data);
}



}