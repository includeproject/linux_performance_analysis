<?php

class ValidationUtils {

    function clean_post_data($post_data) {
        $post_data = trim($post_data);
        $post_data = addslashes($post_data);
        $post_data = stripslashes($post_data);
        $post_data = htmlspecialchars($post_data);
        return $post_data;
    }

    function encrypt_password($password) {
        return sha1("(#~$" . md5("L!n@#" . $password . "P3*f0*m4nc3") . "$~#)");
    }

    function isEmail($email){
        return preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email);
    }
    
    function isName($name){
        return preg_match("|^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$|", $name);
    }
}
