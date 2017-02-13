<?php
class linkEmployee extends commonModel{
	
	public $id;	//ID    
	public $realName;	//真实姓名    
	public $tel;	//手机号    
	public $pwd;	//密码    
	public $img;	//头像    
	public $sex;	//没有选择性别：0，男士:1,女士2，默认是字符串0    
	public $born;	//出身日期    
	public $cdate;	//注册时间    
	public $lasttime;	//最后一次登录时间    
	public $departmentId;	//部门ID    
	public $status;	//1有效，2无效，3删除    
	public $positionId;	//职位ID
	public $lng;
	public $lat;    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'employee';
	}
	
	/**
	 * 管理首页部门员工列表
	 * @param unknown $departmentId
	 * @param unknown $order
	 */
	function apiManageList($departmentId, $positionId, $order = 1 , $type = 1) {
	    $year = date("Y");
	    $month = date("m");
	    
	    $sql = "select * from employee where departmentId = '{$departmentId}' and positionId = '{$positionId}' ";
	    $info = $this->db->query_array($sql);
	    foreach ($info as $n => $v) {
	    	$sql = " select * from resultslog where year = '{$year}' and month = '{$month}' and employeeId = '{$v['id']}' ";
	    	$res = $this->db->query_array($sql);
	    	if (empty($res)) {
	    		$sql = " insert into resultslog (employeeId,year,month) values ('{$v['id']}','{$year}','{$month}')";
	    		$this->db->query($sql);
	    	}
	    }
	    
	    if ($type == 1) {
	         //会籍
	    	$userType = "memberShipId";
	    }
	    if ($type == 2) {
	        //教练
	        $userType = "coachId";
	    }
	    
	    switch ($order) {
	    	case 1:
	    	    //按完成业绩排序
	    	    $sql = " select a.*,b.num,b.completeNum,c.novipNum,d.vipNum 
        	    	    from employee a
        	    	    left join resultslog b on a.id = b.employeeId
        	    	    left join ( select count(*) as novipNum,{$userType} as uid from user where  isvip = 1 group by  {$userType}  ) c on a.id = c.uid 
        	    	    left join ( select count(*) as vipNum,{$userType} as uid from user where  isvip = 2 group by  {$userType}  ) d on a.id = d.uid
        	    	    where 
        	    	    a.departmentId = '{$departmentId}' 
        	    	    and a.positionId = '{$positionId}'
        	    	    and b.year = '{$year}'
        	    	    and b.month = '{$month}' 
        	    	    order by b.completeNum desc ";
	    	    break;
	    	case 2:
	    	    //按完分配业绩排序
	    	    $sql = " select a.*,b.num,b.completeNum,c.novipNum,d.vipNum 
        	    	    from employee a
        	    	    left join resultslog b on a.id = b.employeeId
        	    	    left join ( select count(*) as novipNum,{$userType} as uid from user where  isvip = 1 group by  {$userType}  ) c on a.id = c.uid 
        	    	    left join ( select count(*) as vipNum,{$userType} as uid from user where  isvip = 2 group by  {$userType}  ) d on a.id = d.uid
        	    	    where
        	    	    a.departmentId = '{$departmentId}'
        	    	    and a.positionId = '{$positionId}'
        	    	    and b.year = '{$year}'
        	    	    and b.month = '{$month}'
        	    	    order by b.num desc ";
	    	    $userInfo = $this->db->query_array($sql);
	    	    break;
	    	case 3:
	    	    //准会员排序
	    	    $sql = " select a.*,b.num,b.completeNum,c.novipNum,d.vipNum 
        	    	    from employee a
        	    	    left join resultslog b on a.id = b.employeeId
        	    	    left join ( select count(*) as novipNum,{$userType} as uid from user where  isvip = 1 group by  {$userType}  ) c on a.id = c.uid 
        	    	    left join ( select count(*) as vipNum,{$userType} as uid from user where  isvip = 2 group by  {$userType}  ) d on a.id = d.uid
        	    	    where
        	    	    a.departmentId = '{$departmentId}'
        	    	    and a.positionId = '{$positionId}'
        	    	    and b.year = '{$year}'
        	    	    and b.month = '{$month}'
        	    	    order by c.novipNum
        	    	   ";
	    	    $userInfo = $this->db->query_array($sql);
	    	    break;
	    	case 4:
    	        //会员排序
    	        $sql = " select a.*,b.num,b.completeNum,c.novipNum,d.vipNum
	    	        from employee a
	    	        left join resultslog b on a.id = b.employeeId
	    	        left join ( select count(*) as novipNum,{$userType} as uid from user where  isvip = 1 group by  {$userType}  ) c on a.id = c.uid
	    	        left join ( select count(*) as vipNum,{$userType} as uid from user where  isvip = 2 group by  {$userType}  ) d on a.id = d.uid
	    	        where
	    	        a.departmentId = '{$departmentId}'
	    	        and a.positionId = '{$positionId}'
	    	        and b.year = '{$year}'
	    	        and b.month = '{$month}'
	    	        order by d.vipNum
    	        ";
    	        break;
	    }
		
	    return  $this->db->query_array($sql);
	}
	
	function setCoordinate($ids,$lat,$lng)
	{
		$sql = "update employee set lng = '{$lng}',lat = '{$lat}' where id in ({$ids}) ";
		$this->db->query($sql);
	}
	
	function getCoordinate($ids)
	{
		$sql = "select * from employee where id in ($ids)";
		return $this->db->query_array($sql);
	}
	

}
