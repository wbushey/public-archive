<?php
/**
 * View that allows a user to send an email to the Celebrity Bar Fight administrators.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/29/08
 */

class cbf_ContactUsView extends boris_View{
	
    // Post Arguments
    public $email_subject;          // The subject entered by the user
    public $email_reply_address;    // The reply address of the email
    public $email_body;             // The message/body of the email
    
	public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        $this->setPageTitle();
	}

	public function process_view(){
		
		/***********************************************
    	 * Handle parameters
    	 ***********************************************/
		if (isset($this->post_args['emailSubmit'])){
			$errors = array();
			try{
				// Get input
				$this->email_subject =  htmlentities($this->post_args['email_subject']);
				$this->email_reply_address = htmlentities($this->post_args['email_from_address']);
			    $this->email_body = $this->post_args['email_body'];
			    
			    // Set form elements
			    $this->flexy_form_elements['email_body'] = new HTML_Template_Flexy_Element;
			    $this->flexy_form_elements['email_body']->setValue($this->email_body);
			    
			    // Verify input
				if(!isset($this->email_subject) || empty($this->email_subject)) 
				        $errors[] = "You must provide a subject for your message.";
			    if(!isset($this->email_reply_address) || empty($this->email_reply_address)) 
			             $errors[] = "You must provide a reply to address.";
			    if(!isset($this->email_body) || empty($this->email_body)) 
			             $errors[] = "You can not send an empty message.";
			    require_once 'utils/VerifyEmail.php';
			    if (!is_valid_email_address($this->email_reply_address)) 
			             $errors[] = "You must provide a valid reply to address.";
			    if(!empty($errors)) throw new boris_MinorException($errors);
			    
			    // Send the email
	        	$headers = "From: {$this->email_reply_address}" . "\r\n" .
	            	'Content-Type: text/html; charset=iso-8859-1';
	        	mail("mail@celebritybarfight.com", $this->email_subject, $this->email_body, $headers);
	        	boris_FeedbackStorage::push_message('Your email has been sent to the administrators of Celebrity Bar Fight. Thank you for your message.');
			} catch (boris_MinorException $e){
				$messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
			}
		}
		
        $this->header = new cbf_LimitedHeaderView(array(), array());
        $this->footer = new cbf_LimitedFooterView(array(), array());
		
		$this->output_header();        
        $this->main_template = 'aboutUs_contactUs.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this, $this->flexy_form_elements);
        $this->output_footer();
	}
	
    /**
     * Adds " - Contact Us" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Contact Us$page_title");
    }
	
	/**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
	public function getViewUrl(){
		return cbf_ContactUsView::getClassViewUrl();	
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
		return cbf_ContactUsView::getClassAugViewUrl($args);
	}
	
	/**
	 * Returns the base url for this class.
	 *
	 * @return string
	 */
	public static function getClassViewUrl(){
		return boris_View::get_class_controller_url() . '/aboutUs/contactUs';
	}
	
	/**
	 * Returns the URL for this class augmented with GET arguments.
	 * The GET arguments can be set by providing an associative array of the form
	 * 			$args['argument_name'] => 'argument_value'
	 * 
	 * There are no arguments for this view.
	 * 
	 * @param array $args
	 * @return string
	 */
	public static function getClassAugViewUrl(array $args = array()){
		$url = cbf_ContactUsView::getClassViewUrl();
			
		// Build the string
        $url = parent::build_augmented_url($url, $args);
		
		return $url;
	}
}
?>