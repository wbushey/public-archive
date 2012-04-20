<?php

require_once 'cbf-conf.php';

/*
 * Basic Boris settings
 */
// Full path to the root of the application
$appConf['path'] = '/home/bill/Development/public_html/cbf' . DIRECTORY_SEPARATOR;
// Full URL of the site
$appConf['base_url'] = 'http://localhost/cbf';
// Namespace of the site's files/classes
$appConf['namespace'] = 'cbf';

/*
 * Application Settings
 */
// Full path to the folder that holds all celebrity pictures
$appConf['pics_path'] = $appConf['path'] . 'pics' . DIRECTORY_SEPARATOR;

/*
 * Error/Exception handling settings
 */ 
// If set to true, the error/exception handler will send output to a specified log file
$appConf['output_to_log_file_on_error'] = true;
// Filename of the log file to output error information to
$appConf['error_log_filename'] = 'boris_errors.log';
// Filename of the log file to output exception information to
$appConf['exception_log_filename'] = 'boris_exception.log';
// If set to true, the error/exception handler will send an email to a specified address
$appConf['send_email_on_error'] = true;
// Email address to contact when an error/exception is handled
$appConf['error_email_address'] = 'error@celebritybarfight.com';



/*
 * Advanced Settings
 * There should be no need to edit these settings
 */
// Derive URLs
$appConf['site_url'] = $appConf['base_url'] . '/site/';
$appConf['layout_url'] = $appConf['base_url'] . '/layout/';
$appConf['pics_url'] = $appConf['base_url'] . '/pics/';
$appConf['js_url'] = $appConf['base_url'] . '/js/';

// Derive paths
$appConf['controller_name'] = 'index.php';
$appConf['controller_url'] = $appConf['site_url'] . $appConf['controller_name'];
$appConf['boris_path'] = $appConf['path'] . 'boris' . DIRECTORY_SEPARATOR;
$appConf['vendor_path'] = $appConf['boris_path'] . 'vendor' . DIRECTORY_SEPARATOR;
$appConf['classes_path'] = $appConf['boris_path'] . 'classes' . DIRECTORY_SEPARATOR;
$appConf['logs_path'] = $appConf['path'] . 'logs' . DIRECTORY_SEPARATOR;
$appConf['site_path'] = $appConf['path'] . 'site' . DIRECTORY_SEPARATOR;
$appConf['layout_path'] = $appConf['path'] . 'layout' . DIRECTORY_SEPARATOR;
$appConf['template_path'] = $appConf['path'] . 'templates' . DIRECTORY_SEPARATOR;
$appConf['compiled_template_path'] = $appConf['template_path'] . 'compiled' . DIRECTORY_SEPARATOR;
?>
