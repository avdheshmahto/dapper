<?php
class model_inbound_order extends CI_Model {
	
//===================inbound==============

public function getInbound($last,$strat)
  {

	  $query=$this->db->query("select * from tbl_inbound_hdr where status='A' Order by inboundid desc limit $strat,$last ");
	  return $result=$query->result();  
  }

function filterInboundOrder($perpage,$pages,$get)
{
 	
			  $qry = "select * from model_inbound_order where status = 'A'";
					  
				 if(sizeof($get) > 0)
				 {
					
					   if($get['po_no'] != "")
						   $qry .= " AND purchase_no LIKE '%".$get['po_no']."%'";
					 
					   if($get['order_date'] != "")
					     $qry .= " AND order_date = '".$get['order_date']."' ";
              	   	  
					   if($get['puchase_contact'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_contact_m where first_name like '%".$get['puchase_contact']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->contact_id;
					   $qry         .= " AND purchase_contact ='$contactVal'";
              	   	   }  
					   
					   if($get['reivied_date'] != "")
					       $qry .= " AND revised_date = '".$get['reivied_date']."'";

					   if($get['po_status'] != "")
					       $qry .= " AND purchase_status = '".$get['po_status']."'";
					
				 }
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_inbound($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A'";
    
		if(sizeof($get) > 0)
		 {
					
					   if($get['purchaseid'] != "")
						   $qry .= " AND purchaseid = '".$get['purchaseid']."' ";
					 
					   if($get['date'] != "")
					     $qry .= " AND invoice_date = '".$get['date']."' ";
              	   	  
					   if($get['cust_name'] != "")
					   {
						   $unitQuery=$this->db->query("select * from tbl_contact_m where first_name like '%".$get['cust_name']."%' ");
						   $getUnit=$unitQuery->row();
						   $sr_no=$getUnit->contact_id;
					 
						   $qry .= " AND vendor_id ='$sr_no'";
              	   	   }  
					   
					   if($get['grand_total'] != "")
					       $qry .= " AND grand_total = '".$get['grand_total']."'";
					
		}
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}

function get_tblHdrData($id){
	$query     = $this->db->query("select * from tbl_purchase_order_hdr where purchaseid = $id ");
	$resultHdr = $query->row_array();
	$arr = "";
    if(sizeof($resultHdr) > 0){
    	// echo "<pre>";
    	// print_r($resultHdr);
    	// echo "</pre>";

        $arr['purchaseid']       = $resultHdr['purchaseid'];
        $arr['purchase_contact'] = $resultHdr['purchase_contact'];
        $arr['supplier_contact'] = $resultHdr['supplier_contact'];
        $arr['fob_incoterms']    = $resultHdr['fob_incoterms'];
        $arr['order_date']       = $resultHdr['order_date'];
        $arr['revised_date']     = $resultHdr['revised_date'];
        $arr['revised_by']       = $resultHdr['revised_by'];
        $arr['terms']            = $resultHdr['terms'];
        $arr['purchase_no'] 	 = $resultHdr['purchase_no'];
        $arr['ship_method']      = $resultHdr['ship_method'];
        $arr['ship_vip'] 		 = $resultHdr['ship_vip'];
        $arr['supplier']         = $resultHdr['supplier'];
        $arr['freight']          = $resultHdr['freight'];
        $arr['company']          = $resultHdr['company'];
        $arr['po_status']        = $resultHdr['po_status'];
        $arr['dtlData']          = array();

        $queryDtl  = $this->db->query("select D.*,S.productname,S.usageunit from tbl_purchase_order_dtl D,tbl_product_stock S where D.productid = S.Product_id AND D.purchaseorderhdr = $id ");
	    $resultDtl = $queryDtl->result_array();
        $i=0;
	    foreach ($resultDtl as $k => $dt) {
         $contQuery = $this->db->query("select keyvalue from tbl_master_data where serial_number='".$dt['usageunit']."'");
		 $cont_val  = $contQuery->row();

	     $arr['dtlData'][$i]['productid']    = $dt['productid'];
	     $arr['dtlData'][$i]['productname']  = $dt['productname'];
	     $arr['dtlData'][$i]['umo']          = $cont_val->keyvalue;
	     $arr['dtlData'][$i]['qty']          = $dt['qty'];
	     $i++;
	    }

      }

     //    echo "<pre>";
    	// print_r($arr);
    	// echo "</pre>";

    	return $arr;
  }

}
?>