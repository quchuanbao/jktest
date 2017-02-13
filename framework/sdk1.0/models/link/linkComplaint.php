<?php
class linkComplaint extends commonModel{
	
	public $id;	//自增ID    
	public $userId;	//会员ID    
	public $content;	//投诉内容    
	public $cdate;	//创建日期    
	public $deparentId;	//所属部门ID    
	public $status;	//0未分配，1处理中，2处理完成，3无效投诉    
	public $employeeId;	//创建员工ID    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'complaint';
	}
	
	
	function getList($status, $lastId ,$page)
	{
		if ($lastId) {
			$last = "  a.id < $lastId ";
		}
		if (!$page) {
			$page = 10;
		}
		$sql = "select a.*,b.cdate as comDate from complaint a left join complaintlog b  on a.id = b.complaintId 
				where a.status = $status ".$last." order by a.id desc limit $page
				";
		return $this->db->query_array($sql);
	}
	
	function getDetail($userId, $lastId ,$page)
	{
		if ($lastId) {
			$last = "  a.id < $lastId ";
		}
		if (!$page) {
			$page = 10;
		}
		$sql = "select a.*,b.cdate as comDate,c.realName
				from complaint a left join complaintlog b  on a.id = b.complaintId
				left join employee c on a.employeeId = c.id 
				where a.userId = $userId ".$last." order by a.id desc limit $page
				";
		return $this->db->query_array($sql);
	}
}