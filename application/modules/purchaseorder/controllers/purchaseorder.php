<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class purchaseorder extends my_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_purchase_order');
    }
    
    public function add_purchase_order()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('add-purchase-order');
        } else {
            redirect('index');
        }
    }
    
    public function view_rm_planning()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-rm-planning');
        } else {
            redirect('index');
        }
    }
    
    
    public function insertInboundOrderGrn()
    {
        
        extract($_POST);
        $table_name      = 'tbl_inbound_hdr';
        $table_name_dtl  = 'tbl_inbound_dtl';
        $pri_col         = 'inboundid';
        $pri_col_dtl     = 'inbound_dtl_id';
        $pri_col_hdr_log = 'tbl_inbound_log';
        
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
            'storage_location' => $this->input->post('storage_location'),
            'po_no' => $this->input->post('po_no'),
            
            'grn_no' => $this->input->post('grn_no'),
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
                    'qn_pc' => $qn_pc[$i],
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
                    'qn_pc' => $qn_pc[$i],
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
                $this->po_stock_in($receive_qty[$i], $productid[$i], $qn_pc[$i]);
                
            }
            
        }
        
        if ($qrd_qtyT == $totToCom) {
            $this->db->query("update tbl_purchase_order_hdr set force_close_status='2' where purchaseid='$po_no'");
        } else {
            $this->db->query("update tbl_purchase_order_hdr set force_close_status='3' where purchaseid='$po_no'");
        }
        
        $rediectInvoice = "purchaseorder/manage_purchase_order";
        
        redirect($rediectInvoice);
        
    }
    
    
    public function po_stock_in($receive_qty, $productid, $qn_pc)
    {
        
        
        $selectQuery  = "select * from tbl_product_serial where product_id='$productid' and location_id='1'";
        $selectQuery1 = $this->db->query($selectQuery);
        $num          = $selectQuery1->num_rows();
        if ($num > 0) {
            $this->db->query("update tbl_product_serial set quantity=quantity+'$receive_qty',qn_pc=qn_pc+'$qn_pc',location_id='1' where product_id='$productid' and location_id='1' ");
        } else {
            $comp_id     = $this->session->userdata('comp_id');
            $divn_id     = $this->session->userdata('divn_id');
            $zone_id     = $this->session->userdata('zone_id');
            $brnh_id     = $this->session->userdata('brnh_id');
            $maker_date  = date('y-m-d');
            $author_date = date('y-m-d');
            
            $this->db->query("insert into tbl_product_serial set quantity='$receive_qty',qn_pc='$qn_pc',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
            
            $this->db->query("insert into tbl_product_serial_log set quantity='$receive_qty',qn_pc='$qn_pc[$i]',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
        }
        
        $this->db->query("update tbl_product_stock set quantity=quantity+'$receive_qty' where Product_id='$productid'");
        
    }
    
    
    public function grn_return()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data['id'] = $_POST['id'];
            $this->load->view('grn-return', $data);
        } else {
            redirect('index');
        }
    }
    
    
    public function insert_retun_grn()
    {
        
        
        extract($_POST);
        $table_name     = 'tbl_grn_return_hdr';
        $table_name_dtl = 'tbl_grn_return_dtl';
        $pri_col        = 'grnhdr';
        
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
            
            'po_no' => $this->input->post('po_no'),
            'return_no' => $this->input->post('return_no'),
            'return_date' => $this->input->post('return_date')
            
        );
        
        $data_merge = array_merge($data, $sess);
        $this->load->model('Model_admin_login');
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        $lastHdrId = $this->db->insert_id();
        //$this->load->model('Model_admin_login');
        
        $rows = count($productid);
        
        for ($i = 0; $i < $rows; $i++) {
            
            if ($return_qty[$i] != '') {
                
                $data_dtl = array(
                    
                    'grnhdr' => $lastHdrId,
                    'po_no' => $po_no,
                    'productid' => $productid[$i],
                    'return_qty' => $return_qty[$i],
                    'return_weight' => $retrn_weight[$i],
                    'receive_qty' => $rec_qty[$i],
                    'receive_weight' => $recevd_wght[$i],
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                    
                );
                
                //print_r($data_dtl);die;
                
                $this->Model_admin_login->insert_user($table_name_dtl, $data_dtl);
                //$this->po_stock_return($return_qty[$i],$productid[$i],$return_weight[$i]);    
                
            }
            
        }
        
        echo 1;
        
    }
    
    public function po_stock_return($return_qty, $productid, $return_weight)
    {
        
        
        $selectQuery  = "select * from tbl_product_serial where product_id='$productid' and location_id='1'";
        $selectQuery1 = $this->db->query($selectQuery);
        $num          = $selectQuery1->num_rows();
        if ($num > 0) {
            
            $this->db->query("update tbl_product_serial set quantity=quantity-'$return_qty',qn_pc=qn_pc+'$return_weight',location_id='1' where product_id='$productid' and location_id='1' ");
        } else {
            $comp_id     = $this->session->userdata('comp_id');
            $divn_id     = $this->session->userdata('divn_id');
            $zone_id     = $this->session->userdata('zone_id');
            $brnh_id     = $this->session->userdata('brnh_id');
            $maker_date  = date('y-m-d');
            $author_date = date('y-m-d');
            
            $this->db->query("insert into tbl_product_serial set quantity='$return_qty',qn_pc='$return_weight',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
            
            $this->db->query("insert into tbl_product_serial_log set quantity='$return_qty',qn_pc='$return_weight[$i]',location_id='1',product_id='$productid',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
            
        }
        
        $this->db->query("update tbl_product_stock set quantity=quantity+'$return_qty' where Product_id='$productid'");
        
        
    }
    
    public function ajax_post_grn()
    {
        
        $data['pid'] = $_POST['id'];
        $this->load->view('ajax-grn-return', $data);
        
    }
    
    
    public function case_memo()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('case-memo');
        } else {
            redirect('index');
        }
    }
    
    public function view_grn_details()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            
            $data = array(
                'id' => $_POST['id']
            );
            
            $this->load->view('view-grn-details', $data);
        } else {
            redirect('index');
        }
        
    }
    
    
    
    public function print_sales()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('email');
        } else {
            redirect('index');
        }
    }
    
    public function print_invoice()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('print-invoice');
        } else {
            redirect('index');
        }
    }
    
    public function invoice_details()
    {
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->user_function(); // call permission fnctn
            $this->load->view('invoice-details', $data);
        } else {
            redirect('index');
        }
    }
    
    public function salesOrder_details_mail()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('invoice-details-mail');
        } else {
            redirect('index');
        }
    }
    
    
    public function insert_invoice()
    {
        extract($_POST);
        $table_name = 'tbl_sales_order_hdr';
        $pri_col    = 'salesid';
        $id         = $this->input->post('id');
        
        $data = array(
            
            'from' => $this->input->post('from'),
            'send_to' => $this->input->post('send_to'),
            'cc' => $this->input->post('cc'),
            'subject' => $this->input->post('subject'),
            'content' => $this->input->post('content')
        );
        
        $this->load->model('Model_admin_login');
        $this->Model_admin_login->update_user($pri_col, $table_name, $id, $data);
        
        $querySalesQuery = $this->db->query("select *from tbl_sales_order_hdr where salesid='$id'");
        
        $getSales = $querySalesQuery->row();
        $cont     = $getSales->content;
        
        $data = array(
            'id' => $id
        );
        
        $url = "assets/sales_order_pdf/invoice_order'" . $id . "'.pdf";
        
        //load the view and saved it into $html variable
        
        $html = $this->load->view('email', $data, true);
        
        //this the the PDF filename that user will get to download
        
        $pdfFilePath = $url;
        
        //load mPDF library
        
        $this->load->library('m_pdf');
        
        //generate the PDF from the given html
        
        $this->m_pdf->pdf->WriteHTML($html);
        
        //download it.
        
        $this->m_pdf->pdf->Output($pdfFilePath, "f");
        $config = Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $data   = array(
            'id' => $_GET['id']
        );
        $this->load->library('email', $config);
        $this->email->from('info@techvyaserp.in');
        $this->email->to($send_to);
        $this->email->cc('collestbablu@gmail.com');
        $this->email->subject($subject);
        $this->email->message($cont);
        $this->email->attach($url);
        if ($this->email->send()) {
            
            echo "<script type='text/javascript'>";
            echo "window.close();";
            echo "window.opener.location.reload();";
            echo "</script>";
            
            //redirect("salesorder/SalesOrder/manageSalesOrder");
        } else {
            //redirect("salesorder/SalesOrder/manageSalesOrder");
            
            echo "<script type='text/javascript'>";
            echo "window.close();";
            echo "window.opener.location.reload();";
            echo "</script>";
            
        }
        
    }
    
    
    
    
    public function testdrop()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('test');
        } else {
            redirect('index');
        }
    }
    
    
    public function edit_invoice_order()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('edit-invoice-order');
        } else {
            redirect('index');
        }
    }
    
    public function edit_purchase_order_1()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('edit-purchase-order');
        } else {
            redirect('index');
        }
    }
    
    public function manage_purchase_order()
    {
        if ($this->session->userdata('is_logged_in')) {
            //$data=$this->user_function();// call permission fnctn
            //$data['result'] = $this->model_purchase_order->invoice_data();
            $data = $this->Manage_PO_Data();
            $this->load->view('manage-purchase-order', $data);
        } else {
            redirect('index');
        }
    }
    
    public function Manage_PO_Data()
    {
        
        $data['result'] = "";
        $table_name     = 'tbl_purchase_order_hdr';
        //$url        = site_url('/purchaseorder/manage_purchase_order?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_purchase_order->count_po($table_name, 'A', $this->input->get());
        
        if ($_GET['entries'] != '' && $_GET['filter'] != 'filter') {
            $url = site_url('/purchaseorder/manage_purchase_order?entries=' . $_GET['entries']);
        } elseif ($_GET['filter'] == 'filter' || $_GET['entries'] != '') {
            $url = site_url('/purchaseorder/manage_purchase_order?purchaseid=' . $_GET['purchaseid'] . '&date=' . $_GET['date'] . '&cust_name=' . $_GET['cust_name'] . '&grand_total=' . $_GET['grand_total'] . '&filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } else {
            $url = site_url('/purchaseorder/manage_purchase_order?');
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
            $data['result'] = $this->model_purchase_order->filterPurchaseOrder($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_purchase_order->getPO($pagination['per_page'], $pagination['page']);
        
        return $data;
        
    }
    
   
    
    public function insertPurchaseOrder()
    {
        
        extract($_POST);
        $table_name     = 'tbl_purchase_order_hdr';
        $table_name_dtl = 'tbl_purchase_order_dtl';
        $pri_col        = 'purchaseid';
        $pri_col_dtl    = 'purchase_dtl_id';
        
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
            
            'purchase_no' => $this->input->post('purchase_no'),
            'sales_id' => $this->input->post('iddd'),
            'vendor_id' => $this->input->post('vendor_id'),
            'invoice_status' => $this->input->post('invoice_type'),
            'invoice_date' => $this->input->post('date'),
            'due_date' => $this->input->post('due_date'),
            'sub_total' => $this->input->post('sub_total'),
            'total_cgst' => $this->input->post('total_cgst'),
            'total_tax_cgst_amt' => $this->input->post('total_tax_cgst_amt'),
            'total_sgst' => $this->input->post('total_sgst'),
            'total_tax_sgst_amt' => $this->input->post('total_tax_sgst_amt'),
            'total_igst' => $this->input->post('total_igst'),
            'total_tax_igst_amt' => $this->input->post('total_tax_igst_amt'),
            'total_gst_tax_amt' => $this->input->post('total_gst_tax_amt'),
            'total_dis' => $this->input->post('total_dis'),
            'total_dis_amt' => $this->input->post('total_dis_amt'),
            'grand_total' => $this->input->post('grand_total'),
            'wff_date' => $this->input->post('wff_date'),
            'valid_till_date' => $this->input->post('valid_till_date'),
            'reference' => $this->input->post('reference'),
            'freight' => $this->input->post('freight'),
            'Place_of_Supply' => $this->input->post('Place_of_Supply'),
            'gr_no' => $this->input->post('gr_no'),
            'status' => 'Draft'
            
            
        );
        
        $data_merge = array_merge($data, $sess);
        $this->load->model('Model_admin_login');
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        $lastHdrId = $this->db->insert_id();
        $this->load->model('Model_admin_login');
        
        for ($i = 0; $i <= $rows; $i++) {
            
            
            
            
            if ($qty[$i] != '') {
                
                $data_dtl = array(
                    'purchaseid' => $lastHdrId,
                    'productid' => $main_id[$i],
                    'list_price' => $list_price[$i],
                    'qty' => $qty[$i],
                    'discount' => $discount[$i],
                    'discount_amount' => $disAmount[$i],
                    'cgst' => $cgst[$i],
                    'sgst' => $sgst[$i],
                    'igst' => $igst[$i],
                    'gstTotal' => $gstTotal[$i],
                    'total_price' => $tot[$i],
                    'net_price' => $nettot[$i],
                    'net_price' => $nettot[$i],
                    'circle_weight' => $circle_weight[$i],
                    
                    'qn_pc' => $qn_pc[$i],
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
        //$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);    
        //$this->paymentAmountInsert($grand_total,$vendor_id,$lastHdrId,$id);    
        //$this->updateTermAndCondition($lastHdrId, $vendor_id, $grand_total, $date);
        $this->software_log_insert($lastHdrId, $vendor_id, $grand_total, 'Purchase Order added');
        
        $rediectInvoice = "purchaseorder/purchaseorder/manage_purchase_order";
        redirect($rediectInvoice);
        
        
        
    }
    
    public function updateTermAndCondition($lastHdrId, $vendor_id, $grand_total, $date)
    {
        $contactQuey = $this->db->query("select *from tbl_contact_m where contact_id='$vendor_id'");
        $getContact  = $contactQuey->row();
        
        
        $termandcondition = "     
            <p>&nbsp;</p>
            <div style='font-family: 'Times New Roman'; font-size: medium; background: #fbfbfb;'>
            <div style='padding: 25.6094px; text-align: center; background: #4190f2;'>
            <div style='color: #ffffff; font-size: 20px;'>Invoice # $lastHdrId</div>
            </div>
            <div style='max-width: 560px; margin: auto; padding: 0px 25.6094px;'>
            <div style='padding: 30px 0px; color: #555555; line-height: 1.7;'>Dear $getContact->first_name,&nbsp;<br /><br />Your invoice $lastHdrId is attached.

            Thank you for your business.&nbsp;</div>
            <br />
            <div style='padding: 16.7969px 0px; line-height: 1.6;'>Thanks & Regards
            <div style='color: #8c8c8c;'>Gaurav Taneja</div>
            <div style='color: #b1b1b1;'>Tech Vyas Solutions Pvt Ltd.</div>
            <div style='color: #b1b1b1;'>9990455812</div>
            </div>
            </div>
            </div>
            <p>&nbsp;</p>";
        $this->db->query("update tbl_sales_order_hdr set termandcondition='" . addslashes($termandcondition) . "' where salesid='$lastHdrId'");
        
    }
    
    public function updatePurchaseOrder()
    {
        
        extract($_POST);
        $table_name     = 'tbl_purchase_order_hdr';
        $table_name_dtl = 'tbl_purchase_order_dtl';
        $pri_col        = 'purchaseid';
        $pri_col_dtl    = 'purchase_dtl_id';
        
        
        //$this->refil_qnty_del($id);
        
        $this->db->query("delete from tbl_purchase_order_dtl where purchaseid='$id'");
        
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
            'purchase_no' => $this->input->post('purchase_no'),
            'vendor_id' => $this->input->post('vendor_id'),
            'invoice_status' => $this->input->post('invoice_type'),
            'invoice_date' => $this->input->post('date'),
            'due_date' => $this->input->post('due_date'),
            'sub_total' => $this->input->post('sub_total'),
            'total_cgst' => $this->input->post('total_cgst'),
            'total_tax_cgst_amt' => $this->input->post('total_tax_cgst_amt'),
            'total_sgst' => $this->input->post('total_sgst'),
            'total_tax_sgst_amt' => $this->input->post('total_tax_sgst_amt'),
            'total_igst' => $this->input->post('total_igst'),
            'total_tax_igst_amt' => $this->input->post('total_tax_igst_amt'),
            'total_gst_tax_amt' => $this->input->post('total_gst_tax_amt'),
            'total_dis' => $this->input->post('total_dis'),
            'total_dis_amt' => $this->input->post('total_dis_amt'),
            'grand_total' => $this->input->post('grand_total'),
            'wff_date' => $this->input->post('wff_date'),
            'valid_till_date' => $this->input->post('valid_till_date'),
            'reference' => $this->input->post('reference'),
            'freight' => $this->input->post('freight'),
            
            'Place_of_Supply' => $this->input->post('Place_of_Supply'),
            
            'gr_no' => $this->input->post('gr_no'),
            'status' => 'Draft'
            
        );
        
        $data_merge = array_merge($data, $sess);
        
        $this->load->model('Model_admin_login');
        $this->Model_admin_login->update_user($pri_col, $table_name, $id, $data_merge);
        
        
        for ($i = 0; $i <= $rows; $i++) {
            
            
            
            
            if ($qty[$i] != '') {
                
                $data_dtl = array(
                    'purchaseid' => $id,
                    'productid' => $main_id[$i],
                    'list_price' => $list_price[$i],
                    'qty' => $qty[$i],
                    'discount' => $discount[$i],
                    'discount_amount' => $disAmount[$i],
                    'cgst' => $cgst[$i],
                    'sgst' => $sgst[$i],
                    'igst' => $igst[$i],
                    'gstTotal' => $gstTotal[$i],
                    'total_price' => $tot[$i],
                    'net_price' => $nettot[$i],
                    'maker_id' => $this->session->userdata('user_id'),
                    'maker_date' => date('y-m-d'),
                    'comp_id' => $this->session->userdata('comp_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id')
                );
                
                $this->Model_admin_login->insert_user($table_name_dtl, $data_dtl);
                //$this->stock_refill_qty($qty[$i],$main_id[$i]);
                
            }
        }
        $this->paymentAmount($grand_total, $vendor_id, $lastHdrId, $id);
        $this->software_log_insert($id, $vendor_id, $grand_total, 'Invoice Updated');
        echo "<script type='text/javascript'>";
        echo "window.close();";
        echo "window.opener.location.reload();";
        echo "</script>";
        
        
    }
    
    function refil_qnty_del($id)
    {
        
        $data = $this->db->query("select * from tbl_invoice_dtl where invoiceid='$id'");
        foreach ($data->result() as $update) {
            $this->db->query("update tbl_product_stock set quantity=quantity+'" . $update->qty . "' where   Product_id='" . $update->productid . "'");
            
            
        }
        return;
    }
    
    
    
    public function stock_refill_qty($qty, $main_id)
    {
        
        $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
        
    }
    
    
    function updata_stock($qty, $main_id)
    {
        
        $this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id'");
        
        return;
    }
    //================================
    
    public function paymentAmountInsert($grand_total, $vendor_id, $lastHdrId, $id)
    {
        
        $table_name = 'tbl_invoice_payment';
        $pri_col    = 'invoiceid';
        if ($id != '') {
            $lastHdrId = $id;
        } else {
            $lastHdrId;
        }
        $data_pay = array(
            
            'contact_id' => $vendor_id,
            'receive_billing_mount' => $grand_total,
            'invoiceid' => $lastHdrId,
            'date' => date('Y-m-d H:i:s'),
            'maker_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'comp_id' => $this->session->userdata('comp_id'),
            'status' => 'invoice'
            
        );
        $this->load->model('Model_admin_login');
        
        $this->Model_admin_login->insert_user($table_name, $data_pay);
        
        return paymentAmountInsert;
    }
    
    //===============================    
    
    public function paymentAmount($grand_total, $vendor_id, $lastHdrId, $id)
    {
        
        $table_name = 'tbl_invoice_payment';
        $pri_col    = 'invoiceid';
        if ($id != '') {
            $lastHdrId = $id;
        } else {
            $lastHdrId;
        }
        $data_pay = array(
            
            'contact_id' => $vendor_id,
            'receive_billing_mount' => $grand_total,
            'invoiceid' => $lastHdrId,
            'date' => date('Y-m-d H:i:s'),
            'maker_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'comp_id' => $this->session->userdata('comp_id'),
            'status' => 'invoice'
            
        );
        $this->load->model('Model_admin_login');
        if ($id != '') {
            
            //        $this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_pay);
            
            $datee   = date('Y-m-d H:i:s');
            $mkrdate = date('y-m-d');
            $this->db->query("update tbl_invoice_payment set contact_id='" . $vendor_id . "',receive_billing_mount='" . $grand_total . "',invoiceid='" . $lastHdrId . "',date='$datee',maker_id='" . $this->session->userdata('user_id') . "',maker_date='$mkrdate',comp_id='" . $this->session->userdata('comp_id') . "',status='invoice' where status='invoice' and invoiceid='$id'");
            
        }
        return paymentAmount;
    }
    
    public function getproduct()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('getproduct');
        } else {
            redirect('index');
        }
    }
    
    
    public function all_product_function()
    {
        
        $this->load->view('all-product', $data);
        
    }
    
    public function viewSalesOrder()
    {
        if ($this->session->userdata('is_logged_in')) {
            
            $this->load->view('view-sales-order');
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
    
    function delete_updata_stock($qty1, $main_id)
    {
        
        $this->db->query("update tbl_product_stock set quantity=quantity-'$qty1' where Product_id='$main_id'");
        $this->db->query("update tbl_product_serial set quantity=quantity-'$qty1' where product_id='$main_id'");
        return;
    }
    
    function item_Stock()
    {
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->manageItemJoinfun();
            $this->load->view('purchaseorder/manage-item', $data);
        } else {
            redirect('index');
        }
        
    }
    
    public function manageItemJoinfun()
    {
        
        $table_name     = 'tbl_product_stock';
        $data['result'] = "";
        //$url   = site_url('/master/Item/manage_item?');
        $sgmnt          = "4";
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_purchase_order->count_product($table_name, 'A', $this->input->get());
        
        if ($_GET['entries'] != '' && $_GET['filter'] != 'filter') {
            $url = site_url('/purchaseorder/item_Stock?entries=' . $_GET['entries']);
        } elseif ($_GET['filter'] == 'filter' || $_GET['entries'] != '') {
            $url = site_url('/purchaseorder/item_Stock?sku_no=' . $_GET['sku_no'] . '&type=' . $_GET['type'] . '&category=' . $_GET['category'] . '&productname=' . $_GET['productname'] . '&usages_unit=' . $_GET['usages_unit'] . '&size=' . $_GET['size'] . '&thickness=' . $_GET['thickness'] . '&gradecode=' . $_GET['gradecode'] . '&filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } else {
            $url = site_url('/purchaseorder/item_Stock?');
        }
        
        $pagination         = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        $data               = $this->user_function();
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter')
            $data['result'] = $this->model_purchase_order->filterProductList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_purchase_order->product_get($pagination['per_page'], $pagination['page']);
        
        return $data;
    }
    
    
    public function force_close()
    {
        
        @extract($_POST);
        $this->db->query("update tbl_purchase_order_hdr set reason='$reason',force_close_status='1',fc_date='$date' where purchaseid='$id'");
        echo "1";
        
    }
    
}