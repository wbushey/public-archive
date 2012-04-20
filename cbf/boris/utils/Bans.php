<?php
/*
 * Created on Mar 2, 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Bans{
 	
 	/**
 	 * Indicates if the provided user is banned from the site. 
 	 * If the user is banned from the site than an array of messages is provided to indicate
 	 * the ban to the user.
 	 * 
 	 * The function always returns an array which contains a boolean at index 0. If the user
 	 * is not banned then index 0 is false and index 0 is the only element of the array. If the
 	 * user is banned then index 0 is true and index 1 is an array of messages indicating the type
 	 * of bans that are in place.
 	 * 
 	 * @param Userprofile
 	 * @return array
 	 */
 	public static function isBanned(Userprofile $challenge){
 		$ban_result[0] = false;
 		
 		// Clean up old bans
        Bans::clear_old_bans();
		
	    // See if username is banned
        $result = BannedusernamesPeer::retrieveByPK($challenge->getUsername());
        if (!empty($result)) {
        	$ban_result[0] = true;
        	if ($result->is_perm_ban()){
        		$ban_result[1][] = 'Sorry, the username ' . $challenge->getUsername() . ' has been permanently banned';
        	} else {
        		$ban_result[1][] = 'Sorry, the username ' . $challenge->getUsername() . ' has been banned until ' . date('F j, Y, g:i:s a', strtotime($result->getTtd()));
        	}
        }
        
        // See if IP is banned
        $result = BannedipsPeer::getMatchingBans($challenge->getIp());
        if (!empty($result)) {
        	$ban_result[0] = true;
        	foreach($result as $ban_by_ip){
        		if ($ban_by_ip->is_perm_ban()){
        			$ban_result[1][] = 'Sorry, your IP address, ' . $challenge->getIp() . ', has been permanently banned';
        		} else {
        			$ban_result[1][] = 'Sorry, your IP address, ' . $challenge->getIp() . ', has been banned until ' . date('F j, Y, g:i:s a', strtotime($ban_by_ip->getTtd()));
        		}
        	}
        }
        
        // See if Email Address is banned
        $result = BannedemailsPeer::retrieveByPK($challenge->getEmailaddress());
        if (!empty($result)){
        	$ban_result[0] = true;
        	if ($result->is_perm_ban()){
        		$ban_result[1][] = 'Sorry, the email address ' . $challenge->getEmailaddress() . ' has been permanently banned';
        	} else {
        		$ban_result[1][] = 'Sorry, the email address ' . $challenge->getEmailaddress() . ' has been banned until ' . date('F j, Y, g:i:s a', strtotime($result->getTtd()));
        	}
        }
	    
	    return $ban_result;
 	}
 	
 	/**
 	 * Removes bans from the database whose TTD has pased
 	 */
 	public static function clear_old_bans(){
 		$cur_time = date('Y-m-d H:i:s');
        $c = new Criteria();
        $criterion = $c->getNewCriterion(BannedusernamesPeer::TTD, $cur_time, Criteria::LESS_EQUAL);
        $criterion->addAnd($c->getNewCriterion(BannedusernamesPeer::TTD, 0, Criteria::NOT_EQUAL));
        $c->add($criterion);
        BannedusernamesPeer::doDelete($c);
        $c = new Criteria();
        $criterion = $c->getNewCriterion(BannedipsPeer::TTD, $cur_time, Criteria::LESS_EQUAL);
        $criterion->addAnd($c->getNewCriterion(BannedipsPeer::TTD, 0, Criteria::NOT_EQUAL));
        $c->add($criterion);
        BannedipsPeer::doDelete($c);
        $c = new Criteria();
        $criterion = $c->getNewCriterion(BannedemailsPeer::TTD, $cur_time, Criteria::LESS_EQUAL);
        $criterion->addAnd($c->getNewCriterion(BannedemailsPeer::TTD, 0, Criteria::NOT_EQUAL));
        $c->add($criterion);
        BannedemailsPeer::doDelete($c);    
        
 	}
 }
?>
