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
		if (empty(Yii::app()->session['employee'])){
			$this->redirect('/site');
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
}