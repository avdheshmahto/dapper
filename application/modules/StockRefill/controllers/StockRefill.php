<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class StockRefill extends my_controller {

function __construct(){
   parent::__construct();
   $this->load->model('model_stock_refill');
}     


public function add_multiple_qty()
{
	if($this->session->userdata('is_logged_in'))
	{	
		$data=$this->Manage_StockRefill_Data();
		$this->load->view('multiple-product-transfer-quantity',$data);
	}

	else
	{
	   redirect('index');
	}
}

public function Manage_StockRefill_Data()
{



  	  $data['result'] = "";
 	  ////Pagination start ///
      $table_name  = 'tbl_product_stock';
	  $url        = site_url('/StockRefill/add_multiple_qty?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_stock_refill->count_refill($table_name,'A',$this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';
      if($_GET['entries']!="")
	  {
         $showEntries = $_GET['entries'];
         $url     = site_url('/StockRefill/add_multiple_qty?entries='.$_GET['entries']);
      }
      $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      //////Pagination end ///
   
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);	
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_stock_refill->filterStockRefill($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_stock_refill->getStockRefill($pagination['per_page'],$pagination['page']);
			
     return $data;



}

public function add_product_qty()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('add-product-quantity');
	}

	else
	{
	 redirect('index');
	}

}

public function getproduct(){
	if($this->session->userdata('is_logged_in')){
//$this->getSelect();
		$this->load->view('getproduct');
	}
	else
	{
	redirect('index');
	}
}

public function insertstockreff(){

//$location_id1='1';

extract($_POST);
if($save!=''){
//echo "hell";die;

$a=sizeof($product_id);
for($i=0; $i<$a; $i++){
if($new_quantity[$i]!='' and $location_id[$i]!='')
{
//echo $new_quantity[$i];die;

		 $selectQuery = "select quantity from tbl_product_serial where product_id='$product_id[$i]' and location_id='$location_id[$i]'";
		$selectQuery1=$this->db->query($selectQuery);

		 $num= $selectQuery1->num_rows();

		if($num >0)

		{	

		$secode=$product_id[$i]."_".$location_id[$i];
	
$this->db->query("update tbl_product_serial set quantity =quantity+$new_quantity[$i] where product_id='".$product_id[$i]."' and location_id='".$location_id[$i]."'");

$p_Q=$this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',product_id='$product_id[$i]', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."',color='$color[$i]' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$location_id[$i]', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."',color='$color[$i]'"; 
$this->db->query($sqlProdLoc2);

 $this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 
$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',product_id='$product_id[$i]', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);
 
 
  			
				}

	 $lastHdrId=$this->db->insert_id();
		
}
}

?>
<script>
alert('Quantity Added Successfully ');
</script>

<?php

 }
redirect('/StockRefill/add_multiple_qty');
} 
}
?>