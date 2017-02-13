<?php 
/**
 * 管理员 * @author bao
 * 
 */


class AdminController extends Controller 
{
	public $layout='main';
	/**
	 * 显示管理员 
	 */
	public function actionIndex() 
	{
		$data['name'] = "管理员";
		$model = new AdminForm('add');
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['AdminForm'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v;
			}
		}
		if (!empty($pageInfo)) {
			$pageInfo.='/';
		}
		$whereInfo = $this->getSearchInfo($model->attributes);
		$dataModel = new linkAdmin();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/admin/index/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id desc limit $from,$limit";
		$data['info'] = $dataModel->search($whereInfo);
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('list',$data);
	}
	
	/**
	 * 添加管理员 
	 */
	public function actionAdd()
	{
		$model = new AdminForm('add');
		if (isset($_POST['AdminForm'])) {
			$model->attributes = $_POST['AdminForm'];
			if($model->validate()){
				$dataModel = new linkAdmin();
				$dataModel->initVar($dataModel);
				$model->password = md5('123456');
				$model->loginDate = date("Y-m-d H:i:s");
				$model->loginIp = $this->getip();
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/admin');
			}
		}
		$model->status = 1;
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	/**
	 *  编辑管理员	 */
	public function actionModify()
	{
		$dataModel = new linkAdmin();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("管理员不存在！");
		}
		$model = new AdminForm('add');
		if (isset($_POST['AdminForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['AdminForm'];
			if($model->validate()){
				$dataModel = new linkAdmin();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				$this->showmsg("操作成功",'/mywork/admin');
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		$data['flag'] = 1;
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	
	/**
	 *  删除管理员	 */
	public function actionDel()
	{
		$dataModel = new linkAdmin();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("管理员不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/admin');
	}
	
	/**
	 *  重置密码	 */
	public function actionModifyPwd()
	{
		$dataModel = new linkAdmin();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("管理员不存在！");
		}
	
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->password = md5('123456');
		$dataModel->modify();
		$this->showmsg("操作成功",'/mywork/admin');
	}
	
	/**
	 *  修改密码	 */
	public function actionModifyPwdView()
	{
		$model = new AdminForm('modify');
		
		if (isset($_POST['AdminForm'])) {
			$model->attributes = $_POST['AdminForm'];
			if($model->validate()){
				$dataModel = new linkAdmin();
				$dataModel->initVar($dataModel);
				$dataModel->id = Yii::app()->session['admin_login']['id'];
				$dataModel->password = md5($model->newPassword2);
				$dataModel->modify();
				Yii::app()->session['admin_login']['password'] = md5($model->newPassword2);
				$this->showmsg("操作成功",'/mywork');
			}
		}
		
		$data['model'] = $model;
		$this->render('modifyPwd',$data);
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