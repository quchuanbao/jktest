<?php 
/**
 * 业绩表 * @author bao
 * 
 */


class ResultslogController extends UController 
{
	public $layout='main';
	/**
	 * 获取业绩
	 */
	public function actionGetAll() 
	{
		$date = $_REQUEST['date'];
		if (empty($date)) {
			$this->showJson(2,"","参数不能为空！");
		}
		$dateInfo = explode("-", $date);
		$year = $dateInfo[0];
		$month = $dateInfo[1];
	    $resultModel = new linkResultslog();
		$resultModel->initVar($resultModel);
		$resultModel->employeeId = $this->uid;
		$resultModel->year = $year;
		$resultModel->month = $month;
		$userResInfo = $resultModel->search();
		$userResInfo = $userResInfo[0]; 
		$res['individual_total'] = $userResInfo['num']; //个人业绩总额
		$res['individual_complete'] = $userResInfo['completeNum']; //个人业绩完成额度
		
		$lastYear = date("Y",strtotime("-1month"));
        $lastMonth = date("m",strtotime("-1month"));
		$starInfo = $resultModel->getStarByDate($lastYear, $lastMonth);
		$res['champion_pic'] = Yii::app()->params['imgurl'].$starInfo['img'];
		$res['champion_name'] = $starInfo['realName'];
		$res['champion_complete'] = $starInfo['completeNum'];
		
		$starInfo = $resultModel->getStarByDate($year, $month);
		$res['star_pic'] = Yii::app()->params['imgurl'].$starInfo['img'];
		$res['star_name'] = $starInfo['realName'];
		$res['star_complete'] = $starInfo['completeNum'];
		
		$userModel = new linkEmployee();
		$userModel->initVar($userModel);
		$userModel->id = $this->uid;
		$userInfo = $userModel->search();
		$userInfo = $userInfo[0];
		
		$departmentModel = new linkResultsdepartmentlog();
		$departmentModel->initVar($departmentModel);
		$departmentModel->year = $year;
		$departmentModel->month = $month;
		$departmentModel->departmentId = $userInfo['departmentId'];
		$department = $departmentModel->search();
		$department = $department[0];
		
		$res['department_total'] = $department['num'];
		$res['department_complete'] = $department['completeNum'];
		
		$this->showJson(0,  $res);
	}
	
	/**
	 * 设置个人业绩
	 */
	public function actionSetResults()
	{
		$id = $_REQUEST['staff_id'];
		$num = $_REQUEST['performance_total'];
		if (empty($num)) {
			$this->showJson(2, '' ,"总业绩额要大于零！");
		}
		$model = new linkEmployee();
		$model->initVar($model);
		$model->id = $id;
		$userInfo = $model->search();
		$userInfo = $userInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"用户被禁止登录或不存在！");
		}
		
		$resultsModel = new linkResultslog();
		$resultsModel->initVar($resultsModel);
		$resultsModel->employeeId = $id;
		$resultsModel->year = date("Y");
		$resultsModel->month = date("m");
		$resultsInfo = $resultsModel->search();
		
		if (empty($resultsInfo)) {
			$resultsModel->initVar($resultsModel);
			$resultsModel->employeeId = $id;
			$resultsModel->year = date("Y");
			$resultsModel->month = date("m");
			$resultsModel->num = $num;
			$resultsModel->save();
		} else {
			$resultsModel->initVar($resultsModel);
			$resultsModel->id = $resultsInfo[0]['id'];
			$resultsModel->employeeId = $id;
			$resultsModel->year = date("Y");
			$resultsModel->month = date("m");
			$resultsModel->num = $num;
			$resultsModel->modify();
		}
		$res = array();
		$this->showJson(0,  $res);
	}

	
	/**
	 * 获取业绩列表
	 */
	public function actionList()
	{
		$date = $_REQUEST['year_month'];
		$ids = $_REQUEST['select_staff'];
		if (empty($date) || empty($ids)) {
			$this->showJson(2,"","参数不能为空！");
		}
		
		$dateInfo = explode("-", $date);
		$year = $dateInfo[0];
		$month = $dateInfo[1];
		
		$userModel = new linkEmployee();
		$userModel->initVar($userModel);
		$userModel->id = $this->uid;
		$userInfo = $userModel->search();
		$userInfo = $userInfo[0];
		
		$departmentModel = new linkResultsdepartmentlog();
		$departmentModel->initVar($departmentModel);
		$departmentModel->year = $year;
		$departmentModel->month = $month;
		$departmentModel->departmentId = $userInfo['departmentId'];
		$department = $departmentModel->search();
		$department = $department[0];
		
		$res['month_total'] = $department['num']; //部门业绩总额（月）
		$res['month_complete'] = $department['completeNum'];//部门业绩完成额
		

		$userArray = explode(",", $ids);
		
		
		$resultModel = new linkResultslog();
		$info = $resultModel->getByIds($year, $month, $ids);
		
		$listInfo = array();
		foreach ($info as $n => $v) {
			$listInfo[$n]['staff_id'] = $v['employeeId'];
			$listInfo[$n]['name'] = $v['realName'];
			$listInfo[$n]['performance_total'] = $v['num'];
			$listInfo[$n]['performance_complete'] = $v['completeNum'];
		}
		
		$res['staff_performance'] = $listInfo;
		$this->showJson(0,  $res);
	}
}