<?php
// Load the application libraries.
require_once('../Application.php');

// Check whether the user has attempted to login.
$Success = null;
$Error = null;
if (isset($_POST['register'])) {
    // Verify the user hasn't already registered.
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])) {
        // Attempt to retrieve the requested user from the database.
        $Users = User::getAll(array(
            'email' => $_POST['email']
        ));
        if(empty($Users)){
            $AuthenticatedUser = null;
            $passLength = strlen($_POST['password']);
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if($_POST['password'] == $_POST['passwordRepeat'] &&  $passLength >= 8){
                    $firstName = $_POST['firstname'];
                    $lastName = $_POST['lastname'];
                    $password = AuthSession::password_hash($_POST['password']);
                    $email = $_POST['email'];
                    $uuid = UUID::randomUUID();
                    if (DBSession::getSession()->query("INSERT INTO `user` (`uuid`, `password`, `email`, `firstName`, `lastName`) VALUES ('$uuid', $password','$email', '$firstName', '$lastName')")){
                        $Success = "Account Successfully Created";
                        header("Location: /home.php");
                        die();
                    }
                }else $Error = "Passwords do not match or are too short";
            }else $Error = "Invalid E-Mail address detected";
        }else $Error = "This user already exists";
    } else $Error = "Please fill in all required fields.";
}?><!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>CoreUI Bootstrap 4 Admin Template</title>

    <!-- Icons -->
    <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
<div class="container">
    <?php
    // Display the error to the user, if any exist.
    if(!empty($Error ) && empty($Success)){
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger collange-full-width" id="loginPageError" role="alert">
                    <b><?php echo $Error;?></b>
                </div>
            </div>
        </div>
        <?php
    }else if(!empty($Success)){
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success collange-full-width" id="loginPageSuccess" role="alert">
                    <b><?php echo $Success;?></b>
                    <Button style="float:right;" class="btn-primary" onclick="location.href='/';">Return to login</Button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form method="POST">
                        <h1>Register</h1>
                        <p class="text-muted">Create your account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                            </div>
                            <input type="password" name="passwordRepeat" class="form-control" placeholder="Repeat password">
                        </div>

                        <button type="submit" name="register" class="btn btn-block btn-success" value="Register">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>