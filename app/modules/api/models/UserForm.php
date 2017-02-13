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
	public $wxnum;	//微信号
	public $cardNum; //身份证号
	public $startDate;//会员卡开始日期
	public $endDate;//会员卡结束日期
	public $cardType;//会员卡类型
	public $totalNum;//会员卡次数
	public $useNum;//会员卡已使用次数
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('realName,tel',
					'required',
					'message' => '不能为空',
				    'on' => 'add'
					),
		        array('pwd,img,sex,email,born,cdate,lasttime,address,ismarry,ischild,isvip,coachId,memberShipId,sourceId,visitDate',
		                'safe',
		        ),
		        array(
		                'img',
		                'file',    //定义为file类型
		                'allowEmpty'=>true,
		                'types'=>'jpg,png,gif',   //上传文件的类型
		                'maxSize'=>1024*1024*10,    //上传大小限制，注意不是php.ini中的上传文件大小
		                'tooLarge'=>'文件大于10M，上传失败！请上传小于10M的文件！',
		                'message'=>'图片不能为空',
		                'on' => 'add',
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