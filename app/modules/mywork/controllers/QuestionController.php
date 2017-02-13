<?php 
/**
 * 问题表 * @author bao
 * 
 */


class QuestionController extends Controller 
{
	public $layout='main';
	/**
	 * 显示问题
	 */
	public function actionIndex() 
	{
		$data['name'] = "问题表";
		$model = new QuestionForm();
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['QuestionForm'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v;
			}
		}
		if (!empty($pageInfo)) {
			$pageInfo.='/';
		}
		$type = $_REQUEST['type'];
		if (empty($type)) {
		    $type = 1;
		}
		
		$whereInfo = $this->getSearchInfo($model->attributes);
		$whereInfo.= " and type = $type ";
		$dataModel = new linkQuestion();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/question/index/type/".$type."/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id asc limit $from,$limit";

		$info = $dataModel->search($whereInfo);
		foreach ($info as $n => $v) {
		    $opModel = new linkQuestionoption();
		    $opModel->initVar($opModel);
		    $opModel->qid = $v['id'];
		    $info[$n]['option'] = $opModel->search();
		}
		
		$data['type'] = $type;
		$data['info'] = $info;
		$data['model'] = $model;
		$this->render('list',$data);
	}
	
	/**
	 * 添加职位表 
	 */
	public function actionAdd()
	{
	    $type = $_REQUEST['type'];
	    $model = new QuestionForm();
		if (isset($_POST['QuestionForm'])) {
			$model->attributes = $_POST['QuestionForm'];
			$model->type = $type;
			if($model->validate()){
				$dataModel = new linkQuestion();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/question/index/type/'.$type);
			}
		}
		$data['model'] = $model;
		$this->render('add',$data);
	}
	
	/**
	 *  编辑职位表	 */
	public function actionModify()
	{
	    $type = $_REQUEST['type'];
	    $dataModel = new linkQuestion();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("职位表不存在！");
		}
		$model = new QuestionForm();
		if (isset($_POST['QuestionForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['QuestionForm'];
			$model->type = $type;
			if($model->validate()){
				$dataModel = new linkQuestion();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				$this->showmsg("操作成功",'/mywork/question/index/type/'.$type);
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		$data['model'] = $model;
		$this->render('add',$data);
	}
	
	
	/**
	 *  删除职位表	 */
	public function actionDel()
	{
	    $type = $_REQUEST['type'];
	    $dataModel = new linkQuestion();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("职位表不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/question/index/type/'.$type);
	}
	
	/**
	 * 组织查询条件
	 * @param array $needArray
	 */
	function getSearchInfo($needArray,$fix=''){
		$where = " 1=1 ";
		if(!empty($needArray)){
			
			foreach ($needArray as $n => $v){
				if(!empty($v)){
					if (empty($fix)){
						$where.=" and ".$n."='".$v."' ";
					} else {
						$where.=" and ".$fix.".".$n."='".$v."' ";
					}
				}
			}
		}
		return $where;
	}
}