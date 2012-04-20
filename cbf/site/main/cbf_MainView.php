<?php
/**
 * Main and default view for the main portion of the site.
 * 
 * The general layout of this view is meant to be inherited and used by
 * all the pages within the main portion of the site. This view also 
 * processes and displays the principle functional view of the site.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 12/24/08
 * TODO: Add ability to either serve gif or png verions of logo and vs.
 */

class cbf_MainView extends boris_View{
    
    private $fight_stack = array();     //Sequence of fights to work through
    
    public $current_fight;      // The fight that is to be displayed
    public $left_fighter;       // The fighter who appears on the left side
    public $right_fighter;      // The fighter who appears on the right side
    private $previous_fight;     	// The fight that previously occured
    private $previous_winner_id;	// The ID of the celebrity who won the previous fight
    
    // Provided arugments
    private $fID;				// ID of a specific fight requested by the user
   	private $current_winner_id;	// ID of the celebrity who won the current fight
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->left_fighter = new Names();
        $this->right_fighter = new Names();
        
        // Set current and previous fights based on what is in the session
        $this->current_fight = unserialize($_SESSION['current_fight']);
        $this->previous_fight = unserialize($_SESSION['previous_fight']);
        $this->previous_winner_id = unserialize($_SESSION['previous_winner_id']);
        
        // Default header and footer
        $this->header = new cbf_LimitedHeaderView(array(), array());
        $this->footer = new cbf_LimitedFooterView(array(), array());
        
        /*
         * Set important components of page
         */
        $this->setPageTitle();
        $this->main_template = 'main_main.html';
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        /*
         * Process arguments
         */
        //fID
        $this->fID = $this->get_args['fID'];
    	// Winner
        if (isset($this->post_args['winner'])){
        	$this->current_winner_id = $this->post_args['winner'];
        	$this->process_winner();	 
        }
        
        // Comment Submission
        if (isset($this->post_args['commentSubmit'])){
            $new_post = new Posts();
            $new_post->set_posttext_from_input($this->post_args['commentBody']);
            $new_post->setUserprofile($this->user);
            $new_post->setFights($this->previous_fight);
            $new_post->setPostdate(time());
            $new_post->save();
        }
        
        /*
         * Advance fight sequence
         */
        // Advance previous fight
        if (isset($this->current_winner_id)){
        	$this->set_previous_fight($this->current_fight);
        	$this->set_previous_winner_id($this->current_winner_id);
        } else {
        	$this->set_previous_fight($this->previous_fight);
        	$this->set_previous_winner_id($this->previous_winner_id);
        }
        // Advance current fight
        if (isset($this->post_args['commentSubmit'])){
        	$this->set_current_fight($this->current_fight);
        } else {
        	$this->set_current_fight($this->get_next_fight());
        }
        
        /*
         * Output
         */
        if ($this->has_previous_fight()){
            // Use the full view if needed
            $this->header = new cbf_FullHeaderView(array(), array());
            $this->footer = new cbf_FullFooterView($this->get_args, $this->post_args);
            $this->header->set_previous_fight($this->previous_fight, $this->previous_winner_id);
            $this->footer->set_previous_fight($this->previous_fight, $this->previous_winner_id);
        }
        $this->set_fight_variables();
        
        $this->output_header();
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        $this->output_footer();
    }
    
    /**
     * Returns the next fight in the fight sequence.
     *
     * The sequence of fights can be thought of as follows:
     * 		F0, F1, ..., previous_fight, current_fight, get_next_fight(), ... , Fn
     * 	Where Fx stands for the x fight in the sequence, n is the total number of fights
     * 	available, previous_fight is the fight displayed on the left side, current_fight is
     * 	the fight displayed in the main area and get_next_fight() is the next fight in the
     * 	sequence. Via get_next_fight(), the sequence can be temporarily interupted by the
     * 	fID argument. Also, get_next_fight automatically regenerates the sequence in the event
     * 	that get_next_fight() = Fn.
     */
    private function get_next_fight(){
    	if (isset($this->fID)){
        	return FightsPeer::retrieveByPK($this->fID);
        } else {
        	// If no fID then use the fight_stack
        	$this->fight_stack = $this->get_fight_stack();
        	$next_fight = FightsPeer::retrieveByPK(array_pop($this->fight_stack));
        	$_SESSION['fight_stack'] = serialize($this->fight_stack);
	        return $next_fight;
        }
    }
    
    /**
     * Set the value of the previous fight variable, both in the current
     * view instance and in the session.
     *
     * @param Fights $pre_fight
     */
    private function set_previous_fight($pre_fight){
    	$this->previous_fight = $pre_fight;
    	$_SESSION['previous_fight'] = serialize($pre_fight);
    }
    
    /**
     * Set the value of the previous_winner_id variable, both in the
     * current view instance and in the session.
     *
     * @param integer $pre_winner_id
     */
    private function set_previous_winner_id($pre_winner_id){
    	$this->previous_winner_id = $pre_winner_id;
    	$_SESSION['previous_winner_id'] = serialize($pre_winner_id);
    }
    
    /**
     * Set the value of the current fight variable, both in the current
     * view instance and in the session.
     *
     * @param Fights $cur_fight
     */
    private function set_current_fight(Fights $cur_fight){
    	$this->current_fight = $cur_fight;
    	$_SESSION['current_fight'] = serialize($cur_fight);
    }
    
    /**
     * Indicates if there is a previous fight to display
     */
    private function has_previous_fight(){
        return (isset($this->previous_fight) && ($this->previous_fight instanceof Fights));
    }

    /**
     * Returns the fight stack.
     */
    private function get_fight_stack(){
    	$fight_stack = unserialize($_SESSION['fight_stack']);
	    if (!isset($fight_stack) || !($fight_stack) || empty($fight_stack)){
            $fight_stack = FightsPeer::get_active_fight_ids();
            shuffle($fight_stack);
        }
        
        return $fight_stack;
    }
    
    /*
     * Sets the public fighter variables based on the current_fight variable
     */
    private function set_fight_variables(){
    	if (!isset($this->current_fight) || !($this->current_fight instanceof Fights))
    		throw new Exception('No or bad value set for current fight');
    		
    	if ((rand() % 2) == 0){
    		$this->left_fighter = $this->current_fight->getNamesRelatedByOneid();
        	$this->right_fighter = $this->current_fight->getNamesRelatedByTwoid();	
    	} else {
    		$this->left_fighter = $this->current_fight->getNamesRelatedByTwoid();
    		$this->right_fighter = $this->current_fight->getNamesRelatedByOneid();
    	}
    }
    
    /**
     * Does the processing required when an winner ID is submitted.
     */
    private function process_winner(){
    	// Make sure there is a fight to process
    	if (!isset($this->current_fight)){
    		unset($this->current_winner_id);
        	throw new Exception('Winner was provided even though no fight occured.');
        	return;
        }
        
        // Make sure the submitted ID applies to the previous fight
        if (!$this->current_fight->has_celeb_id($this->current_winner_id)){
        	unset($this->current_winner_id);
        	return;
        }
        
        if ($this->current_fight->getNamesRelatedByOneid()->getId() == $this->current_winner_id){
        	$this->current_fight->incrementOnewins();
        } elseif($this->current_fight->getNamesRelatedByTwoid()->getId() == $this->current_winner_id) {
        	$this->current_fight->incrementOnewins();
        }
        
        // Save the processed fight and return
        $this->current_fight->save();
    }

    /**
     * Set the winner_id value in the session
     *
     * @param unknown_type $id
     */
    private function set_session_winner_id($id){
    	$_SESSION['winner_id'] = serialize($id);
    }
    
    /**
     * Get the winner_id value from the session
     *
     * @return unknown
     */
    private function get_session_winner_id(){
    	return unserialize($_SESSION['winner_id']);
    }
    
    /**
     * Sets the page title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        $this->header->setPageTitle($page_title);
    }

    /**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_MainView::getClassViewUrl();
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
        $args['fID'] = ((array_key_exists('fID', $args)) ? $args['fID'] : $this->fID);
    
        return cbf_MainView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns the base url for this class.
     *
     * @return string
     */
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/main';
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
        $url = cbf_MainView::getClassViewUrl();
        
        // Build the string
        $url = parent::build_augmented_url($url, $args);

        return $url;
    }
}
?>