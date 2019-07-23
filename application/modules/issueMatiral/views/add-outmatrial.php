<link href="<?=base_url();?>assets/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/select2/css/select2.css" rel="stylesheet">
<?php
  $this->load->view("header.php");
  ?>
<form action="insertInboundOrder" method="post">
  <!-- Main content -->
  <div class="main-content">
  <div class="panel panel-default">
  <!-- Breadcrumb -->
  <ol class="breadcrumb breadcrumb-2">
    <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
    <li><a href="#">Store</a></li>
    <li class="active"><strong>Issue Matrial</strong></li>
    <div class="pull-right">
      <!-- <a href="<?=base_url('inbound/manage_inbound');?>" class="btn btn-sm"><i class="fa fa-list" aria-hidden="true"></i>Manage Material</a> -->
      <!--  <button type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button> -->
    </div>
  </ol>
  <div class="row">
    <div class="col-lg-12" id="listingData">
      <!--<div class="panel-heading clearfix">
        <h4 class="panel-title">Add GRN</h4>
        <ul class="panel-tool-options"> 
        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
        <li><a data-rel="reload"><i class="icon-arrows-ccw"></i></a></li>
        <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> 
        </ul> 
        </div>
        -->
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label for="contact_name">Production Contact:</label>
                    <select name="contact" required  id="contact"  class="select2 form-control" onchange="getPoItem(this.value);">
                      <option value="" selected disabled> --Select-- </option>
                      <?php
                        $contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='5'");
                        foreach($contQuery->result() as $contRow)
                        {
                        ?>
                      <option value="<?php echo $contRow->contact_id; ?>">
                        <?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-4" id="po_order1" >
                    <label for="po_order">Production No:</label>
                    <select name="po_order" required  class="select2 form-control" onchange="getPO();" >
                      <!---->
                      <option value="">---select---</option>
                      <!-- <?php
                        $contQuery=$this->db->query("select * from tbl_quotation_purchase_order_hdr where status='A'");
                        foreach($contQuery->result() as $contRow)
                        {
                        ?>
                        <option value="<?php echo $contRow->purchaseid; ?>" >
                        <?php echo $contRow->purchase_no; ?></option>
                        <?php } ?> -->
                    </select>
                  </div>
                  <!--  <div class="col-sm-4">
                    <label for="contact_name">Production Contact:</label>
                    <input type="test" name="contact_name" value="" id="contact_name" class="form-control"/>  
                    </div>
                    -->
                  <div class="col-sm-6" id="grnId" style="display:none">
                    <label for="po_order">GRN Date.:</label>
                    <input type="date" name="grn_date" class="form-control" required  />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="table-responsive-">
          </div> -->
        <div id="getproductiondata">
        </div>
      </div>
      <input type="hidden" name="rows" id="rows">
      <!--//////////ADDING TEST/////////-->
      <input type="hidden" name="spid" id="spid" value="d1"/>
      <input type="hidden" name="ef" id="ef" value="0" />
      <div class ="pull-right" id="saveDiv" style="display:none">
        <input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
        &nbsp;<a href="<?=base_url();?>inbound/manage_inbound" class="btn btn-sm btn-black btn-outline">Cancel</a>
        <br>
        <br>
      </div>
    </div>
  </div>
</form>
<!-- /.modal-dialog -->
<script>
  function getPO()
  {
    
  	var po_order=document.getElementById("po_order").value;
  	//	alert(po_order);
  	if(po_order == "")
  		return false;
  
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "getpo?po_order="+po_order, false);
  	xhttp.send();
  	document.getElementById("getproductiondata").innerHTML = xhttp.responseText;
  }
  
  function getPoItem(value)
  {
  	//var loc=document.getElementById("loc").value;
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("GET", "getPoItem?id="+value, false);
  	// document.getElementById('invoiceId').style.display = "";
  	// document.getElementById('grnId').style.display = "";
  	// document.getElementById('itemDiv').style.display = "";
  	// document.getElementById('saveDiv').style.display = "";
         xhttp.send();
         document.getElementById("po_order1").innerHTML = xhttp.responseText ;
        // alert(xhttp.responseText);
  	//document.getElementById("po_order").appendChild();
  	//$("#po_order").empty().append(xhttp.responseText);
  
  }
  
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
          v.type="submit";
  	}
  }
  
  function qtyValidation(v)
  {
  document.getElementById('saveDiv').style.display = "block";
  var zz      = document.getElementById(v).id;
  var myarra  = zz.split("rec_qty");
  var asx     = myarra[1];
  var rec_qty = document.getElementById("rec_qty"+asx).value;
  var rem_qty = document.getElementById("rem_qty"+asx).value;
  var validationCheck = document.getElementById("validationCheck").value;
  document.getElementById("validationCheck").value = rec_qty;
  
   if(rec_qty)
    {
       if(Number(rec_qty)==0)
  	{
  		alert("Qty must be grater than 0");
  		document.getElementById("sv1").disabled = true;
          return false;
  	}
  }
  
  if(Number(rem_qty)<Number(rec_qty))
  {
  	alert("Enter Qty must be less then REQUIRED QTY");
  	document.getElementById("sv1").disabled = true;
  	document.getElementById("rec_qty"+asx).value = "";
  	
  	
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
<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/form-advanced-script.js"></script>