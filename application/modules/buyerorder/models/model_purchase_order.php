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
        
        $query = $this->db->query("select * from tbl_quotation_purchase_order_hdr where status='A' Order by purchaseid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterPurchaseOrder($perpage, $pages, $get)
    {
        $qry = "select * from tbl_quotation_purchase_order_hdr where status = 'A'";
        
        if (sizeof($_GET) > 0) {
            
            
            
            if ($get['lot_no'] != "")
                echo $qry .= " AND lot_no = '" . $get['lot_no'] . "' ";
            
            
            if ($get['purchaseid'] != "")
                $qry .= " AND purchaseid = '" . $get['purchaseid'] . "' ";
            
            
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
        
        
        if (sizeof($_GET) > 0) {
            
            if ($get['purchaseid'] != "")
                $qry .= " AND purchaseid = '" . $get['purchaseid'] . "' ";
            
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
                $arr[$i]['itemid']        = $queryp->Product_id;
                $arr[$i]['productionQty'] = $pd->qty;
                //$arr[$i]['qty']       = $pd->qty;
                if ($pid != "") {

                    $qrym = "select *,sum(M.qty) as qty from tbl_part_price_mapping M ,tbl_product_stock S,tbl_machine MM ,tbl_machine_spare_map SM where MM.machine_name = S.Product_id AND MM.id = M.machine_id AND M.machine_id = SM.machine_id AND SM.spare_id = M.part_id AND MM.machine_name = '" . $pid . "' AND M.type = 'part' group by M.rowmatial";
                                                            
                    
                    $querym = $this->db->query($qrym)->result_array();
                    
                    $arr[$i]['part']     = "";
                    $arr[$i]['partname'] = "";
                    
                    if (sizeof($querym) > 0) {
                        $j = 0;
                        foreach ($querym as $mapdata) {
                            $qryu   = "select * from tbl_master_data where serial_number = '" . $mapdata['usageunit'] . "'";
                            $queryu = $this->db->query($qryu)->row();
                            
                            
                            $arr[$i]['partname']                = $mapdata['productname'];
                            $arr[$i]['part'][$j]['pname']       = $mapdata['productname'];
                            $arr[$i]['part'][$j]['unit']        = $queryu->keyvalue;
                            $arr[$i]['part'][$j]['qty']         = $mapdata['qty'];
                            $arr[$i]['part'][$j]['itemqty']     = $pd->qty;
                            $arr[$i]['part'][$j]['rowmatialid'] = $mapdata['rowmatial'];
                            
                            $qryp1   = "select * from tbl_product_stock S where  Product_id = '" . $mapdata['rowmatial'] . "'";
                            $queryp1 = $this->db->query($qryp1)->row();
                            
                            $arr[$i]['part'][$j]['rowmatial'] = $queryp1->productname;
                            $arr[$i]['part'][$j]['quantity']  = $queryp1->quantity;
                            
                            $j++;
                        }
                    }
                }
                // productid
                // qty
                $i++;
            }
        }
        // echo "<pre>";
        //  print_r($arr);
        // echo "</pre>";
        return $arr;
    }
    
    function filterProductList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_product_stock where status = 'A' AND type = 13";
        
        if (sizeof($_GET) > 0) {
            
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
    
    function count_product($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A' AND type = 13";
        
        if (sizeof($_GET) > 0) {
            
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
    
    function product_get($last, $strat)
    {
        $query = $this->db->query("select *from tbl_product_stock where status='A' AND type = 13  order by Product_id desc limit $strat,$last");
        return $result = $query->result();
    }
    
}
?>