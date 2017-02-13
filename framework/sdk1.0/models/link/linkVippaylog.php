<?php
class linkVippaylog extends commonModel{
	
	public $id;	//自增ID    
	public $userId;	//会员ID    
	public $cardType;	//0默认，1年卡，2半年卡，3季卡，4月卡，5次卡    
	public $startDate;	//开始日期    
	public $endDate;	//结束日期    
	public $totalNum;	//总次数    
	public $useNum;	//已用次数    
	public $cardNum;	//证件号码    
	public $payable;	//应付    
	public $payMoney;	//实付    
	public $payType;	//0默认，1现金，2刷卡，3支票    
	public $remark;	//备注    
	public $applyId;	//申请人ID    
	public $reviewId;	//财务审核人ID    
	public $leaderId;	//部门审核人Id    
	public $status;	//0默认，1待主管审核，2待财务审核，3生效，4作废    
	public $cdate;	//创建日期    
	public $reviewDate;	//财务审核日期    
	public $leaderDate;	//部门主管审核日期    
	public $leaderRemark;	//部门主管审核意见    
	public $contract; //合同编号
	public $leaveNum; //假期天数
	public $leaveUseNum; //假期已用天数
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'vippaylog';
	}
    
	/**
	 * api获取用户支付列表
	 * @param unknown $uid
	 */
	function getApiList($uid)
	{
		$sql = "select a.*,b.realName as applyName,c.realName as leaderName,d.realName as reviewName
		        from vippaylog a 
		        left join employee b on a.applyId = b.id
		        left join employee c on a.leaderId = c.id
		        left join employee d on a.reviewId = d.id 
		        where a.userId = '{$uid}' ";
		return $this->db->query_array($sql);
	}
	
	
	/**
	 * api获取用户支付列表
	 * @param unknown $uid
	 */
	function getAdminAudit($where)
	{
		$sql = "select a.*,b.realName as applyName,c.realName as leaderName,d.realName as reviewName
				from vippaylog a
				left join employee b on a.applyId = b.id
				left join employee c on a.leaderId = c.id
				left join employee d on a.reviewId = d.id
				where  " .$where;
		return $this->db->query_array($sql);
	}
	/**
	 * api获取用户支付列表
	 * @param unknown $uid
	 */
	function getAdminAuditCount($where)
	{
		$sql = "select count(*) as num
				from vippaylog a
				left join employee b on a.applyId = b.id
				left join employee c on a.leaderId = c.id
				left join employee d on a.reviewId = d.id
				where  " .$where;
		$res = $this->db->query_array($sql);
		return $res[0]['num'];
	}
	
	/**
	 * 获取审核列表
	 */
	function getAuditList($status)
	{
		$sql = "select a.id,a.cdate,a.leaderDate,a.userId,b.img,b.realName from vippaylog a
				left join user b on a.userId = b.id
				where a.status = $status
				";
		return $this->db->query_array($sql);
	}
}