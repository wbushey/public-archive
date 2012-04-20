<?php

require 'models/om/BaseBannedipsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'bannedIPs' table.
 *
 * IP addresses that have been banned from using the site
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class BannedipsPeer extends BaseBannedipsPeer {

	/**
	 * Returns any address or range bans that match the provided IP Address
	 */
	public static function getMatchingBans($input_ip){
		$pip = ip2long($input_ip);
		$con = Propel::getConnection(self::DATABASE_NAME);
		$sql = "select * from bannedIPs where (($pip>>shift) = (ip>>shift))";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		
		return self::populateObjects($stmt);
	}
	
	/**
     * Performs a search for IP bans that match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
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
        	$names = self::getFieldNames(BasePeer::TYPE_COLNAME);
            $query = 'select distinct ';
            foreach ($names as $i=>$name){
            	$query .= $name;
                if ($i < (sizeof($names) - 1)) $query .= ', ';
            }
            $query .= ' ';
        }
        
        /********************** 
         * Set from clause 
         **********************/
        // Build the from clause
        $query .= 'from ' . self::TABLE_NAME . ' ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /*************************
         * Set where caluse 
         *************************/
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

} // BannedipsPeer
