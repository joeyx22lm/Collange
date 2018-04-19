<?php
class TransformSessionHandler {

    /**
     * Retrieve the transform session data
     * from the AuthSession handler.
     */
    public static function getSessions(){
        return AuthSession::get('transformSessionData');
    }

    /**
     * Set the transform session data
     * via the AuthSession handler.
     */
    public static function setSessions($val){
        return AuthSession::set('transformSessionData', $val);
    }

    /**
     * Create a new session, given image info.
     */
    public static function createSession($imageName, $imageSize, $imageUuid, $sessionId=null, $openedTime=null){
        $Sessions = self::getSessions();
        if($Sessions == null){
            $Sessions = array();
        }
        if($sessionId == null){
            $sessionId = UUID::randomUUID();
        }
        if($openedTime == null){
            $openedTime = time();
        }
        $Sessions[] = array(
            'sessionId'=>$sessionId,
            'imageName'=>$imageName,
            'imageSize'=>$imageSize,
            'imageUuid'=>$imageUuid,
            'events'=>array(
                array(
                    'title'=>"Opened Image",
                    'history'=>$openedTime,
                    'revisionId'=>UUID::randomUUID()
                )
            )
        );
        self::setSessions($Sessions);
        return $sessionId;
    }

    /**
     * Get the transform session, given the sessionId.
     * @param $txId
     * @return mixed|null
     */
    public static function getSession($txId){
        foreach(self::getSessions() as $i=>$Session){
            if($Session['sessionId'] == $txId){
                return $Session;
            }
        }
        return null;
    }

    /**
     * Check whether this user is currently transforming
     * any images.
     * @return bool
     */
    public static function isTransforming(){
        return !empty(self::getSessions());
    }

    public static function getFilters(){
        return StaticResource::get('filters');
    }
}
?>