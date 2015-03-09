<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();

include_once "conexion.php";

  $_SESSION['alert'] ="";
  if (!mysql_select_db(DB_NAME)) {
      echo mysql_error(); 
  }
  else {     
    if (isset($_POST['username'])){
        // Escape single quotes.->  addslashes
        $user = addslashes($_POST['username']);
        $pass = addslashes(md5($_POST['pass']));
       
        if(empty($user) && empty($pass)){
          header("location: ../pages/login.php");
        }else{
          if(verify_account($user,$pass,$result) != 0){//Account exist
            $_SESSION['id_user'] = $result;
            $_SESSION['username'] = $user; 
            header("location: ../pages/user_panel.php");
          }
          else{//Account doesn't exist
            header("location: ../pages/user_register.php");
          }
        }
    }
    if (isset($_POST['register'])) {
      // Escape single quotes.->  addslashes
      $firstname = addslashes($_POST['user_first_name']);
      $lastname = addslashes($_POST['user_last_name']);
      $user = addslashes($_POST['username']);
      $email = addslashes($_POST['emailaddress']);
      $pass = addslashes(md5($_POST['pass']));
      $passconf = addslashes(md5($_POST['passconfirm']));
      $bool = 0;
      if (empty($firstname) || empty($lastname) || empty($user) || empty($email) || empty($pass) || empty($passconf)) {
          $bool = 1;
      }
      if ($bool == 0) {
          if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
              $bool = -1;
              $_SESSION['alert'] = "Email address invalid";
              header("location:../pages/user_register.php");
          } else {
              if ($pass == $passconf) {
                  if (verify_accountUser($user, $result) == 0) {//Account doesn't exist
                      if (create_register($firstname, $lastname, $user, $email, $pass, $result) == 1) { //Account created
                          $_SESSION['id_user'] = $result;
                          $_SESSION['username'] = $_POST['username'];
                          header("location:../pages/user_panel.php");
                      } else {
                          $_SESSION['alert'] = "Can't create account";
                          header("location:../pages/user_register.php");
                      }
                  } else {
                      $_SESSION['alert'] = "Invalid account";
                      header("location:../pages/user_register.php");
                  }
              } else {
                  $_SESSION['alert'] = "Confirm password";
                  header("location:../pages/user_register.php");
              }
          }
      } else {
          $_SESSION['alert'] = "Obligatory information *";
          header("location:../pages/user_register.php");
      }
    }
  }


function verify_account($user, $password, &$result) {
    $sql = "SELECT * FROM user WHERE user = '$user' AND password = '$password'"
            . "OR email = '$user' AND password = '$password'";
    $rec = mysql_query($sql);
    $id = -1;

    if($rec){
      $reg = mysql_fetch_row($rec);     
      $id = $reg[0];
      if($id == "")
        $id = 0;
    }
    return $id;

}

function create_register($firstname, $lastname, $user, $email, $password, &$result) {
    $host_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $user;
    $sql = "INSERT INTO user VALUES (0,'$user','$password','$firstname',
                  '$lastname','$email','$host_dir','1','2')";
//        shell_exec('mkdir -p '. $host_dir);
    if (!mkdir($host_dir, 0777, true)) {
        die('Directory creation failed, please contact the administrator...');
    }
    $rslt = mysql_query($sql);
    if ($rslt) {
        return 1;
    } else {
        return 0;
    }
}


function verify_accountUser($user, &$result) {
    $sql = "SELECT * FROM user WHERE user = '$user' OR email = '$user'";    
    $res = mysql_query($sql);
    $id = -1;
    if($res){
      $reg = mysql_fetch_row($res);     
      $id = $reg[0];
      if($id == "")
        $id = 0;
    }
    return $id;
}
