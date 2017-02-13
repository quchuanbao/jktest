<?php
	Yii::import('zii.widgets.CPortlet');
	class Notice extends CPortlet{
		public function renderContent(){
			$this->render('notice');
		}
	}