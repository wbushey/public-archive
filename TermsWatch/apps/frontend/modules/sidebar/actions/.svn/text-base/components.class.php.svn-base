<?php

class sidebarComponents extends sfComponents{

	public function executeHello(){}

    public function executeOrganizations(){
    	$c = new Criteria();
		$c->addAscendingOrderByColumn(CompanyPeer::NAME);
		$c->setLimit(20);
		$this->organizations = CompanyPeer::doSelect($c);
    }
    
    public function executeHighlightedPolicies(){
    	$c = new Criteria();
    	/*TODO
    	 * A SQL search for the policies with the most versions
    	 */
    	 
    	// Hack job for now.
    	$this->highlightedPolicies = array(
    			array(	'title' => "Blizzard World Of Warcraft Terms Of Use",
					  	'pid' => 33),
        		array(	'title' => "EBay User Agreement",
						'pid' => 8),
      			array(	'title' => "Facebook Privacy Policy",
						'pid' => 39),
      			array(	'title' => "GoDaddy Universal Terms Of Service",
						'pid' => 15)
    	);
    }
}
?>