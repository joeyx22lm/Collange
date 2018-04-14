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
?>