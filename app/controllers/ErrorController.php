<?php
class ErrorController extends CController
{
	public function actionShowError()
	{
		if($error=Yii::app()->errorHandler->error){
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error');
		}
	}
	/**
	 * 维护页面
	 */
	public  function actionMaintenance(){
		
		$this->render('maintenance');
	}
}