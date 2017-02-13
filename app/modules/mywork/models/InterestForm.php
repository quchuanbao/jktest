<?php 
/**
 * 来源表 * @author bao
 * 
 */;

class InterestForm extends CFormModel
{
	public $id;	//自增ID	
	public $name;	//员工ID	
	
	
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
	
	/**
	 * 获取属性名称
	 */
	function getOptionName()
	{
		$data['formName'] = "意见表管理";
		$data['id'] = '自增ID'; 
		$data['name'] = 'name'; 
		return $data;
	}
}