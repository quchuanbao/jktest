<?php
class linkQuestionoption extends commonModel{
	
	public $id;	//自增ID    
	public $name;	//名称   
	public $qid;	//问题ID
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'questionoption';
	}

}