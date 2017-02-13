<?php
class linkAttendance extends commonModel{
	
	public $id;	//自增ID    
	public $employeeId;	//员工ID    
	public $startDate;	//签到日期    
	public $endDate;	//签到日期
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'attendance';
	}
	
	
	//计算请假天数
	function getLateNum($uid, $date, $startNum = '09' ,$endNum = '18' )
	{
	    $day = 0;
	    for ($i=1; $i<=31; $i++) {
	        if(i<10){
	            $startDate = $date."-0".$i." ".$startNum.":00:00";
	            $endDate = $date."-0".$i." ".$endNum.":00:00";
	        } else {
	            $startDate = $date."-".$i." ".$startNum.":00:00";
	            $endDate = $date."-".$i." ".$endNum.":00:00";
	        }
	
	        $sql = "select * from `attendance`
        	        where
        	        employeeId in ($uid)
        	        and ( startDate < '{$startDate}' or endDate > '{$endDate}' )
        	        ";
	        $info = $this->db->query_array($sql);
	        if (!empty($info)) {
	            $day++;
		    }
	   }
	   return $day;
	}

}