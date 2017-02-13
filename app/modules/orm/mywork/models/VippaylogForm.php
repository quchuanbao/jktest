<?php 
/**
 * 会员购买记录表 * @author bao
 * 
 */;

class VippaylogForm extends CFormModel
{
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
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId,cardType,startDate,endDate,totalNum,useNum,cardNum,payable,payMoney,payType,remark,applyId,reviewId,leaderId,status,cdate,reviewDate,leaderDate,leaderRemark',
					'required',
					'message'=>'不能为空',
					),
		);
	}
	
	/**
	 * 获取属性名称
	 */
	function getOptionName()
	{
		$data['formName'] = "会员购买记录表管理";
		$data['id'] = '自增ID'; 
		$data['userId'] = '会员ID'; 
		$data['cardType'] = '0默认，1年卡，2半年卡，3季卡，4月卡，5次卡'; 
		$data['startDate'] = '开始日期'; 
		$data['endDate'] = '结束日期'; 
		$data['totalNum'] = '总次数'; 
		$data['useNum'] = '已用次数'; 
		$data['cardNum'] = '证件号码'; 
		$data['payable'] = '应付'; 
		$data['payMoney'] = '实付'; 
		$data['payType'] = '0默认，1现金，2刷卡，3支票'; 
		$data['remark'] = '备注'; 
		$data['applyId'] = '申请人ID'; 
		$data['reviewId'] = '财务审核人ID'; 
		$data['leaderId'] = '部门审核人Id'; 
		$data['status'] = '0默认，1待主管审核，2待财务审核，3生效，4作废'; 
		$data['cdate'] = '创建日期'; 
		$data['reviewDate'] = '财务审核日期'; 
		$data['leaderDate'] = '部门主管审核日期'; 
		$data['leaderRemark'] = '部门主管审核意见'; 
		return $data;
	}
}