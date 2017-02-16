<?php 
/**
 * 会员表 * @author bao
 * 
 */


class UserController extends Controller 
{
	public $layout='main';
	/**
	 * 显示会员表 
	 */
	public function actionIndex() 
	{
		$data['name'] = "会员表";
		$model = new UserForm();
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		$model->attributes = $_POST['UserForm'];
		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v."/";
			}
		}
		$whereInfo = $this->getSearchInfo($model->attributes);
		
		$dataModel = new linkUser();
		$dataModel->initVar($dataModel);
		$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);
		
		$whereInfo = $this->getSearchInfo($model->attributes,'a');
		if ($model->memberShipId) {
		    $ids = '';
		    $allInfo = $dataModel->getList($whereInfo);
		    foreach ($allInfo as $n => $v) {
		    	$ids.=$v['id'].",";
		    }
		    $data['ids'] = rtrim($ids,',');
		}
		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/user/index/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by a.id desc limit $from,$limit";
		$data['info'] = $dataModel->getList($whereInfo);
		
		
		
		$data['model'] = $model;
		
		$data['sex'] = Yii::app()->params['sex'];
		$data['sourceId'] = $this->getSource();
		$data['membership'] = $this->getMemberShip(1);
		$data['options'] = $model->getOptionName();
		$this->render('list',$data);
	}
	
	
	public function actionExpire()
	{
	    $data['name'] = "会员表";
	    $model = new UserForm();
	    foreach ($model->attributes as $n => $v) {
	        if (!empty($_REQUEST[$n])) {
	            if ($n == 'endDate' && !$_POST['UserForm']['endDate']) {
	                $num = $_REQUEST[$n];
	                $model->$n = date("Y-m-d",time()+$num*86400);;
	            } else {
	                $model->$n = $_REQUEST[$n];
	            }
	            
	        }
	    }
	    if (empty($num)) {
    	    $num = $_POST['UserForm']['endDate'];
    	    if(!$num){
    	    	$num = 30;
    	    }
    	    
    	    $_POST['UserForm']['endDate'] = date("Y-m-d",time()+$num*86400);
    	    
	    }
	    $model->attributes = $_POST['UserForm'];
	    
	    foreach ($model->attributes as $n => $v) {
	        if(!empty($v)){
	            if ($n=='endDate' && $num){
	            	$v=$num;
	            }
	            $pageInfo.=$n."/".$v."/";
	        }
	    }
	    $whereInfo = $this->getSearchInfoExpire($model->attributes);
	    
	    $dataModel = new linkUser();
	    $dataModel->initVar($dataModel);
	    $p = $_GET['page']?$_GET['page']:1;
	    $total = $dataModel->searchCountNum($whereInfo);
	
	    $whereInfo = $this->getSearchInfoExpire($model->attributes,'a');
	   
	    if ($model->memberShipId) {
	        $ids = '';
	        $allInfo = $dataModel->getList($whereInfo);
	        foreach ($allInfo as $n => $v) {
	            $ids.=$v['id'].",";
	        }
	        $data['ids'] = rtrim($ids,',');
	    }
	    $limit = 20;
	    $from = ($p-1)*$limit;
	    $page_nums = 10;
	    $page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/user/expire/".$pageInfo."page/");
	    $data['page'] = $page->adminShow();
	    $whereInfo.= " order by a.endDate asc limit $from,$limit";
	    
	    $data['info'] = $dataModel->getList($whereInfo);
	
	
	   
	    $model->endDate = $num;
	    
	    $data['model'] = $model;
	       
	    
	    $data['sex'] = Yii::app()->params['sex'];
	    $data['sourceId'] = $this->getSource();
	    $data['membership'] = $this->getMemberShip(1);
	    $data['options'] = $model->getOptionName();
	    $this->render('expirelist',$data);
	}
	
	/**
	 * 批量转移会籍操作
	 */
	public function actionChangeuser()
	{
	    $ids = $_POST['ids'];
	    if (empty($ids)) {
	        $this->showmsg("请先查询要转移的会籍",'/mywork/user/');
	    }
	    $model = new UserForm('moveuser');
	    if (isset($_POST['UserForm'])) {
	        $model->attributes = $_POST['UserForm'];
	        if($model->validate()){
	            $dataModel = new linkUser();
	            $dataModel->initVar($dataModel);
	            $dataModel->moveuser($ids,$model->memberShipId);
	            $this->showmsg("操作成功！",'/mywork/user/');
	        } else {
	            $this->showmsg("请选择会籍",'/mywork/user/');
	        }
	    } else {
	        $this->showmsg("请选择会籍",'/mywork/user/');
	    }
	}
	
	/**
	 * 添加会员表 
	 */
	public function actionAdd()
	{
		$model = new UserForm('add');
		if (isset($_POST['UserForm'])) {
			$model->attributes = $_POST['UserForm'];
			
			$model->img = $_REQUEST['picPath'];
			if($model->validate()){

				$uid = Yii::app()->session['admin_login']['id'];
				/**
				$fileNameInfo = explode(".",$model->img);
				$picPath = 'upload/userpic/'.date("Y")."/".date("m");
				is_dir($picPath)?null:@mkdir($picPath,0777,1);
				$fileName = '/'.$uid.'_'.time().'.'.$fileNameInfo[1];
				$picPath = $picPath.$fileName;
				rename($_REQUEST['picPath'],$picPath);
				$model->img = $picPath;
				**/
				$model->cdate = date("Y-m-d H:i:s");
				$dataModel = new linkUser();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$id = $dataModel->save($saveArray);
				
				$extendModel = new linkUserextended();
				$extendModel->initVar($extendModel);
				$extendModel->userId = $id;
				$extendModel->source = $_POST['UserextendedForm']['source']; 
				$extendModel->save();
				
				$this->showmsg("操作成功",'/mywork/user/modify/id/'.$id);
			}
		}
		$data['sex'] = Yii::app()->params['sex'];
		$data['model'] = $model;
		
		$ueModel = new UserextendedForm();
		$data['ueModel'] = $ueModel;
		
		$vipModel = new VippaylogForm();
		$data['vipModel'] = $vipModel;
		
		$data['sourceId'] = $this->getSource();
		$data['interestId'] = $this->getInterest();
		$data['reasonId'] = $this->getReason();
		
		$data['isadd'] = Yii::app()->params['isadd'];
		$data['iscoach'] = Yii::app()->params['iscoach'];
		$data['cardType'] = Yii::app()->params['cardType'];
		
		$data['membership'] = $this->getMemberShip(1);
		
		
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	

	/**
	 *  编辑会员表	 */
	public function actionModify()
	{
		$dataModel = new linkUser();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员表不存在！");
		}
		$model = new UserForm('add');
		if (isset($_POST['UserForm'])) {
		    
		    $dataInfo = $dataInfo[0];
		    $modelArray = get_object_vars($model);
		    foreach ($modelArray as $n => $v){
		        $model->$n = $dataInfo[$n];
		    }
		    
			$model->id = $_REQUEST['id'];
			$model->attributes = $_POST['UserForm'];
			$model->img = $_REQUEST['picPath'];
			$model->cdate = $dataInfo[0]['cdate'];
			if($model->validate()){
				
				if (file_exists($model->img)) {
					$uid = Yii::app()->session['admin_login']['id'];
					$fileNameInfo = explode(".",$model->img);
					$picPath = 'upload/userpic/'.date("Y")."/".date("m");
					is_dir($picPath)?null:@mkdir($picPath,0777,1);
					$fileName = '/'.$uid.'_'.time().'.'.$fileNameInfo[1];
					$picPath = $picPath.$fileName;
					rename($_REQUEST['picPath'],$picPath);
					$model->img = $picPath;
				}
				
				$dataModel = new linkUser();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				
				$extendModel = new linkUserextended();
				$extendModel->initVar($extendModel);
				$extendModel->userId = $dataModel->id;
				$extendInfo = $extendModel->search();
				
				$extendModel->initVar($extendModel);
				if (empty($extendInfo)) {
					$extendModel->userId = $_REQUEST['id'];
					$extendModel->source = $_POST['UserextendedForm']['source'];
					$extendModel->save();
				} else {
					$extendModel->id = $extendInfo[0]['id'];
					$extendModel->source = $_POST['UserextendedForm']['source'];
					$extendModel->modify();
				}
				
				$this->showmsg("操作成功",'/mywork/user/modify/id/'.$_REQUEST['id']);
			}
		} else {
			$dataInfo = $dataInfo[0];
			$modelArray = get_object_vars($model);
			foreach ($modelArray as $n => $v){
				$model->$n = $dataInfo[$n];
			}
		}
		$data['sex'] = Yii::app()->params['sex'];
		
		$data['model'] = $model;
		
		$ueModel = new UserextendedForm();
		
		$extendModel = new linkUserextended();
		$extendModel->initVar($extendModel);
		$extendModel->userId = $dataModel->id;
		$extendInfo = $extendModel->search();
		$extendInfo = $extendInfo[0];
		$modelArray = get_object_vars($ueModel);
		foreach ($modelArray as $n => $v){
			$ueModel->$n = $extendInfo[$n];
		}
		$data['ueModel'] = $ueModel;
		
		$vipModel = new VippaylogForm();
		$data['vipModel'] = $vipModel;
		
		$data['sourceId'] = $this->getSource();
		$data['interestId'] = $this->getInterest();
		$data['reasonId'] = $this->getReason();
		
		$data['isadd'] = Yii::app()->params['isadd'];
		$data['iscoach'] = Yii::app()->params['iscoach'];
		$data['cardType'] = Yii::app()->params['cardType'];
		$data['membership'] = $this->getMemberShip(1);
		
		
		$data['options'] = $model->getOptionName();
		$this->render('add',$data);
	}
	
	
	
	
	/**
	 * 编辑其他会员资料
	 */
	
	public function actionModifyOther()
	{
		
		$dataModel = new linkUser();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("请先保存会员基本资料！");
		}
		
		
		$dataModel = new linkUserextended();
		$dataModel->initVar($dataModel);
		$dataModel->userId = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("请先保存会员基本资料！");
		}
		
		$model = new UserextendedForm();
		if (isset($_POST['UserextendedForm'])) {
			$model->id = $dataInfo[0]['id'];
			$model->userId = $_REQUEST['id'];
			$model->source = $dataInfo[0]['source'];
			$model->attributes = $_POST['UserextendedForm'];
			if($model->validate()){
				$dataModel = new linkUserextended();
				$dataModel->initVar($dataModel);
				$saveArray = $model->attributes;
				$dataModel->modify($saveArray);
				$this->showmsg("操作成功",'/mywork/user/modify/id/'.$_REQUEST['id']);
			}
		}
		$this->showmsg("操作成功",'/mywork/user/modify/id/'.$_REQUEST['id']);
	}
	
	
	
	
	
	
	
	
	
	
	
	/**
	 *  删除会员表	 */
	public function actionDel()
	{
		$dataModel = new linkUser();
		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataInfo = $dataModel->search();
		if (empty($dataInfo)) {
			$this->showmsg("会员表不存在！");
		}

		$dataModel->initVar($dataModel);
		$dataModel->id = $_REQUEST['id'];
		$dataModel->delete();
		$this->showmsg("操作成功",'/mywork/user');
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
						if ($n == 'startDate') {
							$where.=" and cdate >='".$v." 00:00:00' ";
						} elseif ($n == 'endDate'){
							$where.=" and cdate <='".$v."  23:59:39' ";
						} else {
							$where.=" and ".$n."='".$v."' ";
						}
					} else {
						if ($n == 'startDate') {
							$where.=" and $fix.cdate >='".$v." 00:00:00' ";
						} elseif ($n == 'endDate'){
							$where.=" and $fix.cdate <='".$v."  23:59:39' ";
						} else {
							$where.=" and ".$fix.".".$n."='".$v."' ";

						}
					}
				}
			}
		}
		return $where;
	}
	
	/**
	 * 组织查询条件
	 * @param array $needArray
	 */
	function getSearchInfoExpire($needArray,$fix=''){
	    $where = " 1=1 ";
	    if(!empty($needArray)){
	        	
	        foreach ($needArray as $n => $v){
	            if(!empty($v)){
	                $nowDate = date("Y-m-d");
	                if($fix){
	                    if ($n == 'endDate') {
	                        
	                        $where.=" and ".$fix.".endDate <='".$v."' and ".$fix.".endDate>= '".$nowDate."' ";
	                    }  else {
	                        $where.=" and ".$fix.".".$n."='".$v."' ";
	                    }
	                } else {
	                    if ($n == 'endDate') {
	                        $where.=" and endDate <='".$v."' and  endDate>= '".$nowDate."' ";
	                    }  else {
	                        $where.=" and ".$n."='".$v."' ";
	                    }
	                }
	                
	                    
	                
	            }
	        }
	    }
	    return $where;
	}
	
	/**
	 * 异步上传图片
	 */
	public function actionAjaxUpload()
	{
		$model = new UserForm('ajax');
		$model->attributes = $_POST['UserForm'];
	
		if($model->validate()){
			$file = CUploadedFile::getInstance($model,'img');
			if(is_object($file)&&get_class($file) === 'CUploadedFile'){   // 判断实例化是否成功
				//文件扩展名
				$uid = Yii::app()->session['admin_login']['id'];
				$basePath = "temp/";
				is_dir($basePath)?null:@mkdir($basePath,0777,1);
				$fileName = time().".".strtolower($file->extensionName);
				$picPath = $basePath.$uid.'_'.$fileName;
				$file->saveAs($picPath);
				$res['code'] = 0;
				$res['fileName'] = "temp/".$uid.'_'.$fileName;
				$res['filePath'] = $picPath;
				//进行压缩
				$setimg = new sdkSetimg();
				$imageres = $setimg->resizeImage($picPath,500,500);
				$setimg->saveImage($imageres,$picPath,100);
			}
		} else {
			$res['code'] = 1;
			$res['res'] = $model->getError('img');
		}
		echo json_encode($res);
	}


	public function actionTel()
	{
		$data['name'] = "会员表";
		$model = new UsertelForm();
		foreach ($model->attributes as $n => $v) {
			if (!empty($_REQUEST[$n])) {
				$model->$n = $_REQUEST[$n];
			}
		}
		@$model->attributes = $_POST['UsertelForm'];

		if (empty($model->startDate)) {
			$model->startDate = date("Y-m-d");
		}
		if (empty($model->endDate)) {
			$model->endDate = date("Y-m-d");
		}


		foreach ($model->attributes as $n => $v) {
			if(!empty($v)){
				$pageInfo.=$n."/".$v."/";
			}
		}
		$whereInfo = $this->getSearchInfo($model->attributes);



		$dataModel = new linkUsertel();
		$dataModel->initVar($dataModel);
		@$p = $_GET['page']?$_GET['page']:1;
		$total = $dataModel->searchCountNum($whereInfo);

		$whereInfo = $this->getSearchInfo($model->attributes,'a');

		$limit = 20;
		$from = ($p-1)*$limit;
		$page_nums = 10;
		@$page = new sdkPage($total,$p,$limit,$page_nums,"/mywork/user/tel/".$pageInfo."page/");
		$data['page'] = $page->adminShow();
		$whereInfo.= " order by a.id desc limit $from,$limit";

		$data['info'] = $dataModel->getList($whereInfo);


		$data['total'] = $total;
		$data['model'] = $model;
		$data['membership'] = $this->getMemberShip(4);
		$this->render('tellist',$data);
	}
	
	
}
