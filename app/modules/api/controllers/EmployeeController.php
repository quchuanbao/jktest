<?php 
/**
 * 员工表 * @author bao
 * 
 */


class EmployeeController extends UController 
{
	/**
	 * 获取用户信息接口
	 */
	public function actionUserInfo()
	{
		$dataModel = new linkEmployee();
		$dataModel->initVar($dataModel);
		$dataModel->id = Yii::app()->session['uid'];
		$dataModel->status = 1;
		$userInfo = $dataModel->search();
		if (empty($userInfo)) {
			$this->showJson(2, '' ,"用户被禁止登录或不存在！");
		}
		
		
		$userInfo = $userInfo[0];
		$user['account'] = $userInfo['tel'];
		$user['name'] = $userInfo['realName'];
		$user['sex'] = Yii::app()->params['sex'][$userInfo['sex']];
		if (!empty($userInfo['img'])) {
			$user['pic'] = Yii::app()->params['imgurl'].$userInfo['img'];
		}
		$user['department'] = $this->getDepartment($userInfo['departmentId']);
		$user['job'] = $this->getPostion($userInfo['positionId']);
		$user['level'] = '0';
		$this->showJson(0, $user);
	}
	
	/**
	 * 会籍管理接口
	 */
    public function actionManageList()
    {
    	$model = new linkEmployee();
    	$model->initVar($model);
    	$model->id = $this->uid;
    	$userInfo = $model->search();
    	$userInfo = $userInfo[0];
        
        $order = $_REQUEST['sort_rule'];
        if (empty($order)) {
        	$order = 1;
        }
        $type = 1;
        if ($userInfo['departmentId'] == 1) {
            //会籍
            $type = 1;
        }
        if ($userInfo['departmentId'] == 2) {
            //教练
            $type = 2;
        }
        $userInfo = $model->apiManageList($userInfo['departmentId'], $userInfo['positionId'], $order ,$type);
    	$res = array();
    	foreach ($userInfo as $n => $v ) {
    		$res[$n]['staff_id'] = $v['id'];
    		$res[$n]['photo'] = Yii::app()->params['imgurl'].$v['img'];
    		$res[$n]['name'] = $v['realName'];
    		$res[$n]['performance_total'] = $v['num'];
    		$res[$n]['performance_complete'] = $v['completeNum'];
    		$res[$n]['associate_count'] = $v['vipNum'];
    		$res[$n]['member_count'] = $v['novipNum'];
    	}
    	$this->showJson(0, $res);
    }
    
    /**
     * 获取员工详情
     */
    public function actionDetail()
    {
    	$id = $_REQUEST['staff_id'];
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
    	
    	$userModel = new linkUser();
    	$userModel->initVar($userModel);
    	$where = " ( memberShipId = '{$id}' or coachId = '{$id}' ) and isvip = 1 ";
    	$vipNum = $userModel->searchCountNum($where);
    	
    	$userModel->initVar($userModel);
    	$where = " ( memberShipId = '{$id}' or coachId = '{$id}' )  and isvip = 2 ";
    	$noVipNum = $userModel->searchCountNum($where);
    	
    	
    	//迟到早退天数
    	$attendanceModel = new linkAttendance();
    	$lateNum = $attendanceModel->getLateNum($id,date("Y-m"));
    	
    	//请假天数
    	$leaveModel = new linkLeave();
    	$leaveNum = $leaveModel->getLeaveNum($id,date("Y-m"));
    	
    	//未完成任务数量
    	$taskModel = new linkTask();
    	$taskModel->initVar($taskModel);
    	$taskNum = $taskModel->getManageDetail($id);
    	
    	
    	$res['photo'] = Yii::app()->params['imgurl'].$userInfo['img'];
    	$res['name'] = $userInfo['realName'];
    	$res['department'] = $this->getDepartment($userInfo['departmentId']);
    	$res['mobile'] = $userInfo['tel'];
    	$res['type'] = $userInfo['departmentId'];
    	$res['performance_total'] = $resultsInfo[0]['num'];
    	$res['performance_complete'] = $resultsInfo[0]['performance_complete'];
    	
    	$res['uncomplete_count'] = $taskNum;
    	
    	$res['associate_count'] = $noVipNum;
    	$res['member_count'] = $vipNum;
    	$res['work_days'] = date("j");
    	$res['leave_days'] = $leaveNum;
    	$res['early_out_days'] = $lateNum;
    	$this->showJson(0, $res);
    	
    }
    
    /**
     * 获取会员，分配或者未分配
     */
    public function actionGetMember()
    {
    	$id = $_REQUEST['staff_id'];
    	$limit = $_REQUEST['limit'];
    	if (empty($limit)) {
    		$limit = 10;
    	}
    	$lastId = $_REQUEST['lastId'];
    	$model = new linkEmployee();
    	$model->initVar($model);
    	$model->id = $id;
    	$userInfo = $model->search();
    	$userInfo = $userInfo[0];
    	if (empty($userInfo)) {
    		$this->showJson(2, '' ,"用户被禁止登录或不存在！");
    	}
    	
    	$type = $_REQUEST['member_type'];
    	if (empty($type)) {
    		$this->showJson(2, '' ,"参数会员类型不能空！");
    	}
    	if ($lastId) {
    		$page =" and id < $lastId ";
    	}
    	
    	if ($userInfo['departmentId'] == 1) { 
    		//会籍部门  未分配会员和准会员
    		$userModel = new linkUser();
    		$userModel->initVar($userModel);
    		$where = "  memberShipId = '' ";
    		$isvip = 2;
    		if ($type == 1) {
    			//准会员
    			$where.= ' and isvip = 2 ';
    		}
    		if ($type == 2) {
    			//会员
    			$where.= ' and isvip = 1 ';
    		}
    		$where.= $page."  order by id desc limit $limit  ";
    		$userInfo = $userModel->search($where);
    	}
    	
    	
    	if ($userInfo['departmentId'] == 2) {
    		//教练部门  未分配学员和准学员
    		$userModel = new linkUser();
    		$userModel->initVar($userModel);
    		$where = "  coachId = '' ";
    		$isvip = 2;
    		if ($type == 1) {
    			//准学员
    			$where.= ' and isvip = 2 and iscoach = 1 ';
    		}
    		if ($type == 2) {
    			//会员
    			$where.= ' and isvip = 1 and iscoach = 2 ';
    		}
    		$where.= $page."  order by id desc limit $limit  ";
    		$userInfo = $userModel->search($where);
    	}
    	
    	
    	
    	$res = array();
    	foreach ($userInfo as $n => $v) {
    		$res[$n]['member_id'] = $v['id'];
    		$res[$n]['photo'] = Yii::app()->params['imgurl'].$v['img'];
    		$res[$n]['name'] = $v['realName'];
    		$visitModel = new linkVisitlog();
    		$visitInfo = $visitModel->getUserList($v['id'],1);
    		$visitInfo = $visitInfo[0];
    		$res[$n]['visitor'] = $visitInfo['realName'];
    		$res[$n]['visit_count'] = $visitModel->getUserListCount($v['id']);
    	}
    	$this->showJson(0, $res);
    }
    
    /**
     * 划分和取消划分
     */
    public function actionDistribut() {
    	
    	$data = json_decode($_REQUEST['data']);
    	 
    	$id = $_REQUEST['staff_id'];
    	$model = new linkEmployee();
    	$model->initVar($model);
    	$model->id = $id;
    	$userInfo = $model->search();
    	$userInfo = $userInfo[0];
    	if (empty($userInfo)) {
    		$this->showJson(2, '' ,"用户".$userInfo['realName']."被禁止登录或不存在！");
    	}
    	
    	
    	$pushids = implode(',',json_decode($_REQUEST['push_member']));
    	$popids = implode(',',json_decode($_REQUEST['pop_member']));
    		
    	
    	if ($userInfo['departmentId'] == 1) {
    		//会籍部门
    		$userModel = new linkUser();
    		if ($pushids) {
    			$sql = " update user set memberShipId = '{$id}' where id in ({$pushids}) ";
    			$userModel->getDistribut($sql);
    		}
    		if ($popids) {
    			$sql = " update user set memberShipId = '' where id in ({$popids}) ";
    			$userModel->getDistribut($sql);
    		}
    	}
    	
    	if ($userInfo['departmentId'] == 2) {
    		//教练部门
    		$userModel = new linkUser();
    		if ($pushids) {
    			$sql = " update user set coachId = '{$id}' where id in ({$pushids}) ";
    			$userModel->getDistribut($sql);
    		}
    		if ($popids) {
    			$sql = " update user set coachId = '' where id in ({$popids}) ";
    			$userModel->getDistribut($sql);
    		}
    	}
    	$res = array();
    	$this->showJson(0, $res);
    }
    
    /**
     * 获取公司通讯录
     */
    public function actionContact()
    {
    	$departMentModel = new linkDepartment();
    	$departMentModel->initVar($departMentModel);
    	$departMentInfo = $departMentModel->search();
    	$res = array();
    	foreach ($departMentInfo as $n => $v) {
    		$res[$n]['department'] = $v['name'];
    		$res[$n]['department_id'] = $v['id'];
    		$employeeModel = new linkEmployee();
    		$employeeModel->initVar($employeeModel);
    		$employeeModel->departmentId = $v['id'];
    		$info = $employeeModel->search();
    		$res[$n]['staff_list'] = array();
    		foreach ($info as $n1 => $v1) {
    			$res[$n]['staff_list'][$n1]['staff_id'] = $v1['id'];
    			$res[$n]['staff_list'][$n1]['photo'] = Yii::app()->params['imgurl'].$v1['img'];
    			$res[$n]['staff_list'][$n1]['name'] = $v1['realName'];
    			$res[$n]['staff_list'][$n1]['job'] = $this->getPostion($v1['positionId']);
    			$res[$n]['staff_list'][$n1]['mobile'] = $v1['tel'];
    			$res[$n]['staff_list'][$n1]['age'] = date("Y")-date("Y",strtotime($v1['born']));
    		}
    	}
    	$this->showJson(0, $res);
    }
    
    //设置座标
    public function actionSetCoordinate()
    {
        $lat = $_REQUEST['latitude'];
        $lng = $_REQUEST['longitude'];
        $ids = $this->uid;
        $employeeModel = new linkEmployee();
        $employeeModel->setCoordinate($ids,$lat,$lng);
        $res = array();
        $this->showJson(0, $res);
    }
    
    //设置座标
    public function actionGetCoordinate()
    {
        $ids = $_REQUEST['staff_ids'];
        if (empty($ids)) {
            $this->showJson(2, '' ,"参数错误！");
        }
        $employeeModel = new linkEmployee();
        $info = $employeeModel->GetCoordinate($ids);
        $res = array();
        foreach ($info as $n => $v) {
        	$res[$n]['staff_id'] = $v['id'];
        	$res[$n]['latitude'] = $v['lat'];
        	$res[$n]['longitude'] = $v['lng'];
        }
        $this->showJson(0, $res);
    }
    
	
}