<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curl\Method\GetMethod;
use App\Curl\Handle\getDyTkSign;
use App\Curl\Handle\getSignature;
class IndexController extends Controller
{
    public function test(){


        $url = "https://www.douyin.com/share/user/1";
        $data = GetMethod::make($url)->setReferer("https://www.douyin.com")->request();
        $dytk =  getDyTkSign::get($data);
        dd($dytk);

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
}
