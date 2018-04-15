<?php

/**
 * Class Log
 */
class Log {

    public static $level = 1;

    /**
     * @return bool
     */
    private static function shouldError(){
        return self::$level > -1;
    }

    /**
     * @return bool
     */
    private static function shouldWarn(){
        return self::$level > 0;
    }

    /**
     * @return bool
     */
    private static function shouldInfo(){
        return self::$level > 0;
    }

    /**
     * @return bool
     */
    private static function shouldDebug(){
        return self::$level > 1;
    }

    /**
     * @param $str
     */
    public static function error($str){
        if(self::shouldError()){
            file_put_contents("php://stderr", "ERROR: $str\n");
        }
    }

    /**
     * @param $str
     */
    public static function warn($str){
        if(self::shouldWarn()){
            file_put_contents("php://stderr", "ERROR: $str\n");
        }
    }

    /**
     * @param $str
     */
    public static function info($str){
        if(self::shouldInfo()){
            file_put_contents("php://stderr", "ERROR: $str\n");
        }
    }

    /**
     * @param $str
     */
    public static function debug($str){
        if(self::shouldDebug()){
            file_put_contents("php://stderr", "ERROR: $str\n");
        }
    }
}
?>