<?php

#This script must contain the code for catch, validate and apply the patches
#sent by the user
    echo $_FILES['files']["name"][0];

fixFilesArray($_FILES['files']);
foreach ($_FILES['files'] as $position => $file) {
    // should output array with indices name, type, tmp_name, error, size
    var_dump($file);
}

