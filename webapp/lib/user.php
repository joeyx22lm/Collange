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
    private $fname;
    private $lname;
    private $email;
    private $password;

    public function getName($reverse=false){
        return UserUtil::formatName($this->fname, $this->lname, $reverse);
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    /**
     * Build User object from JSON string or
     * standard array.
     * @param $data (string or array)
     * @return User
     */
    public static function build($data){
        return parent::build('User', $data);
    }
}
?>