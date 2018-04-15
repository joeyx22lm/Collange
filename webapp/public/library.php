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
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Explore</a>
                    <a class="btn" href="#"><i class="fa fa-upload"></i> &nbsp;Import Photo</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid" id="library-view">
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                    foreach(Image::getAll(DBSession::getSession(), array(
                        'ownerId'=>AuthSession::getUser()->id)) as $Image){
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-1 img-responsive">
                            <image src="https://placehold.it/30x30" style="width:100%;" alt="<?php echo json_encode($Image);?>"/>
                        </div>
                        <?php
                    }
                    ?>
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

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
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
    function blurContainer(container, opacity){
        if(container != undefined){
            container.css('opacity', opacity);
        }
    }
    $(document).ready(function(){
        $('#processingModal').modal();
        $('#errorModal').modal();

        // Library container.
        var libraryView = $('#library-view');

        /**
         * Start Dropzone.JS
         */
        var uploader = new Dropzone("div#library-view", {url: '/api.php?upload'});
        uploader.on('dragover', function(e){
            blurContainer(libraryView, '0.25');
        });
        uploader.on('dragleave', function(e){
            blurContainer(libraryView, '1');
        });

        // Upload complete.
        uploader.on('queuecomplete', function(e){
            $.when(function(){
                $('#processingModal').modal('hide');
                blurContainer(libraryView, '1');
            }).then(function(){
                window.location.reload();
            });
        });
        // Upload error.
        uploader.on('error', function(file, msg, xhr){
            $('#processingModal').modal('hide');
            $('#errorMsg').text(msg);
            $('#errorModal').modal('show');
        });
    });
</script>
</body>
</html>