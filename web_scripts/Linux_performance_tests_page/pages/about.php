<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Admin Home Page</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Linux Performance Analysis</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/page_scripts/nav-bar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <div class="jumbotron">
                            <h1>
                                Hi everybody!
                            </h1>
                            <p>
                                The idea of this website is that you can upload a linux kernel patch or series of patches such as 
                                files, web addresses and even from the mailing list. After that perform some script tools that
                                analizes the performance of the kernel before and after the application of the patch. This will help
                                to all open source community, please be patient. 
                                If you want more information or you have any idea and you want to collaborate with us please visit our 
                                <a href="https://github.com/includeproject/linux_performance_analysis">github</a> repo.
                            </p>
                            <p>
                                You are able to execute three different scripts from three different tools, more performance tools will be
                                available over time. This is only for tests. 
                                <br/>
                                <br/>
                                <i><b>Installed tools</b></i>
                            <ul>
                                <li>Linux Test Performance (LTP)</li>
                                <li>Powertop</li>
                                <li>Flexible I/O tester (FIO)</li>
                            </ul>
                            <pre>
  _      _                    _____           __                                          
 | |    (_)                  |  __ \         / _|                                         
 | |     _ _ __  _   ___  __ | |__) |__ _ __| |_ ___  _ __ _ __ ___   __ _ _ __   ___ ___ 
 | |    | | '_ \| | | \ \/ / |  ___/ _ \ '__|  _/ _ \| '__| '_ ` _ \ / _` | '_ \ / __/ _ \
 | |____| | | | | |_| |>  <  | |  |  __/ |  | || (_) | |  | | | | | | (_| | | | | (_|  __/  _ _ _
 |______|_|_| |_|\__,_/_/\_\ |_|   \___|_|  |_| \___/|_|  |_| |_| |_|\__,_|_| |_|\___\___| (_|_|_)

                                 .:xxxxxxxx:. 
                             .xxxxxxxxxxxxxxxx. 
                            :xxxxxxxxxxxxxxxxxxx:. 
                           .xxxxxxxxxxxxxxxxxxxxxxx: 
                          :xxxxxxxxxxxxxxxxxxxxxxxxx: 
                          xxxxxxxxxxxxxxxxxxxxxxxxxxX: 
                          xxx:::xxxxxxxx::::xxxxxxxxx: 
                         .xx:   ::xxxxx:     :xxxxxxxx 
                         :xx  x.  xxxx:  xx.  xxxxxxxx 
                         :xx xxx  xxxx: xxxx  :xxxxxxx 
                         'xx 'xx  xxxx:. xx'  xxxxxxxx 
                          xx ::::::xx:::::.   xxxxxxxx 
                          xx:::::.::::.:::::::xxxxxxxx 
                          :x'::::'::::':::::':xxxxxxxxx. 
                          :xx.::::::::::::'   xxxxxxxxxx 
                          :xx: '::::::::'     :xxxxxxxxxx. 
                         .xx     '::::'        'xxxxxxxxxx. 
                       .xxxx                     'xxxxxxxxx. 
                     .xxxx                         'xxxxxxxxx. 
                   .xxxxx:                          xxxxxxxxxx. 
                  .xxxxx:'                          xxxxxxxxxxx. 
                 .xxxxxx:::.           .       ..:::_xxxxxxxxxxx:. 
                .xxxxxxx''      ':::''            ''::xxxxxxxxxxxx. 
                xxxxxx            :                  '::xxxxxxxxxxxx 
               :xxxx:'            :                    'xxxxxxxxxxxx: 
              .xxxxx              :                     ::xxxxxxxxxxxx 
              xxxx:'                                    ::xxxxxxxxxxxx 
              xxxx               .                      ::xxxxxxxxxxxx. 
          .:xxxxxx               :                      ::xxxxxxxxxxxx:: 
          xxxxxxxx               :                      ::xxxxxxxxxxxxx: 
          xxxxxxxx               :                      ::xxxxxxxxxxxxx: 
          ':xxxxxx               '                      ::xxxxxxxxxxxx:' 
            .:. xx:.                                   .:xxxxxxxxxxxxx' 
          ::::::.'xx:.            :                  .:: xxxxxxxxxxx': 
  .:::::::::::::::.'xxxx.                            ::::'xxxxxxxx':::. 
  ::::::::::::::::::.'xxxxx                          :::::.'.xx.'::::::. 
  ::::::::::::::::::::.'xxxx:.                       :::::::.'':::::::::   
  ':::::::::::::::::::::.'xx:'                     .'::::::::::::::::::::.. 
    :::::::::::::::::::::.'xx                    .:: ::::::::::::::::::::::: 
  .:::::::::::::::::::::::. xx               .::xxxx ::::::::::::::::::::::: 
  :::::::::::::::::::::::::.'xxx..        .::xxxxxxx ::::::::::::::::::::' 
  '::::::::::::::::::::::::: xxxxxxxxxxxxxxxxxxxxxxx :::::::::::::::::' 
    '::::::::::::::::::::::: xxxxxxxxxxxxxxxxxxxxxxx :::::::::::::::' 
        ':::::::::::::::::::_xxxxxx::'''::xxxxxxxxxx '::::::::::::' 
             '':.::::::::::'                        `._'::::::'' 
                            </pre>
                            <h3>Applying patches feature is coming soon!</h3>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <script src="../vendors/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>