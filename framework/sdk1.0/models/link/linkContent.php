<?php
class linkContent extends commonModel{
	
	public $id;	//ID    
	public $mid;	//用户ID    
	public $pic;	//图片    
	public $content;	//内容    
	public $cdate;	//创建日期    
	public $pv;	//浏览数量    
	public $status;	//1正常，2删除    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'content';
	}

}