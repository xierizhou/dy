<?php
/**
 * Created by PhpStorm.
 * User: rizhou
 * Date: 2018/9/26
 * Time: 17:22
 */

namespace Sunday\SwooleCrontab;

use Sunday\SwooleCrontab\Clients\ReloadConfigClient;
class Factory
{
    public static function createHttpServer(){

    }

    public static function createReloadClient(){
        return new ReloadConfigClient();
    }
}