<?php

use App\models\User;

use Service\Traits\AdminLog;
use Yaf\Application;
use Yaf\Controller_Abstract as Controller;
use Log\log;

class IndexController extends Controller
{
    use AdminLog;

    public function init()
    {
    }

    public function indexAction()
    {
        echo phpinfo();
    }


    public function testDbAction()
    {
        $userModel = new User();
        $userModel->name = 'test';
        $userModel->mobile = '12345678910';
        $a = $userModel->get()->toArray();
        dd($a);
    }
}
