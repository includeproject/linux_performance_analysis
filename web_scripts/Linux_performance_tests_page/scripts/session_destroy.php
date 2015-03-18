<?php

session_start();

$_SESSION = array();
unset($_SESSION['username']);
unset($_SESSION['pass']);
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
header("location:../pages/login.php");
