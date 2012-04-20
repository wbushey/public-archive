<?php
/**
 * View for the portion of the admin panel that allows a user to manage an advertisments.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/17/2009
 */

// Pagination
require_once('utils/Pagination.php');

class cbf_AdsView extends cbf_AdminView{
    
    private $mode;          // Determine if the page should display a listing or an ad

    public $ad;             // The ad object of the new advertisment
    private $ad_image;      // Image data for an ad that we are hosting
    
    public $search_results = array();   // Holdes the result listing
    public $pg;                         // Pagination

    public $ad_position_string;    // The string to display describing the ad's position
    public $ad_priority;    // The value provided for the ad's priority
    public $hosting_check;  // Value of the hosting checkbox
    public $hosting_file;   // Filename provided
    public $ad_code;        // The code provided for the ad
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        if (isset($this->get_args['id'])){
            $this->ad = AdPeer::retrieveByPK($this->get_args['id']);
            
            if ($this->ad){
                $this->ad_image = $this->ad->getImage();
                $this->mode = 'ad';
                $this->javascripts[] = 'popupDiv.js';
                $this->javascripts[] = 'admin_ads.js';
                $this->javascripts[] = 'sendPost.js';
            }
            else $this->mode = 'browse';
        }
        else $this->mode = 'browse';
    }
    
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        // Decide which view to process
        if ($this->mode == 'ad') $this->process_ad_view();
        else $this->process_browse_view();

        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        // Decide which view to output
        if ($this->mode == 'ad') $this->display_ad_view();
        else $this->display_browse_view();
        
        $this->output_footer();
    }
    
    /**
     * Performs the processing needed to display a page for browsing ads.
     *
     */
    private function process_browse_view(){
        $criteria = array();
        $this->pg = new Pagination();
        
        /*
         * Process Arguements
         * Allowable Arguments
         *  l: Number of results to display per page
         *  p: Desired page number of results
         */
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 30;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = AdPeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        /* Set the display of links and form inputs */     
        $this->pg->set_links($this);
        
        // Set standard search attributes and execute the search
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        $criteria['order_by'] = AdPeer::NAME . ' asc';
        $this->search_results = AdPeer::adv_search($criteria);
        
    }
    
    /**
     * Displays a view to the user which allows for searching and browsing of celebrities.
     */
    private function display_browse_view(){
        $this->main_template = 'admin_ads_search.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Performs the necessary processing to display a page for editing a celebrity
     */
    private function process_ad_view(){
        
        /******************************************************* 
         * Handle Ajax arguments
         *******************************************************/
        if (isset($this->get_args['action'])){
            if ($this->get_args['action'] == 'get_display_percentage'){
                header("Cache-Control: no-cache, must-revalidate");
                // Date in the past
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                
                $position = $this->get_args['position'];
                $priority = $this->get_args['priority'];
                if ($priority == 0){
                    $percentage = 0;
                } else {
                    $c = new Criteria();
                    $c->add(AdPeer::POSITION, $position);
                    $c->addJoin(AdPeer::ID, AdSelectionListPeer::AD_ID);
                    $count = AdPeer::doCount($c);
                    $percentage = 100 * $priority / ($count - $this->ad->getAdPriority() + $priority);
                }
                echo $percentage;
                exit();
            }
        }
        
        /****************************************************** 
         * Process any changes that have been made by the user 
         ******************************************************/
        // Name Change
        if (isset($this->post_args['edit_name_submit'])){
            $this->ad->setName($this->post_args['edit_name_field']);
            if(!$this->ad->validate()){
            $errors = $this->ad->getValidationFailures();
                foreach($errors as $k => $v){
                    boris_FeedbackStorage::push_error('Validation Error: ' . $v->getMessage($k));
                }
            } else {
                $this->ad->save();
                boris_FeedbackStorage::push_message('Name Updated Successfully');
            }
        }
        
        // Position Change
        if (isset($this->post_args['edit_position_submit'])){
            $this->ad->setPosition($this->post_args['edit_position_select']);
            if(!$this->ad->validate()){
            $errors = $this->ad->getValidationFailures();
                foreach($errors as $k => $v){
                    boris_FeedbackStorage::push_error('Validation Error: ' . $v->getMessage($k));
                }
            } else {
                $this->ad->save();
                boris_FeedbackStorage::push_message('Position Updated Successfully');
            }
        }
        
        // Priority Change
        if (isset($this->post_args['edit_priority_submit'])){
            $this->ad->updateAdPriority($this->post_args['edit_priority_field']);
            if(!$this->ad->validate()){
            $errors = $this->ad->getValidationFailures();
                foreach($errors as $k => $v){
                    boris_FeedbackStorage::push_error('Validation Error: ' . $v->getMessage($k));
                }
            } else {
                $this->ad->save();
                boris_FeedbackStorage::push_message('Priority Updated Successfully');
            }
        }
        
        // Code Change
        if (isset($this->post_args['edit_code_text'])){
            $this->ad->setCode(stripslashes($this->post_args['edit_code_text']));
            if(!$this->ad->validate()){
            $errors = $this->ad->getValidationFailures();
                foreach($errors as $k => $v){
                    boris_FeedbackStorage::push_error('Validation Error: ' . $v->getMessage($k));
                }
            } else {
                $this->ad->save();
                boris_FeedbackStorage::push_message('Code Updated Successfully');
            }
        }
        
        // Delete the ad
        if (isset($this->post_args['yes_remove_ad_button'])){
            AdPeer::doDelete($this->ad);
            boris_FeedbackStorage::push_message($this->ad->getName() . ' was Successfully Removed');
            
            // Redirect to browse
            header("Location: {$this->getViewUrl()}");
            exit;
        }
        
        /*
         * Required processing for display
         */
        $this->ad_position_string = AdPeer::get_position_string($this->ad->getPosition());
        $this->flexy_form_elements['edit_position_select'] = new HTML_Template_Flexy_Element;
        $position_options = array(-1 => '');
        foreach(AdPeer::get_all_positions() as $pos){
            $position_options[$pos] =  AdPeer::get_position_string($pos);
        }
        $this->flexy_form_elements['edit_position_select']->setOptions($position_options);
        $this->flexy_form_elements['edit_position_select']->setValue($this->ad->getPosition());
        $this->flexy_form_elements['edit_code_text'] = new HTML_Template_Flexy_Element;
        $position_options = array(-1 => '');
        $this->flexy_form_elements['edit_code_text']->setValue($this->ad->getRawCode());
    }
    
    /**
     * Sends a fully processed view to the user's browser that allows
     * the user to edit a celebrity.
     *
     */
    private function display_ad_view(){
        $this->main_template = 'admin_ads.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this, $this->flexy_form_elements);
    }
    
    /*
     * Validates input.
     * If the input is not valid, a boris_MinorException will be thrown
     */
    private function check_input(){
        $errors = array();
        $this->ad_name = trim($this->ad_name);
        if (empty($this->ad_name)) $errors[] = 'A name for the ad must be provided';
        if (! is_numeric($this->ad_position) || 
            !in_array($this->ad_position, array(AdPeer::$TOP, AdPeer::$RIGHT_1))){
                $errors[] = 'An ad position must be selected';
            }
        if (!is_numeric($this->ad_priority) || $this->ad_priority < 0)
                $errors[] = 'An integer greater than 0 must be entered for the priority';
        if (isset($this->hosting_check)){
            // Check the file
            if (!empty($this->hosting_file['error'])) $errors[] = 'An error occured while uploading the image file: ' . $this->hosting_file['error'];
            if (!is_uploaded_file($this->hosting_file['tmp_name'])) $errors[] = 'An error occured while uploading the image file.';
        }
        $this->ad_code = trim($this->ad_code);
        if (empty($this->ad_code)) $errors[] = 'Code must be entered for the ad';
        if (!empty($errors)){
            throw new boris_MinorException($errors);
        }
    }
    
    /**
     * Adds " - Add Advertisment" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Advertisments" . $page_title);
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_AdsView::getClassViewUrl();  
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
        if ($this->mode == 'ad'){
            $args['id'] = ((array_key_exists('id', $args)) ? $args['id'] : $this->get_args['id']);
        } else {
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->get_args['l']);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->get_args['p']);
        }
        
        return cbf_AdsView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns the base url for this class.
     *
     * @return string
     */
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/ads';
    }
    
    /**
     * Returns the URL for this class augmented with GET arguments.
     * The GET arguments can be set by providing an associative array of the form
     *          $args['argument_name'] => 'argument_value'
     * 
     * There are no arguments for this view.
     * 
     * @return string
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_AdsView::getClassViewUrl();
            
        // Build the string
        $url = parent::build_augmented_url($url, $args);
        
        return $url;
    }
}
