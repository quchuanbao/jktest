<?php
class TelController extends Controller
{
	
	public $layout='';
    
    public function actionIndex()
	{
		$this->render('search');
	}
	
	public function actionSearch()
	{
		$keyword = $_REQUEST['keyword'];
		
		$adminModel = new linkUsertel();
		$adminModel->initVar($adminModel);
		$adminModel->tel = $keyword;
		$info = $adminModel->search();
		if(!empty($info)){
			$res = '1,该手机号已存在!';
			echo $res;
			exit;
		}

		$telModel =  new linkUsertel();
		$telModel->initVar($telModel);
		$telModel->tel = $keyword;
		$telModel->empolyeeId = Yii::app()->session['employeetel']['id'];
		$telModel->cdate = date("Y-m-d H:i:s");
		$telModel->save();

		$res = '2,录入成功!';
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