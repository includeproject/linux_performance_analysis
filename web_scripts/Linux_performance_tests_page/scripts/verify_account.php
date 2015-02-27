<?php
session_start(); 
session_unset();
session_destroy(); 
include_once "conexion.php";

  if (!mysql_select_db(DB_NAME)) {
      echo mysql_error(); 
  }
  else {
    if (!isset($_SESSION['username'])){
      if (isset($_POST['login']){
          $user = $_POST['username'];
          $pass = $_POST['pass'];
          if(empty($user) && empty($pass)){
            header("location: ../pages/login.php");
          }else{
            //Si la cuenta existe, direccionar a user_panel.php
            if(verify_account($user,$pass,$result) == 1){
              $_SESSION['username'] = $user; 
              $_SESSION['pass'] = $pass;
              header("location: ../pages/user_panel.php");
            }
            //Sino direccionar a user_register.php, registro
            else{
              header("location: ../pages/user_register.php");
            }
          }
      }  
      else if (isset($_POST['register'])) {  
        if($_POST['pass'] == $POST['passconfirm']){
          if(verify_account($_POST['user'],$_POST['password'],$result) == 0){//No existe la cuenta
              if(create_register($_POST['user_first_name'],
                                 $_POST['user_last_name'],
                                 $_POST['username'],
                                 $_POST['emailaddress'],
                                 $_POST['pass'],
                                 $result) == 1){ 
                $_SESSION['username'] = $_POST['username']; 
                $_SESSION['pass'] = $_POST['password']; 
                header("location:../pages/user_panel.php"); 
              }
          } 
        } else{ 
            header("location:../pages/user_register.php"); 
        }   
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
        if($count == 1){ 
            return 1; 
        } else{ 
            return 0; 
        } 
    } 

    function create_register($firstname, $lastname,$user,$email,$password,&$result) { 
        $sql = "INSERT INTO user VALUES (0,'$user','$password','$firstname',
                  '$lastname','$email','$host_dir','0','2')"; 
        $rslt = mysql_query($sql); 
        if($rslt){
          return 1;
        }else{
          return 0;
        }
    } 
?>