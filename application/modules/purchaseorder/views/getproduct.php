<?php
  $con1=$_GET['con'];
  $con2=explode("^",$con1);
  $con3=$con2[0];
  $Productctg_id=$con2[1];
  $prdIdd= $_GET['commonProduct'];
  $contactStateQuery=$this->db->query("select *from tbl_contact_m where contact_id='".$_GET['con_id']."'");
  $getContactState=$contactStateQuery->row();
  $getContactState->state_id;
?>

<html lang="en">
  <head>
    <script>
      var x = document.getElementsByClassName("prds");
         function ChangeCurrentCell() 
         {
      
         }
      
         ChangeCurrentCell();
      
         $(document).keydown(function(e)
         {
      
          if (e.keyCode == 37) 
          { 
            currentCell--;
            alert(currentCell);
            // ChangeCurrentCell();     
            return false;
          }
      
          if (e.keyCode == 39)      
      	  { 
            currentCell++;
            //  ChangeCurrentCell();
            return false;
          }
      
      
          if (e.keyCode == 38)
          {       
      	   
            if(currentCell>0)
      	    {
      
              currentCell--;
              //alert(currentCell);
              x[currentCell].focus();
              x[currentCell].select();

            }
            else
            {

              var mx = document.getElementById("ttsp").value;
              currentCell=mx;
              x[currentCell].focus();
              x[currentCell].select();
              currentCell--;
              //alert("Last...");

            }
      
      	    //  alert(currentCell);
                return false;
      
          }
      
      	
          if (e.keyCode == 40)     
      	  { 
      
      	    var mx = document.getElementById("ttsp").value;
      	    if(currentCell<mx)
      
      	    {
      
              x[currentCell].focus();

              x[currentCell].select();

              currentCell++;

              e.preventDefault();

              e.stopPropagation();

              e.returnValue = false;

              //Window.focus()

              //break; 

              //alert(currentCell);

          	}
      
            else

            {

              currentCell=0;

              x[currentCell].focus();

              x[currentCell].select();

              //alert('rowCount'); 		          

              document.getElementById('prdsrch').scrollTop =0;

            }
      
      	}
      
  });
      
      
        var xobj;
      
        //modern browers
      
        if(window.XMLHttpRequest)      
        {      
          xobj=new XMLHttpRequest();      
        }
        //for ie
      
        else if(window.ActiveXObject)      
        {
          xobj=new ActiveXObject("Microsoft.XMLHTTP");
      	}
      
      	else
        {
          alert("Your broweser doesnot support ajax");
        }
             
      
      
      	  function abc(pt,pr,tid,q,u,igst,quantity,reorder,p,cp)
          {
      		       	
        		var qnTT = Number(quantity);
            document.getElementById("reorder").value   = reorder;
            document.getElementById("qty_stock").value = qnTT.toFixed(2);

            var pid=pt.split("^");
            var pids=pid[1];

            var igstt = igst.split("^");
            var igstF = igstt[1];
      
      				if(igst=='NON_TAX')
      				{
      				 document.getElementById("nettot").value=pr;
      				}
      				else
      				{
        				if(igstF=='igst')
        				{
        					var calTot=Number(igstt[0])*Number(pr)/100;
        					document.getElementById("gstTotal").value=calTot;
        					var finalTot=Number(calTot)+Number(pr);
        					document.getElementById("igst").value=igstt[0];
        				}
        
        				if(igstF=='cgst')
        				{
        					var calTot   = Number(igstt[0])*Number(pr)/100;
        					document.getElementById("gstTotal").value=calTot;
        					var finalTot = Number(calTot)+Number(pr);
        
        					//alert(igstF);
        					var cgst=igstt[0]/2;
        					
        					document.getElementById("cgst").value=cgst;
        					document.getElementById("sgst").value=cgst;
        				}
      				}
                         
      				
      				
      				document.getElementById("or_qn").value = cp;
      				document.getElementById("pri_id").value = p;
      			  document.getElementById("prd").value    = pt;      				
      				document.getElementById("prd").value    = pt;
      				document.getElementById("lpr").innerHTML= pr;
      				document.getElementById("lph").value    = pr;
      				document.getElementById("spid").value   = tid;
      				document.getElementById("usunit").value = u;
      				document.getElementById("tot").value    = pr;
      				
      
      				if(igst=='NON_TAX')
      				{
      				 document.getElementById("nettot").value=pr;
      				}
      				else
      				{
      				 document.getElementById("nettot").value=finalTot;
      				}
      			 
              //document.getElementById("quantity").value=q;					
      				//document.getElementById("abqt").value=q;

              document.getElementById("qn_pc").value='';          
              document.getElementById("qn").value='';
      				
      	  }
      
      
      
       
    </script>
  </head>
  <body>
    <?php
      if($con1!="")
      {
       if($prdIdd != ""){
     
       $sel=$this->db->query("select * from tbl_product_stock where type='13' and  sku_no like '%$con1%' and Product_id NOT IN($prdIdd)");
	   }
	   else
	   {
		  
		   $sel=$this->db->query("select * from tbl_product_stock where type='13' and  sku_no like '%$con1%'");
	   }
      
       $i=0;
      
       foreach($sel->result() as $arr)
       {
        
        $c_w= $arr->circle_weight;
        $usageunit=$arr->usageunit;
        $qty=$arr->quantity;
      
        if($_GET['invoice_type']=='GST')
        {
         if($getContactState->state_id=='6')
        {
      	  
      	 $igst=$arr->gst_tax."^"."cgst";  
        }
        else
        {
      	    $igst=$igst=$arr->gst_tax."^"."igst";
      
        }
      
      }
      else
      {
      
      $igst="NON_TAX";  
      
      }
      
      
      
      $product_det1 = $this->db->query("Select * from tbl_master_data where serial_number= '$arr->usageunit'");

      $prod_Details1 = $product_det1->row();

      $usunit=$prod_Details1->keyvalue;		

      $i++;
      $id='d'; 

      $id.=$i; 
      @$countid+= count($id);
      //echo $arr->size;


      $product_det1 = $this->db->query("Select * from tbl_master_data where serial_number= '$arr->usageunit'");

      $prod_Details1 = $product_det1->row();
      
      
  ?>

    <input type="text" id="ty<?php echo $id;?>"  class="prds form-control" value="<?php echo $arr->sku_no.'' ?>" name="<?php echo $id;?>"
      onFocus="abc(this.value,'<?php echo $arr->unitprice_purchase; ?>',this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>','<?php echo $igst; ?>','<?php echo $arr->quantity; ?>','<?php echo $arr->min_re_level; ?>','<?php echo $arr->Product_id; ?>','<?=$c_w;?>')"
      onClick="abc(this.value,'<?php echo $arr->unitprice_purchase; ?>',this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>','<?php echo $igst; ?>','<?php echo $arr->quantity; ?>','<?php echo $arr->min_re_level; ?>','<?php echo $arr->Product_id; ?>','<?=$c_w;?>')" style="width:240px;border:1px solid;" tabindex="-1"  readonly >
   
    <?php }  }  ?>

    <input type="hidden" value="<?php echo $i;?>" id="ttsp" >
    <input type="hidden" id="countid" value="<?php echo $countid;?>">
  </body>
</html>