<?php
/**
 * View for the portion of the admin panel that allows a user to edit a celebrity's information.
 * 
 * The has two modes, search mode and display mode. Search mode allows the user to search for
 * and browse the celebrities that are in the database. Display mode allows the user to view
 * and edit a particular celebrity. Unless an id argument is provided this view
 * will default to search mode. If an id argument is provided for a celebrity that does not
 * exist then the view will go into search mode.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/11/08
 */

// Pagination
require_once('utils/Pagination.php');

class cbf_CelebritiesView extends cbf_AdminView{
    
    private $mode;                  // Determine if the page should display a search or a celebrity
    
    public $celebrity;				// Holds the celebrity that the user wants to work on
    public $pics_rows = array();	// 2D array for the layout of pictures
    public $all_fights = array();   // Holds all fights that the celebrity is a part of
    
    public $search_results = array();   // Holdes the result listing
    public $pg;                         // Pagination
    public $has_fight_options;          // The options available for the has_fight menu
    public $has_picture_options;        // The options available for the has_picture menu
    
    // Arguments for search
    public $has_fight;                  // Search for celebs who are in a fight?
    public $has_picture;                // Search for celebs who have a picture?
    public $name_query;                 // Name to search for
    
    
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        if (isset($this->get_args['id'])){
            $this->celebrity = NamesPeer::retrieveByPK($this->get_args['id']);
            
            if ($this->celebrity) $this->mode = 'celeb';
            else $this->mode = 'search';
        }
        else $this->mode = 'search';
        
        $this->javascripts[] = 'popupDiv.js';
        $this->javascripts[] = 'admin_celebrities.js';
        $this->javascripts[] = 'sendPost.js';
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        // Decide which view to process
        if ($this->mode == 'celeb') $this->process_celebrity_view();
        else $this->process_search_and_browse_view();

        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        // Decide which view to output
        if ($this->mode == 'celeb') $this->display_celebrity_view();
        else $this->display_search_and_browse_view();
        
        $this->output_footer();
    }
    
    /**
     * Adds " - Celebrities" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Celebrities$page_title");
    }
    
    /**
     * Performs the processing needed to display a page for searching and
     * browsing celebrities.
     *
     */
    private function process_search_and_browse_view(){
        $criteria = array();
        $this->pg = new Pagination();
        
        /*
         * Process Arguements
         * Allowable Arguments
         *  name: Name to search for
         *  has_fight: Search for celebrities who are in a fight?
         *  has_picture: Search for celebrities who have a picture?
         *  l: Number of results to display per page
         *  p: Desired page number of results
         */
        
        // Argument name
        if (isset($this->get_args['name']) && !empty($this->get_args['name'])){
            $this->name_query = $this->get_args['name'];
            $criteria['name'] = $this->name_query;
        }
        
        // Argument has_fight
        $this->has_fight = $this->get_args['has_fight'];
        switch ($this->has_fight){
            case 'Yes':
                $criteria['has_fight'] = true;
                break;
            case 'No':
                $criteria['has_fight'] = false;
                break;
            default:
                $this->has_fight = '--';
                break;
        }
        
        // Argument has_picture
        $this->has_picture = $this->get_args['has_picture'];
        switch ($this->has_picture){
            case 'Yes':
                $criteria['has_picture'] = true;
                break;
            case 'No':
                $criteria['has_picture'] = false;
                break;
            default:
                $this->has_picture = '--';
                break;
        }
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 30;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = NamesPeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        /* Set the display of links and form inputs */     
        $this->pg->set_links($this);
        
        // Set the options for has_fight
        $this->has_fight_options = "<select name=\"has_fight\" id=\"has_fight\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->has_fight_options .= '<option' . (($this->has_fight == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->has_fight_options .= "</select>";
        
        // Set the options for has_picture
        $this->has_picture_options = "<select name=\"has_picture\" id=\"has_picture\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->has_picture_options .= '<option' . (($this->has_picture == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->has_picture_options .= "</select>";
        
        // Set standard search attributes and execute the search
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        $criteria['order_by'] = NamesPeer::NAME . ' asc';
        $this->search_results = NamesPeer::adv_search($criteria);
        
    }
    
    /**
     * Displays a view to the user which allows for searching and browsing of celebrities.
     */
    private function display_search_and_browse_view(){
        $this->main_template = 'admin_celebrities_search.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Performs the necessary processing to display a page for editing a celebrity
     */
    private function process_celebrity_view(){
        
        /****************************************************** 
         * Process any changes that have been made by the user 
         ******************************************************/
        try{
            // Name Change
            if (isset($this->post_args['edit_name_submit'])){
                // Validate
                if (!isset($this->post_args['edit_name_field']) || empty($this->post_args['edit_name_field'])) 
                        throw new boris_MinorException('You must enter a name for the celebrity');
                
                // Commit Change
                $this->celebrity->setName($this->post_args['edit_name_field']);        
                $this->celebrity->save();
                boris_FeedbackStorage::push_message('Name Updated Successfully');
            }
            
            // Reference Change
            if (isset($this->post_args['edit_reference_submit'])){
                // Validate
                if (!isset($this->post_args['edit_reference_field']) || empty($this->post_args['edit_reference_field']))
                        throw new boris_MinorException('You must enter an address for the reference');
                
                // Commit Change
                $this->celebrity->setReference($this->post_args['edit_reference_field']);
                $this->celebrity->save();
                boris_FeedbackStorage::push_message('Reference URL Updated Successfully');           
            }
            
            // Adding a Picture
            if (isset($this->post_args['add_picture_submit'])){
                $file = $_FILES['new_picture_file'];
                if (!$file || $file['size'] == 0)
                    throw new boris_MinorException('An error occured while transmitting the picture');

                PicsPeer::process_new_picture($file, $this->celebrity);
                boris_FeedbackStorage::push_message('New Picture Successfully Added');
            }
            
            // Removing a Picture
            if (isset($this->post_args['remove_picture_button'])){
                $filename = substr($this->post_args['picture_to_remove'], strstr($this->post_args['picture_to_remove'], Pics::fullPrefix) + 1);
                PicsPeer::remove_picture($filename, $this->celebrity);
                boris_FeedbackStorage::push_message('Picture Successfully Removed');
            }
            
            // Delete the celebrity
            if (isset($this->post_args['yes_remove_celeb_button'])){
                $name = $this->celebrity->getName();
                NamesPeer::doDelete($this->celebrity);
                boris_FeedbackStorage::push_message($name . ' was Successfully Removed');
                
                // Redirect to search and browse
                $this->mode = 'search';
                header("Location: {$this->getViewUrl()}");
                exit;
            }
        } catch (boris_MinorException $e){
            $messages = $e->getMessages();
            foreach($messages as $message) boris_FeedbackStorage::push_error($message);
        }

        /****************************************************** 
         * Required processing to display the page
         ******************************************************/
        // Setup the pics_rows array
        $raw_pics = $this->celebrity->getPicss();
        $x = 0;
        foreach($raw_pics as $pic){
        	$this->pics_rows[$x/3][$x%3] = $pic; 
        	$x++;
        }
        
        // Setup fights arrays
        $this->all_fights = $this->celebrity->get_all_fights();
        
    }
    
    /**
     * Sends a fully processed view to the user's browser that allows
     * the user to edit a celebrity.
     *
     */
    private function display_celebrity_view(){
        $this->main_template = 'admin_celebrities.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }

    /**
     * Method used by the page template to generate a link for working with a fight.
     *
     * @param Fights $fight
     * @return url as a string
     */
    public function getFightLink(Fights $fight){
        return cbf_FightsView::getClassAugViewUrl(array('id' => $fight->getId()));
    }
    
    /*
     * Method used by the page template to generate a link for adding a celebrity to a fight.
     */
    public function getAddFightLink(Names $name){
    	return cbf_AddFightView::getClassAugViewUrl(array('celeb1ID' => $name->getId()));
    }

    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public function getViewUrl(){
        return cbf_CelebritiesView::getClassViewUrl();
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
        if ($this->mode == 'celeb'){
            $args['id'] = ((array_key_exists('id', $args)) ? $args['id'] : $this->get_args['id']);
        } else {
            if (!array_key_exists('name', $args) && isset($this->name_query)){
                $args['name'] = $this->name_query;
            }
            $args['has_fight'] = ((array_key_exists('has_fight', $args)) ? $args['has_fight'] : $this->has_fight);
            $args['has_picture'] = ((array_key_exists('has_picture', $args)) ? $args['has_picture'] : $this->has_picture);
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->get_args['l']);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->get_args['p']);
        }
        
        return cbf_CelebritiesView::getClassAugViewUrl($args);
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
        $url = cbf_CelebritiesView::getClassViewUrl();
        
        if (count($args) > 0){ 
            $url .= '?';
            if (array_key_exists('id', $args)){
                $url .= 'id=' . $args['id'];
            } else {
                // Set needed defaults
                $args['has_fight'] = ((array_key_exists('has_fight', $args)) ? $args['has_fight'] : '--');
                $args['has_picture'] = ((array_key_exists('has_picture', $args)) ? $args['has_picture'] : '--');
                $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 30);
                $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1);
                
                // Build the string
                $arg = each($args);
                $url .= $arg['key'] . '=' . $arg['value'];
                while ($arg = each($args)){
                    $url .= '&' . $arg['key'] . '=' . $arg['value'];
                }
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
        return boris_View::get_class_controller_url() . '/admin/celebrities';
    }
}
?>