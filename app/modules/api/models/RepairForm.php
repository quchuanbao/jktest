<?php 
/**
 * 器械报修表 * @author bao
 * 
 */;

class RepairForm extends CFormModel
{
	public $id;	//自增ID	
	public $num;	//器械编号	
	public $content;	//故障描述	
	public $employeeId;	//员工ID	
	public $status;	//0维修中，1已修完	
	public $cdate;	//创建日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('num,content,employeeId,status,cdate',
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
		$data['formName'] = "器械报修表管理";
		$data['id'] = '自增ID'; 
		$data['num'] = '器械编号'; 
		$data['content'] = '故障描述'; 
		$data['employeeId'] = '员工ID'; 
		$data['status'] = '0维修中，1已修完'; 
		$data['cdate'] = '创建日期'; 
		return $data;
	}
}