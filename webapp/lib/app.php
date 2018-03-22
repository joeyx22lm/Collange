<?php
class StaticResource {
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
StaticResource::setStaticResource(array(
    'APP_TITLE'=>'Collange '
));


class App {
    public static function buildNavbar(){
        require(__DIR__.'/ui/navbar.php');
    }
}

class AuthSession {
    private static $connected = false;
    public static function protect(){
        self::start();
        if(!self::isLoggedIn()){
            // Redirect to login page.
            header("Location: /");
            die();
        }
    }

    public static function password_hash($password){
        return password_hash($password, PASSWORD_DEFAULT, ["cost"=>12]);
    }
    public static function password_verify($password, $hash){
        return password_verify($password, $hash);
    }
    public static function isLoggedIn(){
        if(!self::$connected || !isset($_SESSION) || empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])){
            return false;
        }
        return true;
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