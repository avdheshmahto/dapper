<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Report extends my_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_report');
        $this->load->library('pagination');
    }
    
    function report_function()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('open-page-report');
        } else {
            redirect('index');
        }
    }
    //=========================Payment===================
    function searchPaymentReport()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['SearchPayment'] = $this->model_report->getSearchPayment($contactid);
            $data = $this->Manage_Payment();
            $this->load->view('payment-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_Payment()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_contact_m';
        $url            = site_url('/report/Report/searchPaymentReport?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_payment($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchPaymentReport?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterPayment($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getPayment($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    function searchPaymentLogReport()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['totalSearchPayment'] = $this->model_report->getSearchPaymentLog($contactid,$payment_mode,$f_date,$t_date);
            $data = $this->Manage_PaymentLog();
            $this->load->view('payment-log-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_PaymentLog()
    {
        
        $data['result'] = "";
        $table_name     = 'tbl_invoice_payment';
        $url            = site_url('/report/Report/searchPaymentLogReport?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_payment_log($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchPaymentLogReport?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterPaymentLog($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getPaymentLog($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
        
    }
    
    
    
    function searchPaymentReceivedReport()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['SearchPaymentReceived'] = $this->model_report->getSearchPaymentReceived($contactid);
            $data = $this->Manage_PaymentReceived();
            $this->load->view('payment-received-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_PaymentReceived()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_contact_m';
        $url            = site_url('/report/Report/searchPaymentReceivedReport?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_payment_received($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchPaymentReceivedReport?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterPaymentReceived($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getPaymentReceived($pagination['per_page'], $pagination['page']);
        
        return $data;
        
    }
    
    function searchPaymentReceivedLogReport()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['SearchPaymentReceivedLog'] = $this->model_report->getSearchPaymentReceivedLog($contactid,$payment_mode,$f_date,$t_date);
            $data = $this->Manage_PaymentReceivedLog();
            $this->load->view('payment-received-log-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_PaymentReceivedLog()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_invoice_payment';
        $url            = site_url('/report/Report/searchPaymentReceivedLogReport?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_payment_received_log($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchPaymentReceivedLogReport?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterPaymentReceivedLog($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getPaymentReceivedLog($pagination['per_page'], $pagination['page']);
        
        return $data;
        
    }
    
    
    //============================Product Stock====================
    
    function searchStock()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['stockSearch'] = $this->model_report->getSearchStock($p_id,$p_name);
            $data = $this->Manage_Product_Stock();
            $this->load->view('add-product-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_Product_Stock()
    {
        
        $data['result'] = "";
        $table_name     = 'tbl_product_stock';
        $url            = site_url('/report/Report/searchStock?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_product($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchStock?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterProductList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getProduct($pagination['per_page'], $pagination['page']);
        
        return $data;
        
    }
    
    //============Template========================
    
    function searchLot()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['searchTemplate'] = $this->model_report->getTemplateSearch($temp_id,$p_name,$f_date,$t_date);
            $data = $this->Manage_Template_Report();
            $this->load->view('lot-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_Template_Report()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_template_hdr';
        $url            = site_url('/report/Report/searchTemplate?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_template($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchTemplate?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterTemplate($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getTemplate($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    function view_template()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-template');
        } else {
            redirect('index');
        }
    }
    
    
    /*function searchProduction() {
    extract($_POST);
    if($this->session->userdata('is_logged_in')){
    //$postlist['masterCuttingSearch'] = $this->model_report->getSearchMasterCutting($p_id,$p_name,$f_date,$t_date);
    $data = $this->Manage_Production_Data();
    $this->load->view('production-report', $postlist);
    }
    else
    {
    redirect('index');
    }
    }
    
    function Manage_Production_Data()
    {
    
    $data['result'] = "";
    $table_name  = 'tbl_template_hdr';
    $url        = site_url('/report/Report/searchTemplate?');
    $sgmnt      = "4";
    $showEntries= 10;
    $totalData  = $this->model_report->count_template($pagination['per_page'],$pagination['page'],$this->input->get());
    if($_GET['entries']!=""){
    $showEntries = $_GET['entries'];
    $url     = site_url('/report/Report/searchTemplate?entries='.$_GET['entries']);
    }
    $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
    
    
    $data=$this->user_function();      // call permission fnctn
    $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
    $data['pagination']        = $this->pagination->create_links();
    
    if($this->input->get('filter') == 'filter')   ////filter start ////
    $data['result'] = $this->model_report->filterTemplate($pagination['per_page'],$pagination['page'],$this->input->get());
    else    
    $data['result'] = $this->model_report->getTemplate($pagination['per_page'],$pagination['page']);
    
    return $data;
    
    }*/
    
    function searchProduction()
    {
        $_SERVER['REQUEST_URI'];
        extract($_GET);
        
        if ($this->session->userdata('is_logged_in')) {
            //pagination settings
            $config['use_page_numbers']     = FAlSE;
            $config['page_query_string']    = TRUE;
            $config['query_string_segment'] = 'offset';
            //$config['get']=(isset($_GET['search']))?'?search='.$_GET['search']:'';
            if ($_GET['p_name'] != "" || $_GET['p_id'] != "" || $_GET['f_date'] != "" || $_GET['t_date'] != "" || $_GET['type'] != "")
                $getval = "?p_name=" . $_GET['p_name'] . "&p_id=" . $_GET['p_id'] . "&f_date=" . $_GET['f_date'] . "&t_date=" . $_GET['t_date'] . "&type=" . $_GET['type'] . "&Show=Show";
            else {
                $getval = "?";
            }
            
            $config['base_url']    = site_url('/report/Report/searchProduction' . $getval);
            $config['total_rows']  = count($this->model_report->getSearchMasterCutting($_GET, '', 0));
            $config['per_page']    = "6";
            $config["uri_segment"] = 4;
            $choice                = $config["total_rows"] / $config["per_page"];
            $config["num_links"]   = floor($choice);
            
            //config for bootstrap pagination class integration
            $config['full_tag_open']   = '<ul class="pagination">';
            $config['full_tag_close']  = '</ul>';
            $config['first_link']      = 'First';
            $config['last_link']       = 'Last';
            $config['first_tag_open']  = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link']       = '&laquo';
            $config['prev_tag_open']   = '<li class="prev">';
            $config['prev_tag_close']  = '</li>';
            $config['next_link']       = '&raquo';
            $config['next_tag_open']   = '<li>';
            $config['next_tag_close']  = '</li>';
            $config['last_tag_open']   = '<li>';
            $config['last_tag_close']  = '</li>';
            $config['cur_tag_open']    = '<li class="active"><a href="#">';
            $config['cur_tag_close']   = '</a></li>';
            $config['num_tag_open']    = '<li>';
            $config['num_tag_close']   = '</li>';
            
            $this->pagination->initialize($config);
            $pages                = $_GET['per_page'];
            $postlist['page']     = ($pages != "") ? $pages : 0;
            //echo $this->uri->segment(4);
            $postlist['totalrow'] = $config['total_rows'];
            
            $postlist['getfinishgood']       = $this->model_report->mod_finishgood();
            $postlist['masterCuttingSearch'] = $this->model_report->getSearchMasterCutting($_GET, $config["per_page"], $postlist['page']);
            $postlist['pagination']          = $this->pagination->create_links();
            
            $this->load->view('production-report', $postlist);
        } else {
            redirect('index');
        }
    }
    
    function searchProductionKora()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $postlist['getfinishgood']       = $this->model_report->mod_finishgood();
            $postlist['masterCuttingSearch'] = $this->model_report->getOverLocking($_POST, 'Overlock');
            $this->load->view('production-report-kora', $postlist);
        } else {
            redirect('index');
        }
    }
    
    function searchProductionCutting()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $postlist['getfinishgood']       = $this->model_report->mod_finishgood();
            $postlist['masterCuttingSearch'] = $this->model_report->getOverLocking($_POST, 'Cutting');
            $this->load->view('production-report-cutting', $postlist);
        } else {
            redirect('index');
        }
    }
    
    function searchProductionPacking()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $postlist['getfinishgood']       = $this->model_report->mod_finishgood();
            $postlist['masterCuttingSearch'] = $this->model_report->getOverLocking($_POST, 'Packing');
            $this->load->view('production-report-Paking', $postlist);
        } else {
            redirect('index');
        }
    }
    
    
    function view_production()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-production');
        } else {
            redirect('index');
        }
    }
    //==================INvoice=============
    
    function searchInvoice()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['invceSearch'] = $this->model_report->getSearchInvoice($inv_no,$cust_name,$f_date,$t_date);
            $data = $this->Manage_Invoice_Data();
            $this->load->view('invoice-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_Invoice_Data()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_invoice_hdr';
        $url            = site_url('/report/Report/searchInvoice?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_invoice($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchInvoice?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterInvoiceData($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getInvoice($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    //==============================
    
    function view_qc()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-qc');
        } else {
            redirect('index');
        }
    }
    //====================Proforma Invoice===============
    
    function searchProInvoice()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['proInvceSearch'] = $this->model_report->getSearchProInvoice($inv_no,$cstmr_name,$f_date,$t_date);
            $data = $this->Manage_ProformaInvoice();
            $this->load->view('proforma-invoice-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_ProformaInvoice()
    {
        
        $data['result'] = "";
        $table_name     = 'tbl_proforma_invoice_hdr';
        $url            = site_url('/report/Report/searchProInvoice?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_pro_invoice($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchProInvoice?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterProInvoiceData($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getProInvoice($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    //=============================
    
    function view_proforma_invoice()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-invoice-order');
        } else {
            redirect('index');
        }
    }
    
    
    function searchPacking()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $postlist['packingSearch'] = $this->model_report->getSearchPacking($p_id, $f_date, $t_date);
            $this->load->view('packing-report', $postlist);
        } else {
            redirect('index');
        }
    }
    
    function view_packing()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-packing');
        } else {
            redirect('index');
        }
    }
    
    function searchRmPlaning()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            //$postlist['purchaseOrderSearch'] = $this->model_report->getSearchPurchaseOrder($p_no,$v_name,$f_date,$t_date);
            $data = $this->Manage_rm_planing_data();
            $this->load->view('rm-planing-report', $data);
        } else {
            redirect('index');
        }
    }
    
    function Manage_rm_planing_data()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_purchase_order_hdr';
        $url            = site_url('/report/Report/searchTemplate?');
        $sgmnt          = "4";
        $showEntries    = 10;
        $totalData      = $this->model_report->count_po($pagination['per_page'], $pagination['page'], $this->input->get());
        if ($_GET['entries'] != "") {
            $showEntries = $_GET['entries'];
            $url         = site_url('/report/Report/searchTemplate?entries=' . $_GET['entries']);
        }
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        $data               = $this->user_function(); // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter') ////filter start ////
            $data['result'] = $this->model_report->filterRmPlaningOrder($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getRmPlaningOrder($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    function searchSalesOrder()
    {
        extract($_POST);
        if ($this->session->userdata('is_logged_in')) {
            $postlist['saleOrderSearch'] = $this->model_report->getSearchSaleOrder($p_no, $v_name, $f_date, $t_date, $g_total);
            $this->load->view('add-saleorder-report', $postlist);
        } else {
            redirect('index');
        }
    }
    
}

?>