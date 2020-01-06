<?php

use Yaf\Application;
use Yaf\Controller_Abstract as Controller;
use Log\log;

class IndexController extends Controller
{
    public function indexAction() {

        echo phpinfo();
    }
}
