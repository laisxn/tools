<?php
namespace Api;

 class ApiCommonController extends \CommonController
{
    public function init()
    {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

     /**
      * @param null $data
      * @param string $msg
      */
    public function success($data = null, $msg = 'success')
    {
        $data = [
            'code' => 0,
            'msg' => $msg,
            'data' => $data
        ];
        return $this->response($data);
    }

     /**
      * @param null $data
      * @param string $msg
      */
    public function fail($data = null, $msg = 'error')
    {
        $data = [
            'code' => 1,
            'msg' => $msg,
            'data' => $data
        ];
        return $this->response($data);
    }

     /**
      * @param $data
      */
    public function response($data) {
        echo json_encode($data);
    }

}
