<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/28
 * Time: 16:53
 */

namespace App\Swoole;
use swoole_server;

class Server
{
    public function __construct(){
        $serv = new swoole_server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);
        $serv->set(array(
            'worker_num' => 4,
            'daemonize' => true,
            'backlog' => 128,
        ));

        $serv->on('Connect', array($this,'onConnect'));
        $serv->on('Receive', array($this,'onReceive'));
        $serv->on('Task', array($this,'onTask'));
        $serv->on('Close', array($this,'onClose'));
        $serv->start();
    }

    public function onConnect(swoole_server $server,$fd,$reactorId){

    }

    public function onReceive(swoole_server $server, int $fd, int $reactor_id, string $data){

    }

    public function onClose(swoole_server $server, int $fd, int $reactorId){

    }

    public function onTask(swoole_server $server, int $task_id, int $src_worker_id,  $data){

    }


}