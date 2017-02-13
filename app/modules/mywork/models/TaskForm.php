<?php 
/**
 * 任务表 * @author bao
 * 
 */;

class TaskForm extends CFormModel
{
	public $id;	//自增ID	
	public $content;	//任务内容	
	public $employeeId;	//用户ID	
	public $noticeDate;	//提醒日期	
	public $complete;	//完成日期	
	public $remark;	//备注	
	public $parentId;	//父类ID	
	public $status;	//0默认，1未完成，2已完成	
	public $leaderId;	//分配人ID	
	public $cdate;	//创建日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('content,employeeId,noticeDate,complete,remark,parentId,status,leaderId,cdate',
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
		$data['formName'] = "任务表管理";
		$data['id'] = '自增ID'; 
		$data['content'] = '任务内容'; 
		$data['employeeId'] = '用户ID'; 
		$data['noticeDate'] = '提醒日期'; 
		$data['complete'] = '完成日期'; 
		$data['remark'] = '备注'; 
		$data['parentId'] = '父类ID'; 
		$data['status'] = '0默认，1未完成，2已完成'; 
		$data['leaderId'] = '分配人ID'; 
		$data['cdate'] = '创建日期'; 
		return $data;
	}
}