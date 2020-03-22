<?php


class RouterPlugin extends Yaf\Plugin_Abstract {

    public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
        //dd($request, $response);
    }

    public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
        //dd($request, $response);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function xssClean($data)
    {
        if(is_array($data)){
            return filter_var_array($data, FILTER_SANITIZE_STRING);
        }else{
            return filter_var($data, FILTER_SANITIZE_STRING);
        }
    }

}