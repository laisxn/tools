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
     * // 加载 Composer
     */
    public function _initAutoload()
    {
        require ROOT_PATH.'/vendor/autoload.php';
    }

    /**
     * init config
     */
    public function _initConfig()
    {
        Yaf\Registry::set('config', Yaf\Application::app()->getConfig());
        $this->config = Yaf\Registry::get('config');
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




}