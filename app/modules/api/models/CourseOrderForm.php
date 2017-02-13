<?php 
/**
 * 课程表 * @author bao
 * 
 */;

class CourseOrderForm extends CFormModel
{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $employeeId;	//教练ID
    public $startDate;	//开始日期
    public $startTime;	//开始时间
    public $endTime;	//结束时间
    public $type;
    public $status;	//状态：1未确认，2已确认,3失败
	public $cdate;
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId, startDate, startTime, endTime',
					'required',
					'message'=>'不能为空',
					'on' => 'add',	
					),
		);
	}
}