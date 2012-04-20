<?php
/**
 * View for the portion of the admin panel that allows a user to edit a fight's information.
 * 
 * This view has two modes, search mode and display mode. Search mode allows a user to search and
 * browse though all the fights currently available in the system. Display mode allows a user to
 * view and edit a particular fight. Unless an id argument is provided this view will default to 
 * search mode. If an id argument is provided but can not be found in the database then the view
 * will switch to search mode.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/11/08
 */

// Pagination
require_once('utils/Pagination.php');

class cbf_FightsView extends cbf_AdminView{

    private $mode;                  // Determine if the page should display a search or a fight
    
    public $fight;                  // Holds the fight that the user wants to look at
    public $fighter_one;            // The first celebrity in the fight
    public $fighter_one_url;        // URL to edit the first fighter
    public $fighter_two;            // The second celebrity in the fight
    public $fighter_two_url;        // URL to edit the second fighter
    public $fight_url;              // URL to the public fight page
    
    /* Search variables */
    public $is_active;              // Indicates whether to search for active/inactive fights
    public $has_smack;              // Search for fights with/without smack
    public $search_results;
    
    /* Smack and Smack Pagination */
    public $all_smack = array();            // All smack that has been posted concerning this fight.
    public $pg;                             // Pagination 

    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        if (isset($this->get_args['id'])){
            $this->fight = FightsPeer::retrieveByPK($this->get_args['id']);
            
            if ($this->fight) $this->mode = 'fight';
            else $this->mode = 'search';
        }
        else $this->mode = 'search';
        
        $this->javascripts[] = 'popupDiv.js';
        $this->javascripts[] = 'admin_fights.js';
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
        if ($this->mode == 'fight') $this->process_fight_view();
        else $this->process_search_and_browse_view();

        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        // Decide which view to output
        if ($this->mode == 'fight') $this->display_fight_view();
        else $this->display_search_and_browse_view();
        
        $this->output_footer();
    }

    /**
     * Adds " - Fights" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Fights$page_title");
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
         *  is_active: Search for fights that are active?
         *  has_smack: Search for fights that have smack?
         *  l: Number of results to display per page
         *  p: Desired page number of results
         */
        
        // Argument is_active
        $this->is_active = $this->get_args['is_active'];
        switch ($this->is_active){
            case 'Yes':
                $criteria['is_active'] = true;
                break;
            case 'No':
                $criteria['is_active'] = false;
                break;
            default:
                $this->is_active = '--';
                break;
        }
        
        // Argument has_smack
        $this->has_smack = $this->get_args['has_smack'];
        switch ($this->has_smack){
            case 'Yes':
                $criteria['has_smack'] = true;
                break;
            case 'No':
                $criteria['has_smack'] = false;
                break;
            default:
                $this->has_smack = '--';
                break;
        }
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 30;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = FightsPeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        /* Set the display of links and form inputs */    
        
        // Set the next and previous links
        $this->pg->set_links($this);
        
        // Set the options for is_active
        $this->is_active_options = "<select name=\"is_active\" id=\"is_active\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->is_active_options .= '<option' . (($this->is_active == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->is_active_options .= "</select>";
        
        // Set the options for has_smack
        $this->has_smack_options = "<select name=\"has_smack\" id=\"has_smack\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->has_smack_options .= '<option' . (($this->has_smack == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->has_smack_options .= "</select>";
        
        // Set standard search attributes and execute the search
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        $criteria['order_by'] = FightsPeer::ID . ' asc'; 
        $this->search_results = FightsPeer::adv_search($criteria);
    }
    
    /**
     * Displays a view to the user which allows for searching and browsing of fights.
     */
    private function display_search_and_browse_view(){
        $this->main_template = 'admin_fights_search.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }

    /**
     * Performs the necessary processing to display a page for editing a fight
     */
    private function process_fight_view(){
        
        /****************************************************** 
         * Process pagination arguments
         ******************************************************/
        
        $this->pg = new Pagination();
        
        // Limit
        $this->pg->limit = $this->get_args['l'];
        if (!isset($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit < 1)
            $this->pg->limit = 20;
 
        // Current Page
        $this->pg->cur_page = $this->get_args['p'];
        if (!isset($this->pg->cur_page) || !is_numeric($this->pg->cur_page) || $this->pg->cur_page < 1)
            $this->pg->cur_page = 1;
        
        /****************************************************** 
         * Process any changes that have been made by the user 
         ******************************************************/
        
        // Remove a post
        if (isset($this->post_args['yes_remove_post_button'])){
            PostsPeer::doDelete($this->post_args['post_to_remove']);
            boris_FeedbackStorage::push_message('Post Successfully Removed');
        }
        
        // Activate fight
        if (isset($this->post_args['activate_fight_button'])){
            $this->fight->setActive(1);
            $this->fight->save();
            boris_FeedbackStorage::push_message($this->fight->toString() . ' activated.');
        }
        
        // Deactivate fight
        if (isset($this->post_args['deactivate_fight_button'])){
            $this->fight->setActive(0);
            $this->fight->save();
            boris_FeedbackStorage::push_message($this->fight->toString() . ' deactivated.');
        }
        
        // Remove the fight
        if (isset($this->post_args['yes_remove_fight_button'])){
            $name = $this->fight->toString();
            FightsPeer::doDelete($this->fight);
            boris_FeedbackStorage::push_message($name . ' was Successfully Removed');
            
            // Redirect to search and browse
            $this->mode = 'search';
            header("Location: {$this->getViewUrl()}");
            exit;
        }
        
        // Edit smack
        if (isset($this->post_args['save_post_button'])){
            $post = PostsPeer::retrieveByPK($this->post_args['post_to_edit']);
            $post->set_posttext_from_input($this->post_args['edit_post_text']);
            $post->save();
            boris_FeedbackStorage::push_message('Post Successfully Updated');
        }
        
        /****************************************************** 
         * Required processing to display the page
         ******************************************************/
        
        // Make the two fighters accessable to the template
        $this->fighter_one = $this->fight->getNamesRelatedByOneid();
        $this->fighter_two = $this->fight->getNamesRelatedByTwoid();
        
        // Generate editing URLs
        $this->fighter_one_url = cbf_CelebritiesView::getClassAugViewUrl(array('id' => $this->fighter_one->getId()));
        $this->fighter_two_url = cbf_CelebritiesView::getClassAugViewUrl(array('id' => $this->fighter_two->getId()));
        $fight_url = cbf_MainView::getClassAugViewUrl(array('fID' => $this->fight->getID()));
        $this->fight_url = "<a href=\"$fight_url\">$fight_url</a>";
        
        // Setup smack search and pagination
        $c = new Criteria();
        $c->add(PostsPeer::FIGHTID, $this->fight->getId(), Criteria::EQUAL);
        $c->addDescendingOrderByColumn(PostsPeer::POSTDATE);
        $this->pg->total_results = PostsPeer::doCount($c);
        $this->pg->set_total_pages();
        $c->setLimit($this->pg->limit);
        $c->setOffset(($this->pg->cur_page - 1) * $this->pg->limit);
        $this->pg->set_links($this);
        
        // Make the smack accessable to the template
        $raw_smack_array = PostsPeer::doSelect($c);
        if (!empty($raw_smack_array)) require 'utils/cbf_smackDisplay.php';
        foreach($raw_smack_array as $raw_smack){
            $temp_smack = new cbf_SmackDisplay();
            $temp_smack->user_id = $raw_smack->getUserprofile()->getId();
            $temp_smack->username = "<a href=\"" . cbf_UsersView::getClassAugViewUrl(array('id' => $temp_smack->user_id)) . "\">" . $raw_smack->getUserprofile()->getUsername() . "</a>";
            $temp_smack->date = $raw_smack->getPostdate();
            $temp_smack->body = $raw_smack->getPosttext();
            $temp_smack->body_for_input = $raw_smack->get_posttext_for_input();
            $temp_smack->smack_id = $raw_smack->getId();
            $this->all_smack[] = $temp_smack;
        }
    }
    
    /**
     * Sends a fully processed view to the user's browser that allows
     * the user to edit a fight.
     *
     */
    private function display_fight_view(){
        $this->main_template = 'admin_fights.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public function getViewUrl(){
        return cbf_FightsView::getClassViewUrl();
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
        if ($this->mode == 'fight'){
            $args['id'] = ((array_key_exists('id', $args)) ? $args['id'] : $this->get_args['id']);
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->smack_limit);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->cur_smack_page);
        } else {
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->limit);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->cur_page);
        }
        
        return cbf_FightsView::getClassAugViewUrl($args);
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
        $url = cbf_FightsView::getClassViewUrl();
        
        if (count($args) > 0){ 
            $url .= '?';
            if (array_key_exists('id', $args)){
                $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 20);
                $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1);
            } else {
                // Set needed defaults
                $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 30);
                $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1); 
            }
            
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
        return boris_View::get_class_controller_url() . '/admin/fights';
    }
}
?>