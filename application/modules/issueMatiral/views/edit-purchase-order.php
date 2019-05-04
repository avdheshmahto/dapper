					 <?php
					    $poid        = "";$purchase_contact =""; $supplier_contact = ""; $fob_incoterms	='';
						$order_date  = "";$revised_date     =""; $revised_by       = ""; $terms	        ='';
						$purchase_no = "";$ship_method      =""; $ship_vip		   = ""; $supplier	    ='';
						$freight     = "";$company          =""; $po_status		   = ""; $dtlData	    ='';

                      if($result != ""){
                         $poid               = $result['purchaseid'];
                         $purchase_contact   = $result['purchase_contact'];
                         $supplier_contact   = $result['supplier_contact'];
                         $fob_incoterms		 = $result['fob_incoterms'];
                         $order_date         = $result['order_date'];
                         $revised_date       = $result['revised_date'];
                         $revised_by         = $result['revised_by'];
                         $terms              = $result['terms'];
                         $purchase_no        = $result['purchase_no'];
                         $ship_method        = $result['ship_method'];
                         $ship_vip           = $result['ship_vip'];
                         $supplier           = $result['supplier'];
                         $freight            = $result['freight'];
                         $company            = $result['company'];
                         $po_status          = $result['po_status'];
                         $dtlData            = $result['dtlData'];
					    }

					    echo "<pre>";
					     print_r($result);
					    echo "</pre>";
                      ?>

					    <div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Purchase Order</h4>
						<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
						</div>
                         <div class="panel-body" >
       
                       <form action="insertPurchaseOrder" method="post">
						 <div class="panel-body">
				          <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
								   <div class="panel-body">
									 <div class="form-group">
									  <div class="col-sm-6">
									 	<label for="company">Location Name:</label>
									    <select name="company"  class="form-control" id="company" required>
										   <option value="">----Select ----</option>
											<?php 
												$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
												foreach ($sqlprotype->result() as $fetch_protype){
											?>
									 	   <option value="<?php echo $fetch_protype->serial_number;?>" <?=$company ==$fetch_protype->serial_number?'selected':'';?> ><?php echo $fetch_protype->keyvalue; ?></option>
											<?php } ?>
					                    </select>

									  </div>
									   <div class="col-sm-6">
									 	<label for="po_order">PURCHASE ORDER:</label>
									    <input type="text"  class="form-control" id="po_order"  name="po_order" value="<?=$purchase_no;?>"  disabled />
                                        <input type="hidden" name="poid" value="<?=$poid;?>">
									  </div>
									   <div class="col-sm-3">
										<label for="order_date">ORDER DATE:</label>
										  <input type="date"  class="form-control" id="order_date"  name="order_date" value="<?=$order_date;?>" />
									    </div>
									    <div class="col-sm-3">
										<label for="contact_id_copy">PURCHASER CONTACT:</label>
										<select name="vendor_id"   id="contact_id_copy" class="form-control" disabled>
											<option value="" selected disabled>Select</option>
											<?php
											$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='5'");
											foreach($contQuery->result() as $contRow)
											{
											?>
												<option value="<?php echo $contRow->contact_id; ?>" <?=$purchase_contact ==$contRow->contact_id?'selected':'';?> >
												<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
												</option>
											<?php } ?>
										</select>
									    </div>

										<div class="col-sm-3">
										<label for="terms">TERMS:</label>
										<input type="text" name="terms"  id="terms" class="form-control" value="<?=$terms;?>"  >
									    </div>
									   
									  
									  	<div class="col-sm-3">
										<label for="fob_incoterms">FOB/INCOTERMS:</label>
											<input type="text" name="fob_incoterms" id="fob_incoterms" class="form-control"  value="<?=$fob_incoterms;?>" >

									    </div>
				                    </div>
				                    
				                    <div class="form-group">
                                       <div class="col-sm-3">
										 <label for="revised_date">REVISED DATE:</label>
										  <input type="date"  class="form-control"  id="revised_date" name="revised_date" value="<?=$revised_date;?>" />
									    </div>

									    <div class="col-sm-3">
										  <label for="revised_by">REVISED BY:</label>
										  <input type="text"  class="form-control"  id="revised_by" name="revised_by" value="<?=$revised_by;?>" />
										</div>

										<div class="col-sm-3">
										<label for="ship_method">SHIP METHOD:</label>
										<input type="text" name="ship_method" id="ship_method" class="form-control" value="<?=$ship_method;?>"  >
									    </div>
									   
									  
									  	<div class="col-sm-3">
										 <label for="ship_vip">SHIP VIA:</label>
										 <input type="text" name="ship_vip" id="ship_vip" class="form-control" value="<?=$ship_vip;?>"  >
				                        </div>
				                    </div>

				                    <div class="form-group">
				                    	<div class="col-sm-3">
										 <label for="supplier">SUPPLIER SITE ID:</label>
										  <input type="text"  class="form-control"  name="supplier"  id="supplier" value="<?=$supplier;?>" />
									    </div>
									     <div class="col-sm-3">
										  <label for="supplier_contact">SUPPLIER CONTACT:</label>
										   <select name="supplier_contact" required  id="supplier_contact" class="form-control" disabled>
											<option value="" selected disabled>Select</option>
											<?php
											$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='4'");
											 foreach($contQuery->result() as $contRow)
											 {
											 ?>
											<option value="<?php echo $contRow->contact_id; ?>" <?=$contRow->contact_id==$supplier_contact?'selected':'';?> >
											<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
											</option>
											 <?php } ?>
									   	 </select>
										<!--   <input type="text"  class="form-control" required name="supplier_contact" value="" id="supplier_contact" /> -->
									    </div>

										<div class="col-sm-3">
										<label for="freight">FREIGHT:</label>
										  <input type="text" name="freight" id="freight" class="form-control"  value="<?=$freight;?>" >
									    </div>
									    <div class="col-sm-3">
										</div>
									</div>

								  </div>
								</div>
							</div>
						</div>

				        <div class="table-responsive ">
								<table class="table table-striped table-bordered table-hover" >
									<tbody>
									 <tr class="gradeA">
										<th>Product Name</th>
										<th>Unit</th>
										<th>Quantity</th>
										<th>Actual Qty</th>
										<th>Ordered Qty</th>
										<th>Effective Qty</th>
									 </tr>

									<tr class="gradeA">
										<td style="width:280px;">
											<div class="input-group"> 
											<div style="width:100%; height:28px;">
											<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:230px;"  placeholder=" Search Items..." tabindex="5" autocomplete="off">
											<input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
												<!-- <img  style="display:none" src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)" /> -->
										    </div>
					                        </div>
											<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
											 <?php
											   $this->load->view('getproduct');
					                         ?>
											</div>
										</td>
				                        <td>
										<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
										</td>
					                    <td>
										  <b id="lpr"></b>
										  <input type="number" step="any" id="lph" min="1"  value="" class="form-control" style="width:70px;">
									    </td> 
										<td><input type="text"   id="qty_stock" class="form-control"  style="width:70px;" readonly></td>
										<td><input type="text"   id="ordered_qty" class="form-control"   style="width:70px;" readonly></td>
										<td><input type="text"   id="effective_qty" class="form-control" style="width:70px;"readonly / ></td>
									</tr>
								  </tbody>
							</table>
				        </div>
						
						<div class="" id="style-3-y">
						<div class="force-overflow-y">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
						<thead>
						<tr>
						<th class="tdcenter"> Sl No</th>
						<th class="tdcenter">Item Number & Description</th>
						<th class="tdcenter">UOM</th>
						<th class="tdcenter">Ordered Qty</th>
						<!-- <th class="tdcenter">Actual Qty</th> -->
						<th class="tdcenter">Action</th>
						</tr>
						</thead>
						<tbody  id="invoice">
					    <?php 
					     $i = 1;
					     foreach ($dtlData as  $dttl) {
                        ?>
					    <tr>
							<td align="center"><?=$i;?></td>
							<td align="center">
								<input type="text" name="pd[]" id="pd<?=$i;?>" value="<?=$dttl['productname'];?>^<?=$dttl['productid'];?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['productid'];?>" name="main_id[]" id="main_id<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['umo'];?>" name="unit[]" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center">
								<input type="text" name="unit[]" value="<?=$dttl['umo'];?>" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;"></td>
								<td align="center" style="width: 3%;">
								<input type="text" name="qty[]" id="qty<?=$i;?>" value="<?=$dttl['qty'];?>" readonly="" style="text-align: center; border: hidden;"></td><td align="center">
								<button type="button" class="btn btn-xs btn-black" name="ed" onclick = "editselectrow('<?=$dttl['productid'];?>',this);"  id="ed<?=$i;?>"  style="margin-right: 10px;"><i class="icon-pencil"> </i>
								</button>
								<button type="button" class="btn btn-xs btn-black" name="dlt" id="dlt<?=$i;?>" onclick = "deleteselectrow('<?=$dttl['productid'];?>',this);"><i class="icon-trash"> </i></button>
							</td>
						</tr>
						<?php $i++;} ?>
						</tbody>
						</table>
						</div>	  

						</div>
						</div><!--scrollbar-y close-->		

						</div>

		<input type="hidden" name="rows" id="rows" value="<?=$i;?>">
		<!--//////////ADDING TEST/////////-->
		<input type="hidden" name="spid" id="spid" value="d1"/>
		<input type="hidden" name="ef" id="ef" value="0" />

		<div class ="pull-right">
        <input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
		&nbsp;<a href="<?=base_url();?>purchaseorder/manage_purchase_order" class="btn btn-sm btn-black btn-outline">Cancel</a>
   </div>


      </div>
    
</form>
</div>

<script type="text/javascript">


//add item into showling list
	window.addEventListener("keydown", checkKeyPressed, false);
	      //funtion to select product
	      function checkKeyPressed(e) {
			      var s=e.keyCode;
			      var ppp   = document.getElementById("prd").value;
			      var sspp  = document.getElementById("spid").value;//
			      var ef    = document.getElementById("ef").value;
					ef      = Number(ef);
			
			      var countids = document.getElementById("countid").value;
			      for(n=1;n<=countids;n++)
			       {
			          document.getElementById("tyd"+n).onkeyup  = function (e) {
			          var entr =(e.keyCode);
			          if(entr==13){
			            document.getElementById("lph").focus();
			            document.getElementById("prdsrch").innerHTML=" ";
	                  }
			       }
			     }
    
            document.getElementById("lph").onkeyup = function (e) {
            var entr = (e.keyCode);
            if (e.keyCode == "13")
	        {
	          e.preventDefault();
              e.stopPropagation();
		   if(ppp!=='' || ef==1)
	        {
        	 adda();	  	
	   		 var ddid = document.getElementById("spid").value;
		     var ddi  = document.getElementById(ddid);
		     ddi.id   = "d";
            }
	       else
	       {
	        alert("Enter Correct Product");
	       }
	       return false;
       }
    }

}

function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
 {
 
var regex = /(\d+)/g;

nn = d.match(regex)
id = nn;
if(document.getElementById("prd").value!=''){
		document.getElementById("qn").focus();
    alert("Product already in edit Mode");
    return false;
}
        var i = $("#"+d).parent().parent();
        var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
		if (cnf== true)
		 {
		   i.remove();
		  // slr();
		  // editDeleteCalculation();
		}
			
   }
////////////////////////////////// ends delete code ////////////////////////////////


////////////////////////////////// starts edit code ////////////////////////////////


		function editselectrow(d,r) //modify dyanamicly created rows or product detail
		 {
		 	//alert(d);
	 	    var regex = /(\d+)/g;
			nn = d.match(regex)
			id = nn;
		    if(document.getElementById("prd").value!=''){
				document.getElementById("lph").focus();
				alert("Product already in edit Mode");
			 	return false;
		    }
           // ####### starts ##############//
            var pd       = document.getElementById("pd"+id).value;
		    var main_id  = document.getElementById("main_id"+id).value;
	        var unit     = document.getElementById("unit"+id).value;
            var qn       = document.getElementById("qty"+id).value;
		 //	var actual   = document.getElementById("actual"+id).value;
		
			document.getElementById("pri_id").value    = main_id;
		    document.getElementById("prd").value       = pd;
			document.getElementById("usunit").value    = unit;
			document.getElementById("lph").value       = lph;
			//document.getElementById("qty_stock").value = actual;
			
            // ####### ends ##############//
			//editDeleteCalculation();
            $("#"+d).parent().parent().remove();
            document.getElementById("prd").focus();
		}

////////////////////////////////// ends edit code ////////////////////////////////

  function getdata()
	{
		// alert('sss');
	currentCell          = 0;
    var product1         = document.getElementById("prd").value;	 
    var product          = product1;
	var conatctId        = document.getElementById("contact_id_copy").value;
	var supplier_contact = document.getElementById("supplier_contact").value;
   // var state        = document.getElementById("state").value;
   // alert();
	if(conatctId=='')
	{
		alert('Please Select Purchase Contact !');
		document.getElementById("contact_id_copy").focus();
	}	
	if(supplier_contact=='')
	{
		alert('Plaese Select Sipplier Contact !');
		document.getElementById("supplier_contact").focus();
	}
		
	if(xobj)
    {
		var obj=document.getElementById("prdsrch");
		//alert(obj);
		xobj.open("GET","getproduct?con="+product+"&con_id="+conatctId+"&supplier_contact="+supplier_contact,true);
		xobj.onreadystatechange=function()
		{
		if(xobj.readyState==4 && xobj.status==200)
		  {
			console.log(xobj.responseText);
			obj.innerHTML=xobj.responseText;
		  }
		}
	}
	xobj.send(null);
}
  
////////////////////////////////////////////////////   



</script>