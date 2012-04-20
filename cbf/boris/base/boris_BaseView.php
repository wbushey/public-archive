<?php
/**
 * This is the foundation view class for all other views in the Boris framework.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 01/10/2009
 */

// Import the Flexy template system 
require 'HTML/Template/Flexy.php';
require 'HTML/Template/Flexy/Element.php';

// Import Feedback and State Storage
require 'base/boris_FeedbackStorage.php';

abstract class boris_BaseView{
    /*
     * Each page is broken down into three portions, the header, main, and footer. The
     * header and footer maybe either templates or other boris_View objects, but the 
     * main_template must be a template.
     */
    protected $header = null;       // Display the masterhead portion of a page
    protected $main_template;       // Template for the content of the page
    protected $footer = null;       // Display the bottom portion of a page
    
    public $page_title;             // Title of the page
    public $javascripts = array();  // Any external javascripts to include
    
    protected $get_args = array();  // Holds the arguments passed to a page via URL
    protected $post_args = array(); // Holds the arguments passed to a page via form elements
    
    protected $flexy_handle;        // Handle to the Flexy output system
    protected $flexy_form_elements  // Storage for form elements used by templates
                = array(); 
    
    public $user;                   // The user's account object
    protected $required_type;		// Indicates the required minimum level to see the view.
    
    protected $redirecting;         // Indicates if the view is redirecting the user instread of displaying
    
    /*
     * The following variables provide an interface for the templates to access the 
     * information stored in the Feedback Storage system.
     */
    public $hasErrors = false;      // Indicates if the previous page generated errors
    public $errors = array();       // The errors that the previous page generated
    public $hasMessages = false;    // Indicates if the previous page generated messages
    public $messages = array();     // The messages that the previous page generated
    
    /**
     * Constructor
     * 
     * Initializes the user's state and the Flexy system.
     *
     * @access public
     */
    public function __construct(array $get_args, array $post_args){
        global $appConf;
        
        $this->get_args = $get_args;
        $this->post_args = $post_args;
        
        // Initial Flexy
        $options = array(
            'templateDir' => $appConf['template_path'],
            'compileDir' => $appConf['compiled_template_path'],
            'forceCompile' => 0,
            'debug' => 0,
            'locale' => 'en',
            'compiler' => 'Standard'
        );
        $this->flexy_handle = new HTML_Template_Flexy($options);
        
        // Get the user object out of the session.
        $this->user = unserialize($_SESSION['user_profile']);
        if ((is_null($this->user) || !is_object($this->user) 
                || !($this->user instanceof Userprofile))) 
            $this->user = new Userprofile();
        $this->required_type = UserprofilePeer::$DEFAULT_USER;
            
        // Initalize to a non-redirecting view
        $this->redirecting = false;
    }
    
    /**
     * Initiates and controls the output process.
     */
    abstract public function process_view();
    
    /**
     * Prints out he header associated with the current view.
     * 
     * The function will choose the proper method for outputing the header, either
     * by using the header's process_view method if the header is a boris_View object,
     * or by compiling and outputing if the header is a template.
     *
     */
    protected function output_header(){
        if (is_null($this->header)) throw new Exception('Error - Header is NULL');
        
        // 
        
        if (is_object($this->header) && ($this->header instanceof boris_View)){
            $this->header->process_view();
            return;
        }
        
        if (is_string($this->header)){
            if (file_exists($this->flexy_handle->options['templateDir'][0] . $this->header)){
                $this->setFeedback();
                $this->flexy_handle->compile($this->header);
                $this->flexy_handle->outputObject($this);
                return;
            } else {
                throw new Exception('Error - Header template ' . $this->header . ' not found.');
            }
        }
        
        throw new Exception('Error - Unknown Header type.');
    }
    
    /**
     * Prints out he footer associated with the current view.
     * 
     * The function will choose the proper method for outputing the footer, either
     * by using the footer's process_view method if the footer is a boris_View object,
     * or by compiling and outputing if the footer is a template.
     *
     */
    protected function output_footer(){
        if (is_null($this->footer)) throw new Exception('Error - Footer is NULL');
        
        if (is_object($this->footer) && ($this->footer instanceof boris_View)){
            $this->footer->process_view();
            return;
        }
        
        if (is_string($this->footer)){
            if (file_exists($this->flexy_handle->options['templateDir'][0] . $this->footer)){
                $this->flexy_handle->compile($this->footer);
                $this->flexy_handle->outputObject($this);
                return;
            } else {
                throw new Exception('Error - Footer template ' . $this->footer . ' not found.');
            }
        }
        
        throw new Exception('Error - Unknown Footer type.');
    }
    
    /**
     * Set the title that the page will display.
     *
     * @access public
     * @param string $page_title
     */
    public abstract function setPageTitle($page_title = NULL);
    
    /**
     * Set the user that is viewing the page.
     * 
     * @access public
     * @param mixed $user
     */
    public function setUser($user){
        $this->user = $user;
    }
    
    /**
     * Returns the user who is viewing the page.
     */
    public function getUser(){
    	return $this->user;
    }
    
    /**
     * Syncs the feedback variables of the view with Feedback Storage.
     *
     */
    public function setFeedback(){
        if (!(boris_FeedbackStorage::has_errors() || boris_FeedbackStorage::has_messages())) return;
        // Set the Feedback Storage variables
        $this->hasErrors = boris_FeedbackStorage::has_errors();
        $this->errors = boris_FeedbackStorage::get_errors();
        $this->hasMessages = boris_FeedbackStorage::has_messages();
        $this->messages = boris_FeedbackStorage::get_messages();
    }

    /**
     * Indicates if the current viewer is a logged in member of the site.
     *
     * @access public
     * @return True if the viewer is logged in, false otherwise.
     */
    public function isLoggedIn(){
        return ($this->user->getId() != null);
    }

    /**
     * Indicates if the current viewer is authorized to see the view.
     *
     * @access public
     * @return True if the viewer is authorized, false otherwise.
     */
    public function isAuthorized(){
    	return ($this->isLoggedIn() && $this->user->is_type($this->required_type));
    }
    
    /**
     * Returns the current year.
     */
    public function getCurrentYear(){
        return date("Y");
    }

    /**
     * Returns true if the client's browser fully supports the displaying
     * of PNG image files. In particular the browser must be able to support transparency.
     * Based on the information available at http://www.libpng.org/pub/png/pngapbr.html
     * 
     * @return boolean
     */
    public function client_supports_png(){
        // IE 7 and above have support
        if ( preg_match('/MSIE (\d*\.\d*);/', $_SERVER['HTTP_USER_AGENT'], $version) ){
            if ($version[1] >= 7) return TRUE;
    
        // Firefox 0.7 and above
        } else if (preg_match('#Firefox/(\d*\.\d*)#', $_SERVER['HTTP_USER_AGENT'], $version)){
            if ($version[1] >= 0.7) return TRUE;
        }
    
        return FALSE;
    }
    
    /****************************************************************************
     * The following are methods for templates to retrieve certain required paths
     ****************************************************************************/
    
    /**
     * Returns the URL to the layout folder.
     *
     * @return string
     */
    public function getLayoutUrl(){
        global $appConf;
        
        return $appConf['layout_url'];
    }

    /**
     * Returns the URL to the pics folder.
     *
     * @return string
     */
   	public function getPicsUrl(){
   		global $appConf;
   		
   		return $appConf['pics_url'];
   	}

   	/**
   	 * Returns the URL to the javascript folder.
   	 *
   	 * @return string
   	 */
    public function getJsUrl(){
        global $appConf;
        
        return $appConf['js_url'];
    }

    /**
     * Returns the URL to the controller.
     *
     * @return string
     */
    public function get_controller_url(){
        return boris_BaseView::get_class_controller_url();
    }

    /**
     * Returns the URL to the controller.
     *
     * @return string
     */
    protected static function get_class_controller_url(){
        global $appConf;
        
        return $appConf['controller_url'];
    }
    
    /**
     * Returns the provided url augmented with the provided arugment array.
     *
     * @param string $url
     * @param array $args
     * @return string
     */
    protected static function build_augmented_url($url, array $args=array()){
    	if (count($args) > 0){
	    	$url .= '?';
	    	$arg = each($args);
	        $url .= $arg['key'] . '=' . $arg['value'];
	        while ($arg = each($args)){
	            $url .= '&' . $arg['key'] . '=' . $arg['value'];
	        }
    	}
        return $url;
    }
    
    /**
     * Returns the URL of this view class.
     */
    abstract public function getViewUrl();

    /**
     * Returns an augmented URL for the view class.
     */
    abstract public function getAugViewUrl();
    
    /**
     * Returns the URL of this view.
     */
    //abstract public static function getClassViewUrl();
    
    /**
     * Returns the augmented URL that resulted in the current display.
     */
    //abstract public static function getClassAugViewUrl();
}

?>
