<?php
class model_finish extends CI_Model {
	
function getfinish($last,$strat)
{
	
	  $query=$this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and module_name='Finish'    group by lot_no desc limit $strat,$last ");
	  return $result=$query->result();  
}

function filterfinishList($perpage,$pages,$get){
 	
	
					  $qry = "select * from tbl_production_order_log where status = 'A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_id'] != "")
						
						  $qry .= " AND productionid = '".$get['p_id']."'";
					  
					   if($get['date'] != "")
					
					     $qry .= " AND date LIKE '%".$get['date']."%'";
						  
					   if($get['goods'] != "")
					    {
						  
						   $unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['goods']."%'");
						   $getUnit=$unitQuery->row();
						   $sr_no=$getUnit->Product_id;
					 
						 $qry .= " AND product_id ='$sr_no'";
			  
					    } 
					 
					   if($get['qty'] != "")
					
					     $qry .= " AND qty = '".$get['qty']."'"; 
				    }
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_finish($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from tbl_production_order_log where status='A'";
    
		if(sizeof($get) > 0)
		 {
					
					   if($get['p_id'] != "")
						
						  $qry .= " AND productionid = '".$get['p_id']."' ";
					  
					   if($get['date'] != "")
					
					     $qry .= " AND date LIKE '%".$get['date']."%'";
						  
					   if($get['goods'] != "")
					    {
						  
						   $unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['goods']."%'");
						   $getUnit=$unitQuery->row();
						   $sr_no=$getUnit->Product_id;
					 
						 $qry .= " AND product_id ='$sr_no'";
			  
					    } 
					 
					   if($get['qty'] != "")
					
					     $qry .= " AND qty = '".$get['qty']."'"; 
		 }
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}




}
?>