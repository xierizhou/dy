<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/20
 * Time: 14:32
 */

namespace Sunday\SwooleCrontab;

use Illuminate\Support\Facades\DB;
use App;
class Server
{
    private $ip = '0.0.0.0';

    private $port = '9502';

    private $mode = SWOOLE_BASE;

    private $sock_type = SWOOLE_SOCK_TCP;

    private $cron = [];







    public function __construct()
    {
        $crontab = App::make('crontab');

        $this->ip = $crontab->config('ip')?:$this->ip;
        $this->port = $crontab->config('port')?:$this->port;
        $this->cron = $crontab->config('task')?:$this->cron;


        $serv = new \swoole_server($this->ip, $this->port);
        $serv->set(array(
            'worker_num' => 4,
            'task_worker_num'=>4,
            'daemonize' => false,
            'backlog' => 128,
        ));


        $serv->on('Connect', array($this,'onConnect'));
        $serv->on('Receive', array($this,'onReceive'));
        $serv->on('Close', array($this,'onClose'));
        $serv->on('WorkerStart',array($this,'onWorkerStart'));
        $serv->on('Start',array($this,'onStart'));
        $serv->on('Task',array($this,'onTask'));
        $serv->on('Finish',array($this,'onFinish'));
        $serv->on('PipeMessage',array($this,'onPipeMessage'));
        $serv->start();
    }

    public function onConnect($serv, $fd){

    }

    public function onReceive(\swoole_server $serv, $fd, $from_id, $data){
        $data = json_decode($data,true);
        if(array_get($data,'action') == 'reload'){
            $serv->sendMessage(json_encode(['pipe_type'=>'reload']),0);
            $serv->send($fd,json_encode(['type'=>array_get($data,'action'),'status'=>'success']));
        }

    }

    public function onClose($serv, $fd){

    }


    public function onStart(\swoole_server $serv){
        echo "定时任务已开启";
    }


    public function onWorkerStart(\swoole_server $server, int $worker_id){

        if($worker_id == 1){

            $server->sendMessage(json_encode(['pipe_type'=>'check']), $worker_id-1);
        }

    }

    public function onTask(\swoole_server $serv, int $task_id, int $src_worker_id,  $data){
            $data = json_decode($data,true);
            exec(array_get($data,'command'),$out);

            $serv->sendMessage(json_encode(['pipe_type'=>'suc','crontab'=>json_encode($data),'result'=>implode(PHP_EOL,$out)]),1);



    }

    public function onFinish(\swoole_server $serv, int $task_id, string $data){

    }

    public function onPipeMessage(\swoole_server $server, int $src_worker_id, $message){
        $message = json_decode($message,true);

        if(array_get($message,'pipe_type') == 'check'){

            $server->tick(1000, function()use($server){  //检查任务

                foreach($this->cron as $key=>$item){

                    if(!is_null(Server::parse(array_get($item,'timing'))) && is_array(Server::parse(array_get($item,'timing')))){
                        $server->task(json_encode($item));
                    }

                }
            });
        }

        if(array_get($message,'pipe_type') == 'suc'){ //task 结束
            $crontab = json_decode(array_get($message,'crontab'),true);
            DB::table('crotab')->insert([
                'name'=>array_get($crontab,'name'),
                'result'=>array_get($message,'result'),
                'created_at'=>time()
            ]);
        }

        if(array_get($message,'pipe_type') == 'reload'){  //重新载入配置
            $cron = require(config_path('swoole_crontab.php'));
            $this->cron = array_get($cron,'task');
            var_dump($this->cron);
        }

    }



    static public $error;
    /**
     *  解析crontab的定时格式，linux只支持到分钟/，这个类支持到秒
     * @param string $crontab_string :
     *
     *      0     1    2    3    4    5
     *      *     *    *    *    *    *
     *      -     -    -    -    -    -
     *      |     |    |    |    |    |
     *      |     |    |    |    |    +----- day of week (0 - 6) (Sunday=0)
     *      |     |    |    |    +----- month (1 - 12)
     *      |     |    |    +------- day of month (1 - 31)
     *      |     |    +--------- hour (0 - 23)
     *      |     +----------- min (0 - 59)
     *      +------------- sec (0-59)
     * @param int $start_time timestamp [default=current timestamp]
     * @return int unix timestamp - 下一分钟内执行是否需要执行任务，如果需要，则把需要在那几秒执行返回
     * @throws InvalidArgumentException 错误信息
     */
    static public function parse($crontab_string, $start_time = null)
    {
        if (!preg_match('/^((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)$/i',
            trim($crontab_string))
        ) {
            if (!preg_match('/^((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)\s+((\*(\/[0-9]+)?)|[0-9\-\,\/]+)$/i',
                trim($crontab_string))
            ) {
                self::$error = "Invalid cron string: " . $crontab_string;
                return false;
            }
        }
        if ($start_time && !is_numeric($start_time)) {
            self::$error = "\$start_time must be a valid unix timestamp ($start_time given)";
            return false;
        }
        $cron = preg_split("/[\s]+/i", trim($crontab_string));
        $start = empty($start_time) ? time() : $start_time;



        if (count($cron) == 6) {
            $date = array(
                'second' => (empty($cron[0])) ? array(1 => 1) : self::_parse_cron_number($cron[0], 1, 59),
                'minutes' => self::_parse_cron_number($cron[1], 0, 59),
                'hours' => self::_parse_cron_number($cron[2], 0, 23),
                'day' => self::_parse_cron_number($cron[3], 1, 31),
                'month' => self::_parse_cron_number($cron[4], 1, 12),
                'week' => self::_parse_cron_number($cron[5], 0, 6),
            );

        } elseif (count($cron) == 5) {
            $date = array(
                'second' => array(1 => 1),
                'minutes' => self::_parse_cron_number($cron[0], 0, 59),
                'hours' => self::_parse_cron_number($cron[1], 0, 23),
                'day' => self::_parse_cron_number($cron[2], 1, 31),
                'month' => self::_parse_cron_number($cron[3], 1, 12),
                'week' => self::_parse_cron_number($cron[4], 0, 6),
            );

        }

        if (
            in_array(intval(date('i', $start)), $date['minutes']) &&
            in_array(intval(date('G', $start)), $date['hours']) &&
            in_array(intval(date('j', $start)), $date['day']) &&
            in_array(intval(date('w', $start)), $date['week']) &&
            in_array(intval(date('n', $start)), $date['month'])

        ) {
            return $date['second'];
        }
        return null;
    }

    /**
     * 解析单个配置的含义
     * @param $s
     * @param $min
     * @param $max
     * @return array
     */
    static protected function _parse_cron_number($s, $min, $max)
    {
        $result = array();
        $v1 = explode(",", $s);
        foreach ($v1 as $v2) {
            $v3 = explode("/", $v2);
            $step = empty($v3[1]) ? 1 : $v3[1];
            $v4 = explode("-", $v3[0]);
            $_min = count($v4) == 2 ? $v4[0] : ($v3[0] == "*" ? $min : $v3[0]);
            $_max = count($v4) == 2 ? $v4[1] : ($v3[0] == "*" ? $max : $v3[0]);
            for ($i = $_min; $i <= $_max; $i += $step) {
                if (intval($i) < $min) {
                    $result[$min] = $min;
                } elseif (intval($i) > $max) {
                    $result[$max] = $max;
                } else {
                    $result[$i] = intval($i);
                }
            }
        }
        ksort($result);
        return $result;
    }



}