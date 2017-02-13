<?php
class linkRepair extends commonModel{
	
	public $id;	//自增ID    
	public $num;	//器械编号    
	public $content;	//故障描述    
	public $employeeId;	//员工ID    
	public $status;	//0维修中，1已修完    
	public $cdate;	//创建日期    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'repair';
	}

}