<?php

#This script must contain the code for catch, validate and apply the patches
#sent by the user
#Please make sure that the $uploadDir directory exists
#This files are not validated on this release, please be careful what you upload


$uploadDir = '/var/www/html/uploads/';
$userDir = '';
if ($_FILES['files']['name'] && $_FILES['files']['error']) {
    $i = 0;
    foreach ($_FILES['files']['name'] as $file) {
        echo $file[$i].'<br/>';
        if (copy($_FILES['files']['tmp_name'][$i], $uploadDir . $_FILES['files']['name'][$i])) {
            echo "The files were succesfully uploaded. <br/>";
        } else {
            echo "An error occurred while uploading the file. <br/>";
            echo 'error with '. $file[$i] .'<br/>';
            echo 'Position: '. $i .'<br/>';
        }
        ++$i;
    }
}