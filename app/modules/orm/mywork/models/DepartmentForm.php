<?php 
/**
 * 部门 * @author bao
 * 
 */;

class DepartmentForm extends CFormModel
{
	public $id;	//自增ID	
	public $name;	//部门名称	
	public $parentId;	//父部门ID	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('name,parentId',
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
		$data['formName'] = "部门管理";
		$data['id'] = '自增ID'; 
		$data['name'] = '部门名称'; 
		$data['parentId'] = '父部门ID'; 
		return $data;
	}
}