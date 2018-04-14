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
    var_dump($_FILES);
    die();
    //die(json_encode($_FILES));
   /* $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
       // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }*/
}
?>