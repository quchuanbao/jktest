<script src="/static/admin/js/common.js" type="text/javascript" ></script>
<select id="province" name="province" onchange="getCity(this.value)" >
<option value="" >请选择省份</option>
<?php
	foreach ($info as $n => $v){
		$flag = '';
		if ($v['id'] == $_REQUEST['province']) {
			$flag = 'selected="selected"';
		}
		
		echo "<option ".$flag." value = '".$v['id']."'>".$v['name']."</option>";
	}
?>
</select>&nbsp;-&nbsp;<select id="city" name="city" onchange="getDistrict(this.value)" >
<option  value="" >请选择城市</option>
<?
	if (!empty($cityInfo)) {
		foreach ($cityInfo as $n => $v){
			$flag = '';
			if ($v['id'] == $_REQUEST['city']) {
				$flag = 'selected="selected"';
			}
			
			echo "<option ".$flag." value = '".$v['id']."'>".$v['name']."</option>";
		}
	}
?>
</select>&nbsp;-&nbsp;<select id="district" name="district" >
<option value="" >请选择地区</option>
<?
	if (!empty($districtInfo)) {
		foreach ($districtInfo as $n => $v){
			$flag = '';
			if ($v['id'] == $_REQUEST['district']) {
				$flag = 'selected="selected"';
			}
			
			echo "<option ".$flag." value = '".$v['id']."'>".$v['name']."</option>";
		}
	}
?>
</select>