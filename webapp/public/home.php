<?php require_once('../Application.php');?>
<?php AuthSession::protect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('Dashboard');?>
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

    <?php Image::getAll(array(‘shared’ =>‘1’));?>

    <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-speech"></i></a>
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>

        <div class="row">
                    <div class="col-lg-3 col-md-6 col-xs-12 img-responsive" style="padding: 25px 25px 25px 25px">
                        <img src="https://placehold.it/300x300" class="img-responsive" style="width:100%">
                    </div>
                    <div class="col-lg-3 col-md-6 col-xs-12 img-responsive" style="padding: 25px 25px 25px 25px">
                        <img src="https://placehold.it/300x300" class="img-responsive" style="width:100%">
                    </div>
                    <div class="col-lg-3 col-md-6 col-xs-12 img-responsive"  style="padding: 25px 25px 25px 25px">
                        <img src="https://placehold.it/300x300" class="img-responsive" style="width:100%">
                    </div>
                    <div class="col-lg-3 col-md-6 col-xs-12 img-responsive"  style="padding: 25px 25px 25px 25px">
                        <img src="https://placehold.it/300x300" class="img-responsive" style="width:100%">
                    </div>
                </div>
    </main>
</div>
<?php App::buildPageFooter();?>
<!-- Custom scripts required by this view -->
<script src="js/views/main.js"></script>
</body>
</html>