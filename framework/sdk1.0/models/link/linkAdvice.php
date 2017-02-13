<?php
class linkAdvice extends commonModel{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $content;	//内容
    public $cdate;	//日期
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'advice';
	}
}