<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/6
 * Time: 14:22
 */

namespace App\Services;

use App\Services\Collection\Collector;
class FactoryService
{
    public function createCollector(){
        return new Collector;
    }
}