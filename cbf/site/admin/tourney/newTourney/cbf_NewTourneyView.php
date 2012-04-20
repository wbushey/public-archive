<?php
/**
 * View for the portion of the admin panel that allows a user to create a new tournament.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 5/11/09
 */

class cbf_NewTourneyView extends cbf_AdminView{
	
	public $celebs = array();	// Array of all celebrities
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->javascripts[] = 'admin_newTourney.js';
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        if (isset($this->post_args['add_tourney'])) {
        	try{
	            // If the user submitted the form try to add the new tournament
	            
	            // Make sure there are 2^x fighters
	            if (!is_int(log(count($this->post_args['celebs']), 2))){
	            	throw new boris_MinorException('The number of celebrities must be a power of 2');
	            };
	            
	            // Create a new tournament
	            $tourney = TourneyStatusPeer::buildNewTournament($this->post_args['celebs']);
	            
	            
        	} catch (boris_MinorException $e){
        		$messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
        	}
        } 
        
        /*
         * Retrieve all celebrities
         */
         $c = new Criteria();
         $c->addAscendingOrderByColumn(NamesPeer::NAME);
         $this->celebs = NamesPeer::doSelect($c);
        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        $this->main_template = 'admin_newTourney.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        
        $this->output_footer();
    }
    
    /**
     * Allows the view to create links to celebrity pages
     */
    public function getCelebLink(Names $celeb){
    	return cbf_CelebritiesView::getClassAugViewUrl(array('id' => $celeb->getId()));
    }
    
    /**
     * Adds " - Add Celebrity" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Tournaments - Create a Tournament");
    }
    
    public function getViewUrl(){
        return self::getClassViewUrl();
    }
    
    /**
     * Returns a link to this view with a full set of arguments.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){        
        return self::getClassAugViewUrl();
    }
    
    public static function getClassAugViewUrl(array $args = array()){
        $url = self::getClassViewUrl();
        return $url;
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/tourney/newTourney';
    }
}
?>