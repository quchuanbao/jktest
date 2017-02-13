<?php
class linkResultsdepartmentlog extends commonModel{
	
	public $id;	//自增Id    
	public $departmentId;	//用户ID    
	public $year;	//年    
	public $month;	//月份    
	public $num;	//业绩    
	public $completeNum;	//完成业绩    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'resultsdepartmentlog';
	}

}