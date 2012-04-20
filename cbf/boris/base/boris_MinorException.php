<?php
/**
 * Custom exception class that represents a minor exception during execution.
 * 
 * Minor exceptions would include input validation failures, attempted duplicate database
 * entries, and application check failures.
 * 
 * This exception class allows for multiple messages to be added to the exception instance.
 * 
 * This exception class will always have a code value of 10.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/03/09
 */

class boris_MinorException extends Exception{
	
	private $messages = array();
    
    public function __construct($messages){
    	if (is_array($messages)){
    		$this->messages = $messages;
    		parent::__construct('Multiple Messages.', 10);
    	} else {
    		$this->messages = array($messages);
    		parent::__construct($messages, 10);
    	}
    }

    public function getMessages() {
        return $this->messages;
    }
}
?>