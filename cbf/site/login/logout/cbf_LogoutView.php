<?php
/**
 * View which logs out a user.
 * 
 * This is a special case view, it is not intended to display anything. It
 * simply removes the user's profile information from the session, then
 * redirects the user back to the page they were viewing, or a default page.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/26/08
 */

class cbf_LogoutView extends boris_View{
	
	private $redirect_to;		// Page to go to after logging out
	
	public function __construct(array $get_args, array $post_args){
		parent::__construct($get_args, $post_args);	
		
		if (isset($this->get_args['uri'])) $this->redirect_to = $this->get_args['uri'];
		else $this->redirect_to = cbf_MainView::getClassViewUrl();
	}
	
	public function process_view(){
		unset($_SESSION['user_profile']);
		header("Location: {$this->redirect_to}");
	}
	
	/**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
	public function getViewUrl(){
		return cbf_LogoutView::getClassViewUrl();	
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
		$args['uri'] = ((array_key_exists('uri', $args)) ? $args['uri'] : $this->redirect_to);
		
		return cbf_LogoutView::getClassAugViewUrl($args);
	}
	
	/**
	 * Returns the base url for this class.
	 *
	 * @return string
	 */
	public static function getClassViewUrl(){
		return boris_View::get_class_controller_url() . '/login/logout';
	}
	
	/**
	 * Returns the URL for this class augmented with GET arguments.
	 * The GET arguments can be set by providing an associative array of the form
	 * 			$args['argument_name'] => 'argument_value'
	 * 
	 * Arguments for this view are:
	 * 		'uri' - The uri to redirect to after logging out.
	 * 
	 * @return string
	 */
	public static function getClassAugViewUrl(array $args = array()){
		$url = cbf_LogoutView::getClassViewUrl();
			
		// Build the string
        $url = parent::build_augmented_url($url, $args);
		
		return $url;
	}
}
?>