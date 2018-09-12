<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Curl\Method\GetMethod;
class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:socket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = "http://buyercamp.xyz/apis/test/socket";
        //$body = file_get_contents($url);
        $ip = $this->get_rand_ip();
        $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->request();
        dd($data);
    }

    public function get_rand_ip(){
        $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
        $randarr= mt_rand(0,count($arr_1)-1);

        $ip1id = $arr_1[$randarr];

        $ip2id=  round(rand(600000,  2550000)  /  10000);
        $ip3id=  round(rand(600000,  2550000)  /  10000);
        $ip4id=  round(rand(600000,  2550000)  /  10000);
        return  $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
    }
}
