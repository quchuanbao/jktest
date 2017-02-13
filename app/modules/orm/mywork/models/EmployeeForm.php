<?php 
/**
 * 员工表 * @author bao
 * 
 */;

class EmployeeForm extends CFormModel
{
	public $id;	//ID	
	public $realName;	//真实姓名	
	public $tel;	//手机号	
	public $pwd;	//密码	
	public $img;	//头像	
	public $sex;	//没有选择性别：0，男士:1,女士2，默认是字符串0	
	public $born;	//出身日期	
	public $cdate;	//注册时间	
	public $lasttime;	//最后一次登录时间	
	public $departmentId;	//部门ID	
	public $status;	//1有效，2无效，3删除	
	public $positionId;	//职位ID	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('realName,tel,pwd,img,sex,born,cdate,lasttime,departmentId,status,positionId',
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
		$data['formName'] = "员工表管理";
		$data['id'] = 'ID'; 
		$data['realName'] = '真实姓名'; 
		$data['tel'] = '手机号'; 
		$data['pwd'] = '密码'; 
		$data['img'] = '头像'; 
		$data['sex'] = '没有选择性别：0，男士:1,女士2，默认是字符串0'; 
		$data['born'] = '出身日期'; 
		$data['cdate'] = '注册时间'; 
		$data['lasttime'] = '最后一次登录时间'; 
		$data['departmentId'] = '部门ID'; 
		$data['status'] = '1有效，2无效，3删除'; 
		$data['positionId'] = '职位ID'; 
		return $data;
	}
}