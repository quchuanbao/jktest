<?php
class linkVisitlog extends commonModel{
	
	public $id;	//自增ID    
	public $employeeId;	//员工Id    
	public $content;	//回访内容    
	public $telTime;	//通话时长    
	public $telNum;	//呼叫次数    
	public $cdate;	//呼叫日期 
	public $userId; //用户ID   
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'visitlog';
	}
	
	/**
	 * 获取列表用户回信息
	 */
	function getUserList($userId , $limit)
	{
		if (intval($limit)) {
			$limit = " limit $limit ";
		}
	    $sql = "select a.*,b.realName from visitlog a left join employee b on a.employeeId = b.id 
		        where a.userId =  '{$userId}'  order by a.id desc ".$limit."
		        ";
		$res = $this->db->query_array($sql);
		return $res;
	}
	
	/**
	 * 获取列表用户回访次数
	 */
	function getUserListCount($userId)
	{
	    $sql = "select count(*) as num from visitlog where userId =  '{$userId}' ";
	    $res = $this->db->query_array($sql);
	    return $res[0]['num'];
	}
	


}