<?php
	Yii::import('zii.widgets.CPortlet');
	class AdminTop extends CPortlet{
		public function renderContent(){
			$this->render('adminTop');
		}
	}