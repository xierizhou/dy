<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/22
 * Time: 14:29
 */

namespace Sunday\SwooleCrontab\Facades;

use Illuminate\Support\Facades\Facade;
class CrontabFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crontab';
    }
}