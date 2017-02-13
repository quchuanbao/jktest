<?php
	Yii::import('zii.widgets.CPortlet');
	class District extends CPortlet{
		public function renderContent(){
			$province = new linkProvince();
			$province->initVar($province);
			$data['info'] = $province->search();
			if (!empty($_REQUEST['province'])) {
				$city = new linkCity();
				$city->initVar($city);
				$city->pid = $_REQUEST['province'];
				$data['cityInfo'] = $city->search();
			}
			if (!empty($_REQUEST['city'])) {
				$district = new linkDistrict();
				$district->initVar($district);
				$district->cityId = $_REQUEST['city'];
				$data['districtInfo'] = $district->search();
			}
			$this->render('district',$data);
		}
	}