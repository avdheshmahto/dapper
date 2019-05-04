<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class model_report extends CI_Model {

//=============================Payment Received Log=====================

function getPaymentReceivedLog($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_payment where status='PaymentReceived'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentReceivedLog($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_payment where status='PaymentReceived' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_received_log($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_payment where status='PaymentReceived' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=====================================Payment Log==========================================

function getPaymentLog($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_payment where status='payment'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentLog($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_payment where status='payment' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_log($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_payment where status='payment' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//=====================Payment=========================================


function getPayment($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_contact_m where group_name='5'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPayment($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_contact_m where group_name='5' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_contact_m where group_name='5' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//============================Payment Received================================

function getPaymentReceived($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_contact_m where group_name='4'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentReceived($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_contact_m where group_name='4' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_received($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_contact_m where group_name='4' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//====================Product Stock======================================

function getProduct($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_product_stock where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterProductList($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_product_stock where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_id'] != "")
						
						  $qry .= " AND sku_no = '".$get['p_id']."'";
						  
						  if($get['type'] != "")
						
						  $qry .= " AND type = '".$get['type']."'";
						  
						  
					  
					   if($get['p_name'] != "")
					
					     $qry .= " AND productname LIKE '%".$get['p_name']."%'";
					
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_product($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_product_stock where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_id'] != "")
						
						  $qry .= " AND Product_id = '".$get['p_id']."'";
					  
					   if($get['p_name'] != "")
					
					     $qry .= " AND productname LIKE '%".$get['p_name']."%'";
					   
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}



//========================Invoice=========================================

function getInvoice($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterInvoiceData($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cust_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cust_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_invoice($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cust_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cust_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=====================================Proforma Invoice===============


function getProInvoice($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_proforma_invoice_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterProInvoiceData($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_proforma_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cstmr_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cstmr_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_pro_invoice($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_proforma_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cstmr_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cstmr_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//===========================Template=============================


function getTemplate($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_quotation_purchase_order_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterTemplate($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_quotation_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['lot_no'] != "")						
						  $qry .= " AND lot_no = '".$get['lot_no']."'";
					  
					   if($get['p_name'] != "")
					    {
						    $sql1 = $this->db->query("select * from tbl_product_stock where productname like '%".$get['p_name']."%' ");
						    $sql2 = $sql1->row();					
					        $qry .= " AND product_id  = '$sql2->Product_id' ";
					    }
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_template($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_quotation_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['lot_no'] != "")						
						  $qry .= " AND lot_no = '".$get['lot_no']."'";
					  
					   if($get['contact_id'] != "")
					    {
						    
					       $qry .= " AND vendor_id  = '".$get['contact_id']."' ";
					    }
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=================================End===================================

function getSearchPacking($p_id,$f_date,$t_date) {

    $select_query = "Select * from tbl_production_log where production_status='packing'";
    
		if($p_id!='')
		{
			$sql1 = $this->db->query("select * from tbl_packing where packing_id = '$p_id' ");
			$sql2 = $sql1->row();						
			$select_query.=" and  qc_id = '$sql2->qc_id' ";	  
		}

		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$select_query .="and date >='$fdate1' and date <='$todate1'";
		}		
	$query = $this->db->query($select_query);
    return $query->result();
}

//===========================Purchase Order=================================


function getRmPlaningOrder($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_purchase_order_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterRmPlaningOrder($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")						
						  $qry .= " AND purchase_no = '".$get['p_no']."'";
					  
					   if($get['v_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['v_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_po($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")						
						  $qry .= " AND purchaseid = '".$get['p_no']."'";
					  
					   if($get['v_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['v_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//==========================Production========================

function getSearchMasterCutting($post,$limit=0, $start=0) 
{
		$p_name = $post['p_name']; $f_date = $post['f_date']; $t_date = $post['t_date'];$p_id   = $post['p_id'];$type = $post['type'];
    
	    if($p_id!='' || $p_name!='' || $f_date!='' || $t_date!='' || $type!='')
		{
            $select_query    = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A'"; 
        	
			if($p_id!=''){	$select_query.=" and PL.finishProductId  = '$p_id'"; }
			
			if($type!=''){	$select_query.=" AND PL.production_status = '".$type."'"; }
        	
			if($p_name!='')
			{				
		    	$sql1         = $this->db->query("select * from tbl_contact_m where first_name like '%$p_name%' ");
				$sql2         = $sql1->row();

				$select_query.=" and C.contact_id  = '$sql2->contact_id'";	  
			}
			if($f_date!='' && $t_date!='')
			{
			    $tdate   = explode("-",$t_date);
				$fdate   = explode("-",$f_date);
                $todate1 = $tdate[0]."-".$tdate[1]."-".$tdate[2];
		        $fdate1  = $fdate[0]."-".$fdate[1]."-".$fdate[2];
				$select_query .="and PL.date >='$fdate1' and PL.date <='$todate1'";
			}
		  }
       else{
       	
	 	  $select_query    = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' ";
	 	  }
	   
	   if($limit == "")
	   {
	 	  	$select_query   .= "  order by PL.production_log_id ASC ";
	 	  	$query = $this->db->query($select_query);
	   }
	   else
	   {
	 	    $select_query   .= "  order by PL.production_log_id ASC limit  $start, $limit";
	   }
		  $query = $this->db->query($select_query);
	      $data  = $query->result_array();
	      return $data;
}


function getOverLocking($post,$type)
{
   
    	$p_name = $post['p_name']; $f_date = $post['f_date']; $t_date = $post['t_date'];$p_id   = $post['p_id'];
        
		if($p_id!='' || $p_name!='' || $f_date!='' || $t_date!='')
		{
         
         if($type != 'Cutting')
		 {
              $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND PL.production_status = '".$type."'"; 
        }
		else
		{
        	 $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND (PL.production_status = '".$type."' OR PL.production_status = 'Raphu') ";	
        }

        if($p_id!='')
		{				
			$select_query.=" and PL.finishProductId  = '$p_id'";	  
		}

		if($p_name!='')
		{				
		    $sql1 = $this->db->query("select * from tbl_contact_m where first_name like '%$p_name%' ");
			$sql2 = $sql1->row();
			$select_query.=" and C.contact_id  = '$sql2->contact_id'";	  
		}
			
		if($f_date!='' && $t_date!='')
		{
			
			$tdate=explode("-",$t_date);
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
		    $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$select_query .="and PL.date >='$fdate1' and PL.date <='$todate1'";
		}
}
       else
	   {
	 	    if($type != 'Cutting')
			{
              $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND PL.production_status = '".$type."'"; 
            }
			else
			{
        	  $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND (PL.production_status = 'Cutting' OR PL.production_status = 'Raphu') ";	
        	}
	   }
		
		  $query = $this->db->query($select_query);
	      $data  = $query->result_array();
	      return $data;
}

function mod_finishgood()
{
      // $select_query = "Select * from tbl_product_stock where type = '14'";
      $query = $this->db->query("Select * from tbl_product_stock where type = '14'");
	  return $data  = $query->result_array();
}



}
?>