<?php
/**
 * The limited version of the footer of the site
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/14/08
 */

// Menu generator
require_once 'main/cbf_MainLayout.php';

class cbf_LimitedFooterView extends boris_View{
    
    public $footerText;
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->main_template = 'main_limitedFooter.html';
        $this->footerText = cbf_MainLayout::generate_footer_text($this->getCurrentYear());
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    public function getViewUrl(){
        return cbf_LimitedFooterView::getClassViewUrl();
    }
    
    public function getAugViewUrl(){
        return $this->getViewUrl();
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/main';
    }
    
    public static function getClassAugViewUrl(){
        return cbf_LimitedFooterView::getClassViewUrl();
    }
}
?>