<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curl\Method\GetMethod;
use App\Curl\Handle\getDyTkSign;
use App\Curl\Handle\getSignature;
class IndexController extends Controller
{
    public function test(){


        $url = "https://www.douyin.com/share/user/57720812347";
        $ip = $this->get_rand_ip();
        $data = GetMethod::make($url)->setHeader(["CLIENT-IP:$ip", "X-FORWARDED-FOR:$ip"])->setReferer("https://www.douyin.com")->request();

        $dytk =  getDyTkSign::get($data);


/*        $sign =   getSignature::get(57720812347,$data);



        $awm_url = "https://www.douyin.com/aweme/v1/aweme/post/?user_id=57720812347&count=80&max_cursor=0&aid=1128&_signature=ws6e6xASmVJo4d5r9SpCLsLOnv&dytk=4830f6e279a5f53872aab9e9dc112d33";

        $data = GetMethod::make($awm_url)->setReferer("https://www.douyin.com")->request();

        $data = json_decode($data['body'],true);
        dd($data);*/
        return 123;
    }



    public function signature(Request $request){
        file_put_contents(public_path('test1.txt'),serialize($request->all()));
    }

    public function get_rand_ip(){
        $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
        $randarr= mt_rand(0,count($arr_1));
        $ip1id = $arr_1[$randarr];
        $ip2id=  round(rand(600000,  2550000)  /  10000);
        $ip3id=  round(rand(600000,  2550000)  /  10000);
        $ip4id=  round(rand(600000,  2550000)  /  10000);
        return  $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
    }
}
