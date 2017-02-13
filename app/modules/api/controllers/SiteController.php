<?php
class SiteController extends Controller
{
	/**
	 * 登录
	 */
	public function actionLogin()
	{
		$model = new LoginForm();
		$model->tel = $_POST['account'];
		$model->pwd = $_POST['password'];
		if ( !$model->validate() ) {
			$errors = $model->getErrors();
			$this->showFormError($errors);
		}
		
		$this->showJson(0, array('token'=>session_id()));
	}
	
	
	
	
	
	/**
	 * 注销
	 */
	public function actionLoginOut()
	{
		$uid = Yii::app ()->session['uid'];
		if (!empty($uid)) {
			unset(Yii::app ()->session['uid']);
		}
		
		$this->showJson(0,'',"注销成功！");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	/**
	 * 获取验证码
	 */
	public function actionGetCode()
	{
		//一分钟内不能重新获取
		//一天不能大于5次
		$tel = $_POST['tel'];
		$type = $_POST['type'];
		$action = $_POST['action'];
		
		if (empty($action)) {
			$action = 1;
		}
		
		if (empty($tel)) {
			$this->showJson(2,'','手机号错误！');
		}

		
		$dataModel = new linkMember();
		$dataModel->initVar($dataModel);
		$dataModel->tel = $tel;
		$userInfo = $dataModel->search();
		
		if ($action == 1) {
			//注册验证
			if (!empty($userInfo)) {
				$this->showJson(2,'','该用户已注册！');
			}
		}
		
		if ($action == 2) {
			//找回密码验证
			if (empty($userInfo)) {
				$this->showJson(2,'','该手机号不存在！');
			}
		}
		
		
		
		$dataModel = new linkSmsdetail();
		$dataModel->initVar($dataModel);
		
		$startDate = date("Y-m-d")." 00:00:00";
		$endDate = date("Y-m-d")." 23:59:59";
		$where .= " tel = '{$tel}' and cdate>='{$startDate}' and cdate<='{$endDate}'  ORDER BY id DESC ";
		$res = $dataModel->search($where);

		if (count($res)>4) {
			$this->showJson(2,'','验证码获取太频繁，请明天重试！');
		}
		
		if (!empty($res[0])) {
			
			if( time()-strtotime($res[0]['cdate']) < 60) {
				$this->showJson(2,'','请1分钟后重试！');
			}
		}
		
		$code = rand(0,9).rand(0,9).rand(0,9).rand(0,9);

		$msg = new CLOOPENAPI();
		
		if (empty($_POST['type'])) {
			$res = $msg->SendSMSCode($tel,$code);
		} else {
			$res = $msg->SendVoiceCode($tel,$code);
		}
		$result = json_decode($res,true);
			
		if($result['statusCode'] == '000000'){
			$dataModel->initVar($dataModel);
			$dataModel->tel = $tel;
			$dataModel->code = $code;
			$dataModel->cdate = date("Y-m-d H:i:s");
			$dataModel->save();
			$this->showJson(0,'','');
		}else{
			$this->showJson(2,'','验证码发送失败！');
		}
	}
	//注册第一步
	public function actionReg()
	{
	
	    $model = new MemberForm('reg');
	    $model->attributes = $_POST;
	    $model->cdate = date("Y-m-d H:i:s");
	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	
	    $dataModel = new linkMember();
	    $dataModel->initVar($dataModel);
	    $saveArray = $model->attributes;
	    unset($saveArray['code']);
	    $id = $dataModel->save($saveArray);
	
	    if ( $id ) {
	        Yii::app()->session['uid'] = $id;
	        $this->showJson(0, array('token'=>session_id(),'uid'=>$id));
	    } else {
	        $this->showJson(2,'','注册失败');
	    }
	}
	
	
	
	//注册第二步
	public function actionRegTwo()
	{
	    $model = new MemberForm('regTwo');
	    $model->attributes = $_POST['form'];
	    if ( !$model->validate() ) {
	        $errors = $model->getErrors();
	        $this->showFormError($errors);
	    }
	
	    $dataModel = new linkMember();
	
	    $file = CUploadedFile::getInstance($model,'img');
	    if(is_object($file)&&get_class($file) === 'CUploadedFile'){   // 判断实例化是否成功
	        //文件扩展名
	        	
	        $fileName = time().".".strtolower($file->extensionName);
	        $fileNameInfo = explode(".",$fileName);
	        $picPath = Yii::app()->params['contentPicPath'].date("Y",$fileNameInfo[0])."/".date("m",$fileNameInfo[0])."/";
	        is_dir($picPath)?null:@mkdir($picPath,0777,1);
	        	
	        $picPath = $picPath.$uid.'_'.$fileName;
	        $file->saveAs($picPath);
	        //进行压缩
	        $setimg = new sdkSetimg();
	        $imageres = $setimg->resizeImage($picPath,200,200);
	        $setimg->saveImage($imageres,$picPath,100);
	        	
	        $dataModel->initVar($dataModel);
	        $model->img = $picPath;
	        	
	        $saveArray = $model->attributes;
	        $dataModel->save($saveArray);
	        $this->showJson('000','操作成功！');
	    } else {
	        $this->showJson('111','图片上传错误！');
	    }
	}
	
	/**
	 * 找回密码
	 */
	public function actionGetPwd()
	{
		
		$model = new MemberForm('getpwd');
		$model->attributes = $_POST;
		
		if ( !$model->validate() ) {
			$errors = $model->getErrors();
			$this->showFormError($errors);
		}
		
		$type = $_POST['type'];
		
		$dataModel = new linkMember();
		$dataModel->initVar($dataModel);
		$dataModel->tel = $model->tel;
		$userInfo = $dataModel->search();
		if (empty($userInfo)) {
			$this->showJson(2,'','该用手机号不存在！');
		}
		$dataModel = new linkMember();
		$dataModel->initVar($dataModel);
		$dataModel->id = $userInfo[0]['id'];
		$dataModel->pwd = $model->pwd;
		$dataModel->modify();
		$this->showJson(0,'','');
	}
	
	
	/**
	 * 获取验证码
	 */
	public function actionGetPwdCode()
	{
		//一分钟内不能重新获取
		//一天不能大于5次
		$tel = $_POST['tel'];
		$type = $_POST['type'];
	
		if (empty($tel)) {
			$this->showJson(2,'','手机号错误！');
		}
	
	
		$dataModel = new linkMember();
		$dataModel->initVar($dataModel);
		$dataModel->tel = $tel;
		$userInfo = $dataModel->search();
		if (!empty($userInfo)) {
			$this->showJson(2,'','该用户已注册！');
		}
	
		$dataModel = new linkSmsdetail();
		$dataModel->initVar($dataModel);
	
		$startDate = date("Y-m-d")." 00:00:00";
		$endDate = date("Y-m-d")." 23:59:59";
		$where .= " tel = '{$tel}' and cdate>='{$startDate}' and cdate<='{$endDate}'  ORDER BY id DESC ";
		$res = $dataModel->search($where);
	
		if (count($res)>4) {
			$this->showJson(2,'','验证码获取太频繁，请明天重试！');
		}
	
		if (!empty($res[0])) {
				
			if( time()-strtotime($res[0]['cdate']) < 60) {
				$this->showJson(2,'','请1分钟后重试！');
			}
		}
	
		$code = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	
		$msg = new CLOOPENAPI();
	
		if (empty($_POST['type'])) {
			$res = $msg->SendSMSCode($tel,$code);
		} else {
			$res = $msg->SendVoiceCode($tel,$code);
		}
		$result = json_decode($res,true);
			
		if($result['statusCode'] == '000000'){
			$dataModel->initVar($dataModel);
			$dataModel->tel = $tel;
			$dataModel->code = $code;
			$dataModel->cdate = date("Y-m-d H:i:s");
			$dataModel->save();
			$this->showJson(0,'','');
		}else{
			$this->showJson(2,'','验证码发送失败！');
		}
	}
	
	
	
	
	
	
	
}