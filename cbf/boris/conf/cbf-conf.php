<?php
// This file generated by Propel 1.6.3 convert-conf target
// from XML runtime conf file /home/bill/Development/workspace/cbf/build/dev_machine/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'cbf' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=cbf',
        'user' => 'cbfUser',
        'password' => 'password!!!',
      ),
    ),
    'default' => 'cbf',
  ),
  'generator_version' => '1.6.3',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-cbf-conf.php');
return $conf;
