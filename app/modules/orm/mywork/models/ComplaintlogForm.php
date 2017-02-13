<?php 
/**
 * 投诉处理表 * @author bao
 * 
 */;

class ComplaintlogForm extends CFormModel
{
	public $id;	//自增ID	
	public $complaintId;	//投诉ID	
	public $employeeId;	//员工ID	
	public $content;	//处理意见	
	public $cdate;	//创建日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('complaintId,employeeId,content,cdate',
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
		$data['formName'] = "投诉处理表管理";
		$data['id'] = '自增ID'; 
		$data['complaintId'] = '投诉ID'; 
		$data['employeeId'] = '员工ID'; 
		$data['content'] = '处理意见'; 
		$data['cdate'] = '创建日期'; 
		return $data;
	}
}