<?php

require 'models/om/BaseAdPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'ad' table.
 *
 * Ad codes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class AdPeer extends BaseAdPeer {
    
    // Define ad positions
    public static $TOP = 0;
    public static $RIGHT_1 = 1;
                    
    /**
     * Returns a string describing the provided position value
     *
     * @param int $pos_num
     */
    public static function get_position_string($pos_num){
        $position_names = array(
            AdPeer::$TOP => 'Top',
            AdPeer::$RIGHT_1 => 'Right 1'
        );
        
        return $position_names[$pos_num];
    }
    
    /**
     * Returns an array of all the possible position values
     *
     * @return int[]
     */
    public static function get_all_positions(){
        $pos = array(
            AdPeer::$TOP, 
            AdPeer::$RIGHT_1
        );
        return $pos;
    }
    
    /**
     * Returns a random ad for the specified position 
     *
     * @param integer $position
     * @return Ad
     */
    public static function get_random_ad($position){
        $db_adapter = Propel::getDB();
        $c = new Criteria();
        $c->add(AdPeer::POSITION, $position);
        $c->addJoin(AdPeer::ID, AdSelectionListPeer::AD_ID);
        $count = AdSelectionListPeer::doCount($c);
        $c->addAscendingOrderByColumn($db_adapter->random(rand(1, $count)));
        $c->setLimit(1);
        return AdPeer::doSelectOne($c);
    }

    /**
     * Performs a search for celebrities who match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
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
        $con = Propel::getConnection(NamesPeer::DATABASE_NAME);
        $sql = AdPeer::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return AdPeer::populateObjects($stmt);
    }
    
    /**
     * Returns the number of results that match the provided criteria.
     *
     * @param array $criteria
     * @return Number of results
     */
    public static function adv_count(array $criteria){
        $criteria['do_count'] = true;
        
        $con = Propel::getConnection(NamesPeer::DATABASE_NAME);
        
        $sql = AdPeer::generate_query($criteria);
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
            $query = 'select count(*) ';
        } else {
            $query = 'select distinct ad.id, ad.name, ad.position, ad.date_added, ad.image_id, ad.code ';
        }
        
        // Build the from clause
        $query .= 'from ad ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /* Set where caluse */
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
} // AdPeer
