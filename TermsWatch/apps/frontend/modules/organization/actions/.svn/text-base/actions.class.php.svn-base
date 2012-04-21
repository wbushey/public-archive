<?php

/**
 * organization actions.
 *
 * @package    TermsWatch
 * @subpackage organization
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class organizationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('organization', 'show');
  }
  
  /**
   * Retrives and displays information about the policies being
   * monitored for the provided organization.
   */
  public function executeShow(sfWebRequest $request){
  	$this->redirectUnless($request->hasParameter('cid'), 'timeline/timeline');
  	
  	// This action shows the sidebar
  	$this->getResponse()->setSlot('sidebar', true);
  	
  	// Get Company Information
  	$c = new Criteria();
  	$c->addJoin(CompanyPeer::CID, PolicyPeer::PID);
  	$c->add(CompanyPeer::CID, $request->getParameter('cid'));
  	$this->company = CompanyPeer::doSelectOne($c);
  	$this->policies = $this->company->getPolicys();
  	
  	// Set the mission
  	sfLoader::loadHelpers(array('TermsWatch'));
  	$mission = array();
  	$count = count($this->policies);
  	$mission['image'] = $this->company->getImagelarge();
  	$mission['title'] = $this->company->getName();
  	$mission['body'] = "TOSBack tracks ".(($count > 1) ? 
                                        $count . " " . $this->company->getName() . " policies." :
                                        "one " . $this->company->getName() . " policy.");
  	$this->getResponse()->setSlot('mission', termswatch_generate_mission($mission));
  	
  	// Set the crumbs for this action
  	sfLoader::loadHelpers(array('Url', 'Tag'));
  	$crumbs = array(	link_to('Home', '/')
  						);
  	$this->getResponse()->setSlot('crumbs', $crumbs);
  	
  	return sfView::SUCCESS;
  }
}
