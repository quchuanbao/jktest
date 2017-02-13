<?php 
/**
 * 考勤表 * @author bao
 * 
 */;

class AttendanceForm extends CFormModel
{
	public $id;	//自增ID	
	public $employeeId;	//员工ID	
	public $cdate;	//签到日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('employeeId,cdate',
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
		$data['formName'] = "考勤表管理";
		$data['id'] = '自增ID'; 
		$data['employeeId'] = '员工ID'; 
		$data['cdate'] = '签到日期'; 
		return $data;
	}
}