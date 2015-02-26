<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <script src="../vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <div class="modal fade" id="wait_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="myModalLabel">Wait a moment...</h1>
                    </div>
                    <div class="modal-body">
                        <p>The scripts are being executed as fast as possible</p>
                        <div class="" style="text-align: center;">
                            <img src="assets/ajax-loader2.gif"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                <?php include './../scripts/nav-bar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <div class="jumbotron">
                            <h1>
                                These tests are executed on realtime!
                            </h1>
                            <p>
                                Once you have uploaded the patch, this could be the first page you see, please select
                                one tool and one script to execute.
                            </p>
                            <p>The meter animations has no functionality yet.</p>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Select an analysis script to execute</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span4">
                                    <div class="chart" data-percent="73">73%</div>
                                    <div class="chart-bottom-heading">
                                        <button class="btn btn-inverse" id="ltp_button">LTP</button>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="chart" data-percent="53">53%</div>
                                    <div class="chart-bottom-heading">
                                        <button class="btn btn-primary" id="powertop_button">Powertop</button>

                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="chart" data-percent="83">83%</div>
                                    <div class="chart-bottom-heading">
                                        <button class="btn btn-primary" id="fio_button">FIO</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="available_scripts" class="row-fluid">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="ltp_scripts">
                                <table id="ltp_scripts_table"class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Script name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>ver_linux</td>
                                            <td>This script shows everything about the linux distribution and physical environment</td>
                                            <td><button id="execute_ltp_ver_linux" class="btn btn-success btn-mini">Execute</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="powertop_scripts">
                                <table id="powertop_scripts_table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Script name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Powertop</td>
                                            <td>This script will show the results thrown by powertop</td>
                                            <td><button id="execute_powertop_csv" class="btn btn-success btn-mini">Execute</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="fio_scripts">
                                <table id="fio_scripts_table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Script name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>cpuclock-test</td>
                                            <td>Perform test and validation of internal CPU clock<td>
                                            <td><button id="execute_fio_cpuclock_test" class="btn btn-success btn-mini">Execute</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="results_section" class="row-fluid">
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <script src="../vendors/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../assets/scripts.js"></script>
        <script>
            $(function () {
                $('.chart').easyPieChart({animate: 1000});
            });
        </script>
        <script>
            $('#wait_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: false
            });
            function exclude() {
                $("#ltp_button").attr("class", "btn btn-primary");
                $("#powertop_button").attr("class", "btn btn-primary");
                $("#fio_button").attr("class", "btn btn-primary");
            }
            $("#ltp_button").click(function () {
                exclude();
                $(this).attr("class", "btn btn-inverse");
                $("#ltp_scripts").attr("class", "tab-pane active");
                $("#powertop_scripts").attr("class", "tab-pane");
                $("#fio_scripts").attr("class", "tab-pane");
            });
            $("#powertop_button").click(function () {
                exclude();
                $(this).attr("class", "btn btn-inverse");
                $("#ltp_scripts").attr("class", "tab-pane");
                $("#powertop_scripts").attr("class", "tab-pane active");
                $("#fio_scripts").attr("class", "tab-pane");
            });
            $("#fio_button").click(function () {
                exclude();
                $(this).attr("class", "btn btn-inverse");
                $("#ltp_scripts").attr("class", "tab-pane");
                $("#powertop_scripts").attr("class", "tab-pane");
                $("#fio_scripts").attr("class", "tab-pane active");
            });
            $("#execute_ltp_ver_linux").click(function () {
                $('#wait_modal').modal('show');
                $.ajax({
                    url: "./scripts/ltp.php"
                }).done(function (data) {
                    $("#results_section").html('<pre>' + data + '</pre>');
                    $('#wait_modal').modal('hide');
                }).fail(function () {
                    alert('Failed');
                });
            });
            $("#execute_powertop_csv").click(function () {
                $('#wait_modal').modal('show');
                $.ajax({
                    url: "./scripts/powertop.php"
                }).done(function (data) {
                    $('#wait_modal').modal('hide');
                    $("#results_section").html('<pre>' + data + '</pre>');
                });
            });
            $("#execute_fio_cpuclock_test").click(function () {
                $('#wait_modal').modal('show');
                $.ajax({
                    url: "./scripts/fio.php"
                }).done(function (data) {
                    $('#wait_modal').modal('hide');
                    $("#results_section").html('<pre>' + data + '</pre>');
                });
            });
        </script>
    </body>

</html>