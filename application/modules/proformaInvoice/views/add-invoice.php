<?php
  $this->load->view("header.php");
  $tableName='tbl_contact_m';
  $location='manage_contact';
  
  
  ?>
<form id="f1" name="f1" method="POST" action="insertInvoice" onSubmit="return checkKeyPressed(a)" enctype="multipart/form-data">
  <!-- Main content -->
  <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=42epwf1jarbwose89sqt3dztyfu7961g4cs5xoib4kordvbd"></script>
  <script>tinymce.init({ selector:'#tem' });</script>
  <div class="main-content">
  <ol class="breadcrumb breadcrumb-2">
    <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
    <li><a href="#">Proforma Invoice</a></li>
    <li class="active"><strong><a href="#">Manage Proforma Invoice</a></strong></li>
    <div class="pull-right">
      <a class="btn btn-sm" href="<?=base_url();?>proformaInvoice/manage_invoice">Manage Proforma Invoice</a>
    </div>
  </ol>
  <div class="row">
    <div class="col-lg-12">
      <div class="heading">
        <h4 class="panel-title"><strong>Add Proforma Invoice</strong></h4>
        <div class="panel-body">
          <div class="table-responsive-">
            <table class="table table-striped table-bordered table-hover" >
              <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>
                    <div class="field">
                      <select name="contactid" id="vendor_id" required  class="form-control" style="
                        width: 100%;" onChange="document.getElementsByName('contactid')[0].value=this.value;"   <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
                        <option value="" selected disabled>Select</option>
                        <?php
                          $contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='4'");
                          foreach($contQuery->result() as $contRow)
                          {
                          ?>
                        <option value="<?php echo $contRow->contact_id; ?>">
                          <?php echo $contRow->first_name; ?>
                        </option>
                        <?php } ?>
                      </select>
                      <select style="display:none" name="invoice_type" class="form-control"  required id="invoice_type"   <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
                        <option value="No-Tax">	No-Tax	</option>
                        <option value="GST" selected="selected">GST	</option>
                      </select>
                    </div>
                  </th>
                  <th>Proforma No.</th>
                  <th>
                    <input type="text"  class="form-control" required name="proforma_no" value="<?php echo $detail->proforma_no;?>" />
                  </th>
                  <th>Proforma Date</th>
                  <th>
                    <input type="date"  class="form-control" min="0" name="proforma_date" value="<?php echo $detail->proforma_date;?>" />
                  </th>
                </tr>
                <tr>
                  <td>Buyer Order</td>
                  <th>
                    <input type="text"  class="form-control"  name="buyer_order" value="<?php echo $detail->buyer_order;?>" />
                  </th>
                  <td>Date</td>
                  <th>
                    <input type="date"  class="form-control"  name="buyer_date" value="<?php echo $detail->buyer_date;?>" />
                  </th>
                  <td>Ship Date</td>
                  <th>
                    <input type="date"  class="form-control"  name="ship_date" value="<?php echo $detail->ship_date;?>" />
                  </th>
                </tr>
                <tr>
                  <td>Payment Term</td>
                  <th>
                    <input type="text"  class="form-control"  name="payment_term" value="<?php echo $detail->payment_term;?>" />
                  </th>
                  <td>Delivery Term</td>
                  <th>
                    <input type="text"  class="form-control"  name="dilivery_term" value="<?php echo $detail->dilivery_term;?>" />
                  </th>
                  <td>Port Of loading</td>
                  <th>
                    <select name="port_loading" class="form-control">
                      <option value="">--Select--</option>
                      <?php
                        $portOfLoading=$this->db->query("select *from tbl_master_data where param_id='21'");
                        foreach($portOfLoading->result() as $getPortOfLoading){
                        ?>
                      <option value="<?=$getPortOfLoading->serial_number;?>"><?=$getPortOfLoading->keyvalue;?></option>
                      <?php
                        }
                        ?>
                    </select>
                  </th>
                </tr>
                <tr>
                  <td>Port Of Discharge</td>
                  <th>
                    <select name="port_of_discharge" class="form-control">
                      <option value="">--Select--</option>
                      <?php
                        $portOfDischarge=$this->db->query("select *from tbl_master_data where param_id='22'");
                        foreach($portOfDischarge->result() as $getportOfDischarge){
                        ?>
                      <option value="<?=$getportOfDischarge->serial_number;?>"><?=$getportOfDischarge->keyvalue;?></option>
                      <?php
                        }
                        ?>
                    </select>
                  </th>
                  <td>Partshipment</td>
                  <th><input type="text"  class="form-control"  name="partshipment"  /></th>
                  <td>Forwarder</td>
                  <th><input type="text"  class="form-control"  name="forwarder"  /></th>
                  </th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" >
              <tbody>
                <tr class="gradeA">
                  <th>Item Code</th>
                  <th style="display:none;">Quantity In Stock</th>
                  <th>Usages Unit</th>
                  <th>Quantity</th>
                  <th>Per Crt Qty.</th>
                  <th>Total Qty.</th>
                  <th>Price US $</th>
                  <th style="display:none;">Discount%</th>
                  <th style="display:none;">Discount Amount</th>
                  <th style="display:none;">CGST</th>
                  <th style="display:none;">SGST</th>
                  <th style="display:none;">IGST</th>
                  <th style="display:none;">GST Total</th>
                  <th>Total</th>
                  <th>Net Price</th>
                </tr>
                <tr class="gradeA">
                  <th style="width:280px;">
                    <div class="input-group">
                      <div style="width:100%; height:28px;" >
                        <input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:280px; font-size:11px;"  placeholder=" Search Items..." tabindex="5" >
                        <input type="hidden"  name="pri_id[]" id='pri_id'  value="" style="width:80px;"  />
                        <img  style="display:none" src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)" />
                      </div>
                    </div>
                    <div id="prdsrch" style="color:black;padding-left:0px; width:280px; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
                      <?php
                        //include("getproduct.php");
                        $this->load->view('getproduct');
                        
                        ?>
                    </div>
                  </th>
                  <th style="display:none;">
                    <input type="hidden" readonly="" id="reorder" style="width:70px;" class="form-control"> 
                    <input type="text" readonly="" id="qty_stock" style="width:70px;" class="form-control"> 
                  </th>
                  <th>
                    <input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
                  </th>
                  <th><input type="number" id="qn" min="1" style="width:70px;"   class="form-control"></th>
                  <th><input type="number" id="per_crt_qn" min="1" style="width:70px;" readonly="readonly"   class="form-control"></th>
                  <th><input type="number" id="total_qty" min="1" style="width:70px;" readonly="readonly"   class="form-control"></th>
                  <th>
                    <b style="display:none" id="lpr"></b>
                    <input type="number" step="any" id="lph" min="1"  value="" class="form-control" style="width:112px;">
                  </th>
                  <th style="display:none;"><input type="number" step="any" name="saleamnt" id="discount" class="form-control" style="width:70px;"/ ></th>
                  <th style="display:none;"><input type="number" step="any" name="saleamnt" id="disAmt" class="form-control"  style="width:70px;"/ ></th>
                  <th style="display:none;"><input type="number" min="1" step="any" name="saleamnt" id="cgst" class="form-control"  style="width:70px;"/ ></th>
                  <th style="display:none;"><input type="number" min="1" step="any" name="saleamnt" id="sgst" class="form-control"   style="width:70px;"/ ></th>
                  <th style="display:none;"><input type="number" step="any" name="saleamnt" id="igst" class="form-control"  style="width:70px;"/ ></th>
                  <th style="display:none;"><input type="number" step="any" name="saleamnt" id="gstTotal" class="form-control"   style="width:70px;"/ ></th>
                  <th><input type="text" name="saleamnt" readonly="" id="tot" class="form-control" style="width:70px;"/ ></th>
                  <th><input type="text" name="saleamnt" readonly="" id="nettot" class="form-control"  style="width:70px;"/ ></th>
                </tr>
              </tbody>
            </table>
          </div>
          <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
            <table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
              <tr>
                <td style="width:1%;">
                  <div align="center"><u>Sl No</u>.</div>
                </td>
                <td style="width:11%;">
                  <div align="center"><u>Item</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Quantity</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Per Crt Qty.</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Total Qty.</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Price US $</u></div>
                </td>
                <td style="width:3%; display:none;">
                  <div align="center"><u>Discount</u></div>
                </td>
                <td style="width:3%; display:none;">
                  <div align="center"><u>Discount Amount</u></div>
                </td>
                <td style="width:3%;  display:none;">
                  <div align="center"><u>CGST</u></div>
                </td>
                <td style="width:3%;  display:none;">
                  <div align="center"><u>SGST</u></div>
                </td>
                <td style="width:3%;  display:none;">
                  <div align="center"><u>IGST</u></div>
                </td>
                <td style="width:3%;  display:none;">
                  <div align="center"><u>GST TOTAL</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Total</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Net Price</u></div>
                </td>
                <td style="width:3%;">
                  <div align="center"><u>Action</u></div>
                </td>
              </tr>
            </table>
            <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
              <table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >
                <tr></tr>
              </table>
            </div>
          </div>
          <input type="hidden" name="rows" id="rows">
          <!--//////////ADDING TEST/////////-->
          <input type="hidden" name="spid" id="spid" value="d1"/>
          <input type="hidden" name="ef" id="ef" value="0" />
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" >
              <tbody>
                <tr class="gradeA">
                  <th>Sub Total</th>
                  <th>&nbsp;</th>
                  <th>
                    <input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
                  </th>
                </tr>
                <tr class="gradeA" style="display:none">
                  <th>Service Charge</th>
                  <th><input  type="number" step="any" min="1" id="service_charge" onkeyup="serviceChargeCal();" name="service_charge_per" placeholder="0%" class="form-control"></th>
                  <th><input type="text" readonly="" id="service_charge_total" name="service_charge_total" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr style="display:none" class="gradeA">
                  <th>Gross Discount</th>
                  <th><input type="number" name="gross_discount_per" onkeyup="grossDiscountCal()" id="gross_discount_per" step="any" min="1" placeholder="%" class="form-control"></th>
                  <th><input type="number" readonly="" name="gross_discount_total" id="gross_discount_total" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr  class="gradeA" style="display:none">
                  <th>CGST TAX</th>
                  <th><input style="display:none;" type="number" name="total_cgst"  id="total_cgst" step="any" min="1" placeholder="%" class="form-control"></th>
                  <th><input type="number" readonly="" name="total_tax_cgst_amt" id="total_tax_cgst_amt" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr  class="gradeA" style="display:none">
                  <th>SGST TAX</th>
                  <th><input style="display:none;" type="number" name="total_sgst"  id="total_sgst" step="any" min="1" placeholder="%" class="form-control"></th>
                  <th><input type="number" readonly="" name="total_tax_sgst_amt" id="total_tax_sgst_amt" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr  class="gradeA" style="display:none">
                  <th>IGST TAX</th>
                  <th><input style="display:none;" type="number" name="total_igst"  id="total_igst" step="any" min="1" placeholder="%" class="form-control"></th>
                  <th><input type="number" readonly="" name="total_tax_igst_amt" id="total_tax_igst_amt" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr  class="gradeA" style="display:none">
                  <th>Total GST TAX</th>
                  <th>&nbsp;</th>
                  <th><input type="number" readonly="" name="total_gst_tax_amt" id="total_gst_tax_amt" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr  class="gradeA" style="display:none">
                  <th>Total Discount</th>
                  <th><input style="display:none;" type="number" name="total_dis"  id="total_dis" step="any" min="0" placeholder="%" class="form-control"></th>
                  <th><input type="number" readonly="" name="total_dis_amt" id="total_dis_amt" step="any" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr class="gradeA">
                  <th>Grand Total</th>
                  <th>&nbsp;</th>
                  <th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
                </tr>
                <tr class="gradeA">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
                <tr class="gradeA">
                  <th>
                  <th>&nbsp;</th>
                  <th>
                    <input class="btn btn-sm" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
                    &nbsp;<a href="<?=base_url();?>proformaInvoice/manage_invoice" class="btn btn-secondary btn-sm">Cancel</a>
                  </th>
                  </th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    //add item into showling list
    window.addEventListener("keydown", checkKeyPressed, false);
    //funtion to select product
    function checkKeyPressed(e) {
    var s=e.keyCode;
    
    var ppp=document.getElementById("prd").value;
    var sspp=document.getElementById("spid").value;//
    var ef=document.getElementById("ef").value;
    		ef=Number(ef);
    		
    var countids=document.getElementById("countid").value;
    
    //if(countids==''){
    //countids=1;
    //}
    
    for(n=1;n<=countids;n++)
    {
    
    
    document.getElementById("tyd"+n).onkeyup  = function (e) {
    var entr =(e.keyCode);
    if(entr==13){
    document.getElementById("qn").focus();
    document.getElementById("prdsrch").innerHTML=" ";
    
    }
    }
    }
    
    document.getElementById("qn").onkeyup = function (e) {
    var entr =(e.keyCode);
    if(entr==13){
    
    var per_crt_qn =document.getElementById("per_crt_qn").value;
    var qty =document.getElementById("qn").value;
    
    var totalQty=Number(per_crt_qn)*Number(qty);
    document.getElementById("total_qty").value=totalQty;
    
    document.getElementById("lph").focus();
    }
    }
    
    
    
    
    
    
    document.getElementById("lph").onkeyup = function (e) {
    var entr =(e.keyCode);
    var rate=document.getElementById("lph").value;
    var qnt=document.getElementById("total_qty").value;
    
    var total=(Number(rate)*Number(qnt));
    
    document.getElementById("tot").value=total;
    document.getElementById("nettot").value=total;
    if(document.getElementById("lph").value=="" && entr==08){
    
    }
       if (e.keyCode == "13")
    	 {
    	
    	 e.preventDefault();
         e.stopPropagation();
    	
    	  if(ppp!=='' || ef==1)
    	 {
    
    	
    			adda();	  	
    			
    		
    			
    		
    		var ddid=document.getElementById("spid").value;
    		var ddi=document.getElementById(ddid);
    		ddi.id="d";
    		
    			}
    	       else
    			{
    	   alert("Enter Correct Product");
    			}
    		return false;
        }
    	}
    }
    /////////////////////////////////////////////
    
    function fsv(v)
    {
    var rc=document.getElementById("rows").value;
    
    if(rc!=0)
    {
    v.type="submit";
    }
    else
    {
    	alert('No Item To Save..');	
    }
    }
    
    
    function getdata()
    		  {
    		  
    		 currentCell = 0;
    		 var product1=document.getElementById("prd").value;	 
    		 var product=product1;
    		 	
    			
    		    
    		    if(xobj)
    			 {
    			 var obj=document.getElementById("prdsrch");
    			
    			 xobj.open("GET","getproduct?con="+product,true);
    			 xobj.onreadystatechange=function()
    			  {
    			  if(xobj.readyState==4 && xobj.status==200)
    			   {
    			    obj.innerHTML=xobj.responseText;
    			   }
    			  }
    			 }
    			 xobj.send(null);
    		  }
      
    ////////////////////////////////////////////////////
    
     function slr(){
    		var table = document.getElementById('invoice');
            var rowCount = table.rows.length;
    		  for(var i=1;i<rowCount;i++)
    		  {    
                  table.rows[i].cells[0].innerHTML=i;
    		  }
    			 
    			  
    }  
    
    
    
    //////////////////////////////////////////////////////////////
    
    
    
         var rw=0;
    	 
     function adda()
    		  { 
    		 
    		  		 
    
    				var qn=document.getElementById("qn").value;
    				var per_crt_qn=document.getElementById("per_crt_qn").value;
    				var total_qty= document.getElementById("total_qty").value;
    				
    				var unit=document.getElementById("usunit").value;
    				var lph=document.getElementById("lph").value;
    				var dis=document.getElementById("discount").value;	
    				var disAmount=document.getElementById("disAmt").value;		
    		       
    			   var cgst=document.getElementById("cgst").value;		
    			   var igst=document.getElementById("igst").value;		
    			   var sgst=document.getElementById("sgst").value;		
    			   var gstTotal=document.getElementById("gstTotal").value;
    			    var qty_stock=document.getElementById("qty_stock").value;
    			   
    			    var tot=document.getElementById("tot").value;
    				var nettot=document.getElementById("nettot").value;
    			  	
    			
    				
    				//default
    				var rows=document.getElementById("rows").value;
    				var pri_id=document.getElementById("pri_id").value;
    				var pd=document.getElementById("prd").value;
    		   	   var table = document.getElementById("invoice");
    					var rid =Number(rows)+1;
    					document.getElementById("rows").value=rid;
    					
    						
    							totalSum();	
    							//serviceChargeCal();
    							//grossDiscountCal();				
                 				clear();
    				
    					 currentCell = 0;
    	if(pd!="" && qn!=0)
    					{
    				     var indexcell=0;
    								var row = table.insertRow(-1);
    						rw=rw+0;
    						
    						//cell 0st
    	 var cell=cell+indexcell;		
     	 cell = row.insertCell(0);
    	 cell.style.width=".20%";
    	 cell.align="center"
    	cell.innerHTML=rid;
    				
    				
    				//cell 1st item name
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;	
    			
    	    cell = row.insertCell(indexcell);
    				cell.style.width="11%";
    				cell.align="center";
    				
    				
    				
    				
    				//============================item text ============================
    				var prd = document.createElement("input");
    							prd.type="text";
    							prd.border ="0";
    							prd.value=pd;	
    							prd.name='pd[]';//
    							prd.id='pd'+rid;//
    							prd.readOnly = true;
    							prd.style="text-align:center";  
    							prd.style.width="100%";
    							prd.style.border="hidden"; 
    							cell.appendChild(prd);
    				var priidid = document.createElement("input");
    							priidid.type="hidden";
    							priidid.border ="0";
    							priidid.value=pri_id;	
    							priidid.name='main_id[]';//
    							priidid.id='main_id'+rid;//
    							priidid.readOnly = true;
    							priidid.style="text-align:center";  
    							priidid.style.width="100%";
    							priidid.style.border="hidden"; 
    							cell.appendChild(priidid);
    							
    							
    							var unitt = document.createElement("input");
    							unitt.type="hidden";
    							unitt.border ="0";
    							unitt.value=unit;	
    							unitt.name='unit[]';//
    							unitt.id='unit'+rid;//
    							unitt.readOnly = true;
    							unitt.style="text-align:center";  
    							unitt.style.width="100%";
    							unitt.style.border="hidden"; 
    							cell.appendChild(unitt);
    					
    						// ends here
    	
    	
    	//#################cell 2nd starts here####################//
    	
    	
    	
    	
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;
            cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.style.display="none";
    				cell.align="center"
    				var qty_stockK = document.createElement("input");
    							qty_stockK.type="text";
    							qty_stockK.border ="0";
    							qty_stockK.value=qty_stock;	    
    							qty_stockK.name ='qty_stock[]';
    							qty_stockK.id='qty_stock'+rid;
    							qty_stockK.readOnly = true;
    							qty_stockK.style="text-align:center";
    							qty_stockK.style.width="100%";
    							qty_stockK.style.border="hidden"; 
    							cell.appendChild(qty_stockK);
    	
    	//==============================close 2nd cell =========================================
    		
    		//#################cell 3rd starts here####################//					
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"
    		//========================================start qnty===================================	
    				var qtty = document.createElement("input");
    							qtty.type="text";
    							qtty.border ="0";
    							qtty.value=qn;	    
    							qtty.name ='qty[]';
    							qtty.id='qnty'+rid;
    							qtty.readOnly = true;
    							qtty.style="text-align:center";
    							qtty.style.width="100%";
    							qtty.style.border="hidden"; 
    							cell.appendChild(qtty);
    								
    		//======================================close 3rd cell========================================
    		
    		
    		
    		
    		
    		
    			
    		//#################cell 3rd starts here####################//					
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"
    		//========================================start qnty===================================	
    				var per_crt_qnY = document.createElement("input");
    							per_crt_qnY.type="text";
    							per_crt_qnY.border ="0";
    							per_crt_qnY.value=per_crt_qn;	    
    							per_crt_qnY.name ='per_crt_qn[]';
    							per_crt_qnY.id='per_crt_qn'+rid;
    							per_crt_qnY.readOnly = true;
    							per_crt_qnY.style="text-align:center";
    							per_crt_qnY.style.width="100%";
    							per_crt_qnY.style.border="hidden"; 
    							cell.appendChild(per_crt_qnY);
    								
    		//======================================close 3rd cell========================================
    		
    		
    	
    			
    		//#################cell 3rd starts here####################//					
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"
    		//========================================start qnty===================================	
    				var total_qtyY = document.createElement("input");
    							total_qtyY.type="text";
    							total_qtyY.border ="0";
    							total_qtyY.value=total_qty;	    
    							total_qtyY.name ='total_qty[]';
    							total_qtyY.id='total_qty'+rid;
    							total_qtyY.readOnly = true;
    							total_qtyY.style="text-align:center";
    							total_qtyY.style.width="100%";
    							total_qtyY.style.border="hidden"; 
    							cell.appendChild(total_qtyY);
    								
    		//======================================close 3rd cell========================================
    	
    	
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;
            cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"
    				var salepr = document.createElement("input");
    							salepr.type="text";
    							salepr.border ="0";
    							salepr.value=lph;	    
    							salepr.name ='list_price[]';
    							salepr.id='lph'+rid;
    							salepr.readOnly = true;
    							salepr.style="text-align:center";
    							salepr.style.width="100%";
    							salepr.style.border="hidden"; 
    							cell.appendChild(salepr);
    					
    
    	
    	
    	
    	
    	
    		
    		
    		
    		
    		
    		
    		
    		
    		//===================================start 4th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";	
    				cell.style.display="none";
    												
    				var discount = document.createElement("input");
    							discount.type="text";
    							discount.border ="0";
    							discount.value=dis;	
    							discount.name ='discount[]';
    							discount.id='dis'+rid;
    							discount.readOnly = true;
    							discount.style="text-align:center";
    							discount.style.width="100%";
    							discount.style.border="hidden"; 
    							cell.appendChild(discount);
    		//===============================close 4th cell=================================
    
    		
    
    //===================================start 5th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				cell.style.display="none";
    												
    				var disAmtt = document.createElement("input");
    							disAmtt.type="text";
    							disAmtt.border ="0";
    							disAmtt.value=disAmount;	
    							disAmtt.name ='disAmount[]';
    							disAmtt.id='disAmount'+rid;
    							disAmtt.readOnly = true;
    							disAmtt.style="text-align:center";
    							disAmtt.style.width="100%";
    							disAmtt.style.border="hidden"; 
    							cell.appendChild(disAmtt);
    		//===============================close 5th cell=================================
    		
    		
    
    
    
    
    
    
    
    //===================================start 5th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				cell.style.display="none";	
    				
    												
    				var cgstt = document.createElement("input");
    							cgstt.type="text";
    							cgstt.border ="0";
    							cgstt.value=cgst;	
    							cgstt.name ='cgst[]';
    							cgstt.id='cgst'+rid;
    							cgstt.readOnly = true;
    							cgstt.style="text-align:center";
    							cgstt.style.width="100%";
    							cgstt.style.border="hidden"; 
    							cell.appendChild(cgstt);
    		//===============================close 5th cell=================================
    		
    
    //===================================start 5th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				cell.style.display="none";	
    				
    												
    				var sgstt = document.createElement("input");
    							sgstt.type="text";
    							sgstt.border ="0";
    							sgstt.value=sgst;	
    							sgstt.name ='sgst[]';
    							sgstt.id='sgst'+rid;
    							sgstt.readOnly = true;
    							sgstt.style="text-align:center";
    							sgstt.style.width="100%";
    							cgstt.style.border="hidden"; 
    							cell.appendChild(sgstt);
    		//===============================close 5th cell=================================
    		
    //===================================start 5th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				cell.style.display="none";	
    				
    												
    				var igstt = document.createElement("input");
    							igstt.type="text";
    							igstt.border ="0";
    							igstt.value=igst;	
    							igstt.name ='igst[]';
    							igstt.id='igst'+rid;
    							igstt.readOnly = true;
    							igstt.style="text-align:center";
    							igstt.style.width="100%";
    							igstt.style.border="hidden"; 
    							cell.appendChild(igstt);
    		//===============================close 5th cell=================================
    		
    
    
    
    		
    //===================================start 5th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				cell.style.display="none";	
    				
    												
    				var gstTotalt = document.createElement("input");
    							gstTotalt.type="text";
    							gstTotalt.border ="0";
    							gstTotalt.value=gstTotal;	
    							gstTotalt.name ='gstTotal[]';
    							gstTotalt.id='gstTotal'+rid;
    							gstTotalt.readOnly = true;
    							gstTotalt.style="text-align:center";
    							gstTotalt.style.width="100%";
    							gstTotalt.style.border="hidden"; 
    							cell.appendChild(gstTotalt);
    		//===============================close 5th cell=================================
    
    
    
    
    
    
    
    		
    		
    		
    		
    			
    	
    				
    		//===================================start 6th cell================================
    		indexcell=Number(indexcell+1);		
    		var cell=cell+indexcell;		
    	    cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"	
    				
    												
    				var vatamt = document.createElement("input");
    							vatamt.type="text";
    							vatamt.border ="0";
    							vatamt.value=tot;	
    							vatamt.name ='tot[]';
    							vatamt.id='tot'+rid;
    							vatamt.readOnly = true;
    							vatamt.style="text-align:center";
    							vatamt.style.width="100%";
    							vatamt.style.border="hidden"; 
    							cell.appendChild(vatamt);
    		//===============================close 5th cell=================================
    					
    									
    		//============================================start 7th cell================================	
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;	
    	   cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center"
    			
    				var netprice = document.createElement("input");
    							netprice.type="text";
    							netprice.border ="0";
    							netprice.value=nettot;	    
    							netprice.name ='nettot[]';
    							netprice.id='nettot'+rid;
    							netprice.readOnly = true;
    							netprice.style="text-align:center";
    							netprice.style.width="100%";
    							netprice.style.align="center";
    							netprice.style.border="hidden"; 
    							cell.appendChild(netprice);							
    											
    		//======================================close net price====================================							
    		//cell 3st
    	indexcell=Number(indexcell+1);		
    	var cell=cell+indexcell;
    	var imageloc="/mr_bajaj/";
    	var cell = row.insertCell(indexcell);
    				cell.style.width="3%";
    				cell.align="center";
    				var delt =document.createElement("img");
    						delt.src ="<?=base_url();?>assets/images/delete.png";
    						delt.class ="icon";
    						delt.border ="0";
    						//delt.style.width="30%";
    						//delt.style.height="20%";
    						delt.name ='dlt';
    						delt.id='dlt'+rid;
    						delt.style.border="hidden"; 
    						delt.onclick= function() { deleteselectrow(delt.id,delt); };
    					    cell.appendChild(delt);
    	var edt = document.createElement("img");
    						edt.src ="<?=base_url();?>/assets/images/edit.png";
    						edt.class ="icon";
    						//edt.style.width="60%";
    						//edt.style.height="40%";
    						edt.border ="0";
    						edt.name ='ed';
    						edt.id='ed'+rid;
    						edt.style.border="hidden"; 
    						edt.onclick= function() { editselectrow(delt.id,edt); };
    						cell.appendChild(edt);
    			
    
    			
    			}
    			else
    			{
    			if(qn==0)
    				{
    					alert('***Quantity Can not be Zero ***');
    					
    					
    				}
    				else
    				{
    				
    			alert('***Please Select PRODUCT ***');
    			
    			}
    			}
    
    function clear()
    {
    
    // this finction is use for clear data after adding invoice
    		document.getElementById("prd").value='';
    		document.getElementById("usunit").value='';
    		document.getElementById("lph").value='';
    		document.getElementById("per_crt_qn").value='';
    		document.getElementById("total_qty").value='';
    		document.getElementById("lpr").innerHTML ='';
    		document.getElementById("discount").value='';
    		document.getElementById("disAmt").value='';
    		document.getElementById("tot").value='';
    		document.getElementById("nettot").value='';
    		document.getElementById("qn").value='';
    		document.getElementById("pri_id").value='';
    		
    		document.getElementById("igst").value='';
    		document.getElementById("cgst").value='';
    		document.getElementById("sgst").value='';
    		document.getElementById("gstTotal").value='';
    		document.getElementById("qty_stock").value='';
    		
    		
    		document.getElementById("prd").focus();	
    		
    		
    }
    
    
    
    
    
    
    ////////////////////////////////// starts edit code ////////////////////////////////
    
    
    function editselectrow(d,r) //modify dyanamicly created rows or product detail
     {
     
    var regex = /(\d+)/g;
    nn= d.match(regex)
    id=nn;
    if(document.getElementById("prd").value!=''){
    document.getElementById("qn").focus();
    alert("Product already in edit Mode");
    return false;
    }
    
    
    // ####### starts ##############//
    var pd=document.getElementById("pd"+id).value;
    
    		var unit=document.getElementById("unit"+id).value;
    		var qn=document.getElementById("qnty"+id).value;
    		var per_crt_qn=document.getElementById("per_crt_qn"+id).value;
    		var total_qty=document.getElementById("total_qty"+id).value;
    		var lph=document.getElementById("lph"+id).value;
    		var discount=document.getElementById("dis"+id).value;
    		var disAmt=document.getElementById("disAmount"+id).value;
    		var tot=document.getElementById("tot"+id).value;
    		var nettot=document.getElementById("nettot"+id).value;
    		var igst=document.getElementById("igst"+id).value;
    		var cgst=document.getElementById("cgst"+id).value;
    		var sgst=document.getElementById("sgst"+id).value;
    		var gstTotal=document.getElementById("gstTotal"+id).value;
    		var qty_stock=document.getElementById("qty_stock"+id).value;
    		
    		var pri_id=document.getElementById("main_id"+id).value;
    // ####### ends ##############//
    
    // ####### starts ##############//
    document.getElementById("pri_id").value=pri_id;
    document.getElementById("qn").focus();
    document.getElementById("prd").value=pd;
    document.getElementById("usunit").value=unit;
    document.getElementById("qn").value=qn;
    document.getElementById("per_crt_qn").value=per_crt_qn;
    document.getElementById("total_qty").value=total_qty;
    document.getElementById("lpr").innerHTML=lph;
    document.getElementById("lph").value=lph;
    document.getElementById("discount").value=discount;
    document.getElementById("disAmt").value=disAmt;
    document.getElementById("tot").value=tot;
    document.getElementById("nettot").value=nettot;
    
    document.getElementById("igst").value=igst;
    document.getElementById("cgst").value=cgst;
    document.getElementById("sgst").value=sgst;
    document.getElementById("gstTotal").value=gstTotal;
    document.getElementById("qty_stock").value=qty_stock;
    
    
    // ####### ends ##############//
    editDeleteCalculation();
    
        var i = r.parentNode.parentNode.rowIndex;
    	document.getElementById("invoice").deleteRow(i);
    }
    
    ////////////////////////////////// ends edit code ////////////////////////////////
    
    
    
    
    ////////////////////////////////// starts delete code ////////////////////////////////
    
    function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
     {
     
    var regex = /(\d+)/g;
    
    nn= d.match(regex)
    	id=nn;
    	if(document.getElementById("prd").value!=''){
     		document.getElementById("qn").focus();
         alert("Product already in edit Mode");
    return false;
    }
    
    
    
    
    		var pd=document.getElementById("pd"+id).value;
    		var unit=document.getElementById("unit"+id).value;
    		var qn=document.getElementById("qnty"+id).value;
    		var lph=document.getElementById("lph"+id).value;
    		var discount=document.getElementById("dis"+id).value;
    		var disAmt=document.getElementById("disAmount"+id).value;
    		var tot=document.getElementById("tot"+id).value;
    		var nettot=document.getElementById("nettot"+id).value;
    		
    		var pri_id=document.getElementById("main_id"+id).value;
    		var igst=document.getElementById("igst"+id).value;
    		var cgst=document.getElementById("cgst"+id).value;
    		var sgst=document.getElementById("sgst"+id).value;
    		var gstTotal=document.getElementById("gstTotal"+id).value;
    		
    		
    
    	    var i = r.parentNode.parentNode.rowIndex;
         var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
    if (cnf== true)
     {
     document.getElementById("invoice").deleteRow(i);
      slr();
      
     editDeleteCalculation();
    	//serviceChargeCal();	
    	//grossDiscountCal();
    	}
    	
    	}
    ////////////////////////////////// ends delete code ////////////////////////////////
    
    
    function totalSum(){
    
    
    var tot=document.getElementById("tot").value;
    var subb=document.getElementById("sub_total").value;
    var gt=document.getElementById("grand_total").value;
    var totDisPer=document.getElementById("total_dis").value;
    var discount=document.getElementById("discount").value;
    var disAmt=document.getElementById("disAmt").value;
    var total_dis_amt=document.getElementById("total_dis_amt").value;
    var total_igst=document.getElementById("total_igst").value;
    var total_tax_igst_amt=document.getElementById("total_tax_igst_amt").value;
    var igst=document.getElementById("igst").value;
    var cgst=document.getElementById("cgst").value;
    var sgst=document.getElementById("sgst").value;
    var total_sgst=document.getElementById("total_sgst").value;
    var gstTotal=document.getElementById("gstTotal").value;
    var total_tax_sgst_amt=document.getElementById("total_tax_sgst_amt").value;
    var total_tax_cgst_amt=document.getElementById("total_tax_cgst_amt").value;
    
    var total_cgst=document.getElementById("total_cgst").value;
    var total_gst_tax_amt=document.getElementById("total_gst_tax_amt").value;
    
    
    			var tol=(Number(nettot));
    			
    			var total=Number(nettot)+Number(gt);
    			
    			var Stotal=Number(tot)+Number(subb);
    			var Sdis=Number(totDisPer)+Number(discount);
    			var SdisTot=Number(total_dis_amt)+Number(disAmt);
    			var SigstPer=Number(total_igst)+Number(igst);
    			var SigstAmt=Number(gstTotal)+Number(total_tax_igst_amt);
    			document.getElementById("grand_total").value=total.toFixed(2);	
    			document.getElementById("sub_total").value=Stotal.toFixed(2);
    			
    			document.getElementById("total_dis").value=Sdis;
    			document.getElementById("total_dis_amt").value=SdisTot.toFixed(2);
    			
    			if(Number(igst!=''))
    			{
    				
    			document.getElementById("total_igst").value=SigstPer;
    			document.getElementById("total_tax_igst_amt").value=SigstAmt.toFixed(2);
    			}
    			
    			if(Number(sgst!=''))
    			{
    				
    				var SsgstPer=Number(sgst)+Number(total_sgst);
    				var sgstT=Number(tot)*Number(sgst)/100;
    				
    				var SsgstAmt=Number(gstTotal/2)+Number(total_tax_sgst_amt);
    				
    				
    			document.getElementById("total_sgst").value=SsgstPer;
    			document.getElementById("total_cgst").value=SsgstPer;
    			document.getElementById("total_tax_sgst_amt").value=SigstAmt.toFixed(2)/2;
    
    document.getElementById("total_tax_cgst_amt").value=SsgstAmt.toFixed(2);
    			
    document.getElementById("total_tax_sgst_amt").value=SsgstAmt.toFixed(2);
    			
    			
    			}
    
    
    var TotGST=Number(total_gst_tax_amt)+Number(gstTotal);
    
    			document.getElementById("total_gst_tax_amt").value=TotGST.toFixed(2);
    		
    		
    			
    
    }
    
    
    
    
    // ###### starts when item we edit or delete ##########//
    function editDeleteCalculation()
    {
    	
    var sub_total=document.getElementById("sub_total").value;
    var grand_total=document.getElementById("grand_total").value;
    var total_gst_tax_amt=document.getElementById("total_gst_tax_amt").value;
    var total_tax_cgst_amt=document.getElementById("total_tax_cgst_amt").value;
    
    var total_cgst=document.getElementById("total_cgst").value;
    var total_sgst=document.getElementById("total_sgst").value;
    var total_igst=document.getElementById("total_igst").value;
    
    var total_tax_cgst_amt=document.getElementById("total_tax_cgst_amt").value;
    
    var total_tax_sgst_amt=document.getElementById("total_tax_sgst_amt").value;
    
    var total_tax_igst_amt=document.getElementById("total_tax_igst_amt").value;
    
    
    
    
    if(Number(total_igst)!='')
    {
    
    total_igst_cal=total_igst-igst;	
    document.getElementById("total_igst").value=total_igst_cal;
    
    
    
    
    
    
    
    total_tax_igst_amt_cal=total_tax_igst_amt-gstTotal;	
    document.getElementById("total_tax_igst_amt").value=total_tax_igst_amt_cal;
    
    
    
    }
    else
    {
    total_cgst_cal=total_cgst-cgst;
    total_sgst_cal=total_sgst-sgst;
    total_tax_cgst_amt_cal=total_tax_cgst_amt-gstTotal/2;
    total_tax_sgst_amt_cal=total_tax_sgst_amt-gstTotal/2;
    
    document.getElementById("total_cgst").value=total_cgst_cal;
    document.getElementById("total_sgst").value=total_sgst_cal;
    document.getElementById("total_tax_cgst_amt").value=total_tax_cgst_amt_cal;
    document.getElementById("total_tax_sgst_amt").value=total_tax_sgst_amt_cal;
    
    }
    
    sub_total_cal=sub_total-tot;
    grand_total_cal=grand_total-nettot;
    
    total_dis_cal=total_dis-discount;
    total_dis_amt_cal=total_dis_amt-disAmt;
    
    total_gst_tax_amt_cal=total_gst_tax_amt-gstTotal;
    
    
    
    
    document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
    document.getElementById("grand_total").value=grand_total_cal.toFixed(2);
    
    document.getElementById("total_gst_tax_amt").value=total_gst_tax_amt_cal;
    
    
    
    document.getElementById("total_dis").value=total_dis_cal;
    document.getElementById("total_dis_amt").value=total_dis_amt_cal;
    
    }
    // ##### ends ###########
    
    
    
    
    
    
    
    
    
    
       }
    
    // ###### starts service charge calculation ##########//
    function serviceChargeCal()
    {
    
    var sub_total=document.getElementById("sub_total").value;
    var service_charge=document.getElementById("service_charge").value;
    
    service_total_per=Number(sub_total)*Number(service_charge)/100;
    service_total_cal=Number(sub_total)+Number(service_total_per);
    
    document.getElementById("service_charge_total").value=service_total_per.toFixed(2);
    document.getElementById("grand_total").value=service_total_cal.toFixed(2);
    return service_total_cal.toFixed(2);
    }
    // ##### ends ###########
      
    
    // ###### starts gross discount calculation ##########//
    function grossDiscountCal()
    {
    
    var serviceTotl=serviceChargeCal();
    
    var gross_discount_per=document.getElementById("gross_discount_per").value;
    var gross_discount_total=document.getElementById("gross_discount_total").value;
    var grand_total=document.getElementById("grand_total").value;
    
    
    service_total_per=Number(serviceTotl)*Number(service_charge)/100;
    service_total_cal=Number(sub_total)+Number(service_total_per);
    
    var totalGross=Number(serviceTotl)*Number(gross_discount_per)/100;
    var totalGrossCal=Number(grand_total)-Number(totalGross);
    
    document.getElementById("gross_discount_total").value=totalGross.toFixed(2);
    document.getElementById("grand_total").value=totalGrossCal.toFixed(2);
    }
    // ##### ends ###########
    function getCustomer()
    {
    	
    var state=document.getElementById("state").value;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "getContact?state="+state, false);
    xhttp.send();
    document.getElementById("contact_id_copy").innerHTML = xhttp.responseText;
    	
    	
    }
    
          
  </script>
</form>
<?php
  $this->load->view("footer.php");
  ?>