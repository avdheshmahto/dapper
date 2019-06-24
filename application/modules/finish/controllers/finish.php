<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class finish extends my_controller {
	
function __construct(){
   parent::__construct();
   $this->load->library('pagination'); 
   $this->load->model('model_finish');
}     

public function manage_stock()
{

$this->load->view('manage-stock');	
	
}

public function manage_finish(){

	if($this->session->userdata('is_logged_in')){
		$data =  $this->manage_finishJoin();
		$this->load->view('manage-finish',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function manage_test(){

  if($this->session->userdata('is_logged_in')){
    
    $data =  $this->manage_testJoin();
    $this->load->view('manage-test',$data);
  
  }
  else
  {
  
  redirect('index');
  
  }   
}

function manage_testJoin(){
  
  $data['result'] = "";
  ////Pagination start ///
  $table_name  = 'tbl_production_available_order';
  $url        = site_url('/finish/manage_test?');
  $sgmnt      = "4";
  $showEntries= 10;
  $totalData  = $this->model_finish->count_test($table_name,'A',$this->input->get());
  
  if($_GET['entries']!=""){
    $showEntries = $_GET['entries'];
    $url     = site_url('/finish/manage_test?entries='.$_GET['entries']);
  }
  
    $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
    //////Pagination end ///
   
    $data=$this->user_function();      // call permission fnctn
    $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$agination['page']);
    $data['pagination']        = $this->pagination->create_links();
    if($this->input->get('filter') == 'filter')   ////filter start ////
    $data['result']       = $this->model_finish->filterTest($pagination['per_page'],$pagination['page'],$this->input->get());
            else  
    $data['result'] = $this->model_finish->gettest($pagination['per_page'],$pagination['page']);
    return $data;
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
  $data['result'] =  $this->model_finish->modgetitemspharemap(2);
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

public function manage_finish_jobwork_map_details(){

	if($this->session->userdata('is_logged_in')){
	
  		$this->load->view('manage-finish-jobwork-map-details');
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

public function view_finish_order(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('view-finish-order',$data);
  }
  else
  {
  redirect('index');
  }   
}

public function view_finish_order_test(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('view-finish-order-test',$data);
  }
  else
  {
  redirect('index');
  }   
}



public function manage_finish_map(){

  if($this->session->userdata('is_logged_in')){
    $data=array(
      'id' =>$_POST['id']
    );
    $this->load->view('manage-finish-map',$data);
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



function manage_finishJoin(){
  $data['result'] = "";
	////Pagination start ///
  $table_name  = 'tbl_production_order_log';
	$url        = site_url('/finish/manage_finish?');
	$sgmnt      = "4";
	$showEntries= 10;
  $totalData  = $this->model_finish->count_finish($table_name,'A',$this->input->get());
  //$showEntries= $_GET['entries']?$_GET['entries']:'12';
  if($_GET['entries']!=""){
      $showEntries = $_GET['entries'];
      $url     = site_url('/finish/manage_finish?entries='.$_GET['entries']);
  }
  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  //////Pagination end ///
  $data=$this->user_function();      // call permission fnctn
  $data['dataConfig']= array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
  //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);	
  $data['pagination']        = $this->pagination->create_links();
	if($this->input->get('filter') == 'filter')   ////filter start ////
    $data['result']       = $this->model_finish->filterProductionList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    $data['result'] = $this->model_finish->getfinish($pagination['per_page'],$pagination['page']);
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
'order_type' => 'Finish Order',
'process' => $process,
'date' => $date,
'shape_id' => $shapeId[$i],
'part_id' => $part_c[$i],
'fg_id' => $fg_id[$i],
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
$dataR=explode(",",$fg_id[$i]);
$cntP=count($dataP);

for($j=0;$j<$cntP;$j++)
{

$data=array(
'vendor_id' => $vendor_id,  
'date' => $date,
'job_order_no' => $job_order_no,
'lot_no' => $lot_number,
'order_type' => 'Finish Order',
'process' => $process,
'shape_id' => $shapeId[$i],
'part_id' => $dataP[$j],
'fg_id' => $dataR[$j],

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

public function view_finish_parts()
{
@extract($_GET);
$data=array('id' => $ID

);
$this->load->view("view-finish-parts",$data);
}

public function manage_finish_test_map()
{

$this->load->view("manage-finish-test-map");

}


public function view_finish_test()
{

$this->load->view("view-finish-test");

}

public function insert_insepction()
{

  extract($_POST);
  $table_name ='tbl_product_inspection';
  $this->db->query("delete from $table_name where productionid='$poid' and type ='$type'");  
  if($type=='Purchase Order')
  {
    $this->db->query("update  tbl_purchase_order_dtl set rej_qty=rej_qty+'$rec_qty' where purchaseorderdtlid='$poid' ");  
  }
  if($type=='production')
  {
    
    $this->db->query("update  tbl_production_hdr set rej_qty=rej_qty+'$rec_qty' where productionid='$poid' ");  
  
  }
     
  $this->load->model('Model_admin_login');  
  $rows=count($test_param);
  
  for($i=0; $i<=$rows; $i++)
    {
      if($insp1[$i]!=''){
        $data_dtl['lot']= $lot;
         $data_dtl['product_id']= $p_id[$i];
         $data_dtl['test_param']=$this->input->post('test_param')[$i];         
         $data_dtl['specification']=$this->input->post('specification')[$i];
         $data_dtl['specification2']=$this->input->post('specification2')[$i];
         $data_dtl['insp1']=$this->input->post('insp1')[$i];
         $data_dtl['insp2']=$this->input->post('insp2')[$i];
         $data_dtl['insp3']=$this->input->post('insp3')[$i];
         $data_dtl['insp4']=$this->input->post('insp4')[$i];
         $data_dtl['insp5']=$this->input->post('insp5')[$i];
         $data_dtl['insp6']=$this->input->post('insp6')[$i];
         $data_dtl['insp7']=$this->input->post('insp7')[$i];
         $data_dtl['insp8']=$this->input->post('insp8')[$i];
         $data_dtl['insp9']=$this->input->post('insp9')[$i];
         $data_dtl['insp10']=$this->input->post('insp10')[$i];
         $data_dtl['maker_id']=$this->session->userdata('user_id');
         $data_dtl['maker_date']=date('y-m-d');
         $data_dtl['comp_id']=$this->session->userdata('comp_id');
         $data_dtl['zone_id']=$this->session->userdata('zone_id');
         $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
         $this->Model_admin_login->insert_user($table_name,$data_dtl);   
         }
      }

      echo "1";
 }

public function manage_assemble()
{
  if($this->session->userdata('is_logged_in')){
   
    $data =  $this->manage_assembleJoin();
    $this->load->view("manage-assemble",$data);
  }  
}

function manage_assembleJoin(){
  $data['result'] = "";
  ////Pagination start ///
  $table_name  = 'tbl_production_order_check';
  $url        = site_url('/finish/manage_assemble?');
  $sgmnt      = "4";
  $showEntries= 10;
  $totalData  = $this->model_finish->count_assemble($table_name,'A',$this->input->get());
  //$showEntries= $_GET['entries']?$_GET['entries']:'12';
  if($_GET['entries']!=""){
      $showEntries = $_GET['entries'];
      $url     = site_url('/finish/manage_assemble?entries='.$_GET['entries']);
  }
  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  //////Pagination end ///
  $data=$this->user_function();      // call permission fnctn
  $data['dataConfig']= array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
  //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']); 
  $data['pagination']        = $this->pagination->create_links();
  if($this->input->get('filter') == 'filter')   ////filter start ////
    $data['result']       = $this->model_finish->filterProductionList($pagination['per_page'],$pagination['page'],$this->input->get());
            else  
    $data['result'] = $this->model_finish->getassemble($pagination['per_page'],$pagination['page']);
    return $data;
}

public function manage_assemble_map()
{
  if($this->session->userdata('is_logged_in')){
   
  $this->load->view("manage-assemble-map",$data);
  
  }  
}

public function assemble_grn()
{
    @extract($_GET);
    if($this->session->userdata('is_logged_in')){
      $data=array(
                'p_id'    =>   $ID,
                'lot_id'  => $lot_id
      );  
      //print_r($data);

     $this->load->view("order-assemble-details",$data);
  }  
}


public function insert_finish_map()
{

@extract($_POST);
$table_name='tbl_assemble_fg';
$cnt=count($product_id);
for($i=0;$i<$cnt;$i++){
  $data=array(
    'job_order_no' => $job_order_id,
    'lot_no' => $lot_no,
    'order_type' => 'Finish Order',
    'grn_no' => $grn_no,
    'grn_date' => $grn_date,
    'product_id' => $product_id[$i],
    'fg_id' => $fg_id,
    'qty' => $qty[$i],
    'module_name' => 'Finish Order'
);

$sesio = array(
    'comp_id' => $this->session->userdata('comp_id'),
    'zone_id' => $this->session->userdata('zone_id'),
    'maker_date'=> date('y-m-d'),
    'author_date'=> date('y-m-d')
    );

$dataall = array_merge($data,$sesio);
$this->Model_admin_login->insert_user($table_name,$dataall);

}
echo "1";

}


}