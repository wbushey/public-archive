<?php
/**
 * 
 * 
 * @author Bill Bushey <wbushey@acm.org>
 * Last Updated 01/10/2009
 */
require 'base/boris_BaseView.php';

abstract class boris_View extends boris_BaseView{
	
	public function __construct(array $get_args, array $post_args){
		parent::__construct($get_args, $post_args);
        global $appConf;
        
        // Ban check
        if ($this->isLoggedIn()){
	    	$ban_result = Bans::isBanned($this->getUser());
	    	if ($ban_result[0]){
	    		$this->setUser(new Userprofile());
	    		unset($_SESSION['user_profile']);
	    		foreach ($ban_result[1] as $ban_message) boris_FeedbackStorage::push_error($ban_message);
	    	}
        }
    }
	
    /**
     * Set the title that the page will display.
     *
     * @access public
     * @param string $page_title
     */
    public function setPageTitle($page_title = NULL){
        $this->page_title = "Celebrity Bar Fight$page_title";
    }
}
?>
