<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Account extends my_controller {

function __construct()
{
    parent::__construct(); 
	$this->load->library('pagination');
    $this->load->model('model_master');	
}

public function manage_contact()
{

	if($this->session->userdata('is_logged_in'))
	{
		$d=$_GET['con_type'];
		$data = $this->ContactListJoin($d);
		$this->load->view('/Account/manage-contact',$data);
	}
	else
	{
		redirect('index');
	}

}

public function ContactListJoin($d)
{

  	  $data['result'] = "";
      $table_name  = 'tbl_contact_m';
      $con_type=$d;
	  //$url        = site_url('/master/Account/manage_contact?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_master->count_contact($table_name,'A',$this->input->get(),$con_type);

      if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/master/Account/manage_contact?con_type='.$con_type.'&entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/master/Account/manage_contact?con_type='.$con_type.'&name='.$_GET['name'].'&grp_name='.$_GET['grp_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/master/Account/manage_contact?con_type='.$con_type);
	  }
	  
      $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
   
	  $data  = $this->user_function();
	  $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	  $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')
		$data['result'] = $this->model_master->filterContactList($pagination['per_page'],$pagination['page'],$this->input->get(),$con_type);
		else	
			$data['result'] = $this->model_master->contact_get($pagination['per_page'],$pagination['page'],$con_type);
			
	  return $data;
  
}

public function insert_contact()
{
	
		@extract($_POST);
		$table_name ='tbl_contact_m';
		$pri_col ='contact_id';
	 	$id= $this->input->post('contact_id');
	 	// echo "<pre>";
	 	//  print_r($_POST);
	 	// echo "<pre>";
		//  print_r($_POST);die;

		$entityarr =$this->input->post('entity');
        @$entityComma=implode(',',$entityarr);
		
		$data= array(
                    'first_name' => $this->input->post('first_name'),
					'group_name' => $this->input->post('maingroupname'),
					'contact_person' => $this->input->post('contact_person'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'),					
	                'phone' => $this->input->post('phone'),
					'IT_Pan'	=> $pan_no,
					'gst' => $this->input->post('gst_no'),	
					'address1' => $address1,
                 	'address3' => $address3,
					'city' => $this->input->post('city'),
				    'state_id' => $this->input->post('state'),
					'pincode' => $this->input->post('pin_code'),
					'finalDestination' => $this->input->post('finalDestination'),
					'countryDestination' => $this->input->post('countryDestination'),
				    'portDischarge' => $this->input->post('portDischarge'),
					'norify' => $this->input->post('norify'),

	 				'vendor_type' => $this->input->post('vendor_type'),	
	 				
	 				'mappedConsignee'=> $entityComma,				
					'code' => $this->input->post('code')						                 	
                );

	    $sesio = array(
			'comp_id'     => $this->session->userdata('comp_id'),
			'divn_id'     => $this->session->userdata('divn_id'),
			'zone_id'     => $this->session->userdata('zone_id'),
			'brnh_id'     => $this->session->userdata('brnh_id'),
			'maker_id'    => $this->session->userdata('user_id'),
			'author_id'   => $this->session->userdata('user_id'),
			'maker_date'  => date('y-m-d'),
			'author_date' => date('y-m-d')
        );
		
		$data_entr = array_merge($data,$sesio);		
    	$this->load->model('Model_admin_login');

		if($id!='')
		{
		 $this->Model_admin_login->update_user($pri_col,$table_name,$id,$data);
		 echo "2"."^".$maingroupname;
		}
		else
		{ 
		 $this->Model_admin_login->insert_user($table_name,$data_entr);
		 echo "1"."^".$maingroupname;		          
		}
}

public function ajax_ContactListData()
{
	$d=$_POST['id'];
	$data =  $this->ContactListJoin($d);
	$this->load->view('/Account/edit-contact',$data);  
}



public function updateContact()
{
	if($this->session->userdata('is_logged_in'))
	{
		 $data['ID'] = $_GET['ID'];
		 $this->load->view('/Account/edit-contact',$data);
	}
	else
	{
		redirect('index');
	}
}

public function getdata_fun()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data['id'] = $_GET['con'];
		$this->load->view('/Account/getdata',$data);
	}
	else
	{
		redirect('index');
	}
}

public function contact_log()
{

	if($this->session->userdata('is_logged_in'))
	{
		$data=$this->user_function();// call permission fnctn
		$this->load->view('Account/contact-log',$data);
	}
	else
	{
		redirect('index');
	}

}


public function contact_log_pay()
{

	if($this->session->userdata('is_logged_in'))
	{
		$data=$this->user_function();// call permission fnctn
		$this->load->view('Account/contact-log-pay',$data);
	}
	else
	{
		redirect('index');
	}

}



public function contact_list_pay()
{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','5')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
}
	
public function contact_list()
{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','4')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
}	

public function contact_list_m()
{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
}	

public function add_contact()
{
	if($this->session->userdata('is_logged_in'))
	{
 		$this->load->view('Account/add-contact');
	}
	else
	{
		redirect('index');
	}
}

	

	

function insertOpeningBal($ContactLastid,$openingBal)
{
		
		$table_name='tbl_invoice_payment';
		$data= array(
					
					'contact_id' => $ContactLastid,
                 	'receive_billing_mount' => $openingBal,
	                'remarks' => 'Opening Balance',
                 	'comp_id' => $this->session->userdata('comp_id'),
					
					'date' =>  date('y-m-d'),
					
					'maker_id' => $this->session->userdata('user_id'),
					
					'maker_date'=> date('y-m-d'),
					'status'=> 'invoice'
					
						
					);
			$this->Model_admin_login->insert_user($table_name,$data);
		 return;
}


	
function delete_contact() {
	
	$table_name ='tbl_contact_m';
	$pri_col ='contact_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		
		// echo "select * from tbl_invoice_payment where contact_id='$id'"
		
		$querypayment= $this->db->query("select * from tbl_invoice_payment where contact_id='$id'");
		$fetchid=$querypayment->row();
		if($fetchid->contact_id!=''){
		?>	
		<script>
        	
			confirm("You can't delete it because this id is in tbl_invoice_payment"); 
			window.location.href='manage_contact';			
		
        </script>
        <?php	
		}
		
		//echo "select * from tbl_invoice_dtl where productid='$id'";
		
		$queryP=$this->db->query("select * from tbl_invoice_hdr where contactid='$id'");
		$fetchP=$queryP->row();
		
		
		if($fetchP->contactid!=''){
		?>			 
			<script> alert("please delete product in tbl_invoice_dtl table then you can delete this product:"); 
			window.location.href='manage_contact';
			</script>				 
				
		<?php			 
		}else{
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		
		$table_name1 ='tbl_address_m';
		$pri_col1 ='entityid';
		$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_address($pri_col1,$table_name1,$id);
	    redirect('/index.php/Account/manage_contact');

	}

}


public function firstfunction()
{
	$data['firstid']=$_GET['firstid'];
	$this->load->view('get-alies-itemctg',$data);
	
}


public function aliesnamefunction()
{
	$data['aliesnameid']=$_GET['aliesnameid'];
	$this->load->view('get-alies-itemctg',$data);
}

public function ajax_getentityRows(){
	 
       $result  =  $this->model_master->get_getentityRows($this->input->post('id'));
 }

 public function mappingSuplier(){
	if($this->session->userdata('is_logged_in')){
	   $data['result']  = "";
       $data['result']  = $this->model_master->get_tblmappingData($this->input->post('id'));
       $data['contact'] = $this->input->post('id');
       $data['type']    = $this->input->post('editView');
	   $this->load->view('Account/mappingadd',$data);
	 }
	else
	 {
	 redirect('index');
	 }		
 }

   public function getproduct(){
	 if($this->session->userdata('is_logged_in')){
	   $this->load->view('Account/getproduct');
	 }
	 else
	 {
	   redirect('index');
	 }
  }


 public function insertProductMapping(){
        @extract($_POST);
		$table_name ='tbl_product_mapping';
		$pri_col    = 'contact_id';
		$table_name_log = 'tbl_price_mapping_log';

		 $sesio = array(
			'comp_id'     => $this->session->userdata('comp_id'),
			'divn_id'     => $this->session->userdata('divn_id'),
			'zone_id'     => $this->session->userdata('zone_id'),
			'brnh_id'     => $this->session->userdata('brnh_id'),
			'maker_id'    => $this->session->userdata('user_id'),
			'author_id'   => $this->session->userdata('user_id'),
			'maker_date'  => date('y-m-d'),
			'author_date' => date('y-m-d')
         );

		// echo "<pre>";
		//   print_r($_POST);
		// echo  "</pre>";
		$count   = $this->input->post('rows');
		$contact = $this->input->post('contact');
       
		$this->Model_admin_login->delete_user($pri_col,$table_name,$contact);
        
		for ($i = 0; $i < $count; $i++) {
            $data_dtl['product_id']  = $this->input->post('main_id')[$i];
			$data_dtl['price']       = $this->input->post('price')[$i];
			$data_dtl['contact_id']  = $contact;
			$data_dtl['status']      = 1;
			$data_entr = array_merge($data_dtl,$sesio);
            $this->Model_admin_login->insert_user($table_name,$data_entr);

            $this->Model_admin_login->insert_user($table_name_log,$data_entr);
			//echo $i;
        }

       

        	
        //echo "<pre>";
		//  print_r($data_dtl);
		// echo  "</pre>";die;
        echo 1;
 }

}
?>