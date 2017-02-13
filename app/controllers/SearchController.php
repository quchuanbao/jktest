<?php
class SearchController extends Controller
{
	
	public $layout='';
    
    public function actionIndex()
	{
		$this->render('search');
	}
	
	public function actionSearch()
	{
		$keyword = $_REQUEST['keyword'];
		
		$adminModel = new linkUser();
		$adminModel->initVar($adminModel);
		$date = date("Y-m-d")." 23:00:00";
		$where = " ( vipNum = '{$keyword}' or tel = '{$keyword}' or cardNum = '{$keyword}'
		or wxnum = '{$keyword}' or realName = '{$keyword}'
		) and isvip = 1 and endDate >= '{$date}' limit 1 ";
		
		$info = $adminModel->search($where);
		$info = $info[0];
		if (empty($info)) {
			$res = '<p style="color:#F00;">该会员不存在或禁止登录！</p>';
			echo $res;
			exit;
		}
		
		if ($info['cardType'] == 5 && ( ($info['totalNum'] - $info['useNum']) < 1)) {
		    $res = '<p style="color:#F00;">已无可用次数！</p>';
		    echo $res;
		    exit;
		}
		
		if ($info['cardType'] == 1) {
		    $startDate = date("Y-m-d 00:00:00");
		    $endDate = date("Y-m-d 23:59:59");
		    $userLeaveModel = new linkUserleave();
		    $userLeaveModel->initVar($userLeaveModel);
		    $where = " userId = '{$info['id']}' and cardNum = '{$info['vipNum']}' and startDate<= '{$startDate}' and endDate>= '{$endDate}' ";
		    $leaveinfo = $userLeaveModel->search($where);
		    if (!empty($leaveinfo)) {
		        $res = '<p style="color:#F00;">请假期间不可入内！</p>';
		        echo $res;
		        exit;
		    }
		    
		    
		    $vipModel = new linkVippaylog();
		    $vipModel->initVar($vipModel);
		    $vipModel->cardNum = $info['vipNum'];
		    $vipInfo = $vipModel->search();
		    $vipInfo = $vipInfo[0];
		    
		}
		$employeeModel = new linkEmployee();
		$employeeModel->initVar($employeeModel);
		$employeeModel->id = $info['memberShipId'];
		$employeeInfo = $employeeModel->search();
		$employeeInfo = $employeeInfo[0];
		$logModel = new linkUserLog();
// 		$date = date("Y-m-d");
//         $where = " userId = {$info['id']} and left(cdate,10) = '{$date}' " ;
// 		$logInfo = $logModel->search();
//		$logInfo = $logInfo[0];
		
		$logModel->initVar($logModel);
		$logModel->userId = $info['id'];
		$logModel->cdate = date("Y-m-d H:i:s");
		$logModel->save();
		
		$cardType = Yii::app()->params['cardType'];
		$sex = Yii::app()->params['sex'];
		$sourceId = $this->getSource();
		
		if (!file_exists($info['img'])) {
			$img = '未上传照片';
			//$img = '<input onchange="uploadImage(\''.$info['id'].'\');" name="UserForm[img]" id="UserForm_img" type="file">';
		} else {
			$img = '<img style="height:100px;" src = "/'.$info['img'].'" />';
		}
		
		$res.='<p id="imageShow">照片：'.$img.'</p>';
		$res.='<p><input onchange="uploadImage(\''.$info['id'].'\');" name="UserForm[img]" id="UserForm_img" type="file"></p>';
		$res.='<p>姓名：'.$info['realName'].'</p>';
		$res.='<p>卡号：'.$info['vipNum'].'</p>';
		$res.='<p style="color:#F00;">会员类型：'.$cardType[$info['cardType']].'</p>';
		$res.='<p style="color:#F00;">会籍：'.$employeeInfo['realName'].'</p>';
		$res.='<p>电话号码：'.$info['tel'].'</p>';
		$res.='<p>性别：'.$sex[$info['sex']].'</p>';
		$res.='<p>出生日期：'.$info['born'].'</p>';
		$res.='<p>证件号码：'.$info['cardNum'].'</p>';
		$res.='<p>地址：'.$info['address'].'</p>';
		$res.='<p>邮箱：'.$info['email'].'</p>';
		$res.='<p>微信号：'.$info['wxnum'].'</p>';
		if ($info['cardType'] == 1) {
		    $res.='<p>总请假天数：'.$vipInfo['leaveNum'].'</p>';
		    $res.='<p>已请假天数：'.$vipInfo['leaveUseNum'].'</p>';
		    $res.='<p style="color:#F00;">剩余请假天数：'.($vipInfo['leaveNum'] - $vipInfo['leaveUseNum']).'</p>';
		}
		if ($info['cardType'] == 5) {
		  $res.='<p style="color:#F00;">剩余次数：'.($info['totalNum'] - $info['useNum']).'</p>';
		}
		$res.='<p style="color:#F00;">有效期：'.$info['endDate'].'</p>';
	    if ($info['cardType'] == 5) {
	        $res.='<div class="modal-footer" style="text-align:center;"><a href="/search/fee/userId/'.$info['id'].'/cardNum/'.$info['vipNum'].'"  class="btn btn-warning">点击扣除次数</a></div>';
	    } else {
	        $res.='<div class="modal-footer" style="text-align:center;"></div>';
	    }
		echo $res;
		exit;
	}
	
	
	public function actionFee()
	{
		$cardNum = $_GET['cardNum'];
		$userId = $_GET['userId'];
		$vipModel = new linkVippaylog();
		$vipModel->initVar($vipModel);
		$vipModel->cardNum = $cardNum;
		$vipModel->userId = $userId;
		$vipInfo = $vipModel->search();
		$vipInfo = $vipInfo[0];
		if (empty($vipInfo)) {
		    $this->showmsg('卡号错误！');
		}
		
		$userModel = new linkUser();
		$userModel->initVar($userModel);
		$userModel->id = $vipInfo['userId'];
		$userInfo = $userModel->search();
		$userInfo = $userInfo[0];
		
		if ($userInfo['cardType'] == 5 && ( ($userInfo['totalNum'] - $userInfo['useNum']) < 1)) {
		    $this->showmsg('已无可用次数！');
		}
		$useNum = $userInfo['totalNum'] - ($userInfo['useNum'] + 1);
		$userModel->initVar($userModel);
		$userModel->id = $vipInfo['userId'];
		$userModel->useNum = $userInfo['useNum'] + 1;
		$userModel->modify();
		$this->showmsg('刷卡成功，卡内剩余次数！'.$useNum);
	}
	
	
	/**
	 * 异步上传图片
	 */
	public function actionAjaxUpload()
	{
		$model = new UserForm('ajax');
		$model->attributes = $_POST['UserForm'];
	    $uid = $_GET['uid'];
		if($model->validate()){
			$file = CUploadedFile::getInstance($model,'img');
			if(is_object($file)&&get_class($file) === 'CUploadedFile'){   // 判断实例化是否成功
				//文件扩展名
			    $picPath = 'upload/userpic/'.date("Y")."/".date("m");
                is_dir($picPath)?null:@mkdir($picPath,0777,1);
                $fileName = '/'.$uid.'_'.time().'.'.$file->extensionName;
                $picPath = $picPath.$fileName;
			    $file->saveAs($picPath);
			    $res['code'] = 0;
			    $res['filePath'] = $picPath;
			    //进行压缩
			    $setimg = new sdkSetimg();
			    $imageres = $setimg->resizeImage($picPath,500,500);
			    $setimg->saveImage($imageres,$picPath,100);
			    $userModel = new linkUser();
			    $userModel->initVar($userModel);
			    $userModel->id = $uid;
			    $userModel->img = $picPath;
			    $userModel->modify();
			}
		} else {
			$res['code'] = 1;
			$res['res'] = $model->getError('img');
		}
		echo json_encode($res);
	}
	
}