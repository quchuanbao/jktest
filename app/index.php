<?php
date_default_timezone_set("Asia/Shanghai");
$token = $_REQUEST['token'];
if ($token) {
	session_id($token);
	session_start();
}
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/config/main.php';
$sdk =  dirname(__FILE__) . '/../framework/sdk1.0/link.php';
define('ROOT_DIR', dirname(__FILE__)); 
// remove the following line when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
error_reporting(0);
require_once($yii);
require_once($sdk);
Yii::createWebApplication($config)->run();
