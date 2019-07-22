<?php
class model_master extends CI_Model
{
    
    function productCatg_data()
    {
        $this->db->select("*");
        // $this->db->order_by("prodcatg_id","desc");
        $this->db->from('tbl_prodcatg_mst');
        $query = $this->db->get();
        return $result = $query->result();
    }
    
    function productSubCatg_data()
    {
        $this->db->select("*");
        // $this->db->order_by("prodcatg_id","desc");
        $this->db->from('tbl_prodcatg_m');
        $query = $this->db->get();
        return $result = $query->result();
    }
    
    //===========================================Product Master============================
    
    function product_get($last, $strat, $p_type)
    {
        
        
        
        
        //echo "select *from tbl_product_stock where status='A' and type='$p_type'  order by Product_id desc limit $strt,$last";
        $query = $this->db->query("select *from tbl_product_stock where status='A' and type='$p_type'  order by sku_no asc limit $strat,$last");
        return $result = $query->result();
    }
    
    function filterProductList($perpage, $pages, $get, $p_type)
    {
        
        $qry = "select * from tbl_product_stock where status = 'A' ";
        
        if (sizeof($get) > 0) {
            
            
            
            if ($get['p_type'] != "")
                $qry .= " AND type LIKE '%" . $get['p_type'] . "%'";
            
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
    
    
    function count_product($tableName, $status = 0, $get, $p_type)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A' ";
        
        if (sizeof($get) > 0) {
            if ($get['p_type'] != "")
                $qry .= " AND type LIKE '%" . $get['p_type'] . "%'";
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
    
    
    //=============================Contact Master==================================================
    
    function contact_get($last, $strat, $con_type)
    {
        $query = $this->db->query("select *from tbl_contact_m where status='A' and group_name='$con_type' ORDER BY contact_id DESC limit $strat,$last");
        return $result = $query->result();
    }
    
    function filterContactList($perpage, $pages, $get, $con_type)
    {
        
        $qry = "select * from tbl_contact_m where status = 'A' ";
        
        if (sizeof($get) > 0) {
            
            if ($get['con_type'] != '')
                $qry .= " AND group_name LIKE '%" . $get['con_type'] . "%'";
            
            if ($get['name'] != "")
                $qry .= " AND first_name LIKE '%" . $get['name'] . "%'";
            
            if ($get['grp_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_account_mst where account_name LIKE '%" . $get['grp_name'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->account_id;
                $qry .= " AND group_name ='$sr_no'";
            }
            
            if ($get['email'] != "")
                $qry .= " AND email LIKE '%" . $get['email'] . "%'";
            
            if ($get['mobile'] != "")
                $qry .= " AND mobile LIKE '%" . $get['mobile'] . "%'";
            
            if ($get['phone'] != "")
                $qry .= " AND phone LIKE '%" . $get['phone'] . "%'";
            
        }
        
        $qry .= " LIMIT $pages,$perpage";
        
        $data = $this->db->query($qry)->result();
        
        return $data;
        
    }
    
    function count_contact($tableName, $status = 0, $get, $con_type)
    {
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        
        
        if (sizeof($get) > 0) {
            
            
            
            if ($get['con_type'] != '')
                $qry .= " AND group_name LIKE '%" . $get['con_type'] . "%'";
            
            if ($get['name'] != "")
                $qry .= " AND first_name LIKE '%" . $get['name'] . "%'";
            
            if ($get['grp_name'] != "") {
                $unitQuery = $this->db->query("select * from tbl_account_mst where account_name LIKE '%" . $get['grp_name'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->account_id;
                $qry .= " AND group_name ='$sr_no'";
            }
            
            if ($get['email'] != "")
                $qry .= " AND email LIKE '%" . $get['email'] . "%'";
            
            
            if ($get['mobile'] != "")
                $qry .= " AND mobile LIKE '%" . $get['mobile'] . "%'";
            
            if ($get['phone'] != "")
                $qry .= " AND phone LIKE '%" . $get['phone'] . "%'";
            
        }
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        
        return $query[0]['countval'];
        
    }
    
    function tree_all()
    {
        $data   = "";
        $result = $this->db->query("SELECT  id, name,name as text, inside_cat as parent_id ,create_on FROM tbl_category where status = 1 Order by id ASC")->result_array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }
    
    function categorySelectbox($parent = 0, $spacing = '', $user_tree_array = '')
    {
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        
        $sql   = "select * from tbl_category where status = 1 AND inside_cat = $parent";
        $query = $this->db->query($sql);
        $data  = $query->result_array();
        if (sizeof($data) > 0) {
            foreach ($data as $row) {
                // echo "<option>".$spacing . $row['name']."</option>";
                $user_tree_array[] = array(
                    "id" => $row['id'],
                    "name" => $spacing . $row['name'],
                    'praent' => $row['inside_cat']
                );
                $user_tree_array   = $this->categorySelectbox($row['id'], $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $user_tree_array);
            }
        }
        return $user_tree_array;
    }
    
    function category_all($last, $strat)
    {
        $data   = "";
        /*echo "SELECT  id, name,name as text, inside_cat as parent_id ,create_on FROM tbl_category where status = 1 Order by id ASC limit $strat,$last";*/
        $result = $this->db->query("SELECT  id, name,name as text, inside_cat as parent_id ,create_on,type,grade FROM tbl_category where status = 1 Order by type asc ")->result_array();
        if (sizeof($result) > 0) {
            return $result;
        }
    }
    
    function insert_value($post)
    {
        $data = date("Y-m-d");
        //echo $post['typee'];die;
        $sql  = "insert into tbl_category set type = ?,name = ?,inside_cat = ?,create_on = ?";
        return $this->db->query($sql, array(
            $post['typee'],
            $post['category'],
            $post['selectCategory'],
            $data
        ));
        
    }
    
    function treeGetParentValue($id = 0, $user_tree_array = '')
    {
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        
        $sql   = "select * from tbl_category where  id =$id";
        $query = $this->db->query($sql);
        $data  = $query->result_array();
        
        if (sizeof($data) > 0) {
            foreach ($data as $row) {
                $user_tree_array[] = array(
                    "id" => $row['inside_cat'],
                    'name' => $row['name']
                );
                $user_tree_array   = $this->treeGetParentValue($row['inside_cat'], $user_tree_array);
            }
        }
        return $user_tree_array;
    }
    
    function edit_Category($post)
    {
        $qry = "update tbl_category set type = ?,name = ?,inside_cat=?  WHERE id = ?";
        $this->db->query($qry, array(
            $post['typee'],
            $post['category'],
            $post['selectCategory'],
            $post['edit']
        ));
    }
    
    function get_child_data($id = 0, $spacing = '', $user_tree_array = '')
    {
        
        
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        if ($id != '') {
            $sql = "select * from tbl_category where  inside_cat = $id";
            
            $query = $this->db->query($sql);
            $data  = $query->result_array();
        }
        if (sizeof($data) > 0) {
            foreach ($data as $row) {
                // echo "<option>".$spacing . $row['name']."</option>";
                $user_tree_array[] = array(
                    "id" => $row['id'],
                    "name" => $spacing . $row['name']
                );
                $user_tree_array   = $this->get_child_data($row['id'], $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $user_tree_array);
            }
        }
        
        return $user_tree_array;
    }
    
    function get_getentityRows($id)
    {
        if ($id != 0) {
            echo "select * from tbl_contact_m where contact_id = $id";
            $qry       = $this->db->query("select * from tbl_contact_m where contact_id = $id");
            $entityVal = $qry->row();
            
            $i = 0;
            
            $qryEntity = $this->db->query("select * from tbl_contact_m  where contact_id IN (" . $entityVal->mappedConsignee . ")");
            foreach ($qryEntity->result() as $fetch_protype) {
                
?>
       <tr>
            <td>
                <input  type ="hidden" class="form-control" name="entity[]" value="<?= $fetch_protype->contact_id; ?>">
                <input  type ="text" class="form-control"  value="<?= $fetch_protype->first_name; ?>">
            </td>
            <!-- <td>
                <input  type ="hidden" class="form-control" value = "<?= $entityIdimplode; ?>" name="entity_code[]">
                <input  type ="text" class="form-control" value="<?= $entityimplode; ?>">
            </td> -->
            <td>
                <i class="fa fa-trash  fa-2x" id="quotationdel" style="font-size:20px;" attrVal="<?= $fetch_protype->contact_id; ?>" aria-hidden="true"></i>
            </td>
        </tr>
    <?php
                $i++;
            }
        }
    }
    //}
    
    
    
    
    
    
    
    
    
    
    
    function get_getentityRowsItem($id)
    {
        //echo "select * from tbl_shape_part_mapping  where product_id='$id'";die;
        if ($id != 0) {
            
            $i         = 0;
            //echo "select * from tbl_shape_part_mapping  where product_id='$id'";
            $qryEntity = $this->db->query("select * from tbl_shape_part_mapping  where product_id='$id'");
            foreach ($qryEntity->result() as $fetch_protype) {
                
                $productQuery = $this->db->query("select *from tbl_product_stock where Product_id='" . $fetch_protype->part_id . "'");
                $getProduct   = $productQuery->row();
                
                
?>
       <tr>
            <td>
                <input  type ="hidden" class="form-control" name="entity[]" value="<?= $getProduct->Product_id; ?>">
                <input  type ="text" class="form-control"  value="<?= $getProduct->sku_no; ?>">
            </td>
            <!-- <td>
                <input  type ="hidden" class="form-control" value = "<?= $entityIdimplode; ?>" name="entity_code[]">
                <input  type ="text" class="form-control" value="<?= $entityimplode; ?>">
            </td> -->
            <td>
                <i class="fa fa-trash  fa-2x" id="quotationdel" style="font-size:20px;" attrVal="<?= $fetch_protype->contact_id; ?>" aria-hidden="true"></i>
            </td>
        </tr>
    <?php
                $i++;
            }
        }
    }
    //}
    
    
    
    
    
    function get_getentityRowsItemPart($id)
    {
        //echo "select * from tbl_shape_part_mapping  where product_id='$id'";die;
        if ($id != 0) {
            
            $i         = 0;
            //echo "select * from tbl_shape_part_mapping  where product_id='$id'";
            $qryEntity = $this->db->query("select * from tbl_part_price_mapping  where part_id='$id'");
            foreach ($qryEntity->result() as $fetch_protype) {
                
                $productQuery = $this->db->query("select *from tbl_product_stock where Product_id='" . $fetch_protype->rowmatial . "'");
                $getProduct   = $productQuery->row();
                
                
                $productUnitQuery = $this->db->query("select *from tbl_master_data where serial_number='" . $fetch_protype->unit . "'");
                $getUnitProduct   = $productUnitQuery->row();
                
                
?>


    <tr>
        
        <td><input type ="hidden" name="prodcId[]" value="<?= $getProduct->Product_id; ?>"><?= $getProduct->sku_no; ?></td>

        <td><input type ="hidden" name="uom[]" value="<?= $getUnitProduct->serial_number; ?>"><?= $getUnitProduct->keyvalue; ?></td>

        <td><input type ="hidden" name="mproPrice[]" value="<?= $fetch_protype->qty; ?>"><?= $fetch_protype->qty; ?></td>

        <td><input type ="hidden" name="EPrice[]" value="<?= $fetch_protype->EPrice; ?>"><?= $fetch_protype->EPrice; ?></td>

        <td id="partId"><i class="fa fa-trash  fa-2x" mproductid="<?= $getProduct->Product_id; ?>" mproductname="<?= $getProduct->sku_no; ?>" id="quotationdel" aria-hidden="true"></i></td>

    </tr>
       
    <?php
                $i++;
            }
        }
    }
    //}
    
    
    
    
    
    
    
    function get_getentityRowsItemShape($id)
    {
        //echo "select * from tbl_shape_part_mapping  where product_id='$id'";die;
        //echo "select *from tbl_product_stock where Product_id='".$fetch_protype->machine_name."'";
        if ($id != 0) {
            
            $i         = 0;
            //echo "select * from tbl_shape_part_mapping  where product_id='$id'";
            $qryEntity = $this->db->query("select * from tbl_machine  where code='$id'");
            foreach ($qryEntity->result() as $fetch_protype) {
                
                $productQuery = $this->db->query("select *from tbl_product_stock where Product_id='" . $fetch_protype->machine_name . "'");
                $getProduct   = $productQuery->row();
                
                
                
                
                
?>


    <tr>
        
        <td><input type ="hidden" name="entityShape[]" value="<?= $getProduct->Product_id; ?>"><?= $getProduct->sku_no; ?></td>

        

        <td><i class="fa fa-trash  fa-2x" mproductid="<?= $getProduct->Product_id; ?>" mproductname="<?= $getProduct->sku_no; ?>" id="quotationdel" aria-hidden="true"></i></td>

    </tr>
       
    <?php
                $i++;
            }
        }
    }
    //}
    
    
    
    
    
    
    
    function get_tblmappingData($id)
    {
        $query     = $this->db->query("select * from tbl_product_mapping M,tbl_product_stock S where S.Product_id = M.product_id AND M.contact_id = $id");
        $resultHdr = $query->result_array();
        // $arr = "";
        if (sizeof($resultHdr) > 0) {
            //  echo "<pre>";
            // print_r($resultHdr);
            // echo "</pre>";
            return $resultHdr;
        }
        return "";
    }
    
    function mod_productList($val)
    {
        $qry = $this->db->query("select C.* from tbl_product_stock C  where  C.productname like '%$val%' group by C.Product_id")->result_array();
        return $qry;
    }
    
    
    function getsparemapedQty($partid, $machineid)
    {
        // echo "select * from tbl_part_price_mapping where part_id= $partid AND machine_id= $machineid";
        $qry = $this->db->query("select * from tbl_part_price_mapping where part_id= $partid AND machine_id= $machineid")->result_array();
        return $qry;
        // return "";
    }
    
    
    
    
    
    
    //===========================================Unit Conversion============================
    
    function unit_get($last, $strat)
    {
        
        
        
        
        //echo "select *from tbl_product_stock where status='A' and type='$p_type'  order by Product_id desc limit $strt,$last";
        $query = $this->db->query("select *from tbl_unit_conversion where status='A'  order by id desc limit $strat,$last");
        return $result = $query->result();
    }
    
    function filterUnitList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_unit_conversion where status = 'A' ";
        
        if (sizeof($get) > 0) {
            
            
            
            
            
            
            if ($get['main_unit'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['main_unit'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND unit_name ='$sr_no'";
            }
            
            if ($get['sub_unit'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['sub_unit'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND unit_conversion_name ='$sr_no'";
            }
            
            
            if ($get['con_fact'] != "")
                $qry .= " AND unit_conversion_value LIKE '%" . $get['con_fact'] . "%'";
            
            
            
            
            
        }
        
        $qry .= " LIMIT $pages,$perpage";
        
        $data = $this->db->query($qry)->result();
        
        return $data;
        
    }
    
    
    function count_unit($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        if (sizeof($get) > 0) {
            if ($get['main_unit'] != "") {
                $unitQuery = $this->db->query("select * from tbl_master_data where keyvalue LIKE '%" . $get['main_unit'] . "%'");
                $getUnit   = $unitQuery->row();
                $sr_no     = $getUnit->serial_number;
                $qry .= " AND unit_name ='$sr_no'";
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
    
    
    
    
    
    
    
    
}

?>