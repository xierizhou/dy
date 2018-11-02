<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/26
 * Time: 17:05
 */

namespace Sunday\SwooleCrontab\Clients;


abstract class BaseClient
{
    public function __construct()
    {
        $ip = config('swoole_crontab.ip','0.0.0.0');
        $port = config('swoole_crontab.port','9501');
        $client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        $client->on("connect", array($this,"onConnect"));
        $client->on("receive", array($this,"onReceive"));
        $client->on("error", array($this,"onError"));
        $client->on("close", array($this,"onClose"));
        $client->connect($ip, $port);
    }

    abstract function onConnect(\swoole_client $cli);
    abstract function onReceive(\swoole_client $cli,$data);
    abstract function onError(\swoole_client $cli);
    abstract function onClose(\swoole_client $cli);
}