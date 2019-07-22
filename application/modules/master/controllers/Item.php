<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Item extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_master');
    }
    
    public function updateItem()
    {
        if ($this->session->userdata('is_logged_in')) {
            $data['ID'] = $_GET['ID'];
            $this->load->view('/Item/edit-item', $data);
        } else {
            redirect('index');
        }
    }
    
    
    public function ajax_getentityRows()
    {
        
        $result = $this->model_master->get_getentityRowsItem($this->input->post('id'));
    }
    
    
    
    
    public function ajax_getentityRowsOfPart()
    {
        
        $result = $this->model_master->get_getentityRowsItemPart($this->input->post('id'));
    }
    
    
    public function ajax_getentityShape()
    {
        
        $result = $this->model_master->get_getentityRowsItemShape($this->input->post('id'));
    }
    
    
    public function manage_item()
    {
        if ($this->session->userdata('is_logged_in')) {
            $d    = $_GET['p_type'];
            $data = $this->manageItemJoinfun($d);
            $this->load->view('Item/manage-item', $data);
        } else {
            redirect('index');
        }
    }
    
    public function manageItemJoinfun($d)
    {
        $table_name     = 'tbl_product_stock';
        $data['result'] = "";
        $p_type         = $d;
        //$url   = site_url('/master/Item/manage_item?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_master->count_product($table_name, 'A', $this->input->get(), $p_type);
        
        if ($_GET['entries'] != '' && $_GET['filter'] != 'filter') {
            $url = site_url('/master/Item/manage_item?p_type=' . $p_type . '&entries=' . $_GET['entries']);
        } elseif ($_GET['filter'] == 'filter' || $_GET['entries'] != '') {
            $url = site_url('/master/Item/manage_item?p_type=' . $p_type . '&sku_no=' . $_GET['sku_no'] . '&type=' . $_GET['type'] . '&category=' . $_GET['category'] . '&productname=' . $_GET['productname'] . '&usages_unit=' . $_GET['usages_unit'] . '&size=' . $_GET['size'] . '&thickness=' . $_GET['thickness'] . '&gradecode=' . $_GET['gradecode'] . '&filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } else {
            $url = site_url('/master/Item/manage_item?p_type=' . $p_type);
        }
        
        $pagination         = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        //$pagination['uri_segment']=2;
        $data               = $this->user_function();
        $data['dataConfig'] = array(
            'p_type' => $p_type,
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter')
            $data['result'] = $this->model_master->filterProductList($pagination['per_page'], $pagination['page'], $this->input->get(), $p_type);
        else
            $data['result'] = $this->model_master->product_get($pagination['per_page'], $pagination['page'], $p_type);
        
        return $data;
        
    }
    
    public function insert_item()
    {
        
        @extract($_POST);
        //print_r($_POST);die;
        $table_name            = 'tbl_product_stock';
        $table_name_map        = 'tbl_shape_part_mapping';
        $table_name_part_price = 'tbl_part_price_mapping';
        $table_name_shape      = 'tbl_machine';
        $pri_col               = 'Product_id';
        $pri_col_map           = 'product_id';
        $id                    = $this->input->post('Product_id');
        $this->load->model('Model_admin_login');
        
        $data = array(
            
            'scrap_id' => $this->input->post('scrap_id'),
            'type' => $this->input->post('type'),
            'category' => $this->input->post('category'),
            'sku_no' => $this->input->post('sku_no'),
            'percentage' => $this->input->post('percentage'),
            'packing' => $this->input->post('packing'),
            'qty_box' => $this->input->post('qty_box'),
            'productname' => $this->input->post('productname'),
            'subcategory' => $this->input->post('subcategory'),
            'usageunit' => $this->input->post('unit'),
            'pro_size' => $this->input->post('size'),
            'thickness' => $this->input->post('thickness'),
            'grade_code' => $this->input->post('grade_code'),
            'unitprice_sale' => $this->input->post('unitprice_sale'),
            'circle_weight' => $this->input->post('circle_weight'),
            'unitprice_purchase' => $this->input->post('unitprice_purchase'),
            'hsn_code' => $this->input->post('hsn_code'),
            'gst_tax' => $this->input->post('gst_tax'),
            'weight' => $this->input->post('weight'),
            'ctn_lenght' => $this->input->post('ctn_lenght'),
            'ctn_width' => $this->input->post('ctn_width'),
            'ctn_height' => $this->input->post('ctn_height'),
            'mst' => $this->input->post('mst'),
            'cbm' => $this->input->post('cbm'),
            'lead_time' => $this->input->post('lead_time'),
            'opening_stock' => $this->input->post('opening_stock'),
            'quantity' => $this->input->post('opening_stock'),
            'net_weight' => $this->input->post('net_weight'),
            'cast_weight' => $this->input->post('cast_weight'),
            'tolerance_percentage' => $this->input->post('tolerance_percentage')
            
        );
        
        $sesio = array(
            'comp_id' => $this->session->userdata('comp_id'),
            'divn_id' => $this->session->userdata('divn_id'),
            'zone_id' => $this->session->userdata('zone_id'),
            'brnh_id' => $this->session->userdata('brnh_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
        );
        
        if ($id == "") {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            $lastId = $this->db->insert_id();
            $count  = count($entity);
            
            for ($i = 0; $i < $count; $i++) {
                
                $data_dtl = array(
                    'part_id' => $entity[$i],
                    'product_id' => $lastId
                );
                
                $sesio = array(
                    'comp_id' => $this->session->userdata('comp_id'),
                    'divn_id' => $this->session->userdata('divn_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id'),
                    'maker_date' => date('y-m-d'),
                    'author_date' => date('y-m-d')
                );
                
                $merge_data_dtl = array_merge($data_dtl, $sesio);
                $this->Model_admin_login->insert_user($table_name_map, $merge_data_dtl);
                //echo $i;
            }
            
            
            for ($s = 0; $s < count($prodcId); $s++) {
                $data = array(
                    'rowmatial' => $prodcId[$s],
                    'qty' => $mproPrice[$s],
                    'EPrice' => $EPrice[$s],
                    'part_id' => $lastId,
                    'machine_id' => $itemid,
                    'type' => $mapType,
                    'unit' => $uom[$s]
                );
                
                $dataall = array_merge($data, $sesio);
                $this->Model_admin_login->insert_user($table_name_part_price, $dataall);
            }
            
            
            for ($r = 0; $r < count($entityShape); $r++) {
                $dataShape = array(
                    'code' => $lastId,
                    'machine_name' => $entityShape[$r]
                    
                );
                
                $dataallShape = array_merge($dataShape, $sesio);
                $this->Model_admin_login->insert_user($table_name_shape, $dataallShape);
            }
            
            //$this->session->set_flashdata('flash_msg', 'Record Added Successfully.');
            echo "1" . "^" . $type;
        } else if ($id != "") {
            
            $this->Model_admin_login->delete_user($pri_col, $table_name, $contact);
            $this->Model_admin_login->update_user($pri_col, $table_name, $id, $data);
            
            $this->Model_admin_login->delete_user($pri_col_map, $table_name_map, $id);
            $count = count($entity);
            
            for ($i = 0; $i < $count; $i++) {
                
                $data_dtl = array(
                    'part_id' => $entity[$i],
                    'product_id' => $id
                );
                
                $sesio = array(
                    'comp_id' => $this->session->userdata('comp_id'),
                    'divn_id' => $this->session->userdata('divn_id'),
                    'zone_id' => $this->session->userdata('zone_id'),
                    'brnh_id' => $this->session->userdata('brnh_id'),
                    'maker_date' => date('y-m-d'),
                    'author_date' => date('y-m-d')
                );
                
                
                $merge_data_dtl = array_merge($data_dtl, $sesio);
                $this->Model_admin_login->insert_user($table_name_map, $merge_data_dtl);
                //echo $i;
                
                
                
            }
            $this->db->query("delete from tbl_part_price_mapping where part_id='$id'");
            
            for ($s = 0; $s < count($prodcId); $s++) {
                $data = array(
                    'rowmatial' => $prodcId[$s],
                    'qty' => $mproPrice[$s],
                    'EPrice' => $EPrice[$s],
                    'part_id' => $id,
                    'machine_id' => $itemid,
                    'type' => $mapType,
                    'unit' => $uom[$s]
                );
                
                //$dataall = array_merge($data,$sesio);
                $this->Model_admin_login->insert_user($table_name_part_price, $data);
                
                
                
            }
            
            $this->db->query("delete from tbl_machine where code='$id'");
            
            for ($r = 0; $r < count($entityShape); $r++) {
                $dataShape = array(
                    'code' => $id,
                    'machine_name' => $entityShape[$r]
                    
                );
                
                $dataallShape = array_merge($dataShape, $sesio);
                $this->Model_admin_login->insert_user($table_name_shape, $dataallShape);
            }
            
            echo "2" . "^" . $type;
            
        }
        //redirect('master/Item/manage_item');
    }
    
    public function ajex_ItemListData()
    {
        
        $d    = $_POST['id'];
        $data = $this->manageItemJoinfun($d);
        $this->load->view('Item/edit-item', $data);
    }
    
    
    public function ajex_UnitListData()
    {
        
        $data = $this->manageConversionJoinfun();
        $this->load->view('Item/get-conversion', $data);
    }
    
    
    
    
    public function test_3()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('Item/test_3');
        } else {
            redirect('index');
        }
        
    }
    
    public function item_list()
    {
        $info = array();
        
        $res = $this->db->select('*')->where('status', 'A')->get('tbl_product_stock');
        
        $i = '0';
        
        foreach ($res->result() as $row) {
            
            $compQuery1 = $this->db->select('*')->where('serial_number', $row->usageunit)->get('tbl_master_data');
            $keyvalue1  = $compQuery1->row();
            
            
            $info[$i]['1'] = $row->Product_id;
            $info[$i]['2'] = $row->category;
            $info[$i]['3'] = $row->productname;
            $info[$i]['4'] = $row->unitprice_purchase;
            $info[$i]['5'] = $row->unitprice_sale;
            $info[$i]['6'] = $row->mrp;
            $info[$i]['7'] = $row->Product_id;
            $info[$i]['8'] = $keyvalue1->keyvalue;
            $info[$i]['9'] = $row->product_image;
            
            $i++;
            
        }
        
        return $info;
        
    }
    
    public function get_cid()
    {
        //$data=$this->user_function();// call permission function
        $this->load->view('get_cid');
        
    }
    
    public function add_item()
    {
        //echo "";die;
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('Item/add-item');
        } else {
            redirect('index');
        }
    }
    //=========================================================================================
    
    public function update_item()
    {
        
        @extract($_POST);
        
        $table_name = 'tbl_product_stock';
        $pri_col    = 'Product_id';
        $idE        = $this->input->post('Product_id');
        $this->load->model('Model_admin_login');
        
        @$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
        $branchFetch2 = $branchQuery2->row();
        
        count($this->input->post('color'));
        // implode function is used here
        $bb = $this->input->post('color');
        @$ab = implode(',', $bb);
        $count = sizeof('color');
        
        if ($_FILES['image_name']['name'] != '') {
            $target     = "assets/image_data/";
            $target1    = $target . @date(U) . "_" . ($_FILES['image_name']['name']);
            $image_name = @date(U) . "_" . ($_FILES['image_name']['name']);
            move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
        } else {
            $image_name = $branchFetch2->product_image;
        }
        $dataarr = array(
            'productname' => $this->input->post('item_name'),
            'industry' => $this->input->post('industry'),
            'type' => $this->input->post('type'),
            'category' => $this->input->post('category'),
            'subcategory' => $this->input->post('subcategory'),
            //'product_image' => $image_name,
            'color' => $ab,
            //'Product_typeid' => $Product_typeid,
            'sku_no' => $this->input->post('sku_no'),
            'gst_tax' => $this->input->post('gst_tax'),
            'hsn_code' => $this->input->post('hsn_code'),
            //'min_re_order_level' => $this->input->post('min_re_order_level'),
            'circle_weight' => $this->input->post('circle_weight'),
            'unitprice_purchase' => $this->input->post('unitprice_purchase'),
            
            'unitprice_sale' => $this->input->post('unitprice_sale'),
            'usageunit' => $this->input->post('unit')
            //'pic_per_box' => $this->input->post('pic_per_box'),
            //'mrp' => $this->input->post('mrp'),
            //'style_no' => $this->input->post('style'),    
        );
        $this->Model_admin_login->update_user($pri_col, $table_name, $idE, $dataarr);
        $this->session->set_flashdata('flash_msg', 'Record Updated Successfully.');
        redirect('master/Item/manage_item');
        
    }
    
    //============================================================================================
    
    
    private function set_barcode($code)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array(
            'text' => $code
        ), array());
    }
    
    
    public function bar()
    {
        //I'm just using rand() function for data example
        $temp = rand(10000, 99999);
        $this->set_barcode($temp);
    }
    
    
    
    
    function changesubcatg()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->input->get('ID');
            $data['result'] = $this->model_master->get_child_data($this->input->get('ID'));
            $this->load->view('Item/getsubcatg', $data);
        } else {
            redirect('index');
        }
    }
    
    public function import_product()
    {
        
        
        if ($this->session->userdata('is_logged_in')) {
            
            $this->load->view('Item/import-product');
        }
        
        else {
            redirect('index');
            
        }
        
    }
    
    
    public function import_item()
    {
        @extract($_POST);
        $filename = $_FILES["file"]["tmp_name"];
        
        
        if ($_FILES["file"]["size"] > 0) {
            
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                //select id of category
                $catId  = $this->db->query("select *from tbl_prodcatg_mst where prodcatg_name='" . $getData[0] . "'");
                $catRow = $catId->row();
                
                //select id of unit id
                $unitId  = $this->db->query("select *from tbl_master_data where keyvalue='" . $getData[2] . "'");
                $unitRow = $unitId->row();
                
                if ($getData[0] != 'Category Name') {
                    
                    
                    $this->db->query("insert into tbl_product_stock set productname='" . $getData[0] . "',category='" . $catRow->prodcatg_id . "',usageunit='" . $unitRow->serial_number . "',hsn_code='" . $getData[3] . "',gst_tax='" . $getData[4] . "',min_re_level='" . $getData[6] . "',p_p_unit='" . $getData[5] . "',unitprice_purchase='" . $getData[7] . "',unitprice_sale='" . $getData[8] . "',comp_id='" . $this->session->userdata('comp_id') . "'");
                    
                }
            }
            fclose($file);
            
        }
        //fclose($file);
        echo "<script>
alert('Product Imported Successfully');
window.location.href = 'manage_item';
</script>";
        
        
        //redirect('/master/manage_item');
        
    }
    
    
    
    public function item_t()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            
            $data           = $this->user_function(); // call permission fnctn
            $data['result'] = $this->model_master->product_get();
            $this->load->view('Item/manage-item-test', $data);
        } else {
            redirect('index');
        }
        
        
    }
    
    
    public function insert_loop_data()
    {
        
        for ($i = 1; $i <= 3000; $i++) {
            $this->db->query("insert into tbl_product_stock set productname='safi',comp_id='1'");
        }
        
    }
    
    
    public function getCat()
    {
        
        $data = array(
            'type' => $_GET['ID']
        );
        $this->load->view("Item/getCat", $data);
    }
    
    
    public function ajex_getPartCode()
    {
        
        $data = array(
            'part_id' => $_POST['partid']
        );
        $this->load->view("Item/getPartCode", $data);
    }
    
    public function ajex_getPartRowMat()
    {
        
        $data['result'] = $this->model_master->getsparemapedQty($this->input->post('partid'), $this->input->post('machineid'));
        
        $this->load->view("Item/getPartRowMat", $data);
    }
    
    
    
    public function ajex_getPartRowMatView()
    {
        
        $data['result'] = $this->model_master->getsparemapedQty($this->input->post('partid'), $this->input->post('machineid'));
        
        $this->load->view("Item/getPartRowMatView", $data);
    }
    
    
    function ajex_insertMapping()
    {
        //print_r($this->input->post());
        @extract($this->input->post());
        $table_name = 'tbl_part_price_mapping';
        $countarr   = count($this->input->post('prodcId'));
        $sesio      = array(
            'maker_id' => $this->session->userdata('comp_id'),
            'comp_id' => $this->session->userdata('comp_id'),
            'divn_id' => $this->session->userdata('divn_id'),
            'zone_id' => $this->session->userdata('zone_id'),
            'brnh_id' => $this->session->userdata('brnh_id'),
            'maker_date' => date('Y-m-d'),
            'author_date' => date('Y-m-d')
        );
        
        
        
        $this->db->delete('tbl_part_price_mapping', array(
            'machine_id' => $this->input->post('itemid'),
            'part_id' => $this->input->post('partid')
        ));
        
        for ($i = 0; $i < $countarr; $i++) {
            $data = array(
                'rowmatial' => $prodcId[$i],
                'qty' => $mproPrice[$i],
                'EPrice' => $EPrice[$i],
                'part_id' => $partid,
                'machine_id' => $itemid,
                'type' => $mapType,
                'unit' => $uom[$i]
            );
            
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
        }
        
        echo 1;
        
        
        
    }
    
    public function manage_unit_conversion()
    {
        if ($this->session->userdata('is_logged_in')) {
            
            $data = $this->manageConversionJoinfun();
            $this->load->view('Item/manage-unit-conversion', $data);
        } else {
            redirect('index');
        }
    }
    
    public function manageConversionJoinfun()
    {
        $table_name     = 'tbl_unit_conversion';
        $data['result'] = "";
        
        //$url   = site_url('/master/Item/manage_item?');
        $sgmnt = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_master->count_unit($table_name, 'A', $this->input->get());
        
        if ($_GET['entries'] != '' && $_GET['filter'] != 'filter') {
            $url = site_url('/master/Item/manage_unit_conversion?entries=' . $_GET['entries']);
        } elseif ($_GET['filter'] == 'filter' || $_GET['entries'] != '') {
            $url = site_url('/master/Item/manage_item?sku_no=' . $_GET['sku_no'] . '&type=' . $_GET['type'] . '&category=' . $_GET['category'] . '&productname=' . $_GET['productname'] . '&usages_unit=' . $_GET['usages_unit'] . '&size=' . $_GET['size'] . '&thickness=' . $_GET['thickness'] . '&gradecode=' . $_GET['gradecode'] . '&filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } else {
            $url = site_url('/master/Item/manage_unit_conversion?');
        }
        
        $pagination         = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        //$pagination['uri_segment']=2;
        $data               = $this->user_function();
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') == 'filter')
            $data['result'] = $this->model_master->filterUnitList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_master->unit_get($pagination['per_page'], $pagination['page']);
        
        return $data;
        
    }
    
    public function insert_unit_conversion()
    {
        @extract($_POST);
        $table_name = 'tbl_unit_conversion';
        $pri_col    = 'id';
        
        $id = $this->input->post('id');
        
        $this->load->model('Model_admin_login');
        
        $data = array(
            
            //'industry'           => $this->input->post('industry'),
            'unit_name' => $this->input->post('main_unit'),
            'unit_conversion_name' => $this->input->post('sub_unit'),
            'unit_conversion_value' => $this->input->post('con_fact')
            
            
        );
        
        $sesio   = array(
            'comp_id' => $this->session->userdata('comp_id'),
            'divn_id' => $this->session->userdata('divn_id'),
            'zone_id' => $this->session->userdata('zone_id'),
            'brnh_id' => $this->session->userdata('brnh_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
        );
        $dataall = array_merge($data, $sesio);
        
        
        if ($id != '') {
            
            $this->Model_admin_login->update_user($pri_col, $table_name, $id, $data);
            echo "2";
        } else {
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo "1";
        }
        
    }
    
    
}

?>