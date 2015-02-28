<?php
session_start(); 

include_once "conexion.php";
  $_SESSION['alert'] ="";
  if (!mysql_select_db(DB_NAME)) {
      echo mysql_error(); 
  }
  else {    
      if (isset($_POST['login_user'])){
          $user = $_POST['username'];
          $pass = $_POST['pass'];
          echo "user ".$user." pass ".$pass;
          if(empty($user) && empty($pass)){
            header("location: ../pages/login.php");
          }else{
            if(verify_account($user,$pass,$result) == 1){
              $_SESSION['username'] = $user; 
              $_SESSION['pass'] = $pass;
              header("location: ../pages/user_panel.php");
            }
            else{
              header("location: ../pages/user_register.php");
            }
          }
      }
      if (isset($_POST['register'])) {  
        $firstname = $_POST['user_first_name'];
        $lastname= $_POST['user_last_name'];
        $user = $_POST['username'];
        $email = $_POST['emailaddress'];
        $pass = $_POST['pass'];
        $passconf = $_POST['passconfirm'];

        if($pass == $passconf){
          if(verify_account($user,$pass,$result) == 0){
              if(create_register($firstname, $lastname, $user, $email,$pass,$result) == 1){ 
                $_SESSION['username'] = $_POST['username']; 
                $_SESSION['pass'] = $_POST['password'];
                header("location:../pages/user_panel.php"); 
              }else{
                $_SESSION['alert'] ="Can't create account";
                header("location:../pages/user_register.php"); 
              }
          } 
          else{
            $_SESSION['alert'] ="Account invalid";
            header("location:../pages/user_register.php"); 
          }
        } else{ 
            $_SESSION['alert'] ="Confirm password";
            header("location:../pages/user_register.php"); 
        }   
      }  

    }
  

  function verify_account($user,$password,&$result) { 
        $sql = "SELECT * FROM user WHERE user = '$user' and password = '$password'"; 
        $rec = mysql_query($sql); 
        $count = 0; 

        while($row = mysql_fetch_object($rec)){ 
            $count++; 
            $result = $row; 
        }   
        return $count;
    } 

    function create_register($firstname, $lastname,$user,$email,$password,&$result) { 
        $host_dir = $_SERVER['DOCUMENT_ROOT']."/uploads/".$user;
        $sql = "INSERT INTO user VALUES (0,'$user','$password','$firstname',
                  '$lastname','$email','$host_dir','1','2')"; 
        shell_exec('mkdir -p '. $host_dir);
        $rslt = mysql_query($sql); 
        if($rslt){
          return 1;
        }else{
          return 0;
        }
    } 
?>