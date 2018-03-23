<?php require_once('../Application.php');?>
<?php AuthSession::protect();



if(isset($_GET['signedKey'])){
    die(S3Handler::createSignedPOSTUrl("testdocument.jpg", $_GET['mime']));
}
?>