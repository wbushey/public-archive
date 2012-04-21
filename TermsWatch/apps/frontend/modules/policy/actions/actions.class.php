<?php

/**
 * policy actions.
 *
 * @package    TermsWatch
 * @subpackage policy
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class policyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('policy', 'show');
  }
  
  /**
   * Display information about a particular policy.
   */
  public function executeShow(sfWebRequest $request){
  	$this->redirectUnless($request->hasParameter('pid'), 'timeline/timeline');
  	
  	// This action shows the sidebar
  	$this->getResponse()->setSlot('sidebar', true);
  	
  	// Get information about the policy
  	$c = new Criteria();
  	$c->add(PolicyPeer::PID, $request->getParameter('pid'));
  	$c->addJoin(PolicyPeer::CID, CompanyPeer::CID);
  	$this->policy = PolicyPeer::doSelectOne($c);
  	
  	$this->redirectUnless($this->policy, 'timeline/timeline');
  	
  	$c = new Criteria();
  	$c->add(VersionPeer::PID, $this->policy->getPid());
  	$c->addDescendingOrderByColumn(VersionPeer::RETRIEVEDAT);
  	$this->versions = VersionPeer::doSelect($c);
  	
  	// Set the crumbs for this action
  	sfLoader::loadHelpers(array('Url', 'Tag'));
  	$crumbs = array(	link_to('Home', '/'), 
  						link_to($this->policy->getCompany()->getName(), 'organization/show?cid=' . $this->policy->getCompany()->getCid())
  						);
  	$this->getResponse()->setSlot('crumbs', $crumbs);
  	
  	// Set the message
  	sfLoader::loadHelpers(array('TermsWatch'));
  	$mission = array();
  	$this->versionCount = count($this->versions);
  	$mission['image'] = $this->policy->getCompany()->getImagelarge();
  	$mission['title'] = $this->policy->getCompany()->getName() . " " . $this->policy->getName();
  	$mission['body'] = "TOSBack tracks ".(($this->versionCount > 1) ? 
                                        $this->versionCount . " versions of this policy." :
                                        "one version of this policy.");
  	$this->getResponse()->setSlot('mission', termswatch_generate_mission($mission));
  	
  	return sfView::SUCCESS;
  	
  }
}
