<?php
class linkOpinion extends commonModel{
	
	public $id;	//自增ID    
	public $employeeId;	//员工ID    
	public $content;	//意见内容    
	public $cdate;	//创建日期    
	public $type;
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'opinion';
	}

}