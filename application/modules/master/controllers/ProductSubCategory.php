<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class ProductSubCategory extends my_controller {
function __construct(){
   parent::__construct(); 
$this->load->model('model_master');
}

public function pcategory_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A','comp_id',$this->session->userdata('comp_id'))
           -> get('tbl_prodcatg_mst');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('status','A','prodcatg_id',$row->main_prodcatg_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();
		
		  if($row->main_prodcatg_id==1){$Primary="Y";}else{$Primary="N";}
				
			$info[$i]['1']=$row->prodcatg_name;
			$info[$i]['2']=$Primary;
			 if($row->main_prodcatg_id!='1'){
			$info[$i]['3']=$compRow->prodcatg_name;
			}
			$info[$i]['4']=$row->prodcatg_id;				
				$i++;
			
		}
		return $info;
	
	}

	public function insert_itemsubctg(){	
			extract($_POST);
			$count= count($prodcatg_id);
			//echo $count;die;
			$table_name ='tbl_prodcatg_m';
		 	$pri_col ='product_Catid';
	 		$id= $this->input->post('prodcatg_id');
			//echo $id;die;
			$this->load->model('Model_admin_login');
			
			
			
			/*$mid1= $this->input->post('mid1');
			//echo $mid1;die;
			$midd1= $this->input->post('midd1');
			$midd2= $midd1-1;
			if($midd2==1){
			$mid= $midd2;
			}else if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			*/if($id==''){
			$data=array(
					
					'catg_id' => $this->input->post('catg_id'),
					'categoryName' => $this->input->post('prodsubcatg_name'),
					//'alias' => $this->input->post('alias'),
					'Description' => $this->input->post('description'),
					//'main_prodcatg_id' => $midd1
					
					);
					
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
					
			$this->Model_admin_login->insert_user($table_name,$dataall);
					
					$this->session->set_flashdata('flash_msg', 'Record Added Successfully.');
					redirect('/master/ProductSubCategory/manage_itemsubctg');
					
					
					}
		else
				{
				for($i=1;$i<=$count;$i++){
				//echo $prodcatg_id[$i];die;
				 $idE=$prodcatg_id[$i];
				$dataarr=array(
				
					//'main_prodcatg_id' => $midd1[$i],
					'catg_id' => $catg_id[$i],
					'categoryName' => $prodsubcatg_name[$i],
					//'alias' => $alias[$i],
					'Description' => $description[$i]
				);
				
				$this->Model_admin_login->update_user($pri_col,$table_name,$idE,$dataarr);
			}
					$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.');
				
					redirect('/master/ProductSubCategory/manage_itemsubctg');
				
					/*if($midd1==2){
					*/
					
					/*}
					else if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/master/ProductCategory/manage_itemctg');
					}
					else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					$lastid=$this->db->insert_id();
					$this->fillselect($prodcatg_name,$lastid,'contact_id_copy');
					echo "<script type='text/javascript'>";
					echo "window.close();";
					//echo "window.opener.location.reload();";
					echo "</script>";
			
				}
				*/
				}
				
			}	
			
	

public function add_itemsubctg(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('ProductSubCategory/add-itemsubctg');
	}
	else
	{
	redirect('index');
	}
	
	
}
	
	public function manage_itemsubctg(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_master->productSubCatg_data();
	$this->load->view('ProductSubCategory/manage-itemsubctg',$data);
	}
	else
	{
	redirect('index');
	}
	
	
}

	
public function aliesfunction(){
	
		$data['alias_idd']=$_GET['alias_idd'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

	public function prodcatefunction(){
	
		$data['prodcatg_id']=$_GET['prodcatg_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
}
?>