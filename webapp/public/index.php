<?php require_once('../Application.php');?>
<?php AuthSession::start(); ?>
<?php
if(isset($_POST['login'])){
    $Users = User::getAll(array(
        'email'=>$_POST['email']
    ));
    if($Users != null && sizeof($Users) == 1){
        // Check password.
        if(AuthSession::password_verify($_POST['password'], $Users[0]['password'])){
            $_SESSION['user'] = $Users[0];
            header("Location: /home.php");
            die();
        }

        else if($Users[0]['password'] == $_POST['password']){
            $hash = AuthSession::password_hash($Users[0]['password']);
            $id = $User[0]['id'];
            die("UPDATE `user` SET `password`='$hash' WHERE `id`='$id'");
            /*if(DBSession::getSession()->query()){
                $_SESSION['user'] = $Users[0];
                header("Location: /home.php");
                die();
            }*/
        }
    }
    die('We didn\'t find your user :(');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title><?php echo App::getStaticResource('APP_TITLE');?> - Login</title>

  <!-- Icons -->
  <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
  <div class="container">
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