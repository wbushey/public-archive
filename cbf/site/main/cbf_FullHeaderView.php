<?php
/**
 * The full version of the header of the site
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/16/08
 */

// Menu generator
require_once 'main/cbf_MainLayout.php';

class cbf_FullHeaderView extends boris_View{
    
    public $menu;               // HTML required to display the left hand menu
    public $top;                // HTML to display the ad at the top
    public $right_1;            // HTML to display the sky ad on the right
    public $previous_fight;     // The previous fight that is being displayed
    public $winner;             // The winning celebrity of the previous fight
    public $winner_percentage;  // Percent of times the winner won the fight
    public $loser;              // The losing celebrity of the previous fight
    public $loser_percentage;  // Percent of times the loser won the fight
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->setPageTitle();
        
        $this->header = 'main_commonHeader.html';
        $this->main_template = 'main_fullHeader.html';
        
        $this->menu = cbf_MainLayout::generate_menu($this->isLoggedIn());
        $ad = AdPeer::get_random_ad(AdPeer::$RIGHT_1);
        if (!is_null($ad) && $ad instanceof Ad) $this->right_1 = $ad->getCode();
        $ad = AdPeer::get_random_ad(AdPeer::$TOP);
        if (!is_null($ad) && $ad instanceof Ad) $this->top = $ad->getCode();
    }
    
    /**
     * Sets the previous fight variable, which the view will use to display
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
            $this->set_percentages($this->previous_fight->getOnewins());
        } else {
            $this->winner = $this->previous_fight->getNamesRelatedByTwoid();
            $this->loser = $this->previous_fight->getNamesRelatedByOneid(); 
            $this->set_percentages($this->previous_fight->getOnewins());
        }
    }
    
    private function set_percentages($wins){
        $this->winner_percentage = (int)(($wins/$this->previous_fight->getTotalFights()) * 100);
        $this->loser_percentage = 100 - $this->winner_percentage;
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        $this->output_header();
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }

    /**
     * Sets the page title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle($page_title);
    }

    public function getViewUrl(){
        return cbf_MainView::getClassViewUrl();
    }
    
    public function getAugViewUrl(){
        return $this->getViewUrl();
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/main';
    }
    
    public static function getClassAugViewUrl(){
        return cbf_MainView::getClassViewUrl();
    }
}
?>