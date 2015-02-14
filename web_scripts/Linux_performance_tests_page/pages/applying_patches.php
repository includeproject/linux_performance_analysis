<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Linux Analysis Performance</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
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
            <?php include '../scripts/nav-bar.php'; ?>
            <div class="span9" id="condtent">
                <div class="row-fluid">
                    <form method="post" role="form" action="#">
                        <div class="jumbotron">
                            <h1>
                                Upload your patches to analize!
                            </h1>
                            <p>
                                You are able to upload your own patches and analize their performance with ltp. 
                                The results will be shown into another page after the operations end.
                            </p>
                            <p>

                                <span class="btn btn-primary btn-file">Upload a list of patches to analyze
                                    <input class="file" id="fileInput" type="file" name="files[]" multiple="true">
                                </span>
                                <!--                            <button class="btn btn-inverse" id="update">
                                                                <i class="icon-refresh icon-white"></i> 
                                                                Update
                                                            </button>-->
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
                        <div class="pull-right">
                            <button type="submit" class="btn btn-inverse" id="submit">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Test patches
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--</div>-->
        </div>
        <hr>
        <footer>
            <p></p>
        </footer>
    </div>
    <script src="../vendors/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="../vendors/easypiechart/jquery.easy-pie-chart.js"></script>-->
    <script src="../assets/scripts.js"></script>
    <script>
        $("#submit").prop("disabled", true);
        $("#fileInput").change(function () {
            var files = $("#fileInput")[0].files;
            var tbody = '';
            var supported_extensions = ["gz","xz","bz2","tar","tar.gz","tar.xz","tar.bz2"];
            for (var i = 0; i < files.length; i++) {
                var extension = files[i].name.split('.').pop();
                extension = (files[i].name.indexOf('.') > 0) ? extension : '--';
                
                /*Change the next condition comparing with supported_extensions array*/
                var status = (extension !== '--') ? 'success' : 'rejected';
                /*********************************************************************/
                
                tbody += '<tr>';
                tbody += '<td>' + (i + 1) + '</td>';
                tbody += '<td>' + files[i].name + '</td>';
                tbody += '<td>' + extension + '</td>';
                tbody += '<td>' +
                        '<span class="badge badge-' + ((status === 'rejected') ? 'important' : 'success') + '">' + status + '</span>'
                        + '</td>';
                tbody += '</tr>';
            }
            $('#tbody').html(tbody);
            if (tbody === '') {
                $("#submit").prop("disabled", true);
            } else {
                $("#submit").prop("disabled", false);
            }
        });

    </script>
</body>

</html>