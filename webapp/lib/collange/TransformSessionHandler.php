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

    public static function setSession($val){
        $Sessions = self::getSessions();
        if(empty($Sessions)){
            $Sessions = array();
        }
        if(empty($val['sessionId'])){
            $Sessions[] = $val;
            return self::setSessions($Sessions);
        }else{
            foreach($Sessions as $key=>$Session) {
                if ($Session['sessionId'] == $val['sessionId']) {
                    $Sessions[$key] = $val;
                    return self::setSessions($Sessions);
                }
            }
        }
        return null;
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
            'originalImageName'=>$imageName,
            'originalImageSize'=>$imageSize,
            'originalImageUuid'=>$imageUuid,
            'events'=>array(
                array(
                    'title'=>"Opened Image",
                    'history'=>$openedTime,
                    'saved'=>true,
                    'revisionId'=>UUID::randomUUID(),
                    'EventUUID'=>null,
                    'imageName'=>$imageName,
                    'imageSize'=>$imageSize,
                    'imageUuid'=>$imageUuid,
                )
            )
        );
        self::setSessions($Sessions);
        return $sessionId;
    }

    /**
     * Create a new session, given image info.
     */
    public static function reviseSession($sessionId, $title, $saved, $EventUUID=null, $revisionId=null, $openedTime=null){
        // Attempt to retrieve the session.
        $Session = self::getSession($sessionId);
        if($Session == null){
            return null;
        }

        // Make sure we can add events.
        if($Session['events'] == null){
            $Session['events'] = array();
        }

        // Check for defaults.
        if($revisionId == null){
            $revisionId = UUID::randomUUID();
        }
        if($openedTime == null){
            $openedTime = time();
        }

        // Add the requested event.
        $Session['events'][] = array(
            'title'=>$title,
            'history'=>$openedTime,
            'saved'=>$saved,
            'revisionId'=>$revisionId,
            'EventUUID'=>$EventUUID,
            'imageName'=>$Session['originalImageName'],
            'imageSize'=>$Session['originalImageSize'],
            'imageUuid'=>null,
        );

        // Store the event.
        self::setSession($Session);
        return $revisionId;
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