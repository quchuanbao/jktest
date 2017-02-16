<?php
/**
 * 后台登陆程序
 */
class TelForm extends CFormModel
{
	
	public $userName;
	public $password;
	public $validate;
	/**
	 * 声明验证规则
	 */
	public function rules()
	{
		return array(
				array('userName,password,validate',
					'required',
					'message' => '不能为空',	
					),
				array('userName', 'checkUserName'),
				array('validate', 'checkValidate'),
		);
	}
	
	/**
	 * 检查用户名和密码是否正确
	 */
	function checkUserName()
	{
		$adminModel = new linkEmployee();
		$adminModel->initVar($adminModel);
		$adminModel->tel = $this->userName;
		$adminModel->pwd = md5($this->password);
		$adminModel->departmentId = 4;//
		$userInfo = $adminModel->search();
		if (empty($userInfo)) {
			$this->addError('password','用户名或密码错误！');
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