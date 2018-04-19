<?php
require_once('../Application.php');
AuthSession::protect();

/**
 * Handle User File Uploads
 */
if(isset($_GET['upload'])){
    // Retain the key attempted, in case we need to abort.
    $key = null;
    if(!empty($_FILES['file'])){
        // Import S3 Handler and Amazon S3 SDK.
        PHPLoader::loadModule('collange:S3Handler');

        // Check if upload is over ~50MB?
        if($_FILES['file']['size'] > 50485760){
            http_response_code(400);
            die(StaticResource::get('error_api_upload_maxsize'));
        }

        $filename = basename($_FILES['file']['name']);
        $type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        if(!in_array($type, StaticResource::get('upload_allowed_types'))) {
            http_response_code(400);
            die(StaticResource::get('error_api_upload_filetype'));
        }

        // Extract image type and randomize name.
        $imageUUID = UUID::randomUUID();
        $key = $imageUUID . '.' . $type;

        // Make sure the image is a JPG.
        $location = ImageHandler::convertImageToJPG($_FILES['file']['tmp_name'], $type);
        $type = 'jpg';
        $key = $imageUUID . '.' . $type;

        // Strip any EXIF/PID info from the image.
        $location = ImageHandler::stripEXIFFromJPEG($location);

        // Make sure the image made it thru all of that conversion.
        if($location != null){
            $imageRcd = new Image($imageUUID, AuthSession::getUser()->id, $filename, '', $_FILES['file']['size'], 0, $type);
            $saveResult = $imageRcd->save();
            if($saveResult){
                // Upload the user's image.
                if(!S3Handler::upload($key, $location)){
                    http_response_code(400);
                    die(StaticResource::get('error_api_upload_unknown'));
                }

                // Upload successful, delete the local file now.
                unlink($location);

                // Cache a signed url for users to view the image, we're going to need it soon.
                $URL = S3Handler::createSignedGETUrl($key, '+1 hour');
                if(!empty($URL)){
                    PHPLoader::loadModule('collange:S3EphemeralURLHandler');
                    if(S3EphemeralURLHandler::set($key, $URL)){
                        Log::info('S3EphemeralURL('.$key.'): ' . $URL);
                        die();
                    }
                }
            }
        }
    }

    // Something bad happened.. Atleast try to delete their file..
    if(!S3Handler::delete($key)){
        Log::error('API.delete('.$key.'): Error');
    }

    http_response_code(400);
    die(StaticResource::get('error_api_upload_unknown'));
}


/**
 * Initialize an editing session.
 */
if(isset($_GET['edit'])){
    if(!empty($_GET['edit'])){
        /**
         * Transformation Session
         * TEST DATA
         */
        TransformSessionHandler::createSession('IMG400012.JPG', '2.4Mb', UUID::randomUUID(), UUID::randomUUID(), '42 mins ago');
        TransformSessionHandler::createSession('IMG400014.JPG', '2.3Mb', UUID::randomUUID(), UUID::randomUUID(), '10 mins ago');
        $Image = null;
        foreach(Image::getAll(DBSession::getSession(), array(
            'ownerId'=>AuthSession::getUser()->getId(),
            'uuid'=>$_GET['edit'])
        ) as $i=>$img){
            $Image = $img;
        }
        if($Image != null){
            if(TransformSessionHandler::createSession($Image['fileName'], $Image['size'], $Image['uuid'])){
                header("Location: /transform.php?uuid=".$Image['uuid']);
                die();
            }else Log::error('Unable to create TransformSession(Image(uuid='.$_GET['edit'].'))');
        }else Log::error('Unable to retrieve Image(uuid='.$_GET['edit'].')');
    }

    // If we got here, an error occurred. Redirect back to library.
    header("Location: /library.php?error");
    die();
}
?>