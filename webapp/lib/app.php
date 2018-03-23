<?php
class StaticResource {
    private static $StaticResource = null;
    public static function set($arr, $val=null){
        if($val == null){
            self::$StaticResource = $arr;
        }

        else {
            if(self::$StaticResource == null) self::$StaticResource = array();
            self::$StaticResource[$arr] = $val;
        }
    }
    public static function get($key){
        return(self::$StaticResource == null ? null : self::$StaticResource[$key]);
    }
}
StaticResource::set(array(
    'APP_TITLE'=>'Collange',
    'ENV_AWS_S3_BUCKET'=>$_ENV['AWS_S3_BUCKET'],
    'ENV_AWS_KEY'=>$_ENV['AWS_KEY'],
    'ENV_AWS_SECRET'=>$_ENV['AWS_SECRET']
));


class App {
    public static function buildPageNavbar(){
        require(__DIR__.'/ui/component/navbar.php');
    }
    public static function buildPageSidebar(){
        require(__DIR__.'/ui/component/sidebar.php');
    }
    public static function buildPageFooter(){
        require(__DIR__.'/ui/component/footer.php');
    }
    public static function buildHtmlHead($injectPageTitle=null){
        require(__DIR__.'/ui/head.php');
    }
    public static function buildHtmlJS(){
        require(__DIR__.'/ui/js.php');
    }
}

class AuthSession {
    private static $connected = false;
    public static function protect(){
        self::start();
        if(!self::isLoggedIn()){
            // Redirect to login page.
            header("Location: /");
            die();
        }
    }

    public static function password_hash($password){
        return password_hash($password, PASSWORD_DEFAULT, ["cost"=>12]);
    }
    public static function password_verify($password, $hash){
        return password_verify($password, $hash);
    }
    public static function isLoggedIn(){
        if(!self::$connected || !isset($_SESSION) || empty($_SESSION) || !isset($_SESSION['user']) || empty($_SESSION['user'])){
            return false;
        }
        return true;
    }
    public static function start(){
        session_start();
        session_regenerate_id();
        self::$connected = true;
    }
    public static function set($key, $val){
        if(self::$connected){
            $_SESSION[$key] = $val;
        }
    }
    public static function get($key){
        if(self::$connected){
            return $_SESSION[$key];
        }
        return null;
    }
    public static function getUser(){
        return self::get('user');
    }
}

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

require_once('../../vendor/autoload.php');
class S3Handler {
    public static $session = null;

    public static function getClient(){
        if(self::$session == null){
            self::$session = new Aws\S3\S3Client([
                'version'     => 'latest',
                'region'      => 'us-east-1',
                'credentials' => [
                    'key'    => StaticResource::get('ENV_AWS_KEY'),
                    'secret' => StaticResource::get('ENV_AWS_SECRET'),
                ],
            ]);
        }
        return self::$session;
    }

    public static function createSignedGETUrl($key, $expire='+1 hour'){
        $cmd = self::getClient()->getCommand('GetObject', [
            'Bucket' => StaticResource::get('ENV_AWS_S3_BUCKET'),
            'Key'    => $key
        ]);
        $request = self::getClient()->createPresignedRequest($cmd, $expire);
        return $request->getUri();
    }

    public static function createSignedPOSTUrl($key, $mime, $expire='+30 minutes'){
        $client = self::getClient();
        $formInputs = ['acl' => 'private'];
        $options = [
            $formInputs,
            ['bucket' => StaticResource::get('ENV_AWS_S3_BUCKET')],
            ['starts-with', $key, '']
        ];
        $postObject = new Aws\S3\PostObjectV4(
            $client,
            StaticResource::get('ENV_AWS_S3_BUCKET'),
            $formInputs,
            $options,
            $expire
        );
        return json_encode(array($postObject->getFormAttributes(), $postObject->getFormInputs()));
    }
}
?>