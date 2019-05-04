<?php
class model_production extends CI_Model {
	
function getProduction($last,$strat)
{
	  $query=$this->db->query("select * from tbl_production_hdr where status='A' Order by productionid desc limit $strat,$last ");
	  return $result=$query->result();  
}

function filterProductionList($perpage,$pages,$get){
 	
	
					  $qry = "select * from tbl_production_hdr where status = 'A'";
					  
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

function count_production($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A'";
    
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