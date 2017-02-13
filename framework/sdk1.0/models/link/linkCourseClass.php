<?php
class linkCourseClass extends commonModel{
    public $id;	//自增ID
    public $employeeId;	//教练ID
    public $startDate;	//开始日期
    public $startTime;	//开始时间
    public $endTime;	//结束时间
    public $siteId;//场地ID
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'courseclass';
	}
}