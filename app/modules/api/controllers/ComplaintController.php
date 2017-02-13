<?php 
/**
 *  投诉表 * @author bao
 * 
 */


class ComplaintController extends UController 
{
/**
	 * 投诉列表
	 */
	public function actionList()
	{
		$status = $_REQUEST['process_status'];
		if ($status) {
			$status = 2;
		} else {
			$status = 1;
		}
		$lastId = $_REQUEST['last_id'];
		$page = $_REQUEST['page'];
		if (empty($status)) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		$complaintModel = new linkComplaint();
	
		$info = $complaintModel->getList($status, $lastId, $page);
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['complaint_code'] = $v['id'];
			$res[$n]['member_id'] = $v['userId'];
			$res[$n]['content'] = $v['content'];
			$res[$n]['complaint_time'] = $v['cdate'];
			$res[$n]['process_time'] = $v['comDate'];
		}
		
		$this->showJson(0, $res);
	}
	
	/**
	 * 投诉detail
	 */
	public function actionDetail()
	{
		$userId = $_REQUEST['member_id'];
		$lastId = $_REQUEST['last_id'];
		$page = $_REQUEST['page'];
		if (empty($userId)) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		$complaintModel = new linkComplaint();
	
		$info = $complaintModel->getDetail($userId, $lastId, $page);
		$res = array();
		foreach ($info as $n => $v) {
			$res[$n]['complaint_code'] = $v['id'];
			if ($v['status'] == 1) {
				$res[$n]['process_status'] = 0;
			}
			if ($v['status'] == 2) {
				$res[$n]['process_status'] = 1;
			}
			$res[$n]['customer_service'] = $v['realName'];
			$res[$n]['content'] = $v['content'];
			$res[$n]['complaint_time'] = $v['cdate'];
			$res[$n]['process_time'] = $v['comDate'];
		}
	
		$this->showJson(0, $res);
	}
	
	
	/**
	 * 投诉detail
	 */
	public function actionUpdate()
	{
		$userId = $_REQUEST['member_id'];
		$id = $_REQUEST['complaint_code'];
		$content = $_REQUEST['process_result'];
		
		if (empty($userId) || empty($id) || empty($content)) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		
		$complaintModel = new linkComplaint();
		$complaintModel->initVar($complaintModel);
		$complaintModel->id = $id;
		$info = $complaintModel->search();
		if (empty($info)) {
			$this->showJson(2, '' ,"投诉单不存在！");
		}
		
		$complaintModel = new linkComplaint();
		$complaintModel->initVar($complaintModel);
		$complaintModel->id = $id;
		$complaintModel->status = 2;
		$complaintModel->modify();
		
		$complaintModel = new linkComplaintlog();
		$complaintModel->initVar($complaintModel);
		$complaintModel->employeeId = $this->uid;
		$complaintModel->content = $content;
		$complaintModel->cdate = date("Y-m-d H:i:s");
		$complaintModel->complaintId = $id;
		$complaintModel->save();
		$res = array();
		$this->showJson(0, $res);
	}
	
}