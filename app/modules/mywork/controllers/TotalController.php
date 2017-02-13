<?php 
/**
 * 会员表 * @author bao
 * 
 */


class TotalController extends Controller 
{
	public $layout='main';
	/**
	 * 显示会员表 
	 */
	public function actionIndex() 
	{
		$model = new TotalForm();
		$model->attributes = $_POST['TotalForm'];
		
		
		if (empty($model->startDate)) {
			$model->startDate = date("Y-m-d");
		}
		if (empty($model->endDate)) {
			$model->endDate = date("Y-m-d");
		}
		
		$dateModel = new linkUserLog();
		$info = $dateModel->adminDdTotal($model->startDate,$model->endDate);
		foreach ($info as $n => $v) {
			$totalInfo[$v['date']] = $v['num'];
		}
		
		$starDate = strtotime($model->startDate);
		$endDate = strtotime($model->endDate);
		if ($starDate == $endDate) {
			for ($i = 0; $i <= 23; $i++) {
				if ($i < 10) {
					$j='0'.$i;
				} else {
					$j = $i;
				}
				$res['date'][$i] = $j;
				$res['value'][$i] = intval($totalInfo[$j]);
			}
			
		} else {
			$days = ($endDate - $starDate)/86400;
			for ($i = 0; $i <= $days; $i++) {
				$res['date'][$i] = date("d",$starDate + 86400*$i);
				$date = date("Y-m-d",$starDate + 86400*$i);
				$res['value'][$i] = intval($totalInfo[$date]);
			}
		}
		$data['date'] = json_encode($res['date']);
		$data['value'] = json_encode($res['value']);
		$data['model'] = $model;
		$this->render('userlog',$data);
	}
	
	public function actionPay()
	{
	    $data = array();
	    $this->render('pay',$data);
	}
	
	public function actionRe()
	{
	    $data = array();
	    $this->render('re',$data);
	}
	
	public function actionXu()
	{
	    $data = array();
	    $this->render('xu',$data);
	}
	
	public function actionDao()
	{
	    $data = array();
	    $this->render('dao',$data);
	}
	
	public function actionJiao()
	{
	    $data = array();
	    $this->render('jiao',$data);
	}
	
	public function actionBi()
	{
	    $data = array();
	    $this->render('bi',$data);
	}
}
