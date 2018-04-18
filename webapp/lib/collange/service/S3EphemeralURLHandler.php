<?php

/**
 * Class S3EphemeralURLHandler
 * Provides a caching interface upon the existing RedisHandler
 * session. This caching interface is really just a map to
 * store all of our S3 signed url's for an image. These
 * should expire be made to expire at some point..
 */
class S3EphemeralURLHandler extends RedisHandler {
    private static $cacheKeyName = 'S3EphemeralURLMap';

    public static function set($key, $val, $expire=null){
        if($expire == null){
            $expire = (time()+3600);    // +1 hour
        }
        return self::getSession()->hset(self::$cacheKeyName, $key, json_encode(array('uri'=>$val, 'expires'=>$expire)));
    }

    public static function get($key){
        $val = self::getSession()->hget(self::$cacheKeyName, $key);
        if(!empty($val)){
            $val = json_decode($val, true);
            if($val['expires'] < time()){
                return $val['val'];
            }
        }
        return null;
    }
}
?>