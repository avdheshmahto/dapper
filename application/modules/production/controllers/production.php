<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class production extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->library('pagination'); 
   $this->load->model('model_production');
}     

public function add_production(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-production');
	}
	else
	{
	redirect('index');
	}		
}

public function add_overlock(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-overlock');
	}
	else
	{
	redirect('index');
	}		
}

public function manage_production(){
	
	if($this->session->userdata('is_logged_in')){
	//$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_production->getProduction();
	$data =  $this->manage_productionJoin();
	$this->load->view('manage-production',$data);
	}
	else
	{
	redirect('index');
	}	
}

function manage_productionJoin(){
  		$data['result'] = "";
	////Pagination start ///
      $table_name  = 'tbl_production_hdr';
	  $url        = site_url('/production/manage_production?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_production->count_production($table_name,'A',$this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';
      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url     = site_url('/production/manage_production?entries='.$_GET['entries']);
      }
     $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
     //////Pagination end ///
   
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);	
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_production->filterProductionList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_production->getProduction($pagination['per_page'],$pagination['page']);
			
     return $data;
  }


public function edit_production(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-production');
	}
	else
	{
	redirect('index');
	}		
}

	
public function insert_overlock(){
	@extract($_POST);
	$table_name ='tbl_overlock';
	$pri_col ='overlock_id';
	$table_name_log ='tbl_production_log';
	$pri_col_log ='production_log_id';
	$status='Overlock';

    $count=count($qty);
    //echo $count;die;
    $sumQty=0;
    
   /* echo "<pre>";
    print_r($_POST);
    echo "</pre>";die;*/

    for($i=0;$i<$count;$i++){
			 $data_dtl['production_id']     = $this->input->post('production_id');
			 $data_dtl['finishProductId']   = $this->input->post('finishProduct');
			 $data_dtl['production_status'] = $status;
			 $data_dtl['customer_name']     = $this->input->post('contact_id')[$i];				 
			 $data_dtl['qty']               = $this->input->post('qty')[$i];
			 $data_dtl['date']              = $this->input->post('date')[$i];
			 $data_dtl['maker_id']          = $this->session->userdata('user_id');
			 $data_dtl['maker_date']        = date('y-m-d');
			 $data_dtl['comp_id']           = $this->session->userdata('comp_id');
			 $data_dtl['zone_id']           = $this->session->userdata('zone_id');
			 $data_dtl['brnh_id']           = $this->session->userdata('brnh_id');

			 $sumQty = $qty[$i];
			 $IDE    = $overlock_id[$i];

			if($overlock_id[$i]==''){
				$this->Model_admin_login->insert_user($table_name,$data_dtl);	
				$lastid=$this->db->insert_id();
			}else{
				//echo $tailor_id[$i];
				if($qty[$i]!=''){
				  $this->db->query("update tbl_overlock set qty='".$qty[$i]."', customer_name='".$contact_id[$i]."', date='".$date[$i]."' where overlock_id='".$overlock_id[$i]."'");
				}
				//$this->Model_admin_login->update_user($pri_col,$table_name,$IDE,$data_dtl);
					$lastid=$overlock_id[$i];
				}	
				//die;
				if($qty[$i]!=''){
				
				 $data_dtl_log['production_id']= $this->input->post('production_id');
				 $data_dtl_log['finishProductId']= $this->input->post('finishProduct');
				 $data_dtl_log['production_status']= $status;
				 $data_dtl_log['customer_name']=$this->input->post('contact_id')[$i];	
				 $data_dtl_log['overlock_id']=$lastid;			 
				 $data_dtl_log['qty']=$this->input->post('qty')[$i];
				 $data_dtl_log['date']=$this->input->post('date')[$i];
				 $data_dtl_log['maker_id']=$this->session->userdata('user_id');
				 $data_dtl_log['maker_date']=date('y-m-d');
				 $data_dtl_log['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl_log['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl_log['brnh_id']=$this->session->userdata('brnh_id');
					
					$this->Model_admin_login->insert_user($table_name_log,$data_dtl_log);
				}
				$this->stock_refill_qty($sumQty,$finishProduct,$production_id);
			}


        $rediectInvoice="production/manage_production";
		redirect($rediectInvoice);

}


public function insertProduction(){
		
		extract($_POST);
        
		$table_name ='tbl_production_hdr';
		$table_name_dtl ='tbl_production_dtl';
		$pri_col ='productionid';
		$pri_col_dtl ='productionhdr';
		
		
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
	
					'product_id' => $this->input->post('finished_goods'),
					'date' => $this->input->post('date'),
					'qty' => $this->input->post('hdr_qty'),
					'machine' => $this->input->post('machine'),
		 );
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			$this->load->model('Model_admin_login');
		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
				
				
				if($tot_gram[$i]!=''){

				 $data_dtl['productionhdr']= $lastHdrId;
				 $data_dtl['product_id']=$this->input->post('product_id')[$i];				 
				 $data_dtl['quantity']=$this->input->post('useper')[$i];
				 $data_dtl['tot_qty']=$this->input->post('tot_gram')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				
				
				$this->stock_refill_qty1($tot_gram[$i],$product_id[$i]);
				
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
							}
					}
				
			
			
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Template added');
				
	
				
			 $rediectInvoice="production/manage_production";
		redirect($rediectInvoice);	
	   
					
	
	}

	
	public function updateProduction(){
		
		extract($_POST);
		$table_name ='tbl_production_hdr';
		$table_name_dtl ='tbl_production_dtl';
		//$table_name_log ='tbl_production_hdr_log';
		$pri_col ='productionid';
		$pri_col_dtl ='productionhdr';
		//$pri_col_log ='productionhdr_id';
		
 
		 $this->db->query("delete from $table_name_dtl where productionhdr='$id'");	
				
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
	
					'product_id' => $this->input->post('product_id'),
					'date' => $this->input->post('date'),
					'qty' => $this->input->post('qty'),
					'machine' => $this->input->post('machine'),
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);

		
		for($i=0; $i<=$rows; $i++)
				{
				 
				if($qty[$i]!=''){

				 $data_dtl['productionhdr']= $id;
				 $data_dtl['product_id']=$this->input->post('product_idd')[$i];				 
				 $data_dtl['grams']=$this->input->post('gram')[$i];
				 $data_dtl['tot_grm']=$this->input->post('tot_gram')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				
				
			
							}
					}
					
		$sqlProdLog="insert into tbl_production_hdr_log set productionhdr_id ='$id',product_id='$product_id',qty='$qty',machine='$machine',date='$date', maker_date=NOW(), maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLog);

		
					
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
		
	}
	
	
	
	
public function all_product_function(){
	
		$this->load->view('all-product',$data);
	
	}

public function viewSalesOrder(){
	if($this->session->userdata('is_logged_in')){
	
	$this->load->view('view-sales-order');
	}
	else
	{
	redirect('index');
	}
		
}

public function getproduct(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct');
	}
	else
	{
	redirect('index');
	}
}



public function add_inspection()
{
	
		if($this->session->userdata('is_logged_in')){
		$this->load->view('add-inspection');
	}
	else
	{
	redirect('index');
	}
	
}
		
public function insert_insepction()
{
extract($_POST);

		$table_name ='tbl_product_inspection';
		
 
		 $this->db->query("delete from $table_name where productionid='$productionid' and type ='$type'");	
				/*
		
		$data = array(
	
					'product_id' => $this->input->post('product_id'),
					'test_param' => $this->input->post('test_param')[$i],
					'specification' => $this->input->post('specification')[$i],
					'insp1' => $this->input->post('insp1')[$i],
					'insp2' => $this->input->post('insp2')[$i],
					'insp3' => $this->input->post('insp3')[$i],
					'insp4' => $this->input->post('insp4')[$i],
					'insp5' => $this->input->post('insp5')[$i],
					'insp6' => $this->input->post('insp6')[$i],
					'insp7' => $this->input->post('insp7')[$i],
					'insp8' => $this->input->post('insp8')[$i],
					'insp9' => $this->input->post('insp9')[$i],
					'insp10' => $this->input->post('insp10')[$i],
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);
*/
$this->load->model('Model_admin_login');	
		
		$rows=count($test_param);
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
				
				
				if($insp1[$i]!=''){
				 $data_dtl['productionid']= $productionid;
				 $data_dtl['product_id']= $p_id[$i];
				 $data_dtl['type']= $type;
				 
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
					
					
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "alert('Inspection Added Successfully')";
					echo "</script>";
		
		
		
		
}
		

public function print_inspection()
{
	$data=array(
	'id' => $_GET['id']
	);
	
$this->load->view("print-inspection",$data);	
	
}


public function stock_refill_qty1($qty,$main_id)
	{
	
	//echo "update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id' and type='13'";die;
				$this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id' and type='13'");
	
	}
public function stock_refill_qty($qty,$main_id,$production_id)
	{
	//echo $production_id;
	//$gethdrProduction=$this->db->query("select *from tbl_production_hdr where productionid='".$production_id."'");
	//$gethdrProdfetch=$gethdrProduction->row();
	//$tot_qty=$gethdrProdfetch->qty*$qty;
	$gethdrQuery=$this->db->query("select * from tbl_template_hdr where product_id='".$main_id."'");
	$gethdrfetch=$gethdrQuery->row();
	//echo $gethdrfetch->templateid;
	$getdtlQuery=$this->db->query("select * from tbl_template_dtl where templatehdr='".$gethdrfetch->templateid."'");
	foreach($getdtlQuery->result() as $getdtlfetch){
		echo $getdtlfetch->product_id;
		$tot_qty=$getdtlfetch->quantity*$qty;
		//echo "update tbl_product_stock set quantity=quantity-'$tot_qty' where Product_id='$getdtlfetch->product_id' and type='13'<br>";
		$this->db->query("update tbl_product_stock set quantity=quantity-'$tot_qty' where Product_id='$getdtlfetch->product_id' and type='28'");
	}
	//die;
				
	return;
				
	
	}
	
	
	
	function approve_production_order(){
	
	$approveQuery=$this->db->query("select *from tbl_production_hdr where productionid='".$_GET['id']."'");
	$getAprove=$approveQuery->row();
	if($getAprove->approve_status=='Approve')
	{
		$this->db->query("update tbl_production_hdr set approve_status='Not Approve' where productionid='".$_GET['id']."'");
	}
	else
	{
	$this->db->query("update tbl_production_hdr set approve_status='Approve' where productionid='".$_GET['id']."'");
	}
	
	
redirect('production/manage_production');
}


public function stockIn(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	
	$this->load->view('stockInProduct',$data);
	}
	else
	{
	redirect('index');
	}	
}

public function getRackQty()
{
$rackQty=$this->db->query("select SUM(quantity) as s from tbl_product_serial where location_id='".$_GET['location_rack_id']."' and product_id='".$_GET['pid']."'");
$getQty=$rackQty->row();
echo $getQty->s;


}		

public function insertstockreff(){



extract($_POST);
if($save!=''){
//echo "hell";die;

 $a=sizeof($product_id);
for($i=0; $i<$a; $i++){
if($new_quantity[$i]!='')
{

//echo $product_id[$i];

		 $selectQuery = "select * from tbl_product_serial where product_id='$product_id[$i]' and  location_id='$rack_id[$i]' ";
		$selectQuery1=$this->db->query($selectQuery);

		 $num= $selectQuery1->num_rows();

		if($num >0)

		{	

		$secode=$product_id[$i]."_".$location_id1;
	
$this->db->query("update tbl_product_serial set quantity =quantity+$new_quantity[$i] where product_id='".$product_id[$i]."'  and location_id='$rack_id[$i]'");

$p_Q=$this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$rack_id[$i]',type='Production_stockIn',product_id='$product_id[$i]',f_id='$inbound_id', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$rack_id[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
$this->db->query($sqlProdLoc2);

 $this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 
$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$rack_id[$i]',type='Production_stockIn',product_id='$product_id[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."',f_id='$inbound_id', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);
 
 
  			
				}

	 $lastHdrId=$this->db->insert_id();
		
}
}

?>
<script>
alert('Quantity Added Successfully ');
window.close();
</script>

<?php

 }
//redirect('/StockRefill/add_multiple_qty');
} 


		
}