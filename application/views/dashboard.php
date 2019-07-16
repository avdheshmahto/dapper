<?php
  $this->load->view("header.php");
  $entries = "";
  
   if($this->input->get('entries')!="")
   {
    $entries = $this->input->get('entries');
   }
  
  ?>
<div id="mapSpare" class="modal fade modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-contentMap" id="modal-contentMap">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Part List</h4>
        <div id="getPartMappingData" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
    </div>
  </div>
</div>
<div id="modal-10" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> View Material Quantity Mapping</h4>
        <div id="productqtymap" class="text-center " style="font-size: 15px;color: red;"></div>
      </div>
      <div id="getsparepartqtymappingView">
      </div>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- Main content -->
<div class="main-content">
  <h1 class="page-title">Dashboard</h1>
  <div class="row">
    <!-- Online Signup -->
    <a href="#">
      <div class="col-lg-3 col-sm-6">
        <div class="panel minimal secondary-bg">
          <div class="panel-body">
            <h2 class="no-margins"><strong>&nbsp;</strong></h2>
            <p>Product List</p>
            <div class="float-chart-sm pt-15">
              <div id="online-signup" class="flot-chart-content" style="padding: 0px; position: relative;">
                <canvas class="flot-base" width="200" height="70" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 200px; height: 70px;"></canvas>
                <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                  <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 5px; text-align: center;">J</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 85px; text-align: center;">J</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 101px; text-align: center;">J</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 21px; text-align: center;">F</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 36px; text-align: center;">M</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 68px; text-align: center;">M</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 53px; text-align: center;">A</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 117px; text-align: center;">A</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 133px; text-align: center;">S</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 148px; text-align: center;">O</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 165px; text-align: center;">N</div>
                    <div style="position: absolute; max-width: 15px; top: 57px; font: bold 11px/13px &quot;Source Sans Pro&quot;, sans-serif; color: rgb(214, 216, 219); left: 181px; text-align: center;">D</div>
                  </div>
                </div>
                <canvas class="flot-overlay" width="200" height="70" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 200px; height: 70px;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- /Online Signup -->
    <a href="#">
      <!-- Last Month Sale -->
      <div class="col-lg-3 col-sm-6">
        <div class="panel minimal royalblue-bg">
          <div class="panel-body">
            <h2 class="no-margins"><strong>&nbsp;</strong></h2>
            <p>Contact List</p>
          </div>
          <div class="float-chart-sm">
            <div class="last-month-outer">
              <div id="last-month-sale" class="flot-chart-content" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                <svg height="85" version="1.1" width="243" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.25px;">
                  <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                  <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                  <circle cx="0" cy="42.5" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                  <circle cx="48.81222707423581" cy="54.642857142857146" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                  <circle cx="97.62445414847161" cy="0" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                  <circle cx="145.9061135371179" cy="60.714285714285715" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                  <circle cx="194.1877729257642" cy="6.071428571428569" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                  <circle cx="243" cy="57.67857142857143" r="0" fill="#7e7ac3" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                </svg>
                <div class="morris-hover morris-default-style" style="display: none;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /last month sale -->
    </a>
    <!-- New Visits -->
    <a href="#">
      <div class="col-lg-3 col-sm-6">
        <div class="panel minimal royalblue-bg">
          <div class="panel-body">
            <h2 class="no-margins"><strong>&nbsp;</strong></h2>
            <p>Buyer Order</p>
          </div>
          <div class="float-chart-sm">
            <div class="last-month-outer">
              <div id="last-month-sale" class="flot-chart-content"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /new visits -->
    </a>
    <a href="#">
      <!-- Total Revenu -->
      <div class="col-lg-3 col-sm-6">
        <div class="panel minimal info-bg">
          <div class="panel-body">
            <h2 class="no-margins"><strong>&nbsp;</strong></h2>
            <p>Reports</p>
            <div class="float-chart-sm pt-15">
              <div id="total-revenue" class="flot-chart-content" style="padding: 0px; position: relative;">
                <canvas class="flot-base" width="200" height="70" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 200px; height: 70px;"></canvas>
                <canvas class="flot-overlay" width="200" height="70" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 200px; height: 70px;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- /total revenu -->
  </div>
  <div class="panel-default">
    <?php
      if($this->session->flashdata('flash_msg')!='')
       {
      ?>
    <div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
      <strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
    </div>
    <?php }?> 
    <div id="listingData">
      <div class="row">
        <div class="panel-body">
          <div class="jvectormap-section" id="world-map-markers" style="height: 400px"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <div class="col-md-6 text-left"></div>
          <div class="col-md-6"> <?php echo $pagination; ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view("footer.php");
  ?>
<script>
  // function editItem(v){
  // //alert(v);
  // var pro=v;
  //  var xhttp = new XMLHttpRequest();
  //   xhttp.open("GET", "updateItem?ID="+pro, false);
  //   xhttp.send();
  //   document.getElementById("contentitem").innerHTML = xhttp.responseText;
  // }
  
  
  function changing(v)
  {
    //alert(v);
    var pro=v;
    var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "changesubcatg?ID="+pro, false);
      xhttp.send();
      //alert(xhttp.responseText);
      document.getElementById("subcategory1").innerHTML = xhttp.responseText;
     // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
  }
  

  function getCat(v)
  {
    
    var pro=v;
    var xhttp = new XMLHttpRequest();
    if(v=='33')
    {
    $("#consigneeMapping").show();
    }
    else
    {
      $("#consigneeMapping").hide();
    }
      xhttp.open("GET", "getCat?ID="+pro, false);
      xhttp.send();
      //alert(xhttp.responseText);
      document.getElementById("category").innerHTML = xhttp.responseText;
     // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
  }
  
  
</script> 
<script>
  function exportTableToExcel(tableID, filename = ''){
   
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      
      // Specify file name
      filename = filename?filename+'.xls':'ProductList_<?php echo date('d-m-Y');?>.xls';
      
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
</script>
<script>
  var xport = {
    _fallbacktoCSV: true,  
    toXLS: function(tableId, filename) {   
      this._filename = (typeof filename == 'undefined') ? tableId : filename;
      
      //var ieVersion = this._getMsieVersion();
      //Fallback to CSV for IE & Edge
      if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
        return this.toCSV(tableId);
      } else if (this._getMsieVersion() || this._isFirefox()) {
        alert("Not supported browser");
      }
  
      //Other Browser can download xls
      var htmltable = document.getElementById(tableId);
      var html = htmltable.outerHTML;
  
      this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls'); 
    },
    toCSV: function(tableId, filename) {
      this._filename = (typeof filename === 'undefined') ? tableId : filename;
      // Generate our CSV string from out HTML Table
      var csv = this._tableToCSV(document.getElementById(tableId));
      // Create a CSV Blob
      var blob = new Blob([csv], { type: "text/csv" });
  
      // Determine which approach to take for the download
      if (navigator.msSaveOrOpenBlob) {
        // Works for Internet Explorer and Microsoft Edge
        navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
      } else {      
        this._downloadAnchor(URL.createObjectURL(blob), 'csv');      
      }
    },
    _getMsieVersion: function() {
      var ua = window.navigator.userAgent;
  
      var msie = ua.indexOf("MSIE ");
      if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
      }
  
      var trident = ua.indexOf("Trident/");
      if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf("rv:");
        return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
      }
  
      var edge = ua.indexOf("Edge/");
      if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
      }
  
      // other browser
      return false;
    },
    _isFirefox: function(){
      if (navigator.userAgent.indexOf("Firefox") > 0) {
        return 1;
      }
      
      return 0;
    },
    _downloadAnchor: function(content, ext) {
        var anchor = document.createElement("a");
        anchor.style = "display:none !important";
        anchor.id = "downloadanchor";
        document.body.appendChild(anchor);
  
        // If the [download] attribute is supported, try to use it
        
        if ("download" in anchor) {
          anchor.download = this._filename + "." + ext;
        }
        anchor.href = content;
        anchor.click();
        anchor.remove();
    },
    _tableToCSV: function(table) {
      // We'll be co-opting `slice` to create arrays
      var slice = Array.prototype.slice;
  
      return slice
        .call(table.rows)
        .map(function(row) {
          return slice
            .call(row.cells)
            .map(function(cell) {
              return '"t"'.replace("t", cell.textContent);
            })
            .join(",");
        })
        .join("\r\n");
    }
  };
  
  function viewPartCode(partid){
     
     var ur = 'ajex_getPartCode';
     
     $.ajax({
        type: "POST",
        url: ur,
        data: {'partid':partid},
        success: function(data){
         // alert('sdfsdf');
         // console.log(data);
          $("#getPartMappingData").empty().append(data).fadeIn();
          //$('#partid').val(partid);
          //$('#itemid').val(machineid);
          //$('#mapType').val(mtype);
        }
      });
  
     
  }
  
  
  
  function mapiingPartRowMat(partid,machineid,mtype){
    
     var ur = 'ajex_getPartRowMat';
     $.ajax({
        type: "POST",
        url: ur,
        data: {'partid':partid,'machineid':machineid},
        success: function(data){
         // alert('sdfsdf');
         // console.log(data);
          $("#getsparepartqtymapping").empty().append(data).fadeIn();
       $('#partid').val(partid);
          $('#itemid').val(machineid);
          $('#mapType').val(mtype);
        }
      });
  
     
  }
  
  
  
  function mapiingPartRowMatView(partid,machineid,mtype){
    
     var ur = 'ajex_getPartRowMatView';
     $.ajax({
        type: "POST",
        url: ur,
        data: {'partid':partid,'machineid':machineid},
        success: function(data){
         // alert('sdfsdf');
         // console.log(data);
          $("#getsparepartqtymappingView").empty().append(data).fadeIn();
       $('#partid').val(partid);
          $('#itemid').val(machineid);
          $('#mapType').val(mtype);
      
  
      // $("#btn").prop('disabled', false);
  
      
        }
      });
  
     
  }
  
  
  
   function selectListdata(ths){
  
       
       $("#muom").attr('disabled',false);
       $('#productListData').css('display','none');
       res = ths.value.split("^");
      // alert(res[2]);
       $('#mproductname').val(res[1]);
       $('#mproductid').val(res[0]);
       // $('').val();
       $("#muom").val(res[2]);
       $("#muom").attr('disabled',true);
  
    }
  
  function addpricemap(){
    
   var mproductname =  $('#mproductname').val();
   var mproductid   =  $('#mproductid').val();
   var price        =  $('#mPrice').val();
   var Eprice        =  $('#EPrice').val();
   var muom         =  $('#muom').val();
   var muomval      =  $("#muom option:selected").text();
  //alert(mproductname);
  $('#resultarea').text("");
    
  
    
  $('#prodetails option:selected').remove();
         $('#partTable').append('<tr><td><input type ="hidden" name="prodcId[]" value="'+mproductid+'">'+mproductname+'</td><td><input type ="hidden" name="uom[]" value="'+muom+'">'+muomval+'</td><td><input type ="hidden" name="mproPrice[]" value="'+price+'">'+price+'</td><td><input type ="hidden" name="EPrice[]" value="'+Eprice+'">'+Eprice+'</td><td><i class="fa fa-trash  fa-2x" mproductid="'+mproductid+'" mproductname="'+mproductname+'" id="quotationdel" aria-hidden="true"></i></td></tr>');
  
         $('#mproductname').val("");
         $('#mproductid').val("");
         $('#mPrice').val("");
       $('#EPrice').val("");
         $("#muom").val("");
       $("#prodetails").val("");
       
         $("#select2-prodetails-container").text("--select--");
       
         
    
    }
  
  $("#productpriceMapped").validate({
      rules: {},
        submitHandler: function(form) {
          ur = "ajex_insertMapping";
          var formData = new FormData(form);
              $.ajax({
                   type : "POST",
                   url  :  ur, 
                   //dataType : 'json', // Notice json here
                   data : formData, // serializes the form's elements.
                   success : function (data) {
                  // alert(data);
                  // console.log(data); // show response from the php script.
                   if(data == 1){
                    if(data == 1)
                      var msg = "Mapping Process Successful !";
                       
  
                       $("#resultarea").text(msg); 
                        setTimeout(function() {   //calls click event after a certain time
                         $("#modal-2 .close").click();
                        $("#resultarea").text(" "); 
                         $('#myform')[0].reset(); 
                         $("#id").val("");
                      }, 1000);
                    }else{
                      $("#resultarea").text(data);
                   }
                   //ajex_ItemListData();
                 },
                  error: function(data){
                      alert(data);
                  },
                  cache: false,
                  contentType: false,
                  processData: false
              });
            return false;
          //form.preventDefault();
        }
    });
  
  
  function getEntityRow(thsValue){
        //alert(thsValue+'sdsdf');
        $.ajax({  
          type: "POST",  
        url: "ajax_getentityRows",  
        cache:false,  
        data: {'id':thsValue},  
        success: function(data)  
        {
               // alert(data);
                //console.log(data);
          $("#consigneeTable").empty().append(data).fadeIn();
          amazonEntity();
        }   
        });
      }
    
    
  function getEntityRowOfPartCode(thsValue){
        //alert(thsValue+'sdsdf');
        $.ajax({  
          type: "POST",  
        url: "ajax_getentityRowsOfPart",  
        cache:false,  
        data: {'id':thsValue},  
        success: function(data)  
        {
               // alert(data);
                //console.log(data);
          $("#partTable").empty().append(data).fadeIn();
          amazonEntity();
        }   
        });
      }
    
    
    
    function getEntityRowOfShape(thsValue){
        //alert(thsValue+'sdsdf');
        $.ajax({  
          type: "POST",  
        url: "ajax_getentityShape",  
        cache:false,  
        data: {'id':thsValue},  
        success: function(data)  
        {
                //alert(data);
                //console.log(data);
          $("#consigneeTableShape").empty().append(data).fadeIn();
          amazonEntity();
        }   
        });
      }
    
    
  function getFG()
  {
  
    $("#status").val("13").trigger('chosen:updated');
  
  }


</script>