<?php 
/**
 * 课程表 * @author bao
 * 
 */;

class CourseClassForm extends CFormModel
{
    public $id;	//自增ID
    public $siteId;	//用户ID
    public $employeeId;	//教练ID
    public $startDate;	//开始日期
    public $startTime;	//开始时间
    public $endTime;	//结束时间
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('siteId, startDate, startTime, endTime',
					'required',
					'message'=>'不能为空',
					'on' => 'add',	
					),
		);
	}
}