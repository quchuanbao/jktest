<?php
class UController extends Controller
{

	public $uid;
	public function init()
	{

 		$uid = Yii::app ()->session['uid'];
 		
		if(!$uid){
			//未登录
			$this->showJson(1,'','未登陆！');
		}
 		$this->uid = $uid;
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