<?php
/**
 * Class PHPLoader
 */
class PHPLoader {
    private static $modules;
    private static function exec($resource, $once=true){
        if($once) return require_once($resource);
        else return require($resource);
    }
    public static function initModule($name, $resource=null){
        // Check if overriding all modules.
        if(is_array($name) && $resource == null){
            self::$modules = $name;
        }else{
            if(self::$modules == null){
                self::$modules = array();
            }
            self::$modules[$name] = $resource;
        }
    }
    public static function loadModule($name){
        // load an array of resources.
        if(is_array($name)){
            foreach($name as $module){
                if(isset(self::$modules[$module])) {
                    self::exec(self::$modules[$module]);
                }
            }
        }
        // load a single resource.
        else if(isset(self::$modules[$name])){
            self::exec(self::$modules[$name]);
        }
    }
    public static function printModules($die=true){
        if(self::$modules != null) {
            foreach(self::$modules as $name=>$resource){
                echo($name . ":\t\t" . $resource);
            }
            if($die) die();
        }
    }
}
?>