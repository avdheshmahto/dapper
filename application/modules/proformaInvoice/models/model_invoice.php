<?php
class model_invoice extends CI_Model
{
    
    function invoice_data()
    {
        $query = $this->db->query("select * from tbl_proforma_invoice_hdr");
        return $result = $query->result();
    }
    
    //=========Invoice==============
    
    public function getInvoice($last, $strat)
    {
        $query = $this->db->query("select * from tbl_proforma_invoice_hdr where status='A' Order by invoiceid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterInvoice($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_proforma_invoice_hdr where status = 'A'";
        
        if (sizeof($get) > 0) {
            
            if ($get['invoiceid'] != "")
                $qry .= " AND invoiceid = '" . $get['invoiceid'] . "' ";
            
            if ($get['invoice_status'] != "")
                $qry .= " AND invoice_status like '%" . $get['invoice_status'] . "%' ";
            
            if ($get['invoice_date'] != "")
                $qry .= " AND invoice_date = '" . $get['invoice_date'] . "' ";
            
            if ($get['cust_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_contact_m where group_name='4' and first_name like '%" . $get['cust_name'] . "%' ");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->contact_id;
                
                $qry .= " AND vendor_id ='$sr_no'";
            }
            
            if ($get['grand_total'] != "")
                $qry .= " AND grand_total = '" . $get['grand_total'] . "'";
            
        }
        $qry .= " LIMIT $pages,$perpage ";
        $data = $this->db->query($qry)->result();
        return $data;
        
    }
    
    
    function count_invoice($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        if (sizeof($get) > 0) {
            
            if ($get['invoiceid'] != "")
                $qry .= " AND invoiceid = '" . $get['invoiceid'] . "' ";
            
            if ($get['invoice_status'] != "")
                $qry .= " AND invoice_status like '%" . $get['invoice_status'] . "%' ";
            
            if ($get['invoice_date'] != "")
                $qry .= " AND invoice_date = '" . $get['invoice_date'] . "' ";
            
            if ($get['cust_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_contact_m where group_name='4' and first_name like '%" . $get['cust_name'] . "%' ");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->contact_id;
                
                $qry .= " AND vendor_id ='$sr_no'";
            }
            
            if ($get['grand_total'] != "")
                $qry .= " AND grand_total = '" . $get['grand_total'] . "'";
            
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    
}
?>