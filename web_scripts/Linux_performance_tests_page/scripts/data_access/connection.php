<?php

class Connection {

    public static function execute_query($sql) {
        require_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/data_access/db_connection.inc';
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        mysqli_query($connection, "SET NAMES 'utf8'");
        $result = mysqli_query($connection, $sql);
        return $result;
    }

}
