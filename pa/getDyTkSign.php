<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/8/29
 * Time: 16:28
 */



class getDyTkSign
{


    public static function get($data){
        $body=str_replace(array("\n","\r\n","  "),'',$data['body']);
        $dytk=self::getSubstr($body,"dytk: '","'}");

        return $dytk;
    }

    public static function getSubStr($str, $leftStr, $rightStr){
        $left = strpos($str, $leftStr);
        $right = strpos($str, $rightStr,$left);
        if($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
    }
}