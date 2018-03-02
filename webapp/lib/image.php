<?php
class Image extends DBObject {
    protected static $tableName='image';    // DB Table is `user`
    protected static $tablePKName='id';     // DB Primary Key field is `id`
    protected static $tablePKType='i';      // DB Primary Key is an integer.

    protected $id;
    protected $ownerId;
    protected $key;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }

    public static function get($x, $y=null){
        return parent::get($x, $y);
    }

    public static function getAll($x, $y=null){
        return parent::getAll($x, $y);
    }
}

$i = Image::getAll(array(
    'ownerId'=>'10'
));
die(json_encode($i));
?>