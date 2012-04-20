<?php
/**
 * View for the portion of the admin panel that allows a user to add a celebirty.
 * 
 * If the view is called with no arguments then the user will be presented with a screen allowing the user
 * to fill in the required fields for adding a celebirty. If the view is called with a name argument then
 * an attempt will be made to add the celebrity, using a generated reference URL and no picture. If a URL
 * and/or picture is provided then they will be used.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/11/08
 */

class cbf_AddCelebrityView extends cbf_AdminView{
   
    public $celebrity;      // The celebrity object of the new celebrity
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->celebrity = new Names();
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        if (isset($this->post_args['add_celebrity'])) {
            // If the user submitted the form try to add the new celebrity
            try{
                $errors = array();
                
                // Set the name
                $this->celebrity->setName($this->post_args['name']);
                if (!isset($this->post_args['name']) || empty($this->post_args['name'])) 
                        throw new boris_MinorException('You must enter a name for the celebrity');
                
                // Set the reference URL
                if (!isset($this->post_args['reference_url']) || strlen($this->post_args['reference_url']) == 0){
                    // Generate the reference URL based on the name
                    $this->celebrity->setReference('http://www.wikipedia.org/wiki/' . rawurlencode($this->celebrity->getName()));
                } else {
                    // Use the provided reference URL
                    $this->celebrity->setReference($this->post_args['reference_url']);
                }
                
                // Save the new celebirty
                $this->celebrity->save();
                boris_FeedbackStorage::push_message('Celebrity <a href="' . 
                            cbf_CelebritiesView::getClassAugViewUrl(array('id' => $this->celebrity->getId())) . '">' . 
                            $this->celebrity->getName() . '</a> Successfully Added.');
                
                // If a picture is provided, use it
                if (isset($_FILES['picture']) && strlen($_FILES['picture']['name']) > 0){
                    $file = $_FILES['picture'];
                    if (!$file || $file['size'] == 0){
                        throw new boris_MinorException('An error occured while transmitting the picture');
                    } else {
                        PicsPeer::process_new_picture($file, $this->celebrity);
                        boris_FeedbackStorage::push_message('Picture Successfully Added');
                    }
                }
                
                // Everything is successful, so redirect to main celebrities page
                header('Location: ' . cbf_CelebritiesView::getClassViewUrl());
                return 0;
            } catch (boris_MinorException $e){
                $messages = $e->getMessages();
                foreach($messages as $message) boris_FeedbackStorage::push_error($message);
            }
        } 
            
        // Show the standard input view
        $this->show_input_view();
    }
    
    /**
     * Displays the normal view that allows a user to input values for the name,
     * reference url, and picture of the new celebrity.
     *
     */
    private function show_input_view(){
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        $this->main_template = 'admin_addCelebrity.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
        
        $this->output_footer();
    }
    
    /**
     * Adds " - Add Celebrity" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Celebrities - Add Celebrity");
    }
    
    public function getViewUrl(){
        return cbf_AddCelebrityView::getClassViewUrl();
    }
    
    /**
     * Returns a link to this view with a full set of arguments.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){        
        return cbf_AddCelebrityView::getClassAugViewUrl();
    }
    
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_AddCelebrityView::getClassViewUrl();
        return $url;
    }
    
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/celebrities/addCelebrity';
    }
}
?>