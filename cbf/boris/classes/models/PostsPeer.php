<?php

require 'models/om/BasePostsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'posts' table.
 *
 * Posts made about celebrity fights
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class PostsPeer extends BasePostsPeer {
    
    /**
     * Performs a search for posts that match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
     *  $criteria['fightId'] = integer  ID of the fight to search for posts for
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
        $con = Propel::getConnection(PostsPeer::DATABASE_NAME);
        $sql = PostsPeer::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return PostsPeer::populateObjects($stmt);
    }
    
    /**
     * Returns the number of results that match the provided criteria.
     *
     * @param array $criteria
     * @return Number of results
     */
    public static function adv_count(array $criteria){
        $criteria['do_count'] = true;
        
        $con = Propel::getConnection(PostsPeer::DATABASE_NAME);
        
        $sql = PostsPeer::generate_query($criteria);
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
            $query = 'select distinct ' . PostsPeer::ID . ', ' . PostsPeer::FIGHTID . ', ' .
                       PostsPeer::POSTERID . ', ' . PostsPeer::POSTDATE . ',' . 
                       PostsPeer::POSTTEXT . ' ';
        }
        
        /* Set from clause */
        // Build the from clause
        $query .= 'from ' . PostsPeer::TABLE_NAME . ' ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /* Set where caluse */
        // Build the where clause
        if (array_key_exists('fightID', $c)) $where[] = 'fightID = ' . $c['fightID'];
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
} // PostsPeer
