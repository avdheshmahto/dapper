<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class shapeMapping extends my_controller {


function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
}


public function manage_shape()
{
    if($this->session->userdata('is_logged_in'))
    {
		//$data=$this->user_function();// call permission fnctn
	 	//$data['result'] = $this->model_master->getMachineData();	
	 	$data=$this->Manage_Shape_Data();
	 	$this->load->view('machine/manage-machine',$data);
    }
	else
	{
		redirect('index');
	}
}

public function Manage_Shape_Data()
{
	  $data['result'] = "";
	  $table_name  = 'tbl_machine';
	  //$url        = site_url('/shapeMapping/manage_shape?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_master->count_shape_mapping($table_name,'A',$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/shapeMapping/manage_shape?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/shapeMapping/manage_shape?item_name='.$_GET['item_name'].'&shape_name='.$_GET['shape_name'].'&shape_desc='.$_GET['shape_desc'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/shapeMapping/manage_shape?');
	  }
     
	 $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
      
     $data=$this->user_function(); 
     $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination'] = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_master->filterShapeMapping($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_master->getShapeMapping($pagination['per_page'],$pagination['page']);
			
     return $data;
}

public function get_machine(){
	if($this->session->userdata('is_logged_in')){
      $data           = $this->user_function();// call permission fnctn
	  $data['result'] = $this->model_master->getMachineData();	
	  $this->load->view('machine/get-machine',$data);
	}
	else
	{
	 redirect('index');
	}
}


public function insert_machine()
{
	@extract($_POST);
	$table_name ='tbl_machine';
	$id         = $id;
	$pri_col    = 'id';	
	
	$data = array(
					'machine_name' => $item_name,
					'code' => $shape_name,					
					'machine_des' => $shape_desc,
					//'capacity' => $capacity
                );

   $sesio = array(
					'maker_id'    => $this->session->userdata('comp_id'),
					'comp_id'     => $this->session->userdata('comp_id'),
					'divn_id'     => $this->session->userdata('divn_id'),
					'zone_id'     => $this->session->userdata('zone_id'),
					'brnh_id'     => $this->session->userdata('brnh_id'),
					'maker_date'  => date('Y-m-d'),
					'author_date' => date('Y-m-d')
				 );

  $dataall = array_merge($data,$sesio);
  
  if($id!='')
   {
     $this->Model_admin_login->update_user($pri_col,$table_name,$id,$data);
   }
   else
   {
     $this->Model_admin_login->insert_user($table_name,$dataall);
   }

   redirect("shapeMapping/manage_shape");
   //$this->load->view('assets/machine/get_machine');

}


public function getMachinePage()
{
$data=array(
'id' => $_GET['id']
);	
	
$this->load->view("machine/edit-machine",$data);	
	
}


public function getSpare()
{

	
		if($this->session->userdata('is_logged_in')){

	
	$data=array(
	'ID' => $_GET['ID']
	);
		
	$this->load->view('machine/map-spare',$data);
	}
	else
	{
	redirect('index');
	}
		

}


public function getproduct()
{

	
		if($this->session->userdata('is_logged_in')){

	
	$data=array(
	
	'id' => $_GET['con'] 
	);
	
	$this->load->view('machine/getproduct',$data);
	}
	else
	{
	redirect('index');
	}
		

}




public function insert_spare()
{
	@extract($_GET);
	$table_name='tbl_machine_spare_map';
	//$this->db->delete('tbl_machine_spare_map', array('machine_id' => $machine_id)); 
	
	$data = array(
					'machine_id' => $_GET['machine_name'],
					'spare_id'   => $_GET['code']
				);
				//print_r($_GET);
	$sesio = array(
					'maker_id' => $this->session->userdata('comp_id'),
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('Y-m-d'),
					'author_date'=> date('Y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);



 	$this->Model_admin_login->insert_user($table_name,$dataall);
	//echo "shapeMapping/get_spare?id='".$_GET['id']."'";die;

 redirect("shapeMapping/get_spare?id='".$_GET['machine_name']."'");
//$this->load->view('assets/machine/get_machine');

}

public function manage_spare_map()
{
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
	    $data['result'] = $this->model_master->getSpareData($this->input->get('id'));
		$this->load->view('machine/manage-spare-map',$data);
	 }else{
		redirect('index');
	}
	
}

public function ajax_productlist(){
	$result = $this->model_master->mod_productList($this->input->post('value')); 
	if(sizeof($result) > 0){
		foreach ($result as  $dt) {
			if($dt['productname']!= ""){
			echo "<a class='form-control listpro' jsvalue='".json_encode($dt)."' onclick='selectList(this)'>".$dt['productname']."</a>";
		    }
		}
    }
    else
	  echo "<a class='form-control' value='Not Found !'> Not Found !</a>";	
		    
}


public function get_spare()
{
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_master->getSpareData($this->input->get('id'));
	$this->load->view("machine/get-spare",$data);	
	
}

  function ajex_insertMapping(){
 	//print_r($this->input->post());
 	@extract($this->input->post());
     $table_name ='tbl_part_price_mapping';
     $countarr = count($this->input->post('prodcId'));
          $sesio = array(
				'maker_id'    => $this->session->userdata('comp_id'),
				'comp_id'     => $this->session->userdata('comp_id'),
				'divn_id'     => $this->session->userdata('divn_id'),
				'zone_id'     => $this->session->userdata('zone_id'),
				'brnh_id'     => $this->session->userdata('brnh_id'),
				'maker_date'  => date('Y-m-d'),
				'author_date' => date('Y-m-d')
		   );

     $this->db->delete('tbl_part_price_mapping', array('machine_id' => $this->input->post('itemid'),'part_id' => $this->input->post('partid'))); 

      for($i = 0;$i<$countarr;$i++){
         $data = array(
     	  'rowmatial'  => $prodcId[$i],
     	  'qty'        => $mproPrice[$i],
     	  'part_id'    => $partid,
     	  'machine_id' => $itemid,
     	  'type'       => $mapType,
     	  'unit'       => $uom[$i],
         );
         
         $dataall = array_merge($data,$sesio);
         $this->Model_admin_login->insert_user($table_name,$dataall);
      }
    
    echo 1;



}

public function ajax_rowmatiral(){
	$result = $this->model_master->mod_spareproductList($this->input->post('value')); 
	if(sizeof($result) > 0){
	//print_r($result);
	foreach ($result as  $dt) {
		$prodId   = $dt['Product_id'];
		$prodName = $dt['productname'];
		$uom      = $dt['usageunit'];
	?>
      <a class='form-control col-sm-3 listpro' style='cursor: pointer;display: block;' title = '<?=$prodName;?>'  onclick="selectListdata(<?=$prodId;?>,'<?=$prodName;?>',<?=$uom;?>);"><?=$prodName;?>
</a>

<?php  } }
      else
	    echo "<a class='form-control' value='Not Found !'> Not Found !</a>";	
   }

  function ajex_getsparemapedQty(){
    $data['result'] = $this->model_master->getsparemapedQty($this->input->post('partid'),$this->input->post('machineid'));
	$this->load->view("machine/get-sparemapedQty",$data);
  }

  function ajex_viewgetsparemapedQty(){
    $data['result'] = $this->model_master->viewgetsparemapedQty($this->input->post('partid'),$this->input->post('machineid'),$this->input->post('typee'));
	$this->load->view("machine/get-viewsparemapedQty",$data);
  }


}

?>
