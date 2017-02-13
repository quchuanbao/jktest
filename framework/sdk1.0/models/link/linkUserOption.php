<?php
class linkUserOption extends commonModel{
	
	public $id;	//自增ID    
	public $qid;	//名称   
	public $optionId;	//1运动背景资料，2回访问题
	public $userid;
	public $class;
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'useroption';
	}
	
	

}