<?php
/**
 * The limited version of the header of the site
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/14/08
 */

// Menu generator
require_once 'main/cbf_MainLayout.php';

class cbf_LimitedHeaderView extends boris_View{
    
    public $menu;       // HTML required to display the left hand menu
    public $top;        // HTML to display the ad at the top
    public $right_1;    // HTML to display the sky ad on the right
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->setPageTitle();
        
        $this->header = 'main_commonHeader.html';
        $this->main_template = 'main_limitedHeader.html';
        
        $this->menu = cbf_MainLayout::generate_menu($this->isLoggedIn());
        $ad = AdPeer::get_random_ad(AdPeer::$RIGHT_1);
        if (!is_null($ad) && $ad instanceof Ad) $this->right_1 = $ad->getCode();
        $ad = AdPeer::get_random_ad(AdPeer::$TOP);
        if (!is_null($ad) && $ad instanceof Ad) $this->top = $ad->getCode();
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