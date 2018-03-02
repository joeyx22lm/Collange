<?php
class UserUtil {
    public static function formatName($fname, $lname, $ReverseFormat){
        if(!empty($fname) && !empty($lname)){
            return ($ReverseFormat ? $lname.', '.$fname : $fname.' '.$lname);
        }else if(!empty($fname)){
            return $fname;
        }else if(!empty($lname)){
            return $lname;
        }
        return null;
    }
}
class User extends DBObject {
    protected static $tableName='user';     // DB Table is `user`
    protected static $tablePKName='id';     // DB Primary Key field is `id`
    protected static $tablePKType='i';      // DB Primary Key is an integer.

    protected $id;
    protected $fname;
    protected $lname;
    protected $email;
    protected $password;

    public function getName($reverse=false){
        return UserUtil::formatName($this->fname, $this->lname, $reverse);
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public static function get($x, $y=null){
        return parent::get($x, $y);
    }

    public static function getAll($x, $y=null){
        return parent::getAll($x, $y);
    }
}
?>