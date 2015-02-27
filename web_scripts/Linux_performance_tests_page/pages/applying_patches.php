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
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!--<div class="container">-->
            <?php include './../scripts/nav-bar.php'; ?>
            <div class="span9" id="content">
                <div class="row-fluid">
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