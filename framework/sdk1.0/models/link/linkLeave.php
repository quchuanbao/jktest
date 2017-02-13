<?php
class linkLeave extends commonModel{
	
	public $id;	//自增ID    
	public $employeeId;	//员工ID    
	public $startDate;	//启始日期    
	public $endDate;	//终止日期    
	public $reason;	//请假理由    
	public $audit;	//上级审核意见    
	public $leaderId;	//审核人ID    
	public $status;	//0待审核，1审核通过，2驳回，3作废    
	public $cdate;	//创建日期    
	public $auditDate;//审核日期
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'leave';
	}
    
	//计算请假天数
	function getLeaveNum($uid, $date)
	{
	    $hour = 0.0;
	    for ($i=1; $i<=31; $i++) {
		    if(i<10){
		        $startDate = $date."-0".$i." 00:00:00";
		        $endDate = $date."-0".$i." 23:59:59";
		    } else {
		        $startDate = $date."-".$i." 00:00:00";
		        $endDate = $date."-".$i." 23:59:59";
		    }
		    
		    $sql = "select * from `leave`
        		    where
        		    employeeId in ($uid)
        		    and startDate >= '{$startDate}'
        		    and endDate <= '{$endDate}'
        		    and status = 1 ";
		    $info = $this->db->query_array($sql);
		    $info = $info[0];
		    if (!empty($info)) {
		    	$hour += ( strtotime($info['startDate']) - strtotime($info['endDate']) ) / 3600 ;
		    }
		}
		if ($hour){
		    return number_format($hour,1);
		} else {
			return '0.0';
		}
	}
	
	/**
	 * 得到审核列表
	 */
	function getAuditList($departmentId, $status)
	{
		$sql = " select a.*,b.realName,b.img from `leave` a left join  employee b on a.employeeId = b.id
				 where a.status = '{$status}' and b.departmentId = '{$departmentId}'
				";
		return $this->db->query_array($sql);
	}
}