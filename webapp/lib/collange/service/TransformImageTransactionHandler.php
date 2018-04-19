<?php
class TransformImageRequestHandler extends RedisHandler {
    public static function enqueue($imagekey, $txId, $revisionId, $filter){
        $EventUUID = UUID::randomUUID();
        if(self::getSession()->rpush(StaticResource::get('TransformWaitingQueue'), array(
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
    public static function get($EventUUID){
        return self::getSession()->hget(StaticResource::get('TransformResponseMap'), $EventUUID);
    }
}
?>