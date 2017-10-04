<?php

namespace think;

//make debug false;
class App implements \ArrayAccess
{
    public static $debug = false;
    protected $container;
     protected $runtimePath;

    public function __construct()
    {
        $this->container   = Container::getInstance();
        $this->runtimePath = \dirname(__DIR__) . DIRECTORY_SEPARATOR . 'runtime';
    }

	public function log($log, $type = 'info')
    {
		// do nothing
        // $this->debug && $this->log->record($log, $type);
    }

    /**
     * 获取应用运行时目录
     * @return string
     */
     public function getRuntimePath()
     {
         return Container::getInstance()->get('config')->get('database.runtime_path') ?: $this->runtimePath;
        //  return $this->runtimePath;
     }

    /**
     * 获取容器实例
     * @return Container
     */
     public function container()
     {
         return $this->container;
     }
 
     public function __set($name, $value)
     {
         $this->container->bind($name, $value);
     }
 
     public function __get($name)
     {
         return $this->container->make($name);
     }
 
     public function __isset($name)
     {
         return $this->container->bound($name);
     }
 
     public function __unset($name)
     {
         $this->container->__unset($name);
     }
 
     public function offsetExists($key)
     {
         return $this->__isset($key);
     }
 
     public function offsetGet($key)
     {
         return $this->__get($key);
     }
 
     public function offsetSet($key, $value)
     {
         $this->__set($key, $value);
     }
 
     public function offsetUnset($key)
     {
         $this->__unset($key);
     }
}