<?php 
/**
 * 会员购买记录表 * @author bao
 * 
 */


class VippaylogController extends Controller 
{
	public $layout='main';
	/**
	 * 显示会员购买记录表 
	 */
	public function actionIndex() 
	{
		$id = $_REQUEST['uid'];
		if (empty($id)) {
			$this->showmsg("参数错误！");
		}

		$model = new VippaylogForm();

		$dataModel = new linkVippaylog();
		$dataModel->initVar($dataModel);
		$data['info'] = $dataModel->getApiList($id);
		$data['model'] = $model;
		
		
		$data['cardType'] = Yii::app()->params['cardType'];
		$data['payStatus'] = Yii::app()->params['payStatus'];
		$data['payType'] = Yii::app()->params['payType'];
		$data['uid'] = $id;
		$this->render('list',$data);
	}
	
	/**
	 * 添加会员购买记录表 
	 */
	public function actionAdd()
	{
		$id = $_REQUEST['uid'];
		if (empty($id)) {
			$this->showmsg("参数错误！");
		}
		
		$model = new VippaylogForm('add');
		$model->userId = $id;
		$model->applyId = Yii::app()->session['admin_login']['id'];
		$model->cdate = date("Y-m-d H:i:s");
		$model->status = 2;
		if (isset($_POST['VippaylogForm'])) {
			$model->attributes = $_POST['VippaylogForm'];
			if($model->validate()){
				$dataModel = new linkVippaylog();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/vippaylog/index/uid/'.$id);
			}
			
		}
		$data['model'] = $model;
		$data['cardType'] = Yii::app()->params['cardType'];
		$this->render('add',$data);
	}
	
	/**
	 *  编辑会员购买记录表	 */
	public function actionModify()
	{
		$dataModel = new linkVippaylog();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员购买记录表不存在！");
		}

		if ($dataInfo[0]['status'] != 1) {
			$this->showmsg("会员购买单已提交审核，禁止修改！");
		}
		
		$model = new VippaylogForm('add');
		if (isset($_POST['VippaylogForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['VippaylogForm'];
			if($model->validate()){
				$dataModel = new linkVippaylog();
				$dataModel->initVar($dataModel);
				$dataModel->id = $model->id;
				$dataModel->cardType = $model->cardType;
				$dataModel->startDate = $model->startDate;
				$dataModel->endDate = $model->endDate;
				$dataModel->totalNum = $model->totalNum;
				$dataModel->payable = $model->payable;
				$dataModel->payMoney = $model->payMoney;
				$dataModel->remark = $model->remark;
				$dataModel->modify();
				$this->showmsg("操作成功",'/mywork/vippaylog/index/uid/'.$dataInfo[0]['userId']);
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		
		$data['cardType'] = Yii::app()->params['cardType'];
		
		$data['model'] = $model;
		$this->render('add',$data);
	}
	
	
	/**
	 *  删除会员购买记录表	 */
	public function actionDel()
	{
		$dataModel = new linkVippaylog();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员购买记录表不存在！");
		}
		$dataInfo = $dataInfo[0];
		if ($dataInfo['status'] == 3) {
			$this->showmsg("会员购买单已生效，禁止删除！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/vippaylog');
	}
	
	
	
	/** 
	 *  财务待审核列表 
	*/
	public function actionAuditList()
	{
		$model = new VippaylogForm();	
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['VippaylogForm'];
		if (empty($model->status)) {
			$model->status = 2;
		}
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v."/";
			}
		}

		$whereInfo = $this->getSearchInfo($model->attributes,'a');
		
		$dataModel = new linkVippaylog();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->getAdminAuditCount($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/vippaylog/auditlist/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id desc limit $from,$limit";
		$data['info'] = $dataModel->getAdminAudit($whereInfo);
	
		$data['model'] = $model;

		
	
		$data['cardType'] = Yii::app()->params['cardType'];
		$data['payStatus'] = Yii::app()->params['payStatus'];
		$data['payType'] = Yii::app()->params['payType'];
		$this->render('listaudit',$data);
	}
	
	
	/**
	 *  财务审核	 
	 */
	public function actionAduit()
	{
		$dataModel = new linkVippaylog();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员购买记录表不存在！");
		}
	
		if ($dataInfo[0]['status'] != 2) {
			$this->showmsg("非财务审核状态，禁止修改！");
		}

		$model = new VippaylogForm('audit');
		if (isset($_POST['VippaylogForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['VippaylogForm'];
			if($model->validate()){
				$dataModel = new linkVippaylog();
				$dataModel->initVar($dataModel);
				$dataModel->id = $model->id;
				$dataModel->cardNum = $model->cardNum;
				$dataModel->payType = $model->payType;
				$dataModel->reviewId = Yii::app()->session['admin_login']['id'];
				$dataModel->reviewDate = date("Y-m-d H:i:s");
				$dataModel->contract = $model->contract;
				$dataModel->status = 3;
				$dataModel->modify();
				
				$userModel = new linkUser();
				$userModel->initVar($userModel);
				$userModel->id = $dataInfo[0]['userId'];
				$userModel->isvip = 1;
				$userModel->vipNum = $model->cardNum;
				$userModel->startDate = $dataInfo[0]['startDate'];
				$userModel->endDate = $dataInfo[0]['endDate'];
				$userModel->totalNum = $dataInfo[0]['totalNum'];
				$userModel->cardType = $dataInfo[0]['cardType'];
				$userModel->modify();
				
				$this->showmsg("操作成功",'/mywork/vippaylog/AuditList');
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
	    
		$userModel = new linkUser();
		$userInfo = $userModel->getApiList($dataInfo['userId']);
		$data['userInfo'] = $userInfo;
		$data['sex'] = Yii::app()->params['sex'];
		$data['sourceId'] = $this->getSource();
		$data['cardType'] = Yii::app()->params['cardType'];
		$data['payType'] = Yii::app()->params['payType'];
		$data['model'] = $model;
		$this->render('aduit',$data);
	}
	
	
	/**
	 * 编辑假期天数
	 */
	public function actionAddleave()
	{
	    $id = $_REQUEST['id'];
	    if (empty($id)) {
	        $this->showmsg("参数错误！");
	    }
	    
	    $vipModel = new linkVippaylog();
	    $vipModel->initVar($vipModel);
	    $vipModel->id = $id;
	    $vipInfo = $vipModel->search();
	    if (empty($vipInfo)) {
	        $this->showmsg("会员信息不存在！");
	    }
	    $vipInfo = $vipInfo[0];
	    if ($vipInfo['cardType'] !=1 ) {
	        $this->showmsg("非年卡禁止设置请假天数！");
	    }
	    
	    if ( $vipInfo['leaveNum'] == $vipInfo['leaveUseNum'] ) {
	        $this->showmsg("此卡已无剩余请假天数可用！");
	    }
	    
	    
	
	    $model = new UserleaveForm();
	   
	    if (isset($_POST['UserleaveForm'])) {
	        $model->attributes = $_POST['UserleaveForm'];
	        if($model->validate()){
	            
	            $stime = strtotime($model->startDate." 00:00:00");
	            $etime = strtotime($model->endDate." 23:59:59");
	            $dayNum = intval(($etime-$stime)/86400) + 1;
	            
	            if ( ($vipInfo['leaveUseNum']+$dayNum) > $vipInfo['leaveNum'] ){
	                $this->showmsg("请假天数大于可用天数！");
	            }
	            
	            
	            $vipModel = new linkVippaylog();
	            $vipModel->initVar($vipModel);
	            $vipModel->id = $id;
	            $vipModel->leaveUseNum = $vipInfo['leaveUseNum']+$dayNum;
	            $vipModel->modify();
	            
	            $userModel = new linkUser();
	            $userModel->initVar($userModel);
	            $userModel->id = $vipInfo['userId'];
	            $userInfo = $userModel->search();
	            $userInfo = $userInfo[0];

	            
	            $userModel = new linkUser();
	            $userModel->initVar($userModel);
	            $userModel->id = $vipInfo['userId'];
	            $ustime = strtotime($userInfo['endDate']) + $dayNum*86400;
	            $userModel->endDate = date("Y-m-d",$ustime);
	            $userModel->modify();
	            
	            $userLeaveModel = new linkUserleave();
	            $userLeaveModel->initVar($userLeaveModel);
	            $userLeaveModel->userId = $vipInfo['userId'];
	            $userLeaveModel->cdate = date("Y-m-d H:i:s");
	            $userLeaveModel->cardNum = $vipInfo['cardNum'];
	            $userLeaveModel->startDate = $model->startDate;
	            $userLeaveModel->endDate = $model->endDate;
	            $userLeaveModel->num = $dayNum;
	            $userLeaveModel->save();
	            $this->showmsg("操作成功",'/mywork/vippaylog/leavelist/id/'.$id);
	        } 	
	    }
	    $data['model'] = $model;
	    $data['vipInfo'] = $vipInfo;
	    $data['cardType'] = Yii::app()->params['cardType'];
	    $this->render('leaveadd',$data);
	}
	
	/**
	 * 编辑列表
	 */
	public function actionleavelist()
	{
	    $id = $_REQUEST['id'];
	    if (empty($id)) {
	        $this->showmsg("参数错误！");
	    }
	       
	    $vipModel = new linkVippaylog();
	    $vipModel->initVar($vipModel);
	    $vipModel->id = $id;
	    $vipInfo = $vipModel->search();
	    if (empty($vipInfo)) {
	        $this->showmsg("会员信息不存在！");
	    }
	    $vipInfo = $vipInfo[0];
	    if ($vipInfo['cardType'] !=1 ) {
	        $this->showmsg("非年卡禁止设置请假天数！");
	    }

	    $model = new VippaylogForm();
	    $model->leaveNum = intval($vipInfo['leaveNum']);
	    if (isset($_POST['VippaylogForm'])) {
	        $model->attributes = $_POST['VippaylogForm'];
	        if($model->validate()){
	            $dataModel = new linkVippaylog();
	            $dataModel->initVar($dataModel);
	            $dataModel->id = $id;
	            $dataModel->leaveNum = $model->leaveNum;
	            $dataModel->modify();
	            $this->showmsg("操作成功",'/mywork/vippaylog/leavelist/id/'.$id);
	        }
	    }
	    $data['model'] = $model;
	    $data['vipInfo'] = $vipInfo;
	    $data['cardType'] = Yii::app()->params['cardType'];
	    
	    $userLeaveModel = new linkUserleave();
	    $userLeaveModel->initVar($userLeaveModel);
	    $where = " userId = '{$vipInfo['userId']}' and cardNum = '{$vipInfo['cardNum']}' order by id desc   "; 
	    $info = $userLeaveModel->search($where);
	    $data['info'] = $info;

	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->id = $vipInfo['userId'];
	    $userInfo = $userModel->search();
	    $userInfo = $userInfo[0];
	    $data['userInfo'] = $userInfo;
	    $this->render('leavelist',$data);
	}
	
	
	
	
	
	
	/**
	 * 组织查询条件
	 * @param array $needArray
	 */
	function getSearchInfo($needArray,$fix=''){
		$where = " 1=1 ";
		if(!empty($needArray)){
			
			foreach ($needArray as $n => $v){
				if(!empty($v)){
					if (empty($fix)){
						$where.=" and ".$n."='".$v."' ";
					} else {
						$where.=" and ".$fix.".".$n."='".$v."' ";
					}
				}
			}
		}
		return $where;
	}
}