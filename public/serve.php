<?php

define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */

$app  = new Yaf\Application(APP_PATH . "/config/app.ini");

$repuest = new Yaf\Request\Simple();
$app->bootstrap();
//dd($repuest);


if ($repuest->isCli()) {
    /**
     * /usr/local/php/bin/php /home/wwwroot/swoole-yaf/cli.php Cli~Test/index
     * $argc $argv 是php自带的两个参数
     * $argc是获取cli模式下参数的个数 例如上面指令就是两个
     * $argv是获取参数的值 是一个数组
     */
    global $argc, $argv;
    if ( $argc > 1 ) {
        $module = '';
        $uri = $argv [1];//获取到Cli~Test/index
        if ( preg_match ( '/^[^?]*~/i', $uri ) ) {
            list ( $module, $uri ) = explode ( '~', $uri, 2 );//将获取的值按~分割成两个
        }
        $module = strtolower(  $module ); //获取到模块Cli
        $modules = Yaf\Application::app()->getModules ();//获取application.ini配置文件下的合法模块

        if ( in_array ( ucfirst ( $module ), $modules ) ) { //判断Cli模块是否在配置文件中已经配置
            $repuest->setModuleName ( $module );//在路由中的设置模块名
        }
        if ( false === strpos ( $uri, '?' ) ) {//解析uri是否带有参数
            $args = array ();
        } else {
            list ( $uri, $args ) = explode ( '?', $uri, 2 );
            parse_str ( $args, $args );
        }
        foreach ( $args as $k => $v ) {//将参数值写入请求路由中
            $repuest->setParam ( $k, $v );
        }
        $repuest->setRequestUri ( $uri ); //在路由中设置uri
        if ( $repuest->isRouted () && ! empty ( $uri ) ) {//判断路由是否合法，uri是否非空
            if ( false !== strpos ( $uri, '/' ) ) {
                list ( $controller, $action ) = explode ( '/', $uri );
                $repuest->setActionName ( $action );//在路由中设置方法名
            } else {
                $controller = $uri;
            }
            $repuest->setControllerName ( ucfirst ( strtolower ( $controller ) ) );//在路由中设置控制器名
        }
    }
    $app->bootstrap()->getDispatcher()->flushInstantly( true )->dispatch( $repuest ); // 如果打开flushIstantly, 则视图渲染结果会直接发送给请求端而不会写入Response对象
} else {
    exit;

}