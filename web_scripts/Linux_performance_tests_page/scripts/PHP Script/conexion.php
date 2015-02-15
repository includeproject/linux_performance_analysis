<?php
 
//Information for database conection
define('DB_SERVER','localhost');
define('DB_NAME','');
define('DB_USER','');
define('DB_PASS','');
 
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
mysql_select_db(DB_NAME,$con);
 
?>
