<?php


abstract class CommonController extends \Yaf\Controller_Abstract
{
    public function init()
    {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

}
