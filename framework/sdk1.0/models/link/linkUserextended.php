<?php
class linkUserextended extends commonModel{
	
	public $id;	//自增Id
	public $userId;	//会员ID
	public $interestId; //兴趣爱好
	public $interest; //兴趣爱好手填
	public $source; //其他来源
	public $reasonId; //参加俱乐部原因
	public $reason; //其他原因
	public $isadd; //是否加入过俱乐部
	public $iscoach; //是否请过教练
	public $remark; //备注
	public $cpname; //公司名称
	public $cpaddress; //公司地址
	public $cptel; //公司电话
	public $cppost; //公司邮编
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'userextended';
	}

}