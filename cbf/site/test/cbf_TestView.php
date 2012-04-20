<?php
/**
 * View used for testing code
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 05/06/09
 */


class cbf_TestView extends boris_View{
	
	
	public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        $this->setPageTitle();
	}

	public function process_view(){
        $this->header = new cbf_LimitedHeaderView(array(), array());
        $this->footer = new cbf_LimitedFooterView(array(), array());
        
        /* Testing creation of tournament fight */
        //## First, test creation of tournament fight for already existing general fight ##
        /*$oneID = 4; //William Shatner
        $twoID = 3; //Sean Connery
    	// Add them to the list of tournament fighters (otherwise the tournament fight won't be created)
    	$one_tourney_fighter = new TourneyFighters();
    	$one_tourney_fighter->setFighterId($oneID);
    	$one_tourney_fighter->save();
    	$two_tourney_fighter = new TourneyFighters();
    	$two_tourney_fighter->setFighterId($twoID);
    	$two_tourney_fighter->save();
        // Create tournament fight
        $tourny_fight = new TourneyFights();
        $tourny_fight->setOneid($one_tourney_fighter->getFighterId());
        $tourny_fight->setTwoid($two_tourney_fighter->getFighterId());
        $tourny_fight->save();*/
        
		
		//## Second, test creation of tournament fight for already existing general fight ##
		/*$oneID = 131; //Bob Newhart
        $twoID = 151; //G. W. Bush
    	// Add them to the list of tournament fighters (otherwise the tournament fight won't be created)
    	$one_tourney_fighter = new TourneyFighters();
    	$one_tourney_fighter->setFighterId($oneID);
    	$one_tourney_fighter->save();
    	$two_tourney_fighter = new TourneyFighters();
    	$two_tourney_fighter->setFighterId($twoID);
    	$two_tourney_fighter->save();
        // Create tournament fight
        $tourny_fight = new TourneyFights();
        $tourny_fight->setOneid($one_tourney_fighter->getFighterId());
        $tourny_fight->setTwoid($two_tourney_fighter->getFighterId());
        $tourny_fight->save();*/
		
		
		/* Test Creation of Fight */
		// Get 256 random fighters
		$c = new Criteria();
		$c->setLimit(8);
		$fighters = NamesPeer::doSelect($c);
		$fighterIds = array();
		foreach($fighters as $fighter){
			$fighterIds[] = $fighter->getId();
		}
		
		$tourney = TourneyStatusPeer::buildNewTournament($fighterIds);
		
		echo 'Success';
		
		
		$this->output_header();        
        $this->output_footer();
	}
	
    /**
     * Adds " - Testing" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Testing$page_title");
    }
	
	/**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
	public function getViewUrl(){
		return cbf_TestView::getClassViewUrl();	
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
		return cbf_TestView::getClassAugViewUrl($args);
	}
	
	/**
	 * Returns the base url for this class.
	 *
	 * @return string
	 */
	public static function getClassViewUrl(){
		return boris_View::get_class_controller_url() . '/test';
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
		$url = cbf_TestView::getClassViewUrl();
			
		// Build the string
        $url = parent::build_augmented_url($url, $args);
		
		return $url;
	}
}
?>