<?php
     /* Empezamos la sesión */
     session_start();
    
     /* Si no hay una sesión creada, redireccionar al index. */
     if(empty($_SESSION['username']) && empty($_SESSION['pass'])){ // Recuerda usar corchetes.
        header('Location: login.php');
     }
?>
<!DOCTYPE html>
<html class="no-js">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Linux Analysis Performance</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <!--<link href="../vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">-->
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
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
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> 
                                <i class="icon-user"></i><?=$_SESSION['username'];?> <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#">Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="login.php">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!--<div class="container">-->
            <?php include '../scripts/nav-bar.php'; ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <div class="span8 column">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Uploaded patches</div>
                                <div class="pull-right"><span class="badge badge-info">0</span>

                                </div>
                            </div>
                            <div class="block-content collapse in">

                                <table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Patch name
                                            </th>
                                            <th>
                                                Upload date
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Actions  
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-medium btn-success" type="submit" value="Crear sesión" onclick="location.href='applying_patches.php' ;">Apply</button>
                    </div>
                    <div class="span4 column">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Users</div>
                                <div class="pull-right"><span class="badge badge-info">1,234</span></div>
                            </div>
                            <div class="block-content collapse in">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <footer>
            <p></p>
        </footer>
    </div>
    <script src="../vendors/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>
</body>

</html>