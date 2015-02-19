<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
                <?php include '../scripts/nav-bar.php'; ?>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!--/.fluid-container-->
        <script src="../vendors/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../assets/scripts.js"></script>
    </body>

</html>