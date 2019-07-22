<?php
class model_production extends CI_Model
{
    
    function getProduction($last, $strat)
    {
        
        $query = $this->db->query("select * from tbl_quotation_purchase_order_hdr where status='A' Order by purchaseid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterProductionList($perpage, $pages, $get)
    {
        
        
        $qry = "select * from tbl_quotation_purchase_order_hdr where status = 'A'";
        
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
    
    function count_production($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from tbl_quotation_purchase_order_hdr where status='A'";
        
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
    
    
    
    public function getInbound($last, $strat)
    {
        $query = $this->db->query("select * from tbl_production_grn_hdr where status='A' Order by inboundid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterInboundOrder($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_production_grn_hdr where status = 'A'";
        
        if (sizeof($get) > 0) {
            
            /*if($get['location'] != "")
            {
            $contactQuery = $this->db->query("select * from tbl_master_data where keyvalue like '%".$get['location']."%' ");
            $contactVal   = $contactQuery->row();
            $contactVal   = $contactVal->serial_number;
            $qry         .= " AND storage_location ='$contactVal'";
            }  */
            
            /*if($get['po_no'] != "")
            $qry .= " AND po_no LIKE '%".$get['po_no']."%'";*/
            
            if ($get['po_no'] != "") {
                $contactQuery = $this->db->query("select * from tbl_purchase_order_hdr where purchase_no like '%" . $get['po_no'] . "%' ");
                $contactVal   = $contactQuery->row();
                $contactVal   = $contactVal->purchaseid;
                $qry .= " AND po_no ='$contactVal'";
            }
            
            if ($get['date'] != "")
                $qry .= " AND grn_date = '" . $get['date'] . "' ";
            
            /*if($get['invoice_no'] != "")
            $qry .= " AND invoice_no = '".$get['invoice_no']."'";*/
            
            if ($get['grn_no'] != "")
                $qry .= " AND grn_no = '" . $get['grn_no'] . "'";
            
        }
        $qry .= " LIMIT $pages,$perpage ";
        $data = $this->db->query($qry)->result();
        return $data;
    }
    
    function count_inbound($tableName, $status = 0, $get)
    {
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        if (sizeof($get) > 0) {
            
            /* if($get['location'] != "")
            {
            $contactQuery = $this->db->query("select * from tbl_master_data where keyvalue like '%".$get['location']."%' ");
            $contactVal   = $contactQuery->row();
            $contactVal   = $contactVal->serial_number;
            $qry         .= " AND storage_location ='$contactVal'";
            }  */
            
            /*  if($get['po_no'] != "")
            $qry .= " AND po_no LIKE '%".$get['po_no']."%'";*/
            
            if ($get['po_no'] != "") {
                $contactQuery = $this->db->query("select * from tbl_purchase_order_hdr where purchase_no like '%" . $get['po_no'] . "%' ");
                $contactVal   = $contactQuery->row();
                $contactVal   = $contactVal->purchaseid;
                $qry .= " AND po_no ='$contactVal'";
            }
            
            if ($get['date'] != "")
                $qry .= " AND grn_date = '" . $get['date'] . "' ";
            
            /* if($get['invoice_no'] != "")
            $qry .= " AND invoice_no = '".$get['invoice_no']."'";*/
            
            if ($get['grn_no'] != "")
                $qry .= " AND grn_no = '" . $get['grn_no'] . "'";
            
        }
        
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }
    
    // product Stock paging and search query strats from here // 
    
    function count_product($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A' and type='13' or type='32' or type='33'";
        
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
        
        $qry = "select * from tbl_product_stock where status = 'A' and type='13' or type='32' or type='33'";
        
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
        $query = $this->db->query("select *from tbl_product_stock where status='A' and type in(13,32,33)  order by Product_id desc limit $strat,$last");
        return $result = $query->result();
    }
    
    // ends
    
    
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
                    // echo "select * from tbl_part_price_mapping M ,tbl_product_stock S,tbl_machine MM where M.part_id = S.Product_id AND MM.machine_name = '".$pid."' AND M.type = 'part' AND MM.id  = M.machine_id";
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
    
}
?>