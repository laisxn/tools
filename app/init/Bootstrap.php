<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Application;
use Yaf\Loader;
use Yaf\Registry;
use Yaf\Session;

class Bootstrap extends Bootstrap_Abstract
{
    public $config;

    /**
     * init config
     */
    public function _initConfig()
    {
        Yaf\Registry::set('config', Yaf\Application::app()->getConfig());
        $this->config = Yaf\Registry::get('config');
    }

    /**
     * start debug
     */
    public function _initIsDebug()
    {
        if ($this->config->project->debug) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        }
    }

    /**
     * start session
     */
    public function _initStartSession()
    {
        Yaf\Session::getInstance()->start();
    }

    /**
     * 初始化数据库
     */
    public function _initCache()
    {
        //初始化 illuminate/database
        $capsule = new Illuminate\Cache\CacheManager();
        $capsule->addConnection($this->config->database->toArray());
        //数据库事件
        //$capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
        $capsule->setAsGlobal();
        //开启Eloquent ORM
        $capsule->bootEloquent();

        class_alias('\Illuminate\Database\Capsule\Manager', 'DB');
    }

    /**
     * 初始化数据库
     */
    public function _initDefaultDbAdapter()
    {
        //初始化 illuminate/database
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($this->config->database->toArray());
        //数据库事件
        //$capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));
        $capsule->setAsGlobal();
        //开启Eloquent ORM
        $capsule->bootEloquent();

        class_alias('\Illuminate\Database\Capsule\Manager', 'DB');
    }

    /**
     * 注册插件
     * @param Yaf\Dispatcher $dispatcher
     */
    public function _initPlugin(Yaf\Dispatcher $dispatcher)
    {

        $sysLog = new RouterPlugin();
        $dispatcher->registerPlugin($sysLog);
        \Illuminate\Support\Facades\Cache::add('aa', 12);
        dd(\Illuminate\Support\Facades\Cache::get('aa'));
    }


}