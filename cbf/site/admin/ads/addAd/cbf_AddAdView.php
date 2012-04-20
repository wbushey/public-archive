<?php
/**
 * View for the portion of the admin panel that allows a user to add an advertisment.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/08/2009
 */

class cbf_AddAdView extends cbf_AdminView{

    private $ad;            // The ad object of the new advertisment
    private $ad_image;      // Image data for an ad that we are hosting
    
    public $ad_name;        // The name provided for the ad
    public $ad_position;    // The provided position value
    public $ad_priority;    // The value provided for the ad's priority
    public $hosting_check;  // Value of the hosting checkbox
    public $hosting_file;   // Filename provided
    public $ad_code;        // The code provided for the ad
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->javascripts[] = 'admin_addAd.js';
        
        $this->ad = new Ad();
        $this->ad_image = new Image();
        $this->ad_name = $this->post_args['name'];
        $this->ad_position = $this->post_args['position'];
        $this->flexy_form_elements['position'] = new HTML_Template_Flexy_Element;
        $this->flexy_form_elements['position']->setOptions(array(
                '-1' => '',
                AdPeer::$TOP => 'Top',
                AdPeer::$RIGHT_1 => 'Right'
            ));
        $this->flexy_form_elements['position']->setValue($this->ad_position);
        $this->ad_priority = $this->post_args['priority'];
        $this->hosting_check = $this->post_args['hosting_check'];
        if (isset($this->hosting_check)){
            $this->flexy_form_elements['hosting_check'] = new HTML_Template_Flexy_Element;
            $this->flexy_form_elements['hosting_check']->setAttributes('checked');
        }
        $this->hosting_file = $_FILES['hosting_file'];
        $this->ad_code = stripslashes($this->post_args['code']);
        $this->flexy_form_elements['code'] = new HTML_Template_Flexy_Element;
        $this->flexy_form_elements['code']->setValue($this->ad_code);
    }
    
    public function process_view(){
        
        /*
         * Handle Ajax arguments
         */
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
                    $percentage = 100 * $priority / ($count + $priority);
                }
                echo $percentage;
                exit();
            }
        }
        
        if(isset($this->post_args['add_ad_submit'])){
            /*
             * Adding an ad
             */
            try{
                // Check input
                $this->check_input();
                
                if (isset($this->hosting_check)){
                    // We are hosting the ad image
                    $this->ad_image->setName($this->hosting_file['name']);
                    $this->ad_image->setDatatype($this->hosting_file['type']);
                    $this->ad_image->setSize($this->hosting_file['size']);
                    $this->ad_image->setDateAdded(time());
                    $this->ad_image->save();
                    $this->ad_image->import_image_data($this->hosting_file['tmp_name']);
                    
                    $this->ad_code = preg_replace('/__CBF_AD__/', 
                            '__CBF_AD_' . $this->ad_image->getId() . '__', 
                            $this->ad_code);
                }
                
                /*
                 * Save the ad
                 */
                $this->ad = new Ad();
                $this->ad->setName($this->ad_name);
                $this->ad->setPosition($this->ad_position);
                $this->ad->setDateAdded(time());
                $this->ad->setCode($this->ad_code);
                if (isset($this->hosting_check)) $this->ad->setImageId($this->ad_image->getId());
                $this->ad->save();
                $this->ad->updateAdPriority($this->ad_priority);
                boris_FeedbackStorage::push_message('Advertisment has been added successfully.');
                // Everything is successful, so redirect to main celebrities page
                header('Location: ' . cbf_AdsView::getClassViewUrl());
                return 0;
            } catch (boris_MinorException $e){
                // Push the error message and display the input view
                $messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
            }
        }
        
        //Output
        $this->output_header();        
        $this->main_template = 'admin_addAd.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this, $this->flexy_form_elements);
        $this->output_footer();
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
        parent::setPageTitle(" - Advertisments - Add Advertisment" . $page_title);
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_AddAdView::getClassViewUrl();  
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
        return cbf_AddAdView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns the base url for this class.
     *
     * @return string
     */
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/ads/addAd';
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
        $url = cbf_AddAdView::getClassViewUrl();
            
        // Build the string
        $url = parent::build_augmented_url($url, $args);
        
        return $url;
    }
}
?>