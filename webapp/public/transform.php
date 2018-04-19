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

// Retrieve the current revision.
$Revision = null;
foreach(array_reverse($TransformSession['events']) as $i=>$Event){
    if(!isset($_GET['revisionId'])){
        $Revision = $Event;
        break;
    }else if($Event['revisionId'] == $_GET['revisionId']){
        $Revision = $Event;
        break;
    }
}
if($Revision == null){
    header("Location: /library.php");
    die();
}


// Retrieve image information.
$ImageURL = 'https://placehold.it/1000x500?text=Applying+Filter';
$EventUUID = null;

// Check if we're awaiting a filter process.
if(!empty($Revision['EventUUID'])){
    $EventUUID = $Revision['EventUUID'];
}

// Check if this is a saved image.
else if(!empty($Revision['imageUuid'])){
    $Image = null;
    foreach(Image::getAll(DBSession::getSession(), array('ownerId'=>AuthSession::getUser()->id, 'uuid'=>$Revision['imageUuid'])) as $img){
        $img['key'] = $img['uuid'] . '.' . $img['ext'];
        $Image = $img;
        $ImageURL = S3EphemeralURLHandler::get($Image['key']);
        if ($ImageURL == null) {
            $ImageURL = S3Handler::createSignedGETUrl($Image['key']);
            S3EphemeralURLHandler::set($Image['key'], $ImageURL);
        }
    }
    if($Image == null || $ImageURL == null){
        header("Location: /library.php");
        die();
    }
}

// Check if this filter has been applied, but not saved.
else if(!empty($Revision['key'])) {
    $ImageURL = S3EphemeralURLHandler::get($Revision['key']);
    if ($ImageURL == null) {
        $ImageURL = S3Handler::createSignedGETUrl($Revision['key']);
        S3EphemeralURLHandler::set($Revision['key'], $ImageURL);
    }
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
        .centered-body {
            text-align:center;
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
                    // If current revision not saved, show bold-typed save button.
                    if(!empty($Revision['key'])){
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
                    <?php
                    $class = 'img';
                    if(!empty($Revision['EventUUID'])) {
                        $class .= ' lazy-ajax';
                    }
                    ?>
                    <img id="imagecontainer" src="<?php echo $ImageURL;?>" class="<?php echo $class;?>" style="margin: 0 auto;width:100%;padding:15px;"/>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="filteringModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalTitle">Applying Filter</h5>
            </div>
            <div class="modal-body centered-body">
                <i class="fa fa-spinner fa-spin" style="font-size:38px;margin-bottom:10px;"></i><br />
                <p id="filterStatus">Queueing your filter request</p>
            </div>
        </div>
    </div>
</div>

<?php App::buildPageFooter();?>

<script>
    var revision = {
      sessionId: '<?php echo $TransformSession['sessionId'];?>',
      revisionId: '<?php echo $Revision['revisionId'];?>',
      imageUuid: '<?php echo $Revision['imageUuid'];?>',
      imageKey: '<?php echo $Revision['key'];?>',
      eventUuid: '<?php echo $Revision['EventUUID'];?>'
    };
    $(document).ready(function(){
        var filterProcessAjax = null;
        var filterStatus = $('#filterStatus');
        $('.applyfilter[filter-id!=""]').click(function(){
            $('#filteringModal').modal({show: true});
            $('#filterModalTitle').html('Applying Filter: <b>' + $(this).text() + '</b>');
        });
        $('.applyfilter[filter-id!=""]').click(function(){
            var filter = $(this).attr('filter-id');
            var sessionId = '<?php echo $TransformSession['sessionId'];?>';
            var revisionId = '<?php echo $Revision['revisionId'];?>';
            var imageUuid = '<?php echo $Image['uuid'];?>';
            var api = '/api.php?filter='+encodeURIComponent(filter);
            api += '&image='+encodeURIComponent(imageUuid);
            api += '&key='+encodeURIComponent(revision.imageKey);
            api += '&revisionId='+encodeURIComponent(revisionId);
            api += '&txId='+encodeURIComponent(sessionId);

            $.getJSON(api, function(response) {
                console.log('Filter.response:');
                console.log(response);
                filterStatus.text('Filter request has been queued for processing.');
                if(response.EventUUID != ''){
                    revision.eventUuid = response.EventUUID;
                    revision.revisionId = response.revisionId;
                    var url = '/api.php?loadEventUUID='+encodeURIComponent(response.EventUUID)+'&txId=<?php echo $TransformSession['sessionId'];?>';
                    filterProcessAjax = setInterval(function(){
                        $.getJSON(url, function(resp){
                            if(resp != undefined){
                                clearInterval(filterProcessAjax);
                                window.location.href = '/transform.php?txId=<?php echo $TransformSession['sessionId'];?>&revisionId='+response.revisionId;
                            }
                        });
                    }, 3000);
                }
            });
        });
    });
</script>
</body>
</html>