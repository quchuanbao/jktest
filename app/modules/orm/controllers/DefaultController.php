<?php
class DefaultController extends CController
{
	public $path_link='../framework/sdk1.0/models/link/';
	public $controller_link='modules/mywork/controllers/';
	public $form_link='modules/mywork/models/';
	public $view_link='modules/mywork/views/';
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionGenerate()
	{
		mysql_connect($_POST['ip'],$_POST['user'],$_POST['password']) or die('数据库连接不对');
		$link = mysql_connect($_POST['ip'],$_POST['user'],$_POST['password']);
		mysql_select_db($_POST['dbname']) or die('数据库不对');
		//mysql_set_charset('utf8');
		mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary", $link);
		
		$query=mysql_query('show tables');
		$table=array();
		while($row=mysql_fetch_array($query)){
			$table[]=$row[0];
		}
		
		$exist=array();
		$gen=array();
		foreach($table as $v){
			$file_path=$this->path_link.'link'.ucfirst($v).'.php';
			$controller_path = $this->controller_link.ucfirst($v).'Controller.php';
			$form_path = $this->form_link.ucfirst($v).'Form.php';
			$view_path = $this->view_link.$v.'/';
			is_dir($view_path)?null:@mkdir($view_path,0777,1);
			
			
			if(file_exists($file_path)){
				$exist[]=$v;
			}else{
				$query=mysql_query("SELECT COLUMN_NAME,COLUMN_COMMENT FROM information_schema.columns WHERE TABLE_SCHEMA = '{$_POST['dbname']}' and table_name='$v'");
				$fields=array();
				while($row=mysql_fetch_array($query)){
					$fields[$row[0]]=$row[1];
				}
				$data['table'] = $v;
				$data['fields'] = $fields;
				
				$query=mysql_query("SELECT TABLE_COMMENT from information_schema.TABLES  WHERE TABLE_SCHEMA = '{$_POST['dbname']}' and table_name='$v'");
				$row=mysql_fetch_array($query);
				$data['tableName'] = $row[0];
				
				$code=$this->renderPartial('_class',$data,true);
				file_put_contents($file_path,$code);
				
				$code=$this->renderPartial('_controller',$data,true);
				file_put_contents($controller_path,$code);
				
				$code=$this->renderPartial('_form',$data,true);
				file_put_contents($form_path,$code);
				
				$code=$this->renderPartial('_add',$data,true);
				file_put_contents($view_path."add.php",$code);
				
				$code=$this->renderPartial('_list',$data,true);
				file_put_contents($view_path."list.php",$code);
				
				$gen[]=$v;
			}
		}
		echo 'Exist:'.count($exist).'('.join(',',$exist).')<br>';
		echo 'Generate:'.count($gen).'('.join(',',$gen).')';
	}
}