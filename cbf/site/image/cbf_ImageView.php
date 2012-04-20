<?php
/**
 * View which displays an image stored in the database.
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/17/2009
 */

class cbf_ImageView extends boris_View{
    
    private $image_id;      // ID of the requested image
    private $image;         // Image object of the requested image
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        $this->image_id = $this->get_args['iID'];
    }
    
    public function process_view(){
        
        if (isset($this->image_id)){
            if(!is_numeric($this->image_id)){
                echo 'Improper argument provided.';
                exit();
            }
            
            /*
             * Retrieval Mode
             */
            $this->image = ImagePeer::retrieveByPK($this->image_id);
            if (is_null($this->image)){
                echo 'The requested image could not be found.';
                exit();
            }
            
            // Output header
            Header ( 'Content-Type: ' . $this->image->getDatatype());
            Header ( 'Content-Length: ' . $this->image->getSize());
            Header ( 'Content-Disposition: attachment; filename=' . $this->image->getName());
            
            // Send image a node at a time
            $this->image->init_data();
            while ($this->image->has_more_data()){
                echo $this->image->get_next_data_node();
            }
        } 
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return string
     */
    public function getViewUrl(){
        return cbf_ImageView::getClassViewUrl();  
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
        $args['iID'] = ((array_key_exists('iID', $args)) ? $args['iID'] : $this->image_id);
        return cbf_ImageView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns the base url for this class.
     *
     * @return string
     */
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/image';
    }
    
    /**
     * Returns the URL for this class augmented with GET arguments.
     * The GET arguments can be set by providing an associative array of the form
     *          $args['argument_name'] => 'argument_value'
     * 
     * The arguments for this view are:
     *      iID - The ID number of the requested image
     * 
     * @return string
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_ImageView::getClassViewUrl();
            
        // Build the string
        $url = parent::build_augmented_url($url, $args);
        
        return $url;
    }
    
}
?>