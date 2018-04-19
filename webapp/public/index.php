<?php
// Load the application libraries.
require_once('../Application.php');

// Initialize new or existing session.
AuthSession::start();

if(isset($_GET['logout'])){
    AuthSession::logout();
}

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
        <?php App::buildHtmlHead('Login');?>
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
							<div class="card-body text-center">
								<div>
									<h3>Don't have an account?</h3>
									<input type="button" class="btn btn-primary px-4" onclick="location.href='register.php';" value="Register Here!">
								</div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php App::buildHtmlJS();?>

    </body>
</html>