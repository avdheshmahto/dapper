<?php
class model_master extends CI_Model
{
    
    function getMachineData()
    {
        $this->db->select("*")->from("tbl_machine")->where("status", 'A');
        $this->db->order_by("id", "desc");
        
        $query = $this->db->get();
        
        return $result = $query->result();
    }
    
    //=======================Shape Mapping=============
    
    function getShapeMapping($last, $strat)
    {
        $qry = $this->db->query("select * from tbl_machine where status = 'A' Order by id desc limit $strat,$last ");
        return $result = $qry->result();
    }
    
    function filterShapeMapping($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_machine where status = 'A' ";
        
        if (sizeof($get) > 0) {
            
            if ($get['item_name'] != "") {
                $machinQuery2 = $this->db->query("select * from tbl_product_stock where productname like '%" . $get['item_name'] . "%' ");
                $getMachine2  = $machinQuery2->row();
                $qry .= " AND machine_name ='$getMachine2->Product_id'";
            }
            
            if ($get['shape_name'] != "") {
                $machinQuery1 = $this->db->query("select * from tbl_product_stock where productname like '%" . $get['shape_name'] . "%' ");
                $getMachine1  = $machinQuery1->row();
                $qry .= " AND code ='$getMachine1->Product_id'";
            }
            
            if ($get['shape_desc'] != "")
                $qry .= " AND machine_des like '%" . $get['shape_desc'] . "%' ";
            
        }
        
        $qry .= " LIMIT $pages,$perpage ";
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_shape_mapping($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from $tableName where status='A' ";
        
        if (sizeof($get) > 0) {
            
            if ($get['item_name'] != "") {
                $machinQuery2 = $this->db->query("select * from tbl_product_stock where productname like '%" . $get['item_name'] . "%' ");
                $getMachine2  = $machinQuery2->row();
                $qry .= " AND machine_name ='$getMachine2->Product_id'";
            }
            
            if ($get['shape_name'] != "") {
                $machinQuery1 = $this->db->query("select * from tbl_product_stock where productname like '%" . $get['shape_name'] . "%' ");
                $getMachine1  = $machinQuery1->row();
                $qry .= " AND code ='$getMachine1->Product_id'";
            }
            
            if ($get['shape_desc'] != "")
                $qry .= " AND machine_des like '%" . $get['shape_desc'] . "%' ";
            
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    
    
    //=================End=========================
    
    function getSpareData($id)
    {
        $query = $this->db->query("select * from tbl_shape_part_mapping where product_id = '$id'");
        return $result = $query->result();
    }
    
    
    
    function mod_productList($val)
    {
        //echo "select * from tbl_product_stock where productname like '%$val%'";
        $qry = $this->db->query("select productname,Product_id from tbl_product_stock where type = '32' AND productname like '%$val%'")->result_array();
        // print_r($qry);
        return $qry;
    }
    
    function getsparemapedQty($partid, $machineid)
    {
        // echo "select * from tbl_part_price_mapping where part_id= $partid AND machine_id= $machineid";
        $qry = $this->db->query("select * from tbl_part_price_mapping where part_id= $partid AND machine_id= $machineid")->result_array();
        return $qry;
        // return "";
    }
    
    function mod_spareproductList($val)
    {
        //echo "select * from tbl_product_stock where productname like '%$val%'";
        $qry = $this->db->query("select productname,Product_id,usageunit from tbl_product_stock where type = '13' AND productname like '%$val%'")->result_array();
        // print_r($qry);
        return $qry;
    }
    
    function viewgetsparemapedQty($partid, $machineid, $type)
    {
        $qry = "";
        if ($type == 'shapeview') {
            $qry = $this->db->query("select SUM(qty) as mqty,rowmatial,unit from tbl_part_price_mapping where machine_id= $machineid group by rowmatial")->result_array();
        } elseif ($type == 'partview') {
            $qry = $this->db->query("select qty as mqty,rowmatial,unit from tbl_part_price_mapping where part_id = $partid AND machine_id= $machineid")->result_array();
        }
        return $qry;
        
    }
    
    
}
?>