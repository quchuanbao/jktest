<?php 
/**
 * 管理员 * @author bao
 * 
 */;

class AdminForm extends CFormModel
{
	public $id;	//ID	
	public $userName;	//登录名	
	public $password;	//密码	
	public $realName;	//真实姓名	
	public $loginDate;	//登陆时间	
	public $loginIp;	//登陆IP	
	public $status;	//1有效，2冻结	
	public $newPassword1; //新密码
	public $newPassword2; //新密码
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userName,realName,status',
					'required',
					'message'=>'不能为空',
					'on' => 'add',
					),
				array('userName', 'match', 'pattern'=>'/^[A-Za-z0-9]+$/u','message'=>'用户名不合法，必须为字母或者数字！','on' => 'add'),
				array('userName', 'checkUserName','on' => 'add'),
				array('password,newPassword1,newPassword2',
						'required',
						'message'=>'不能为空',
						'on' => 'modify'),
				array('password,',
						'checkPwd',
						'on' => 'modify'),
				array('newPassword1,newPassword2',
						'checkPwdDiff',
						'on' => 'modify'),
		);
	}
	
	/**
	 * 检查用户名和密码是否正确
	 */
	function checkUserName()
	{
		if (!empty($this->id)) {
			$dataModel = new linkAdmin();
			$dataModel->initVar($dataModel);
			$dataModel->id = $this->id;
			$dataInfo = $dataModel->search();
		}
		if ($dataInfo[0]['userName'] != $this->userName) {
			$adminModel = new linkAdmin();
			$adminModel->initVar($adminModel);
			$adminModel->userName = $this->userName;
			$userInfo = $adminModel->search();
			if (!empty($userInfo)) {
				$this->addError('userName','用户名已存在！');
			}
		}
	}
	
	/**
	 * 检查密码是否正确
	 */
	function checkPwd()
	{
		if (md5($this->password) != Yii::app()->session['admin_login']['password']) {
			$this->addError('password','原始密码输入错误！');
		}
	}
	
	/**
	 * 检查密码是否正确
	 */
	function checkPwdDiff()
	{
		if ($this->newPassword1 != $this->newPassword2) {
			$this->addError('newPassword2','两次密码输入不一致！');
		}
	}
	
	/**
	 * 获取属性名称
	 */
	function getOptionName()
	{
		$data['formName'] = "管理员管理";
		$data['id'] = 'ID'; 
		$data['userName'] = '登录名'; 
		$data['password'] = '密码'; 
		$data['realName'] = '真实姓名'; 
		$data['loginDate'] = '登陆时间'; 
		$data['loginIp'] = '登陆IP'; 
		$data['status'] = '1有效，2冻结'; 
		return $data;
	}
}