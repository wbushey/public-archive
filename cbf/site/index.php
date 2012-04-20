<?php
/**
 * Controller for Boris.
 * 
 * This page directs incoming requests to their appropriate destinations,
 * establishes configuration settings and handles uncaught exceptions.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/03/09
 */

// Bring in all the configuration settings.
require '../boris/conf/config.php';

// Setup the include path
set_include_path($appConf['boris_path'] . PATH_SEPARATOR . get_include_path());
set_include_path($appConf['site_path'] . PATH_SEPARATOR . get_include_path());
set_include_path($appConf['classes_path'] . PATH_SEPARATOR . get_include_path());
set_include_path($appConf['vendor_path'] . PATH_SEPARATOR . get_include_path());

// Initalize Propel
require 'propel/runtime/lib/Propel.php';
Propel::init("conf/cbf-conf.php");

// Requires
require 'user/boris_View.php';
require 'user/boris_ClassLoader.php';
require 'base/boris_MinorException.php';
require 'user/boris_ErrorHandler.php';
require 'utils/Bans.php';

// Add the autoload callback
spl_autoload_register('boris_ClassLoader::autoload');

// Register error handler
set_error_handler("boris_ErrorHandler::handle_error");

// Create a session
session_start();

// Start processing the destination view
try{    
    $view = boris_ClassLoader::loadClass($_SERVER['REQUEST_URI'], $_GET, $_POST);    
    $view->process_view();
} catch (Exception $e){
    if ($e->getCode() == 404){
        // This is a page not found exception, so send a 404 header
        header('HTTP/1.0 404 Not Found');
        echo $e->getMessage();
    } else {
        boris_ErrorHandler::handle_exception($e);
    }
}

?>
