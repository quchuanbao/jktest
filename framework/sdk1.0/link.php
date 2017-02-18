<?php
date_default_timezone_set('Asia/Shanghai');
define('PM_PATH_ROOT', str_replace('\\','/',dirname(__FILE__)));

//项目名称
define('PM_NAME','link');

//数据库配置
define('PM_DB_HOST',"127.0.0.1");
define('PM_DB_USER',"homestead");
define('PM_DB_PASSWORD',"secret");
define('PM_DB_NAME',"ruike");
include PM_PATH_ROOT.'/config/common_inc.php';
