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
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;

    public function getId(){
        return $this->id;
    }
    public function getName($reverse=false){
        return UserUtil::formatName($this->firstName, $this->lastName, $reverse);
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    /**
     * Return a user with the given id.
     * @param $x
     * @return mixed
     */
    public static function get($x, $y=null){
        return parent::get($x, $y);
    }

    /**
     * Return an array of users where all of the
     * given fields match the db values.
     *       array(
     *             'firstName'=>'John',
     *             'lastName'=>'Doe'
     *       )
     * @param $x
     * @param null $y
     * @return mixed
     */
    public static function getAll($x, $y=null){
        return parent::getAll($x, $y);
    }
}
?>