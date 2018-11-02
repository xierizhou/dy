<?php

namespace Sunday\SwooleCrontab;

use Illuminate\Console\Command;
use Sunday\SwooleCrontab\Server;
use Illuminate\Support\Facades\DB;
use Sunday\SwooleCrontab\Crontab;
use Sunday\SwooleCrontab\Clients\ReloadConfigClient;
use Sunday\SwooleCrontab\Factory;
class SwooleCrontabCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:crontab {oper}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //$timing = "* */2 * * * *";

        //$test = SwooleCrontabCommand::parse($timing,time());
        //dd($test);


        $oper = $this->argument('oper');
        if($oper == 'start'){

            new Server();
        }else{

            Factory::createReloadClient();
        }

    }

}
