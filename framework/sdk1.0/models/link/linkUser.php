<?php
class linkUser extends commonModel{
	
	public $id;	//ID    
	public $realName;	//真实姓名    
	public $tel;	//手机号    
	public $pwd;	//密码    
	public $img;	//头像    
	public $sex;	//没有选择性别：0，男士:1,女士2，默认是字符串0    
	public $email;	//邮件    
	public $born;	//出身日期    
	public $cdate;	//注册时间    
	public $lasttime;	//最后一次登录时间    
	public $address;	//地址    
	public $ismarry;	//0默认，1已婚，2未婚    
	public $ischild;	//0默认，1有小孩，2无小孩    
	public $isvip;	//0默认，1是会员，2准会员，3过期会员    
	public $coachId;	//教练ID    
	public $memberShipId;	//会籍ID    
	public $sourceId;	//会员来源    
	public $visitDate;	//回访日期    
	public $wxnum;	//微信号
	public $cardNum; //身份证号
	public $vipNum; //会员卡号
	public $startDate;//会员卡开始日期
	public $endDate;//会员卡结束日期
	public $cardType;//会员卡类型
	public $totalNum;//会员卡次数
	public $useNum;//会员卡已使用次数
	public $iscoach;//1没购买教练客，2已购买教练课
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'user';
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
	    from user a
	    left join employee b on a.memberShipId = b.id
	    where  ".$whereInfo;
	    return $this->db->query_array($sql);
	}

	function moveuser($ids,$memberShipId){
		$sql = "update user set memberShipId = $memberShipId where id in ($ids) ";
		$this->db->query($sql);
	}
}