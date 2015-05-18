<?php

class User {

    public $idUser;
    public $username;
    public $password;
    public $name;
    public $lastname;
    public $email;
    public $host_directory;
    public $active;
    public $level;

    public function __construct($username, $password, $name, $lastname, $email, $host_directory, $active, $level, $id_user = -1) {
        $this->idUser = $id_user;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->host_directory = $host_directory;
        $this->active = $active;
        $this->level = $level;
    }

    public function constructUser($row) {
        if ($row != NULL) {
            $user = new User(
                    $row['user'], $row['password'], $row['first_name'], $row['last_name'], $row['email'], $row['host_directory'], $row['active'], $row['level'], $row['id_user']);
            return $user;
        }
        return NULL;
    }

    public function create($user) {
        $sql = 'INSERT INTO '
                . 'user(user, password, first_name, last_name, email, host_directory, active, level) '
                . 'VALUES(' . '
                "' . $user->username . '",
                "' . $user->password . '",
                "' . $user->name . '",
                "' . $user->lastname . '",
                "' . $user->email . '",
                "' . $user->host_directory . '",
                ' . $user->active . ',' .
                '' . $user->level . '' .
                ')';
        include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/connection.php';
        Connection::execute_query($sql);
    }

    public function retreiveAll() {
        $sql = 'SELECT * FROM user WHERE active=1';
        include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/connection.php';
        $result = Connection::execute_query($sql);
        $users = mysql_fetch_array($result);
        return $users;
    }

    public function userExists($username, $password, $nopass = NULL) {
        $sql = ($nopass == NULL) ?
                'SELECT * FROM user '
                . 'WHERE'
                . '(user = "' . $username . '" OR email = "' . $username . '") '
                . 'AND password ="' . $password . '"' : 
            'SELECT * FROM user WHERE user = "' . $username . '" OR email = "' . $username . '"';
        include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/connection.php';
        $result = Connection::execute_query($sql);
        $row = mysqli_fetch_array($result);
        echo $sql;
        return $this->constructUser($row);
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getHost_directory() {
        return $this->host_directory;
    }

    public function getActive() {
        return $this->active;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHost_directory($host_directory) {
        $this->host_directory = $host_directory;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function __destruct() {
        $this->idUser = NULL;
        $this->username = NULL;
        $this->password = NULL;
        $this->name = NULL;
        $this->lastname = NULL;
        $this->email = NULL;
        $this->host_directory = NULL;
        $this->active = NULL;
        $this->level = NULL;
    }

}
