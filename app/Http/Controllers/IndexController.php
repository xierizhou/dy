<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curl\Method\GetMethod;
use App\Curl\Handle\getDyTkSign;
use App\Curl\Handle\getSignature;
use App\Models\User;
class IndexController extends Controller
{
    public function getAwew(){
        $uid = request('uid');
        $sign = request('sign');

        $dytk = \Redis::get(request('uid').'_dytk');
        $url  = "https://www.douyin.com/aweme/v1/aweme/post/?user_id=$uid&count=25&max_cursor=0&aid=1128&_signature=$sign&dytk=$dytk";
        $data = GetMethod::make($url)->setHeader([
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: zh-CN,zh;q=0.9',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Safari/537.36'
        ])->request();

        User::where("dy_uid",$uid)->update([
            'dy_data_json'=>$data['body']
        ]);

    }
}
