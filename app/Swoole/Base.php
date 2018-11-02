<?php
/**
 * Created by PhpStorm.
 * User: elite
 * Date: 2018/9/28
 * Time: 16:55
 */

namespace App\Swoole;


abstract class Base
{
    private static $instance;
    private function __construct(){}
    private function __clone(){}

    abstract public static function getInstance();

}