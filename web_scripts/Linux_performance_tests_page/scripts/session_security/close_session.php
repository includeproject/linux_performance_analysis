<?php

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/session_security/session.php';
Session::destroy();

header('location: http://' . filter_input(INPUT_SERVER, 'REMOTE_ADDR') . '/Linux_performance_tests_page' . '/pages/login.php');

