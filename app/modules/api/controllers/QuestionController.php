<?php 
/**
 * 课程表 * @author bao
 * 
 */


class CourseController extends UController 
{
	public $layout='main';
	
	/**
	 * 添加课程
	 */
	public function actionAdd()
	{

	    $model = new CourseForm('add');
	    $model->userId = $_POST['member_id'];
	    $model->startDate = $_POST['course_date'];
	    $model->startTime = $_POST['start_time'];
	    $model->endTime = $_POST['end_time'];
	    $model->employeeId = $this->uid;
	    $model->status = 1;

	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	
	    $dataModel = new linkCourse();
	    $dataModel->initVar($dataModel);
	    $saveArray = $model->attributes;
	    $id = $dataModel->save($saveArray);
	    $res['id'] = strval($id);
	    $this->showJson(0,  $res);
	}
	
	
	/**
	 * 获取训练动作等列表
	 */
	public function actionGetTraining()
	{
	    $courseAction = new linkCourseaction();
	    $courseAction->initVar($courseAction);
	    $action = $courseAction->search();
	    
	    foreach ($action as $n => $v) {
	        $res['action_list'][$n]['action_code'] = $v['id'];
	        $res['action_list'][$n]['action_name'] = $v['name'];
	    }
	    
	    $coursePosition = new linkCourseposition();
	    $coursePosition->initVar($coursePosition);
	    $position = $coursePosition->search();
	    
	    foreach ($position as $n => $v) {
	        $res['body_part_list'][$n]['body_part_code'] = $v['id'];
	        $res['body_part_list'][$n]['body_part_name'] = $v['name'];
	    }
	    
	    $courseInstrument = new linkCourseinstrument();
	    $courseInstrument->initVar($courseInstrument);
	    $instrument = $courseInstrument->search();
	    foreach ($instrument as $n => $v) {
	        $res['equipment_list'][$n]['equipment_code'] = $v['id'];
	        $res['equipment_list'][$n]['equipment_name'] = $v['name'];
	    }
	    
	    $courseNum = Yii::app()->params['courseNum'];
	    foreach ($courseNum as $n => $v) {
	        $res['frequency_list'][$n-1]['frequency_code'] = $n;
	        $res['frequency_list'][$n-1]['frequency'] = $v;
	    }
	   
	    
	    $courseStrength = Yii::app()->params['courseStrength'];
	    foreach ($courseStrength as $n => $v) {
	        $res['intensity_list'][$n-1]['intensity_code'] = $n;
	        $res['intensity_list'][$n-1]['intensity_name'] = $v;
	    }
	    
	    $courseFeeling = Yii::app()->params['courseFeeling'];
	    foreach ($courseFeeling as $n => $v) {
	        $res['feel_list'][$n-1]['feel_code'] = $n;
	        $res['feel_list'][$n-1]['feel_name'] = $v;
	    }
	    
	    $this->showJson(0,  $res);
	}
	
	
	/**
	 * 设置课程
	 */
	public function actionSet()
	{
	    //[{"equipment_code":1,"body_part_code":1,"action_code":1,"frequency_code":1,"intensity_code":1,"feel_code":1},{"equipment_code":1,"body_part_code":1,"action_code":1,"frequency_code":1,"intensity_code":1,"feel_code":1}]
	    
	    //$code = '20150109-1';
	    $code = $_POST['course_code'];
	    $codeInfo = explode("-", $code);
	    $courseId = $codeInfo[1];
	    if (empty($courseId) || empty($_REQUEST['training_list']) ) {
	        $this->showJson(2,'','参数错误！');
	    }
	    
	    $courseModel = new linkCourse();
	    $courseModel->initVar($courseModel);
	    $courseModel->id = $courseId;
	    $courseInfo = $courseModel->search();
	    $courseInfo = $courseInfo[0];
	    if (empty($courseInfo)) {
	        $this->showJson(2,'','课程不存在！');
	    }
	    
	    $courseModel->initVar($courseModel);
	    $courseModel->id = $courseId;
	    $courseModel->startDate = $_POST['course_date'];
	    $courseModel->startTime = $_POST['start_time'];
	    $courseModel->endTime = $_POST['end_time'];
	    $courseModel->modify();
	    
	    $courseResultModel = new linkCourseresult();
	    $data = json_decode($_REQUEST['training_list']);
	    $courseResultModel->initVar($courseResultModel);
	    $courseResultModel->courseId = $courseId;
	    $courseResultModel->delete();
	    
	    foreach ($data as $n => $v) {
 	        $courseResultModel->initVar($courseResultModel);
 	        $courseResultModel->courseId = $courseId;
 	        $courseResultModel->actionId = $v->action_code;
	        $courseResultModel->instrumentId = $v->equipment_code;
	        $courseResultModel->postionId = $v->body_part_code;
	        $courseResultModel->num = $v->frequency_code;
	        $courseResultModel->strength = $v->intensity_code;
	        $courseResultModel->feeling = $v->feel_code;
 	        $courseResultModel->save();
	    }
	    
	    $this->showJson(0,  array());
	}
	
	
	
	
	/**
	 * 购买课程
	 */
	public function actionBuy()
	{
	    $userId = $_POST['member_id'];
	    
	    $model = new CourseBuyForm('add');
	    $model->userId = $_POST['member_id'];
	    $model->num = $_POST['lesson_number'];
	    $model->price = $_POST['unit_price'];
	    $model->total = $_POST['total_price'];
	    $model->paytype = $_POST['pay_type'];
	    $model->remark = $_POST['price_explain'];
	    $model->employeeId = $this->uid;
	    $model->cdate = date("Y-m-d H:i:s");
	    $model->status = 1;
	    
	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	    
	    $dataModel = new linkCourseBuy();
	    $dataModel->initVar($dataModel);
	    $saveArray = $model->attributes;
	    $id = $dataModel->save($saveArray);
	    $res['id'] = strval($id);
	    $this->showJson(0,  array());
	}
	
	
	/**
	 * 购买课程
	 */
	public function actionBuyList()
	{
	    $userId = $_POST['member_id'];
	     
	    if (empty($userId)) {
	        $this->showJson(2,'','参数错误！');
	    }
	    
	    
	    $dataModel = new linkCourseBuy();
	    $info = $dataModel->apiList($userId);
	    
	    foreach ($info as $n => $v) {
	    	$res[$n]['pay_date'] = date("Y-m-d",strtotime($v['cdate']));
	    	$res[$n]['lesson_number'] = $v['num'];
	    	$res[$n]['unit_price'] = $v['price'];
	    	$res[$n]['total_price'] = $v['total'];
	    	$res[$n]['coach'] = $v['coach'];
	    	$res[$n]['manager'] = $v['manager'];
	    	$res[$n]['finance'] = $v['finance'];
	    }
	    
	    $this->showJson(0,  $res);
	}
	
	/**
	 * 设置课程详情
	 */
	public function actionDetail()
	{
	    $code = $_POST['course_code'];
	    $codeInfo = explode("-", $code);
	    $courseId = $codeInfo[1];
	    if (empty($courseId)  ) {
	        $this->showJson(2,'','参数错误！');
	    }
	     
	    $courseModel = new linkCourse();
	    $courseModel->initVar($courseModel);
	    $courseModel->id = $courseId;
	    $courseInfo = $courseModel->search();
	    $courseInfo = $courseInfo[0];
	    if (empty($courseInfo)) {
	        $this->showJson(2,'','课程不存在！');
	    }
	    
	    $courseInfo = $courseModel->apiList($courseId);
	    
	    $resultModel = new linkCourseresult();
	    $resultInfo = $resultModel->apiList($courseId);
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
	 * 添加课程
	 */
	public function actionAddClass()
	{
	
	    $model = new CourseClassForm('add');
	    $model->siteId = $_POST['site_id'];
	    $model->startDate = $_POST['course_date'];
	    $model->startTime = $_POST['start_time'];
	    $model->endTime = $_POST['end_time'];
	    $model->employeeId = $this->uid;
	
	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	
	    $dataModel = new linkCourseClass();
	    $dataModel->initVar($dataModel);
	    $saveArray = $model->attributes;
	    $id = $dataModel->save($saveArray);
	    $res['id'] = strval($id);
	    $this->showJson(0,  $res);
	}
	
	/**
	 * 添加课程
	 */
	public function actionSiteList()
	{
	   $info = Yii::app()->params['courseSite'];
	   foreach ($info as $n => $v ) {
	       $res[$n-1]['site_id'] = $n;
	       $res[$n-1]['site_name'] = $v;
	   }
	   $this->showJson(0,  $res);
	}
	
	
	/**
	 * 课程列表
	 */
	public function actionList(){
		$members = $_REQUEST['select_member'];
		$date = $_REQUEST['year_month'];
		
		$lastId = $_REQUEST['page_index'];
		$limit = $_REQUEST['page_size'];
        if (empty($limit)) {
        	$limit = 10;
        }
		
		$emploeeyId = $this->uid;
		
		$courseModel = new linkCourse();
		$info = $courseModel->searchList($emploeeyId,$members,$date,$lastId,$limit);
		
		foreach ($info as $n => $v) {
			$res[$n]['course_type'] = 1;
			$res[$n]['course_date'] = $v['startDate'];
			$res[$n]['course_code'] = date("Ymd",strtotime($v['startDate']))."-".$v['id'];
		
			
			$res[$n]['start_time'] = $v['startTime'];
			$res[$n]['end_time'] = $v['endTime'];
			$res[$n]['member_id'] = $v['userId'];
			$res[$n]['member_name'] = $v['memberName'];
			$res[$n]['over_lessons'] = intval($v['usenum']);
			$res[$n]['total_lessons'] = $v['num'];
			if ($v['status'] == 1) {
			    $res[$n]['confirmed'] = 0;
			}
			if ($v['status'] == 2) {
			    $res[$n]['confirmed'] = 1;
			}
		}
		$out['unconfirmed_count'] = $courseModel->searchListCount($emploeeyId,$members,$date);
		$out['course_list'] = $res;
		$this->showJson(0,  $out);
	}
}