<?php
/**
 * The following are methods for interacting with Feedback Storage
 * 
 * Feedback Storage is a portion of the $_SESSION array used to store error
 * and feedback messages to the user. This portion is made up of two members
 * of the array:
 *      $_SESSION['feedback_errors']: An array containing error output from
 *                                    the most recently viewed page
 *      $_SESSION['feedback_messages']: An array containing general messages
 *                                      from the most recently viewed page
 * 
 * These arrays are meant to only store errors/messages that have resulted
 * from the processing of the most recently accessed page. As such, when they
 * are retrieved using the provided methods these arrays will be returned to the
 * caller and cleared from the Feedback Storage area.
 * 
 * These arrays should only be accessed using the provided methods sense these
 * methods will take care of any needed house keeping and will provide for a 
 * uniform storage method.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/03/2009
 */

abstract class boris_FeedbackStorage{
    /**
     * Sets the errors array to empty.
     */
    public static function clear_errors(){
        $_SESSION['feedback_errors'] = serialize(array());
    }
    
    /**
     * Indicates if any error messages were generated due to the processing of the
     * previous page.
     *
     * @return True if errors exist, false otherwise
     */
    public static function has_errors(){
        if (empty($_SESSION['feedback_errors'])) return false;
    
        $errors = unserialize($_SESSION['feedback_errors']);
        return !empty($errors);
    }
    
    /**
     * Returns the array of errors that were generated from the previous page.
     *
     * @return An array of error messages
     */
    public static function get_errors(){
        $errors = unserialize($_SESSION['feedback_errors']);
        boris_FeedbackStorage::clear_errors();
        return $errors;
    }
    
    /**
     * Adds a new error message to the array of generated error messages.
     *
     * @param string $new_error
     */
    public static function push_error($new_error){
        $errors = unserialize($_SESSION['feedback_errors']);
        
        if (!is_array($errors)) $errors = array();
        
        $errors[] = $new_error;
        $_SESSION['feedback_errors'] = serialize($errors);
    }
    
    /**
     * Sets the messages array to empty.
     */
    public static function clear_messages(){
        $_SESSION['feedback_messages'] = serialize(array());
    }
    
    /**
     * Indicates if any general messages were generated due to the processing of 
     * the previous page.
     *
     * @return True if messages exist, false otherwise
     */
    public static function has_messages(){
        if (empty($_SESSION['feedback_messages'])) return false;
        
        $messages = unserialize($_SESSION['feedback_messages']);
        return !empty($messages);
    }
    
    /**
     * Returns the array of general messages that were generated from the previous page.
     *
     * @return An array of general messages
     */
    public static function get_messages(){
        $messages = unserialize($_SESSION['feedback_messages']);
        boris_FeedbackStorage::clear_messages();
        return $messages;
    }
    
    /**
     * Adds a new general message to the array of generated messages.
     *
     * @param string $new_message
     */
    public static function push_message($new_message){
        $messages = unserialize($_SESSION['feedback_messages']);
        
        if (!is_array($messages)) $messages = array();
        
        $messages[] = $new_message;
        $_SESSION['feedback_messages'] = serialize($messages);
    }
}
?>