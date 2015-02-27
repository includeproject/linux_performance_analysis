<?php
session_start(); 
// al volver al index si existe una session, esta sera destruida, existen formas de conservarlas como con un if(session_start()!= NULL). Pero por el momento para el ejemplo no es valido. 
session_unset();
 
session_destroy(); 
// Se destruye la session existente de esta forma no permite el duplicado.
//echo $_SERVER('DOCUMENT_ROOT').'/upload/user';
 
 ?>
<!DOCTYPE html>

<html>
  <head>
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
        <input type="text" class="input-block-level" placeholder="First Name" name="user_first_name">
        <input type="text" class="input-block-level" placeholder="Last Name" name="user_last_name">
        <input type="text" class="input-block-level" placeholder="User Name" name="username">
        <input type="text" class="input-block-level" placeholder="Email address" name="emailaddress">
        <input type="password" class="input-block-level" placeholder="Password" name="pass">
        <input type="password" class="input-block-level" placeholder="Password Confirm" name="passconfirm">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button name="register" class="btn btn-large btn-success" type="submit" value="Crear sesión">Create account</button>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
