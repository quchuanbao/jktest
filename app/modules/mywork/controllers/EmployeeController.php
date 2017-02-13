<?php 
/**
 * 员工表 * @author bao
 * 
 */


class EmployeeController extends Controller 
{
	public $layout='main';
	/**
	 * 显示员工表 
	 */
	public function actionIndex() 
	{
		$data['name'] = "员工表";
		$model = new EmployeeForm('search');
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['EmployeeForm'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v;
			}
		}
		if (!empty($pageInfo)) {
			$pageInfo.='/';
		}

		
		$whereInfo = $this->getSearchInfo($model->attributes);
		$dataModel = new linkEmployee();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/employee/index/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id desc limit $from,$limit";
		$data['info'] = $dataModel->search($whereInfo);
		$data['model'] = $model;
		
		
		$data['sex'] = Yii::app()->params['sex'];
		$data['position'] = $this->getPosition();
		$data['department'] = $this->getDepartment();
		$data['employeeStatus'] = Yii::app()->params['employeeStatus'];
		
		
		$data['options'] = $model->getOptionName();
		$this->render('list',$data);
	}
	
	/**
	 * 添加员工表 
	 */
	public function actionAdd()
	{
		$model = new EmployeeForm('add');
		
		if (isset($_POST['EmployeeForm'])) {
			
		    $model->attributes = $_POST['EmployeeForm'];
			$model->pwd = '123456';
			$model->status = 1;
			$model->cdate = date("Y-m-d H:i:s");
			
			if($model->validate()){
				$dataModel = new linkEmployee();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/employee');
			}
		}
		$model->pwd = '123456';
		$data['position'] = $this->getPosition();
		$data['department'] = $this->getDepartment();
		$data['sex'] = Yii::app()->params['sex'];
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	/**
	 *  编辑员工表	 */
	public function actionModify()
	{
		$dataModel = new linkEmployee();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("员工不存在！");
		}
		$model = new EmployeeForm('add');
		if (isset($_POST['EmployeeForm'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['EmployeeForm'];
			if($model->validate()){
				$dataModel = new linkEmployee();
				$dataModel->initVar($dataModel);
				$dataModel->id = $_REQUEST['id'];
				$dataModel->realName = $model->realName;
				$dataModel->sex = $model->sex;
				$dataModel->tel = $model->tel;
				$dataModel->positionId = $model->positionId;
				$dataModel->departmentId = $model->departmentId;
				$dataModel->born = $model->born;
				$dataModel->modify();
				$this->showmsg("操作成功",'/mywork/employee');
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		$data['position'] = $this->getPosition();
		$data['department'] = $this->getDepartment();
		$data['sex'] = Yii::app()->params['sex'];
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	
	/**
	 *  删除员工表	 */
	public function actionDel()
	{
		$dataModel = new linkEmployee();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("员工不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->status = 3;
		$dataModel->modify();
		$this->showmsg("操作成功",'/mywork/employee');
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