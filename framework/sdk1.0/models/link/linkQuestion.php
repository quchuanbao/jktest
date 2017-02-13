<?php
class linkQuestion extends commonModel{
	
	public $id;	//自增ID    
	public $name;	//名称   
	public $type;	//1运动背景资料，2回访问题
	public $class;
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'question';
	}

}