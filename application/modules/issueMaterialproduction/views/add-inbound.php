<?php
  $this->load->view("header.php");
  ?>
<!-- Main content -->
<div class="main-content">
  <div class="panel panel-default">
    <!-- Breadcrumb -->
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Challan Order</a></li>
      <li class="active"><strong>Add Challan</strong></li>
      <div class="pull-right">
        <a href="<?=base_url('issueMaterialproduction/inbound/manage_inbound');?>" class="btn btn-sm"><i class="fa fa-list" aria-hidden="true"></i>Manage Challan</a>
      </div>
    </ol>
    <form action="<?=base_url();?>issueMaterialproduction/inbound/insertInboundOrder" method="post">
      <div class="row">
        <div class="col-lg-12" id="listingData">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label for="po_order">Production Number:</label>
                        <select name="po_order" required id="po_order"  class="form-control" onchange="getPO();">
                          <option value="">---select---</option>
                          <?php
                            $contQuery=$this->db->query("select *from tbl_quotation_purchase_order_hdr where status = 'A'");
                            foreach($contQuery->result() as $contRow)
                            {
                            ?>
                          <option value="<?php echo $contRow->purchaseid; ?>" >
                            <?php echo $contRow->purchase_no; ?>
                          </option>
                          <?php } ?>
                        </select>
                      </div>
                      <!-- <div class="col-sm-6">
                        <label for="po_order">PURCHASE ORDER NO.:</label>
                        <select name="po_no"  class="form-control" id="loc" onchange="getPoItem();"  required>
                        <option value="">----Select ----</option>
                        <?php
                          $queryPo=$this->db->query("select *from tbl_quotation_purchase_order_hdr where status = 'A'");
                          foreach($queryPo->result() as $getPO){
                              echo '<option value='.$getPO->purchaseid.'>'.$getPO->purchase_no.'</option>';
                          }
                          ?>
                        </select>
                        
                        </div> -->
                      <!-- 
                        <div class="col-sm-6" id="invoiceId" style="display:none">
                        <label for="po_order">GRN No.:</label>
                        <input type="text" name="grn_no"  class="form-control" required />
                        
                        </div>-->
                      <div class="col-sm-6" >
                        <label for="po_order"> Date.:</label>
                        <input type="date" name="grn_date" class="form-control" required  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="table-responsive-">
              </div> -->
            <div class="" id="style-3-y">
              <div class="force-overflow-y">
                <div class="table-responsive" id="getproductiondata">
                </div>
              </div>
            </div>
            <!--scrollbar-y close-->		
          </div>
        </div>
      </div>
      <div class ="pull-right" id="saveDiv" >
        <input class="btn btn-sm btn-black btn-outline" type="submit" value="SAVE"   id="sv1" onclick="fsv(this)" >
        &nbsp;<a href="<?=base_url();?>issueMaterialproduction/inbound/manage_inbound" class="btn btn-sm btn-black btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>
<!-- /.modal-dialog -->
<script>
  function getPO()
  {
      var po_order=document.getElementById("po_order").value;
  	if(po_order == "")
  		return false;
  
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "getpo?po_order="+po_order, false);
  	xhttp.send();
  	console.log(xhttp.responseText);
  	document.getElementById("getproductiondata").innerHTML = xhttp.responseText;
  }
  
  // function getPoItem()
  // {
  
  // var loc=document.getElementById("loc").value;
  
  
  // var xhttp = new XMLHttpRequest();
  // xhttp.open("GET", "getPoItem?poId="+loc, false);
  // document.getElementById('invoiceId').style.display = "";
  // document.getElementById('grnId').style.display = "";
  // document.getElementById('itemDiv').style.display = "";
  // document.getElementById('saveDiv').style.display = "";
  // xhttp.send();
  
  
  // document.getElementById("itemDiv").innerHTML = xhttp.responseText;
  // }
  
  function fsv(v)
  {
  
  	var validationCheck=document.getElementById("validationCheck").value;
  	if(Number(validationCheck)=='0')
  	{
  		alert("Please Eneter qty");
  		document.getElementById("sv1").disabled = true;
  		return false;
  	}
  	else
  	{
  		//alert('sdsd');
       v.type="submit";
  	}
  }
  
  function qtyValidation(v)
  {
  	document.getElementById('saveDiv').style.display = "block";
  	var zz=document.getElementById(v).id;
  	
  	var myarra = zz.split("rec_qty");
  	var asx= myarra[1];
  	var rec_qty=document.getElementById("rec_qty"+asx).value;
  	var instock=document.getElementById("instock"+asx).value;
  	var rem_qty=document.getElementById("rem_qty"+asx).value;
  	var validationCheck=document.getElementById("validationCheck").value;
  	document.getElementById("validationCheck").value=rec_qty;
  
  	// if(Number(instock)<Number(rec_qty))
  	// {
  	// 	alert("Enter Qty must be less then In Stock Qty");
  	// 	document.getElementById("sv1").disabled = true;
  	// 	document.getElementById("rec_qty"+asx).value ="";
  	// 	return false;
  	// }
  
  
   if(rec_qty)
    {
    if(Number(rec_qty)==0)
  	{
  		alert("Qty must be grater than 0");
  		document.getElementById("sv1").disabled = true;
  		document.getElementById("rec_qty"+asx).value ="";
  		return false;
  	}
    }
  
    if(Number(rem_qty)<Number(rec_qty))
  	{
  		alert("Enter Qty must be less then enter qty");
  		document.getElementById("sv1").disabled = true;
  		document.getElementById("rec_qty"+asx).value ="";
  	}
  	else
  	{
  		document.getElementById("sv1").disabled = false;
  	}
  }
  
</script>	
<?php
  $this->load->view("footer.php");
  ?>