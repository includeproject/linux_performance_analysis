<?php

#This script must contain the code for catch, validate and apply the patches
#sent by the user
fixFilesArray($_FILES['upload']);
foreach ($_FILES['upload'] as $position => $file) {
    // should output array with indices name, type, tmp_name, error, size
    var_dump($file);
    echo $_FILES['upload']["name"][0];
}

