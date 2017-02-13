<?php 
/**
 * 内容 * @author bao
 * 
 */;

class ContentForm extends CFormModel
{
	public $id;	//ID	
	public $mid;	//用户ID	
	public $pic;	//图片	
	public $content;	//内容	
	public $cdate;	//创建日期	
	public $pv;	//浏览数量	
	public $status;	//1正常，2删除	
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('mid,pic,content,cdate,pv,status',
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
		$data['formName'] = "内容管理";
		$data['id'] = 'ID'; 
		$data['mid'] = '用户ID'; 
		$data['pic'] = '图片'; 
		$data['content'] = '内容'; 
		$data['cdate'] = '创建日期'; 
		$data['pv'] = '浏览数量'; 
		$data['status'] = '1正常，2删除'; 
		return $data;
	}
}