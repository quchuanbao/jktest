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
	public $cardNum;	//会员卡号
	public $contract; //合同编号
	public $leaveNum; //假期天数
	public $leaveUseNum; //假期已用天数
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('cardType, startDate, endDate, payable, payMoney',
					'required',
					'message'=>'不能为空',
					'on' => 'add'	
					),
				array('cardNum, payType',
						'required',
						'message'=>'不能为空',
						'on' => 'audit'
				),
				array('totalNum,remark,status,leaderRemark,contract,leaveNum','safe'),
		);
	}
	
	
}