<?php
class Image extends DBObject {
    protected static $tableName='image';    // DB Table is `user`
    protected static $tablePKName='id';     // DB Primary Key field is `id`
    protected static $tablePKType='i';      // DB Primary Key is an integer.

    protected $id;
    protected $ownerId;
    protected $fileName;
    protected $caption;
    protected $size;
    protected $shared;
    protected $createdDate;
    protected $key;
    protected $uuid;

    public function __construct($uuid, $ownerId, $fileName, $caption, $size, $shared, $key, $createdDate=null)
    {
        if($createdDate == null){
            $createdDate = time();
        }
        $this->ownerId = $ownerId;
        $this->uuid = $uuid;
        $this->fileName = $fileName;
        $this->caption = $caption;
        $this->size = $size;
        $this->shared = $shared;
        $this->createdDate = $createdDate;
        $this->key = $key;
    }

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
?>