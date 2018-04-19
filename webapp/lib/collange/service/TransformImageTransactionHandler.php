<?php
class TransformImageRequestHandler extends RedisHandler {
    private static $queueKeyName = 'TransformWaitingQueue';

    public static function enqueue($imagekey, $txId, $revisionId, $filter){
        $EventUUID = UUID::randomUUID();
        if(self::getSession()->rpush(self::$queueKeyName, array(
            'key'=>$imagekey,
            'txId'=>$txId,
            'revisionId'=>$revisionId,
            'filter'=>$filter,
            'eventId'=>$EventUUID
        ))){
            return $EventUUID;
        }
        return null;
    }
}
class TransformImageResponseHandler extends RedisHandler {
    private static $cacheKeyName = 'TransformCompleteMap';

    public static function get($EventUUID){
        return self::getSession()->hget(self::$cacheKeyName, $EventUUID);
    }
}
?>