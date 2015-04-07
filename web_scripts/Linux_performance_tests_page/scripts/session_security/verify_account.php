<?php

session_start();
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/session_security/validation_utils.php';
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/user.php';
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/session_security/session.php';

$validation = new ValidationUtils();
$usr = new User();
$username = $validation->clean_post_data(filter_input(INPUT_POST, 'username'));
$password = $validation->clean_post_data(filter_input(INPUT_POST, 'pass'));
$encrypted = $validation->encrypt_password($password);
$user = $usr->userExists($username, $encrypted);

if ($user != NULL) {
    $session = new Session();
    $session->create($user);
    header('location: http://' . filter_input(INPUT_SERVER, 'REMOTE_ADDR') . '/Linux_performance_tests_page' . '/pages/user_panel.php');
} else {
    $_SESSION['error'] = "Invalid username or password";
    $_SESSION['user'] = $username;
    header('location: http://' . filter_input(INPUT_SERVER, 'REMOTE_ADDR') . '/Linux_performance_tests_page' . '/pages/login.php');
}
