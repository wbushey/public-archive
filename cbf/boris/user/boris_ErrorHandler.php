<?php
/**
 * The error/exception handler for Boris.
 * 
 * This class extends boris_BaseErrorHandler, which contains definitions for 
 * handle_exception and handle_error. This class is designed to allow for
 * easy customization of the display_error_notice function. It is also possible
 * to use this class to overwrite or extend the handle_exception and handle_error
 * functions.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/03/2009
 */
require 'base/boris_BaseErrorHandler.php';

abstract class boris_ErrorHandler extends boris_BaseErrorHandler{

    /**
     * Function that controls what is displayed to the end user when an error or exception occur.
     * 
     * It is recommended that this function do nothing more than output a simple notice to the user
     * that the site is malfunctioning.
     */
    protected static function display_error_notice(){
        global $appConf;
        echo <<< END_OF_ERROR
<html>
  <head>
    <title>Celebrity Bar Fight - Error</title>
    <style type="text/css">
      body{
        margin: 0px;
        padding: 0px;
        background-color: #f2f2f2;
        font-size: 62.5%;
      }
      
      .content{
        margin: 10px 10%;
        font-size: 1.6em;
      }
      
    </style>
  </head>
  <body>
    <div id="span">
      <div id="masterhead">
        <center><img id="logo" src='{$appConf['layout_url']}/img/cbf_logo.png'/></center>
      </div>
      <div class="content">
        <p>We're sorry, an error has occured that is preventing Celebrity Bar Fight from displaying correctly. The website administrators have been notified of this error and are doing their best to restore the site.</p>
      </div>
    </div>
  </body>
</html>
END_OF_ERROR;
    }
}
?>