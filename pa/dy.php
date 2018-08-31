<?php
require "Http.php";
require "getDyTkSign.php";
$pro1 = new swoole_process(function(swoole_process $p){
    echo $p->pid;
    for ($i=1;$i<100000;$i++){
        file_put_contents("./sql-1-s.txt",$i);
        $url = "https://www.douyin.com/share/user/$i";

        $data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
            //dd("不能包含中文和特殊字符！");
            continue;
            //var_dump(123);exit;

        }
        file_put_contents("./sql-1.txt","('$url'),",FILE_APPEND);

    }
});
$pro1->start();



$pro1 = new swoole_process(function(swoole_process $p){
    echo $p->pid;
    for ($i=100001;$i<200000;$i++){
        file_put_contents("./sql-2-s.txt",$i);
        $url = "https://www.douyin.com/share/user/$i";

        $data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
            //dd("不能包含中文和特殊字符！");
            continue;
            //var_dump(123);exit;

        }
        file_put_contents("./sql-2.txt","('$url'),",FILE_APPEND);

    }
});
$pro1->start();


$pro1 = new swoole_process(function(swoole_process $p){
    echo $p->pid;
    for ($i=200001;$i<300000;$i++){
        file_put_contents("./sql-3-s.txt",$i);
        $url = "https://www.douyin.com/share/user/$i";

        $data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
            //dd("不能包含中文和特殊字符！");
            continue;
            //var_dump(123);exit;

        }
        file_put_contents("./sql-3.txt","('$url'),",FILE_APPEND);

    }
});
$pro1->start();


$pro1 = new swoole_process(function(swoole_process $p){
    echo $p->pid;
    for ($i=300001;$i<400000;$i++){
        file_put_contents("./sql-4-s.txt",$i);
        $url = "https://www.douyin.com/share/user/$i";

        $data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
            //dd("不能包含中文和特殊字符！");
            continue;
            //var_dump(123);exit;

        }
        file_put_contents("./sql-4.txt","('$url'),",FILE_APPEND);

    }
});
$pro1->start();


$pro1 = new swoole_process(function(swoole_process $p){
    echo $p->pid;
    for ($i=400001;$i<500000;$i++){
        file_put_contents("./sql-5-s.txt",$i);
        $url = "https://www.douyin.com/share/user/$i";

        $data = Http::getInstance()->setMethod('get')->setHeader(array('Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8','Accept-Language: zh-CN,zh;q=0.9','Cache-Control: max-age=0','Cookie: _ga=GA1.2.1382467954.1535446928; _gid=GA1.2.1470733110.1535446928','User-gent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Mobile Safari/537.36'))->setUrl($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        if(!preg_match("/^[A-Za-z0-9]+$/",$dytk)){
            //dd("不能包含中文和特殊字符！");
            continue;
            //var_dump(123);exit;

        }
        file_put_contents("./sql-5.txt","('$url'),",FILE_APPEND);

    }
});
$pro1->start();

