<?php
/**
 * A simple set of functions for compiling multiple SQL statements into
 * one compound statement.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 7/21/2008
 */


/**
 * Class which provides the simple set of functions used to compile SQL statements.
 *
 */
class sql_compiler{
    
    /**
     * Creates an expression tree based on the provided SQL statement(s).
     * Provided statments should be complete, syntatically correct SQL statements.
     * The provided variable may either be a single string or an array of strings.
     * 
     * Currently this function will only handle simple select statements.
     *
     * @param mixed $statements
     * @return unknown
     */
    public static function build_tree(mixed $statements){
        // Can't do anything with a null/empty
        if (is_null($statements) || empty($statements)){
            throw new Exception('Cannot compile a null/empty set of expressions');
        }
        
        // Build an array if need be
        if (!is_array($statements)){
            $statements = array($statements);
        }
        
        $tree_root = new sql_node();
        
        foreach($statements as $i => $statement){
            // Each statement should be a string or a Criteria
            if (!is_string($statements) && !($statements instanceof Criteria) ){
                throw new Exception(" Statment $i is an unknown type.");
            }
            
            // Build the tree
        }
        
        return true;
    }
    
    public static function build_statement(sql_node $tree){
        
    }
    
}

/**
 * This class is the basic node used int the SQL tree that is generated
 * during compilation.
 *
 */
abstract class sql_node{
    
    var $parts = array();
    
    public function get_part_names(){
        return array_keys($parts);
    }
    
    public function append($key, $value){
        if (isset($this->parts[$key])){
            $this->parts[$key] .= ", $value";
        } else {
            $this->parts[$key] = $value;
        } 
    }
}

class select_node extends sql_node{

}




?>