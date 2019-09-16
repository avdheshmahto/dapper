<?php
class model_finish extends CI_Model
{
    
    function getfinish($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and module_name='Finish'    group by lot_no  limit $strat,$last ");
        return $result = $query->result();

    }
    
    function filterfinishList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_production_order_transfer_another_module where module_name = 'Finish' ";
        
        /*if (sizeof($get) > 0) {
            if ($get['p_id'] != "")
                $qry .= " AND lot_no = '" . $get['p_id'] . "'";
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
        }*/

        $qry .= "group by lot_no";
        $data = $this->db->query($qry)->result();
        return $data;

    }
    
    function count_finish($tableName, $status = 0, $get)
    {

        $qry = "select count(*) as countval from tbl_production_order_transfer_another_module where status='A' and module_name='Finish'";

        /*if (sizeof($get) > 0) {
            if ($get['p_id'] != "")
                $qry .= " AND lot_no = '" . $get['p_id'] . "' ";
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
        }*/

        $qry .= " group by lot_no ";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    
    // starts here //
    
    function gettest($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_production_order_check where status='A' and test_qty!='' group by lot_no desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterTest($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_production_order_check where status = 'A' and test_qty!=''";
        if (sizeof($_GET) > 0) {
            if ($get['p_id'] != "")
                $qry .= " AND lot_no = '" . $get['p_id'] . "' ";
            
            $qry .= "group by lot_no order by lot_no desc ";
        }
        
        
        
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_test($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from tbl_production_order_check where status='A' and test_qty!='' ";
        if (sizeof($_GET) > 0) {
            if ($get['p_id'] != "")
                $qry .= " AND lot_no = '" . $get['p_id'] . "' ";
            $qry .= "group by lot_no order by lot_no desc ";
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    //Ends
    
    //starts here
    
    function getassemble($last, $strat)
    {
        $query = $this->db->query("select * from tbl_production_order_transfer_another_module where status='A' and module_name='Assemble' group by lot_no  limit $strat,$last  ");
        return $result = $query->result();
    }
    
    function filterassembleList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_production_order_transfer_another_module where status='A' and module_name='Assemble' group by lot_no  limit $strat,$last ";

        /*if (sizeof($get) > 0) {
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
        }*/

        $data = $this->db->query($qry)->result();
        return $data;

    }
    
    function count_assemble($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from tbl_production_order_transfer_another_module where module_name='Assemble'";

        /*if (sizeof($get) > 0) {
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
        }*/
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];

    }
    
    //ends
    
    
    function modgetitemspharemap($id)
    {

        $qry   = "select * from tbl_quotation_purchase_order_dtl where purchaseid = $id AND status='A'";
        $query = $this->db->query($qry)->result();
        $arr   = "";
        if (sizeof($query) > 0) {
            $i = 0;
            foreach ($query as $pd) {
                $qryp                     = "select * from tbl_product_stock where Product_id = '" . $pd->productid . "'";
                $queryp                   = $this->db->query($qryp)->row();
                $pid                      = $queryp->Product_id;
                $arr[$i]['item']          = $queryp->productname;
                $arr[$i]['sku_no']        = $queryp->sku_no;
                $arr[$i]['itemid']        = $queryp->Product_id;
                $arr[$i]['productionQty'] = $pd->total_price;
                //$arr[$i]['qty']       = $pd->qty;
                if ($pid != "") {
                    $qrym = "select *,sum(M.qty) as qty from tbl_part_price_mapping M ,tbl_product_stock S,tbl_machine MM ,tbl_machine_spare_map SM where MM.machine_name = S.Product_id AND MM.id = M.machine_id AND M.machine_id = SM.machine_id AND SM.spare_id = M.part_id AND MM.machine_name = '" . $pid . "' AND M.type = 'part' group by M.rowmatial";
                    
                    $querym              = $this->db->query($qrym)->result_array();
                    $arr[$i]['part']     = "";
                    $arr[$i]['partname'] = "";
                    
                    if (sizeof($querym) > 0) {
                        $j = 0;
                        foreach ($querym as $mapdata) {
                            $qryu                               = "select * from tbl_master_data where serial_number = '" . $mapdata['usageunit'] . "'";
                            $queryu                             = $this->db->query($qryu)->row();
                            $arr[$i]['partname']                = $mapdata['productname'];
                            $arr[$i]['part'][$j]['pname']       = $mapdata['productname'];
                            $arr[$i]['part'][$j]['unit']        = $queryu->keyvalue;
                            $arr[$i]['part'][$j]['qty']         = $mapdata['qty'];
                            $arr[$i]['part'][$j]['itemqty']     = $pd->qty;
                            $arr[$i]['part'][$j]['rowmatialid'] = $mapdata['rowmatial'];
                            $qryp1                              = "select * from tbl_product_stock S where  Product_id = '" . $mapdata['rowmatial'] . "'";
                            $queryp1                            = $this->db->query($qryp1)->row();
                            $arr[$i]['part'][$j]['rowmatial']   = $queryp1->productname;
                            $arr[$i]['part'][$j]['quantity']    = $queryp1->quantity;
                            $j++;
                        }
                    }
                }
                $i++;
            }
        }
        return $arr;
    }

    
    
}
?>