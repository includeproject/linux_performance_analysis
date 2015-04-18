<?php

echo '<h1>Welcome!</h1>';
$cmd = '';

$result = exec($cmd, $output, $return);

echo $result;
echo '<br />';
echo var_dump($output);
echo '<br />';
echo $return;

echo '<h1>Welcome!</h1>';

$result2 = passthru($cmd, $return);

echo $result2;
echo '<br />';
echo '<br />';
echo $return;
