<?php
/**
 * View for the portion of the admin panel that allows a user to view and edit IP bans.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 3/23/09
 */

// Pagination
require_once('utils/Pagination.php');
require_once('utils/Bans.php');

class cbf_IpBansView extends cbf_AdminView{
    
    /* Bans and Pagination */
    public $results = array();              // All bans to be displayed
    public $pg;                             // Pagination 
    
    
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->main_template = 'admin_ipBans.html';
        
        /*$this->javascripts[] = 'popupDiv.js';
        $this->javascripts[] = 'admin_users.js';
        $this->javascripts[] = 'sendPost.js';*/
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        /*
         * If submitted, add a new ban
         */
         if (isset($this->post_args['ban_button'])){
         	$new_ban = new Bannedips();
         	try{
	         	$new_ban->parseIpAndMaskString($this->post_args['ip_address']);
	         	if ($this->post_args['days'] == 0){
	         		$new_ban->setTtd(0);
	         	} else {
	         		$new_ban->setTtd(strtotime("+" . $this->post_args['days'] . " day"));
	         	}
	         	$new_ban->save();
	         	boris_FeedbackStorage::push_message($new_ban->getIpAndMaskString() . ' has been successfully banned.');
         	}catch(boris_MinorException $e){
         		boris_FeedbackStorage::push_error($e->getMessage());
         	}
         }
         
         /*
          * If submitted, remove a ban
          */
          if(isset($this->get_args['del'])){
          	$del_ban = new Bannedips();
          	$del_ban->parseIpAndMaskString($this->get_args['del']);
          	$del_ban = BannedipsPeer::retrieveByPK($del_ban->getIp(), $del_ban->getShift());
          	if (!$del_ban || ! $del_ban instanceof Bannedips) {
          		boris_FeedbackStorage::push_error($this->get_args['del'] . ' could not be found.');
          	} else {
          		$del_ban->delete();
          		boris_FeedbackStorage::push_message($del_ban->getIpAndMaskString() . ' ban has been successfully removed.');
          	}
          }
        
        /*
         * Handle Pagination and arguments
         * l: Number of results to display per page
         * p: Desired page number of results
         */
        $this->pg = new Pagination();
        $criteria = array();
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 30;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = BannedipsPeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        // Create pagination links  
        $this->pg->set_links($this);
        
        // Set standard search attributes and execute the search
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        $criteria['order_by'] = BannedipsPeer::IP . ' asc';
        $this->results = BannedipsPeer::adv_search($criteria);
        
        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
       
        
        $this->output_footer();
    }
    
    /**
     * Adds " - Users" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - IP Bans$page_title");
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public function getViewUrl(){
        return cbf_IpBansView::getClassViewUrl();
    }
    
    /**
     * Returns a link to the current instance of the view with a full set of arguments.
     * 
     * An array of the following form may be passed:
     *      $args['argument_name'] => 'argument_value'
     * If an argument exists in the provided array as a key then the associated value
     * will be used when generated the link. Otherwise, the value that generated the current
     * instance of the view, or the default value, will be used.
     *
     * @param array $args
     * @return string
     */
    public function getAugViewUrl(array $args = array()){        
        return cbf_IpBansView::getClassAugViewUrl($args);
    }
    
    /**
     * Returns a link to this view with a full set of arguments.
     * 
     * An array of the following form may be passed:
     *      $args['argument_name'] => 'argument_value'
     * If an argument exists in the provided array as a key then the associated value
     * will be used when generated the link. Otherwise, a default value will be used.
     *
     * @param array $args
     * @return unknown
     */
    public static function getClassAugViewUrl(array $args = array()){
        $url = cbf_IpBansView::getClassViewUrl();
        
        if (count($args) > 0){ 
            $url .= '?';
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 30);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1);
            
            // Build the string
            $arg = each($args);
            $url .= $arg['key'] . '=' . $arg['value'];
            while ($arg = each($args)){
                $url .= '&' . $arg['key'] . '=' . $arg['value'];
            }
        }
        
        return $url;
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public static function getClassViewUrl(){
        return boris_View::get_class_controller_url() . '/admin/bans/ipBans';
    }
}
?>