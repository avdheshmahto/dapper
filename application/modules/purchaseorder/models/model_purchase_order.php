<?php
class model_purchase_order extends CI_Model
{
    
    function invoice_data()
    {
        $query = $this->db->query("select * from tbl_purchase_order_hdr order by purchase_no asc");
        return $result = $query->result();
    }
    
    //===================Po==============
    
    public function getPO($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_purchase_order_hdr where status='A' Order by purchaseid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterPurchaseOrder($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_purchase_order_hdr where status = 'A'";
        
        if (sizeof($get) > 0) {
            
            if ($get['purchase_no'] != "")
                $qry .= " AND purchase_no = '" . $get['purchase_no'] . "' ";
            
            if ($get['date'] != "")
                $qry .= " AND invoice_date = '" . $get['date'] . "' ";
            
            if ($get['cust_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_contact_m where first_name like '%" . $get['cust_name'] . "%' ");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->contact_id;
                $qry .= " AND vendor_id ='$sr_no'";
            }
            
            if ($get['grand_total'] != "")
                $qry .= " AND grand_total like '%" . $get['grand_total'] . "%' ";
            
        }
        
        $qry .= " LIMIT $pages,$perpage ";
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_po($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        if (sizeof($get) > 0) {
            
            if ($get['purchase_no'] != "")
                $qry .= " AND purchase_no = '" . $get['purchase_no'] . "' ";
            
            if ($get['date'] != "")
                $qry .= " AND invoice_date = '" . $get['date'] . "' ";
            
            if ($get['cust_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_contact_m where first_name like '%" . $get['cust_name'] . "%' ");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->contact_id;
                
                $qry .= " AND vendor_id ='$sr_no'";
            }
            
            if ($get['grand_total'] != "")
                $qry .= " AND grand_total like '%" . $get['grand_total'] . "%' ";
            
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    
    function count_product($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A' and type='13'";
        
        if (sizeof($get) > 0) {
            
            if ($get['sku_no'] != "")
                $qry .= " AND sku_no LIKE '%" . $get['sku_no'] . "%'";
            
            if ($get['type'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['type'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND type ='$sr_no'";
            }
            
            if ($get['category'] != "") {
                $unitQuery2 = $this->db->query("select * from tbl_category where name LIKE '%" . $get['category'] . "%'");
                $getUnit2   = $unitQuery2->row();
                $sr_no2     = $getUnit2->id;
                $qry .= " AND category ='$sr_no2'";
            }
            
            if ($get['productname'] != "")
                $qry .= " AND productname LIKE '%" . $get['productname'] . "%'";
            
            
            if ($get['usages_unit'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['usages_unit'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND usageunit ='$sr_no'";
            }
            
            if ($get['size'] != "")
                $qry .= " AND pro_size LIKE '%" . $get['size'] . "%'";
            
            if ($get['thickness'] != "")
                $qry .= " AND thickness LIKE '%" . $get['thickness'] . "%'";
            
            if ($get['gradecode'] != "")
                $qry .= " AND grade_code LIKE '%" . $get['gradecode'] . "%'";
            
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        
        return $query[0]['countval'];
        
    }
    
    function filterProductList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_product_stock where status = 'A' and type='13'";
        
        if (sizeof($get) > 0) {
            
            if ($get['sku_no'] != "")
                $qry .= " AND sku_no LIKE '%" . $get['sku_no'] . "%'";
            
            if ($get['type'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['type'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND type ='$sr_no'";
            }
            
            if ($get['category'] != "") {
                $unitQuery2 = $this->db->query("select * from tbl_category where name LIKE '%" . $get['category'] . "%'");
                $getUnit2   = $unitQuery2->row();
                $sr_no2     = $getUnit2->id;
                $qry .= " AND category ='$sr_no2'";
            }
            
            if ($get['productname'] != "")
                $qry .= " AND productname LIKE '%" . $get['productname'] . "%'";
            
            if ($get['usages_unit'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['usages_unit'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND usageunit ='$sr_no'";
            }
            
            if ($get['size'] != "")
                $qry .= " AND pro_size LIKE '%" . $get['size'] . "%'";
            
            if ($get['thickness'] != "")
                $qry .= " AND thickness LIKE '%" . $get['thickness'] . "%'";
            
            if ($get['gradecode'] != "")
                $qry .= " AND grade_code LIKE '%" . $get['gradecode'] . "%'";
            
        }
        
        $qry .= " LIMIT $pages,$perpage";
        $data = $this->db->query($qry)->result();
        return $data;
        
    }
    
    function product_get($last, $strat)
    {
        $query = $this->db->query("select *from tbl_product_stock where status='A' and type='13'  order by Product_id desc limit $strat,$last");
        return $result = $query->result();
    }
    
    
}
?>