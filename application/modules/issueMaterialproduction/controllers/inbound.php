<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class inbound extends my_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_inbound_order');
    }
    
    public function add_inbound()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('add-inbound');
        } else {
            redirect('index');
        }
    }
    
    public function edit_purchase_order()
    {
        if ($this->session->userdata('is_logged_in')) {
            $data['result'] = $this->model_purchase_order->get_tblHdrData($this->input->post('id'));
            $this->load->view('edit-purchase-order', $data);
        } else {
            redirect('index');
        }
    }
    
    public function manage_inbound()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            
            $data = $this->Manage_Inbound_Data();
            $this->load->view('manage-inbound', $data);
        } else {
            redirect('index');
        }
    }
    
    public function Manage_Inbound_Data()
    {
        
        $data['result'] = "";
        $table_name     = 'tbl_issuematrial_hdr';
        //$url        = site_url('/inbound/manage_inbound?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_inbound_order->count_inbound($table_name, 'A', $this->input->get());
        
        
        if ($_GET['entries'] != '' && $_GET['filter'] != 'filter') {
            $url = site_url('/issueMaterialproduction/inbound/manage_inbound?entries=' . $_GET['entries']);
            
        } elseif ($_GET['filter'] == 'filter' || $_GET['entries'] != '') {
            
            $url = site_url('/issueMaterialproduction/inbound/manage_inbound?po_no=' . $_GET['po_no'] . '&date=' . $_GET['date'] . '&grn_no=' . $_GET['grn_no'] . '&filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
            
        } else {
            $url = site_url('/issueMaterialproduction/inbound/manage_inbound?');
            
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        $data               = $this->user_function();
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter')
            $data['result'] = $this->model_inbound_order->filterInboundOrder($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_inbound_order->getInbound($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    
    
    public function insertInboundOrder()
    {
        extract($_POST);
        // echo "<pre>";
        //  print_r($_POST);
        // echo "</pre>";die;
        
        $table_name      = 'tbl_issuematrial_hdr';
        $table_name_dtl  = 'tbl_issuematrial_dtl';
        $pri_col         = 'inboundid';
        $pri_col_dtl     = 'inbound_dtl_id';
        $pri_col_hdr_log = 'tbl_inbound_log';
        $sess            = array(
            'maker_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'status' => 'A',
            'comp_id' => $this->session->userdata('comp_id'),
            'zone_id' => $this->session->userdata('zone_id'),
            'brnh_id' => $this->session->userdata('brnh_id'),
            'divn_id' => $this->session->userdata('divn_id')
        );
        
        
        
        $data = array(
            // 'storage_location'=> $this->input->post('storage_location'),  
            'po_no' => $this->input->post('po_order'),
            // 'grn_no'          => $this->input->post('grn_no'),
            'grn_date' => $grn_date
        );
        
        $data_merge = array_merge($data, $sess);
        $this->load->model('Model_admin_login');
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        $lastHdrId = $this->db->insert_id();
        $this->load->model('Model_admin_login');
        
        $rows = count($productid);
        for ($i = 0; $i < $rows; $i++) {
            if ($receive_qty[$i] != '') {
                $data_dtl = array(
                    'inboundrhdr' => $lastHdrId,
                    'productid' => $productid[$i],
                    'receive_qty' => $receive_qty[$i],
                    'remaining_qty' => $remaining_qty[$i],
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                );
                
                
                $data_dtl_log = array(
                    'inboundrhdr' => $lastHdrId,
                    'po_no' => $po_no,
                    'productid' => $productid[$i],
                    'receive_qty' => $receive_qty[$i],
                    'remaining_qty' => $remaining_qty[$i],
                    'grn_no' => $this->input->post('grn_no'),
                    'grn_date' => $this->input->post('grn_date'),
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                );
                
                
                $this->Model_admin_login->insert_user($table_name_dtl, $data_dtl);
                $this->Model_admin_login->insert_user($pri_col_hdr_log, $data_dtl_log);
                $this->po_stock_in_rem($receive_qty[$i], $productid[$i], $storage_location);
            }
        }
        $rediectInvoice = "issueMaterialproduction/inbound/manage_inbound";
        redirect($rediectInvoice);
        
    }
    
    public function getproduct()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('getproduct');
        } else {
            redirect('index');
        }
    }
    
    
    
    function deleteSalesOrder()
    {
        $table_name     = 'tbl_purchase_order_hdr';
        $table_name_dtl = 'tbl_purchase_order_dtl';
        $pri_col        = 'purchase_order_id';
        $pri_col_dtl    = 'purchase_order_hdr_id';
        $this->load->model('Model_admin_login');
        $id     = $_GET['id'];
        $id_dtl = $_GET['id'];
        $this->Model_admin_login->delete_user($pri_col, $table_name, $id);
        $this->Model_admin_login->delete_user($pri_col_dtl, $table_name_dtl, $id_dtl);
        redirect('SalesOrder/managePurchaseOrder');
    }
    
    
    
    public function getPo()
    {
        
        $data['result'] = $this->model_inbound_order->getmatrials($this->input->get('po_order'));
        $this->load->view("getpoitem", $data);
        
    }
    
    public function getPoItem()
    {
        $data = array(
            'id' => $_GET['poId']
        );
        $this->load->view("getpoitem", $data);
    }
    
    
    function delete_updata_stock($qty1, $main_id)
    {
        
        $this->db->query("update tbl_product_stock set quantity=quantity-'$qty1' where Product_id='$main_id'");
        $this->db->query("update tbl_product_serial set quantity=quantity-'$qty1' where product_id='$main_id'");
        
        return;
    }
    
    
    
    public function view_inbound()
    {
        
        $data = array(
            'id' => $_POST['id'],
            'po_id' => $_POST['po_id']
        );
        $this->load->view("view-inbound", $data);
        
    }
    
    public function view_challan_log()
    {
        
        $data = array(
            'id' => $_POST['id'],
            'po_id' => $_POST['po_id']
        );
        $this->load->view("view-challan-log", $data);
        
    }
    
    
    public function po_stock_in($receive_qty, $productid)
    {
        
        
        $selectQuery  = "select * from tbl_product_serial where product_id='$productid' and location_id='1'";
        $selectQuery1 = $this->db->query($selectQuery);
        $num          = $selectQuery1->num_rows();
        if ($num > 0) {
            $this->db->query("update tbl_product_serial set quantity=quantity+'$receive_qty',location_id='1' where product_id='$productid' and location_id='1' ");
        } else {
            $comp_id     = $this->session->userdata('comp_id');
            $divn_id     = $this->session->userdata('divn_id');
            $zone_id     = $this->session->userdata('zone_id');
            $brnh_id     = $this->session->userdata('brnh_id');
            $maker_date  = date('y-m-d');
            $author_date = date('y-m-d');
            
            $this->db->query("insert into tbl_product_serial set quantity='$receive_qty',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
            
            $this->db->query("insert into tbl_product_serial_log set quantity='$receive_qty',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
        }
        
        $this->db->query("update tbl_product_stock set quantity=quantity+'$receive_qty' where Product_id='$productid'");
        
    }
    
    
    
    public function mrn_print()
    {
        $this->load->view("mrn-print");
    }
    
    function insert_issue_row_material()
    {
        
        @extract($_POST);
        $table_name     = 'tbl_receive_matrial_hdr';
        $table_name_dtl = 'tbl_receivematrial_dtl';
        
        $sess = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'status' => 'A',
            'comp_id' => $this->session->userdata('comp_id'),
            'zone_id' => $this->session->userdata('zone_id'),
            'brnh_id' => $this->session->userdata('brnh_id'),
            'divn_id' => $this->session->userdata('divn_id')
        );
        
        $data = array(
            'date' => date('y-m-d'),
            'request_no' => $request_no,
            'po_no' => $req_production_id,
            'challan_no' => $challan_no,
            'challan_date' => $challan_date
            
        );
        $this->load->model('Model_admin_login');
        $data_merge = array_merge($data, $sess);
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        
        $lastId = $this->db->insert_id();
        
        for ($i = 0; $i < count($qty); $i++) {
            
            if ($qty[$i] != '') {
                
                $data_dtl = array(
                    'inboundrhdr' => $lastId,
                    'productid' => $productid[$i],
                    'receive_qty' => $qty[$i],
                    'order_qty' => $order_qty[$i],
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                );
                
                //$this->stock_refill_qty($qty[$i],$main_id[$i]);
                $this->Model_admin_login->insert_user($table_name_dtl, $data_dtl);
            }
            
            
        }
        
        
        
        for ($i = 0; $i < count($qty); $i++) {
            
            if ($qty[$i] != '') {
                
                
                $this->db->query("update tbl_issuematrial_dtl set remaining_qty=remaining_qty+'$qty[$i]',rem_order_qty=rem_order_qty+'$order_qty[$i]' where inboundrhdr='$req_production_id'");
                $this->po_stock_in_rem($qty[$i], $productid[$i], $order_qty[$i]);
                //$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);        
            }
            
            
        }
        
        
        if ($qrd_qtyT == $totToCom) {
            
            $this->db->query("update tbl_issuematrial_hdr set status='2' where po_no='$req_production_id'");
        } else {
            $this->db->query("update tbl_issuematrial_hdr set status='3' where po_no='$req_production_id'");
            
        }
        
        redirect("issueMaterialproduction/inbound/manage_inbound");
        
    }
    
    
    public function po_stock_in_rem($receive_qty, $productid, $order_qty)
    {
        
        $selectQuery  = "select * from tbl_product_serial where product_id='$productid' and location_id='1'";
        $selectQuery1 = $this->db->query($selectQuery);
        $num          = $selectQuery1->num_rows();
        if ($num > 0) {
            $this->db->query("update tbl_product_serial set quantity=quantity-'$receive_qty',qn_pc=qn_pc-'$order_qty',location_id='1' where product_id='$productid' and location_id='1' ");
        } else {
            $comp_id     = $this->session->userdata('comp_id');
            $divn_id     = $this->session->userdata('divn_id');
            $zone_id     = $this->session->userdata('zone_id');
            $brnh_id     = $this->session->userdata('brnh_id');
            $maker_date  = date('y-m-d');
            $author_date = date('y-m-d');
            
            $this->db->query("insert into tbl_product_serial set quantity='$receive_qty',qn_pc='$order_qty',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
            
            $this->db->query("insert into tbl_product_serial_log set quantity='$receive_qty',qn_pc='$order_qty',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
        }
        
        $this->db->query("update tbl_product_stock set quantity=quantity-'$receive_qty' where Product_id='$productid'");
        
    }
    
}