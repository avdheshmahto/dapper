 <?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of Employee Model
     *
     * @author TechArise Team
     *
     * @email info@techarise.com
     */
    defined('BASEPATH') OR exit('No direct script access allowed');

    class employee_model extends CI_Model {
        // Declare variables
        private $_limit;
        private $_pageNumber;
        private $_offset;
        // setter getter function
        public function setLimit($limit) {
            $this->_limit = $limit;
        }

        public function setPageNumber($pageNumber) {
            $this->_pageNumber = $pageNumber;
        }

        public function setOffset($offset) {
            $this->_offset = $offset;
        }
        // Count all record of table "employee" in database.
        public function getAllEmployeeCount() {
            $this->db->from('tbl_product_stock');
            return $this->db->count_all_results();
        }
        // Fetch data according to per_page limit.
        public function employeeList() {       
            $this->db->select(array('e.Product_id', 'e.productname', 'e.sku_no', 'e.quantity', 'e.style_no'));
            $this->db->from('tbl_product_stock as e');          
            $this->db->limit($this->_pageNumber, $this->_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

    }

    ?>