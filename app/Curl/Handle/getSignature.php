<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/8/29
 * Time: 17:05
 */

namespace App\Curl\Handle;

use App\Curl\Method\PostMethod;
use App\Curl\Method\GetMethod;
class getSignature
{



    public static function get($user_id,$body){
        $ua = $_SERVER['HTTP_USER_AGENT'];

        //$tac=self::getSubStr($body['body'],"tac='","'</sc");

       /* $file=str_replace('{$UA}',$_SERVER['HTTP_USER_AGENT'],file_get_contents(public_path('sign/douyin_fuck.js')));
        $file=str_replace('{$uid}',$user_id,$file);
        $file=str_replace('{$tac}',$tac,$file);*/
        $res = PostMethod::make("http://192.168.0.111:8081/process_post")->setHeader(["Content-Type: application/x-www-form-urlencoded"])->setData(http_build_query(['user_id'=>$user_id,'ua'=>$ua,]))->request();

        return json_decode($res['body'],1);
    }

    public static function getSubStr($str, $leftStr, $rightStr){
        $left = strpos($str, $leftStr);
        $right = strpos($str, $rightStr,$left);
        if($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
    }
}