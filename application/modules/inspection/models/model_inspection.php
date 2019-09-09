<?php
class model_inspection extends CI_Model
{
    

    function get_assemble($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and module_name='Assemble' group by lot_no desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterAssemble($perpage, $pages, $get)
    {
        
        
        $qry = "select * from tbl_production_order_transfer_another_module where module_name = 'Assemble'";
        
        if (sizeof($get) > 0) {
            
            if ($get['p_id'] != "")
                $qry .= " AND productionid = '" . $get['p_id'] . "'";
            
            if ($get['date'] != "")
                $qry .= " AND date LIKE '%" . $get['date'] . "%'";
            
            if ($get['goods'] != "") {
                
                $unitQuery = $this->db->query("select * from tbl_product_stock where productname LIKE '%" . $get['goods'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->Product_id;
                
                $qry .= " AND product_id ='$sr_no'";
                
            }
            
            if ($get['qty'] != "")
                $qry .= " AND qty = '" . $get['qty'] . "'";
        }
        
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_assemble($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from tbl_production_order_transfer_another_module where module_name='Assemble'";
        
        if (sizeof($get) > 0) {
            
            if ($get['p_id'] != "")
                $qry .= " AND productionid = '" . $get['p_id'] . "' ";
            
            if ($get['date'] != "")
                $qry .= " AND date LIKE '%" . $get['date'] . "%'";
            
            if ($get['goods'] != "") {
                
                $unitQuery = $this->db->query("select * from tbl_product_stock where productname LIKE '%" . $get['goods'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->Product_id;
                
                $qry .= " AND product_id ='$sr_no'";
                
            }
            
            if ($get['qty'] != "")
                $qry .= " AND qty = '" . $get['qty'] . "'";
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }  
    
    
}
?>