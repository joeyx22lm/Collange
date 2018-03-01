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


class AuthSession {
    private static $connected = false;
    public static function protect(){
        self::start();
        if(!self::$connected || !isset($_SESSION) || empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])){
            // Redirect to login page.
            header("Location: /");
            die();
        }
    }
    public static function start(){
        session_start();
        session_regenerate_id();
        self::$connected = true;
    }
    public static function set($key, $val){
        if(self::$connected){
            $_SESSION[$key] = $val;
        }
    }
    public static function get($key){
        if(self::$connected){
            return $_SESSION[$key];
        }
        return null;
    }
}
?>