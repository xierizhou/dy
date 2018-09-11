<?php

namespace App\Http\Controllers\Admin;

use App\Models\TempUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Factory;
use Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
class TempUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TempUser $tempUser)
    {


        //


        if($search = request('search'))
            $tempUser = $tempUser->where('url','like',"%$search%");

        return view("admin.temp.user")->withData(

            $tempUser->paginate(config('admin.page_pre'))
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idupdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $temp = TempUser::find($id);
        $data = Factory::createCollector()->getUserInfo($temp->url);

        User::create([
            'dy_uid'=>array_get($data,'uid'),
            'dy_number'=>array_get($data,'number'),
            'nickname'=>array_get($data,'nickname'),
            'avatar'=>array_get($data,'avatar'),
            'dy_url'=>$temp->url,
            'dy_data_json'=> json_encode($data),
            'short_introduce'=>array_get($data,'short_introduce'),
            'position'=>array_get($data,'position'),
            'constellation'=>array_get($data,'constellation'),
            'follow_count'=>array_get($data,'follow_count'),
            'fans_count'=>array_get($data,'fans_count'),
            'fabulous_count'=>array_get($data,'fabulous_count'),
            'dy_uid_icon' => array_get($data,'dy_uid_icon'),
        ]);
        $temp->delete();

        return response()->json([
            'code' => 200,
            'message' => '操作成功'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TempUser::delete($id);
    }
}
