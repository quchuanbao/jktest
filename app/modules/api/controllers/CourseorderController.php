<?php 
/**
 * 课程表 * @author bao
 * 
 */


class CourseorderController extends Controller 
{
	public $layout='main';
	
	/**
	 * 待审课程用户列表
	 */
	public function actionMemberList(){
		$lastId = $_REQUEST['last_id'];
		$limit = $_REQUEST['limit'];
		$tel = $_REQUEST['tel'];
		if (empty($tel)) {
			$this->showJson(2,'','参数错误！');
		}
		
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->tel = $tel;
		$userInfo = $userModel->search();
		if (empty($userInfo)) {
			$this->showJson(2,'','会员记录不存在！');
		}
		$userInfo = $userInfo[0];
		
		$couseDate = new linkCourseBuy();
		$couseDate->initVar($couseDate);
		$where = " status = 3 and userId ='{$userInfo['id']}' and  usenum < num order by id desc limit 1 ";
		$couseInfo = $couseDate->search($where);
		if (empty($couseInfo)) {
			$this->showJson(2,'','未购买私教课程，或者课程已完结！');
		}
		
		
		$dataModel = new linkCourseOrder();
		$dataModel->initVar($dataModel);
		$where = " userId = '{$userInfo['id']}' ";
		
		if (!empty($lastId)) {
			$where.= " id < $lastId ";
		}
		if (empty($limit)) {
			$limit = 10;
		}
		
		$where.=" order by id desc limit $limit ";
		
		$info = $dataModel->search($where);
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['appointment_id'] = $v['id'];
			$res[$n]['type'] = $v['type'];
			$res[$n]['course_date'] = $v['startDate'];
			$res[$n]['start_time'] = $v['startTime'];
			$res[$n]['endTime'] = $v['endTime'];
			$res[$n]['status'] = $v['status'];
		}
		$this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 学员添加课程
	 */
	public function actionMemberAdd()
	{
		
		$tel = $_REQUEST['tel'];
		if (empty($tel)) {
			$this->showJson(2,'','参数错误！');
		}
		
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->tel = $tel;
		$userInfo = $userModel->search();
		if (empty($userInfo)) {
			$this->showJson(2,'','会员记录不存在！');
		}
		$userInfo = $userInfo[0];
		
		$couseDate = new linkCourseBuy();
		$couseDate->initVar($couseDate);
		$where = " status = 3 and userId = '{$userInfo['id']}' and usenum < num order by id desc limit 1 ";
		$couseInfo = $couseDate->search($where);
		if (empty($couseInfo)) {
			$this->showJson(2,'','未购买私教课程，或者课程已完结！');
		}
		$couseInfo = $couseInfo[0];
		
		$dataModel = new linkCourseOrder();
		$dataModel->initVar($dataModel);
		$where  = " status != 3 and employeeId = '{$couseInfo['employeeId']}' and startDate = '{$_POST['course_date']}' ";
		$es = $dataModel->search($where);
		
		$sTime = strtotime($_POST['course_date']." ".$_POST['start_time'].":00");
		$eTime = strtotime($_POST['course_date']." ".$_POST['end_time'].":00");
		if (!empty($es)) {
			
			foreach ($es as $n => $v) {
				$startTime = strtotime($v['startDate']." ".$v['startTime'].":00");
				$endTime = strtotime($v['startDate']." ".$v['endTime'].":00");
				
				if ($sTime >= $startTime) {
					if ($eTime <= $endTime) {
						$this->showJson(2,'','该时间段教练已有约，请选择其他时间段！');
					} else {
						if ($sTime < $endTime) {
							$this->showJson(2,'','该时间段教练已有约，请选择其他时间段！');
						}
					}
					
				} else {
					if ($eTime > $startTime) {
						$this->showJson(2,'','该时间段教练已有约，请选择其他时间段！');
					}
				}
			}
		}
		
		
		
		$model = new CourseOrderForm('add');
	    $model->userId = $couseInfo['userId'];
	    $model->startDate = $_POST['course_date'];
	    $model->startTime = $_POST['start_time'];
	    $model->endTime = $_POST['end_time'];
	    $model->employeeId = $couseInfo['employeeId'];
	    $model->status = 1;
	    $model->type = 1;
	    $model->cdate = date("Y-m-d H:i:s");
	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	
	    $dataModel = new linkCourseOrder();
	    $dataModel->initVar($dataModel);
	    $saveArray = $model->attributes;
	    $id = $dataModel->save($saveArray);
	    $res['id'] = strval($id);
	    $this->showJson(0,  $res);
	}
	
	
	
	
	
	
	/**
	 * 学员确认课程
	 */
	public function actionMemberConfirm()
	{
	
		$tel = $_REQUEST['tel'];
		$id = $_REQUEST['appointment_id'];
		$confirmType = $_REQUEST['confirm_type'];
		
		if (empty($tel) || empty($id) || empty($confirmType)) {
			$this->showJson(2,'','参数错误！');
		}
	
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->tel = $tel;
		$userInfo = $userModel->search();
		if (empty($userInfo)) {
			$this->showJson(2,'','会员记录不存在！');
		}
		$userInfo = $userInfo[0];
	
		$couseDate = new linkCourseBuy();
		$couseDate->initVar($couseDate);
		$where = " status = 3 and userId = '{$userInfo['id']}' and usenum < num order by id desc limit 1 ";
		$couseInfo = $couseDate->search($where);
		if (empty($couseInfo)) {
			$this->showJson(2,'','未购买私教课程，或者课程已完结！');
		}
		$couseInfo = $couseInfo[0];
        
		$dataModel = new linkCourseOrder();
		$dataModel->initVar($dataModel);
		$dataModel->id = $id;
		$orderInfo = $dataModel->search();
		
		if (empty($orderInfo)) {
		    $this->showJson(2,'','预约课程不存在！');
		}
		$orderInfo = $orderInfo[0];
		
		if ($confirmType == 3) {
			$dataModel = new linkCourseOrder();
			$dataModel->initVar($dataModel);
			$dataModel->id = $id;
			$dataModel->startDate = $_POST['course_date'];
			$dataModel->startTime = $_POST['start_time'];
			$dataModel->endTime = $_POST['end_time'];
			$dataModel->type = 1;
			$dataModel->status = 1;
			$dataModel->modify();
		} else {
			$dataModel = new linkCourseOrder();
			$dataModel->initVar($dataModel);
			$dataModel->id = $id;
			if ($confirmType == 1) {
				$dataModel->status = 2;
				$dataModel->modify();
				//接受，添加到正式课程列表				
				$dataModel = new linkCourse();
				$dataModel->userId = $orderInfo['userId'];
				$dataModel->employeeId = $orderInfo['employeeId'];
				$dataModel->startDate = $orderInfo['startDate'];
				$dataModel->startTime = $orderInfo['startTime'];
				$dataModel->endTime = $orderInfo['endTime'];
				$dataModel->status = 1;
				$dataModel->save();
			}
			if ($confirmType == 2) {
				$dataModel->status = 3;
				$dataModel->modify();
			}
		}
		
		$res = array();
		$this->showJson(0,  $res);
	}
	
	
	
	
	/**
	 * 列表
	 */
	public function actionList()
	{
	
	    $tel = $_REQUEST['tel'];
	    if (empty($tel)) {
	        $this->showJson(2,'','参数错误！');
	    }
	
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->tel = $tel;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,'','会员记录不存在！');
	    }
	    $userInfo = $userInfo[0];
	
	    $couseDate = new linkCourseBuy();
	    $couseDate->initVar($couseDate);
	    $where = " status = 3 and userId = '{$userInfo['id']}' and usenum < num order by id desc limit 1 ";
	    $couseInfo = $couseDate->search($where);
	    if (empty($couseInfo)) {
	        $this->showJson(2,'','未购买私教课程，或者课程已完结！');
	    }
	    $couseInfo = $couseInfo[0];
	
	    
	    
	    $lastId = $_REQUEST['last_id'];
	    $limit = $_REQUEST['limit'];
	    
	    
	    
	    $dataModel = new linkCourseOrder();
	    $dataModel->initVar($dataModel);
	    $where = " status != 3 and employeeId = '{$couseInfo['employeeId']}'  ";
	    
	    if (!empty($lastId)) {
	        $where.= " id < $lastId ";
	    }
	    if (empty($limit)) {
	        $limit = 10;
	    }
	    
	    $where.=" order by id desc limit $limit ";
	    $info = $dataModel->search($where);
	    $res = array();
	    foreach ($info as $n => $v) {
	    	$res[$n]['course_date'] = $v['startDate'];
	    	$res[$n]['start_time'] = $v['startTime'];
	    	$res[$n]['end_time'] = $v['endTime'];
	    }
	    $this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 上完课程列表确认
	 */
	public function actionComplatelist()
	{
	
	    $tel = $_REQUEST['tel'];
	    if (empty($tel)) {
	        $this->showJson(2,'','参数错误！');
	    }
	
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->tel = $tel;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,'','会员记录不存在！');
	    }
	    $userInfo = $userInfo[0];
	
	    $couseDate = new linkCourseBuy();
	    $couseDate->initVar($couseDate);
	    $where = " status = 3 and userId = '{$userInfo['id']}' and usenum < num order by id desc limit 1 ";
	    $couseInfo = $couseDate->search($where);
	    if (empty($couseInfo)) {
	        $this->showJson(2,'','未购买私教课程，或者课程已完结！');
	    }
	    $couseInfo = $couseInfo[0];
	  
	    $lastId = $_REQUEST['last_id'];
	    $limit = $_REQUEST['limit'];

	    $dataModel = new linkCourse();
	    $dataModel->initVar($dataModel);
	    $where = " status != 1 and  userId = '{$couseInfo['userId']}'  ";
	     
	    if (!empty($lastId)) {
	        $where.= " id < $lastId ";
	    }
	    if (empty($limit)) {
	        $limit = 10;
	    }
	     
	    $where.=" order by id desc limit $limit ";
	    $info = $dataModel->search($where);
	    $res = array();
	    foreach ($info as $n => $v) {
	    	$res[$n]['id'] = $v['id'];
	        $res[$n]['course_date'] = $v['startDate'];
	        $res[$n]['start_time'] = $v['startTime'];
	        $res[$n]['end_time'] = $v['endTime'];
	        if ($v['status'] == 2) {
	            $v['status'] = 1;
	        }
	        if ($v['status'] == 3) {
	            $v['status'] = 2;
	        }
	        $res[$n]['status'] = $v['status'];
	    }
	    $this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 确认课程
	 */
	public function actionComconfirm()
	{
	
	    $tel = $_REQUEST['tel'];
	    $id = $_REQUEST['id'];
	    if (empty($tel) || empty($id)) {
	        $this->showJson(2,'','参数错误！');
	    }
	
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->tel = $tel;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,'','会员记录不存在！');
	    }
	    $userInfo = $userInfo[0];
	
	    $couseDate = new linkCourseBuy();
	    $couseDate->initVar($couseDate);
	    $where = " status = 3 and userId = '{$userInfo['id']}' and usenum < num order by id desc limit 1 ";
	    $couseInfo = $couseDate->search($where);
	    if (empty($couseInfo)) {
	        $this->showJson(2,'','未购买私教课程，或者课程已完结！');
	    }
	    $couseInfo = $couseInfo[0];
	     
	    $dataModel = new linkCourse();
	    $dataModel->initVar($dataModel);
	    $dataModel->id = $id;
	    $info = $dataModel->search();
	    if (empty($info)) {
	        $this->showJson(2,'','课程信息不存在！');
	    }
	    
	    $dataModel = new linkCourse();
	    $dataModel->initVar($dataModel);
	    $dataModel->id = $id;
	    $dataModel->status = 3;
	    $dataModel->modify();

	    $res = array();
	    $this->showJson(0,  $res);
	}
	
	
	/**
	 * 设置课程详情
	 */
	public function actionDetail()
	{
		
		$tel = $_REQUEST['tel'];
		$courseId = $_REQUEST['id'];
		if (empty($tel) || empty($courseId)) {
			$this->showJson(2,'','参数错误！');
		}
		
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->tel = $tel;
		$userInfo = $userModel->search();
		if (empty($userInfo)) {
			$this->showJson(2,'','会员记录不存在！');
		}
		$userInfo = $userInfo[0];
		
		$courseModel = new linkCourse();
		$courseModel->initVar($courseModel);
		$courseModel->id = $courseId;
		$courseModel->userId = $userInfo['id'];
		$courseInfo = $courseModel->search();
		$courseInfo = $courseInfo[0];
		if (empty($courseInfo)) {
			$this->showJson(2,'','课程不存在！');
		}
		 
		$courseInfo = $courseModel->apiList($courseId);
		 
		$resultModel = new linkCourseresult();
		$resultInfo = $resultModel->apiList($courseId);
		if ($courseInfo['status'] != 3) {
			$res['status'] = 1;
		} else {
			$res['status'] = 2;
		}
		$res['course_code'] = date("Ymd",strtotime($courseInfo['startDate']))."-".$courseInfo['id'];
		$res['course_type'] = 1;
		$res['member_id'] = $courseInfo['userId'];
		$res['member_name'] = $courseInfo['memberName'];
		$res['member_photo'] = Yii::app()->params['imgurl'].$courseInfo['img'];
		 
		$res['over_lessons'] = intval($courseInfo['usenum']);
		$res['total_lessons'] = $courseInfo['num'];
		$res['course_date'] = $courseInfo['startDate'];
		$res['start_time'] = $courseInfo['startTime'];
		$res['end_time'] = $courseInfo['endTime'];
		 
		foreach ($resultInfo as $n => $v) {
			$res['training_list'][$n]['equipment_code'] = $v['instrumentId'];
			$res['training_list'][$n]['equipment_name'] = $v['instrumentName'];
			$res['training_list'][$n]['body_part_code'] = $v['postionId'];
			$res['training_list'][$n]['body_part_name'] = $v['positionName'];
			$res['training_list'][$n]['action_code'] = $v['actionId'];
			$res['training_list'][$n]['action_name'] = $v['actionName'];
			 
			$res['training_list'][$n]['frequency_code'] = $v['num'];
			$res['training_list'][$n]['frequency'] =   Yii::app()->params['courseNum'][$v['num']];
			 
			$res['training_list'][$n]['intensity_code'] = $v['strength'];
			$res['training_list'][$n]['intensity_name'] = Yii::app()->params['courseStrength'][$v['strength']];
			 
			$res['training_list'][$n]['feel_code'] = $v['feeling'];
			$res['training_list'][$n]['feel_name'] = Yii::app()->params['courseFeeling'][$v['feeling']];
		}
		 
		$this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 学员意见反馈
	 */
	public function actionAdvice()
	{
	
	    $tel = $_REQUEST['tel'];
	    $content = $_REQUEST['content'];
	    if (empty($tel) || empty($content)) {
	        $this->showJson(2,'','参数错误！');
	    }
	
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->tel = $tel;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,'','会员记录不存在！');
	    }
	    $userInfo = $userInfo[0];
	
	    $model = new linkAdvice();
	    $model->initVar($model);
	    $model->userId = $userInfo['id'];
	    $model->content = $content;
	    $model->cdate = date("Y-m-d H:i:s");
	    $model->save();
	    
	    $res = array();
	    $this->showJson(0,  $res);
	}
	
}