<?php require_once('../Application.php');?>
<?php AuthSession::protect();
if(!isset($_GET['user'])){
    header("Location: /home.php");
    die();
}
$UserQ = DBSession::getSession()->query("SELECT * FROM `user` WHERE `uuid`='$_GET[user]'");
$User = null;
$Images = array();
if($UserQ != null && $UserQ->num_rows > 0) {
    $User = $UserQ->fetch_array();
}
if(empty($User)){
    header("Location: /home.php");
    die();
}

$ImagesQ = DBSession::getSession()->query("SELECT * FROM `image` WHERE `ownerId`='$User[id]' AND `shared`='1'");
if($ImagesQ != null && $ImagesQ->num_rows > 0) {
    while($Image = $ImagesQ->fetch_array()) {
        $Images[] = $Image;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php App::buildHtmlHead('Dashboard');?>
</head>
<body class="app header-fixed sidebar-fixed">
<?php echo App::buildPageNavbar();?>
<div class="app-body">
    <?php App::buildPageSidebar();?>

    <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Profile</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-speech"></i></a>
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid" id="explore-view">
            <div class="animated fadeIn">
                <div class="row">

                    <div style="text-align: center; float: none; margin: 0 auto;" class="library-card card col-lg-6 col-md-6 col-sm-6">
                        <div style="margin-top: 10px;">
                            <h5 style=""><?php echo $User['firstName'] . ' ' . $User['lastName'];?></h5>
                            <p>My personal caption</p>
                        </div>
                    </div>
					<?php
	                    foreach($Images as $i=>$Image){
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
<script>
    $(document).ready(function(){
        /**
         * Lazy-load all of the images.
         */
        $('img[attr-lazysrc]').each(function(index){
            $(this).attr('src', $(this).attr('attr-lazysrc')).removeClass('lazy');
        });
    });
</script>
</body>
</html>