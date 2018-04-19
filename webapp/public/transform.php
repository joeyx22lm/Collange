<?php require_once('../Application.php');?>
<?php AuthSession::protect();




/**
 * Begin Loading Transformation Session
 */
$TransformSession = TransformSessionHandler::getSession(!isset($_GET['txId']) ? null : $_GET['txId']);

// Redirect if invalid transform session.
if(empty($TransformSession)){
    header("Location: /library.php");
    die();
}

// Retrieve image information.
$Image = null;
$cachedURL = null;
foreach(Image::getAll(DBSession::getSession(), array('ownerId'=>AuthSession::getUser()->id, 'uuid'=>$TransformSession['imageUuid'])) as $img){
    $img['key'] = $img['uuid'] . '.' . $img['ext'];
    $Image = $img;
    $cachedURL = S3EphemeralURLHandler::get($Image['key']);
    if ($cachedURL == null) {
        $cachedURL = S3Handler::createSignedGETUrl($Image['key']);
        S3EphemeralURLHandler::set($Image['key'], $cachedURL);
    }
}
if($Image == null || $cachedURL == null){
    header("Location: /library.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('Transform that image!');?>
    <style>
        .bold-typed {
            font-weight:900;
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
            <li class="breadcrumb-item"><a href="/library.php">My Library</a></li>
            <li class="breadcrumb-item active"><?php echo $TransformSession['imageName'];?></li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-graph"></i> &nbsp;Filters
                        </button>
                        <div class="dropdown-menu">
                            <?php
                            foreach(TransformSessionHandler::getFilters() as $filterApiName=>$filterDisplayName){
                            ?>
                                <a class="dropdown-item applyfilter" filter-id="<?php echo $filterApiName;?>"><?php echo $filterDisplayName;?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Properties</a>
                    <?php
                    if(true){
                    ?>
                    <a class="btn bold-typed" href="#"><i class="fa fa-save bold-typed"></i> &nbsp;Save</a>
                    <?php
                    }else{
                    ?>
                    <a class="btn" href="#"><i class="fa fa-save"></i> &nbsp;Save</a>
                    <?php
                    }
                    ?>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <!---<div class="animated fadeIn">
                <div class="card" style="margin:15px;">
                    <div class="card-footer">
                        <ul>
                            <li>
                                <div class="text-muted">Opacity</div>
                                <strong>40%</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="d-none d-md-table-cell">
                                <div class="text-muted">Brightness</div>
                                <strong>20%</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text-muted">Warmth</div>
                                <strong>70%</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text-muted">Zoom</div>
                                <strong>100%</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>--->
            <div class="row">
                <div class="col-lg-12 img-responsive" id="canvas">
                    <img src="<?php echo $cachedURL;?>" class="img" style="margin: 0 auto;width:100%;padding:15px;"/>
                </div>
            </div>
        </div>
    </main>
</div>
<?php App::buildPageFooter();?>
<!-- Custom scripts required by this view -->
<script src="js/views/main.js"></script>
</body>
</html>