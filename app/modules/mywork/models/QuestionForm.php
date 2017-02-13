<?php 
/**
 * 问题表 * @author bao
 * 
 */;

class QuestionForm extends CFormModel
{
	public $id;	//自增ID	
	public $type;	//1:运动背景，2回访问题
	public $class; //1单选，2多选
	public $name;
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('name',
					'required',
					'message'=>'不能为空',
					),
		);
	}
}