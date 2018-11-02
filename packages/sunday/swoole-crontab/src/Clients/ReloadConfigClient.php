<?php
/**
 * Created by PhpStorm.
 * User: rizhou
 * Date: 2018/9/26
 * Time: 17:11
 */

namespace Sunday\SwooleCrontab\Clients;


class ReloadConfigClient extends BaseClient
{

    public function onConnect(\swoole_client $cli)
    {
        $cli->send(json_encode(['action'=>'reload']));
    }


    public function onReceive(\swoole_client $cli, $data)
    {
        $cli->close();
    }

    public function onError(\swoole_client $cli)
    {
        echo "error\n";
    }

    public function onClose(\swoole_client $cli)
    {
        echo "reload success...\n";
    }
}