<?php
class model_inbound_order extends CI_Model
{
    
    //===================inbound==============
    
    public function getInbound($last, $strat)
    {
        $query = $this->db->query("select * from tbl_inbound_hdr where status='A' Order by inboundid desc limit $strat,$last ");
        return $result = $query->result();
    }
    
    function filterInboundOrder($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_inbound_hdr where status = 'A'";
        
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
    
    function get_tblHdrData($id)
    {
        $query     = $this->db->query("select * from tbl_purchase_order_hdr where purchaseid = $id ");
        $resultHdr = $query->row_array();
        $arr       = "";
        if (sizeof($resultHdr) > 0) {
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
            $arr['purchase_no']      = $resultHdr['purchase_no'];
            $arr['ship_method']      = $resultHdr['ship_method'];
            $arr['ship_vip']         = $resultHdr['ship_vip'];
            $arr['supplier']         = $resultHdr['supplier'];
            $arr['freight']          = $resultHdr['freight'];
            $arr['company']          = $resultHdr['company'];
            $arr['po_status']        = $resultHdr['po_status'];
            $arr['dtlData']          = array();
            
            $queryDtl  = $this->db->query("select D.*,S.productname,S.usageunit from tbl_purchase_order_dtl D,tbl_product_stock S where D.productid = S.Product_id AND D.purchaseorderhdr = $id ");
            $resultDtl = $queryDtl->result_array();
            $i         = 0;
            foreach ($resultDtl as $k => $dt) {
                $contQuery = $this->db->query("select keyvalue from tbl_master_data where serial_number='" . $dt['usageunit'] . "'");
                $cont_val  = $contQuery->row();
                
                $arr['dtlData'][$i]['productid']   = $dt['productid'];
                $arr['dtlData'][$i]['productname'] = $dt['productname'];
                $arr['dtlData'][$i]['umo']         = $cont_val->keyvalue;
                $arr['dtlData'][$i]['qty']         = $dt['qty'];
                $i++;
            }
            
        }
        
        //    echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        
        return $arr;
    }
    
    function getmatrials($id)
    {
        $query     = $this->db->query("select * from tbl_quotation_purchase_order_dtl where purchaseid = $id ");
        $resultDtl = $query->result_array();
        $arr       = array();
        if (sizeof($resultDtl) > 0) {
            $i = 0;
            foreach ($resultDtl as $dt) {
                /// Shape  Name ////
                $pid                    = $dt['productid'];
                $querypro               = $this->db->query("select * from tbl_product_stock where Product_id = $pid ");
                $resultpro              = $querypro->row();
                $arr[$i]['productname'] = $resultpro->productname;
                $arr[$i]['dtlqty']      = $dt['qty'];
                
                //$arr[$i]['productname'] = $resultpro->productname;
                //echo "select M.*,S.Product_id,S.productname,S.Product_id from tbl_part_price_mapping M,tbl_product_stock S,tbl_machine MM where M.part_id = S.Product_id AND MM.id = M.machine_id AND MM.machine_name = $pid AND M.type ='part' group by M.part_id";
                
                $querypro1        = $this->db->query("select M.*,S.Product_id,S.productname,S.Product_id from tbl_part_price_mapping M,tbl_product_stock S,tbl_machine MM where M.part_id = S.Product_id AND MM.id = M.machine_id AND MM.machine_name = $pid AND M.type ='part' group by M.part_id");
                $resultpro1       = $querypro1->result_array();
                $j                = 0;
                $arr[$i]['empty'] = "";
                
                if (sizeof($resultpro1) != "") {
                    foreach ($resultpro1 as $rdt1) {
                        $arr[$i]['rowmatrial'][$j]['partname'] = $rdt1['productname'];
                        $arr[$i]['rowmatrial'][$j]['partid']   = $rdt1['Product_id'];
                        
                        $querymaterial  = $this->db->query("select M.*,S.Product_id,S.productname,S.quantity,S.usageunit from tbl_part_price_mapping M,tbl_product_stock S where M.rowmatial = S.Product_id AND M.machine_id ='" . $rdt1['machine_id'] . "'  AND M.part_id = '" . $rdt1['part_id'] . "'");
                        $resultmaterial = $querymaterial->result_array();
                        $k              = 0;
                        
                        if (sizeof($resultmaterial) != "") {
                            foreach ($resultmaterial as $rdt) {
                                //// Rowmaterial Name ////
                                $queryunit  = $this->db->query("select keyvalue from tbl_master_data where serial_number = '" . $rdt['usageunit'] . "'");
                                $resultunit = $queryunit->row();
                                
                                $inbountLogQuery = $this->db->query("select SUM(D.receive_qty) as rec_qty from tbl_issuematrial_dtl D,tbl_issuematrial_hdr H where D.inboundrhdr = H.inboundid AND D.productid='" . $rdt['Product_id'] . "' AND H.po_no='$id'");
                                $getInbound      = $inbountLogQuery->row();
                                
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['name']     = $rdt['productname'];
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['unit']     = $resultunit->keyvalue;
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['mqty']     = $rdt['qty'];
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['rec_qty']  = $getInbound->rec_qty;
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['dtlqty']   = $dt['qty'];
                                $arr[$i]['rowmatrial'][$j]['partdetails'][$k]['stockqty'] = $rdt['quantity'];
                                //$arr[$i]['rowmatrial'][$j]['name']      = $rdt['productname'];
                                $k++;
                            }
                        }
                        $j++;
                    }
                } else
                    $arr[$i]['empty'] = "Data Not Found!";
                
                $i++;
            }
        }
        
        // echo "<pre>";
        //  print_r($arr);
        // echo "<pre>";
        return $arr;
    }
    
    function getcontact()
    {
        $qry = "select * from tbl_quotation_purchase_order_dtl where status='A'";
        
        
    }
    
}
?>