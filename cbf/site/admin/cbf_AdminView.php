<?php
/**
 * Main and default view for the administration portion of the site.
 * 
 * The general layout of this view is meant to be inherited and used by
 * all the pages within the administration panel.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 7/15/08
 */

class cbf_AdminView extends boris_View{
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->setPageTitle();
        
        $this->header = 'admin_header.html';
        $this->footer = 'admin_footer.html';
        
        $this->required_type = UserprofilePeer::$ADMIN_USER;
        $names = boris_ClassLoader::getNames($_SERVER['REQUEST_URI']);
        if (($this->isAuthorized() == false) && $names['class_name'] != 'cbf_LoginView'){
            boris_FeedbackStorage::push_error('You must be an administrator to view this page.');
            $this->redirecting = true;
            header('Location: ' . cbf_LoginView::getClassViewUrl().'?uri=' . $_SERVER['REQUEST_URI']);
        }
    }
    
    /**
     * <Description of view>
     *
     */
    public function process_view(){
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        $this->output_header();
        echo "Admin";
        $this->output_footer();
    }

    /**
     * Adds " - Admin Panel" to the title.
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Admin Panel$page_title");
    }

    public function getViewUrl(){
        return cbf_AdminView::getClassViewUrl();
    }
    
    public function getAugViewUrl(){
        return $this->getViewUrl();
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin';
    }
    
    public static function getClassAugViewUrl(){
        return cbf_AdminView::getClassViewUrl();
    }
}
?>