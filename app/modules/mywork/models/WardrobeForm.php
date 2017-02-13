<?php 
/**
 * 衣柜租用 * @author bao
 * 
 */;

class WardrobeForm extends CFormModel
{
	public $id;	//自增ID	
	public $num;	//衣柜编号	
	public $userId;	//会员ID	
	public $employeeId;	//员工ID	
	public $startDate;	//开始日期	
	public $endDate;	//结束日期	
	public $status;	//0未归还，1已归还	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('num,userId,employeeId,startDate,endDate,status',
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
		$data['formName'] = "衣柜租用管理";
		$data['id'] = '自增ID'; 
		$data['num'] = '衣柜编号'; 
		$data['userId'] = '会员ID'; 
		$data['employeeId'] = '员工ID'; 
		$data['startDate'] = '开始日期'; 
		$data['endDate'] = '结束日期'; 
		$data['status'] = '0未归还，1已归还'; 
		return $data;
	}
}