<?php
/**
 * 后台登陆程序
 */
class SearchForm extends CFormModel
{
	
	public $keyword;
	/**
	 * 声明验证规则
	 */
	public function rules()
	{
		return array(
				array('keyword',
					'required',
					'message' => '不能为空',	
					),
		);
	}
}