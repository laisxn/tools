<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Loader;
use Yaf\Application;

class Bootstrap extends Bootstrap_Abstract
{
    public $config;

    // 初始化配置
    public function _initConfig()
    {
        $this->config = Application::app()->getConfig();
    }

    public function _initCommonFunctions()
    {
        Loader::import(Application::app()->getConfig()->application->directory . '/common/Functions.php');
    }



}