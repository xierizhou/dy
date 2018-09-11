<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/6
 * Time: 17:14
 */

namespace App\Services\Collection;

use App\Tools\Curl\Method\GetMethod;
use App\Curl\Handle\getDyTkSign;
use App\Curl\Handle\getSignature;
use App\Tools\Curl\Handle\getAwEme;
class Collector
{
    public function getUserInfo($url){
        $cd = explode('/',$url);
        $user_id = $cd[count($cd)-1];

        $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
        //$str = '<div class="subnav-title-name"><a href="http://www.autohome.com.cn/16/">一汽-大众-捷达</a></div>';


        $rule = '/<p class="nickname">(.*?)<\/p>/ies';
        preg_match($rule,$data['body'],$match);

        $rule = '/<img class="avatar" src="(.*?)">/ies';
        preg_match($rule,$data['body'],$match2);


        preg_match('/<span class="location(.*?)">(.*?)<\/span>/s',$data['body'],$match3);

        preg_match('/<span class="constellation(.*?)">(.*?)<\/span>/s',$data['body'],$match4);



        $rule = '/<p class="signature">(.*?)<\/p>/s';
        preg_match($rule,$data['body'],$match5);




        //匹配dy号
        $rule = '/<p class="shortid">抖音ID：(.*?) <\/p>/ies';
        preg_match($rule,$data['body'],$match6);

        $rule = '/(.*?)<i class="icon iconfont ">(.*?)<\/i>/s';
        preg_match_all($rule,array_get($match6,1),$match7);



        //$dytk =  getDyTkSign::get($data);
        //$sign =   getSignature::get($user_id,$data);
        //dd($sign);
        //$data = getAwEme::get($user_id,$sign['signature'],$dytk);
        $res['uid'] = $user_id;
        $res['dy_number_icon'] = implode('|',array_get($match7,2));
        $res['dy_number'] = array_get($match7,'1.0');
        $res['nickname'] = array_get($match,1);
        $res['avatar'] = array_get($match2,1);
        $res['position'] = array_get($match3,2);
        $res['constellation'] = array_get($match4,2);
        $res['short_introduce'] = array_get($match5,1);

        return $res;
    }
}