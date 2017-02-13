<?php 
/**
 * 任务表 * @author bao
 * 
 */


class TaskController extends UController 
{
	public $layout='main';
	/**
	 * 显示任务表 
	 */
	public function actionList() 
	{
		$date = $_REQUEST['date'];
		$lastId = $_REQUEST['listId'];
		$limit = $_REQUEST['limit'];
		
		$dataModel = new linkTask();
		$listInfo = $dataModel->getList($this->uid, $lastId ,$date, $limit);
		$res = array();
		foreach ($listInfo as $n => $v) {
			$res[$n]['id'] = $v['id'];
			$res[$n]['name'] = $v['content'];
			$res[$n]['create_date'] = $v['cdate'];
			$res[$n]['remind'] = 0;
			if ($v['noticeDate'] != "0000-00-00 00:00:00") {
				$res[$n]['remind'] = 1;
			}
			$res[$n]['remind_time'] = $v['noticeDate'];
			
			$res[$n]['complete'] = 0;
			if ($v['status'] == 1) {
				$res[$n]['complete'] = 0;
			}
			if ($v['status'] == 2) {
				$res[$n]['complete'] = 1;
			}
			if ($v['complete'] == "0000-00-00 00:00:00"){
				$v['complete'] = '';
			}
			$res[$n]['complete_time'] = $v['complete'];
			
			$res[$n]['dispatch'] = 0;
			$res[$n]['job'] = '';
			if ($v['dispatcher'] ) {
				$res[$n]['dispatch'] = 1;
				$res[$n]['job'] = $this->getPostion($v['positionId']);
			}
			$res[$n]['dispatcher'] = $v['dispatcher'];
			$res[$n]['dispatcher_id'] = $v['leaderId'];
			
			$res[$n]['remark'] = $v['remark'];
		}
		
		$this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 添加任务
	 */
	public function actionUserAdd()
	{
		$id = $_POST['id'];
		
		$model = new TaskForm('add');
		$model->content = $_POST['name'];
		$model->employeeId = $this->uid;
		
		$model->noticeDate = $_POST['remind_time'];
		if ($_POST['complete']) {
			$model->status = 2;
		} else {
			$model->status = 1;
		}
		$model->complete = $_POST['complete_time'];
		$model->leaderId = $_POST['dispatcher_id'];
		$model->remark = $_POST['remark'];
		
		if ( !$model->validate() ) {
			$errors = $model->getErrors();
			$this->showFormError($errors);
		}
		
		if ($id) {
			$dataModel = new linkTask();
			$dataModel->initVar($dataModel);
			$dataModel->id = $id;
			$dataModel->employeeId = $this->uid;
			if (!empty($model->content)) {
				$dataModel->content = $model->content;
			}
			if (!empty($model->noticeDate)) {
				$dataModel->noticeDate = $model->noticeDate;
			}
			if (!empty($model->status)) {
				$dataModel->status = $model->status;
			}
			if (!empty($model->complete)) {
				$dataModel->complete = $model->complete;
			}
			if (!empty($model->leaderId)) {
				$dataModel->leaderId = $model->leaderId;
			}
			if (!empty($model->remark)) {
				$dataModel->remark = $model->remark;
			}
			$dataModel->modify();
		} else {
			$dataModel = new linkTask();
			$dataModel->initVar($dataModel);
			$model->cdate = date("Y-m-d H:i:s");
			$saveArray = $model->attributes;
			$id = $dataModel->save($saveArray);
		}
		if ( $model->cdate ){
			$res['create_date'] =  $model->cdate;
		} else {
			$dataModel = new linkTask();
			$dataModel->initVar($dataModel);
			$model->id = $id;
			$task = $dataModel->search();
			$res['create_date'] =  $task[0]['cdate'];
		}
		$res['id'] = strval($id);
		$this->showJson(0,  $res);
	}

	
	/**
	 *  删除任务表	 
	 */
	public function actionUserDel()
	{
		
		$ids = $_REQUEST['id'];
		if (empty($ids)) {
			$this->showJson(2,'','参数不能为空！');
		}
		$dataModel = new linkTask();
		$dataModel->initVar($dataModel);
		$dataModel->delById($this->uid, $ids);
		$this->showJson(0,  array());
	}
	
	/**
	 * 获取子任务列表
	 */
	public function actionChirldList()
	{
		$id = $_REQUEST['parent_id'];
		$model = new linkTask();
		$model->initVar($model);
		$model->id = $id;
		$taskInfo = $model->search();
		if (empty($taskInfo)) {
			$this->showJson(2,"","任务不存在！");
		}
		
		$model->initVar($model);
		$chirldList = $model->getChirldList($id);
		$res = array();
		foreach ($chirldList as $n => $v) {
			$res[$n]['id'] = $v['id'];
			$res[$n]['parent_id'] = $v['parentId'];
			$res[$n]['name'] = $v['content'];
			$res[$n]['create_date'] = $v['cdate'];
			$res[$n]['complete'] = 0;
			if ($v['status'] == 1) {
				$res[$n]['complete'] = 0;
			}
			if ($v['status'] == 2) {
				$res[$n]['complete'] = 1;
			}
			if ($v['complete'] == "0000-00-00 00:00:00"){
				$v['complete'] = '';
			}
			$res[$n]['complete_time'] = $v['complete'];
		}
		$this->showJson(0,  $res);	
	}
	
	
	
	/**
	 * 添加子任务
	 */
	public function actionAddChirld()
	{
	    
	    $data = json_decode($_REQUEST['data']);
	    
	    if (empty($data[0]->parent_id)) {
	    	$this->showJson(2,"","参数错误！");
	    }
	    
	    foreach ($data as $n => $v) {
	    	$v = (array)$v;
	    	$parentId = $v['parent_id'];
	    	$dataModel = new linkTask();
	    	$dataModel->initVar($dataModel);
	    	$model->id = $parentId;
	    	$leaderTask = $dataModel->search();
	    	if (empty($leaderTask)) {
	    		$this->showJson(2,"","任务不存在！");
	    	}
	    	
	    	$id = $v['id'];
	    	$model = new TaskForm('addChirld');
	    	$model->content = $v['name'];
	    	$model->employeeId = $this->uid;
	    	$model->parentId = $parentId;
	    	$model->noticeDate = $v['remind_time'];
	    	if ($v['complete']) {
	    		$model->status = 2;
	    	} else {
	    		$model->status = 1;
	    	}
	    	$model->complete = $v['complete_time'];
	    	if ( !$model->validate() ) {
	    		$errors = $model->getErrors();
	    		$this->showFormError($errors);
	    	}
	    	
	    	if ($id) {
	    		$dataModel = new linkTask();
	    		$dataModel->initVar($dataModel);
	    		$dataModel->id = $id;
	    		if (!empty($model->content)) {
	    			$dataModel->content = $model->content;
	    		}
	    		if (!empty($model->noticeDate)) {
	    			$dataModel->noticeDate = $model->noticeDate;
	    		}
	    		if (!empty($model->status)) {
	    			$dataModel->status = $model->status;
	    		}
	    		if (!empty($model->complete)) {
	    			$dataModel->complete = $model->complete;
	    		}
	    		$dataModel->modify();
	    	} else {
	    		$dataModel = new linkTask();
	    		$dataModel->initVar($dataModel);
	    		$model->cdate = date("Y-m-d H:i:s");
	    		$saveArray = $model->attributes;
	    		$dataModel->save($saveArray);
	    	}
	    	
	    	if ( $model->cdate ){
	    		$res[$n]['create_date'] =  $model->cdate;
	    	} else {
	    		$dataModel = new linkTask();
	    		$dataModel->initVar($dataModel);
	    		$model->id = $id;
	    		$task = $dataModel->search();
	    		$res[$n]['create_date'] =  $task[0]['cdate'];
	    	}
	    	$res[$n]['create_date'] =  $model->cdate;
	    	$res[$n]['parent_id'] = strval($parentId);
	    	
	    }
	    $this->showJson(0,  $res);
	}
	
	
	/**
	 *  删除任务表
	 */
	public function actionChirldDel()
	{
	
		$ids = $_REQUEST['id'];
		if (empty($ids)) {
			$this->showJson(2,'','参数不能为空！');
		}
		$parentId = $_REQUEST['parent_id'];
		if (empty($parentId)) {
			$this->showJson(2,'','父任务参数不能为空！');
		}
		$dataModel = new linkTask();
		$dataModel->initVar($dataModel);
		$dataModel->delByChirldId($this->uid, $ids, $parentId);
		$this->showJson(0,  array());
	}
	
	
	
	/**
	 * 分派任务
	 */
	public function actionDispatcher()
	{
		$ids = $_REQUEST['select_staff'];
		if (empty($ids)) {
			$this->showJson(2,'','参数不能为空！');
		}
		
		$employeeInfo = explode(",", $ids);
		$res = array();
		foreach ($employeeInfo as $n => $v) {
			$model = new TaskForm('add');
			$model->content = $_POST['task_name'];
			$model->employeeId = $v;
			$model->noticeDate = $_POST['remind_time'];
			$model->leaderId = $this->uid;
			$model->remark = $_POST['remark'];
			
			if ( !$model->validate() ) {
				$errors = $model->getErrors();
				$this->showFormError($errors);
			}
			
			$dataModel = new linkTask();
			$dataModel->initVar($dataModel);
			$model->cdate = date("Y-m-d H:i:s");
			$model->status = 1;
			$saveArray = $model->attributes;
			$id = $dataModel->save($saveArray);
			
			$chirldTask = json_decode($_POST['subtask_list']);
			if (!empty($chirldTask)) {
				foreach ($chirldTask as $n1 => $v1) {
					$dataModel = new linkTask();
					$dataModel->initVar($dataModel);
					$dataModel->content = $v1;
					$dataModel->employeeId = $v;
					$dataModel->leaderId = $this->uid;
					$dataModel->parentId = $id;
					$dataModel->status = 1;
					$model->cdate = date("Y-m-d H:i:s");
					$dataModel->save();
				}
			}
			
			$res[$n]['create_date'] =  $model->cdate;
			$res[$n]['id'] = strval($id);
		}
		
		
		$this->showJson(0,  $res);
	}
	
	/**
	 * 任务汇总
	 */
	public function actionTotal()
	{
	    $startDate = $_REQUEST['start_date'];
	    $endDate = $_REQUEST['end_date'];
	    if (empty($startDate) || empty($endDate)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    
	    $taskModel = new linkTask();
	    $days = round( (strtotime($endDate) - strtotime($startDate) )/3600/24);
	    
	    for ($i=0; $i<=$days; $i++){
	        $res[$i]['week_day'] =  date("N",strtotime($endDate)-86400*$i);
	        $date = date("Y-m-d",strtotime($endDate)-86400*$i);
	        
	        $s = $date." 00:00:00";
	        $e = $date." 23:59:59";
	        $info = $taskModel->getBydate($this->uid, $s, $e);
	        $res[$i]['task_list'] = array();
            $cmNum = 0;
        	foreach ($info as $n => $v) {
        		if ($v['complete'] != "0000-00-00 00:00:00") {
        			$cmNum++;
        		}
        		$res[$i]['task_list'][$n] = $v['content'];
        	}
	        
        	if ($cmNum) {
        	    $res[$i]['complete_percent'] = ($cmNum/count($info)) * 100;
        	    $res[$i]['complete_percent'] = $res[$i]['complete_percent']."%";
        	} else {
        	    $res[$i]['complete_percent'] = "0%";
        	}
	    }
        $this->showJson(0,  $res);
	}
	
	/**
	 * 任务搜索
	 */
	public function actionSearch()
	{
	    $keyword = trim($_REQUEST['search_name']);
	    if (empty($keyword)) {
	        $this->showJson(2,"","参数不能为空！");
	    }

	    $lastId = $_REQUEST['last_id'];
	    $limit = $_REQUEST['page_size'];
	    
	    $dataModel = new linkTask();
	    $listInfo = $dataModel->getSearch($this->uid, $keyword , $lastId , $limit);
	    $res = array();
	    foreach ($listInfo as $n => $v) {
	        $res[$n]['id'] = $v['id'];
	        $res[$n]['name'] = $v['content'];
	        $res[$n]['create_date'] = $v['cdate'];
	        $res[$n]['remind'] = 0;
	        if ($v['noticeDate'] != "0000-00-00 00:00:00") {
	            $res[$n]['remind'] = 1;
	        }
	        $res[$n]['remind_time'] = $v['noticeDate'];
	        	
	        $res[$n]['complete'] = 0;
	        if ($v['status'] == 1) {
	            $res[$n]['complete'] = 0;
	        }
	        if ($v['status'] == 2) {
	            $res[$n]['complete'] = 1;
	        }
	        if ($v['complete'] == "0000-00-00 00:00:00"){
	            $v['complete'] = '';
	        }
	        $res[$n]['complete_time'] = $v['complete'];
	        	
	        $res[$n]['dispatch'] = 0;
	        $res[$n]['job'] = '';
	        if ($v['dispatcher'] ) {
	            $res[$n]['dispatch'] = 1;
	            $res[$n]['job'] = $this->getPostion($v['positionId']);
	        }
	        $res[$n]['dispatcher'] = $v['dispatcher'];
	        $res[$n]['remark'] = $v['remark'];
	    }
	    $this->showJson(0,  $res);
	}
	
	
	/**
	 * 获取教练或者会籍任务
	 */
	public function actionGetManage()
	{
	    $status = $_REQUEST['task_status'];
	    $date = $_REQUEST['date'];
	    if (empty($date) ){
	    	$date = date("Y-m-d");
	    }
	    if ($status == 1) {
	        $status = 2;
	    } else {
	        $status = 1;
	    }
	    $dataModel = new linkTask();
	    $listInfo = $dataModel->getManageList($this->uid,$date, $status);
	    $res = array();
	    foreach ($listInfo as $n => $v) {
	        $res[$n]['staff_id'] = $v['employeeId'];
	        $res[$n]['photo'] = Yii::app()->params['imgurl'].$v['img'];
	        $res[$n]['name'] = $v['realName'];
	        $res[$n]['last_task_time'] = $v['cdate'];
	        $res[$n]['task_desc'] = $v['content'];
	    }
	    $info['task_count'] = count($listInfo);
	    $info['task_list'] = $res;
	    $this->showJson(0,  $info);
	}
	
	/**
	 * 任务统计管理用
	 */
	public function actionTotalList()
	{
		$ids = $_REQUEST['select_staff'];
		$startDate = $_REQUEST['start_date'];
		$endDate = $_REQUEST['end_date'];
		if (empty($startDate) || empty($endDate) || empty($ids) ) {
			$this->showJson(2,"","参数不能为空！");
		}
		
		$res = array();
		$taskModel = new linkTask();
		$days = round( (strtotime($endDate) - strtotime($startDate) )/3600/24);
		 
		for ($i=0; $i<=$days; $i++){
			$date = date("Y-m-d",strtotime($endDate)-86400*$i);
			$s = $date." 00:00:00";
			$e = $date." 23:59:59";
			
			
			$res[$i]['date'] = $date;
			
			
			$res[$i]['staff_list'] = array();
			$userModel = new linkEmployee();
			$userModel->initVar($userModel);
			$where = " id in ($ids)  ";
			$userInfo = $userModel->search($where);
			
			foreach ($userInfo as $n => $v) {
				$res[$i]['staff_list'][$n]['staff_id'] = $v['id'];
				$res[$i]['staff_list'][$n]['name'] = $v['realName'];
				
				$info = $taskModel->getBydate($v['id'], $s, $e);
				$res[$i]['staff_list'][$n]['task_list'] = array();
				foreach ($info as $n1 => $v1) {
				    $res[$i]['staff_list'][$n]['task_list'][$n1]['uuid'] = $v1['id'];
				    $res[$i]['staff_list'][$n]['task_list'][$n1]['name'] = $v1['content'];
				    if ($v['leaderId']) {
				        $res[$i]['staff_list'][$n]['task_list'][$n1]['dispatch'] = 1;
				    } else {
				        $res[$i]['staff_list'][$n]['task_list'][$n1]['dispatch'] = 0;
				    }
				}
				
			}
		}
		$this->showJson(0,  $res);
	}
	
}