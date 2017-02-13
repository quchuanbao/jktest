<?php
/**
 * 后台登陆程序
 */
class LoginForm extends CFormModel
{
	
	public $tel;
	public $pwd;
	/**
	 * 声明验证规则
	 */
	public function rules()
	{
		return array(
				array('tel',
					'required',
					'message' => '手机号不能为空',	
					),
				array('pwd',
						'required',
						'message' => '密码不能为空',
				),
				array('tel', 'checkTel'),
		);
	}
	
	/**
	 * 检查用户名和密码是否正确
	 */
	function checkTel()
	{
		$dataModel = new linkEmployee();
		$dataModel->initVar($dataModel);
		$dataModel->tel = $this->tel;
		$dataModel->pwd = md5($this->pwd);
		$userInfo = $dataModel->search();
		
		if (empty($userInfo)) {
			$this->addError('tel','用户名或密码错误！');
		} else {
			Yii::app()->session['uid'] = $userInfo[0]['id'];
		}
	}
	
	
	/**
	 * 检查验证码是否正确
	 */
	function checkValidate()
	{
		$showValidate = new sdkValidate();
		if (!$showValidate->checkvalidate($this->validate)) {
			$this->addError('validate','验证码错误！');
		} 
	}
	
	
}