<?php


class UserPlugin extends Yaf\Plugin_Abstract {

    public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
        //dd($request, $response);
    }

    public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
        //dd($request, $response);
    }
}