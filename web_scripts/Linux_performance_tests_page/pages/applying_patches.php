<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Linux Analysis Performance</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../assets/styles.css" rel="stylesheet" media="screen">
        <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <link rel="stylesheet" href="../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/css/jquery.fileupload.css">
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
            <div class="span4">
                <?php include './../scripts/nav-bar.php'; ?>
            </div>
            <div class="span8" id="content">
                <div class="row-fluid">
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
                                    <button type="submit" class="btn btn-primary start">
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

                    </div>
                </div>
                <div class="row-fluid">

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
    <script src="./../assets/scripts.js"></script>
    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
        <td>
        <span class="preview"></span>
        </td>
        <td>
        <p class="name">{%=file.name%}</p>
        <strong class="error text-danger"></strong>
        </td>
        <td>
        <p class="size">Processing...</p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
        {% if (!i && !o.options.autoUpload) { %}
        <button class="btn btn-primary start" disabled>
        <i class="glyphicon glyphicon-upload"></i>
        <span>Start</span>
        </button>
        {% } %}
        {% if (!i) { %}
        <button class="btn btn-warning cancel">
        <i class="glyphicon glyphicon-ban-circle"></i>
        <span>Cancel</span>
        </button>
        {% } %}
        </td>
        </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
        <td>
        <span class="preview">
        {% if (file.thumbnailUrl) { %}
        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
        {% } %}
        </span>
        </td>
        <td>
        <p class="name">
        {% if (file.url) { %}
        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
        {% } else { %}
        <span>{%=file.name%}</span>
        {% } %}
        </p>
        {% if (file.error) { %}
        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
        {% } %}
        </td>
        <td>
        <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
        {% if (file.deleteUrl) { %}
        <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
        <i class="glyphicon glyphicon-trash"></i>
        <span>Delete</span>
        </button>
        <input type="checkbox" name="delete" value="1" class="toggle">
        {% } else { %}
        <button class="btn btn-warning cancel">
        <i class="glyphicon glyphicon-ban-circle"></i>
        <span>Cancel</span>
        </button>
        {% } %}
        </td>
        </tr>
        {% } %}
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <!--<script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-image.js"></script>-->
    <!-- The File Upload audio preview plugin -->
    <!--<script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-audio.js"></script>-->
    <!-- The File Upload video preview plugin -->
    <!--<script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-video.js"></script>-->
    <!-- The File Upload validation plugin -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="./../vendors/jqueryUploader/jQuery-File-Upload-9.9.3/js/main.js"></script>
<!--    <script>
        function isSupportedExtension(extension) {
            return (extension === 'patch' || extension === 'diff')
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

    </script>-->
</body>

</html>