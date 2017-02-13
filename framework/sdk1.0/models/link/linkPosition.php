<?php
class linkPosition extends commonModel{
	
	public $id;	//自增ID    
	public $name;	//部门名称    
	public $parentId;	//父类ID    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'position';
	}

}