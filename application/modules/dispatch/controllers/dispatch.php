<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class dispatch extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_finish');
    }
    
    public function manage_dispatch()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->manage_finishJoin();
            $this->load->view('manage-dispatch', $data);
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
    
    public function manage_kora_jobwork_map_details()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            
            $this->load->view('manage-kora-jobwork-map-details');
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
    
    
    public function manage_dispatch_map()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = array(
                'id' => $_POST['id']
            );
            $this->load->view('manage-dispatch-map', $data);
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
    
    public function insert_dispatch()
    {
        @extract($_POST);
        $table_name = 'tbl_production_dispatch';
        $cnt        = count($prodcId);
        for ($i = 0; $i < $cnt; $i++) {
            $data  = array(
                'vendor_id' => $vendor_id,
                'job_order_id' => $job_order_no,
                'lot_no' => $lot_number,
                'date' => $date,
                'po_no' => $po_no,
                'po_date' => $po_date,
                'productid' => $prodcId[$i],
                'qty' => $qty[$i]
                
            );
            $sesio = array(
                'comp_id' => $this->session->userdata('comp_id'),
                'zone_id' => $this->session->userdata('zone_id'),
                'maker_date' => date('y-m-d'),
                'author_date' => date('y-m-d')
            );
            
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
    public function manage_stock()
    {
        @extract($_GET);
        $data = array(
            'id' => $ID
            
        );
        $this->load->view("manage-stock", $data);
    }
    
}