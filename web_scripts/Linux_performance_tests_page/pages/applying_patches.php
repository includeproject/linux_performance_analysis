<?php
     /* Empezamos la sesión */
     session_start();
     /* Si no hay una sesión creada, redireccionar al index. */
     if(empty($_SESSION['username'])) { // Recuerda usar corchetes.
        header('Location: login.php');
     }
?>
<!DOCTYPE html>
<html class="no-js">

    <head>
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
            <?php include './../scripts/nav-bar.php'; ?>
            <div class="span9" id="content">
                <div class="row-fluid">
<!--<<<<<<< HEAD-->
                    <form method="post" role="form" action="./../scripts/apply_patch.php" enctype="multipart/form-data">
                        <div class="jumbotron">
                            <h1>
                                Upload your patches to analyze!
                            </h1>
                            <p>
                                You are able to upload your own patches and analyze their performance with ltp. 
                                The results will be shown into another page after the operations end. You are able to upload 
                                patches only with extension .diff and .patch.
                            </p>
                            <p>
<!--=======-->
                    <div class="jumbodtron">
                        <h1>
                            Upload your patches to analyze!
                        </h1>
                        <p>
                            You are able to upload your own patches and analyze their performance with ltp. 
                            The results will be shown into another page after the operations end. You are able to upload 
                            patches only with extension .diff and .patch.
                        </p>
                        <br/>
                        <br/>
                        <form id="fileupload" action="http://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data" class="">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript>&lt;input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"&gt;</noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="files[]" multiple="">
                                    </span>
                                    <button type="submit" class="btn btn-primary start" onclick="location.href='execute_script.php'">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <!--                                    <button type="reset" class="btn btn-warning cancel">
                                                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                                                            <span>Cancel upload</span>
                                                                        </button>-->
                                    <!--                                    <button type="button" class="btn btn-danger delete">
                                                                            <i class="glyphicon glyphicon-trash"></i>
                                                                            <span>Delete</span>
                                                                        </button>-->
                                                                        <!--<input type="checkbox" class="toggle">-->
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                        </form>
<!-->>>>>>> origin/master-->

                                <span class="btn btn-primary btn-file">Upload a list of patches to analyze
                                    <input class="file" id="fileInput" type="file" name="files[]" multiple/>
                                </span>
                            </p>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        Patch extension
                                    </th>
                                    <th>
                                        Status for upload
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                        <div id="alert-box" class="alert alert-success">
                            <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                            <h4 id="alert-title">Accepted files</h4>
                            <p id="alert-message">The operation can be completed successfully</p>
                            <button type="submit" class="btn btn-inverse" id="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Upload patches
                            </button>
                        </div>
                    </form>


                    <div id="alert-box-danger" class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>There are some rejected files</h4>
                        <p>Please make sure that you have uploaded files with extension .diff or .patch</p>
                    </div>
                </div>
            </div>
            <!--</div>-->
        </div>
        <hr>
        <footer>
            <p></p>
        </footer>
    </div>
    <script src="./../vendors/jquery-1.9.1.min.js"></script>
    <script src="./../bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="../vendors/easypiechart/jquery.easy-pie-chart.js"></script>-->
    <script src="./../assets/scripts.js"></script>
    <script>
        function isSupportedExtension(extension) {
            return (extension === 'patch' || extension === 'diff' || extension === 'xz')
                    ? true
                    : false;
        }
        $("#submit").prop("disabled", true);
        $("#alert-box").hide();
        $("#alert-box-danger").hide();
        $("#fileInput").change(function () {
            var files = $("#fileInput")[0].files;
            var tbody = '';
            var flag = true;//This is temporal
            for (var i = 0; i < files.length; i++) {
                var extension = files[i].name.split('.').pop();
                extension = (files[i].name.indexOf('.') > 0) ? extension : '--';

                /*Change the next condition comparing with supported_extensions array*/
                var status = (extension !== '--' && isSupportedExtension(extension)) ? 'success' : 'rejected';
                /*********************************************************************/
                tbody += '<tr>';
                tbody += '<td>' + (i + 1) + '</td>';
                tbody += '<td>' + files[i].name + '</td>';
                tbody += '<td>' + extension + '</td>';
                tbody += '<td>' +
                        '<span class="badge badge-' + ((status === 'rejected') ? 'important' : 'success') + '">' + status + '</span>'
                        + '</td>';
                tbody += '</tr>';
                flag = (status === 'rejected') ? true : false;
            }
            $('#tbody').html(tbody);
            if (tbody === '' || flag) {
                $("#submit").prop("disabled", true);
                $("#alert-box").hide();
                $("#alert-box-danger").show();
            } else {
                $("#submit").prop("disabled", false);
                $("#alert-box").show();
                $("#alert-box-danger").hide();
            }
        });

    </script>
</body>

</html>