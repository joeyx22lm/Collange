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
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
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
    <aside class="aside-menu">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
                    <small><b>Today</b></small>
                </div>
                <hr class="transparent mx-3 my-0">
                <div class="callout callout-warning m-0 py-3">
                    <div class="avatar float-right">
                        <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Meeting with
                        <strong>Lucas</strong>
                    </div>
                    <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
                </div>
                <hr class="mx-3 my-0">
                <div class="callout callout-info m-0 py-3">
                    <div class="avatar float-right">
                        <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Skype with
                        <strong>Megan</strong>
                    </div>
                    <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                    <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line </small>
                </div>
                <hr class="transparent mx-3 my-0">
                <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
                    <small><b>Tomorrow</b></small>
                </div>
                <hr class="transparent mx-3 my-0">
                <div class="callout callout-danger m-0 py-3">
                    <div>New UI Project -
                        <strong>deadline</strong>
                    </div>
                    <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
                    <div class="avatars-stack mt-2">
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="mx-3 my-0">
                <div class="callout callout-success m-0 py-3">
                    <div>
                        <strong>#10 Startups.Garden</strong> Meetup
                    </div>
                    <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
                </div>
                <hr class="mx-3 my-0">
                <div class="callout callout-primary m-0 py-3">
                    <div>
                        <strong>Team meeting</strong>
                    </div>
                    <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
                    <div class="avatars-stack mt-2">
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="mx-3 my-0">
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="avatar">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="avatar">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="avatar">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="avatar">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="avatar">
                            <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="aside-options">
                    <div class="clearfix mt-4">
                        <small><b>Option 1</b></small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                    </div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <small><b>Option 2</b></small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div>
                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                    </div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <small><b>Option 3</b></small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <small><b>Option 4</b></small>
                        <label class="switch switch-text switch-pill switch-success switch-sm float-right">
                            <input type="checkbox" class="switch-input" checked="">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4">
                    <small><b>CPU Usage</b></small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2">
                    <small><b>Memory Usage</b></small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2">
                    <small><b>SSD 1 Usage</b></small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2">
                    <small><b>SSD 2 Usage</b></small>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted">25GB/256GB</small>
            </div>
        </div>
    </aside>
</div>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php App::buildPageFooter();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<script>
    /**
     * Start Dropzone.JS
     */
    $(document).ready(function(){
        var libraryView = $('#library-view');
        var uploader = new Dropzone("div#library-view", { url: "/file/post"});

        uploader.on('dragover', function(e){
            libraryView.css('opacity', '0.25');
        });
        uploader.on('dragleave', function(e){
            libraryView.css('opacity', '1');
        });
    });
</script>
</body>
</html>