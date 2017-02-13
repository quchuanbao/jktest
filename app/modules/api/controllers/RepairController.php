<?php 
/**
 * 器械报修表 * @author bao
 * 
 */


class RepairController extends UController 
{
	/**
	 * 报修申请
	 */
	public function actionApply()
	{
		$num = $_REQUEST['equipment_number'];
		$content = $_REQUEST['fault_desc'];
		if (empty($num) || empty($content) ) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		
		$repairModel = new linkRepair();
		$repairModel->initVar($repairModel);
		$repairModel->num = $num;
		$repairModel->status = 0;
		$info = $repairModel->search();
		if (!empty($info)) {
			$this->showJson(2, '' ,"该设备已报修！");
		}
		
		$repairModel = new linkRepair();
		$repairModel->initVar($repairModel);
		$repairModel->num = $num;
		$repairModel->status = 0;
		$repairModel->content = $content;
		$repairModel->employeeId = $this->uid;
		$repairModel->cdate = date("Y-m-d H:i:s");
		$repairModel->save();
		$res = array();
		$this->showJson(0, $res);
	}
	
	/**
	 * 报修申请记录
	 */
	public function actionlog()
	{
		
		$repairModel = new linkRepair();
		$repairModel->initVar($repairModel);
		$repairModel->employeeId = $this->uid;
		$info = $repairModel->search(" 1=1 order by id desc limit 50 ");
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['equipment_number'] = $v['num'];
			$res[$n]['repair_status'] = $v['status'];
			$res[$n]['repair_time'] = date("Y-m-d H:i",strtotime($v['cdate']));
		}
		$this->showJson(0, $res);
	}
	
	
	function actionDetail(){
	    $num = $_POST['equipment_number'];
	    if (empty($num)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    $dataModel = new linkRepair();
	    $dataModel->initVar($dataModel);
	    $info = $dataModel->search(" num = '{$num}' ");
	    if (empty($info)) {
	        $this->showJson(2,"","故障不存在！");
	    }
	    $info = $info[0];
	    $res['repair_status'] = $info['status'];
	    $res['fault_desc'] = $info['content'];
	    $this->showJson(0,$res);
	}
	
	
	function actionReapir(){
	    $num = $_POST['equipment_number'];
	    if (empty($num)) {
	        $this->showJson(2,"","参数不能为空！");
	    }
	    $dataModel = new linkRepair();
	    $dataModel->initVar($dataModel);
	    $info = $dataModel->search(" num = '{$num}' ");
	    if (empty($info)) {
	        $this->showJson(2,"","故障不存在！");
	    }
	    
	    $dataModel->initVar($dataModel);
	    $dataModel->id = $info[0]['id'];
	    $dataModel->status = 1;
	    $dataModel->modify();
	    $res = array();
	    $this->showJson(0,$res);
	}
}