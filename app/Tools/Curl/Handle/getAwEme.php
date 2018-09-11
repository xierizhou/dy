<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/7
 * Time: 10:27
 */

namespace App\Tools\Curl\Handle;

use App\Tools\Curl\Method\GetMethod;
class getAwEme
{

    public static function get($user_id,$_signature,$dytk,$count = 25){
        $url = "https://www.douyin.com/aweme/v1/aweme/post/?user_id=57720812347&count=$count&max_cursor=0&aid=1128&_signature=$_signature&dytk=$dytk";

        $data = GetMethod::make($url)->setHeader(['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Safari/537.36'])->request();
        return json_decode($data['body'],true);
    }
}