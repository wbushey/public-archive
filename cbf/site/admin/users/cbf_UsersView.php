<?php
/**
 * View for the portion of the admin panel that allows a user to edit a user's information.
 * 
 * The has two modes, search mode and display mode. Search mode allows the user to search for
 * and browse the users who are registered for the site by username, email address, or last 
 * used IP address. Display mode allows the user to view and edit a particular user. Unless 
 * an id argument is provided this view will default to search mode. If an id argument is 
 * provided for a user who is not registered then the view will go into search mode.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/11/08
 */

// Pagination
require_once('utils/Pagination.php');
require_once('utils/Bans.php');

class cbf_UsersView extends cbf_AdminView{
    
    
    public $working_user;				// Holds the user that the client wants to work on
    public $is_banned;					// Indicates if the user is banned in anyway
    public $is_email_banned;			// Indicates if the user is banned by email
    public $email_ban;					// The Bannedemail object
    public $is_username_banned;			// Indicates if the user is banned by username
    public $username_ban;				// The Bannedusername object
    public $is_ip_banned;				// Indicates if the user is banned by ip
    public $ip_bans = array();			// The Bannedip object
    
    public $banned_by_username_options;
    public $banned_by_email_options;
    public $banned_by_ip_options;
    
    /* Smack and Smack Pagination */
    public $results = array();              // All smack/search results
    public $pg;                             // Pagination 
    
    // Arguments for search
    public $query;                 		// Query used during search
    public $search_by;					// Indicates if a search occured based on username, email address or IP address.
    public $banned_by_username;			// Search for users who are banned by username?
    public $banned_by_email;			// Search for users who are banned by email address?
    public $banned_by_ip;				// Search for users who are banned by ip address?
    
    
    
    public function __construct(array $get_args, array $post_args){
        parent::__construct($get_args, $post_args);
        
        $this->email_ban = new Bannedemails();
        $this->username_ban = new Bannedusernames();
        
        if (isset($this->get_args['id'])){
            $this->working_user = UserprofilePeer::retrieveByPK($this->get_args['id']);
            
            if ($this->working_user) $this->mode = 'user';
            else $this->mode = 'search';
        }
        else $this->mode = 'search';
        
        $this->javascripts[] = 'popupDiv.js';
        $this->javascripts[] = 'admin_users.js';
        $this->javascripts[] = 'sendPost.js';
    }
    
    /**
     * Decides which view to display to the user based on the arguments
     * provided to via the constructor.
     */
    public function process_view(){
        
        // Don't bother processing the view if redirecting
        if ($this->redirecting) return;
        
        // Decide which view to process
        if ($this->mode == 'user') $this->process_user_view();
        else $this->process_search_and_browse_view();
        
        /* 
         * Send everything to the user 
         */
        $this->output_header();
        
        // Decide which view to output
        if ($this->mode == 'user') $this->display_user_view();
        else $this->display_search_and_browse_view();
        
        $this->output_footer();
    }
    
    /**
     * Adds " - Users" to the title
     *
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        parent::setPageTitle(" - Users$page_title");
    }
    
    /**
     * Performs the processing needed to display a page for searching and
     * browsing celebrities.
     *
     */
    private function process_search_and_browse_view(){
        $criteria = array();
        $this->pg = new Pagination();
        
        /*
         * Process Arguements
         * Allowable Arguments
         *  search_by: What field to use during searching
         *  query: Query to search for
         *  banned_by_username: Search for users who are banned by username?
         *  banned_by_email: Search for users who are banned by email address?
         *  banned_by_ip: Search for users who are banned by ip address?
         *  l: Number of results to display per page
         *  p: Desired page number of results
         */
        
        // Argument search_by
        $this->search_by = $this->get_args['search_by'];
        switch ($this->search_by){
            case 'Email Address':
                $criteria['search_by'] = 'email';
                break;
            case 'IP Address':
                $criteria['search_by'] = 'ip';
                break;
            default:
            	$criteria['search_by'] = 'username';
                $this->search_by = 'User Name';
                break;
        }
        
        // Argument query
        if (isset($this->get_args['query']) && !empty($this->get_args['query'])){
            $this->query = $this->get_args['query'];
            $criteria['query'] = $this->query;
        }
        
        // Argument banned_by_username
        $this->banned_by_username = $this->get_args['banned_by_username'];
        switch ($this->banned_by_username){
            case 'Yes':
                $criteria['banned_by_username'] = true;
                break;
            case 'No':
                $criteria['banned_by_username'] = false;
                break;
            default:
                $this->banned_by_username = '--';
                break;
        }
        
        // Argument banned_by_email
        $this->banned_by_email = $this->get_args['banned_by_email'];
        switch ($this->banned_by_email){
            case 'Yes':
                $criteria['banned_by_email'] = true;
                break;
            case 'No':
                $criteria['banned_by_email'] = false;
                break;
            default:
                $this->banned_by_email = '--';
                break;
        }
        
        // Argument banned_by_ip
        $this->banned_by_ip = $this->get_args['banned_by_ip'];
        switch ($this->banned_by_ip){
            case 'Yes':
                $criteria['banned_by_ip'] = true;
                break;
            case 'No':
                $criteria['banned_by_ip'] = false;
                break;
            default:
                $this->banned_by_ip = '--';
                break;
        }
        
        // Argument l
        $this->pg->limit = $this->get_args['l'];
        if (is_null($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit <= 0) $this->pg->limit = 30;
        $criteria['limit'] = $this->pg->limit;
        // Need to do checks against total_pages later, so set it now
        $this->pg->total_results = UserprofilePeer::adv_count($criteria);
        
        // Arugment p
        $this->pg->cur_page = $this->get_args['p'];
        $this->pg->set_total_pages();        
        
        
        /******************************************* 
         *Set the display of links and form inputs 
         *******************************************/     
        $this->pg->set_links($this);
        
        // Set the options for search_by
        $this->search_by_options = "<select name=\"search_by\" id=\"search_by\">\n";
        foreach(array('User Name', 'Email Address', 'IP Address') as $v){
            $this->search_by_options .= '<option' . (($this->search_by == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->search_by_options .= "</select>";
        
        // Set the options for banned_by_username
        $this->banned_by_username_options = "<select name=\"banned_by_username\" id=\"banned_by_username\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->banned_by_username_options .= '<option' . (($this->banned_by_username == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->banned_by_username_options .= "</select>";
        
        // Set the options for banned_by_email
        $this->banned_by_email_options = "<select name=\"banned_by_email\" id=\"banned_by_email\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->banned_by_email_options .= '<option' . (($this->banned_by_email == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->banned_by_email_options .= "</select>";
        
        // Set the options for banned_by_ip
        $this->banned_by_ip_options = "<select name=\"banned_by_ip\" id=\"banned_by_ip\">\n";
        foreach(array('--', 'Yes', 'No') as $v){
            $this->banned_by_ip_options .= '<option' . (($this->banned_by_ip == $v) ? ' selected>' : '>') . $v . "</option>\n";
        }
        $this->banned_by_ip_options .= "</select>";
        
        // Set standard search attributes and execute the search
        $criteria['offset'] = ($this->pg->cur_page - 1) * $this->pg->limit;
        switch ($this->search_by){
        	case 'Email Address':
        		$criteria['order_by'] = UserprofilePeer::EMAILADDRESS . ' asc';
        		break;
        	case 'IP Address':
        		$criteria['order_by'] = UserprofilePeer::IP . ' asc';
        		break;
        	default:
        		$criteria['order_by'] = UserprofilePeer::USERNAME . ' asc';
        		break;
        }
        $this->results = UserProfilePeer::adv_search($criteria);
        
    }
    
    /**
     * Displays a view to the user which allows for searching and browsing of celebrities.
     */
    private function display_search_and_browse_view(){
        $this->main_template = 'admin_users_search.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Performs the necessary processing to display a page for editing a user
     */
    private function process_user_view(){
        
        /****************************************************** 
         * Process pagination arguments
         ******************************************************/
        
        $this->pg = new Pagination();
        
        // Limit
        $this->pg->limit = $this->get_args['l'];
        if (!isset($this->pg->limit) || !is_numeric($this->pg->limit) || $this->pg->limit < 1)
            $this->pg->limit = 20;
 
        // Current Page
        $this->pg->cur_page = $this->get_args['p'];
        if (!isset($this->pg->cur_page) || !is_numeric($this->pg->cur_page) || $this->pg->cur_page < 1)
            $this->pg->cur_page = 1;
        
        /****************************************************** 
         * Process any changes that have been made by the user 
         ******************************************************/
        // Ban Email Address
        if (isset($this->post_args['ban_email_submit'])){
            switch ($this->post_args['email_length_radio']){
                case 'temp':
                    if (!is_numeric($this->post_args['email_length_text'])) {
                        boris_FeedbackStorage::push_error('You must enter a number of days for a temp ban.');
                    } else {
                        $this->email_ban->setTtd(strtotime("+" . $this->post_args['email_length_text'] . " day"));
                        $this->email_ban->setEmailaddress($this->working_user->getEmailaddress());
                        $this->email_ban->save();
                        boris_FeedbackStorage::push_message('Email has been successfully banned.');
                    }
                    break;
                case 'perm':
                    $this->email_ban->setTtd(0);
                    $this->email_ban->setEmailaddress($this->working_user->getEmailaddress());
                    $this->email_ban->save();
                    boris_FeedbackStorage::push_message('Email has been successfully banned.');
                    break;
                default:
                    boris_FeedbackStorage::push_error('You must select an email ban type.');
            }
        }
        
        // Unban Email Address
        if (isset($this->post_args['unban_email'])){
            BannedemailsPeer::doDelete($this->working_user->getEmailaddress());
            boris_FeedbackStorage::push_message('Email has been successfully unbanned.');
        }
        
        // Ban Username
        if (isset($this->post_args['ban_username_submit'])){
            switch ($this->post_args['username_length_radio']){
                case 'temp':
                    if (!is_numeric($this->post_args['username_length_text'])) {
                        boris_FeedbackStorage::push_error('You must enter a number of days for a temp ban.');
                    } else {
                        $this->username_ban->setTtd(strtotime("+" . $this->post_args['username_length_text'] . " day"));
                        $this->username_ban->setUsername($this->working_user->getUsername());
                        $this->username_ban->save();
                        boris_FeedbackStorage::push_message('User name has been successfully banned.');
                    }
                    break;
                case 'perm':
                    $this->username_ban->setTtd(0);
                    $this->username_ban->setUsername($this->working_user->getUsername());
                    $this->username_ban->save();
                    boris_FeedbackStorage::push_message('User name has been successfully banned.');
                    break;
                default:
                    boris_FeedbackStorage::push_error('You must select a user name ban type.');
            }
        }
        
        // Unban User Name
        if (isset($this->post_args['unban_username'])){
            BannedusernamesPeer::doDelete($this->working_user->getUsername());
            boris_FeedbackStorage::push_message('User name has been successfully unbanned.');
        }
        
        // Ban IP Address
        if (isset($this->post_args['ban_ip_submit'])){
        	$new_ip_ban = new Bannedips();
            switch ($this->post_args['ip_length_radio']){
                case 'temp':
                    if (!is_numeric($this->post_args['ip_length_text'])) {
                        boris_FeedbackStorage::push_error('You must enter a number of days for a temp ban.');
                    } else {
                        $new_ip_ban->setTtd(strtotime("+" . $this->post_args['ip_length_text'] . " day"));
                        $new_ip_ban->setIpString($this->working_user->getIp());
                        $new_ip_ban->setMaskLength(32);
                        $new_ip_ban->save();
                        boris_FeedbackStorage::push_message('IP Address has been successfully banned.');
                    }
                    break;
                case 'perm':
                    $new_ip_ban->setTtd(0);
                    $new_ip_ban->setIpString($this->working_user->getIp());
                    $new_ip_ban->setMaskLength(32);
                    $new_ip_ban->save();
                    boris_FeedbackStorage::push_message('IP Address has been successfully banned.');
                    break;
                default:
                    boris_FeedbackStorage::push_error('You must select an IP Address ban type.');
            }
        }
        
        // Unban IP Address
        if (isset($this->post_args['unban_ip'])){
        	$del_ban = new Bannedips();
          	$del_ban->parseIpAndMaskString($this->get_args['ip_m']);
          	$del_ban = BannedipsPeer::retrieveByPK($del_ban->getIp(), $del_ban->getShift());
          	if (!$del_ban || ! $del_ban instanceof Bannedips) {
          		boris_FeedbackStorage::push_error($this->get_args['del'] . ' could not be found.');
          	} else {
          		$del_ban->delete();
          		boris_FeedbackStorage::push_message($del_ban->getIpAndMaskString() . ' ban has been successfully removed.');
          	}
        }
        
        // Remove a post
        if (isset($this->post_args['yes_remove_post_button'])){
            PostsPeer::doDelete($this->post_args['post_to_remove']);
            boris_FeedbackStorage::push_message('Post Successfully Removed');
        }
        
        // Edit smack
        if (isset($this->post_args['save_post_button'])){
            $post = PostsPeer::retrieveByPK($this->post_args['post_to_edit']);
            $post->set_posttext_from_input($this->post_args['edit_post_text']);
            $post->save();
            boris_FeedbackStorage::push_message('Post Successfully Updated');
        }

        /****************************************************** 
         * Required processing to display the page
         ******************************************************/
        
        // Create ban status
        $this->email_ban = BannedemailsPeer::retrieveByPK($this->working_user->getEmailaddress());
        $this->is_email_banned = ($this->email_ban != NULL);
        $this->username_ban = BannedusernamesPeer::retrieveByPK($this->working_user->getUsername());
        $this->is_username_banned = ($this->username_ban != NULL);
        $this->ip_bans = BannedipsPeer::getMatchingBans($this->working_user->getIp());
        $this->is_ip_banned = (!empty($this->ip_bans));
        $this->is_banned = ($this->is_email_banned || $this->is_username_banned || $this->is_ip_banned);
        
        // Setup smack search and pagination
        $c = new Criteria();
        $c->add(PostsPeer::POSTERID, $this->working_user->getId(), Criteria::EQUAL);
        $c->addDescendingOrderByColumn(PostsPeer::POSTDATE);
        $this->pg->total_results = PostsPeer::doCount($c);
        $this->pg->set_total_pages();
        $c->setLimit($this->pg->limit);
        $c->setOffset(($this->pg->cur_page - 1) * $this->pg->limit);
        $this->pg->set_links($this);
        
        // Make the smack accessable to the template
        $raw_smack_array = PostsPeer::doSelect($c);
        if (!empty($raw_smack_array)) require 'utils/cbf_smackDisplay.php';
        foreach($raw_smack_array as $raw_smack){
            $temp_smack = new cbf_SmackDisplay();
            $temp_smack->fight_id = $raw_smack->getFights()->getId();
            $temp_smack->fight = "<a href=\"" . cbf_FightsView::getClassAugViewUrl(array('id' => $temp_smack->fight_id)) . "\">" . $raw_smack->getFights()->toString() ."</a>";
            $temp_smack->date = $raw_smack->getPostdate();
            $temp_smack->body = $raw_smack->getPosttext();
            $temp_smack->body_for_input = $raw_smack->get_posttext_for_input();
            $temp_smack->smack_id = $raw_smack->getId();
            $this->results[] = $temp_smack;
        }
        
    }
    
    /**
     * Sends a fully processed view to the user's browser that allows
     * the user to edit a celebrity.
     *
     */
    private function display_user_view(){
        $this->main_template = 'admin_users.html';
        $this->flexy_handle->compile($this->main_template);
        $this->flexy_handle->outputObject($this);
    }
    
    /**
     * Returns the URL to this view with out arugments
     *
     * @return Basic URL as a string
     */
    public function getViewUrl(){
        return cbf_UsersView::getClassViewUrl();
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
        if ($this->mode == 'user'){
            $args['id'] = ((array_key_exists('id', $args)) ? $args['id'] : $this->get_args['id']);
        } else {
            if (!array_key_exists('search_by', $args) && isset($this->search_by)){
                $args['search_by'] = $this->search_by;
            }
            if (!array_key_exists('query', $args) && isset($this->query)){
                $args['query'] = $this->query;
            }
            $args['banned_by_username'] = ((array_key_exists('banned_by_username', $args)) ? $args['banned_by_username'] : $this->banned_by_username);
            $args['banned_by_email'] = ((array_key_exists('banned_by_email', $args)) ? $args['banned_by_email'] : $this->banned_by_email);
            $args['banned_by_ip'] = ((array_key_exists('banned_by_ip', $args)) ? $args['banned_by_ip'] : $this->banned_by_ip);
            $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : $this->get_args['l']);
            $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : $this->get_args['p']);
        }
        
        return cbf_UsersView::getClassAugViewUrl($args);
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
        $url = cbf_UsersView::getClassViewUrl();
        
        if (count($args) > 0){ 
            $url .= '?';
            if (array_key_exists('id', $args)){
                $url .= 'id=' . $args['id'];
                $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 20);
                $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1);
            } else {
                // Set needed defaults
                /*$args['banned_by_username'] = ((array_key_exists('banned_by_username', $args)) ? $args['banned_by_username'] : '--');
                $args['banned_by_email'] = ((array_key_exists('banned_by_email', $args)) ? $args['banned_by_email'] : '--');
                $args['banned_by_ip'] = ((array_key_exists('banned_by_ip', $args)) ? $args['banned_by_ip'] : '--');*/
                $args['l'] = ((array_key_exists('l', $args)) ? $args['l'] : 30);
                $args['p'] = ((array_key_exists('p', $args)) ? $args['p'] : 1);
            }
            
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
        return boris_View::get_class_controller_url() . '/admin/users';
    }
}
?>