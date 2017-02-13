<?php
	Yii::import('zii.widgets.CPortlet');
	class UserCompany extends CPortlet{
		public function renderContent(){
			
			$model = new UserextendedForm();
			$data['model'] = $model;
			$this->render('userCompany');
		}
	}