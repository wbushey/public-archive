<?php
/**
 * View which allows a user to register for the site.
 * 
 * This is a special case view, it is intended to take on the apperance of other
 * views and therefore will make calls to create and execute portions of top level
 * views (i.e. cbf_AdminView.) The class will determine which view to construct and
 * call based on the value of the URI argument, which indicates what view the user
 * is attempting to access.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/10/2009
 */

class cbf_AddUserView extends boris_View{
    
    private $top_view;          // The top level view that use during output.
    private $uri;               // The requested address the user submitted.
    
    // Post arguments
    public $entered_username;   // Username entered by the user
    public $entered_address;    // Email address entered by the user
    
	public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        // Clear out old registration attempts
        $c = new Criteria();
        $c->add(AwaitingconfirmationPeer::TTD, time(), Criteria::LESS_EQUAL);
        AwaitingconfirmationPeer::doDelete($c);
        
        // Get an instance of the top level view
        $this->uri = $this->get_args['uri'];
        if (!isset($this->uri)) $this->uri = cbf_MainView::getClassViewUrl();
        $this->top_view = boris_ClassLoader::loadClass($this->uri, array(), array());
        $this->setPageTitle();
        
        // Set post arguments
        $this->entered_username = $this->post_args['username'];
        $this->entered_address = $this->post_args['emailAddress'];
    }
    
    public function process_view(){
    	
    	/***********************************************
    	 * Handle parameters
    	 ***********************************************/
    	if (isset($this->post_args['register_submit'])){
    		// Registering a new user
    		
    		try{
    			// First, get the entered values and verify them
				list($new_conf, $new_prof) = $this->set_check_input();
				
				// Create a confirmation number and TTD for 7 days
				$new_conf->setConfirmnum(md5($new_conf->getUsername()));
				$new_conf->setTtd(strtotime("+7 day"));
				
				// Save the Awaiting Objects
				$new_conf->save();
				
				// Send a confirmation email to the user
				AwaitingconfirmationPeer::send_confirmation_email($new_conf);
				
				// Output success message to user
				boris_FeedbackStorage::push_message('An email has been sent to the provided address. Please follow the directions in the email to complete registration.');
    		} catch (boris_MinorException $e){
                // Push the error message and display the input view
                $messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
            }
    		
    	} elseif(isset($this->get_args['id']) && isset($this->get_args['cn'])){
    		// Confirming a registration
    		
    		try{
    			// Get the awaiting objects
    			$awaiting_conf = AwaitingconfirmationPeer::retrieveByPK($this->get_args['id']);
    			if (is_null($awaiting_conf)) throw new boris_MinorException('Invalid ID number provided');
    			$awaiting_prof = $awaiting_conf->getAwaitingprofiles();
    			
    			// Verify the confirmation number.
    			if ($this->get_args['cn'] != $awaiting_conf->getConfirmnum()) throw new boris_MinorException('Incorrect Confirmation Number provided. Registration has not been confirmed.');
    		
    			// Create new Userprofile and fill with information from registration
    			$new_user = new Userprofile();
    			$new_user->setUsername($awaiting_conf->getUsername());
    			$new_user->setPassword($awaiting_conf->getPassword());
    			$new_user->setUsertype(UserProfilePeer::$DEFAULT_USER);	// All users are set to DEFAULT_USER
    			$new_user->setEmailaddress($awaiting_prof->getEmailaddress());
    			$new_user->setIp($_SERVER['REMOTE_ADDR']);
    			
    			// Save the new UserProfile, delete the awaiting objects, and login the user in
    			$new_user->save();
    			$awaiting_conf->delete();
    			$this->user = UserprofilePeer::authenticate($new_user);
            	$_SESSION['user_profile'] = serialize($this->user);
    			
    			// Output success message to user and send redirect
    			boris_FeedbackStorage::push_message('Your registration has been confirmed, thank you. You will be redirected to the main page in a few seconds.');
    			$main_uri = cbf_MainView::getClassViewUrl();
    			header("refresh: 5; $main_uri");
    		} catch (boris_MinorException $e){
    			// Push the error message and display the input view
                $messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);	
    		}
    	}
    	
    	// Output
    	$this->top_view->output_header();  
    	$this->main_template = 'login_addUser.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        $this->top_view->output_footer();
    }
    
    /*
     * Creates Awaiting objects and sets and verifies their values.
     * 
     * If an error occurs during verification then an exception will be thrown.
     * If no errors occur during verification than the Awaiting objects will be returned
     * as an array(AwaitingConfirmation, AwaitingProfiles).
     */
    private function set_check_input(){
    	$errors = array();
    	
    	// Check entered passwords
    	if (empty($this->post_args['password'])) $errors[] = 'You must enter a password';
    	if ($this->post_args['password'] != $this->post_args['confirmPassword']) $errors[] = 'Passwords do not match';
    	

    	// Check email address
    	require_once 'utils/VerifyEmail.php';
		if (!is_valid_email_address($this->post_args['emailAddress'])) $errors[] = "You must provide a valid email address";
    	
		// Create objects
    	$new_conf = new Awaitingconfirmation();
    	$new_prof = new Awaitingprofiles();
    	$new_conf->setUsername($this->post_args['username']);
    	$new_conf->setPassword($this->post_args['password']);
    	$new_prof->setEmailaddress($this->post_args['emailAddress']);
    	$new_conf->setAwaitingprofiles($new_prof);
    	
       	// Propel Validation
    	if (!($new_conf->validate())){
    		foreach($new_conf->getValidationFailures() as $f){
    			$errors[] = $f->getMessage();
    		}
    	}
    	
    	// See if username is already in system
    	$c = new Criteria();
    	$c->add(UserProfilePeer::USERNAME, $new_conf->getUsername(), Criteria::EQUAL);
    	if (UserProfilePeer::doCount($c) > 0){
    		$errors[] = 'Username ' . $new_conf->getUsername() . ' is already registered';
    	}
    	$c = new Criteria();
    	$c->add(AwaitingConfirmationPeer::USERNAME, $new_conf->getUsername(), Criteria::EQUAL);
    	if (AwaitingConfirmationPeer::doCount($c) > 0){
    		$errors[] = 'Username ' . $new_conf->getUsername() . ' is awaiting confirmation. If you registered as ' . $new_conf->getUsername() . ' please follow the instructions provided by email to confirm registration';
    	}
    	
    	// Ban check
    	$ban_result = Bans::isBanned($view->getUser());
	    if ($ban_result[0]){
	    	throw new boris_MinorException($ban_result[1]);
	    }
    	
    	return array($new_conf, $new_prof);
    }
    
    /**
     * Adds " - Login" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        $this->top_view->setPageTitle(" - Register$page_title");
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public function getViewUrl(){
        return cbf_AddUserView::getClassViewUrl();
    }
    
    /**
     * Returns a link to the current instance of the view with a full set of arguments.
     * 
     * An array of the following form may be passed:
     *      $args['argument_name'] => 'argument_value'
     * If an argument exists in the provided array as a key then the associated value
     * will be used when generated the link. Otherwise, the value that generated the current
     * instance of the view, or the default value, will be used.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){
        $args['uri'] = ((array_key_exists('uri', $args)) ? $args['uri'] : $this->uri);
        
        return cbf_AddUserView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns a link to this view with a full set of arguments.
     * 
     * An array of the following form may be passed:
     *      $args['argument_name'] => 'argument_value'
     * If an argument exists in the provided array as a key then the associated value
     * will be used when generated the link. Otherwise, a default value will be used.
     *
     * @param array $args
     * @return unknown
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_AddUserView::getClassViewUrl();
        
        if (count($args) > 0){ 
            $url .= '?';
            // Set needed defaults
            $args['uri'] = ((array_key_exists('uri', $args)) ? $args['uri'] : '/main');
                
            // Build the string
            $arg = each($args);
            $url .= $arg['key'] . '=' . $arg['value'];
            while ($arg = each($args)){
                $url .= '&' . $arg['key'] . '=' . $arg['value'];
            }
        }
       
        return $url;
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */   
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/login/addUser';
    }
}
?>