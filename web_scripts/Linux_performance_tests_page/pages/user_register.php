<?php
session_start();
$alert = $_SESSION['alert'];
if (isset($_SESSION['username']) || isset($_SESSION['id_user'])){
  header("location: user_panel.php");
}
 ?>
<!DOCTYPE html>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Register Account</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
      <form class="form-signin" action="../scripts/verify_account.php" method="POST">
        <h2 class="form-signin-heading">Create Account</h2>
        <input type="text" class="input-block-level" placeholder="First Name *" name="user_first_name" value="">
        <input type="text" class="input-block-level" placeholder="Last Name *" name="user_last_name" value="">
        <input type="text" class="input-block-level" placeholder="User Name *" name="username" value="">
        <input type="text" class="input-block-level" placeholder="Email address *" name="emailaddress" value="">
        <input type="password" class="input-block-level" placeholder="Password *" name="pass" value="">
        <input type="password" class="input-block-level" placeholder="Password Confirm" name="passconfirm" value="">
        <div style="color:#FF0000">
           <?php echo $alert ?>
        </div>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-success" name="register" type="submit" value="rgst">Create account</button>
        
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
