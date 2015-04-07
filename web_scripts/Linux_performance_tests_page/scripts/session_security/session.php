<?php

class Session {

    public static function create($user) {
        
        session_start();
        $_SESSION = array();
        $_SESSION['username'] = $user->username;
        $_SESSION['userid'] = $user->idUser;
        $_SESSION['name'] = $user->name;
        $_SESSION['lastname'] = $user->lastname;
        $_SESSION['level'] = $user->level;
        $_SESSION['active'] = $user->active;
        $_SESSION['workingdir'] = $user->host_directory;
        $_SESSION['email'] = $user->email;
    }

    public static function destroy() {
        session_start();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

}
