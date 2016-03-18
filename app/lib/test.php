<?php
/**
 * Created by PhpStorm.
 * User: bona.xiao
 * Date: 2016/3/17
 * Time: 17:03
 */
namespace app\lib;
class Test{
    public static function server(){
        print_r($_SERVER);
    }

    public static function env(){
        print_r($_ENV);
    }
}