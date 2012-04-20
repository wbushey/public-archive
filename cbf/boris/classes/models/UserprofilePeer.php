<?php

require 'models/om/BaseUserprofilePeer.php';
require_once 'utils/Bans.php';


/**
 * Skeleton subclass for performing query and update operations on the 'userProfile' table.
 *
 * User account information
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class UserprofilePeer extends BaseUserprofilePeer {

	// Define the user types
    public static $DEFAULT_USER = 0;
    public static $ADMIN_USER = 10;
	
    /**
     * Performs a search for celebrities who match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
     *  $criteria['search_by'] = username   Search the user name field
     *                         = email  	Search the email address field
     * 						   = ip			Search the ip address field
     *  $criteria['query'] = string    	 	The query to match against in the search
     *  $criteria['banned_by_username'] = true      Search for users who have been banned by username
     *                                  = false     Search for users who have not been banned by username
     *  
     *  $criteria['limit'] = integer    Return at most limit number of celebrities
     *  $criteria['offset'] = integer   Skip the first offset celebrities
     *  $criteria['order_by'] = string  Order the results based on the provided string
     * 
     * If one of the above keys is not defined in the provided array then it will not be
     * considered during the search process, or a default value will be used. If any keys
     * besides the ones above are defined in the provided array they will be ignored.
     *
     * @param array $criteria
     */
    public static function adv_search(array $criteria){
        $con = Propel::getConnection(self::DATABASE_NAME);
        $sql = self::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return self::populateObjects($stmt);
    }
    
    /**
     * Returns the number of results that match the provided criteria.
     *
     * @param array $criteria
     * @return Number of results
     */
    public static function adv_count(array $criteria){
        $criteria['do_count'] = true;
        
        $con = Propel::getConnection(self::DATABASE_NAME);
        
        $sql = self::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchColumn();
    }
    
    /*
     * Generates an SQL query based on the array of criteria.
     */
    private static function generate_query(array $c){
        $from = array();
        $where = array();
        
        
        /**********************
         * Set select clause 
         ***********************/
        if(isset($c['do_count']) && $c['do_count'] == true){
            $query = 'select count(*) ';
        } else {
            $query = 'select distinct ' . UserprofilePeer::ID . ', ' . UserprofilePeer::USERNAME . ', ' .
                       UserprofilePeer::PASSWORD . ', ' . UserprofilePeer::USERTYPE . ',' . 
                       UserprofilePeer::EMAILADDRESS . ', ' . UserprofilePeer::IP . ' ';
        }
        
        /********************** 
         * Set from clause 
         **********************/
        // banned_by_username
        if (isset($c['banned_by_username']) && ($c['banned_by_username'] == true || $c['banned_by_username'] == false)){
            $from[] = "LEFT JOIN (" . BannedusernamesPeer::TABLE_NAME . ") ON (" .
                        self::USERNAME . " = " . BannedusernamesPeer::USERNAME . ")";
        }
        // banned_by_email
        if (isset($c['banned_by_email']) && ($c['banned_by_email'] == true || $c['banned_by_email'] == false)){
            $from[] = "LEFT JOIN (" . BannedemailsPeer::TABLE_NAME . ") ON (" .
                        self::EMAILADDRESS . " = " . BannedemailsPeer::EMAILADDRESS . ")";
        }
        // banned_by_ip
        if (isset($c['banned_by_ip']) && ($c['banned_by_ip'] == true || $c['banned_by_ip'] == false)){
            $from[] = "LEFT JOIN (" . BannedipsPeer::TABLE_NAME . ") ON (INET_ATON(" .
                        self::IP . ")>>" . BannedipsPeer::SHIFT . " = " . BannedipsPeer::IP . ">>" . BannedIpsPeer::SHIFT . ")";
        }
        // Build the from clause
        $query .= 'from ' . self::TABLE_NAME . ' ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /*************************
         * Set where caluse 
         *************************/
        // query
        $c['query'] = mysql_escape_string($c['query']);
        switch ($c['search_by']){
        	case 'username':
            	$where[] = "(" . self::USERNAME . " like '%{$c['query']}%' OR " . self::USERNAME . " sounds like '{$c['query']}')";
        		break;
        	case 'email':
        		$where[] = "(" . self::EMAILADDRESS . " like '%{$c['query']}%')";
        		break;
        	case 'ip':
        		$where[] = "(" . self::IP . " like '%{$c['query']}%')";
        		break;
        }
        // banned_by_username
        if (isset($c['banned_by_username'])){
            if ($c['banned_by_username'] === true) $where[] = "(" . BannedusernamesPeer::USERNAME . " is not null)";
            if ($c['banned_by_username'] === false) $where[] = "(" . BannedusernamesPeer::USERNAME . " is null)";
        }
        // banned_by_email
        if (isset($c['banned_by_email'])){
            if ($c['banned_by_email'] === true) $where[] = "(" . BannedemailsPeer::EMAILADDRESS . " is not null)";
            if ($c['banned_by_email'] === false) $where[] = "(" . BannedemailsPeer::EMAILADDRESS . " is null)";
        }
        // banned_by_ip
        if (isset($c['banned_by_ip'])){
            if ($c['banned_by_ip'] === true) $where[] = "(" . BannedipsPeer::IP . " is not null)";
            if ($c['banned_by_ip'] === false) $where[] = "(" . BannedipsPeer::IP . " is null)";
        }
        // Build the where clause
        switch (count($where)){
            case 0:
                // Don't need a where clause
                break;
            case 1:
                $query .= 'where ' . $where[0];
                break;
            default:
                $query .= 'where ';
                foreach ($where as $i=>$clause){
                    $query .= $clause;
                    if ($i < (sizeof($where) - 1)) $query .= ' AND ';
                }
        }
        
        /********************** 
         *Set order by clause 
         **********************/
        if (isset($c['order_by'])){
            $query .= ' order by ' . $c['order_by'];
        }
        
        /********************************
         * Set the limit/offset clauses 
         ********************************/
        if (isset($c['limit'])){
            $query .= ' limit ' . $c['limit'];
            if (isset($c['offset'])) $query .= ' offset ' . $c['offset'];
        }
        
        return $query;
    }
	
	/**
	 * Encodes the provided $base string though several md5 function calls.
	 * This algorithm is based on the algorithm posted by seth at interwebforce dot com
	 * at http://us3.php.net/manual/en/function.md5.php .
	 * 
	 * @param string $base 
	 */
	public static function encode($base){
		for ($i = 0; $i < strlen($base); ++$i){
			$majorsalt .= md5($base{$i});
		}
		$encoding = md5($majorsalt);
		return $encoding;
	}
	
	/**
	 * Determines if the provided Userprofile object represents a registered
	 * user of the site.
	 * 
	 * If the provided user object is able to authenticate then the full Userprofile
	 * object from the database will be returned and the database will be updated to
	 * indicate which IP address was used during login. If the object can not authenticate 
	 * then an Exception will be thrown.
	 * 
	 * Note: The provided challenge Userprofile should have a username, password, and IP address.
	 *
	 * @param Userprofile $challenge
	 * @return unknown
	 */
	public static function authenticate(Userprofile $challenge){
		
		// Test User name
		$c = new Criteria();
		$c->add(self::USERNAME, $challenge->getUsername(), Criteria::EQUAL);
		$control = self::doSelectOne($c);
	    
	    // Test Login
		if (!$control || $challenge->getPassword() != $control->getPassword())
			throw new boris_MinorException('Incorrect login.');
			
		// Ban check
    	$ban_result = Bans::isBanned($challenge);
	    if ($ban_result[0]){
	    	throw new boris_MinorException($ban_result[1]);
	    }
		
		// Update IP and return successfully logged in Userprofile
		$control->setIp($challenge->getIp());
		$control->save();
		return $control;
	}

	/**
	 * Generates a new, random 8 character password.
	 *
	 * @return string
	 */
	public static function generate_random_password(){
		$newPassword = '        ';
		for ($i = 0; $i < strlen($newPassword); ++$i){
			if (rand(0, 1) == 0) $newPassword{$i} = chr(rand(48, 57));
			else $newPassword{$i} = chr(rand(97, 122));
		}
		return $newPassword;
	}
	
	/**
	 * Sends an email to the user containing the user's new password.
	 *
	 * @param string $password
	 */
	public static function email_new_password($password, Userprofile $user){
		$emailBody = <<< END_OF_EMAIL
Hello {$user->getUsername()}<br/>
<br/>
    This email has been sent because you have requested or set a new password at {$_SERVER['HTTP_HOST']}. <br/>
    Your new password is $password<br/>
<br/>
    You may now login with your username and the password provided above.
<br/>
-www.celebritybarfight.com<br/>
END_OF_EMAIL;
	
		// Send the email
		$headers = 'From: new_password@celebritybarfight.com' . "\r\n" .
				'Content-Type: text/html; charset=iso-8859-1';
		mail($user->getEmailaddress(), "Celebrity Bar Fight Password", $emailBody, $headers);
		return 0;	
	}
	
} // UserprofilePeer
