<?php 
/**
 * 会员扩展表 * @author bao
 * 
 */


class UserextendedController extends Controller 
{
	public $layout='main';
	/**
	 * 显示会员扩展表 
	 */
	public function actionIndex() 
	{
		$data['name'] = "会员扩展表";
		$model = new UserextendedForm();
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['UserextendedForm'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v;
			}
		}
		if (!empty($pageInfo)) {
			$pageInfo.='/';
		}
		$whereInfo = $this->getSearchInfo($model->attributes);
		$dataModel = new linkUserextended();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/userextended/index/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id desc limit $from,$limit";
		$data['info'] = $dataModel->search($whereInfo);
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('list',$data);
	}
	
	/**
	 * 添加会员扩展表 
	 */
	public function actionAdd()
	{
		$model = new UserextendedForm();
		if (isset($_POST['UserextendedForm'])) {
			$model->attributes = $_POST['UserextendedForm'];
			if($model->validate()){
				$dataModel = new linkUserextended();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/userextended');
			}
		}
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	/**
	 *  编辑会员扩展表	 */
	public function actionModify()
	{
		$dataModel = new linkUserextended();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员扩展表不存在！");
		}
		$model = new UserextendedForm();
		if (isset($_POST['UserextendedForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['UserextendedForm'];
			if($model->validate()){
				$dataModel = new linkUserextended();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				$this->showmsg("操作成功",'/mywork/userextended');
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	
	/**
	 *  删除会员扩展表	 */
	public function actionDel()
	{
		$dataModel = new linkUserextended();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员扩展表不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/userextended');
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