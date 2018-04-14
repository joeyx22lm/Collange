<?php
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
    public static function getUser(){
        return self::get('user');
    }
    public static function logout(){
        if(self::isLoggedIn()){
            self::set('user', null);
            $_SESSION = array();
            unset($_SESSION);
        }
    }
}
?>