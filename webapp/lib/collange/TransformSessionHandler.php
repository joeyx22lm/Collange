<?php
class TransformSessionHandler {
    public static function getSessions(){
        // test data
        return array(
            array(
                'sessionId'=>'dskjhf38ysdjkfh45',
                'imageName'=>'IMG400012.JPG',
                'imageSize'=>'2.4Mb',
                'events'=>array(
                    array(
                        'title'=>'Resized Image',
                        'history'=>'just now'
                    ),
                    array(
                        'title'=>'Applied Filter',
                        'history'=>'6 mins ago'
                    ),
                    array(
                        'title'=>'Applied Filter',
                        'history'=>'15 mins ago'
                    ),
                    array(
                        'title'=>'Opened Image',
                        'history'=>'42 mins ago'
                    )
                )
            ),
            array(
                'sessionId'=>'8965shjfg327r78saf',
                'imageName'=>'IMG400015.JPG',
                'imageSize'=>'734Kb',
                'events'=>array(
                    array(
                        'title'=>'Opened Image',
                        'history'=>'3 mins ago'
                    )
                )
            )
        );
    }

    public static function getSession($txId){
        foreach(self::getSessions() as $i=>$Session){
            if($Session['sessionId'] == $txId){
                return $Session;
            }
        }
        return null;
    }

    public static function isTransforming(){
        return !empty(self::getSessions());
    }
}
?>