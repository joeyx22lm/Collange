<?php
require_once(__DIR__ . '/lib/joeyx22lm/PHPLoader.php');



/**
 * Catalog all application dependencies.
 */
PHPLoader::initModule(array(
    // Open Source Library to handle logging.
    'com.joeyx22lm.jolib-php:Log'    =>__DIR__ . '/lib/joeyx22lm/Log.php',
    // Open Source Library to handle unit test execution.
    'com.joeyx22lm.jolib-php:TestUtility'       =>__DIR__ . '/lib/joeyx22lm/TestUtility.php',
    // Open Source Library to generate unique strings per UUID v4 standard.
    'com.joeyx22lm.jolib-php:UUID'              =>__DIR__ . '/lib/joeyx22lm/UUID.php',
    // Open Source Library to handle database session.
    'com.joeyx22lm.jolib-php:DBSession'         => __DIR__ . '/lib/joeyx22lm/DBSession.php',
    // Open Source Library to handle static resources.
    'com.joeyx22lm.jolib-php:StaticResource'    =>__DIR__ . '/lib/joeyx22lm/StaticResource.php',

    // Collange Project - Database Object - Image Table.
    'collange:dao:Image'                        =>__DIR__ . '/lib/collange/dao/image.php',
    // Collange Project - Database Object - User Table.
    'collange:dao:User'                         =>__DIR__ . '/lib/collange/dao/user.php',
    // Collange Project - Application UI Functionality.
    'collange:CollangeUI'                       =>__DIR__ . '/lib/collange/CollangeUI.php',
    // Collange Project - User Authentication / Session Management.
    'collange:AuthSession'                      =>__DIR__ . '/lib/collange/AuthSession.php',
    // Collange Project - Image Transformation Functionality.
    'collange:TransformSessionHandler'          =>__DIR__ . '/lib/collange/TransformSessionHandler.php',
    // Collange Project - Amazon S3 Functionality.
    'collange:S3Handler'                        =>__DIR__ . '/lib/collange/S3Handler.php'
));


/**
 * Initialize all globally required dependencies.
 */
PHPLoader::loadModule(array(
    'com.joeyx22lm.jolib-php:Log',
    'com.joeyx22lm.jolib-php:UUID',
    'com.joeyx22lm.jolib-php:DBSession',
    'com.joeyx22lm.jolib-php:StaticResource',
    'collange:dao:Image',
    'collange:dao:User',
    'collange:CollangeUI',
    'collange:AuthSession',
    'collange:TransformSessionHandler'
));



/**
 * Collange - Load all global static resources.
 */
StaticResource::set(array(
    'APP_TITLE'=>'Collange',
    'ENV_AWS_S3_BUCKET'=>$_ENV['AWS_S3_BUCKET'],
    'ENV_AWS_KEY'=>$_ENV['AWS_KEY'],
    'ENV_AWS_SECRET'=>$_ENV['AWS_SECRET'],
    'upload_allowed_types'=>array('gif','png' ,'jpg'),
    'error_api_upload_maxsize'=>'Your image must not exceed 10Mb.',
    'error_api_upload_filetype'=>'Your image must be a GIF, PNG or JPG.',
    'error_api_upload_unknown'=>'An unexpected error occurred while uploading your image.'
));



/**
 * Collange - Initialize Database Session.
 */
DBSession::setSession($_ENV['JAWSDB_MARIA_URL']);



/**
 * UNIT TEST RUNNER
 */
/* Make tests externally runnable */
if(isset($_GET['runTests']) || sizeof($argv) > 1 && strtolower($argv[1]) == 'test'){
    // Import the TestUtility and run its local
    // tests to verify it's working
    PHPLoader::loadModule('com.joeyx22lm.jolib-php:TestUtility');

    // Import all tests from the current directory
    // and execute them.
    TestUtility::runAllTests(__DIR__ . '/test');

    // Stop further execution. This protects
    // against using TestUtility in production code.
    die();
}
?>