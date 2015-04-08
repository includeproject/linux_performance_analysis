<?php
session_start();
//$alert = $_SESSION['alert'];
//if($alert == "Incorrect account or password"){
//  $alert = "";
//}
if ($_SESSION['active'] == 1 && isset($_SESSION['userid'])) {
    header('location: http://' . filter_input(INPUT_SERVER, 'SERVER_ADDR') . '/Linux_performance_tests_page' . '/pages/user_panel.php');
}
$firstname = $_SESSION['firstname'];
$nameErr = $_SESSION['nameErr'];
$lastname = $_SESSION['lastname'];
$lastErr = $_SESSION['lastErr'];
$user = $_SESSION['user'];
$userErr = $_SESSION['userErr'];
$email = $_SESSION['email'];
$emailErr = $_SESSION['emailErr'];
$passErr = $_SESSION['passErr'];
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Register Account</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body id="login">
        <div class="container">
            <form class="form-signin" action="./../scripts/session_security/new_account.php" method="POST">
                <h2 class="form-signin-heading">Create Account</h2>
                <div class="control-group <?php echo ($nameErr != '') ? 'error' : ((!empty($firstname)) ? 'success' : ''); ?>">
                    <label class="control-label"><?php echo ($nameErr != '') ? $nameErr : ''; ?></label>
                    <div class="controls">
                        <input type="text" class="input-block-level" 
                               placeholder="First name *" 
                               name="user_first_name" value="<?php echo $firstname ?>">
                    </div>
                </div>
                <div class="control-group <?php echo ($lastErr != '') ? 'error' : ((!empty($lastname)) ? 'success' : ''); ?>">
                    <label class="control-label"><?php echo ($lastErr != '') ? $lastErr : ''; ?></label>
                    <div class="controls">
                        <input type="text" class="input-block-level" placeholder="Last name *" 
                               name="user_last_name" value="<?php echo $lastname ?>">
                    </div>
                </div>
                <div class="control-group <?php echo ($userErr != '') ? 'error' : ((!empty($user)) ? 'success' : ''); ?>">
                    <label class="control-label"><?php echo ($userErr != '') ? $userErr : ''; ?></label>
                    <div class="controls">
                        <input type="text" class="input-block-level " placeholder="Username *" 
                               name="username" value="<?php echo $user ?>">
                    </div>
                </div>
                <div class="control-group <?php echo ($emailErr != '') ? 'error' : ((!empty($email)) ? 'success' : ''); ?>">
                    <label class="control-label"><?php echo ($emailErr != '') ? $emailErr : ''; ?></label>
                    <div class="controls">
                        <input type="text" class="input-block-level" placeholder="E-mail *" 
                               name="emailaddress" value="<?php echo $email ?>">
                    </div>
                </div>
                <div class="control-group <?php echo ($passErr != '') ? 'error' : ''; ?>">
                    <label class="control-label"><?php echo ($passErr != '') ? $passErr : ''; ?></label>
                    <div class="controls">
                        <input type="password" class="input-block-level" placeholder="Password *" 
                               name="pass" value="">
                        <input type="password" class="input-block-level" placeholder="Confirm password *" 
                               name="passconfirm" value="">
                    </div>
                </div>

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
<?php
unset($_SESSION['nameErr']);
unset($_SESSION['passErr']);
unset($_SESSION['lastErr']);
unset($_SESSION['userErr']);
unset($_SESSION['emailErr']);
?>