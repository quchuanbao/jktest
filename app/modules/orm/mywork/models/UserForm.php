<?php 
/**
 * 会员表 * @author bao
 * 
 */;

class UserForm extends CFormModel
{
	public $id;	//ID	
	public $realName;	//真实姓名	
	public $tel;	//手机号	
	public $pwd;	//密码	
	public $img;	//头像	
	public $sex;	//没有选择性别：0，男士:1,女士2，默认是字符串0	
	public $email;	//邮件	
	public $born;	//出身日期	
	public $cdate;	//注册时间	
	public $lasttime;	//最后一次登录时间	
	public $address;	//地址	
	public $ismarry;	//0默认，1已婚，2未婚	
	public $ischild;	//0默认，1有小孩，2无小孩	
	public $isvip;	//0默认，1是会员，2准会员，3过期会员	
	public $coachId;	//教练ID	
	public $memberShipId;	//会籍ID	
	public $sourceId;	//会员来源	
	public $visitDate;	//回访日期	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('realName,tel,pwd,img,sex,email,born,cdate,lasttime,address,ismarry,ischild,isvip,coachId,memberShipId,sourceId,visitDate',
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
		$data['formName'] = "会员表管理";
		$data['id'] = 'ID'; 
		$data['realName'] = '真实姓名'; 
		$data['tel'] = '手机号'; 
		$data['pwd'] = '密码'; 
		$data['img'] = '头像'; 
		$data['sex'] = '没有选择性别：0，男士:1,女士2，默认是字符串0'; 
		$data['email'] = '邮件'; 
		$data['born'] = '出身日期'; 
		$data['cdate'] = '注册时间'; 
		$data['lasttime'] = '最后一次登录时间'; 
		$data['address'] = '地址'; 
		$data['ismarry'] = '0默认，1已婚，2未婚'; 
		$data['ischild'] = '0默认，1有小孩，2无小孩'; 
		$data['isvip'] = '0默认，1是会员，2准会员，3过期会员'; 
		$data['coachId'] = '教练ID'; 
		$data['memberShipId'] = '会籍ID'; 
		$data['sourceId'] = '会员来源'; 
		$data['visitDate'] = '回访日期'; 
		return $data;
	}
}