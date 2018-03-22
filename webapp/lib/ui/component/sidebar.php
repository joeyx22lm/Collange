<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/home.php"><i class="icon-speedometer"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/library.php"><i class="icon-calculator"></i> Library</a>
            </li>

            <?php
            // Check for active editing sessions.
            $EditingSessions = array(
                array(
                    'sessionId'=>'dskjhf38ysdjkfh45',
                    'imageName'=>'IMG400012.JPG',
                    'events'=>array(
                        array(
                            'title'=>'Resized Image',
                            'history'=>'just now'
                        ),
                        array(
                            'title'=>'Applied Filter',
                            'history'=>'6 mins ago'
                        ),
                        array(
                            'title'=>'Applied Filter',
                            'history'=>'15 mins ago'
                        ),
                        array(
                            'title'=>'Opened Image',
                            'history'=>'42 mins ago'
                        )
                    )
                ),
                array(
                    'sessionId'=>'8965shjfg327r78saf',
                    'imageName'=>'IMG400015.JPG',
                    'events'=>array(
                        array(
                            'title'=>'Opened Image',
                            'history'=>'3 mins ago'
                        )
                    )
                )
            );  // Test data

            if(!empty($EditingSessions)){
                ?>
                <li class="nav-title">
                    Edit Session
                </li>
                <?php
                foreach($EditingSessions as $i=>$Session){

                    // If we are actively within the session, show the most recent events.
                    if(isset($_GET['txId']) && $_GET['txId'] == $Session['sessionId']){
                        ?>
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> <?php echo $Session['imageName'];?></a>
                            <ul class="nav-dropdown-items">
                                <?php
                                foreach($Session['events'] as $j=>$Event){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link no-overflow collange-full-width" href="#"> <?php echo $Event['title'];?> <br /><span class="text-muted"><?php echo $Event['history'];?></span></a>
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
                            <a class="nav-link" href="/transform.php?txId=<?php echo $Session['sessionId'];?>"><i class="icon-puzzle"></i> <?php echo $Session['imageName'];?></a>
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