<?php 
/**
 *  投诉表 * @author bao
 * 
 */;

class ComplaintForm extends CFormModel
{
	public $id;	//自增ID	
	public $userId;	//会员ID	
	public $content;	//投诉内容	
	public $cdate;	//创建日期	
	public $deparentId;	//所属部门ID	
	public $status;	//0未分配，1处理中，2处理完成，3无效投诉	
	public $employeeId;	//创建员工ID	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId,content,cdate,deparentId,status,employeeId',
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
		$data['formName'] = " 投诉表管理";
		$data['id'] = '自增ID'; 
		$data['userId'] = '会员ID'; 
		$data['content'] = '投诉内容'; 
		$data['cdate'] = '创建日期'; 
		$data['deparentId'] = '所属部门ID'; 
		$data['status'] = '0未分配，1处理中，2处理完成，3无效投诉'; 
		$data['employeeId'] = '创建员工ID'; 
		return $data;
	}
}