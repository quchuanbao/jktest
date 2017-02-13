<?php
class linkUserLog extends commonModel{
	
	public $id;	//自增ID    
	public $userId;	//用户ID
	public $cdate;	//创建日期
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'userlog';
	}
	
	function adminDdTotal($startDate,$endDate) {
		if ($startDate == $endDate ){
			$startDate = $startDate." 00:00:00";
			$endDate = $endDate." 23:59:59";
			$sql = "select count(*) as num,DATE_FORMAT(cdate,'%H') as date
			from userlog
			where cdate >= '{$startDate}' and cdate <= '{$endDate}'
			group by DATE_FORMAT(cdate,'%H')
			";
		} else {
			$startDate = $startDate." 00:00:00";
			$endDate = $endDate." 23:59:59";
			$sql = "select count(*) as num,DATE_FORMAT(cdate,'%Y-%m-%d') as date
					from userlog
					where cdate >= '{$startDate}' and cdate <= '{$endDate}'
					group by DATE_FORMAT(cdate,'%Y-%m-%d')
			";
		}
		
		return $this->db->query_array($sql);
	}
}