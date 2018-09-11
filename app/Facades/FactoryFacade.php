<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/6
 * Time: 14:35
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
class FactoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Factory';
    }
}