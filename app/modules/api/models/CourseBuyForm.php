<?php 
/**
 * 课程购买表 * @author bao
 * 
 */;

class CourseBuyForm extends CFormModel
{
    public $id;	//自增ID
    public $userId;	//用户ID
    public $employeeId;	//教练ID
    public $num;	 //次数
    public $price;	//单价
    public $total;	//支付总金额
    public $paytype;	//1现金2信用卡3支票
    public $remark;	//备注
    public $cdate;	//创建日期
    public $status;	//1成功
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('userId, num, price, total, paytype',
					'required',
					'message'=>'不能为空',
					'on' => 'add',	
					),
		        array('remark','safe'),
		);
	}
}