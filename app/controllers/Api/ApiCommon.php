<?php
namespace Api;

 class ApiCommonController extends \CommonController
{
    public function init()
    {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

}
