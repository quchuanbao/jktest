<?php
class Controller extends CController
{
	
	/**
	 * 打印返回信息
	 * @param unknown_type $code
	 * @param unknown_type $needArray
	 */
	public  function showJson($code, $needArray='', $errorMsg='', $error_code = '1001')
	{
		//var_dump($needArray);
		if (!$code) {
			echo json_encode(array('status'=>'success','data'=>$needArray));
			exit;
		}
		
		//需要登录
		if ($code == 1) {
			echo json_encode(array('status'=>'failure','error_code'=>'100', 'error_message' => $errorMsg));
			exit;
		}
		//错误提示
		if ($code == 2) {
			echo json_encode(array('status'=>'failure', 'error_code'=>$error_code, 'error_message' => $errorMsg));
			exit;
		}
	}
	
	/**
	 * 打印form验证错误信息
	 * @param unknown_type $needArray
	 */
	public function showFormError($needArray='')
	{
		foreach ($needArray as $n => $v) {
			$errorMsg = $v[0];
			break;
		}
		echo json_encode(array('status'=>'failure', 'error_code'=>'1001', 'error_message' => $errorMsg));
		exit;
	}
	
	/**
	 * 获取部门
	 * @param unknown $id
	 */
	public function getDepartment($id)
	{
		$deparmentModel = new linkDepartment();
		$deparmentModel->initVar($deparmentModel);
		$deparmentModel->id = $id;
		$deparment = $deparmentModel->search();
		if ($deparment[0]['parentId']) {
			$deparmentModel->initVar($deparmentModel);
			$deparmentModel->id = $id;
			$deparment = $deparmentModel->search();
		}
		if ($deparment) {
			return $deparment[0]['name'];
		} else {
			return "未知部门";
		}
	}
	
	/**
	 * 获取职位
	 * @param unknown $id
	 * @return string
	 */
	public function getPostion($id)
	{
		$postionModel = new linkPosition();
		$postionModel->initVar($postionModel);
		$postionModel->id = $id;
		$postion = $postionModel->search();
		if ($postion) {
			return $postion[0]['name'];
		} else {
			return "未知职位";
		}
	}
	
	
}