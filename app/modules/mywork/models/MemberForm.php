<?php 
/**
 * 用户 * @author bao
 * 
 */;

class MemberForm extends CFormModel
{
	public $id;	//ID	
	public $userName;	//登录名	
	public $password;	//密码	
	public $realName;	//真实姓名	
	public $telephone;	//手机号	
	public $qq;	//QQ号	
	public $cdate;	//注册时间	
	public $loginDate;	//登陆时间	
	public $loginIp;	//登陆IP	
	public $status;	//1有效，2冻结	
	public $nickName;	//昵称	
	public $headPic;	//头像	
	public $isAuthor;	//1不是，2是	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userName,password,realName,telephone,qq,cdate,loginDate,loginIp,status,nickName,headPic,isAuthor',
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
		$data['formName'] = "用户管理";
		$data['id'] = 'ID'; 
		$data['userName'] = '登录名'; 
		$data['password'] = '密码'; 
		$data['realName'] = '真实姓名'; 
		$data['telephone'] = '手机号'; 
		$data['qq'] = 'QQ号'; 
		$data['cdate'] = '注册时间'; 
		$data['loginDate'] = '登陆时间'; 
		$data['loginIp'] = '登陆IP'; 
		$data['status'] = '1有效，2冻结'; 
		$data['nickName'] = '昵称'; 
		$data['headPic'] = '头像'; 
		$data['isAuthor'] = '1不是，2是'; 
		return $data;
	}
}