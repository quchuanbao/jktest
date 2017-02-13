<?php
class SiteController extends CController
{
 
    public function actionIndex()
	{
		$this->layout = '';
		if (!empty(Yii::app()->session['employee'])){
			$this->redirect('/search');
		}
		$model = new LoginForm();
		if (isset($_POST['LoginForm'])) {
			//登陆操作
			$model->attributes = $_POST['LoginForm'];
			if($model->validate()){
				$adminModel = new linkEmployee();
				$adminModel->initVar($adminModel);
				$adminModel->tel = $model->userName;
				$adminModel->pwd = md5($model->password);
				$adminModel->positionId = 7;//前台
				$userInfo = $adminModel->search();
				Yii::app()->session['employee'] = $userInfo[0];
		
				$adminModel->initVar($adminModel);
				$adminModel->id        = $userInfo[0]['id'];
				$adminModel->lasttime = date("Y-m-d H:i:s");
				$adminModel->modify();
				$this->redirect('/search');
			}
		}
		$data['model'] = $model;
		$this->render('login',$data);
	}
	
}