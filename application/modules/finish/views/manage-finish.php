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
  <div class="panel panel-default">
    <ol class="breadcrumb breadcrumb-2">
      <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#">Finish</a></li>
      <li class="active"><strong>Manage Finish</strong></li>
      <div class="pull-right">
      </div>
    </ol>
    <div class="row">
      <div class="col-sm-12">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="html5buttons">
            <div class="dt-buttons">
              <button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
              <a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
            </div>
          </div>
          <div class="dataTables_length" id="DataTables_Table_0_length">
            <label>
              Show
              <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('production/manage_production');?>" class="form-control input-sm">
                <option value="10">10</option>
                <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
                <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
                <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
              </select>
              Entries
            </label>
            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style=" margin-top: -6px;margin-left: 12px;float: right;">
              Showing <?=$dataConfig['page']+1;?> to 
              <?php
                $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
                echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
                ?> of <?php echo $dataConfig['total'];?> Entries
            </div>
          </div>
          <div id="DataTables_Table_0_filter" class="dataTables_filter">
            <label>Search:
            <input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
            </label>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div class="col-lg-12">
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
              <thead>
                <tr>
                  <th>Lot No.</th>
                  <th>Status</th>
                  <th>
                    <div style="width: 210px;">Action</div>
                  </th>
                </tr>
              </thead>
              <tbody id="getDataTable">
                <form method="get">
                  <tr>
                    <td><input name="p_id"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><input name="qty"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                    <td><button type="submit" class="btn btn-sm" name="filter" value="filter"><span>Search</span></button></td>
                  </tr>
                </form>
                <?php
                  $i=1;
                  foreach($result as $sales)
                    {
						
                    
                    ?>
                <tr class="gradeC record">
                  <th><a href="<?=base_url();?>finish/manage_finish_map?id=<?=$sales->lot_no;?>"><?=$sales->lot_no;?></a></th>
                  <th>Pending</th>
                  <th> <button class="btn btn-xs btn-black" data-toggle="modal" data-target="#modal-0" onclick="getspharemap('<?=$sales->lot_no;?>');"  type="button"><i class="icon-eye"></i></button>
                  </th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="col-md-6 text-left"> </div>
                <div class="col-md-6"> <?=$pagination; ?> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form class="form-horizontal" role="form" method="post" action="insert_overlock" enctype="multipart/form-data">
  <div id="editProduction" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-contentProduction"  id="modal-contentProduction" style="background: #FFF;">
      </div>
    </div>
  </div>
</form>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Finish Details: </h4>
        <div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div class="panel-body" id ="purchaseData">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  //--------------------------add overlock start----------------------------
  function addOverlock(v){
  
  var pro=v;
   var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "add_overlock?ID="+pro, false);
    xhttp.send();
    document.getElementById("modal-contentProduction").innerHTML = xhttp.responseText;
   } 
  //--------------------------add overlock end----------------------------
   
  function checkvalue(v,formtype){
  //alert();
  var spliii=v.split("qty");
  var ID=spliii[1];
  
  var qty11=document.getElementById("qty"+ID).value;
  var rest=document.getElementById("rest").value;
  
  
  
   if(formtype == 'edit'){
    var ed11 = document.getElementById("ed"+ID).value;
    //qty11 = Number(qty11)+Number(ed11);
    rest  = Number(rest)+Number(ed11);
    /*alert(qty11);
     alert(rest);*/
   }
  
  /*var inps    = document.getElementsByName('qty[]');
  var inptval = 0;
  for (var i = 0; i <inps.length; i++) {
       var inp=inps[i];
       //alert("qty["+i+"].value="+inp.value);
       inptval = Number(inptval)+ Number(inp.value);
       //alert(inptval);
  }
  alert(rest)
  alert(inptval);	
  if(Number(rest)>=Number(inptval)){
       	document.getElementById("error1").style.display= "none";
          document.getElementById("sv1").disabled = false;
  }*/
  
  if(Number(rest)>=Number(qty11)){
  document.getElementById("error"+ID).style.display= "none";
  document.getElementById("sv1").disabled = false;
  }else{
  //alert(ID);
  document.getElementById("error"+ID).style.display = "";
  document.getElementById("sv1").disabled = true;
  }
  }
  
</script>
<SCRIPT language="javascript">
  function addRow(tableID) {
  
  	var table = document.getElementById(tableID);
  
  	var rowCount = table.rows.length;
  	var row = table.insertRow(rowCount);
  
  var pvrsval=rowCount-1;
  //alert(pvrsval);
  var rest11 = document.getElementById("rest").value;
  var qtyyyt = document.getElementById("qty"+pvrsval).value;
  //alert(qtyyyt);
  var actuval=rest11=Number(rest11)-Number(qtyyyt);
  document.getElementById("rest").value=actuval;
  
  if(rest11!=0){
  document.getElementById("rows").value=rowCount;
  
  var cell1 = row.insertCell(0);
  	var element1 = document.createElement("input");
  	element1.type = "checkbox";
  	element1.name="chkbox[]";
  	cell1.appendChild(element1);
  	
  
  
  
  var cell2 = row.insertCell(1);
  
    var element3 = document.createElement("select");
  element3.name = "contact_id[]";
  element3.className="form-control ui fluid search dropdown email";
  var option1 = document.createElement("option");
    option1.innerHTML = "--Select--";
    option1.value = "";
    element3.appendChild(option1, null);
  <?php
    $contactQuery=$this->db->query("select *from tbl_contact_m where group_name='6'");
    foreach($contactQuery->result() as $getContact){
    ?>
  
    var option2 = document.createElement("option");
    option2.innerHTML = "<?=$getContact->first_name;?>";
    option2.value = "<?=$getContact->contact_id;?>";
    element3.appendChild(option2, null);
    
  <?php }?>
  cell2.appendChild(element3);
  var element5 = document.createElement("input");
  element5.type = "hidden";
  element5.name = "overlock_id[]";
  element5.className="form-control";
  cell2.appendChild(element5);
  
  
  var cell3 = row.insertCell(2);
  	var element4 = document.createElement("input");
  	element4.type = "hidden";
  	element4.name = "text";
  	element4.id = "text";
  	element4.value = "text";
  	cell3.appendChild(element4);
  	
  var cell3 = row.insertCell(3);
  	var element4 = document.createElement("input");
  	element4.type = "number";
  	element4.setAttribute('step','any');
  	element4.setAttribute('min','0');
  	element4.className="form-control";
  	element4.name = "qty[]";
  	element4.id = "qty"+rowCount;
  	element4.onkeyup = function() { checkvalue(this.id); };
  	cell3.appendChild(element4);
  	
  	var element4 = document.createElement("p");
  	//element4.style.display="Block";
  	element4.name = "error[]";
  	element4.value = "*Qty Not Greater Than Rest Value.";
  	element4.id = "error"+rowCount;
  	cell3.appendChild(element4);
  
  
  var cell4 = row.insertCell(4);
  	var element2 = document.createElement("input");
  	element2.type = "date";
  	element2.name = "date[]";
  	element2.className="form-control";
  	cell4.appendChild(element2);
  
  }else{
  	alert("All Quantities Are Filled.");
  }
  }
  
  
  function deleteRow(tableID) {
  	try {
  	var table = document.getElementById(tableID);
  	var rowCount = table.rows.length;
  	for(var i=0; i<rowCount; i++) {
  		var row = table.rows[i];
  		var chkbox = row.cells[0].childNodes[0];
  		if(null != chkbox && true == chkbox.checked) {
  			table.deleteRow(i);
  			rowCount--;
  			i--;
  		}
  
  
  	}
  	}catch(e) {
  		alert(e);
  	}
  }
  
  
  
  function fsv(v)
  {
  
  var sum=0;
  var tableID = document.getElementById("rows").value;
  var totQty = document.getElementById("totQty").value;
  //alert(tableID);
  for(i=1;i<=tableID;i++){
  //alert(i);
  var qqttyy=document.getElementById("qty"+i).value;
  //alert(qqttyy);
  var sum=Number(sum)+Number(qqttyy);
  }
  if(totQty>=sum)
  {
  v.type="submit";
  }
  else
  {
  alert('Total Quantity is Greater than Overlock Sum Quantity.');	
  }
  }
  
  
  function changethevalue(v){
  //alert();
  var spliiit=v.split("btn");
  var ID=spliiit[1];
  //alert(ID);
  var qty=document.getElementById("ed"+ID).value;
  document.getElementById("qty"+ID).value=qty;
  document.getElementById("forfun1"+ID).style.display="Block";
  document.getElementById("forfun"+ID).style.display="none";
  }
  
  
  function CompareDate(v) {
  //alert(v);
  var adate=v;
        var pdate = document.getElementById("pdate").value;
  
  
       if (adate < pdate) {
    		alert("Tailor Date Should be Greater Than or Equal to Cutting Date");
  	document.getElementById("date").value=null;
        }else {
  	
        }
  
    }
  
  
</SCRIPT>
<?php	$this->load->view("footer.php"); ?>
<script>
  function exportTableToExcel(tableID, filename = ''){
   
   	//alert();
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      
      // Specify file name
      filename = filename?filename+'.xls':'Production_<?php echo date('d-m-Y'); ?>.xls';
      
      // Create download link element
      downloadLink = document.createElement("a");
      
      document.body.appendChild(downloadLink);
      
      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      }else{
  
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
      
          // Setting the file name
          downloadLink.download = filename;
          
          //triggering the function
          downloadLink.click();
      }
  }
  
   
   function getspharemap(idVal){
     //alert(idVal);
     var ur = "view_finish_order";
     $.ajax({
       url:ur,
       method:"POST",
       data:{id:idVal},
       success:function(data){
        // alert(data);
        // console.log(data);
         $('#purchaseData').empty().append(data);
       }
     });
   }
  
  
</script>