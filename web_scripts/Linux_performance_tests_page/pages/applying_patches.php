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
            <?php include '../scripts/nav-bar.php'; ?>
            <!--<div class="span9" id="content">-->
                <span class="btn btn-primary btn-file">Upload a list of patches to analyze
                    <input class="file" id="input1" type="file" multiple="true">
                </span>
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
    <script>$("#input1").fileinput({showUpload: false, maxFileCount: 10, mainClass: "input-group-lg"});</script>
    <!--        <script>
                                $(function () {
                                    $('.chart').easyPieChart({animate: 1000});
                                });
            </script>-->
</body>

</html>