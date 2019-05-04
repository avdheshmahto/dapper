<select name="">


<option value="">--Select--</option>

<?php
$catQuery=$this->db->query("select *from tbl_category where type='$type' and status = 1");
foreach($catQuery->result() as $getCat){
?>
<option value="<?=$getCat->id;?>"><?=$getCat->name;?></option>

<?php }?>
</select>