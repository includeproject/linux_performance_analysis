<?php

session_start();
require_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/session_security/validation_utils.php';
require_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/user.php';
require_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/session_security/session.php';

$validation = new ValidationUtils();
$usr = new User();

$pass = $validation->clean_post_data(filter_input(INPUT_POST, 'pass'));
$passconf = $validation->clean_post_data(filter_input(INPUT_POST, 'passconfirm'));
$name = $validation->clean_post_data(filter_input(INPUT_POST, 'user_first_name'));
$lastname = $validation->clean_post_data(filter_input(INPUT_POST, 'user_last_name'));
$username = $validation->clean_post_data(filter_input(INPUT_POST, 'username'));
$email = $validation->clean_post_data(filter_input(INPUT_POST, 'emailaddress'));

#>>>>>>>>>>>>>>> The next section of conditions validates each field of the form 
$isValid = TRUE;
if (strlen($pass) < 8) {
    $_SESSION['passErr'] = 'Password must have 8 or more characters';
    $isValid = FALSE;
} else if ($pass != $passconf) {
    $_SESSION['passErr'] = 'Passwords do not match';
    $isValid = FALSE;
}
if (empty($name)) {
    $_SESSION['nameErr'] = 'This field is required';
    $isValid = FALSE;
}
if (empty($lastname)) {
    $_SESSION['lastErr'] = 'This field is required';
    $isValid = FALSE;
}
if (empty($username)) {
    $_SESSION['userErr'] = 'This field is required';
    $isValid = FALSE;
} elseif ($usr->userExists($username, NULL, 'nopass') != NULL) {
    $_SESSION['userErr'] = 'This username already exists';
    $isValid = FALSE;
}
if (empty($email)) {
    $_SESSION['emailErr'] = 'This field is required';
    $isValid = FALSE;
} elseif (!$validation->isEmail($email)) {
    $_SESSION['emailErr'] = 'This is not a valid email address';
    $isValid = FALSE;
} elseif ($usr->userExists($email, NULL, 'nopass') != NULL) {
    $_SESSION['emailErr'] = 'This email already exists';
    $isValid = FALSE;
}
#>>>>>>>>>>>>>>>>>>>>>The next condition creates a new user if the data were correct, otherwise returns to the form page
if ($isValid) {
    $active = 1;
    $level = 2;
    $host_directory = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/lpa_files/' . $username . '/';
    $encrypted = ($pass == $passconf) ? $validation->encrypt_password($pass) : NULL;

    $user = new User($username, $encrypted, $name, $lastname, $email, $host_directory, $active, $level);
    mkdir($host_directory, 0777, TRUE);
    chmod($host_directory, 0777);
    $user->create($user);
    Session::create($user);
    header('location: http://' . filter_input(INPUT_SERVER, 'SERVER_ADDR') . '/Linux_performance_tests_page' . '/pages/user_panel.php');
} else {
    $_SESSION['firstname'] = $name;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['user'] = $username;
    $_SESSION['email'] = $email;
    header('location: http://' . filter_input(INPUT_SERVER, 'SERVER_ADDR') . '/Linux_performance_tests_page' . '/pages/user_register.php');
}