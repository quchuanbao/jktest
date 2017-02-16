<?php
class linkUsertel extends commonModel{
	
	public $id;	//ID    
	public $tel;	//
	public $empolyeeId;	//
	public $cdate;	//
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'usertel';
	}
	
	function getApiList($uid)
	{
		$sql = "select a.*,b.realName as coachName,c.realName as hjName 
		        from user a 
		        left join employee b on a.coachId = b.id 
		        left join employee c on a.memberShipId = c.id
		        where a.id = $uid  ";
		$res = $this->db->query_array($sql);
		return $res[0];
	}
	
	/**
	 * 得到分配会员
	 */
	function getDistribut($sql)
	{
		return $this->db->query_array($sql);
	}
	
	
	function getList($whereInfo)
	{
	    $sql = "select a.*,b.realName as memberShipName
	    from usertel a
	    left join employee b on a.empolyeeId = b.id
	    where  ".$whereInfo;
	    return $this->db->query_array($sql);
	}

	function moveuser($ids,$memberShipId){
		$sql = "update user set memberShipId = $memberShipId where id in ($ids) ";
		$this->db->query($sql);
	}
}