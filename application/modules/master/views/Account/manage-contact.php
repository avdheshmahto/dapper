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
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0" formid="#contactForm" id="formreset"><i class="fa fa-plus"></i><?php if($_GET['con_type']=='6'){ echo "Add Employee";  } elseif($_GET['con_type']=='5'){ echo "Add Vendor";} elseif($_GET['con_type']=='7'){ echo "Add Consignee";} else{ echo "Add Buyer";}?></button>
        <a  class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i> Delete All</a>
      </div>
    </ol>
    <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <input type="hidden" id="contType" value="<?=$_GET['con_type']?>">
            <h4 class="modal-title"><span class="top_title"></span></h4>
            <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>
          </div>
          <form class="form-horizontal" role="form" id="contactForm" >
            <div class="modal-body overflow">
              <div class="form-group" style="display: none;">
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
                <label class="col-sm-2 control-label">Contact Person:</label> 
                <div class="col-sm-4"> 
                  <input type="text" name="contact_person" id="contact_person" value=""  class="form-control">
                </div>                  
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">*Name:</label> 
                <div class="col-sm-4">        
                  <input type="hidden" name="contact_id" id="contact_id" class="hiddenField" value="" />
                  <input type="text" name="first_name" id="first_name" value=""  class="form-control" >
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
                        <th>Action</th>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>
                          <select  class="form-control" id="entity" >
                            <option value="" selected disabled>----Select ----</option>
                            <?php 
                              $sqlprotype=$this->db->query("SELECT * FROM tbl_contact_m where group_name = 7");
                              foreach ($sqlprotype->result() as $fetch_protype){
                              ?>
                            <option value="<?=$fetch_protype->contact_id;?>"><?=$fetch_protype->first_name; ?></option>
                            <?php } ?>
                          </select>
                        </td>                        
                        <td>
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
              <button type="submit" class="btn btn-sm">Save</button>
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
            <div class="table-responsive__">
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
    var con_type = $('#contType').val();
    if(thsVal == 4 || con_type == 4){
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
  			  //amazonEntity();
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
  

  function addconsignee()
  {
  
    var value        =  0;
    var entity       =  $('#entity').val();
    
    //alert(entity) ;

    if(entity != null)
    {
      
      var x        = document.getElementById("entity").selectedIndex;
      var y        = document.getElementById("entity").options;
      var indexVal =  y[x].text;
      $('#entity option:selected').remove();
      
      $('#consigneeTable').append('<tr class="'+'row_'+value+'"><td><input  type ="hidden" class="form-control" name="entity[]" value="'+entity+'"><input   type ="text" readonly class="form-control"  value="'+indexVal+'"></td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel_contact" attrVal="'+entity+'" val="'+indexVal+'" aria-hidden="true"></i></td></tr>');
      
      //amazonEntity();
      $("#entity").val("");
      $("#select2-entity-container").text("--select--");

    }
    else
    {
      
      alert('Please Select Consignee');
      //$('#entity').focus();

    }
    
  
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