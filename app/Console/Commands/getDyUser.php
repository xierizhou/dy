<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Factory;
use App\Models\User;
use App\Models\TempUser;
class getDyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dy:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $process_num = 4;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $temp = TempUser::all();

        $num = ceil(count($temp) / $this->process_num);
        $new_temp = array_chunk($temp->toArray(),$num);



        foreach($new_temp as $key=>$val){

            $pro = new \swoole_process(function(\swoole_process $p) use($val){
                foreach($val as $vv){

                    $url = array_get($vv,'url');
                    $data = Factory::createCollector()->getUserInfo($url);

                    if(array_get($data,'nickname')){
                        try{
                            \DB::beginTransaction();
                            $insert = [
                                'dy_uid'=>array_get($data,'uid'),
                                'dy_number'=>array_get($data,'dy_number'),
                                'nickname'=>array_get($data,'nickname'),
                                'avatar'=>array_get($data,'avatar'),
                                'dy_url'=>$url,
                                //'dy_data_json'=> json_encode($data),
                                'short_introduce'=>array_get($data,'short_introduce'),
                                'position'=>array_get($data,'position'),
                                'constellation'=>array_get($data,'constellation'),
                                'follow_count'=>array_get($data,'follow_count'),
                                'fans_count'=>array_get($data,'fans_count'),
                                'fabulous_count'=>array_get($data,'fabulous_count'),
                                'dy_number_icon' => array_get($data,'dy_number_icon'),
                            ];


                            User::create($insert);
                            TempUser::find(array_get($vv,'id'))->delete();

                            \DB::commit();
                        }catch (\Exception $exception){

                            \DB::rollBack();
                        }

                    }
                    sleep(1);
                }

            });
            $pro->start();

        }
        \swoole_process::wait();


        return response()->json([
            'code' => 200,
            'message' => '操作成功'
        ]);
    }


}
