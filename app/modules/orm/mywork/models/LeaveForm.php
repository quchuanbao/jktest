<?php 
/**
 *  请假表 * @author bao
 * 
 */;

class LeaveForm extends CFormModel
{
	public $id;	//自增ID	
	public $employeeId;	//员工ID	
	public $startDate;	//启始日期	
	public $endDate;	//终止日期	
	public $reason;	//请假理由	
	public $audit;	//上级审核意见	
	public $leaderId;	//审核人ID	
	public $status;	//0待审核，1审核通过，2驳回，3作废	
	public $cdate;	//创建日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('employeeId,startDate,endDate,reason,audit,leaderId,status,cdate',
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
		$data['formName'] = " 请假表管理";
		$data['id'] = '自增ID'; 
		$data['employeeId'] = '员工ID'; 
		$data['startDate'] = '启始日期'; 
		$data['endDate'] = '终止日期'; 
		$data['reason'] = '请假理由'; 
		$data['audit'] = '上级审核意见'; 
		$data['leaderId'] = '审核人ID'; 
		$data['status'] = '0待审核，1审核通过，2驳回，3作废'; 
		$data['cdate'] = '创建日期'; 
		return $data;
	}
}