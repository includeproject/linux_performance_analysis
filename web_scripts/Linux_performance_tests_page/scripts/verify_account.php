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
          $pass = addslashes($_POST['pass']);
    
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
        // Escape single quotes.->  addslashes
        $firstname = addslashes($_POST['user_first_name']);
        $lastname= addslashes($_POST['user_last_name']);
        $user = addslashes($_POST['username']);
        $email = addslashes($_POST['emailaddress']);
        $pass = addslashes($_POST['pass']);
        $passconf = addslashes($_POST['passconfirm']);
        $bool = 0;
        if(empty($firstname) || empty($lastname) || empty($user) || empty($email) || empty($pass) || empty($passconf)){
          $bool = 1;
        }
        if($bool == 0){
          if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
              $bool = -1;
              $_SESSION['alert'] ="Email address invalid";
              header("location:../pages/user_register.php"); 
          }
          else{
            if($pass == $passconf){
              if(verify_account($user,$pass,$result) == 0){//Account doesn't exist
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
                $_SESSION['alert'] ="Invalid account";
                header("location:../pages/user_register.php"); 
              }
            } else{ 
                $_SESSION['alert'] ="Confirm password";
                header("location:../pages/user_register.php"); 
            }
          }   
        }
        else{
            $_SESSION['alert'] ="Obligatory information *";
            header("location:../pages/user_register.php"); 
        }
      }  

    }
  

  function verify_account($user,$password,&$result) { 
        $sql = "SELECT * FROM user WHERE user = '$user' AND password = '$password'"
                . "OR email = '$user' AND password = '$password'"; 
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
