<?php 
/**
 * 意见表 * @author bao
 * 
 */


class OpinionController extends UController 
{
	/**
	 * 提交意见
	 */
	public function actionApply()
	{
		$content = $_REQUEST['opinion'];
		if (empty($content)) {
			$this->showJson(2, '' ,"参数不能为空！");
		}
		$type = $_REQUEST['submit_type'];
		$opinionModel = new linkOpinion();
		$opinionModel->initVar($opinionModel);
		$opinionModel->employeeId = $this->uid;
		$opinionModel->cdate = date("Y-m-d H:i:s");
		$opinionModel->content = $content;
		$opinionModel->type = $type;
		$opinionModel->save();
		$res = array();
		$this->showJson(0, $res);
	}
}