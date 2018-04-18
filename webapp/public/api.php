<?php
require_once('../Application.php');
AuthSession::protect();


/**
 * Amazon S3 Upload Signed URL Service
 */
if(isset($_GET['signedKey'])){
    if(empty($_GET['mime']) || empty($_GET['ext'])){
        // Incorrect input.
        http_response_code(400);
        die();
    }

    // Import S3 Handler and Amazon S3 SDK.
    PHPLoader::loadModule('Collange:S3Handler');
    die(S3Handler::createSignedPOSTUrl(UUID::randomUUID() . " $_GET[ext]", $_GET['mime']));
}



/**
 * Handle User File Uploads
 */
if(isset($_GET['upload'])){
    if(!empty($_FILES['file'])){
        // Import S3 Handler and Amazon S3 SDK.
        PHPLoader::loadModule('collange:S3Handler');

        // Check if upload is over 10MB?
        if($_FILES['file']['size'] > 10485760){
            http_response_code(400);
            die(StaticResource::get('error_api_upload_maxsize'));
        }

        $filename = basename($_FILES['file']['name']);
        $type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        if(!in_array($type, StaticResource::get('upload_allowed_types'))) {
            http_response_code(400);
            die(StaticResource::get('error_api_upload_filetype'));
        }

        $imageUUID = UUID::randomUUID();
        $key = $imageUUID . '.' . $type;
        $imageRcd = new Image($imageUUID, AuthSession::getUser()->id, $filename, '', $_FILES['file']['size'], 0, $key);
        $saveResult = $imageRcd->save();
        if($saveResult){
            // Upload the user's image.
            if(!S3Handler::upload($key, $_FILES['file']['tmp_name'])){
                http_response_code(400);
                die(StaticResource::get('error_api_upload_unknown'));
            }

            // Upload successful, delete the local file now.
            unlink($_FILES['file']['tmp_name']);

            // Cache a signed url for users to view the image, we're going to need it soon.
            $URL = S3Handler::createSignedGETUrl($key, '+1 hour');
            if(!empty($URL)){
               if(!S3EphemeralURLHandler::set($key, $URL)){
                   Log::error('S3EphemeralURL('.$key.'): Error');
               }else{
                   Log::info('S3EphemeralURL('.$key.'): ' . $URL);
               }
            }
            die();
        }
    }

    http_response_code(400);
    die(StaticResource::get('error_api_upload_unknown'));
}
?>