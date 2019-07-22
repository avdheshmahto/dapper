<?php
class model_packing extends CI_Model
{
    
    public function getQc()
    {
        
        $query = $this->db->query("select * from tbl_product_inspection where status='A'     group by lot_no Order by id desc ");
        return $result = $query->result();
    }
    
    public function stockqty($finishgood_product, $qty)
    {
        
        $qry  = $this->db->query("select S.Product_id,T.quantity from tbl_template_hdr     H,tbl_template_dtl T,tbl_product_stock S where H.templateid = T.templatehdr AND S.Product_id = T.product_id AND H.product_id =? AND S.type = ?", array(
            $finishgood_product,
            15
        ));
        $data = $qry->result_array();
        foreach ($data as $dt) {
            $Product_id = $dt['Product_id'];
            $tot_qty    = $dt['quantity'] * $qty;
            $this->db->query("update tbl_product_stock set quantity=quantity - $tot_qty where Product_id = $Product_id");
        }
    }
    
    public function update_stock_qty($Pid, $qty)
    {
        $this->db->query("update tbl_product_stock set quantity=quantity+$qty where Product_id=?", array(
            $Pid
        ));
    }
    
    //=================================Paking Pagination=====================
    
    public function getPacking($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_product_inspection where status='A' group by lot_no Order by id desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterPacking($perpage, $pages, $get)
    {
        $qry = "select * from tbl_product_inspection where status = 'A'";
        if (sizeof($get) > 0) {
            if ($get['production_id'] != "") {
                $unitQuery = $this->db->query("select * from tbl_overlock where production_id = '" . $get['production_id'] . "'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->overlock_id;
                $qry .= " AND overlock_id ='$sr_no'";
            }
            if ($get['productname'] != "") {
                $unitQuery3 = $this->db->query("select * from tbl_product_stock where productname = '" . $get['productname'] . "'");
                $getUnit3   = $unitQuery3->row();
                $sr_no1     = $getUnit3->Product_id;
                $qry .= " AND finishProductId ='$sr_no1'";
            }
            if ($get['qty'] != "")
                $qry .= " AND qty = '" . $get['qty'] . "'";
            if ($get['date'] != "")
                $qry .= " AND date = '" . $get['date'] . "'";
        }
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_packing($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from tbl_product_inspection where status='A'";
        if (sizeof($get) > 0) {
            if ($get['production_id'] != "") {
                $unitQuery = $this->db->query("select * from tbl_overlock where production_id = '" . $get['production_id'] . "'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->overlock_id;
                $qry .= " AND overlock_id ='$sr_no'";
            }
            if ($get['productname'] != "") {
                $unitQuery3 = $this->db->query("select * from tbl_product_stock where productname = '" . $get['productname'] . "'");
                $getUnit3   = $unitQuery3->row();
                $sr_no1     = $getUnit3->Product_id;
                $qry .= " AND finishProductId ='$sr_no1'";
            }
            if ($get['qty'] != "")
                $qry .= " AND qty = '" . $get['qty'] . "'";
            if ($get['date'] != "")
                $qry .= " AND date = '" . $get['date'] . "'";
        }
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
}
?>