<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class productionModule extends my_controller {

function __construct(){
   parent::__construct();
   $this->load->library('pagination');
   $this->load->model('model_production');
}

public function manage_jobwork_map(){

	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-jobwork-map');
	}
	else
	{
	redirect('index');
	}
}

public function manage_jobwork_view(){

  if($this->session->userdata('is_logged_in')){
    $this->load->view('manage-jobwork-view');
  }else {
    redirect('index');
  }
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

public function add_grn()
{
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-grn');
	}
	else
	{
	redirect('index');
	}
}

public function manage_grn()
{

	if($this->session->userdata('is_logged_in')){

	$data = $this->Manage_Inbound_Data();
	$this->load->view('manage-grn',$data);
	}
	else
	{
	redirect('index');
	}

}

public function Manage_Inbound_Data()
{

  	  $data['result'] = "";
      $table_name  = 'tbl_production_grn_hdr';
	  $sgmnt      = "4";
	  if($_GET['entries']!="")
	  {
		  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries = 10;
	  }
      $totalData  = $this->model_production->count_inbound($table_name,'A',$this->input->get());

      if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
	  	$url  = site_url('/inbound/manage_inbound?entries='.$_GET['entries']);

	  }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {

		$url  = site_url('/inbound/manage_inbound?po_no='.$_GET['po_no'].'&date='.$_GET['date'].'&grn_no='.$_GET['grn_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);

      }
	  else
	  {
	  	 $url  = site_url('/inbound/manage_inbound?');

	  }
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
	  $data=$this->user_function();
      $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination']        = $this->pagination->create_links();

	 if($this->input->get('filter') == 'filter')
        	$data['result']       = $this->model_production->filterInboundOrder($pagination['per_page'],$pagination['page'],$this->input->get());
          	else
    		$data['result'] = $this->model_production->getInbound($pagination['per_page'],$pagination['page']);
	    return $data;
}

public function manage_production(){

	if($this->session->userdata('is_logged_in')){
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
	 	///Pagination start ///
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
    $sumQty=0;
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

				if($qty[$i]!=''){
				  $this->db->query("update tbl_overlock set qty='".$qty[$i]."', customer_name='".$contact_id[$i]."', date='".$date[$i]."' where overlock_id='".$overlock_id[$i]."'");
				}

					$lastid=$overlock_id[$i];
				}

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


		$rediectInvoice="production/manage_production";
		redirect($rediectInvoice);
	}

	public function updateProduction(){

		extract($_POST);
		$table_name ='tbl_production_hdr';
		$table_name_dtl ='tbl_production_dtl';
		$pri_col ='productionid';
		$pri_col_dtl ='productionhdr';
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


public function print_request_challan()
{
	$data=array(
	'id' => $_GET['id']
	);
	$this->load->view("print-request-challan",$data);
}


public function print_issue_challan()
{
	$data=array(
	'id' => $_GET['id']
	);
	$this->load->view("print-issue-challan",$data);
}

public function stock_refill_qty1($qty,$main_id)
	{

		$this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id' and type='13'");

	}

public function stock_refill_qty($qty,$main_id,$production_id)
	{

	$gethdrQuery=$this->db->query("select * from tbl_template_hdr where product_id='".$main_id."'");
	$gethdrfetch=$gethdrQuery->row();
	//echo $gethdrfetch->templateid;
	$getdtlQuery=$this->db->query("select * from tbl_template_dtl where templatehdr='".$gethdrfetch->templateid."'");
	foreach($getdtlQuery->result() as $getdtlfetch){
		echo $getdtlfetch->product_id;
		$tot_qty=$getdtlfetch->quantity*$qty;
		$this->db->query("update tbl_product_stock set quantity=quantity-'$tot_qty' where Product_id='$getdtlfetch->product_id' and type='28'");
	}

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
	$a=sizeof($product_id);
	for($i=0; $i<$a; $i++){
	if($new_quantity[$i]!='')
	{
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

}

public function getPart()

{
@extract($_POST);
$data=array('id' => $shape,
'production_id' => $production_id,
'shapeName'=> $shapeName
);
$this->load->view("getpartCode",$data);

}

public function getPartPo()
{
@extract($_POST);
$data=array('id' => $shape,
'production_id' => $production_id,
);
$this->load->view("getpartPoCode",$data);

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
				'order_type' => $order_type,
				'date' => $date,
				'shape_id' => $shapeId[$i],
				'part_id' => $part_c[$i],
				'rm_id' => $rm_code[$i],
				'qty' => $qtyy[$i],
				'weight' => $weight_qty[$i],
				'total_weight' => $total_weight[$i],
				'rate' => $rate_rs[$i],
				'total_rm_rate_rs' => $total_rm_rate_rs[$i],
				'labour_rate_co' => $labour_rate_rs[$i],
				'total_labour_rate' => $total_labour_rate[$i],
				'total_cost' => $total_cost[$i],
				'production_id' => $production_id,
				'type' => $type,
				'shape_qty' => $shape_qty
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
			$dataZ=explode(",",$rm_code[$i]);
			$dataQ=explode(",",$qtyy[$i]);
			$dataW=explode(",",$weight_qty[$i]);
			$dataR=explode(",",$rate_rs[$i]);
			$total_weightR=explode(",",$total_weight[$i]);
			$total_rm_rate_rsR=explode(",",$total_rm_rate_rs[$i]);
			$labour_rate_coR=explode(",",$labour_rate_rs[$i]);
			$total_labour_rateR=explode(",",$total_labour_rate[$i]);
			$total_costR=explode(",",$total_cost[$i]);

			$cntP=count($dataP);

			for($j=0;$j<$cntP;$j++)
			{

				if($dataQ[$j] != '') {
				$data=array(

					'vendor_id' => $vendor_id,
					'date' => $date,
					'job_order_no' => $job_order_no,
					'lot_no' => $lot_number,
					'order_type' => $order_type,
					'shape_id' => $shapeId[$i],
					'part_id' => $dataP[$j],
					'rm_id'  => $dataZ[$j],
					'qty' => $dataQ[$j],
					'weight' => $dataW[$j],
					'rate' => $dataR[$j],
					'total_weight' => $total_weightR[$j],
					'total_rm_rate_rs' => $total_rm_rate_rsR[$j],
					'labour_rate_co' => $labour_rate_coR[$j],
					'total_labour_rate' => $total_labour_rateR[$j],
					'total_cost' => $total_costR[$j],
					'production_id' => $production_id,
					'type' => $type,
					'shape_qty' => $shape_qty
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
}
echo "1";


}


public function insert_po_production_order()
{
@extract($_POST);
$table_name='tbl_po_order';
$cnt=count($shapeId);
for($i=0;$i<$cnt;$i++){

$data=array(
'vendor_id' => $vendor_id,
'po_order_no' => $job_order_no,
'date' => $date,
'shape_id' => $shapeId[$i],
'part_id' => $part_c[$i],
'qty' => $qtyy[$i],
'production_id' => $production_id,
'type' => $type,
'shape_qty' => $shape_qty
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
'po_order_no' => $job_order_no,
'shape_id' => $shapeId[$i],
'part_id' => $dataP[$j],
'qty' => $dataQ[$j],
'production_id' => $production_id,
'type' => $type,
'shape_qty' => $shape_qty
);

$sesio = array(
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),

					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
				);


$dataall = array_merge($data,$sesio);
$this->Model_admin_login->insert_user(tbl_po_order_log,$dataall);


}
}
echo "1";


}



public function getWorkOrder()
{
	@extract($_POST);
	$data=array('id' => $id);
	$this->load->view("getWorkOrder",$data);
}


public function getPurchaseOrder()
{
	@extract($_POST);
	$data=array('id' => $id);
	$this->load->view("getPurchaseOrder",$data);
}

public function view_request_raw()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-request-raw",$data);
}

public function view_scrap_order()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-scrap-order",$data);
}


public function view_transfer_order()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-transfer-order",$data);
}


public function view_repair_order()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-repair-order",$data);
}

public function view_check_order()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-check-order",$data);
}

public function getPurchaseRawOrder()
{
	@extract($_POST);
	$data=array('id' => $id);
	$this->load->view("getPurchaseRawOrder",$data);
}

public function getRmReturn()
{
	@extract($_POST);
	$data=array('id' => $id);
	$this->load->view("getRMreturnPage",$data);
}


public function view_work_order()
{
	$data=array('id' => $_GET['ID']);
	$this->load->view("view_work_order",$data);
}

function view_Stock(){

   if($this->session->userdata('is_logged_in'))
	{
		$data = $this->manageItemJoinfun();
		$this->load->view('productionModule/manage-stock',$data);
	}
	else
	{
		redirect('index');
	}
}


public function manageItemJoinfun()
{

  $table_name='tbl_product_stock';
  $data['result'] = "";
  //$url   = site_url('/master/Item/manage_item?');
  $sgmnt = "4";
	if($_GET['entries'] != '')
	{
		$showEntries = $_GET['entries'];
	}
	else
		  {
			$showEntries= 10;
		  }

	   $totalData   = $this->model_production->count_product($table_name,'A',$this->input->get());

		if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
		  {
			 $url = site_url('/productionModule/view_Stock?entries='.$_GET['entries']);
		  }
		elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
		  {
			$url = site_url('/productionModule/view_Stock?sku_no='.$_GET['sku_no'].'&type='.$_GET['type'].'&category='.$_GET['category'].'&productname='.$_GET['productname'].'&usages_unit='.$_GET['usages_unit'].'&size='.$_GET['size'].'&thickness='.$_GET['thickness'].'&gradecode='.$_GET['gradecode'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		  }
		else
		  {
			$url = site_url('/productionModule/view_Stock?');
		  }

		  $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
		  $data       = $this->user_function();
 		  $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		  $data['pagination'] = $this->pagination->create_links();

		if($this->input->get('filter') == 'filter')
		  $data['result'] = $this->model_production->filterProductList($pagination['per_page'],$pagination['page'],$this->input->get());
		else
		  $data['result'] = $this->model_production->product_get($pagination['per_page'],$pagination['page']);

	    return $data;
   }

function transfer_work_order()
{
	@extract($_POST);
	$data=array('id' => $id);
  	$this->load->view('transfer_work_order',$data);
}



public function insert_po_production()
{
		@extract($_POST);
		$table_name     = 'tbl_purchase_order_production_hdr';
		$table_name_dtl = 'tbl_purchase_order_production_dtl';
		$pri_col        = 'purchaseid';
		$pri_col_dtl    = 'purchase_dtl_id';
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


					'vendor_id'      => $this->input->post('vendor_id'),
					'date' => $this->input->post('date'),
					'production_id' => $this->input->post('production_id')

				);

			$data_merge = array_merge($data,$sess);
			//print_r($data_merge);
			//die;
		    $this->load->model('Model_admin_login');
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();
			$this->load->model('Model_admin_login');
			for($i=0; $i<count($mproPrice); $i++)
				{

				if($mproPrice[$i]!=''){

                    $data_dtl=array(
					 'purchaseid' => $lastHdrId,
					 'productid' => $prodcId[$i],

					 'qty' => $mproPrice[$i],

					 'maker_id' => $this->session->userdata('user_id'),
					 'maker_date' => date('y-m-d'),
					 'comp_id' => $this->session->userdata('comp_id'),
					 'zone_id' => $this->session->userdata('zone_id'),
					 'brnh_id' => $this->session->userdata('brnh_id')
					);

					$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
		}
	}
	echo "1";

}

public function print_challan()
{
	$data=array('id' => $_GET['id']);
	$this->load->view("print-challan",$data);
}

public function print_po_challan()
{
	$data=array('id' => $_GET['id']);
	$this->load->view("print-po-challan",$data);
}

public function view_purchase_order()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-purchase-order",$data);
}

function ajax_getitemmapping(){

    $data['result'] =  $this->model_production->modgetitemspharemap($this->input->post('id'));
    $this->load->view('view_itemmapping',$data);
 }

 function ajax_print_itemmapping()
 {
    $this->load->view('print-item-mapping');
 }

function insert_issue_row_material(){

		@extract($_POST);
		$table_name     = 'tbl_issuematrial_hdr';
		$table_name_dtl     = 'tbl_issuematrial_dtl';

		$sess = array(

					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);

		$data=array(
					'date' => $date,
					'request_no' => $request_no,
					'po_no' => $req_production_id,
					'lot_no' => $lot_no,
					'job_order_no' => $job_order_no
		);
		    $this->load->model('Model_admin_login');
			$data_merge = array_merge($data,$sess);
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
		    $lastId= $this->db->insert_id();

			for($i=0; $i<count($mproPrice); $i++)
				{

				if($mproPrice[$i]!=''){

                    $data_dtl=array(
                    'inboundrhdr' => $lastId,
					 'productid' => $prodcId[$i],
					 'receive_qty' => $mproPrice[$i],
					 'order_qty' => $order_qty[$i],
					 'maker_id' => $this->session->userdata('user_id'),
					 'maker_date' => date('y-m-d'),
					 'comp_id' => $this->session->userdata('comp_id'),
					 'zone_id' => $this->session->userdata('zone_id'),
					 'brnh_id' => $this->session->userdata('brnh_id')
					);

				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
		}
	}
	echo "1";

 }


public function getPo()
{
	@extract($_GET);
	$queryData=$this->db->query("select *from tbl_po_order where vendor_id='$ID'");
	echo "<option value=''>--Select--</option>";
	foreach($queryData->result() as $getPo)
	{
		echo "<option value='$getPo->po_order_no'>$getPo->po_order_no</option>";
	}
}


public function getPoDtl()
{

	@extract($_GET);
	$productQuery=$this->db->query("select * from tbl_po_order_log where po_order_no='$ID'  ");
		$i=1;
		foreach($productQuery->result() as $getProduct){

		####### get product #######

		$productStockQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getProduct->part_id'");
		$getProductStock=$productStockQuery->row();
		####### ends ########

		####### get UOM #######
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########

		####### get UOM #######
		$inbQ="select SUM(receive_qty) as rec_qty from tbl_production_grn_log where productid='$getProduct->part_id' and po_no='$getProduct->po_order_no'";
											$inbountLogQuery=$this->db->query($inbQ);
											$getInbound=$inbountLogQuery->row();
		####### ends ########

											$remQQ=$getProduct->qty-$getInbound->rec_qty;

        echo "<tr class='gradeX odd' role='row'>
        <td class='size-60 text-center sorting_1'>$i</td>

		<td>$getProductStock->sku_no


        <input type='hidden'  name='productid[]' value='$getProduct->part_id' class='form-control'>
        </td>
		<td>$getProductUOM->keyvalue</td>
		<td>$getProduct->qty</td>
      	<td>$remQQ<input type='hidden' id='rem_qty$i' min='0' name='remaining_qty[]' value=$remQQ class='form-control'>

        <input type='hidden' name='po_no' value='$getProduct->po_order_no' />


        </td>
        <td><input type='number' min='1' name='receive_qty[]' id='rec_qty$i' onkeyup='qtyValidation(this.id);' class='form-control'>

        <input type='hidden' name='validationCheck' id='validationCheck' value='0' />
        </td>
</tr>";

$i++;
}

}


public function productPoGrn()
{

		extract($_POST);
		$table_name ='tbl_production_grn_hdr';
		$table_name_dtl ='tbl_production_grn_dtl';
		$pri_col ='inboundid';
		$pri_col_dtl ='inbound_dtl_id';
		$pri_col_hdr_log='tbl_production_grn_log';

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

				'po_no'    => $this->input->post('po_no'),
				'vendor_id'    => $this->input->post('vendor_id'),
				'production_id' => $GRNproduction_id,

				);

			$data_merge = array_merge($data,$sess);
		    $this->load->model('Model_admin_login');
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();
			$this->load->model('Model_admin_login');
			$rows=count($productid);
		    for($i=0; $i<$rows; $i++)
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
				 'grn_no'       => $this->input->post('grn_no'),
				 'grn_date'			=> $this->input->post('grn_date'),
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);


			  $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
			  $this->Model_admin_login->insert_user($pri_col_hdr_log,$data_dtl_log);
	  		  $this->po_stock_in($receive_qty[$i],$productid[$i],$storage_location);

	  	echo "1";
		 }
	 }
}

public function view_inbound()
{
	@extract($_GET);
	$data=array('id' => $ID);
	$this->load->view("view-inbound",$data);
}

public function print_grn_challan()
{
	@extract($_GET);
	$data=array('id' => $id);
	$this->load->view("print-grn-challan",$data);

}


public function po_stock_in($receive_qty,$productid,$storage_location)
{


		$selectQuery = "select * from tbl_product_serial where product_id='$productid' and location_id='$storage_location'";
		$selectQuery1=$this->db->query($selectQuery);
		$num= $selectQuery1->num_rows();
		if($num>0){
		$this->db->query("update tbl_product_serial set quantity=quantity+'$receive_qty',location_id='$storage_location' where product_id='$productid' and location_id='1' ");
					}else{
							$comp_id = $this->session->userdata('comp_id');
							$divn_id = $this->session->userdata('divn_id');
							$zone_id = $this->session->userdata('zone_id');
							$brnh_id = $this->session->userdata('brnh_id');
							$maker_date= date('y-m-d');
							$author_date= date('y-m-d');

							$this->db->query("insert into tbl_product_serial set quantity='$receive_qty',location_id='$storage_location',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");


							$this->db->query("insert into tbl_product_serial_log set quantity='$receive_qty',location_id='$storage_location',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");

		}


}

public function view_raw_receive()
{

	@extract($_POST);
	$data=array('id' => $id,
	'po_no' => $po_id,
	);
	$this->load->view("receive-raw-material",$data);
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



public function scrap_grn_details()
{
	@extract($_POST);
	$data=array('id' => $id,
	'order_type' => $order_type,
	'lot_no' => $lot_no,
	'scrap_id' => $scrap_id
	);
	$this->load->view("scrap-grn-details",$data);
}

public function order_check()
{
	@extract($_POST);
	$data=array(
	'id' => $id,
	'order_type' => $order_type,
	'lot_no' => $lot_no,
	'job_lot_no' => $job_lot_no
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

public function order_details_repair_grn()
{
	@extract($_POST);
	$data=array('id' => $id,
	'order_type' => $order_type,
	'lot_no' => $lot_no
	);
	$this->load->view("order-details-repair-grn",$data);
}



public function order_transfer()
{
	@extract($_POST);
	$data=array(
	'id' => $id,
	'order_type' => $order_type,
	'lot_no' => $lot_no,
	'jo_no' => $jo_no
	);
	$this->load->view("order-transfer",$data);
}

function insert_receive_row_material(){

		@extract($_POST);
		$table_name_dtl     = 'tbl_receive_matrial_grn_log';
		$sess = array(

					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);

			for($i=0; $i<count($qty); $i++)
				{

				if($qty[$i]!=''){

                    $data_dtl=array(
                     'po_no' => $req_production_id[$i],
					 'productid' => $productid[$i],
					 'receive_qty' => $qty[$i],
					 'maker_id' => $this->session->userdata('user_id'),
					 'maker_date' => date('y-m-d'),
					 'comp_id' => $this->session->userdata('comp_id'),
					 'zone_id' => $this->session->userdata('zone_id'),
					 'brnh_id' => $this->session->userdata('brnh_id')
					);
					$data_merge = array_merge($data_dtl,$sess);
				//$this->stock_refill_qty($qty[$i],$main_id[$i]);
				$this->Model_admin_login->insert_user($table_name_dtl,$data_merge);

$selectSerial=$this->db->query("select *from tbl_product_serial where product_id='$productid[$i]' and location_id='1'");
$SerialCnt=$selectSerial->num_rows();
				if($SerialCnt>0)
				{
					$this->db->query("update tbl_product_serial set quantity=quantity+'$qty[$i]' where  product_id='$productid[$i]' and location_id='1'");
					$this->db->query("update tbl_product_stock set quantity=quantity-'$qty[$i]' where  Product_id='$productid[$i]'");
				}
				else
				{
$this->db->query("insert into tbl_product_serial set quantity='$qty[$i]', product_id='$productid[$i]', location_id='1'");
$this->db->query("update tbl_product_stock set quantity=quantity-'$qty[$i]' where  Product_id='$productid[$i]'");

				}
		}
	}
	echo "1";
}


public function productionOrderInsert()
{

		extract($_POST);
		$table_name ='tbl_production_order_log';
		$table_name_available='tbl_production_available_order';

			$this->load->model('Model_admin_login');
			$rows=count($qty);

		    for($i=0; $i<$rows; $i++)
		    {

		    	if($process_ends[$i]=='')
		    	{
		    			$p_ends='0';
		    	}
		    	else
		    	{
						$p_ends='1';
		    	}
		    	
			  if($qty[$i]!=''){
                 $data_dtl=array(
				 'lot_no'		=> $lot_no,
				 'order_no'		=> $order_no,
				 'order_type'		=> $order_type,
				 'grn_no' => $grn_no,
				 'grn_date' => $grn_date,
				 'grn_type' => $grn_type,
				 'vendor_id' => $vendor_id,
				 'job_order_id' => $job_order_id,
				 'productid'		=> $productid[$i],
				 'qty'		=> $qty[$i],

				 'rm_id'		=> $rmOrdId[$i],

				 'process_ends' => $p_ends,
				 'weight' => $weight[$i],
				 'total_weight' => $total_weight[$i],
				 'rate' => $rate[$i],
				 'total_rm_rate' => $total_rm_rate[$i],
				 'total_labour_rate' => $total_labour_rate[$i],
				 'total_cost' => $total_cost[$i],
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);

                // print_r($data_dtl);die;

$data_dtl_avl=array(
					'lot_no'		=> $lot_no,
					'order_no'		=> $order_no,
					'vendor_id' => $vendor_id,
					'job_order_id' => $job_order_id,
					'productid'		=> $productid[$i],
					'transfer_qty'		=> $qty[$i],
					'weight' => $weight[$i],
				 	'total_weight' => $total_weight[$i],
				 	'rate' => $rate[$i],
				 	'total_rm_rate' => $total_rm_rate[$i],
					'total_labour_rate' => $total_labour_rate[$i],
				 	'total_cost' => $total_cost[$i],
					'maker_id'			=> $this->session->userdata('user_id'),
					'maker_date'		=> date('y-m-d'),
					'comp_id'			=> $this->session->userdata('comp_id'),
					'zone_id'			=> $this->session->userdata('zone_id'),
					'brnh_id'			=> $this->session->userdata('brnh_id')
				);


				 $this->Model_admin_login->insert_user($table_name,$data_dtl);

				 $this->Model_admin_login->insert_user($table_name_available,$data_dtl_avl);



	if($grn_type=='Job Order')
	{
	     $rm_q=$qty[$i]+$rm_qty[$i];
		 if($ord_qty[$i]==$rm_q)
		 {
			 $this->db->query("update tbl_job_work set status='2' where job_order_no='$order_no'");
		 }
		 else
		 {
			  $this->db->query("update tbl_job_work set status='3' where job_order_no='$order_no'");
		 }

	}

	if($grn_type=='rm_receive')
	{
		 $rm_q=$qty[$i]+$rm_qty[$i];
		 if($ord_qty[$i]==$rm_q)
		 {
			 $this->db->query("update tbl_issuematrial_hdr set status='2' where po='$order_no'");
		 }
		 else
		 {
			  $this->db->query("update tbl_job_work set status='3' where po='$order_no'");
		 }

	}



	  		  $this->po_stock_in($qty[$i],$productid[$i],$storage_location);


		 }
	 }

	 echo "1";
}




public function productionOrderRepair()
{

		extract($_POST);

		$table_name ='tbl_production_order_repair';


			$this->load->model('Model_admin_login');
			$rows=count($qty);

		    for($i=0; $i<$rows; $i++)
		    {
			  if($qty[$i]!=''){
                 $data_dtl=array(
				 'lot_no'		=> $lot_no,
				 'order_no'		=> $order_no,
				 'repair_no' => $repair_no,
				 'repair_date' => $repair_date,
				 'vendor_id' => $vendor_id,
				 'job_order_id' => $job_order_id,
				 'productid'		=> $productid[$i],
				 'qty'		=> $qty[$i],
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);

			  $this->Model_admin_login->insert_user($table_name,$data_dtl);

		 }
	 }
	 echo "1";
}



public function productionOrderTransferToModule()
{

		extract($_POST);
		$table_name ='tbl_production_order_transfer_another_module';

			$this->load->model('Model_admin_login');
			$rows=count($qty);

		    for($i=0; $i<$rows; $i++)
		    {
			  if($qty[$i]!=''){
                 $data_dtl=array(
				 'lot_no'		=> $lot_no,

				 'jo_no'        => $jo_no,
				 
				 'order_no'		=> $order_no,
				 'transfer_no' => $transfer_no,
				 'transfer_date' => $transfer_date,
				 'module_name' => $module_name,
				 'vendor_id' => $vendor_id,
				 'job_order_id' => $job_order_id,
				 'productid'		=> $productid[$i],
				 'qty'		=> $qty[$i],

				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);

			  $this->Model_admin_login->insert_user($table_name,$data_dtl);

		 }
	 }
	 echo "1";
}

public function productionOrderCheck()
{
	extract($_POST);
	$table_name ='tbl_production_order_check';
	$table_name_available='tbl_production_available_order';
	$this->load->model('Model_admin_login');
	$rows=count($productid);

    for($i=0; $i<$rows; $i++)
		{
		if($transfer_qty[$i]!='' or $repair_qty[$i]!='' or $scrap_qty[$i]!='' or $test_qty[$i]!=''){

			$data_dtl=array(
				'lot_no'		=> $lot_no,
				'order_no'		=> $order_no,
				'check_no'		=> $check_no,
				'check_date'	=> $check_date,
				'vendor_id'		=> $vendor_id,
				'job_order_id'	=> $job_order_id,
				'productid'		=> $productid[$i],
				'transfer_qty'	=> $transfer_qty[$i],
				'repair_qty'	=> $repair_qty[$i],
				'scrap_qty'		=> $scrap_qty[$i],
				'test_qty'		=> $test_qty[$i],
				'name'			=> $name[$i],
				'order_type'	=> $order_type,
				'maker_id'		=> $this->session->userdata('user_id'),
				'maker_date'	=> date('y-m-d'),
				'comp_id'		=> $this->session->userdata('comp_id'),
				'zone_id'		=> $this->session->userdata('zone_id'),
				'brnh_id'		=> $this->session->userdata('brnh_id')
				);


				 $this->Model_admin_login->insert_user($table_name,$data_dtl);
				 if($transfer_qty[$i]!='')
				 {
				 $this->Model_admin_login->insert_user($table_name_available,$data_dtl);
				}

		 }

	 }
	 echo "1";
}


public function view_production_log_cont()
{
	@extract($_POST);
	$data=array('id' => $id,
	'ord' => $ord
	);
	$this->load->view("view-production-log",$data);
}

public function view_rm_details()
{
	@extract($_POST);
	$data=array('id' => $id,
	'ord' => $ord
	);
	$this->load->view("view-rm-details",$data);
}

public function manage_jobwork_map_details()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("manage-jobwork-map-details",$data);
}

public function manage_jobwork_map_rm_details()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("manage-jobwork-map-rm-details",$data);
}

public function manage_jobwork_map_order_repair()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("manage-jobwork-map-order-repair",$data);
}

public function getGRNOrder()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("getGrnOrder",$data);
}

public function getCheckingOrder()
{

	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("getCheckingOrder",$data);
}


public function ajexRequestRM()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("getRequestRM",$data);
}

public function ajexRequestRepair()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("getRequestRepair",$data);
}


public function order_details_rm()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("order-details-rm",$data);
}


public function order_details_repair()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("order-details-repair",$data);
}

public function view_rm()
{

	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("view-production-rm",$data);
}

public function myProduction_order_receive()
{
echo "dfsd";die;
}


public function search_job_order()
{
	$this->load->view("search-job-order");
}


public function purchase_order_return()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("purchase-order-return",$data);
}

public function rm_return()
{
	@extract($_POST);
	$data=array('id' => $id,
	);
	$this->load->view("rm-return",$data);
}


public function productionPurchaseReturn()
{

	extract($_POST);

		$table_name ='tbl_job_purchase_order_return';


			$this->load->model('Model_admin_login');
			$rows=count($qty);

		    for($i=0; $i<$rows; $i++)
		    {
			  if($qty[$i]!=''){
                 $data_dtl=array(
				 'lot_no'		=> $lot_no,
				 'order_no'		=> $order_no,
				 'return_no' => $return_no,
				 'return_date' => $return_date,
				 'vendor_id' => $vendor_id,
				 'job_order_id' => $job_order_id,
				 'part_id'		=> $productid[$i],
				 'qty'		=> $qty[$i],
				 'maker_id'			=> $this->session->userdata('user_id'),
				 'maker_date'		=> date('y-m-d'),
				 'comp_id'			=> $this->session->userdata('comp_id'),
				 'zone_id'			=> $this->session->userdata('zone_id'),
				 'brnh_id'			=> $this->session->userdata('brnh_id')
				);

			  $this->Model_admin_login->insert_user($table_name,$data_dtl);

		 }
	 }
	 echo "1";

}


public function productionRMReturn()
{
	extract($_POST);
	$table_name ='tbl_job_rm_return';
	$this->load->model('Model_admin_login');
	$rows=count($qty);
	for($i=0; $i<$rows; $i++)
		{
			if($qty[$i]!=''){
            $data_dtl=array(
				'lot_no'		=> $lot_no,
				'order_no'		=> $order_no,
				'return_no'		=> $return_no,
				'return_date'	=> $return_date,
				'vendor_id'		=> $vendor_id,
				'job_order_id'	=> $job_order_id,
				'productid'		=> $productid[$i],
				'qty'			=> $qty[$i],
				'order_qty'		=> $order_qty[$i],
				'maker_id'		=> $this->session->userdata('user_id'),
				'maker_date'	=> date('y-m-d'),
				'comp_id'		=> $this->session->userdata('comp_id'),
				'zone_id'		=> $this->session->userdata('zone_id'),
				'brnh_id'		=> $this->session->userdata('brnh_id')
			);
			$this->Model_admin_login->insert_user($table_name,$data_dtl);
			$this->db->query("update tbl_product_stock set quantity=quantity+'$qty[$i]' where Product_id='$productid[$i]'");
			$this->db->query("update tbl_product_serial set quantity=quantity+'$qty[$i]',qn_pc=qn_pc+'$order_qty[$i]',location_id='1' where product_id='$productid[$i]' and location_id='1' ");
		  	}
	 	}
	echo "1";
}


public function productionOrderScrapInsert()
{
	extract($_POST);
	$table_name ='tbl_job_work_scrap';
	$this->load->model('Model_admin_login');
	$rows=count($qty);
	for($i=0; $i<$rows; $i++)
	{
		if($qty[$i]!=''){
        	$data_dtl=array(
				'lot_no'	=> $lot_no,
				'order_no'	=> $order_no,
				'invoice_no'=> $invoice_no,
				'grn_no'	=> $grn_no,
				'grn_date'	=> $grn_date,
				'job_order_id'=> $job_order_id,
				'productid'	=> $productid[$i],
				'qty'		=> $qty[$i],
				'maker_id'	=> $this->session->userdata('user_id'),
				'maker_date'=> date('y-m-d'),
				'comp_id'	=> $this->session->userdata('comp_id'),
				'zone_id'	=> $this->session->userdata('zone_id'),
				'brnh_id'	=> $this->session->userdata('brnh_id')
				);

				$this->Model_admin_login->insert_user($table_name,$data_dtl);
				$this->db->query("update tbl_product_stock set quantity=quantity+'$qty[$i]' where Product_id='$productid[$i]'");
		   	}
	}
	echo "1";
}


public function raw_material_scrap()
{
	$this->load->view("raw-material-scrap");
}

public function manage_scrap_job_work()
{

$this->load->view("manage-scrap-job-work");

}


public function manage_scrap_job_work_details()
{
$this->load->view("manage-scrap-job-work-details");

}


public function print_challan_grn()
{
	$data=array('id' => $_GET['id']);
	$this->load->view("print-challan-grn",$data);
}


public function print_rm_return()
{
	$data=array('id' => $_GET['id']);
	$this->load->view("print-rm-return",$data);
}


public function view_rm_order_details()
{
	$data=array('id' => $_GET['ID']);
	$this->load->view("view-rm-order-details",$data);
}


}
