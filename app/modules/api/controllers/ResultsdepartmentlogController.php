<?php 
/**
 * 部门业绩表 * @author bao
 * 
 */


class ResultsdepartmentlogController extends UController 
{
/**
	 * 设置个人业绩
	 */
	public function actionSetResults()
	{
		$id = $_REQUEST['staff_id'];
		$num = $_REQUEST['department_total'];
		if (empty($num)) {
			$this->showJson(2, '' ,"总业绩额要大于零！");
		}
		$model = new linkEmployee();
		$model->initVar($model);
		$model->id = $this->uid;
		$userInfo = $model->search();
		$userInfo = $userInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"用户被禁止登录或不存在！");
		}
		
		$resultsModel = new linkResultsdepartmentlog();
		$resultsModel->initVar($resultsModel);
		$resultsModel->departmentId = $userInfo['departmentId'];
		$resultsModel->year = date("Y");
		$resultsModel->month = date("m");
		$resultsInfo = $resultsModel->search();
		
		if (empty($resultsInfo)) {
			$resultsModel->initVar($resultsModel);
			$resultsModel->departmentId = $userInfo['departmentId'];
			$resultsModel->year = date("Y");
			$resultsModel->month = date("m");
			$resultsModel->num = $num;
			$resultsModel->save();
		} else {
			$resultsModel->initVar($resultsModel);
			$resultsModel->id = $resultsInfo[0]['id'];
			$resultsModel->departmentId = $userInfo['departmentId'];
			$resultsModel->year = date("Y");
			$resultsModel->month = date("m");
			$resultsModel->num = $num;
			$resultsModel->modify();
		}
		$res = array();
		$this->showJson(0,  $res);
	}
}