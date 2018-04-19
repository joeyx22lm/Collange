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
        <div class="container-fluid" id="library-view">
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                    foreach(Image::getAll(DBSession::getSession(), array('shared'=>'1')) as $i=>$img){
                        $Image['key'] = $Image['uuid'] . '.'.$Image['ext'];
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
                                    <a class="btn btn-primary" href="#">View Profile</a>
                                    <a class="btn btn-danger" href="#">Report Image</a>
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
<?php App::buildPageFooter();?>
<!-- Custom scripts required by this view -->
<script src="js/views/main.js"></script>
</body>
</html>