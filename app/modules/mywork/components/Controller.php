<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
	
	public function __construct($id,$module=null)
	{
		parent::__construct($id,$module);
		if (empty(Yii::app()->session['admin_login'])){
			$this->redirect('/mywork');
		}
	}
	
	
	/**
	 * 检测是否登陆,并跳转
	 */
	function checkIsLogin()
	{
		//判断是否登陆
		if (empty(Yii::app()->session['admin_login'])){
			$this->redirect('/mywork');
		}
		return Yii::app()->session['admin_login'];
	}
	
	
	/**
	 * 检测登陆状态
	 */
	function checkLoginStatus()
	{
		if (Yii::app()->session['admin_login']){
			return true;
		} else {
			return false;
		}
	}
	

	function showmsg($msg='',$url=-1){
		Yii::app()->session['notice'] = $msg;
		header("Content-type: text/html;charset=utf-8");
		if($url==-1){
			echo "<script>
				location.href='javascript:history.go(".$url.")';
				</script>";
			exit;
		}
		echo "<script>
				location.href='".$url."';
				</script>";
		exit;
	}
	
	/**
	 * 获取IP地址
	 */
	function getip(){
		$onlineip='';
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$onlineip = getenv('HTTP_CLIENT_IP');
		} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$onlineip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$onlineip = getenv('REMOTE_ADDR');
		} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')){
			$onlineip = $_SERVER['REMOTE_ADDR'];
		}
		return $onlineip;
	}
	
	
	function getCity()
	{
		$url='http://api.map.baidu.com/location/ip?ak=BFnX28I7TkpiA8OimWrlV7YU&ip='.$this->getip();
		return json_decode(file_get_contents($url));
	}
	
	/**
	 * 获取会员来源
	 */
	function getSource()
	{
		$sourceModel = new linkSource();
		$sourceModel->initVar($sourceModel);
		$info = $sourceModel->search();
		foreach ($info as $n => $v) {
			$res[$v['id']] = $v['name'];
		}
		return $res;
	}
	
	/**
	 * 获取兴趣爱好
	 */
	function getInterest()
	{
		$interestModel = new linkInterest();
		$interestModel->initVar($interestModel);
		$info = $interestModel->search(" 1=1 order by id desc ");
		foreach ($info as $n => $v) {
			$res[$v['id']] = $v['name'];
		}
		return $res;
	}
	
	/**
	 * 获取加入俱乐部原因
	 */
	function getReason()
	{
		$reasonModel = new linkReason();
		$reasonModel->initVar($reasonModel);
		$info = $reasonModel->search(" 1=1 order by id desc ");
		foreach ($info as $n => $v) {
			$res[$v['id']] = $v['name'];
		}
		return $res;
	}
	
	function getDepartment()
	{
	    $departmentModel = new linkDepartment();
	    $departmentModel->initVar($departmentModel);
	    $departmentInfo = $departmentModel->search();
	    foreach ($departmentInfo as $n => $v) {
	        $department[$v['id']] = $v['name'];
	    }
	    return $department;
	}
	
	function getPosition()
	{
	    $model = new linkPosition();
	    $model->initVar($model);
	    $info = $model->search();
	    foreach ($info as $n => $v) {
	        $res[$v['id']] = $v['name'];
	    }
	    return $res;
	}
	
	function getMemberShip($departmentId)
	{
	    $model = new linkEmployee();
	    $model->initVar($model);
	    $model->departmentId = $departmentId;
	    $info = $model->search();
	    foreach ($info as $n => $v) {
	        $res[$v['id']] = $v['realName'];
	    }
	    return $res;
	}
	
	
}