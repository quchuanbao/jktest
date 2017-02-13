<?php
class linkUserleave extends commonModel{
	
	public $id;	//自增ID    
	public $userId;	//用户名
	public $cardNum;	//关联卡号
	public $num;	//请假天数
	public $startDate;	//开始日期
	public $endDate; //结束日期
	public $cdate; //
	
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'userleave';
	}

}