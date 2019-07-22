<?php
  $this->load->view("header.php");
  
  $entries = "";
  if($this->input->get('entries')!="")
  {
    $entries = $this->input->get('entries');
  }
  
  ?>
<!-- Main content -->
<div class="main-content">
  <div class="panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Master</a></li>
      <li><a href="#">Contact</a></li>
      <li class="active"><strong>Manage Contact</strong></li>
      <div class="pull-right">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" formid="#contactForm" id="formreset"><i class="fa fa-plus"></i>Add Contact</button>
        <a  class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i> Delete All</a>
      </div>
    </ol>
    <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="top_title">Add</span>&nbsp;Contact</h4>
            <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
          </div>
          <form class="form-horizontal" role="form" id="contactForm" >
            <div class="modal-body overflow">
              <div class="form-group">
                <label class="col-sm-2 control-label">&nbsp;</label> 
                <div class="col-sm-4">
                  <input type="hidden" name="maingroupname" value="<?=$_GET['con_type'];?>" />
                  <select style="display:none" name="maingroupname1" id="maingroupname" class="form-control"  onchange="showconsigneemap(this.value)">
                    <option value="">-------select---------</option>
                    <?php
                      $ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");
                      foreach ($ugroup2->result() as $fetchunit){
                      ?>
                    <option value="<?php echo $fetchunit->account_id ;?>"><?php echo $fetchunit->account_name;?></option>
                    <?php } ?>
                  </select>
                </div>
                <label class="col-sm-2 control-label">*Name:</label> 
                <div class="col-sm-4"> 				
                  <input type="hidden" name="contact_id" id="contact_id" class="hiddenField" value="" />
                  <input type="text" name="first_name" id="first_name" value=""  class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Contact Person:</label> 
                <div class="col-sm-4"> 
                  <input type="text" name="contact_person" id="contact_person" value=""  class="form-control">
                </div>
                <label class="col-sm-2 control-label">Email Id:</label> 
                <div class="col-sm-4"> 
                  <input type="email" name="email" id="email" value=""  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Mobile No.:</label> 
                <div class="col-sm-4"> 
                  <input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="Enter 10 Digits Mobile Number"  value=""  class="form-control" >
                </div>
                <label class="col-sm-2 control-label">Phone No.:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" maxlength="10"  pattern="[0-9]{10}" title="Enter Your Phone Number" name="phone" id="phone" value="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Pan No:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="pan_no" id="pan_no" placeholder="PAN NUMBER"  value=""  class="form-control">
                </div>
                <label class="col-sm-2 control-label">GSTIN No:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="gst_no" id="gst_no"  placeholder="GSTIN" value="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Address1:</label> 
                <div class="col-sm-4" id="regid"> 
                  <textarea class="form-control" name="address1" id="address1"> </textarea>
                </div>
                <label class="col-sm-2 control-label">Address2:</label> 
                <div class="col-sm-4" id="regid"> 
                  <textarea class="form-control" name="address3" id="address3"> </textarea>
                </div>
              </div>
              <div class="form-group" >
                <label class="col-sm-2 control-label">City:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="city" id="city" value=""  class="form-control">
                </div>
                <label class="col-sm-2 control-label">State:</label> 
                <div class="col-sm-4" id="regid">
                  <select name="state" id="state" class="form-control">
                    <option value="">--Select--</option>
                    <?php 
                      $stnm=$this->db->query("select * from tbl_state_m order by stateName asc");
                      foreach($stnm->result() as $stdata)
                      {
                      ?>
                    <option value="<?=$stdata->code;?>"><?=$stdata->stateName;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group" >
                <label class="col-sm-2 control-label">Pin Code:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="number" name="pin_code" id="pin_code" value=""  class="form-control">
                </div>
                <label class="col-sm-2 control-label">Code:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="code" id="code" value=""  class="form-control">
                </div>
              </div>
              <div class="form-group consignee" >
                <label class="col-sm-2 control-label">Final Destination:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="finalDestination" id="finalDestination" class="form-control" value="" />
                </div>
                <label class="col-sm-2 control-label">Destination Country:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="countryDestination" id="countryDestination" class="form-control" value="" />
                </div>
              </div>
              <div class="form-group consignee" >
                <label class="col-sm-2 control-label">Port Of Discharge:</label> 
                <div class="col-sm-4" id="regid"> 
                  <input type="text" name="portDischarge" id="portDischarge" class="form-control" value="" />
                </div>
                <label class="col-sm-2 control-label">Norify:</label> 
                <div class="col-sm-4" id="regid">
                  <textarea name="norify" id="norify" class="form-control"></textarea> 
                </div>
              </div>
              <div class="form-group" >
                <label class="col-sm-2 control-label">&nbsp;</label> 
                <div class="col-sm-4" id="regid"> 
                  &nbsp;
                </div>
              </div>
              <?php
                if($_GET['con_type']=='4'){
                ?>
              <div class="form-group" id="consigneeMapping">
                <div class="col-sm-12" >
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr class="gradeA">
                        <th>Consignee</th>
                        <!-- <th>Location code</th> -->
                        <!--<th>Location Address</th>-->
                        <th>Action</th>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>
                          <select  class="form-control" id="entity" >
                            <option value="">----Select ----</option>
                            <?php 
                              $sqlprotype=$this->db->query("SELECT * FROM tbl_contact_m where group_name = 7");
                              foreach ($sqlprotype->result() as $fetch_protype){
                              ?>
                            <option value="<?=$fetch_protype->contact_id;?>"><?=$fetch_protype->first_name; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <!--<td>
                          <select class="form-control" id="entity_code" multiple>
                          <option value="">----Select ----</option>
                          </select> 
                          </td> -->
                        <td>
                          <!-- <i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i> -->
                          <button type="button" onclick="addconsignee()" class="btn btn-sm btn-black btn-outline">Add</button>
                        </td>
                      </tr>
                    </tbody>
                    <tbody id="consigneeTable">
                    </tbody>
                  </table>
                </div>
              </div>
              <?php }?>
            </div>
            <div class="modal-footer" id="button">
              <input type="submit" class="btn btn-sm" value="Save" />
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
      </div>
    </div>
    <div  id="listingData">
      <div class="row">
        <div class="col-sm-12">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="html5buttons">
              <div class="dt-buttons">
                <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToCSV('members.csv')" style="margin: 15px 15px 0px 0px;">Excel</button> 
                <a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
              </div>
            </div>
            <div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 15px 0px -15px 15px;">
              <label>
                Show
                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Account/manage_contact').'?con_type='.$_GET['con_type'].'&name='.$_GET['name'].'&grp_name='.$_GET['grp_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
                  <option value="10">10</option>
                  <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                  <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                  <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
                  <option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
                  <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
                </select>
                entries
              </label>
              <br />
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                Showing <?=$dataConfig['page']+1;?> to 
                <?php
                  $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                  echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                  ?> of <?php echo $dataConfig['total'];?> entries
              </div>
            </div>
            <div id="DataTables_Table_0_filter" class="dataTables_filter" style="margin: 15px 0px 0px 0px;">
              <label>Search:
              <input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example11" id="tblData" >
                <thead>
                  <tr id="abc">
                    <th ><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
                    <th>Name</th>
                    <th>Group Name</th>
                    <th>Email Id</th>
                    <th>Mobile No.</th>
                    <th>Phone No.</th>
                    <th style="width: 16%;">
                      <div style="width:100px;">Action</div>
                    </th>
                  </tr>
                </thead>
                <tbody id="getDataTable">
                  <form method="get">
                    <tr>
                      <td>&nbsp;</td>
                      <input name="con_type" type="hidden" class="search_box form-control input-sm"  value="<?=$_GET['con_type'];?>" />
                      <td><input name="name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="grp_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="email"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="mobile"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><input name="phone"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                      <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                    </tr>
                  </form>
                  <?php
                    $i=1;
                    foreach($result as $fetch_list)
                     {
                    ?>
                  <tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
                    <th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>
                    <th><?=$fetch_list->first_name;?></th>
                    <?php
                      $contactQuery=$this->db->query("select *from tbl_account_mst where account_id='$fetch_list->group_name'");
                      $getContact=$contactQuery->row();
                      ?>
                    <th>
                      <?=$getContact->account_name;?>
                    </th>
                    <th><?=$fetch_list->email;?></th>
                    <th><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
                    <th><?=$fetch_list->phone;?></th>
                    <th>
                      <button class="btn btn-default" type="button" data-toggle="modal" property="view" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);"  data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                      <button class="btn btn-default" type="button" data-toggle="modal" property="edit" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);"  data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>
                      <?php
                        $pri_col='contact_id';
                        $table_name='tbl_contact_m';
                        ?>
                      <button class="btn btn-default delbutton" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>	
                      <?php if($fetch_list->group_name == 4){ ?>
                      <!--<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop='static' data-keyboard='false' title="Contact Mapping" onclick="mappingproduct(<?=$fetch_list->contact_id;?>,'edit');"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-2" type="button" data-backdrop='static' data-keyboard='false'  title=" View Contact Mapping" onclick="mappingproduct(<?=$fetch_list->contact_id;?>,'view');"><i class="icon-flow-tree"></i></button>-->
                      <?php } ?>
                    </th>
                  </tr>
                  <?php $i++; } ?>
                </tbody>
                <input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
                <input type="text" style="display:none;" id="pri_col" value="contact_id">
              </table>
              <div class="row">
                <div class="col-md-12 text-right">
                  <div class="col-md-6 text-left"> </div>
                  <div class="col-md-6">  <?=$pagination; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" >
        	<div class="modal-header">
        	<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title">Edit Purchase Order</h4>
        	<div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div> 
        	</div>
        	<form  class="form-horizontal" role="form" id="insertProductMapping"  >
                <div class="panel-body" id ="mappingData">
             </div>
               </form>
        		
         </div>
         </div>
        </div> -->
      <div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" >
            <div class="modal-header">
              <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Contact Mapping</h4>
              <div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div>
            </div>
            <form  class="form-horizontal" role="form" id="insertProductMapping"  >
              <div class="panel-body" id ="mappingData2">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
  </div>
</div>
<script>
  //add item into showling list
  window.addEventListener("keydown", checkKeyPressed, false);
     //funtion to select product
     function checkKeyPressed(e) {
               // e.preventDefault();
       var s=e.keyCode;
       var ppp   = document.getElementById("prd").value;
       var sspp  = document.getElementById("spid").value;//
       var ef    = document.getElementById("ef").value;
  	ef      = Number(ef);
  
      var countids = document.getElementById("countid").value;
      // alert(countids);
       for(n=1;n<=countids;n++)
        {
           document.getElementById("tyd"+n).onkeyup  = function (e) {
           var entr =(e.keyCode);
           if(entr==13){
             document.getElementById("priceVal").focus();
             document.getElementById("prdsrch").innerHTML=" ";
                 }
        }
      }
              document.getElementById("priceVal").onkeyup  = function (e) {
           var entr =(e.keyCode);
           if(entr==13){
                      document.getElementById("addRow").focus();
           }
     }
              
               document.getElementById("addRow").onclick = function (e) {
               	//alert('dsd');
         var entr = (e.keyCode);
        //  if (e.keyCode == "13")
        // {
           e.preventDefault();
              e.stopPropagation();
     if(ppp!=='' || ef==1)
         {
         	//alert('sdsdsdd');
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
      // }
    }
  
         document.getElementById("addRow").onkeyup = function (e) {
         var entr = (e.keyCode);
          if (e.keyCode == "13")
         {
           e.preventDefault();
              e.stopPropagation();
     if(ppp!=='' || ef==1)
         {
         	//alert('sdsdsdd');
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
  nn = d.match(regex);
  id = nn;
  
  if(document.getElementById("prd").value!=''){
  document.getElementById("qn").focus();
   alert("Product already in edit Mode");
   return false;
  }
      var i = $(r).parent().parent();
      var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
  if (cnf== true)
  {
  
  var rows    = document.getElementById("rows").value; 
  var rid     = Number(rows)-1;
  
  document.getElementById("rows").value = rid;
  
   i.remove();
  // slr();
  // editDeleteCalculation();
  }
  
  }
  
  ////////////////////////////////// ends delete code ////////////////////////////////
  ////////////////////////////////// starts edit code ////////////////////////////////
  
  
  function editselectrow(d,r) //modify dyanamicly created rows or product detail
  {
  
  var regex = /(\d+)/g;
  nn        = d.match(regex)
  id        = nn;
  
  if(document.getElementById("prd").value!=''){
  document.getElementById("lph").focus();
  alert("Product already in edit Mode");
  return false;
  }
  
    //####### starts ##############//
      var pd        = document.getElementById("pd"+id).value;
  var main_id   = document.getElementById("main_id"+id).value;
   var priceval  = document.getElementById("price"+id).value;
  //var qn          = document.getElementById("qty"+id).value;
  //var actual      = document.getElementById("actual"+id).value;
  	
  document.getElementById("pri_id").value    = main_id;
  document.getElementById("prd").value       = pd;
  document.getElementById("priceVal").value  = priceval;
              
              $(r).parent().parent().remove();
              var rows    = document.getElementById("rows").value; 
      var rid     = Number(rows)-1;
              document.getElementById("rows").value = rid;
              document.getElementById("prd").focus();
  }
  
  ////////////////////////////////// ends edit code ////////////////////////////////
  
  function getdata()
  {
  
  // alert('sss');
  currentCell          = 0;
  var product1         = document.getElementById("prd").value;
  var product          = product1;
  var prdId            =  "";
  
  //alert(product);
  if(xobj)
  {
  var obj=document.getElementById("prdsrch");
  //alert("getproduct?con="+product1+"&con_id="+company+"&supplier_contact="+supplier_contact);
  xobj.open("GET","getproduct?con="+product,true);
  xobj.onreadystatechange=function()
  {
  if(xobj.readyState==4 && xobj.status==200)
  {
  //console.log(xobj.responseText);
  obj.innerHTML=xobj.responseText;
  }
  }
  }
  xobj.send(null);
  }
  
  ////////////////////////////////////////////////////   
  function slr(){
  var table    = document.getElementById('invoice');
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
    var locationid =   "";//document.getElementById("locationid").value;     // enter quantity
    var rows      = document.getElementById("rows").value;     //row value
    var pri_id    = document.getElementById("pri_id").value;  //item id
  var pd 		  = document.getElementById("prd").value;
  var priceVal  = document.getElementById("priceVal").value;
  var table     = document.getElementById("invoice");
  var rid       = Number(rows)+1;
  
            
            	// if(lph == 0 || lph == ""){
             //     alert('Please Enter Quantity Value !');
             //     return false;
             //  }
  
  document.getElementById("rows").value=rid;
  //totalSum();	
  
              currentCell = 0;
               if(pri_id!="")
       {
  
      	clear();
        //alert(pd);
        var indexcell=0;
        var row = table.insertRow(-1);
        rw = rw+0;
     //cell 0st
  
      var cell=cell+indexcell;		
   	cell = row.insertCell(0);
  	//cell.style.width=".20%";
  	cell.align="center"
    	cell.innerHTML=rid;
  
  
      //cell 1st item name
               indexcell=Number(indexcell+1);		
               var cell=cell+indexcell;	
  
               cell = row.insertCell(indexcell);
      //cell.style.width = "11%";
      cell.align = "center";
  
  //============================item text ============================
  
      var prd = document.createElement("input");
  	prd.type="text";
  	prd.border ="0";
  	prd.value=pd;
  	prd.setAttribute("class", "form-control");	
  	prd.name='pd[]';//
  	prd.id='pd'+rid;//
  	prd.readOnly = true;
  	prd.style="text-align:center";  
  	//	prd.style.width="100%";
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
  	//	priidid.style.width="100%";
  	priidid.style.border="hidden"; 
  	cell.appendChild(priidid);
  			
  			
  // 				var unitt = document.createElement("input");
  // 				unitt.type="hidden";
  // 				unitt.border ="0";
  // 				unitt.value=unit;	
  // 				unitt.name='unit[]';//
  // 				unitt.id='unit'+rid;//
  // 				unitt.readOnly = true;
  // 				unitt.style="text-align:center";  
  // //	unitt.style.width="100%";
  // 				unitt.style.border="hidden"; 
  // 				cell.appendChild(unitt);
  	
  		// ends here
  
  
  //#################cell 2nd starts here####################//
  
       indexcell = Number(indexcell+1);		
                       var cell  = cell+indexcell;
                          cell      = row.insertCell(indexcell);
                  //cell.style.width="3%";
                 //cell.style.display="none";
              cell.align="center"
              var price = document.createElement("input");
  			price.type         = "text";
  			price.setAttribute("class", "form-control");
  			price.border       = "0";
  			price.value        = priceVal;	    
  			price.name         ='price[]';
  			price.id           ='price'+rid;
  			price.readOnly     = true;
  			price.style        = "text-align:center";
  		    price.style.border = "hidden"; 
  			cell.appendChild(price);
  
                
  			// indexcell = Number(indexcell+1);		
  			// var cell  = cell+indexcell;
  		 //        cell  = row.insertCell(indexcell);
  			// 			cell.style.width="3%";
  			// 			cell.align="center"
  			// 			var salepr = document.createElement("input");
  			// 						salepr.type="text";
  			// 						salepr.border ="0";
  			// 						salepr.value=lph;	    
  			// 						salepr.name ='qty[]';
  			// 						salepr.id='qty'+rid;
  			// 						salepr.readOnly = true;
  			// 						salepr.style="text-align:center";
  			// 					//	salepr.style.width="100%";
  			// 						salepr.style.border="hidden"; 
  			// 						cell.appendChild(salepr);
  						
  
  
  			indexcell=Number(indexcell+1);		
  	        var cell=cell+indexcell;
  	        //var imageloc="/mr_bajaj/";
  	        var cell = row.insertCell(indexcell);
  			//cell.style.width="3%";
  			cell.align="center";
  			
  
  				
  	            var edt = document.createElement("button");
  					edt.type ="button";
  					edt.setAttribute("class", "btn btn-xs btn-black");
  					edt.name ='ed';
  					edt.style="margin-right: 10px;";
  					edt.id='ed'+rid;
  					edt.innerHTML='<i class="icon-pencil"> </i>';
  					edt.onclick= function() { editselectrow(edt.id,edt); };
  					cell.appendChild(edt);
  
    
  
  		        var delt =document.createElement("button");
  		        	delt.type ="button";
  					delt.setAttribute("class", "btn btn-xs btn-black");
  					delt.innerHTML='<i class="icon-trash"> </i>';
  					delt.name ='dlt';
  					delt.id='dlt'+rid;
  					delt.onclick= function() { deleteselectrow(delt.id,delt); };
  				    cell.appendChild(delt);
                
                    $("#style-3-y").addClass("scrollbar-y");
  
  }
  else
  {
   alert('***Please Select PRODUCT ***');
   document.getElementById("prd").focus();
    }
  
  }
  
  function clear()
  {
  document.getElementById("priceVal").value       = "";     // enter quantity
  document.getElementById("prd").value       = "";
  document.getElementById("pri_id").value    = "";
  document.getElementById("prd").focus();	
  }
  
  ////////////////////////////////// starts delete code ////////////////////////////////
  
  function getVendor()
  {
  
  var state=document.getElementById("state").value;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getVendor?state="+state, false);
  xhttp.send();
  document.getElementById("contact_id_copy").innerHTML = xhttp.responseText;
  
  
  }
</script>
<?php
  $this->load->view("footer.php");
  ?>
<script>
  $("#maingroupname").ready(function() {
    var thsVal = $('#maingroupname').val();
    showconsigneemap(thsVal);
  });
  
  function showconsigneemap(thsVal){
    if(thsVal == 4 || <?=$_GET['con_type']=='4';?>){
      $("#consigneeMapping").show();
      $(".consignee").hide();
    }else if(thsVal == 7){
      $(".consignee").show();
    }else{
      $("#consigneeMapping").hide();
      $(".consignee").hide();
    }
  }
  
    function getEntityRow(thsValue){
      	//alert(thsValue+'sdsdf');
      	$.ajax({  
  		    type: "POST",  
  			url: "ajax_getentityRows",  
  			cache:false,  
  			data: {'id':thsValue},  
  			success: function(data)  
  			{
                //alert(data);
                //console.log(data);
  			  $("#consigneeTable").empty().append(data).fadeIn();
  			  amazonEntity();
  			}   
  	    });
      }
  
   function mappingproduct(editId,editView){
      $.ajax({   
  	    type: "POST",  
  		url: "mappingSuplier",  
  		cache:false,  
  		data: {'id':editId,'editView':editView},  
  		success: function(data)  
  		{  
  		//alert(data); 
  		// $("#loading").hide();  
  		 $("#mappingData2").empty().append(data).fadeIn();
  		//referesh table
  		}   
  	});
   }
  
  
  function downloadCSV(csv, filename) {
      var csvFile;
      var downloadLink;
  
      // CSV file
      csvFile = new Blob([csv], {type: "text/csv"});
  
      // Download link
      downloadLink = document.createElement("a");
  
      // File name
      downloadLink.download = filename;
  
      // Create a link to the file
      downloadLink.href = window.URL.createObjectURL(csvFile);
  
      // Hide download link
      downloadLink.style.display = "none";
  
      // Add the link to DOM
      document.body.appendChild(downloadLink);
  
      // Click download link
      downloadLink.click();
  }
  
  
  function exportTableToCSV(filename) {
      var csv = [];
      var rows = document.getElementById("abc").value;
      alert(rows);
  	return false;
      for (var i = 0; i < rows.length; i++) {
          if(i!=1)
  		{
  		var row = [], cols = rows[i].querySelectorAll("td, th");
          
          for (var j = 1; j < cols.length-1; j++) 
  		
  		
              row.push(cols[j].innerText);
          
          csv.push(row.join(","));        
  		
      }
  	}
      // Download CSV file
      downloadCSV(csv.join("\n"), filename);
  	
  }
  
</script>