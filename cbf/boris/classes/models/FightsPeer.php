<?php

require 'models/om/BaseFightsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'fights' table.
 *
 * Matches between celebrities
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class FightsPeer extends BaseFightsPeer {

    // Set the constant values for fight activation
    public static $IS_ACTIVE = 1;
    public static $NOT_ACTIVE = 0;
    
    /**
     * Returns the Fights object representing the fight between celeb1 and celeb2.
     * If no fight exists between celeb1 and celeb2, NULL is returned.
     * 
     * @param mixed $celeb1 Either a Names object or the ID of a celebrity
     * @param mixed $celeb2 Either a Names object or the ID of a celebrity
     */
    public static function get_fight_by_celebrities($celeb1, $celeb2){
    	$con = Propel::getConnection(self::DATABASE_NAME);
    	
    	$celeb1ID = ($celeb1 instanceof Names) ? $celeb1->getId() : $celeb1;
    	$celeb2ID = ($celeb2 instanceof Names) ? $celeb2->getId() : $celeb2;
    	
    	$table_name = self::TABLE_NAME;
    	$ONEID = self::ONEID;
    	$TWOID = self::TWOID;
    	$sql = "select $table_name.* from $table_name " .
    			"where ($ONEID = $celeb1ID and $TWOID = $celeb2ID)" .
    				"or ($ONEID = $celeb2ID and $TWOID = $celeb1ID)";
    	//echo $sql;
    	
    	$stmt = $con->prepare($sql);
    	$stmt->execute();
    	
		$fights = self::populateObjects($stmt);
    	if (empty($fights)) return null;
    	else return $fights[0];
    						
    }
    
    /**
     * Returns all the ids of currently active fights
     *
     * @return unknown
     */
    public static function get_active_fight_ids(){
        $con = Propel::getConnection(FightsPeer::DATABASE_NAME);
        
        $id_field = FightsPeer::ID;
        $table_name = FightsPeer::TABLE_NAME;
        $active_field = FightsPeer::ACTIVE;
        
        $sql = "select $id_field from $table_name where $active_field = 1";
        $stmt = $con->prepare($sql);       
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        $ids = array();
        foreach($results as $result) $ids[] = $result[0];
        
        return $ids;
    }
    
    /**
     * Performs a search for celebrities who match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
     *  $criteria['is_active'] = true   Return fights that are currently active
     *                         = false  Return fights that are not currently active
     *  $criteria['has_smack'] = true     Return fights with at least one post
     *                         = false    Return fights that do not have any posts
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
        $con = Propel::getConnection(FightsPeer::DATABASE_NAME);
        $sql = FightsPeer::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return FightsPeer::populateObjects($stmt);
    }
    
    /**
     * Returns the number of results that match the provided criteria.
     *
     * @param array $criteria
     * @return Number of results
     */
    public static function adv_count(array $criteria){
        $criteria['do_count'] = true;
        
        $con = Propel::getConnection(FightsPeer::DATABASE_NAME);
        
        $sql = FightsPeer::generate_query($criteria);
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
        
        
        /* Set select clause */
        if(isset($c['do_count']) && $c['do_count'] == true){
            $query = 'select count(distinct fights.id) ';
        } else {
            $query = 'select distinct fights.id, fights.oneID, fights.twoID, fights.oneWins, fights.twoWins, fights.active ';
        }
        
        /* Set from clause */
        // has_smack
        if (isset($c['has_smack']) && ($c['has_smack'] == true || $c['has_smack'] == false)){
            $from[] = "LEFT JOIN (posts) ON (fights.id = posts.fightID)";
        }
        // Build the from clause
        $query .= 'from fights ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /* Set where caluse */
        // is_active
        if (isset($c['is_active'])){
            if ($c['is_active'] === true) $where[] = "(fights.active = " . 1 . ")";
            if ($c['is_active'] === false) $where[] = "(fights.active = " . 0 . ")";
        }
        // has_smack
        if (isset($c['has_smack'])){
            if ($c['has_smack'] === true) $where[] = "(exists (select id from posts where fights.id = posts.fightID))";
            if ($c['has_smack'] === false) $where[] = "(not exists (select id from posts where fights.id = posts.fightID))";
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
        
        /* Set order by clause */
        if (isset($c['order_by'])){
            $query .= ' order by ' . $c['order_by'];
        }
        
        /* Set the limit/offset clauses */
        if (isset($c['limit'])){
            $query .= ' limit ' . $c['limit'];
            if (isset($c['offset'])) $query .= ' offset ' . $c['offset'];
        }
        
        
        return $query;
    }
} // FightsPeer
