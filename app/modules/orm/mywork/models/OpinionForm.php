<?php 
/**
 * 意见表 * @author bao
 * 
 */;

class OpinionForm extends CFormModel
{
	public $id;	//自增ID	
	public $employeeId;	//员工ID	
	public $content;	//意见内容	
	public $cdate;	//创建日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('employeeId,content,cdate',
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
		$data['employeeId'] = '员工ID'; 
		$data['content'] = '意见内容'; 
		$data['cdate'] = '创建日期'; 
		return $data;
	}
}