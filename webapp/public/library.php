<?php require_once('../Application.php');?>
<?php AuthSession::protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('My Library');?>
    <link rel="stylesheet=" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css"/>
</head>
<!-- BODY options, add following classes to body to change options
    // Header options
    1. '.header-fixed'					- Fixed Header

    // Brand options
    1. '.brand-minimized'       - Minimized brand (Only symbol)

    // Sidebar options
    1. '.sidebar-fixed'					- Fixed Sidebar
    2. '.sidebar-hidden'				- Hidden Sidebar
    3. '.sidebar-off-canvas'		- Off Canvas Sidebar
    4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
    5. '.sidebar-compact'			  - Compact Sidebar

    // Aside options
    1. '.aside-menu-fixed'			- Fixed Aside Menu
    2. '.aside-menu-hidden'			- Hidden Aside Menu
    3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

    // Breadcrumb options
    1. '.breadcrumb-fixed'			- Fixed Breadcrumb

    // Footer options
    1. '.footer-fixed'					- Fixed footer

    -->
<body class="app header-fixed sidebar-fixed">
<?php echo App::buildPageNavbar();?>
<div class="app-body">
    <?php App::buildPageSidebar();?>

    <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">My Library</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-speech"></i></a>
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid" id="library-view">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                        <image src="https://placehold.it/<?php echo rand(500, 2000);?>x<?php echo rand(600, 1200);?>" style="width:100%;"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
    
</div>

<div class="modal fade" id="processingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uploading Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b><span class="text-danger" id="errorMsg"></span></b>
            </div>
        </div>
    </div>
</div>

<?php App::buildPageFooter();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script>
    $('#processingModal').modal();
    $('#errorModal').modal();

    // Library container.
    var libraryView = $('#library-view');

    // Store file upload credentials.
    var credentials = [];

    /**
     * Start Dropzone.JS
     */
    $(document).ready(function(){
        var uploader = new Dropzone("div#library-view", {url: '#'});

        uploader.on('dragover', function(e){
            libraryView.css('opacity', '0.25');
        });

        uploader.on('dragleave', function(e){
            libraryView.css('opacity', '1');
        });

        uploader.on('processing', function(file){
            alert('processing: do nothing');
        });

        uploader.on('sending', function(file, xhr, formData){
            var credentials = null;
            $.get("/api.php?signedKey=POST&mime="+file.type, function(data) {
                alert( "uploading to: " + data);
                credentials = JSON.parse(data);
            }).fail(function() {
                alert( "uploading to: nowhere" );
            });
            alert('sending: ' + file.name);
            alert('credentials: ' + credentials);
        });

        uploader.on('queuecomplete', function(e){
            $('#processingModal').modal('hide');
            libraryView.css('opacity', '1');
            alert('upload to: ' + uploader.options.url + ' completed successfully.');
        });

        uploader.on('error', function(file, msg, xhr){
            $('#processingModal').modal('hide');
            $('#errorMsg').text(msg);
            $('#errorModal').modal('show');
        });
    });
</script>
</body>
</html>