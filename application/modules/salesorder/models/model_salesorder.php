<?php
class model_salesorder extends CI_Model {
	
function salesorder_data(){
	  $query=$this->db->query("select * from tbl_sales_order_hdr where status='A' Order by salesid desc ");
	  
	  
      
	  return $result=$query->result();  
}

}
