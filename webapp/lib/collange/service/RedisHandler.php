<?php
require_once('../../../vendor/autoload.php');
class RedisHandler {
    private static $session = null;

    public static function getSession(){
        return self::$session;
    }

    public static function setSession($resource){
        self::$session = new Predis\Client($resource);
    }
}
?>