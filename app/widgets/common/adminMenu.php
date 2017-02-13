<?php
	Yii::import('zii.widgets.CPortlet');
	class AdminMenu extends CPortlet{
		public function renderContent(){
			$this->render('adminMenu');
		}
	}