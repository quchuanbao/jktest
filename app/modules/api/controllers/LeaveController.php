<?php 
/**
 *  请假表 * @author bao
 * 
 */


class LeaveController extends UController 
{
	/**
	 *  请假审核列表
	 */
	public function actionAuditList()
	{
		$status = intval($_REQUEST['audit_status']);
		
		$model = new linkEmployee();
		$model->initVar($model);
		$model->id = $this->uid;
		$userInfo = $model->search();
		$userInfo = $userInfo[0];		
		$leaveModel = new linkLeave();
		$leaveInfo = $leaveModel->getAuditList($userInfo['departmentId'], $status);
		$res = array();
		foreach ($leaveInfo as $n => $v) {
			$res[$n]['staff_id'] = $v['employeeId'];
			$res[$n]['photo'] = Yii::app()->params['imgurl'].$v['img'];
			$res[$n]['name'] = $v['realName'];
			$res[$n]['leave_code'] = $v['id'];
			$res[$n]['submit_time'] = $v['cdate'];
			$res[$n]['audit_time'] = $v['auditDate'];
		}
		$this->showJson(0, $res);
	}
	
	

	/**
	 *  请假详情
	 */
	public function actionDetail()
	{
		$uid = $_REQUEST['staff_id'];
		$id = $_REQUEST['leave_code'];
		$model = new linkEmployee();
		$model->initVar($model);
		$model->id = $uid;
		$userInfo = $model->search();
		$userInfo = $userInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"用户".$userInfo['realName']."被禁止登录或不存在！");
		}
		
		$leaveModel = new linkLeave();
		$leaveModel->initVar($leaveModel);
		$leaveModel->id = $id;
		$leaveModel->employeeId = $uid;
		$leaveInfo = $leaveModel->search();
		$leaveInfo = $leaveInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"请假单不存在！");
		}
		
		$res = array();
		$res['photo'] =  Yii::app()->params['imgurl'].$userInfo['img'];
		$res['name'] =  $userInfo['realName'];
		$res['photo'] =  $userInfo['img'];
		$res['department'] =  $this->getDepartment($userInfo['departmentId']);
		$res['mobile'] =  $userInfo['tel'];
		
		$resultsModel = new linkResultslog();
		$resultsModel->initVar($resultsModel);
		$resultsModel->employeeId = $uid;
		$resultsModel->year = date("Y");
		$resultsModel->month = date("m");
		$resultsInfo = $resultsModel->search();
		
		$res['performance_total'] =  $resultsInfo[0]['num'];
		$res['performance_complete'] =  $resultsInfo[0]['performance_complete'];
		
		//未完成任务数量
		$taskModel = new linkTask();
		$taskModel->initVar($taskModel);
		$res['uncomplete_count'] = $taskModel->getManageDetail($uid);
		
		$date = date("Y-m");
		//迟到早退天数
		$attendanceModel = new linkAttendance();
		$res['early_out_days'] = $attendanceModel->getLateNum($uid,$date);
			
		//请假天数
		$leaveModel = new linkLeave();
		$res['leave_days'] = $leaveModel->getLeaveNum($uid,$date);
			
		$res['work_days'] = date('t', strtotime($date."-01"));
		
		
		$res['leave_start_date'] =  $leaveInfo['startDate'];
		$res['leave_end_date'] =  $leaveInfo['endDate'];
		$res['leave_reason'] =  $leaveInfo['reason'];
		$res['apply_time'] =  $leaveInfo['cdate'];
		
		$this->showJson(0, $res);
	}
	
	/**
	 * 获取历史记录
	 */
	public function actionHistory()
	{
		$id = $_REQUEST['staff_id'];
		if (empty($id)) {
			$id = $this->uid;
		}
		
		$leaveModel = new linkLeave();
		$leaveModel->initVar($leaveModel);
		$where = " employeeId = $id order by id desc limit 50 ";
		$leaveInfo = $leaveModel->search($where);
		$res = array();
		foreach ($leaveInfo as $n => $v) {
			$res[$n]['leave_start_date'] = $v['startDate'];
			$res[$n]['leave_end_date'] = $v['endDate'];
			$res[$n]['leave_days'] = round( ( strtotime($v['endDate']) - strtotime($v['startDate']) )/3600/24) + 1;
			$res[$n]['leave_reason'] = $v['reason'];
			$res[$n]['apply_time'] = $v['cdate'];
			$res[$n]['audit_time'] = $v['auditDate'];
		}
		$this->showJson(0, $res);
	}
	
	

	/**
	 * 提交审核
	 */
	public function actionAudit()
	{
		$uid = $_REQUEST['staff_id'];
		$id = $_REQUEST['leave_code'];
		$approve = $_REQUEST['approve'];
		if (empty($approve)) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		$model = new linkEmployee();
		$model->initVar($model);
		$model->id = $uid;
		$userInfo = $model->search();
		$userInfo = $userInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"用户".$userInfo['realName']."被禁止登录或不存在！");
		}
		
		$leaveModel = new linkLeave();
		$leaveModel->initVar($leaveModel);
		$leaveModel->id = $id;
		$leaveModel->employeeId = $uid;
		$leaveInfo = $leaveModel->search();
		$leaveInfo = $leaveInfo[0];
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"请假单不存在！");
		}
		
		$leaveModel = new linkLeave();
		$leaveModel->initVar($leaveModel);
		$leaveModel->id = $id;
		$leaveModel->leaderId = $this->uid;
		$leaveModel->status = $approve;
		$leaveModel->audit = $_REQUEST['audit_opinion'];
		$leaveModel->auditDate = date("Y-m-d H:i:s");
		$leaveModel->modify();
		$res = array();
		$this->showJson(0, $res);
	}
	
	/**
	 * 请假
	 */
	public function actionApply()
	{
		$startDate = $_REQUEST['start_date'];
		$endDate = $_REQUEST['end_date'];
		
		$reason = $_REQUEST['reason'];
		if (empty($startDate) || empty($endDate) || empty($reason) ) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		$leaveModel = new linkLeave();
		$leaveModel->initVar($leaveModel);
		$leaveModel->employeeId = $this->uid;
		$leaveModel->startDate = date("Y-m-d H:i:s",strtotime($startDate));
		$leaveModel->endDate = date("Y-m-d H:i:s",strtotime($endDate));
		$leaveModel->cdate = date("Y-m-d H:i:s");
		$leaveModel->reason = $reason;
		$leaveModel->save();
		$res = array();
		$this->showJson(0, $res);
	}
	
}