<?php
/**
 * The error/exception handler for Boris.
 * 
 * This class provides functions intented for exception and error
 * handling at the index.php level, i.e. any exceptions that have 
 * not been caught by the application or any errors thrown by PHP.
 * 
 * Both the exception handler and the error handler perform the following:
 *      Write information to a log file concerning the exception/error
 *      Send an email to the address specified in config.php
 *      Display a simple page to the user indicating that an error has occured
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/03/2009
 */

abstract class boris_BaseErrorHandler{
    
    /**
     * Exception handler for Boris.
     *
     * @param Exception $e
     */
    public static function handle_exception(Exception $e){
        global $appConf;
        
        // Set the time of the exception
        $e_ts = time();
        $time_string = 'on ' . date('D, F jS Y', $e_ts) . ' at ' . date('g:i:sa T', $e_ts);
        
        // Log the exception
        boris_ErrorHandler::output_log($e, $time_string);
        
        // Email the site admin
        boris_ErrorHandler::send_email($e, $time_string);
        
        // Display an error message to the uer
        boris_ErrorHAndler::display_error_notice();
    }
    
    /**
     * Error handler for Boris.
     * 
     * This error handler only handles errors of the following level:
     *      E_ERROR
     *      E_WARNING
     *      E_PARSE
     *      E_CORE_ERROR
     *      E_CORE_WARNING
     *      E_COMPILE_ERROR
     *      E_COMPILE_WARNING
     *      E_RECOVERABLE_ERROR
     *
     * @param unknown_type $errno
     * @param unknown_type $errmsg
     * @param unknown_type $filename
     * @param unknown_type $linenum
     * @param unknown_type $vars
     */
    public static function handle_error($errno, $errmsg, $filename, $linenum, $vars){
        global $appConf;
        
        // Set the error levels to handle
        $e_levels = array(E_ERROR, E_WARNING, E_PARSE,
                             E_CORE_ERROR, E_CORE_WARNING, 
                             E_COMPILE_ERROR, E_COMPILE_WARNING,
                             E_RECOVERABLE_ERROR);
        if (!in_array($errno, $e_levels)) return 0;
        
        // Set the time of the error
        $e_ts = time();
        $time_string = 'on ' . date('D, F jS Y', $e_ts) . ' at ' . date('g:i:sa T', $e_ts);
        
        $e = new boris_Error($errno, $errmsg, $filename, $linenum, $vars);
        
        // Log the exception
        boris_ErrorHandler::output_log($e, $time_string);
        
        // Email the site admin
        boris_ErrorHandler::send_email($e, $time_string);
        
        // Display an error message to the uer
        boris_ErrorHAndler::display_error_notice();
        
        // Errors don't halt execution, so do that here
        exit();
    }
    
    //protected abstract static function display_error_notice();
    
    /**
     * Sends an email to the address specified by $appConf['error_email_address'].
     *
     * @param mixed $e - The error/exception that is being handled
     * @param string $time_string - A formated string representation of the time that the error/exception occured
     */
    private static function send_email($e, $time_string){
        global $appConf;
        
        if ($appConf['send_email_on_error'] != true) return;
        
        // Set email headers
        $headers = "From: Error Handler" . "\r\n" .
                        'Content-Type: text/html; charset=iso-8859-1';
        
        /*
         * Write and send the email
         */
        if ($e instanceof Exception){
            $emailBody = <<<END_OF_EMAIL
                An exception was thrown at $time_string.<br/>
                File: {$e->getFile()}<br/>
                Code: {$e->getCode()}<br/>
                Message: {$e->getMessage()}<br/>
END_OF_EMAIL;
            mail($appConf['error_email_address'], "Exception at " . $time_string, $emailBody, $headers);
        } else {
            $emailBody = <<<END_OF_EMAIL
                An error occured at $time_string.<br/>
                File: {$e->getFile()}<br/>
                Error Number: {$e->getCode()} ({$e->getCodeString()})<br/>
                Message: {$e->getMessage()}<br/>
END_OF_EMAIL;
            mail($appConf['error_email_address'], "Error at " . $time_string, $emailBody, $headers);
        }
        
    }
    
    /**
     * Writes output to the log files specified by $appConf['exception_log_filename'] and $appConf['error_log_filename'].
     *
     * @param mixed $e - The error/exception that is being handled
     * @param string $time_string - A formated string representation of the time that the error/exception occured
     */
    private static function output_log($e, $time_string){
        global $appConf;
        
        if (!(($e instanceof Exception) || ($e instanceof boris_Error))) return;
        if ($appConf['output_to_log_file_on_error'] != true) return;
        
        
        // Open file and write heading
        if ($e instanceof Exception) $log = fopen($appConf['logs_path'] . $appConf['exception_log_filename'], 'a');
        else $log = fopen($appConf['logs_path'] . $appConf['error_log_filename'], 'a');
        fwrite($log, "--------------------------------------------------------------------------------\n");
        if ($e instanceof Exception) fwrite($log, 'Exception Thrown ');
        else fwrite($log, 'Error Occured ');
        fwrite($log, $time_string ."\n");
        
        // Output error code
        if ($e instanceof Exception) fwrite($log, "\tCode:\t\t " . $e->getCode());
        else fwrite($log, "\tError Number:\t " . $e->getCode() . "(" . $e->getCodeString() . ")");
        fwrite($log, "\n");
        
        // Output message, file and line number
        fwrite($log, "\tMessage:\t " . $e->getMessage() . "\n");
        fwrite($log, "\tFile:\t\t " . $e->getFile() . "\n");
        fwrite($log, "\tLine:\t\t " . $e->getLine() . "\n");
        fwrite($log, "\n");
        
        if ($e instanceof Exception){
            // Output the exception trace
            fwrite($log, "\tBegin Trace\n");
            $t = $e->getTrace();
            foreach($t as $tl){
                // Prepare the arguments string
                $arg_string = print_r($tl['args'], true);
                $arg_string = preg_replace('/\n/', "\n\t\t\t", $arg_string);
                $arg_string = "\t\t\t" . $arg_string;
                
                
                // Write the trace line
                fwrite($log, "\t------------------------------------------------------------------------\n");
                fwrite($log, "\tFile:\t\t " . $tl['file'] . "\n");
                fwrite($log, "\tLine:\t\t " . $tl['line'] . "\n");
                fwrite($log, "\tFunction:\t " . $tl['class'] . $tl['type'] . $tl['function'] . "\n");
                fwrite($log, "\tArguments:\n");
                fwrite($log, $arg_string . "\n");
                fwrite($log, "\t------------------------------------------------------------------------\n");
            }
            fwrite($log, "\tEnd Trace\n");
        } else {
            // Output the var dump
            fwrite($log, "\tBegin Variable Dump\n");
            
            // Prepare the variables string
            $var_string = print_r($e->getVars(), true);
            $var_string = preg_replace('/\n/', "\n\t\t\t", $var_string);
            $var_string = "\t\t\t" . $var_string;
            fwrite($log, $var_string . "\n");
            fwrite($log, "\tEnd Variable Dump\n");
        }
        
        // Print footing and close
        fwrite($log, "--------------------------------------------------------------------------------\n");
        fwrite($log, "################################################################################\n");
        fclose($log);
    }
}

/**
 * Simple class that stores information about an error in a manner similar to Exception.
 *
 * The standard Exception functions are used as follows:
 *  getCode     -- Returns the error number
 *  getMessage  -- Returns the error message
 *  getFile     -- Returns the file that caused the error
 *  getLine     -- Returns the line number of the error
 * 
 * Two addition functions are:
 *  getCodeString   -- Returns a string describing the code level
 *  getVars         -- Returns the variable dump of the error
 * 
 * This class is used to simplify the error handling output functions above
 */
class boris_Error{
    private $errno;
    private $errmsg;
    private $filename;
    private $linenum;
    private $vars;
    
    // Error string lookup array. Taken from http://us2.php.net/manual/en/errorfunc.examples.php
    private $errortype = array (
                E_ERROR              => 'Error',
                E_WARNING            => 'Warning',
                E_PARSE              => 'Parsing Error',
                E_NOTICE             => 'Notice',
                E_CORE_ERROR         => 'Core Error',
                E_CORE_WARNING       => 'Core Warning',
                E_COMPILE_ERROR      => 'Compile Error',
                E_COMPILE_WARNING    => 'Compile Warning',
                E_USER_ERROR         => 'User Error',
                E_USER_WARNING       => 'User Warning',
                E_USER_NOTICE        => 'User Notice',
                E_STRICT             => 'Runtime Notice',
                E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
                );
    
    public function __construct($errno, $errmsg, $filename, $linenum, $vars){
        $this->errno = $errno;
        $this->errmsg = $errmsg;
        $this->filename = $filename;
        $this->linenum = $linenum;
        $this->vars = $vars;
    }
    
    public function getCode(){
        return $this->errno;
    }
    
    public function getCodeString(){
        return $this->errortype[$this->errno];
    }
    
    public function getMessage(){
        return $this->errmsg;
    }
    
    public function getFile(){
        return $this->filename;
    }
    
    public function getLine(){
        return $this->linenum;
    }
    
    public function getVars(){
        return $this->vars;
    }
}
?>
