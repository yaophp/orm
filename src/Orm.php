<?php

namespace yaophp;

use think\App;
use think\Container;
use think\Facade;
use think\Config;
use think\Cache;
use think\Log;

class Orm{
	protected static $default = [
       // 数据库类型
	   'type'            => 'mysql',
	   // 服务器地址
	   'hostname'        => '127.0.0.1',
	   // 数据库名
	   'database'        => '',
	   // 用户名
	   'username'        => '',
	   // 密码
	   'password'        => '',
	   // 端口
	   'hostport'        => '',
	   // 连接dsn
	   'dsn'             => '',
	   // 数据库连接参数
	   'params'          => [],
	   // 数据库编码默认采用utf8
	   'charset'         => 'utf8',
	   // 数据库表前缀
	   'prefix'          => '',
	   // 数据库调试模式
	   'debug'           => false,
	   // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	   'deploy'          => 0,
	   // 数据库读写是否分离 主从式有效
	   'rw_separate'     => false,
	   // 读写分离后 主服务器数量
	   'master_num'      => 1,
	   // 指定从服务器序号
	   'slave_no'        => '',
	   // 是否严格检查字段是否存在
	   'fields_strict'   => true,
	   // 数据集返回类型
	   'resultset_type'  => '',
	   // 自动写入时间戳字段
	   'auto_timestamp'  => false,
	   // 时间字段取出后的默认时间格式
	   'datetime_format' => 'Y-m-d H:i:s',
	   // 是否需要进行SQL性能分析
	   'sql_explain'     => false,
	   // Builder类
	   'builder'         => '',
	   // Query类
	   'query'           => '\\think\\db\\Query',
	   // 是否需要断线重连
	   'break_reconnect' => false,

	   // runtime path
	   'runtime_path' => ''
	];

	protected static $init = false;

	public static function config(array $config=[])
	{
		if (!static::$init) {
			Container::getInstance()->bind([
				'app'                   => App::class,
				'config'                => Config::class,
				'log'                   => Log::class,
				'cache'					=> Cache::class,
				// 接口依赖注入
				'think\LoggerInterface' => Log::class,
			]);

			Facade::bind([
				\think\facade\Config::class => Config::class,
				\think\facade\Log::class => Log::class
            ]);
            
            if (!$config) {
                $configFile = \dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'database.php';
                if (!is_file($configFile)) {
                    throw new \RuntimeException('database config not input and config file not exists');
                }
                $config = include $configFile;
            }

            \think\facade\Config::set(['database' => array_merge(static::$default, $config)]);
			static::$init = true;
		}
		
	}

}
