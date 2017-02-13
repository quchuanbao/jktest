<?php
class linkSource extends commonModel{
	
	public $id;	//自增ID    
	public $name;	//来源名称    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'source';
	}

}