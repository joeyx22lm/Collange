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
    <?php App::buildHtmlHead('Register');?>
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
                            <input type="text" class="form-control" placeholder="First Name" name="firstname">
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                        </div>

                        <div class="input-group mb-3">
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

<?php App::buildHtmlJS();?>

</body>
</html>