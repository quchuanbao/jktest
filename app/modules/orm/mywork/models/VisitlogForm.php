<?php 
/**
 * 回访表 * @author bao
 * 
 */;

class VisitlogForm extends CFormModel
{
	public $id;	//自增ID	
	public $employeeId;	//员工Id	
	public $content;	//回访内容	
	public $telTime;	//通话时长	
	public $telNum;	//呼叫次数	
	public $cdate;	//呼叫日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('employeeId,content,telTime,telNum,cdate',
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
		$data['formName'] = "回访表管理";
		$data['id'] = '自增ID'; 
		$data['employeeId'] = '员工Id'; 
		$data['content'] = '回访内容'; 
		$data['telTime'] = '通话时长'; 
		$data['telNum'] = '呼叫次数'; 
		$data['cdate'] = '呼叫日期'; 
		return $data;
	}
}