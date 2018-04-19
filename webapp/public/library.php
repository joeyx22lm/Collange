<?php require_once('../Application.php');?>
<?php AuthSession::protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('My Library');?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css"/>
    <style>
        .lazy {
            opacity: 0;
        }
        .dropzone {
            width:100%;
            height:100%;
            border: 2px dashed #0087F7;
        }
        .dz-message {
            font-weight:400;
        }
    </style>
</head>
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
                    <a class="btn" href="#" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"></i> &nbsp;Import Photos</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid" id="library-view">
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                    $imageCount = 0;
                    $imageQuery = array('ownerId'=>AuthSession::getUser()->id);
                    foreach(Image::getAll(DBSession::getSession(), $imageQuery) as $Image){
                        $imageCount++;
                        $Image['key'] = $Image['uuid'] . '_thumb.'.$Image['ext'];
                        $cachedURL = S3EphemeralURLHandler::get($Image['key']);
                        if($cachedURL == null){
                            $cachedURL = S3Handler::createSignedGETUrl($Image['key']);
                            S3EphemeralURLHandler::set($Image['key'], $cachedURL);
                        }
                        ?>
                        <div class="library-card card col-lg-3 col-md-4 col-sm-6 col-xs-1" style="padding:0px;">
                            <img attr-lazysrc="<?php echo $cachedURL;?>" class="card-img-top library-image lazy" alt="<?php echo $Image['fileName'];?>"/>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $Image['fileName'];?></h5>
                                <p class="card-text"><?php echo $Image['caption'];?></p>
                                <div class="btn-group" role="group" aria-label="Image Options" style="width:100%;">
                                    <a class="btn btn-primary" href="/api.php?edit=<?php echo $Image['uuid'];?>">Edit Image</a>
                                    <?php
                                    if($Image['shared'] == 1){
                                    ?>
                                    <a class="btn btn-success" href="/api.php?sharing=<?php echo $Image['uuid'];?>">Public Access</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-warning" href="/api.php?sharing=<?php echo $Image['uuid'];?>">No Public Access</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-danger" image-uuid="<?php echo $Image['uuid'];?>" href="#">Delete Image</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalTitle">Import from your computer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/api.php?upload" id="upload-form" class="dropzone needsclick dz-clickable">
                    <div class="dz-message">
                        Drop files here or click to upload.
                    </div>
                </div>
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
                <b><span class="text-danger">An unexpected error occurred while uploading your image.</span></b>
            </div>
        </div>
    </div>
</div>


<?php App::buildPageFooter();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script>
    $(document).ready(function(){
        <?php if($imageCount == 0){ ?>
        /**
         * Initialize the upload modal if no images
         * exist in the user's library.
         */
        $('#uploadModal').modal({show: true});
        <?php } ?>

        /**
         * Lazy-load all of the images.
         */
        var libraryView = $('#library-view');
        libraryView.find('img[attr-lazysrc]').each(function(index){
            $(this).attr('src', $(this).attr('attr-lazysrc')).removeClass('lazy');
        });

        /**
        * Deletion event listener
        */
        $('.deleteimage').click(function(){
            var imageUuid = $(this).attr('image-uuid');
            if(imageUuid != undefined){

            }
        });
    });
</script>
</body>
</html>