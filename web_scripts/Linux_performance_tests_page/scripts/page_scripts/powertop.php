<?php

shell_exec('sudo powertop --csv=$(pwd)/result.csv');

$result = shell_exec('cat $(pwd)/result.csv');

echo $result;