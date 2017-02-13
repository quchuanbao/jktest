<?php
class MyworkModule extends CWebModule
{	
	public function init ()
	{
		$this->setImport(
			array('mywork.models.*', 
					'mywork.components.*',
					'mywork.controllers.*')
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
