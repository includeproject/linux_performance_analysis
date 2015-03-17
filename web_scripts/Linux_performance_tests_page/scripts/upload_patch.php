<?php

#This script must contain the code for catch, validate and apply the patches
#sent by the user
#Please make sure that the $uploadDir directory exists
#This files are not validated on this release, please be careful what you upload
session_start();

$uploadDir = '/var/www/html/uploads/' . $_SESSION['username'] . '/';
$userDir = '';
include_once './conexion.php';
if ($_FILES['files']['name'] && $_FILES['files']['error']) {
    $i = 0;
    foreach ($_FILES['files']['name'] as $file) {
        echo $file[$i] . '<br/>';
        if (copy($_FILES['files']['tmp_name'][$i], $uploadDir . $_FILES['files']['name'][$i])) {
            date_default_timezone_set('America/Monterrey');
            $date = date('Y-m-d H:i:s');
            $fileName = $_FILES['files']['name'][$i];
            $createPatch = "INSERT INTO patch VALUES(0,'$fileName'" . $date . ",'Standby',)";
            echo "The files were succesfully uploaded. <br/>";
        } else {
            echo "An error occurred while uploading the file. <br/>";
            echo 'error with ' . $file[$i] . '<br/>';
            echo 'Position: ' . $i . '<br/>';
        }
        ++$i;
    }
}
    header('Location: ./../pages/user_panel.php');
