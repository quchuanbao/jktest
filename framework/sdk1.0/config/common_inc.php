<?php

/**
 * 自动加载类
 * @param project $class
 */
function __autoload($class)
{
	$common_path =  PM_PATH_ROOT."/models/common/".$class.".php";
	$tools_path =  PM_PATH_ROOT."/tools/".$class.".php";
	$namespace_path = PM_PATH_ROOT."/models/".PM_NAME."/".$class.".php";
	if (file_exists($common_path)){
		require_once($common_path);
	} elseif (file_exists($tools_path)){
		require_once($tools_path);
	} elseif (file_exists($namespace_path)){
		require_once($namespace_path);
	}
}
