<?php 
/**
 * 会员扩展表 * @author bao
 * 
 */;

class UserextendedForm extends CFormModel
{
	public $id;	//自增Id	
	public $userId;	//会员ID	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId',
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
		$data['formName'] = "会员扩展表管理";
		$data['id'] = '自增Id'; 
		$data['userId'] = '会员ID'; 
		return $data;
	}
}