<?php

/**
 * timeline actions.
 *
 * @package    TermsWatch
 * @subpackage timeline
 * @author     Bill Bushey <wbushey@acm.org>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class timelineActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$this->forward('timeline', 'timeline');
  }
  
  /**
   * Displays the policy timeline for a particular company, policy, or for all
   * companies and policies being monitored.
   */
  public function executeTimeline(sfWebRequest $request){
  	// This action shows the sidebar
  	$this->getResponse()->setSlot('sidebar', true);
  	
  	$params = array();
  	if ($request->hasParameter('pid')){
		// Generate timeline for a particular policy
		$params['pid'] = $request->getParameter('pid');
	} elseif ($request->hasParameter('cid')){
		// Generate timeline for a particular company
		$params['cid'] = $request->getParameter('cid');
	}
	
	// Get the information on the latest policy versions
	$this->results = VersionPeer::getTimelineInformation($params); 
	
	$this->numOfPolicies = PolicyPeer::doCount(new Criteria());
	    
    return sfView::SUCCESS;
  }
}
