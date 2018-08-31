<?php
require "Http.php";
require "getDyTkSign.php";
 $url = "https://www.douyin.com/share/user/1";

$data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();

$dytk =  getDyTkSign::get($data);

if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
    //dd("不能包含中文和特殊字符！");
    echo "none";exit;
    //var_dump(123);exit;

}
echo $dytk;