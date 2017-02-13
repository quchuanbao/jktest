<?php
class linkWardrobe extends commonModel{
	
	public $id;	//自增ID    
	public $num;	//衣柜编号    
	public $userId;	//会员ID    
	public $employeeId;	//员工ID    
	public $startDate;	//开始日期    
	public $endDate;	//结束日期    
	public $status;	//0未归还，1已归还    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'wardrobe';
	}

}