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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('Transform that image!');?>
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
            <li class="breadcrumb-item"><a href="/library.php">My Library</a></li>
            <li class="breadcrumb-item"><a href="/library.php">Photo Album</a></li>
            <li class="breadcrumb-item active"><?php echo $TransformSession['imageName'];?></li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-graph"></i> &nbsp;Filters</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Properties</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
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
            </div>
            <div class="row">
                <div class="col-lg-12 img-responsive" id="canvas">
                    <img src="https://placehold.it/2300x1268&text=<?php echo urlencode($TransformSession['imageName']);?>" class="img" style="margin: 0 auto;width:100%;padding:15px;"/>
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