<?php
namespace Service\Traits;

trait AdminLog
{
    public function addAdminOperateLog($data)
    {
        return true;
    }

    public function getAdminOperateLog()
    {
        return [];
    }

}