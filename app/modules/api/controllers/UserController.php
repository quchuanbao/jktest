<?php 
/**
 * 会员表 * @author bao
 * 
 */
class UserController extends UController 
{
    /**
     * 会员列表
     */
    public function actionList()
    {
    	$type = $_REQUEST['member_type'];
    	$id = $_REQUEST['staff_id'];
    	if (empty($type)) {
    	    $this->showJson(2,"","参数不能为空！");
    	}
    	
    	if (empty($id)) {
    	    $id = $this->uid;
    	}
    	
    	
    	$userModel = new linkEmployee();
    	$userModel->initVar($userModel);
    	$userModel->id = $this->uid;
    	$userInfo = $userModel->search();
    	$userInfo = $userInfo[0];
    	
    	if ($userInfo['departmentId'] == 1) {
    		//会籍
    		$model = new linkUser();
    		$model->initVar($model);
    		$where = " memberShipId = '{$id}'  ";
    		 
    		if ($type == 1) {
    			//准会员
    			$where.=" and  isvip = 2 ";
    		}
    		if ($type == 2) {
    			//会员
    			$where.=" and  isvip = 1 ";
    		}
    		 
    		$lastId = $_REQUEST['last_id'];
    		$limit = $_REQUEST['page_size'];
    		 
    		if (!empty($lastId)) {
    			$where.= " and id < '{$lastId}' ";
    		}
    		if (empty($limit)) {
    			$limit = 10;
    		}
    		$where.= " order by id desc limit $limit ";
    		$userInfo = $model->search($where);
    	}
    	
    	if ($userInfo['departmentId'] == 2) {
    		//教练
    		
    		$model = new linkUser();
    		$model->initVar($model);
    		$where = " coachId = '{$id}'  ";
    		 
    		if ($type == 1) {
    			//准学员
    			$where.=" and  isvip = 1 and iscoach = 1 ";
    		}
    		if ($type == 2) {
    			//学员
    			$where.=" and  isvip = 1 and iscoach = 2  ";
    		}
    		 
    		if (!empty($lastId)) {
    			$where.= " and id < '{$lastId}' ";
    		}
    		if (empty($limit)) {
    			$limit = 10;
    		}
    		$where.= " order by id desc limit $limit ";
    		$userInfo = $model->search($where);
    	}
    	
    	$visitModel = new linkVisitlog();
    	
    	foreach ($userInfo as $n => $v) {
    		$res[$n]['member_id'] = $v['id'];
    		$res[$n]['photo'] = Yii::app()->params['imgurl'].$v['img'];
    		$res[$n]['name'] = $v['realName'];
    		$lastInfo = $visitModel->getUserList($v['id'],1);
    	    $lastInfo = $lastInfo[0];
    	    $res[$n]['visit_date'] = $lastInfo['cdate'];
    	    $res[$n]['visitor'] = $lastInfo['realName'];
    	    $res[$n]['lost_call_count'] = $lastInfo['telNum'];
    	    $res[$n]['talk_time'] = $lastInfo['telTime'];
    	    $res[$n]['visit_count'] = $visitModel->getUserListCount($v['id']);
    	}
    	$this->showJson(0,  $res);
    }
    
    /**
     * 会员详情
     */
    public function actionDetail()
    {
    	$id = $_REQUEST['member_id'];
    	
    	
    	$userModel = new linkUser();
    	$userModel->initVar($userModel);
    	$userInfo = $userModel->getApiList($id);
        if (empty($userInfo)) {
            $this->showJson(2,"","会员不存在！");
        }
    	
    	if ($userInfo['isvip'] == 1) {
    	   $res['member_type'] = 2;
    	}
    	if ($userInfo['isvip'] == 2) {
    	   $res['member_type'] = 1;
    	}
    	$res['photo'] = Yii::app()->params['imgurl'].$userInfo['img'];
    	$res['name'] = $userInfo['realName'];
    	$res['mobile'] = $userInfo['tel'];
    	$res['email'] = $userInfo['email'];
    	$res['address'] = $userInfo['address'];
    	$res['join_date'] = $userInfo['cdate'];
    	$res['gender'] = $userInfo['sex'];
    	$res['age'] = date("Y")- date("Y",strtotime($userInfo['born']));
    	$res['next_visit_date'] = $userInfo['visitDate'];
    	$res['coach_name'] = $userInfo['coachName'];
    	$res['huiji_name'] = $userInfo['hjName'];
    	
    	if ($userInfo['ismarry'] == 1) {
    	    $res['marriage'] = 2;
    	}
    	if ($userInfo['ismarry'] == 2) {
    	    $res['marriage'] = 1;
    	}
    	if ($userInfo['ischild'] == 1) {
    	    $res['children'] = 1;
    	}
    	if ($userInfo['ischild'] == 2) {
    	    $res['children'] = 0;
    	}
    	$source = $this->getSource();
    	$res['way'] = $source[$userInfo['sourceId']];
    	
    	
    	$visitModel = new linkVisitlog();
    	$visitInfo = $visitModel->getUserList($userInfo['id'],100);
    	
    	$lastInfo = end($visitInfo);
    	$res['last_visit_date'] = $lastInfo['cdate'];
    	$res['visit_count'] = $visitModel->getUserListCount($id);
    	
    	$visitList = array();
    	foreach ($visitInfo as $n => $v) {
    	    $visitList[$n]['visit_date'] = $v['cdate'];
    	    $visitList[$n]['talk_time'] = $v['telTime'];
    	    $visitList[$n]['visitor'] = $v['realName'];
    	    $visitList[$n]['talk_content'] = $v['content'];
    	    $visitList[$n]['call_count'] = $v['telNum'];
    	    if ($v['talk_time']) {
    	        $visitList[$n]['connected'] = 1;
    	    } else {
    	        $visitList[$n]['connected'] = 0;
    	    }
    	}  
    	
    	$res['visit_list'] = $visitList;
    	
    	$vipModel = new linkVippaylog();
    	$vipModel->initVar($vipModel);
    	$where = " userId = '{$id}'  order by id desc limit 1 ";
    	$vipInfo = $vipModel->search();
    	$vipInfo = $vipInfo[0];

    	if (!empty($vipInfo)) {
    	    $vipArray['card_type'] = $vipInfo['cardType'];
    	    $vipArray['card_number'] = $userInfo['vipNum'];
    	    $vipArray['card_start_date'] = $vipInfo['startDate'];
    	    $vipArray['card_stop_date'] = $vipInfo['endDate'];
    	    $vipArray['cert_number'] = $userInfo['cardNum'];
    	}
    	
    	$res['card_info'] = $vipArray;
    	
    	
    	
    	$this->showJson(0,  $res);
    	
    	
    }
    
    /**
     *  设置下次回访日期
     */
    public function actionSetVisit()
    {
         $uid = $_REQUEST['member_id'];
         $setDate = $_REQUEST['next_visit_date'];
         if (empty($uid) || empty($setDate)) {
             $this->showJson(2,"","参数不能为空！");
         }
         $userModel = new linkUser();
         $userModel->initVar($userModel);
         $userModel->id = $uid;
         $userInfo = $userModel->search();
         if (empty($userInfo)) {
             $this->showJson(2,"","用户不存在！");
         }
         $setDate = date("Y-m-d H:i:s",strtotime($setDate));
         
         $userModel = new linkUser();
         $userModel->initVar($userModel);
         $userModel->id = $uid;
         $userModel->visitDate = $setDate;
         $userModel->modify();
         
         //后续需要增加任务记录进去 
         
         $userInfo = $userInfo[0];
         $taskModel = new linkTask();
         $taskModel->initVar($taskModel);
         $taskModel->cdate = $setDate;
         $taskModel->employeeId = $userInfo['memberShipId'];
         $taskModel->noticeDate = $setDate." 10:00:00";
         $taskModel->complete_time = $setDate." 18:00:00";
         $taskModel->status = 1;
         $taskModel->content = "回访会员".$userInfo['realName'];
         $taskModel->remark = "系统自动创建，回访会员".$userInfo['realName'];
         $taskModel->save();
         $res = array();
         $this->showJson(0,  $res);
         
    }
    
    /**
     *  获取会员卡类型
     */
    public function actionGetVipType()
    {
        $cardType = Yii::app()->params['cardType'];
        foreach ($cardType as $n => $v) {
        	$res[$n-1]['card_type'] = $n;
        	$res[$n-1]['card_name'] = $v;
        }
        $this->showJson(0,  $res);
    }
    
    

    
    
    /**
     * 添加会员
     */
    public function actionAddMember()
    {
//         $res[0]['question_id'] = 1;
//         $res[0]['option_id'] = 1;
//         $this->showJson(0,  $res);
        $userId = $_POST['member_id'];
        $model = new UserForm('add');
        $model->img = $_FILES['photo'];
        $model->realName = $_POST['name'];
        $model->tel = $_POST['mobile'];
        $model->email = $_POST['email'];
        $model->address = $_POST['address'];
        $model->sex = $_POST['gender'];
        $age = time() - intval($_POST['age'])*86400*365;
        $model->born = date("Y-m-d",$age);
        if ($_POST['marriage'] == 1) {
            $model->ismarry = 2;
        }
        if ($_POST['marriage'] == 2) {
            $model->ismarry = 1;
        }
        if ($_POST['children'] == 1) {
            $model->ischild = 1;
        }
        if ($_POST['children'] == 0) {
            $model->ischild = 2;
        }
        $model->sourceId = $_POST['way'];
        if ( !$model->validate() ) {
            $errors = $model->getErrors();
            $this->showFormError($errors);
        }
        
        $uid = $this->uid;
        $userModel = new linkUser();
        $userModel->initVar($userModel);
  
        $file = CUploadedFile::getInstance($model,'img');
        if(is_object($file) && get_class($file) === 'CUploadedFile'){   // 判断实例化是否成功
            //文件扩展名
           
            $fileName = strtolower($file->extensionName);
            $picPath = 'upload/userpic/'.date("Y")."/".date("m");
            is_dir($picPath)?null:@mkdir($picPath,0777,1);
            $fileName = '/'.$uid.'_'.time().'.'.$fileName;
            $picPath = $picPath.$fileName;
            
            $file->saveAs($picPath);
            
            $setimg = new sdkSetimg();
            $imageres = $setimg->resizeImage($picPath,500,500);
            $setimg->saveImage($imageres,$picPath,100);
            
            $userModel->img = $picPath;
        }
        

        $userModel->realName = $model->realName;
        $userModel->tel = $model->tel;
        $userModel->email = $model->email;
        $userModel->address = $model->address;
        $userModel->sex = $model->sex;
        $userModel->born = $model->born;
        $userModel->ismarry = $model->ismarry;;
        $userModel->ischild = $model->ischild;;
        $userModel->sourceId = $model->sourceId;;
        
        if ($userId) {
            $userModel->id = $userId;
            $userModel->modify();
            $id = $userId;
        } else {
            $userModel->cdate = date("Y-m-d H:i:s");
            $userModel->isvip = 2;
            $userModel->memberShipId = $this->uid;
            $id = $userModel->save();
            
            $extendModel = new linkUserextended();
            $extendModel->initVar($extendModel);
            $extendModel->userId = $id;
            $extendModel->save();
        }
       
        
        $sportModel = new linkUserOption();
        $sportModel->initVar($sportModel);
        $sportModel->userid = $id;
        $sportModel->class = 1;
        $sportModel->delete();
        
        $sport = json_decode($_REQUEST['sport_experience']);
        foreach ($sport as $n => $v){
            $v = (array)$v;
            $sportModel = new linkUserOption();
            $sportModel->initVar($sportModel);
            $sportModel->qid = $v['question_id'];
            $sportModel->optionId = $v['option_id'];
            $sportModel->userid = $id;
            $sportModel->class = 1;
            $sportModel->save();
        }
        $res = array();
        $this->showJson(0,  $res);
    }

    

    /**
     * 渠道来源
     */
    public function actionGetWay()
    {
        $sourceModel = new linkSource();
        $sourceModel->initVar($sourceModel);
        $info = $sourceModel->search();
        foreach ($info as $n => $v) {
            $res[$n]['id'] = $v['id'];
            $res[$n]['name'] = $v['name'];
        }
        $this->showJson(0,  $res);
    }
    
    /**
     * 渠道来源
     */
    public function actionSport()
    {
        $userId = $_REQUEST['member_id'];
        $model = new linkQuestion();
        $info = $model->search(' type = 1');
       
        foreach ($info as $n => $v) {
        	$res[$n]['question_id'] = $v['id'];
        	$res[$n]['question_name'] = $v['name'];
        	$res[$n]['question_class'] = $v['class'];
        	$model = new linkQuestionoption();
        	$model->initVar($model);
        	$optionInfo = $model->search( 'qid = '.$v['id'] );
        	foreach ($optionInfo as $n1 => $v1) {
        	    $res[$n]['option_list'][$n1]['option_id'] = $v1['id'];
        	    $res[$n]['option_list'][$n1]['option_name'] = $v1['name'];
        	    if ($userId) {
        	       	$userOptionModel = new linkUserOption();
        	       	$userOptionModel->initVar($userOptionModel);
        	       	$where = " userid = $userId and optionId =  ".$v1['id'];
        	       	$select = $userOptionModel->search($where);
        	       	if (!empty($select)) {
        	       	    $res[$n]['option_list'][$n1]['selected'] = 1;
        	       	} else {
        	       	    $res[$n]['option_list'][$n1]['selected'] = 0;
        	       	}
        	    } else {
        	        $res[$n]['option_list'][$n1]['selected'] = 0;
        	    }
        	}
        }
        $this->showJson(0,  $res);
    }
    
    /**
     * 回访问题
     */
    public function actionReview()
    {
       
        $model = new linkQuestion();
        $info = $model->search(' type = 2');
         
        foreach ($info as $n => $v) {
            $res[$n]['question_id'] = $v['id'];
            $res[$n]['question_name'] = $v['name'];
            $res[$n]['question_class'] = $v['class'];
            $model = new linkQuestionoption();
            $model->initVar($model);
            $optionInfo = $model->search( 'qid = '.$v['id'] );
            foreach ($optionInfo as $n1 => $v1) {
                $res[$n]['option_list'][$n1]['option_id'] = $v1['id'];
                $res[$n]['option_list'][$n1]['option_name'] = $v1['name'];
            }
        }
        $this->showJson(0,  $res);
    }
    
    
    /**
     * 回访问题
     */
    public function actionAddReview()
    {
        $model = new VisitlogForm();
        $model->userId = $_REQUEST['member_id'];
        $model->cdate = $_REQUEST['talk_date'];
        $model->telTime = $_REQUEST['talk_time'];
        $model->content = $_REQUEST['remark'];
        $model->employeeId = $this->uid;
        $model->telNum = 1;
        if ( !$model->validate() ) {
            $errors = $model->getErrors();
            $this->showFormError($errors);
        }
        
        
        $dataModel = new linkVisitlog();
        $dataModel->initVar($dataModel);
        $saveArray = $model->attributes;
        $id = $dataModel->save($saveArray);
        
        
        $sportModel = new linkUserOption();
        $sportModel->initVar($sportModel);
        $sportModel->userid = $model->userId;
        $sportModel->class = 2;
        $sportModel->delete();
        
        $visit = json_decode($_REQUEST['visit_data']);
        foreach ($visit as $n => $v){
            $v = (array)$v;
            $sportModel = new linkUserOption();
            $sportModel->initVar($sportModel);
            $sportModel->qid = $v['question_id'];
            $sportModel->optionId = $v['option_id'];
            $sportModel->userid =  $model->userId;;
            $sportModel->class = 2;
            $sportModel->save();
        }
        
        $res = array();
        $this->showJson(0,  $res);
    }
    
}