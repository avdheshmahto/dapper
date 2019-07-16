<script>
var myWindow;
function openpopup(url,width,height,ev,id) 
{
	window.open(url+"?&popup=True&"+ev+"="+id, "", "width=1398, height=800");
}
</script>
<script>
//####### starts this script is use for popup close #######//
function popupclose(){
window.close();
//####### starts this script is use for popup close #######//
}
</script>
<script>
//####### starts this script is use for select all checkbox #######//
function checkall(objForm)
{
//alert(objForm);
//getCid(this.value);
	var ele,len,i;

	ele= document.getElementsByTagName("input");

	len=ele.length;

	for(i=0;i<len;i++){

	if(ele[i].type=='checkbox'){

		ele[i].checked=objForm;

		}

	}

}
//####### ends this script is use for select all checkbox #######//
</script>

