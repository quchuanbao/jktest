<?php 
/**
 * 衣柜租用 * @author bao
 * 
 */


class WardrobeController extends UController 
{
	/**
	 * 获取衣柜租用记录
	 */
	public function actionMylog()
	{
		$wardrobeModel = new linkWardrobe();
		$wardrobeModel->initVar($wardrobeModel);
		$wardrobeModel->employeeId = $this->uid;
		$info = $wardrobeModel->search(" 1=1  order by id desc limit 50 ");
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['chest_number'] = $v['num'];
			$res[$n]['start_time'] = $v['startDate'];
			$res[$n]['end_time'] = $v['endDate'];
			$res[$n]['rent_status'] = $v['status'];
			$res[$n]['rent_time'] = intval((strtotime($v['endDate']) - strtotime($v['startDate']))/3600);
		}
		$this->showJson(0,  $res);
	}
}