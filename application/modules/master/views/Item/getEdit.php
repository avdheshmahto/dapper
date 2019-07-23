<div class="modal-body overflow">
  <div class="form-group">
    <label class="col-sm-2 control-label"> *Product Type: </label> 
    <div class="col-sm-4">
      <select name="type"  class="form-control" id="type" onchange="getCat(this.value);">
        <option value="">----Select ----</option>
        <?php 
          $sqlprotype=$this->db->query("select * from tbl_master_data where param_id=17");
          foreach ($sqlprotype->result() as $fetch_protype){
          ?>
        <option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
        <?php } ?>
      </select>
    </div>
    <label class="col-sm-2 control-label"> *Category: </label> 
    <div class="col-sm-4">
      <select name="category"  class="form-control" onchange="changing(this.value)" id="category">
        <option value="">----Select ----</option>
        <?php 
          $sqlgroup=$this->db->query("select * from tbl_category where status = 1 ");
          foreach ($sqlgroup->result() as $fetchgroup){						
          ?>					
        <option value="<?php echo $fetchgroup->id; ?>"<?php if($fetchgroup->id==$fetch_list->category){?>selected<?php }?>><?php echo $fetchgroup->name ; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" > Sub Category: </label> 
    <div class="col-sm-4">
      <div id="subcategory1">
        <select name="subcategory" class="form-control" id="subcategory">
          <option value=""> ----Select---- </option>
          <?php 
            //	$sqlgroup11=$this->db->query("select * from tbl_prodcatg_m where status='B'");
            //	foreach ($sqlgroup11->result() as $fetchgroup11){						
            ?>					
          <option value="<?php //echo $fetchgroup11->product_Catid; ?>"><?php //echo $fetchgroup11->categoryName ; ?></option>
          <?php //} ?>
        </select>
      </div>
    </div>
    <label class="col-sm-2 control-label">*Product Code:</label> 
    <div class="col-sm-4"> 
      <input type="hidden" class="hiddenField" id="Product_id"   name="Product_id" value="" />
      <input type="text" class="form-control" name="sku_no" value=""  id="sku_no"> 
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label"> *Product Name: </label> 
    <div class="col-sm-4"> 
      <input name="productname"  type="text" value="" class="form-control" id="productname" > 
    </div>
    <label class="col-sm-2 control-label"> Usages Unit: </label> 
    <div class="col-sm-4">
      <select name="unit"  class="form-control" id="unit">
        <option value="" >----Select Unit----</option>
        <?php 
          $sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
          foreach ($sqlunit->result() as $fetchunit){
          
          ?>
        <option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Size:</label> 
    <div class="col-sm-4">
      <input name="size"  type="text" value="" class="form-control" id = "size"  > 
    </div>
    <label class="col-sm-2 control-label">Thickness:</label> 
    <div class="col-sm-4"> 
      <input name="thickness"  type="text" value="" class="form-control" id="thickness" > 
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Grade Code</label> 
    <div class="col-sm-4"> 
      <input type="text" name="grade_code" id="grade_code" class="form-control"/>
    </div>
    <label class="col-sm-2 control-label">Sale Price:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="number" step="any" name="unitprice_sale" value="" id="unitprice_sale" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Purchase Price:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="number" step="any" name="unitprice_purchase" value="" id="unitprice_purchase" class="form-control" >
    </div>
    <label class="col-sm-2 control-label">HSN Code:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text" step="any" name="hsn_code" value="" id="hsn_code" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">GST Tax:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="number" step="any" name="gst_tax" value="" id="gst_tax" class="form-control" >
    </div>
    <label class="col-sm-2 control-label">Weight:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text" step="any" name="weight" value="" id="weight" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Cartoon Length:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="ctn_lenght" value="" id="ctn_lenght" class="form-control" >
    </div>
    <label class="col-sm-2 control-label">Cartoon Width:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="ctn_width" value="" id="ctn_width" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Cartoon Height:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="ctn_height" value="" id="ctn_height" class="form-control" >
    </div>
    <label class="col-sm-2 control-label">MST:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="mst" value="" id="mst" class="form-control" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">CBM:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="cbm" value="" id="cbm" class="form-control" >
    </div>
    <label class="col-sm-2 control-label">Lead Time:</label> 
    <div class="col-sm-4" id="regid"> 
      <input type="text"  name="lead_time" value="" id="lead_time" class="form-control" >
    </div>
  </div>
</div>