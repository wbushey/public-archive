<?php
/**
 * The full version of the footer of the site
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/11/2009
 */

// Pagination
require_once('utils/Pagination.php');

class cbf_FullFooterView extends boris_View{
    
    public $previous_fight;     // The fight to display smack for
    public $comments;           // Comments posted about the fight
    public $comment_submission; // Text to display allowing the user to make a comment
    public $pg;                 // Pagination
    public $winner;             // The winning celebrity in the previous fight
    public $loser;              // The losing celebrity in the previous fight
    public $footerText;
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->main_template = 'main_fullFooter.html';
        $this->footerText = cbf_MainLayout::generate_footer_text($this->getCurrentYear());
    }
    
    /**
     * Sets the previous fight variable, which the view will use do display
     * information about the previous fight
     *
     * @param Fights $previous_fight
     */
    public function set_previous_fight($previous_fight, $winningID){
    	if (!($previous_fight instanceof Fights)) return;

        $this->previous_fight = $previous_fight;
        if ($this->previous_fight->getNamesRelatedByOneid()->getId() == $winningID){
            $this->winner = $this->previous_fight->getNamesRelatedByOneid();
            $this->loser = $this->previous_fight->getNamesRelatedByTwoid();
        } else {
            $this->winner = $this->previous_fight->getNamesRelatedByTwoid();
            $this->loser = $this->previous_fight->getNamesRelatedByOneid(); 
        }
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        $criteria = array();
        $this->pg = new Pagination();
        
        // Search for the correct fightID
        $criteria['fightID'] = $this->previous_fight->getId();
        
        /*
         * Process Arguements
         * Allowable Get Arguments
         *  l: Number of results to display per page
         *  p: Desired page number of results
         */
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 10;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = PostsPeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        
        // Set the display of links and form inputs      
        $this->pg->set_links($this);
        // Hack to not show page listings if there is only one page
        if ($this->pg->total_pages <= 1) $this->pg->pg_listings = array();
        
        // Get comments
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        $criteria['order_by'] = PostsPeer::POSTDATE . ' asc';
        $this->comments = PostsPeer::adv_search($criteria);
        
        $this->comment_submission = $this->get_comment_submission_text();
        
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Generates the display for submitting comments.
     *
     * @return string
     */
    private function get_comment_submission_text(){
        if ($this->isLoggedIn()){
            $main_address = cbf_MainView::getAugViewUrl();
            $text = <<< END_OF_COMMENT_SUBMISSION
        <form id="commentSubmission" action="$main_address" method="post">
          <textarea name="commentBody" cols="80" rows="20"></textarea>
          <p><input class="submitButton" type="submit" name="commentSubmit" value="Submit Smack"/></p>
        </form>
END_OF_COMMENT_SUBMISSION;
        } else {
            $login_address = cbf_LoginView::getClassViewUrl();
            $text = <<< END_OF_MESSAGE
        <h2>You must <a href="$login_address">login</a> to talk smack.</h2>
END_OF_MESSAGE;

        }
        return $text;
    }
    
/**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_FullFooterView::getClassViewUrl();
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
        $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->pg->limit);
        $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->pg->cur_page);
    
        return cbf_FullFooterView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns the base url for this class.
     *
     * @return string
     */
    public static function getClassViewUrl(){
        return cbf_MainView::getClassViewUrl();
    }
    
    /**
     * Returns the URL for this class augmented with GET arguments.
     * The GET arguments can be set by providing an associative array of the form
     *          $args['argument_name'] => 'argument_value'
     * 
     * The following arguments are usable:
     *      $args['fID']    - The ID of a specific fight to make as the current fight
     *      $args['l']      - The number of comments to display
     *      $args['p']      - The page of comments to display, based on the above $args['l']
     * 
     * @param array $args
     * @return string
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_FullFooterView::getClassViewUrl();
        
        // Build the string
        $url = parent::build_augmented_url($url, $args);

        return $url;
    }
}
?>