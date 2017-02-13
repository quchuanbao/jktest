<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'linklogbt',
	'modules' => array('mywork','orm','api'),
	// preloading 'log' component
	'preload'=>array('log'),

	'defaultController'=>'site',
	'import'=>array(
			'application.models.*',
			'application.api.*',
			'application.components.*',
			'application.modules.srbac.controllers.SBaseController',
			//'application.modules.*'
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=yaoyuehui',
 			'username' => 'yaoyuehui',
 			'password' => 'logbt@yyhui',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
			
		'authManager'=>array(
			'class'=>'srbac.components.SDbAuthManager',
			'itemTable'=>'auth_item',
			'itemChildTable'=>'auth_item_child',
			'assignmentTable'=>'auth_assignment',
			'connectionID'=>'db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=blog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'error/ShowError',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
	'language' => 'zh_cn',
	'sourceLanguage' => 'en_us',
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);