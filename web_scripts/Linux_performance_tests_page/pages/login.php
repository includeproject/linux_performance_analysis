<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) {
    header("location: user_panel.php");
    die;
} else {
    $error = $_SESSION['error'];
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Admin Login</title>
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">

        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body id="login">
        <div class="container">
            <form class="form-signin" action="../scripts/session_security/verify_account.php" method="POST">
                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="control-group <?php echo ($error != '') ? 'error' : ''; ?>">
                    <label class="control-label"><?php echo ($error != '') ? $error : ''; ?></label>
                    <div class="controls">
                        <input type="text" class="input-block-level" placeholder="User name or Email" name="username" value="<?php echo $user ?>"/>
                        <input type="password" class="input-block-level" placeholder="Password" name="pass">
                    </div>
                </div>
                <div style="color:#FF0000">
                    <?php echo $alert; ?>
                </div>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me" name="rememberme"> Remember me
                </label>
                <button class="btn btn-large btn-primary" name="login_user" type="submit" value="sign">Sign in</button>
                <button class="btn btn-default btn-link pull-right" name="register" type="button" value="registin" onclick="location.href = 'user_register.php'">Register Account!</button>      
            </form>
        </div>
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['user']);
