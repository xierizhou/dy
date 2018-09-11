<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/8/29
 * Time: 12:19
 */

namespace App\Tools\Curl\Method;


use App\Tools\Curl\Http;

class PostMethod extends Http
{
    public static function make(String $url){
        return self::getInstance()->setMethod('post')->setUrl($url);
    }
}