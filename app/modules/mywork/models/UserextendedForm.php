<?php 
/**
 * 会员扩展表 * @author bao
 * 
 */;

class UserextendedForm extends CFormModel
{
	public $id;	//自增Id	
	public $userId;	//会员ID	
	public $interestId; //兴趣爱好
	public $interest; //兴趣爱好手填
	public $source; //其他来源
	public $reasonId; //参加俱乐部原因
	public $reason; //其他原因
	public $isadd; //是否加入过俱乐部
	public $iscoach; //是否请过教练
	public $remark; //备注
	public $cpname; //公司名称
	public $cpaddress; //公司地址
	public $cptel; //公司电话
	public $cppost; //公司邮编

	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId',
					'required',
					'message'=>'不能为空',
					),
				array('interestId,interest,reasonId,reason,isadd,iscoach,remark,cpname,cpaddress,cptel,cppost',
					'safe',	
				),
				
		);
	}
	
	/**
	 * 获取属性名称
	 */
	function getOptionName()
	{
		$data['formName'] = "会员扩展表管理";
		$data['id'] = '自增Id'; 
		$data['userId'] = '会员ID'; 
		return $data;
	}
}