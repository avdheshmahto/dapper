<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class inbound extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_inbound_order');
}     

public function add_inbound(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-inbound');
	}
	else
	{
	redirect('index');
	}		
}








public function edit_purchase_order(){
	if($this->session->userdata('is_logged_in')){
       $data['result'] =  $this->model_purchase_order->get_tblHdrData($this->input->post('id'));
	   $this->load->view('edit-purchase-order',$data);
	 }
	else
	 {
	 redirect('index');
	 }		
}
	
public function manage_inbound()
{
	
	if($this->session->userdata('is_logged_in')){
	//$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_purchase_order->invoice_data();
	$data = $this->Manage_Inbound_Data();
	$this->load->view('manage-inbound',$data);
	}
	else
	{
	redirect('index');
	}	
}

public function Manage_Inbound_Data()
{


  	  $data['result'] = "";
 	  ////Pagination start ///
      $table_name  = 'tbl_inbound_hdr';
	  $url        = site_url('/inbound/manage_inbound?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_inbound_order->count_inbound($table_name,'A',$this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';
      if($_GET['entries']!="")
	  {
         $showEntries = $_GET['entries'];
         $url     = site_url('/inbound/manage_inbound?entries='.$_GET['entries']);
      }
      $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      //////Pagination end ///
   
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);	
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_inbound_order->filterInboundOrder($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_inbound_order->getInbound($pagination['per_page'],$pagination['page']);
			
     return $data;


}



public function insertInboundOrder(){
		
		extract($_POST);
		$table_name ='tbl_inbound_hdr';
		$table_name_dtl ='tbl_inbound_dtl';
		$pri_col ='inboundid';
		$pri_col_dtl ='inbound_dtl_id';
		$pri_col_hdr_log='tbl_inbound_log';
		
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
	
	
		$data = array(
	            'storage_location'    => $this->input->post('storage_location'),  
				'po_no'    => $this->input->post('po_no'),
				'invoice_no'       => $this->input->post('invoice_no'),
				'grn_no'    	  => $this->input->post('grn_no'),
				'date' 		  => date('Y-m-d'),
		
				);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();	
			$this->load->model('Model_admin_login');
		$rows=count($productid);
		    for($i=0; $i<=$rows; $i++)
		    {
			  if($receive_qty[$i]!=''){
                 $data_dtl=array(
				 'inboundrhdr'		=> $lastHdrId,
				 'productid'		=> $productid[$i],				 
				 'receive_qty'		=> $receive_qty[$i],
				 'remaining_qty'	=> $remaining_qty[$i],
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);
				
				
				$data_dtl_log=array(
				 'inboundrhdr'		=> $lastHdrId,
				 'po_no'		=> $po_no,
				 'productid'		=> $productid[$i],				 
				 'receive_qty'		=> $receive_qty[$i],
				 'remaining_qty'	=> $remaining_qty[$i],
				 'invoice_no'       => $this->input->post('invoice_no'),
				 'grn_no'			=> $this->input->post('grn_no'),
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);
				
			
			  $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
			  
			   $this->Model_admin_login->insert_user($pri_col_hdr_log,$data_dtl_log);		
	  	 }
	 }
				
		$rediectInvoice="inbound/manage_inbound";
		redirect($rediectInvoice);	
	   
					
	
	}

public function getproduct(){
	if($this->session->userdata('is_logged_in')){
		//echo "asdf";die;
		$this->load->view('getproduct');
	}
	else
	{
	redirect('index');
	}
}



function deleteSalesOrder(){
	$table_name ='tbl_purchase_order_hdr';
	$table_name_dtl ='tbl_purchase_order_dtl';
	$pri_col ='purchase_order_id';	
	$pri_col_dtl ='purchase_order_hdr_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$id_dtl= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col_dtl,$table_name_dtl,$id_dtl);
		redirect('SalesOrder/managePurchaseOrder');
}



public function getPo()
{
	
	$queryPo=$this->db->query("select *from tbl_purchase_order_hdr where company='".$_GET['loc']."'");
	echo '<select>';
	echo '<option>----select----</option>';
	foreach($queryPo->result() as $getPO){
	
	echo '<option value='.$getPO->purchaseid.'>'.$getPO->purchase_no.'</option>';

	}
	echo '</select>';		
	
}

public function getPoItem()
{
$data=array(
'id' => $_GET['poId']
);

$this->load->view("getpoitem",$data);
}
function delete_updata_stock($qty1,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity-'$qty1' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity-'$qty1' where product_id='$main_id'");
		return;	
	}	



public function view_inbound()
{
	
	$data=array(
	'id' => $_POST['id']
	);
$this->load->view("view-inbound",$data);	
	
}

}