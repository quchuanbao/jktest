<?php
class linkComplaintlog extends commonModel{
	
	public $id;	//自增ID    
	public $complaintId;	//投诉ID    
	public $employeeId;	//员工ID    
	public $content;	//处理意见    
	public $cdate;	//创建日期    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'complaintlog';
	}

}