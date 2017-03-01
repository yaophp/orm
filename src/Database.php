<?php

namespace yaophp;

use think\Config;


define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
// 定义应用目录
defined("APP_PATH") or define('APP_PATH', __DIR__ );
defined('ROOT_PATH') or define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
defined('CONF_PATH') or define('CONF_PATH', APP_PATH); // 配置文件目录
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);


class Database{

	public static function config(array $config)
	{
		$default = include(__DIR__ . DS .'config.php');
		$result['database'] = array_merge($default, $config);
		Config::set($result);
	}
	
}
