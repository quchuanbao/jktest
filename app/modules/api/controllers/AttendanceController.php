<?php 
/**
 * 考勤表 * @author bao
 * 
 */


class AttendanceController extends UController 
{
		
	/**
	 * 任务统计管理用
	 */
	public function actionTotalList()
	{
		$ids = $_REQUEST['select_staff'];
		if (empty($ids)) {
			$ids = $this->uid;
		}
		
		$date = $_REQUEST['year_month'];
		
		if (empty($date)) {
			$this->showJson(2,"","日期参数不能为空！");
		}
		
		$userModel = new linkEmployee();
		$userModel->initVar($userModel);
		$where = " id in ($ids)  ";
		$userInfo = $userModel->search($where);
		$res = array();
		foreach ($userInfo as $n => $v) {
			$res[$n]['staff_id'] = $v['id'];
			$res[$n]['name'] = $v['realName'];
			//迟到早退天数
			$attendanceModel = new linkAttendance();
			$res[$n]['early_out_days'] = $attendanceModel->getLateNum($ids,$date);
			
			//请假天数
			$leaveModel = new linkLeave();
			$res[$n]['leave_days'] = $leaveModel->getLeaveNum($ids,$date);
			
			$res[$n]['work_days'] = date('t', strtotime($date."-01"));
		}
		
		$this->showJson(0, $res);
	}
	
	/**
	 * 我的当月考勤记录
	 */
	public function actionMy()
	{
		$num = intval(date("m"));
		$res = array();
		$leaveModel = new linkLeave();
		$attendanceModel = new linkAttendance();
		for ($i = 1; $i <= $num; $i++) {
			$res[$i-1]['month'] = $i;
			if ($i < 10) {
				$i = "0".$i;
			}
			$date = date("Y"."-".$i);
			$res[$i-1]['work_days'] = date('t', strtotime($date."-01"));
			$res[$i-1]['leave_days'] = $leaveModel->getLeaveNum($this->uid,$date);
			$res[$i-1]['early_out_days'] =  $attendanceModel->getLateNum($this->uid,$date);
		}
		$this->showJson(0, $res);
	}
	
	
}