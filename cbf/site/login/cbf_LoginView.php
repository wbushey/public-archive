<?php
/**
 * View which allows a user to login.
 * 
 * This is a special case view, it is intended to take on the apperance of other
 * views and therefore will make calls to create and execute portions of top level
 * views (i.e. cbf_AdminView.) The class will determine which view to construct and
 * call based on the value of the URI argument, which indicates what view the user
 * is attempting to access which requires that he be logged in.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 12/27/2008
 */

class cbf_LoginView extends boris_View{
    
    private $top_view;          // The top level view that use during output.
    private $uri;               // The requested address the user submitted.
    public $lost_password_url;	// URL to the view that handles lost passwords
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        // Get an instance of the top level view
        $this->uri = $this->get_args['uri'];
        if (!isset($this->uri)) $this->uri = cbf_MainView::getClassViewUrl();
        $this->top_view = boris_ClassLoader::loadClass($this->uri, array(), array());
        $this->setPageTitle();
        $this->lost_password_url = cbf_NewPasswordView::getClassViewUrl($this->uri);
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        
    	// Handle Login attempt
        if (isset($this->post_args['login_submit'])){
            $this->user->setUsername($this->post_args['username']);
            $this->user->setPassword($this->post_args['password']);
            $this->user->setIp($_SERVER['REMOTE_ADDR']);
            
            try {
            	$this->user = UserprofilePeer::authenticate($this->user);
            	$_SESSION['user_profile'] = serialize($this->user);
            	header("Location: $this->uri");
            	return 0;
            } catch (boris_MinorException $e){
                // Push the error message and display the input view
                $messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
            }
        }
    	
        // Output
        $this->top_view->output_header();        
        $this->main_template = 'login_login.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        $this->top_view->output_footer();
    }

    /**
     * Adds " - Login" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        $this->top_view->setPageTitle(" - Login$page_title");
    }

    /**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_LoginView::getClassViewUrl();
    }
    
    /**
     * Returns a link to the current instance of the view with a full set of arguments.
     * 
     * The default action of the function is to use the argument values used to retrieve the current instance 
     * of the page when creating the returned URL. However, these values can be overwritten by providing 
     * argument_name => argument_value pairs to the function via the $args array.
     * 
     * See getClassAugViewUrl() for a list of arguments.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){
        $args['uri'] = ((array_key_exists('uri', $args)) ? $args['uri'] : $this->uri);
        
        return cbf_LoginView::getClassAugViewUrl($args);
    }
    

    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */   
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/login';
    }
    
    /**
	 * Returns the URL for this class augmented with GET arguments.
	 * The GET arguments can be set by providing an associative array of the form
	 * 			$args['argument_name'] => 'argument_value'
	 * 
	 * Arguments for this view are:
	 * 		'uri' - The uri to redirect to after logging in.
	 * 
	 * @param array $args
	 * @return string
	 */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_LoginView::getClassViewUrl();
            
        // Build the string
        $url = parent::build_augmented_url($url, $args);
       
        return $url;
    }
}
?>