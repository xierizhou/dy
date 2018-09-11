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
use Illuminate\Support\Facades\Redis;
class getSignature
{



    public static function get($user_id,$body){
        //$ua = $_SERVER['HTTP_USER_AGENT'];

        $tac=self::getSubStr($body['body'],"tac='","'</sc");

        $file=str_replace('{$UA}','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 Safari/537.36',file_get_contents(public_path('sign/douyin_fuck.js')));
        $file=str_replace('{$uid}',$user_id,$file);
        $file=str_replace('{$tac}',$tac,$file);

        $str = "<script src='http://libs.baidu.com/jquery/2.0.0/jquery.min.js'></script>";
        $str .= "<script>";
        $str .= $file;
        $str .= "</script>";
        echo $str;

        set_time_limit(10);
        $sign = '';
        while (true) {
            $sign =  Redis::get('57720812347');
            if($sign){
                break;
            }
        }
        set_time_limit(30);
        return ['uid'=>$user_id,'signature'=>$sign];
    }

    public static function getSubStr($str, $leftStr, $rightStr){
        $left = strpos($str, $leftStr);
        $right = strpos($str, $rightStr,$left);
        if($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
    }
}