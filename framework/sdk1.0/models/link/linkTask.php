<?php
class linkTask extends commonModel{
	
	public $id;	//自增ID    
	public $content;	//任务内容    
	public $employeeId;	//用户ID    
	public $noticeDate;	//提醒日期    
	public $complete;	//完成日期    
	public $remark;	//备注    
	public $parentId;	//父类ID    
	public $status;	//0默认，1未完成，2已完成    
	public $leaderId;	//分配人ID    
	public $cdate;	//创建日期    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'task';
	}
	
	/**
	 * 获取用户任务列表
	 * @param unknown $userId
	 * @param unknown $lastId
	 * @param unknown $data
	 * @param unknown $limit
	 */
	function getList($userId, $lastId ,$data, $limit)
	{
		if (empty($limit)) {
			$limit = 10;
		}
		
		if (!empty($lastId)) {
			$lastId = " and  a.id < '{$lastId}'   ";
		}
		$sql = "select a.*,b.realName as dispatcher,b.positionId  from task a left join employee b on a.leaderId = b.id
				where 
				a.employeeId = '{$userId}' 
				and left(a.cdate,10) = '{$data}'
				and a.parentId = ''  
				".$lastId."
		        order by a.id desc limit $limit ";
		return $this->db->query_array($sql);
	}
	
	/**
	 * 获取子任务
	 * @param unknown $id
	 * @return Ambigous <multitype:, multitype:multitype: , unknown>
	 */
	function getChirldList($id)
	{
	   
	    $sql = "select a.*,b.realName as dispatcher,b.positionId  from task a left join employee b on a.employeeId = b.id
	    where
	    a.parentId = '{$id}' ";
	    return $this->db->query_array($sql);
	}
	
	/**
	 * 用户删除记录
	 * @param unknown $userId
	 * @param unknown $id
	 */
	function delById($userId,$id){
		$sql = "delete from task where id in ($id) and employeeId = $userId ";
		$this->db->query($sql);
	}
	
	/**
	 * 用户删除子记录
	 * @param unknown $userId
	 * @param unknown $id
	 */
	function delByChirldId($userId,$id,$parentId){
		$sql = "delete from task where id in ($id) and employeeId = $userId and parentId = $parentId ";
		$this->db->query($sql);
	}
	/**
	 * 根据日期进行汇总
	 * @param unknown $start
	 * @param unknown $end
	 */
	function getBydate($uid, $start, $end)
	{
		$sql = "select * from task where parentId = '' and  employeeId in ({$uid}) and  cdate>='{$start}' and cdate<='{$end}' order by id desc  ";
		return $this->db->query_array($sql);
	}
	
	/**
	 * 获取用户搜索列表
	 * @param unknown $userId
	 * @param unknown $lastId
	 * @param unknown $data
	 * @param unknown $limit
	 */
	function getSearch($userId, $keyword, $lastId , $limit)
	{
	    if (empty($limit)) {
	        $limit = 10;
	    }
	
	    if (!empty($lastId)) {
	        $lastId = " and  a.id < '{$lastId}'   ";
	    }
	    $sql = "select a.*,b.realName as dispatcher,b.positionId  from task a left join employee b on a.leaderId = b.id
	    where
	    a.employeeId = '{$userId}'
	    and a.content like '%{$keyword}%'
	    and a.parentId = ''
	    ".$lastId."
	    order by a.id desc limit $limit ";
	    return $this->db->query_array($sql);
	}
	
	
	
	/**
	 * 获取用户任务列表
	 * @param unknown $userId
	 * @param unknown $lastId
	 * @param unknown $data
	 * @param unknown $limit
	 */
	function getManageList($userId,$data, $status)
	{

	    $sql = "select a.*,b.realName,b.img  from task a left join employee b on a.employeeId = b.id
	    where
	    a.leaderId = '{$userId}'
	    and left(a.cdate,10) = '{$data}' 
	    and a.status = '{$status}' 
	    and a.parentId = '' 
	    order by a.id desc  ";
	    return $this->db->query_array($sql);
	}
	
	/**
	 * 管理详情
	 */
	function getManageDetail($userId, $status = 1)
	{
		$sql = "select count(*) as num from task where employeeId = '{$userId}' and status = '{$status}' ";
		$res = $this->db->query_array($sql);
		return $res[0]['num'];
	}
	
}