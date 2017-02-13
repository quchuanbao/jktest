<?php
class linkCourseinstrument extends commonModel{
	
    public $id;	//自增ID    
	public $name;	//名称
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'courseinstrument';
	}
}