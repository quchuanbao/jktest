<?php 
/**
 * 课程表 * @author bao
 * 
 */;

class AdviceForm extends CFormModel
{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $content;	//内容
    public $cdate;	//日期
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId, content',
					'required',
					'message'=>'不能为空',
					'on' => 'add',	
					),
		);
	}
}