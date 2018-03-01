<?php
class App {
    private static $StaticResource = null;
    public static function setStaticResource($arr, $val=null){
        if($val == null){
            self::$StaticResource = $arr;
        }

        else {
            if(self::$StaticResource == null) self::$StaticResource = array();
            self::$StaticResource[$arr] = $val;
        }
    }
    public static function getStaticResource($key){
        return(self::$StaticResource == null ? null : self::$StaticResource[$key]);
    }
}
App::setStaticResource(array(
    'APP_TITLE'=>'Collange '
));
?>