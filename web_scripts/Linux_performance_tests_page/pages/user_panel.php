<?php
session_start();

if (!isset($_SESSION['userid']) || !isset($_SESSION['active'])) {
    header('location: http://' . filter_input(INPUT_SERVER, 'SERVER_NAME') . '/Linux_performance_tests_page' . '/pages/login.php');
}
?>
<!DOCTYPE html>
<html class="no-js">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Linux Analysis Performance</title>
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
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> 
                                <i class="icon-user"></i><?php echo $_SESSION['username']; ?> <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="#">Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="<?php echo 'http://' . filter_input(INPUT_SERVER, 'SERVER_NAME') . '/Linux_performance_tests_page' . '/scripts/session_security/close_session.php'; ?>">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <?php include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/Linux_performance_tests_page' . '/scripts/page_scripts/nav-bar.php'; ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <div class="span8 column">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Uploaded patches</div>
                                <div class="pull-right">
                                    <span class="badge badge-info"
                                          ><?php echo count(glob(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/uploads/" . $_SESSION['username'] . "/{*}", GLOB_BRACE)); ?>
                                    </span>

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
                                        <?php
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <button class="btn btn-medium btn-primary" type="submit" value="Crear sesión" onclick="location.href = 'upload_patches.php';">Upload</button>
                    </div>
                    <div class="span4 column">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">News</div>
                                <div class="pull-right"><span class="badge badge-info">0</span></div>
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
    <script>
                            $(".test").onClick(function () {
                                var patchName = $(this).attr('id');
                                $.ajax({
                                    url: "./../scripts/fio.php",
                                    method: 'post',
                                    data: {
                                        path: patchName
                                    }
                                }).done(function (data) {
                                    $('#wait_modal').modal('hide');
                                    $("#results_section").html('<pre>' + data + '</pre>');
                                }).fail(function (error) {
                                    alert('Failed: ' + error);
                                    $('#wait_modal').modal('hide');
                                });
                            });
    </script>
</body>
</html>
