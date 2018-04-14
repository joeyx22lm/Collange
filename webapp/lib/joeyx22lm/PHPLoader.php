<?php
/**
 * Class PHPLoader
 */
class PHPLoader {
    public static $modules = array();
    public static function initModule($name, $resource=null){
        // Check if overriding all modules.
        if(is_array($name) && $resource == null){
            self::$modules = $name;
        }else{
            self::$modules[$name] = $resource;
        }
    }
    public static function loadModule($name){
        // load an array of resources.
        if(is_array($name)){
            foreach($name as $i=>$module){
                require_once(self::$modules[$module]);
            }
        }
        // load a single resource.
        else if(isset(self::$modules[$name])){
            require_once(self::$modules[$name]);
        }
    }
}
?>