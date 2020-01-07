<?php

use Yaf\Controller_Abstract as Controller;
use Log\log;

class UserController extends Controller
{

    public function indexAction()
    {
        Yaf\Dispatcher::getInstance()->disableView();
        echo 'welcome';
    }

    public function loginAction()
    {
        Yaf\Dispatcher::getInstance()->disableView();
        echo 'ok';
    }

}
