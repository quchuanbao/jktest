<?php
class linkCourseBuy extends commonModel{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $employeeId;	//教练ID
    public $num;	 //次数
    public $price;	//单价
    public $total;	//支付总金额
    public $paytype;	//1现金2信用卡3支票
    public $remark;	//备注
    public $cdate;	//创建日期
    public $status;	//1成功
    public $auditDate;
    public $auditRemark;
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'coursebuy';
	}
	
	function apiList($userId)
	{
		$sql = " select a.*,b.realName as coach, c.realName as finance ,d.realName as manager
		         from coursebuy a
		         left join employee b on a.employeeId = b.id
		         left join employee c on a.financeId = c.id
		         left join employee d on a.manageId = d.id
		        ";
		return $this->db->query_array($sql);
	}
	
	function apiAduitList($status,$lastId,$limit)
	{
	    if ($lastId) {
	    	$where = " and a.id < $lastId ";
	    }
	    if (empty($limit)) {
	    	$limit = 10;
	    }
	    $sql = " select a.*,b.realName,b.img from coursebuy a
	             left join user b on a.userId = b.id 
	             where a.status = $status  ".$where."
	             order by a.id desc limit $limit 
		        ";
	    return $this->db->query_array($sql);
	}
	
}