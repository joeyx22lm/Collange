<?php
// Load the Collange application bootstrapper.
require_once('../Application.php');

// Handle login requests.
if(isset($_POST['u']) && !empty($_POST['u']) && isset($_POST['p']) && !empty($_POST['p'])){
    // Redirect to the application homepage.
    header("Location: home.php");
    die();
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Collange - Sign In</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/login.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h1>Collange</h1>
            <form method="post">
                <input type="text" name="u" placeholder="E-Mail Address" required="required" />
                <input type="password" name="p" placeholder="Password" required="required" />
                <button type="submit" class="btn btn-primary btn-block btn-large">Sign In</button>
            </form>
        </div>
        <script  src="js/login.js"></script>
    </body>
</html>
