<?php 
/**
 * 会员购买记录表 * @author bao
 * 
 */


class VippaylogController extends UController 
{

	/**
	 *  会员支付审核
	 */
	public function actionPay() 
	{
	    //证件号码，再确定是否需要更新
		$uid = $_REQUEST['member_id'];
	    if (empty($uid)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->id = $uid;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,"","用户不存在！");
	    }
	    
	    $model = new VippaylogForm('add');
	    $model->cardType = $_REQUEST['card_type'];
	    $model->startDate = $_REQUEST['card_start_date'];
	    $model->endDate = $_REQUEST['card_stop_date'];
	    $model->payable = $_REQUEST['admission_fee'];
	    //$model->payMoney = $_REQUEST['dues'];
	    $model->payMoney = $_REQUEST['total'];
	    $model->payType = $_REQUEST['pay_type'];
	    $model->remark = $_REQUEST['price_explain'];
	    $model->userId = $uid;
	    $model->applyId = $this->uid;
	    $model->cdate = date("Y-m-d H:i:s");
	    $model->status = 1;
	    $model->totalNum = $_REQUEST['total_num'];
	    if(!$model->validate()){
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	    
        $dataModel = new linkVippaylog();
        $dataModel->initVar($dataModel);
        $saveArray = $model->attributes;
        $id = $dataModel->save($saveArray);
        
        $userModel = new linkUser();
        $userModel->initVar($userModel);
        $userModel->id = $uid;
        $userModel->cardNum = $_REQUEST['cert_number'];
        $userModel->modify();
        $res['dues_code'] = strval($id);
        $this->showJson(0,  $res);
	}
	
	/**
	 * 缴费记录
	 */
	public function actionPayList()
	{
	    $uid = $_REQUEST['member_id'];
	    if (empty($uid)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->id = $uid;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,"","用户不存在！");
	    }
	    
	    $dataModel = new linkVippaylog();
	    $dataModel->initVar($dataModel);
	    $info = $dataModel->getApiList($uid);
	    $res = array();
	    foreach ($info as $n => $v) {
	    	$res[$n]['pay_date'] = $v['cdate'];
	    	$res[$n]['card_type'] = $v['cardType'];
	    	$res[$n]['card_number'] = $v['cardNum'];
	    	$res[$n]['card_start_date'] = $v['startDate'];
	    	$res[$n]['card_stop_date'] = $v['endDate'];
	    	$res[$n]['admission_fee'] = $v['payable'];
	    	$res[$n]['dues'] = $v['payMoney'];
	    	$res[$n]['total'] = $v['payMoney'];
	    	$res[$n]['membership'] = $v['applyName'];
	    	$res[$n]['manager'] = $v['leaderName'];
	    	$res[$n]['finance'] = $v['reviewName'];
	    }
	    $this->showJson(0,  $res);
	}
	
	
	
	/**
	 * 财务审核
	 */
	public function actionPayReview() {
	    
	    $uid = $_REQUEST['member_id'];
	    if (empty($uid)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    $userModel = new linkUser();
	    $userModel->initVar($userModel);
	    $userModel->id = $uid;
	    $userInfo = $userModel->search();
	    if (empty($userInfo)) {
	        $this->showJson(2,"","用户不存在！");
	    }
	    $cardNumber =  $_REQUEST['card_number'];
	    //审核后需要插入业绩表
	    //需要验证cardNumber是否重复
	    $logModel = new linkVippaylog();
	    $logModel->initVar($logModel);
	    $logModel->cardNum = $cardNumber;
	    $logInfo = $logModel->search();
	    $this->showJson(2,"","卡号已经存在！");
	}
	
	
	/**
	 * 审核列表
	 */
	public function actionAduitList() {
		$status = $_REQUEST['audit_status'];
		if (!$status) {
			//待主管审核
			$status = 1;
		} else {
		    if ($status == 2) {
		        $status = 5;
		    } else {
		        //主管已审核，待财务审核
		        $status = 2;
		    }
			
		}
		
		$paylogModel = new linkVippaylog();
		$info = $paylogModel->getAuditList($status);
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['member_id'] = $v['userId'];
			$res[$n]['photo'] =  Yii::app()->params['imgurl'].$v['img'];
			$res[$n]['name'] = $v['realName'];
			$res[$n]['dues_code'] = $v['id'];
			$res[$n]['submit_time'] = $v['cdate'];
			$res[$n]['audit_time'] = $v['leaderDate'];
		}
		$this->showJson(0,  $res);
	}
	
	/**
	 * 审核列表
	 */
	public function actionAduitDetail() {
		$userId = $_REQUEST['member_id'];
		$id = $_REQUEST['dues_code'];
		
		$paylogModel = new linkVippaylog();
		$paylogModel->initVar($paylogModel);
		$paylogModel->id = $id;
		$paylogModel->userId = $userId;
		$payInfo = $paylogModel->search();
		if (empty($payInfo)) {
			$this->showJson(2,"","缴费信息不存在！");
		}
		$payInfo = $payInfo[0];
		
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->id = $userId;
		$userInfo = $userModel->search();
		
		$res = array();
		$res['card_type'] = $payInfo['cardType'];
		$res['card_number'] = $payInfo['cardNum'];
		$res['card_start_date'] = $payInfo['startDate'];
		$res['card_stop_date'] = $payInfo['endDate'];
		$res['admission_fee'] = $payInfo['payable'];
		$res['dues'] = $payInfo['payMoney'];
		$res['total'] = $payInfo['payMoney'];
		$res['pay_type'] = Yii::app()->params['payType'][$payInfo['payType']];
		$res['price_explain'] = $payInfo['remark'];
		$res['audit_opinion'] = $payInfo['leaderRemark'];
		$res['cert_number'] = $userInfo[0]['cardNum'];
		$res['total_num'] = $payInfo['totalNum'];
		$this->showJson(0,  $res);
	}
	
	
	/**
	 * 审核列表
	 */
	public function actionAduit() {
		$userId = $_REQUEST['member_id'];
		$id = $_REQUEST['dues_code'];
		$approve = $_REQUEST['approve'];
		$remark = $_REQUEST['audit_opinion'];
		
		$paylogModel = new linkVippaylog();
		$paylogModel->initVar($paylogModel);
		$paylogModel->id = $id;
		$paylogModel->userId = $userId;
		$payInfo = $paylogModel->search();
		if (empty($payInfo)) {
			$this->showJson(2,"","缴费信息不存在！");
		}
		$payInfo = $payInfo[0];
		
		if (empty($approve)) {
			$this->showJson(2,"","参数有误！");
		}
		
		$status = 1;
		
		if ($approve == 1) {
			//审核通过
			$status = 2;
		}
		if ($approve == 2) {
			//审核驳回
			$status = 5;
		}
		
		$paylogModel->initVar($paylogModel);
		$paylogModel->id = $id;
		$paylogModel->status = $status;
		$paylogModel->leaderRemark = $remark;
		$paylogModel->leaderDate = date("Y-m-d H:i:s");
		$paylogModel->modify();
		$res = array();
		$this->showJson(0,  $res);
	}
}