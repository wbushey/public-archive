<?php

require 'models/om/BaseNamesPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'names' table.
 *
 * Names of celebrities
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class NamesPeer extends BaseNamesPeer {

    /**
     * Extends the basic doDelete method by also deleteing any pictures associated
     * with the name from the file system.
     *
     * @param unknown_type $values
     * @param PropelPDO $con
     */
    public static function doDelete($values, PropelPDO $con = null){
        require 'models/Pics.php';
         
        $celebs = array();
         
         /* Must handle any of the three options */
        if ($values instanceof Criteria) {
            //Definitely better ways to do this
            $celebs = NamesPeer::doSelect($values, $con);
            
        } elseif ($values instanceof Names) {
            $celebs[] = $values;
            
        } else {
            // it must be the primary key
            $celebs = NamesPeer::retrieveByPKs((array)$values, $con);
        }
        
        foreach($celebs as $celeb){
            $pics = $celeb->getPicss();
            foreach($pics as $pic){
                PicsPeer::delete_picture_fs($pic);
            }
        }
        
        parent::doDelete($values, $con);
    }
    
    /**
     * Performs a search for celebrities who match the provided criteria.
     * 
     * The criteria is provided by an array. Allowable key=>value pairs for
     * the array are:
     *  $criteria['has_fight'] = true   Return celebrities in at least one fight
     *                         = false  Return celebrities who are not in a fight
     *  $criteria['has_picture'] = true     Return celebrities with at least on picture
     *                           = false    Return celebrities who do not have a picture
     *  $criteria['name'] = string      Return celebrities that match the name string
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
        $sql = NamesPeer::generate_query($criteria);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        return NamesPeer::populateObjects($stmt);
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
        
        $sql = NamesPeer::generate_query($criteria);
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
            $query = 'select count(distinct names.id) ';
        } else {
            $query = 'select distinct names.id, names.name, names.reference ';
        }
        
        /* Set from clause */
        // has_fight
        if (isset($c['has_fight']) && ($c['has_fight'] == true || $c['has_fight'] == false)){
            $from[] = "LEFT JOIN (fights) ON (names.id = fights.oneID OR names.id = fights.twoID)";
        }
        // Build the from clause
        $query .= 'from names ';
        foreach($from as $statement){
            $query .= $statement . ' ';
        }
       
        
        /* Set where caluse */
        // name
        if (isset($c['name']) && is_string($c['name'])){
            $c['name'] = mysqli_escape_string($c['name']);
            $where[] = "(name like '%{$c['name']}%' OR name sounds like '{$c['name']}')";
        }
        // has_fight
        if (isset($c['has_fight'])){
            if ($c['has_fight'] === true) $where[] = "(fights.oneID is not null OR fights.twoID is not null)";
            if ($c['has_fight'] === false) $where[] = "(fights.oneID is null AND fights.twoID is null)";
        }
        // has_picture
        if (isset($c['has_picture'])){
            if ($c['has_picture'] === true) $where[] = "(exists (select id from pics where names.id = pics.id))";
            if ($c['has_picture'] === false) $where[] = "(not exists (select id from pics where names.id = pics.id))";
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
} // NamesPeer
