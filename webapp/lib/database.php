<?php
/*
 * Copyright 2017 Joseph Orlando.
 */
class Database {
    private static $session = null;

    // Connect using a ConnectionURL, as such: setSession('mysql://user:pass@hostname/dbname');
    // Connect using connection parameters, as such: setSession('hostname', 'user', 'pass', 'dbname');
    public static function setSession($host='', $user='', $pass='', $dbname=''){
        if(empty($dbname) && !empty($host)){
            // Connect URL given.
            $UrlParts = parse_url($host);
            if(!empty($UrlParts)){
                return self::setSession($UrlParts['host'], $UrlParts['user'], $UrlParts['pass'], str_replace('/', '', $UrlParts['path']));
            }
        }else{
            self::$session = new mysqli($host, $user, $pass, $dbname);
            if(self::$session != null && empty(self::$session->connect_error)){
                return true;
            }
        }
        return false;
    }

    public static function getSession(){
        return self::$session;
    }

    public static function isConnected(){
        $Session = self::getSession();
        return ($Session != null && empty($Session->error));
    }

    public static function sanitize($data){
        if(self::isConnected()){
            return self::getSession()->real_escape_string($data);
        }

        // Check for (testing) conditions where no
        // DB connection is established. (required for mysqli).
        return mysql_escape_string($data);
    }

    // Sanitize all values in an array for SQL injection.
    // Example:   sanitizeArrayValues($_GET);
    public static function sanitizeArrayValues(&$Arr){
        if(!empty($Arr) && self::getSession() != null){
            foreach ($Arr as $key => $val){
                $Arr[$key] = self::sanitize($val);
            }
        }
        return $Arr;
    }
}
?>