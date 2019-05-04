<?php
class model_stock_refill extends CI_Model {
	
function invoice_data()
{
	  $query=$this->db->query("select * from tbl_invoice_hdr");
	  return $result=$query->result();  
}


//=====================Invoice=================

public function getStockRefill($last,$strat)
  {

	  $query=$this->db->query("select * from tbl_product_stock where status='A' and type!='14' limit $strat,$last ");
	  return $result=$query->result();  
  }

function filterStockRefill($perpage,$pages,$get)
{
 	
			  $qry = "select * from tbl_product_stock where status='A' and type!='14' ";
					  
				 if(sizeof($get) > 0)
				 {
					
					   if($get['cat'] != "")
						   $qry .= " AND category = '".$get['cat']."' ";
					 
					  if($get['productname'] != "")
						   $qry .= " AND productname like '%".$get['productname']."%' ";	
					
				 }
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_refill($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A' and type!='14' ";
    
		if(sizeof($get) > 0)
		 {
					
			  if($get['cat'] != "")
				   $qry .= " AND category = '".$get['cat']."' ";
			 
			  if($get['productname'] != "")
				   $qry .= " AND productname like '%".$get['productname']."%' ";	
			
		}
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}



}
?>