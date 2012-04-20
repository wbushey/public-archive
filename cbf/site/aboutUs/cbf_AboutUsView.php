<?php
/**
 * View that displays a static page describing the people behind Celebrity Bar Fight.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/29/08
 */


class cbf_AboutUsView extends boris_View{
	
	public $feedback_url;		// The url to the feedback form.
	
	public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        $this->setPageTitle();
        $this->feedback_url = cbf_ContactUsView::getClassViewUrl();
	}

	public function process_view(){
        $this->header = new cbf_LimitedHeaderView(array(), array());
        $this->footer = new cbf_LimitedFooterView(array(), array());
		
		$this->output_header();        
        $this->main_template = 'aboutUs_aboutUs.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        $this->output_footer();
	}
	
    /**
     * Adds " - About Us" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - About Us$page_title");
    }
	
	/**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
	public function getViewUrl(){
		return cbf_AboutUsView::getClassViewUrl();	
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
		return cbf_AboutUsView::getClassAugViewUrl($args);
	}
	
	/**
	 * Returns the base url for this class.
	 *
	 * @return string
	 */
	public static function getClassViewUrl(){
		return boris_View::get_class_controller_url() . '/aboutUs';
	}
	
	/**
	 * Returns the URL for this class augmented with GET arguments.
	 * The GET arguments can be set by providing an associative array of the form
	 * 			$args['argument_name'] => 'argument_value'
	 * 
	 * There are no arguments for this view.
	 * 
	 * @return string
	 */
	public static function getClassAugViewUrl(array $args = array()){
		$url = cbf_AboutUsView::getClassViewUrl();
			
		// Build the string
        $url = parent::build_augmented_url($url, $args);
		
		return $url;
	}
}
?>