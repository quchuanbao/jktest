<?php 
/**
 * 业绩表 * @author bao
 * 
 */;

class ResultslogForm extends CFormModel
{
	public $id;	//自增Id	
	public $employeeId;	//用户ID	
	public $year;	//年	
	public $month;	//月份	
	public $num;	//业绩	
	public $completeNum;	//完成业绩	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('employeeId,year,month,num,completeNum',
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
		$data['formName'] = "业绩表管理";
		$data['id'] = '自增Id'; 
		$data['employeeId'] = '用户ID'; 
		$data['year'] = '年'; 
		$data['month'] = '月份'; 
		$data['num'] = '业绩'; 
		$data['completeNum'] = '完成业绩'; 
		return $data;
	}
}