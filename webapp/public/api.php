<?php require_once('../Application.php');?>
<?php AuthSession::protect();
if(isset($_GET['signedKey'])){
    if(empty($_GET['mime']) || empty($_GET['ext'])){
        // Incorrect input.
        http_response_code(400);
        die();
    }
    die(S3Handler::createSignedPOSTUrl(UUID::randomUUID() . " $_GET[ext]", $_GET['mime']));
}
?>