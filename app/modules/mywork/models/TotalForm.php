<?php 
/**
 * 任务表 * @author bao
 * 
 */;

class TotalForm extends CFormModel
{
	public $startDate;	//自增ID	
	public $endDate;	//任务内容	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('startDate,endDate',
					'safe',
					),
		);
	}
	

}