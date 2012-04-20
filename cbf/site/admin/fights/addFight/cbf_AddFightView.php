<?php
/**
 * View for the portion of the admin panel that allows a user to add a fight.
 * 
 * If the view is called with no arguments then the user will be presented with a screen allowing the user
 * to select two celebrities. If the view is called with one celebrity ID via GET then the first celebrity
 * will be filled in and the user will be able to select the second celebrity. If two celebrity IDs are 
 * provided then an attempt will be made to add the fight.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/11/08
 */

class cbf_AddFightView extends cbf_AdminView{
   
    public $fight;      		// The celebrity object of the new celebrity
    public $allCelebOptions;	// Properly formated list of option tags containing all available celebrities.
    public $celeb1Options;		// List of option tags for the celeb1 select box.
    public $celeb2Options;		// List of option tags for the celeb2 select box.
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->fight = new Fights();
        $this->celebOptions = "";
        
        $this->javascripts[] = 'admin_addFight.js';
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        if (isset($this->post_args['add_fight'])) {
            // If the user submitted the form try to add the new fight
            try{
                // Set the ids of the two fighters
                $this->fight->setOneid($this->post_args['celeb1']);
                $this->fight->setTwoid($this->post_args['celeb2']);
                
                // A celebrity can not fight themselves
                // TODO This should be taken care of in validation
                if ($this->fight->getOneid() === $this->fight->getTwoid()){
                	throw new Exception('A Celebrity may not fight themselves.', 10);
                }
                
                // Make sure the fight doesn't already exist
                $search_result = FightsPeer::get_fight_by_celebrities($this->fight->getOneid(), $this->fight->getTwoid());
				if (!is_null($search_result)){
					throw new Exception('The submitted fight already exists.', 10);
				}
				
				// Save the new fight
                $this->fight->save();
                boris_FeedbackStorage::push_message('Fight <a href="' . 
                            cbf_FightsView::getClassAugViewUrl(array('id' => $this->fight->getId())) . '">' . 
                            $this->fight->toString() . '</a> Successfully Added.');
                
                // Everything is successful, so redirect to main celebrities page
                header('Location: ' . cbf_FightsView::getClassViewUrl());
            } catch (Exception $e){
                // Push the error message and display the input view
                if ($e->getCode() == 10){
                    boris_FeedbackStorage::push_error($e->getMessage());
                    $this->show_input_view();
                }
            }
        } else {
            // Show the standard input view
            $this->show_input_view($this->get_args['celeb1ID']);
        }
    }
    
    /**
     * Displays the normal view that allows a user to input values for the name,
     * reference url, and picture of the new celebrity.
     *
     */
    private function show_input_view($celeb1ID = NULL){
    	/*
    	 * Create the list of option tags of celebrities
    	 */
        $c = new Criteria();
        $c->addAscendingOrderByColumn(NamesPeer::NAME);
    	$all_celebs = NamesPeer::doSelect($c);
    	$all_options = "";
    	foreach($all_celebs as $celeb){
    		$all_options .= '<option ';
    		$all_options .= "value=\"" . $celeb->getId() . "\"";
    		$all_options .= '>';
    		$all_options .= $celeb->getName();
    		$all_options .= "</option>\n";
    	}
    	
    	$this->allCelebOptions = "<select id=\"allOptionsSelect\">\n";
    	$this->allCelebOptions .= $all_options;
    	$this->allCelebOptions .= "</select>";
    	
    	$this->celeb2Options = "<select id=\"celeb2\" name=\"celeb2\" size=\"20\">\n";
    	$this->celeb2Options .= $all_options;
    	$this->celeb2Options .= "</select>";
    	
   		/*
   		 * Celeb1 has a special case
   		 */
    	$this->celeb1Options = "<select id=\"celeb1\" name=\"celeb1\" size=\"20\">\n";
    	if ($celeb1ID != NULL){
	    	foreach($all_celebs as $celeb){
	    		$this->celeb1Options .= '<option ';
	    		$this->celeb1Options .= "value=\"" . $celeb->getId() . "\"";
	    		if ($celeb1ID == $celeb->getId()){
	    			$this->celeb1Options .= " selected=\"yes\"";
	    		}
	    		$this->celeb1Options .= '>';
	    		$this->celeb1Options .= $celeb->getName();
	    		$this->celeb1Options .= "</option>\n";
	    	}
    	} else {
    		$this->celeb1Options .= $all_options;
    	}
    	$this->celeb1Options .= "</select>";
    	
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        $this->main_template = 'admin_addFight.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        
        $this->output_footer();
    }
    
    /**
     * Adds " - Add a Fight" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Fights - Add a Fight");
    }
    
    public function getViewUrl(){
        return cbf_AddFightView::getClassViewUrl();
    }
    
    /**
     * Returns a link to this view with a full set of arguments.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){        
        return cbf_AddFightView::getClassAugViewUrl($args);
    }
    
    /**
     * Static method that returns a link to this view with arguments.
     *
     * @param array $args
     * @return string
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_AddFightView::getClassViewUrl();
        if (isset($args['celeb1ID'])){
        	$url .= "?celeb1ID={$args['celeb1ID']}";
        }
        return $url;
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/fights/addFight';
    }
}
?>