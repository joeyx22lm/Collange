<?php
/* MySQL Database Configuration */
require_once('lib/database.php');
DBSession::setSession($_ENV['JAWSDB_MARIA_URL']);

/* User object */
require_once('lib/user.php');

/* Make tests externally runnable */
if(isset($_GET['runTests'])){
    // Import the TestUtility and run its local
    // tests to verify it's working
    require_once('test/testutility.php');

    // Import all tests from the current directory
    // and execute them.
    TestUtility::runAllTests(__DIR__ . '/test');

    // Stop further execution. This protects
    // against using TestUtility in production code.
    die();
}
?>