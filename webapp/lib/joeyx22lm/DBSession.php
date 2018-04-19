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
    public static function setSession($host='', $user='', $pass='', $dbname='', $sanitizeInboundRequest=true){
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
                if(self::$session != null && empty(self::$session->connect_error)) {
                    if($sanitizeInboundRequest){
                        // Sanitize any incoming data at load.
                        if (isset($_GET) && !empty($_GET)) {
                            DBSession::sanitizeArrayValues($_GET);
                        }
                        if (isset($_POST) && !empty($_POST)) {
                            DBSession::sanitizeArrayValues($_POST);
                        }
                    }
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

    public $id = null;

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
    public static function get($x, $y=null){
        if($x != null && $y != null){
            // DB Session and ID given.
            $Q = $x->query("SELECT * FROM `".static::$tableName."` WHERE `".static::$tablePKName."`='$y'");
            if($Q != null && $Q->num_rows > 0){
                return $Q->fetch_array();
            }else if(!empty(DBSession::getSession()->error)){
                Log::error(static::$tableName.'.getAll(id='.$y.'): ' . DBSession::getSession()->error);
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
            }else if(!empty(DBSession::getSession()->error)){
                Log::error(static::$tableName.'.getAll('.json_encode($arr).'): ' . DBSession::getSession()->error);
            }
            return array();
        }

        else if($x != null){
            return self::getAll(DBSession::getSession(), $x);
        }
    }

    /**
     * @return bool|mysqli_result
     */
    private function create(){
        $fields = '';
        $vals = '';
        foreach(get_object_vars($this) as $field=>$val){
            if($field == 'id'){
                continue;
            }
            $fields.=(empty($fields) ? '' : ', ') . '`'.$field.'`';
            $vals.=(empty($vals) ? '' : ', ') . '\''.DBSession::sanitize($val).'\'';
        }
        $queryStr = "INSERT INTO `".static::$tableName.'` ('.$fields.') VALUES ('.$vals.")";
        $ret = DBSession::getSession()->query($queryStr);
        if($ret){
            // store primary key, if successful insert.
            $this->id = DBSession::getSession()->insert_id;
        }else{
            Log::error($queryStr . ': ' . DBSession::getSession()->error);
        }
        return $ret;
    }

    /**
     * @return bool|mysqli_result
     */
    public function save()
    {
        if ($this->id == null) {
            return $this->create();
        }
        $Query = 'UPDATE `' . static::$tableName . '` SET ';
        $fields = '';
        foreach (get_object_vars($this) as $field) {
            if($field == 'id'){
                continue;
            }
            $fields .= (empty($fields) ? '' : ', ') . '`' . $field . '`=\'' . DBSession::sanitize($this->{$field}) . '\'';
        }
        $Query .= $fields . ' WHERE `id`=\'' . $this->id . '\'';
        $ret = DBSession::getSession()->query($Query);
        if(!$ret){
            Log::error($Query . ': ' . DBSession::getSession()->error);
        }
        return $ret;
    }
}
?>