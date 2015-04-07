<?php
/* This php script contains all possible operations with ltp, and all performance
 * scripts that the server can carry out
 */

#Uncomment this line only if you are choosing a specific test from the client side
#$test= $_POST["selected_test"];


#This array contains all possible tests and their respective command
$array_tests = array(
    "cpuclock" => "fio --cpuclock-test"
    );

#Change the $result assignation with this one if you are receiving the test as parameter
#$result = shell_exec($array_tests[$test]);
$result = shell_exec($array_tests["cpuclock"]);

echo $result;