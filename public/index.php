<?php


define('APP_PATH',  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */

// 程序根目录
define('ROOT_PATH', realpath(__DIR__ . '/../'));

// 加载 Composer
require ROOT_PATH.'/vendor/autoload.php';


$app  = new Yaf\Application(APP_PATH . "/config/app.ini");
$app->bootstrap()->run();
