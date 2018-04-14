<?php
class StaticResource {
    private static $StaticResource = null;
    public static function set($arr, $val=null){
        if($val == null){
            self::$StaticResource = $arr;
        }

        else {
            if(self::$StaticResource == null) self::$StaticResource = array();
            self::$StaticResource[$arr] = $val;
        }
    }
    public static function get($key){
        return(self::$StaticResource == null ? null : self::$StaticResource[$key]);
    }
}
?>