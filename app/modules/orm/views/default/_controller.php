<?php echo '<?php'?>
 
/**
 * <?php echo $tableName;
 
 ?>
 * @author bao
 * 
 */


class <?php echo ucfirst($table);?>Controller extends Controller 
{
	public $layout='main';
	/**
	 * 显示<?php echo $tableName;?> 
	 */
	public function actionIndex() 
	{
		$data['name'] = "<?php echo $tableName;?>";
		$model = new <?php echo ucfirst($table);?>Form();
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['<?php echo ucfirst($table);?>Form'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v;
			}
		}
		if (!empty($pageInfo)) {
			$pageInfo.='/';
		}
		$whereInfo = $this->getSearchInfo($model->attributes);
		$dataModel = new link<?php echo ucfirst($table);?>();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/<?php echo $table;?>/index/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by id desc limit $from,$limit";
		$data['info'] = $dataModel->search($whereInfo);
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('list',$data);
	}
	
	/**
	 * 添加<?php echo $tableName;?> 
	 */
	public function actionAdd()
	{
		$model = new <?php echo ucfirst($table);?>Form();
		if (isset($_POST['<?php echo ucfirst($table);?>Form'])) {
			$model->attributes = $_POST['<?php echo ucfirst($table);?>Form'];
			if($model->validate()){
				$dataModel = new link<?php echo ucfirst($table);?>();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->save($saveArray);
				$this->showmsg("操作成功",'/mywork/<?php echo $table;?>');
			}
		}
		$data['model'] = $model;
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	/**
	 *  编辑<?php echo $tableName;?>
	 */
	public function actionModify()
	{
		$dataModel = new link<?php echo ucfirst($table);?>();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("<?php echo $tableName;?>不存在！");
		}
		$model = new <?php echo ucfirst($table);?>Form();
		if (isset($_POST['<?php echo ucfirst($table);?>Form'])) {
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['<?php echo ucfirst($table);?>Form'];
			if($model->validate()){
				$dataModel = new link<?php echo ucfirst($table);?>();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				$this->showmsg("操作成功",'/mywork/<?php echo $table;?>');
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
	 *  删除<?php echo $tableName;?>
	 */
	public function actionDel()
	{
		$dataModel = new link<?php echo ucfirst($table);?>();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("<?php echo $tableName;?>不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/<?php echo $table;?>');
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