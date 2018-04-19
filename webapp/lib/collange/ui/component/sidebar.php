<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <?php
            /**
             * Begin Global Sidebar
             */
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/home.php"><i class="icon-speedometer"></i> Explore</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/library.php"><i class="icon-calculator"></i> Library</a>
            </li>


            <?php
            /**
             * Begin Editing Session Sidebar
             */
            if(TransformSessionHandler::isTransforming()){
                ?>
                <li class="nav-title">
                    Opened Images
                </li>
                <?php
                foreach(TransformSessionHandler::getSessions() as $i=>$Session){
                    // If we are actively within the session, show the most recent events.
                    if(isset($_GET['txId']) && $_GET['txId'] == $Session['sessionId']){
                        ?>
                        <li class="nav-item nav-dropdown open">
                            <a class="nav-link nav-dropdown-toggle truncate" href="#"><i class="icon-puzzle"></i> <?php echo $Session['originalImageName'];?></a>
                            <ul class="nav-dropdown-items">
                                <?php
                                foreach(array_reverse($Session['events']) as $j=>$Event){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link no-overflow collange-full-width" href="/transform.php?txId=<?php echo $Session['sessionId'];?>&revisionId=<?php echo $Event['revisionId'];?>"> <?php echo $Event['title'];?> <br /><span class="text-muted"><?php echo DateUtility::getAge($Event['history']);?></span></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }

                    // If we're not actively within the session, just show the simple link.
                    else{
                        ?>
                        <li class="nav-item">
                            <a class="nav-link truncate" href="/transform.php?txId=<?php echo $Session['sessionId'];?>"><i class="icon-puzzle"></i> <?php echo $Session['originalImageName'];?></a>
                        </li>
                        <?php
                    }

                }
            }
            ?>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>