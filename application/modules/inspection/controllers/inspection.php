<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class inspection extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_finish');
    }
    
    public function manage_stock()
    {
        $this->load->view('manage-stock');
    }
    
    public function manage_inspection()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->manage_finishJoin();
            $this->load->view('manage-inspection', $data);
        } else {
            redirect('index');
        }
    }
    
    public function view_work_order()
    {
        $data = array(
            'id' => $_GET['ID']
        );
        
        if ($this->session->userdata('is_logged_in')) {
            
            $this->load->view('view-work-order', $data);
        } else {
            redirect('index');
        }
    }
    
    public function order_transfer()
    {
        
        @extract($_POST);
        $data = array(
            'id' => $id,
            'order_type' => $order_type,
            'lot_no' => $lot_no
        );
        $this->load->view("order-transfer", $data);
    }
    
    public function view_transfer_order()
    {
        
        @extract($_POST);
        $data = array(
            'id' => $id,
            'order_type' => $order_type,
            'lot_no' => $lot_no
        );
        $this->load->view("view-transfer-order", $data);
    }
    
    public function manage_inspection_jobwork_map_details()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            
            $this->load->view('manage-inspection-jobwork-map-details');
        } else {
            redirect('index');
        }
    }
    
    
    public function order_details()
    {
        @extract($_POST);
        $data = array(
            'id' => $id,
            'order_type' => $order_type,
            'lot_no' => $lot_no
        );
        $this->load->view("order-details", $data);
    }
    
    public function getPart()
    {
        @extract($_POST);
        $data = array(
            'id' => $shape,
            'production_id' => $production_id
        );
        $this->load->view("getpartCode", $data);
        
    }
    
    public function view_finish_order()
    {
        if ($this->session->userdata('is_logged_in')) {
            $data = array(
                'id' => $_POST['id']
            );
            $this->load->view('view-finish-order', $data);
        } else {
            redirect('index');
        }
    }
    
    public function manage_inspection_map()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = array(
                'id' => $_POST['id']
            );
            $this->load->view('manage-inspection-map', $data);
        } else {
            redirect('index');
        }
    }
    
    
    public function order_kora()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = array(
                'id' => $_POST['id']
            );
            $this->load->view('order-kora', $data);
        } else {
            redirect('index');
        }
    }
    
    
    
    function manage_finishJoin()
    {
        $data['result'] = "";
        ////Pagination start ///
        $table_name     = 'tbl_production_order_log';
        $url            = site_url('/finish/manage_finish?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_finish->count_finish($table_name, 'A', $this->input->get());
        //$showEntries= $_GET['entries']?$_GET['entries']:'12';
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/finish/manage_finish?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        //////Pagination end ///
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        //$data['result']            = $this->model_template->contact_get($pagination['per_page'],$pagination['page']);    
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_finish->filterProductionList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_finish->getfinish($pagination['per_page'], $pagination['page']);
        
        return $data;
    }
    
    public function insert_jobwork()
    {
        
        @extract($_POST);
        $table_name = 'tbl_job_work';
        $cnt        = count($productid);
        for ($i = 0; $i < $cnt; $i++) {
            
            $data = array(
                'lot_no' => $lot_number,
                'order_type' => 'Inspection',
                'job_order_no' => $job_order_no,
                'date' => $date,
                'part_id' => $productid[$i],
                'qty' => $qty[$i],
                'production_id' => $production_id,
                //'type' => $type,
                'module_name' => 'Inspection'
                
            );
            
            $sesio = array(
                'comp_id' => $this->session->userdata('comp_id'),
                'zone_id' => $this->session->userdata('zone_id'),
                
                'maker_date' => date('y-m-d'),
                'author_date' => date('y-m-d')
            );
            
            //print_r($data);die;
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            
            
        }
        echo "1";
        
        
    }
    
    
    public function order_check()
    {
        
        @extract($_POST);
        $data = array(
            'id' => $id,
            
            'order_type' => $order_type,
            'lot_no' => $lot_no
        );
        $this->load->view("order-check", $data);
    }
    
    
    public function productionOrderCheck()
    {
        
        
        extract($_POST);
        $table_name           = 'tbl_production_order_check';
        $table_name_available = 'tbl_production_available_order';
        $this->load->model('Model_admin_login');
        $rows = count($transfer_qty);
        for ($i = 0; $i < $rows; $i++) {
            if ($transfer_qty[$i] != '' or $repair_qty[$i] != '' or $scrap_qty[$i] != '') {
                
                $data_dtl = array(
                    'lot_no' => $lot_no,
                    'order_no' => $order_no,
                    'check_no' => $check_no,
                    'check_date' => $check_date,
                    'vendor_id' => $vendor_id,
                    'job_order_id' => $job_order_id,
                    'productid' => $productid[$i],
                    'fg_id' => $fg_id[$i],
                    'transfer_qty' => $transfer_qty[$i],
                    'repair_qty' => $repair_qty[$i],
                    'scrap_qty' => $scrap_qty[$i],
                    'name' => $name[$i],
                    'order_type' => $order_type,
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                );
                
                $this->Model_admin_login->insert_user($table_name, $data_dtl);
                if ($transfer_qty[$i] != '') {
                    $this->Model_admin_login->insert_user($table_name_available, $data_dtl);
                }
                //  $this->po_stock_in($qty[$i],$productid[$i]);    
                
            }
            
        }
        echo "1";
    }
    
    public function test_order()
    {
        @extract($_GET);
        $data = array(
            'p_id' => $_GET['ID'],
            'qty' => $_GET['qty'],
            'lot_no' => $_GET['lot_no']
        );
        $this->load->view('view-inspection-test', $data);
    }
    
    public function print_test_order_challan()
    {
        
        $this->load->view("print-test-order-challan");
        
    }
    
}