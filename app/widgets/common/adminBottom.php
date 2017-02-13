<?php
	Yii::import('zii.widgets.CPortlet');
	class AdminBottom extends CPortlet{
		public function renderContent(){
			$this->render('adminBottom');
		}
	}