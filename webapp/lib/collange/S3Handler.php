<?php
require_once('../../vendor/autoload.php');
use Aws\S3\Exception\S3Exception;
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
            ['bucket' => StaticResource::get('ENV_AWS_S3_BUCKET')]
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

    public static function upload($key, $localpath){
        // Include the SDK using the Composer autoloader
        try {
            return self::getClient()->putObject(array(
                'Bucket'=>StaticResource::get('ENV_AWS_S3_BUCKET'),
                'Key' =>  $key,
                'SourceFile' => $localpath
            ));
        } catch (S3Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public static function delete($key){
        return self::getClient()->deleteObject(array(
            'Bucket'=>StaticResource::get('ENV_AWS_S3_BUCKET'),
            'Key' =>  $key,
        ));
    }
}
?>