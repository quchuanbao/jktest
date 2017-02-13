<?php
class linkCourseOrder extends commonModel{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $employeeId;	//教练ID
    public $startDate;	//开始日期
    public $startTime;	//开始时间
    public $endTime;	//结束时间
    public $status;	//状态：1未确认，2已确认
    public $type;   //1学员发起，2教练发起
    public $cdate;
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'courseorder';
	}
	
	function apiList($id)
	{
		$sql = " select a.*,b.realName as memberName,b.img
		        from course a 
		        left join  user b on a.userId = b.id
		        
		        where a.id = $id  limit 1
		        ";
		$res = $this->db->query_array($sql);
		
		$sql = " select num,usenum from  coursebuy where userId = '{$res[0]['userId']}' order by id desc limit 1 ";
		$info = $this->db->query_array($sql);
		$res[0]['num'] = $info[0]['num'];
		$res[0]['usenum'] = $info[0]['usenum'];
		return $res[0];
	}
	
	function searchList($employeeId,$members,$date,$lastId,$limit = 10)
	{
		$where = " where a.employeeId = $employeeId ";
	    if (!empty($members)) {
			$where.=' and a.userId in ( "'.$members.'" ) ';
		}
		if (!empty($date)) {
		    $where.=" and left(a.startDate,7) = '{$date}' ";
		}
		if (!empty($lastId)) {
		    $where.=" and a.id < $lastId ";
		}
		
	    $sql = " select a.*,b.realName as memberName
		        from course a 
		        left join user b on a.userId = b.id
		        
		        ".$where." order by a.id desc limit $limit ";
	    $res = $this->db->query_array($sql);
	    foreach ($res as $n => $v) {
	        $sql = " select num,usenum from  coursebuy where userId = '{$v['userId']}' order by id desc limit 1 ";
	        $info = $this->db->query_array($sql);
	        $res[$n]['num'] = $info[0]['num'];
	        $res[$n]['usenum'] = $info[0]['usenum'];
	    }
	    return $res;
	}
	
	function searchListCount($employeeId,$members,$date)
	{
	    $where = " where a.status = 1 and a.employeeId = $employeeId ";
	    if (!empty($members)) {
	        $where.=' and a.userId in ( "'.$members.'" ) ';
	    }
	    if (!empty($date)) {
	        $where.=" and left(a.startDate,7) = '{$date}' ";
	    }
	
	    $sql = " select count(*) as num
		        from course a
		        left join user b on a.userId = b.id
		        left join coursebuy c on a.userId = c.userId
		        ".$where;
	    $res = $this->db->query_array($sql);
	    return $res[0]['num'];
	}
}