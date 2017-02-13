<?php
class OrmModule extends CWebModule
{	
	public function init ()
	{
		$this->setImport(
			array('orm.models.*', 
					'orm.components.*',
					'orm.controllers.*')
		);
	}
	
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action)){
			return true;
		}else {
			return false;
		}	
	}
}