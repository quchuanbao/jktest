<?php
class CommonController extends CController
{
	public function actionShowValiate()
	{
		$validate = new sdkValidate();
		echo $validate->show();	
	}
	
	/**
	 * 获取城市
	 */
	function actionGetCity()
	{
		$id = intval($_REQUEST['id']);
		$city = new linkCity();
		$city->initVar($city);
		$city->pid = $id;
		$info = $city->search();
		echo '<option value="" >请选择城市</option>';
		foreach ($info as $n => $v){
			echo "<option value = '".$v['id']."'>".$v['name']."</option>";
		}
	}
	
	/**
	 * 获取城市
	 */
	function actionGetDistrict()
	{
		$id = intval($_REQUEST['id']);
		$model = new linkDistrict();
		$model->initVar($model);
		$model->cityId = $id;
		$info = $model->search();
		echo '<option value="" >请选择地区</option>';
		foreach ($info as $n => $v){
			echo "<option value = '".$v['id']."'>".$v['name']."</option>";
		}
	}
}