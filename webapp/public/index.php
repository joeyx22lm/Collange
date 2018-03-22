<?php
// Load the application libraries.
require_once('../Application.php');

// Initialize new or existing session.
AuthSession::start();


// Check if the user is already logged in.
if(AuthSession::isLoggedIn()){
    header("Location: /home.php");
    die();
}

// Check whether the user has attempted to login.
$Error = null;
if (isset($_POST['login'])) {

    // Attempt to retrieve the requested user from the database.
    $Users = User::getAll(array(
        'email' => $_POST['email']
    ));

    // Verify that some user was found.
    if ($Users != null && sizeof($Users) == 1) {
        $AuthenticatedUser = null;

        // Check whether the user provided a valid password.
        if (AuthSession::password_verify($_POST['password'], $Users[0]['password'])) {
            $AuthenticatedUser = User::build($Users[0]);
        }

        // Special case for development use - allow injecting plaintext into DB.
        // If you set a user's password hash to a plaintext, upon first login
        // using the plaintext password, the hash will be calculated and the user
        // will be allowed to log in. Lets developers override passwords directly in DB.
        else if ($Users[0]['password'] == $_POST['password']) {
            $hash = AuthSession::password_hash($Users[0]['password']);
            $id   = $Users[0]['id'];
            if (DBSession::getSession()->query("UPDATE `user` SET `password`='$hash' WHERE `id`='$id'")) {
                $AuthenticatedUser = User::build($Users[0]);
            }
        }

        // If the authentication logic was successful, mark this
        // user's session as "authenticated" by populating the
        // session object with a user record. Additionally,
        // redirect the user's browser to the dashboard.
        if($AuthenticatedUser != null) {
            $_SESSION['user'] = $AuthenticatedUser;
            header("Location: /home.php");
            die();
        }
    }

    // If we got here with no other errors, it must have been either
    // a bad password or unknown user.
    $Error = "Invalid Username or Password";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?php echo StaticResource::getStaticResource('APP_TITLE');?>">
        <meta name="author" content="Spring 2018 - Team 20">
        <meta name="keyword" content="Collange, UCF, COP4331">
        <title><?php echo StaticResource::getStaticResource('APP_TITLE');?> - Login</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- Page styles -->
        <link href="css/pages/login.css" rel="stylesheet">
    </head>
    <body class="app flex-row align-items-center">
    <div class="container">
        <?php
        // Display the error to the user, if any exist.
        if(!empty($Error)){
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger collange-full-width" id="loginPageError" role="alert">
                    <b><?php echo $Error;?></b>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <form method="POST" class="card-body">
                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input type="text" name="email" class="form-control" placeholder="E-Mail Address">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="login" class="btn btn-primary px-4" value="Login"/>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button type="button" class="btn btn-primary active mt-3">Register Now!</button>
                            </div>
                        </div>
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