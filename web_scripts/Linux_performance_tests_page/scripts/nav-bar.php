<?php

#This is the navigation bar that appears at the left on linux_performance_tests_page
#Add any link you want, just follow the bootstrap rules
$server_name = $_SERVER['SERVER_NAME'];
$path = pathinfo($_SERVER['PHP_SELF']);
$path = $path['dirname'];
$path = $server_name . $path;
$path = str_replace('pages', '', $path);

echo '
    <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="">
                            <a href="http://' . $path . '/pages/execute_script.php"><i class="icon-chevron-right"></i> Perform tests</a>
                        </li>
                        <li class="">
                            <a href="http://' . $path . '/pages/upload_patches.php"><i class="icon-chevron-right"></i> Upload a patch</a>
                        </li>
                        <li class="">
                            <a href="http://' . $path . '/pages/about.php"><i class="icon-chevron-right"></i> About</a>
                        </li>
                        <li class="">
                            <a href="http://' . $path . '/pages/user_panel.php"><i class="icon-chevron-right"></i> User panel</a>
                        </li>
                    </ul>
                </div>
';
