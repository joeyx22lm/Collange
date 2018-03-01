<?php
/**
 * Copyright 2017 Joseph Orlando.
 */
class DBSession {
    private static $session = null;

    /**
     * Establish Database Connection
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $dbname
     * @return bool
     */
    public static function setSession($host='', $user='', $pass='', $dbname=''){
        if(!empty($host)){
            // Handle a ConnectionURL.
            if(empty($user) || empty($pass) || empty($dbname)){
                // Connect URL given.
                $UrlParts = parse_url($host);
                if(!empty($UrlParts)){
                    return self::setSession($UrlParts['host'], $UrlParts['user'], $UrlParts['pass'], str_replace('/', '', $UrlParts['path']));
                }
            }

            // Handle explicit connection parameters.
            else{
                self::$session = new mysqli($host, $user, $pass, $dbname);
                if(self::$session != null && empty(self::$session->connect_error)){
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * Retrieve Database Connection.
     * @return MySQLi
     */
    public static function getSession(){
        return self::$session;
    }

    /**
     * Whether a connection was established
     * successfully.
     * @return bool
     */
    public static function isConnected(){
        $Session = self::getSession();
        return ($Session != null && empty($Session->error));
    }

    /**
     * Sanitize value for SQL injection.
     * @param $data
     * @return string
     */
    public static function sanitize($data){
        if(self::isConnected()){
            return self::getSession()->real_escape_string($data);
        }

        // Check for (testing) conditions where no
        // DB connection is established. (required for mysqli).
        return mysql_escape_string($data);
    }

    /**
     * Sanitize all parameters of an array for
     * SQL injection. Affect's the pointer's reference.
     * @param $Arr
     * @return mixed
     */
    public static function sanitizeArrayValues(&$Arr){
        if(!empty($Arr) && self::getSession() != null){
            foreach ($Arr as $key => $val){
                $Arr[$key] = self::sanitize($val);
            }
        }
        return $Arr;
    }
}
class DBObject {
    /**
     * Convert a raw or JSON-encoded array to
     * an object of the given class name.
     * @param $class
     * @param $data
     * @return null
     */
    public static function build($data, $class=null){
        if($class == null) $class = get_called_class();
        if(!empty($class) && !empty($data)){
            // Handle array as data.
            if(is_array($data)){
                $ret = new $class();
                foreach ($data as $key => $value) $ret->{$key} = $value;
                return $ret;
            }

            // Handle JSON string as data.
            else{
                return self::build(json_decode($data, true), $class);
            }
        }
        return null;
    }

    /**
     * Retrieve the record with the given primary key.
     * @param $x
     * @param $y
     * @return mixed
     */
    public static function get($x, $y){
        if($x != null && $y != null){
            // DB Session and ID given.
            $Q = $x->query("SELECT * FROM `"+static::$tableName+"` WHERE `"+static::$tablePKName+"`='$y'");
            if($Q != null && $Q->num_rows > 0){
                return $Q->fetch_array();
            }
        }

        else if($x != null){
            return self::get(DBSession::getSession(), $x);
        }
    }

    /**
     * Retrieve the records where the fields
     * match the given params.
     * @param $x
     * @param $arr
     * @return mixed
     */
    public static function getAll($x, $arr=null){
        if($x != null && $arr != null && !empty($arr) && is_array($arr)){
            $params = '';
            foreach($arr as $field=>$value){
                $params .= (empty($params) ? '' : ', ') . "`$field`='$value'";
            }
            $Q = $x->query('SELECT * FROM `'.static::$tableName.'` WHERE '.$params);
            if($Q != null && $Q->num_rows > 0){
                $ret = array();
                while($result = $Q->fetch_array()) $ret[] = $result;
                return $ret;
            }
        }

        else if($x != null){
            return self::getAll(DBSession::getSession(), $x);
        }
    }
}
?>