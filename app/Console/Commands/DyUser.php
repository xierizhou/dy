<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Curl\Method\GetMethod;
use App\Curl\Handle\getDyTkSign;
use Factory;
use App\Models\User;
use App\Models\TempUser;
class DyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dyuser:start';

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
       /* $ip = $this->get_rand_ip();
        $url = "https://www.douyin.com/share/user/57720812347";
        //$data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip","User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Mobile Safari/537.35"])->setReferer("https://www.baidu.com")->request();
        $data = file_get_contents($url);*/


        $y = file_get_contents(public_path("sql-11-s.txt"));
        $i = 55011849934;
        if($y>=$i){
            $i = $y;
        }

        while (true){


            //$ip = $this->get_rand_ip();
            file_put_contents(public_path("sql-11-s.txt"),$i);
            $url = "https://www.douyin.com/share/user/$i";
            /*$data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip","User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/".rand(100,537).".36 (KHTML, like Gecko) Chrome/69.0.".rand(1000,3497).".81 Mobile Safari/".rand(100,537).".35"])->setReferer("https://www.baidu.com")->request();
            $dytk =  getDyTkSign::get($data);

            if(preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                file_put_contents(public_path("sql-11.txt"),"('$url'),",FILE_APPEND);
            }*/


            $data = Factory::createCollector()->getUserInfo($url);
            $insert = [
                'dy_uid'=>array_get($data,'uid'),
                'dy_number'=>array_get($data,'dy_number'),
                'nickname'=>array_get($data,'nickname'),
                'avatar'=>array_get($data,'avatar'),
                'dy_url'=>$url,
                //'dy_data_json'=> json_encode($data),
                'short_introduce'=>array_get($data,'short_introduce'),
                'position'=>array_get($data,'position'),
                'constellation'=>array_get($data,'constellation'),
                'follow_count'=>array_get($data,'follow_count'),
                'fans_count'=>array_get($data,'fans_count'),
                'fabulous_count'=>array_get($data,'fabulous_count'),
                'dy_number_icon' => array_get($data,'dy_number_icon'),
            ];


            User::create($insert);



            $i++;
            if($i>=70000000000){
                break;
            }
        }
        echo "ok";exit;


        /*$pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=50000000000;$i<5100000000;$i++){

                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-1.txt"),"('$url'),",FILE_APPEND);

            }
        });
        $pro1->start();

        $pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=51000000001;$i<52000000000;$i++){

                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-2.txt"),"('$url'),",FILE_APPEND);

            }
        });
        $pro1->start();

        $pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=52000000001;$i<53000000000;$i++){

                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-3.txt"),"('$url'),",FILE_APPEND);

            }
        });
        $pro1->start();

        $pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=53000000001;$i<54000000000;$i++){

                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-4.txt"),"('$url'),",FILE_APPEND);

            }
        });
        $pro1->start();

        $pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=54000000001;$i<55000000000;$i++){

                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-5.txt"),"('$url'),",FILE_APPEND);

            }
        });
        $pro1->start();*/

        //dd($this->get_rand_ip());aaa

/*        $pro1 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;

            for ($i=55000000001;$i<56000000000;$i++){

                $ip = $this->get_rand_ip();
                file_put_contents(public_path("sql-6-s.txt"),$i);
                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    continue;
                }
                file_put_contents(public_path("sql-6.txt"),"('$url'),",FILE_APPEND);
                sleep(1);

            }
        });
        $pro1->start();

        $pro2 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=56000000001;$i<57000000000;$i++){
                $ip = $this->get_rand_ip();
                file_put_contents(public_path("sql-7-s.txt"),$i);
                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;
                }
                file_put_contents(public_path("sql-7.txt"),"('$url'),",FILE_APPEND);
                sleep(1);

            }
        });
        $pro2->start();

        $pro3 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=57000000001;$i<58000000000;$i++){
                $ip = $this->get_rand_ip();
                file_put_contents(public_path("sql-8-s.txt"),$i);
                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;

                }
                file_put_contents(public_path("sql-8.txt"),"('$url'),",FILE_APPEND);
                sleep(1);

            }
        });
        $pro3->start();

        $pro4 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;
            for ($i=58000000001;$i<59000000000;$i++){
                $ip = $this->get_rand_ip();
                file_put_contents(public_path("sql-9-s.txt"),"$i");
                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;
                }
                file_put_contents(public_path("sql-9.txt"),"('$url'),",FILE_APPEND);
                sleep(1);

            }
        });
        $pro4->start();

        $pro5 = new \swoole_process(function(\swoole_process $p){
            echo $p->pid;

            for ($i=59000000001;$i<60000000000;$i++){
                $ip = $this->get_rand_ip();
                file_put_contents(public_path("sql-10-s.txt"),$i);
                $url = "https://www.douyin.com/share/user/$i";
                $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();
                $dytk =  getDyTkSign::get($data);
                if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
                    //dd("不能包含中文和特殊字符！");
                    continue;
                }
                file_put_contents(public_path("sql-10.txt"),"('$url'),",FILE_APPEND);
                sleep(1);
            }
        });
        $pro5->start();


        \swoole_process::wait();*/
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
