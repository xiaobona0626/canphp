<?php
/**
 * Created by PhpStorm.
 * User: bona.xiao
 * Date: 2016/3/17
 * Time: 18:39
 */
class WebApp extends framework\base\App{
    private static $_db = null;
    //db
    //cache
    public static function getDb( $database = 'default'){
        if(empty(self::$_db)){
            self::$_db = new \framework\base\Model($database);
        }
        return self::$_db;
    }
}