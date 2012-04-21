<?php

/**
 * version actions.
 *
 * @package    TermsWatch
 * @subpackage version
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class versionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('version', 'show');
  }
  
  /**
   * Displays the requested version of a policy
   */
  public function executeShow(sfWebRequest $request){
  	$this->redirectUnless($request->hasParameter('vid'), 'timeline/timeline');
  	
  	// This action shows the sidebar
  	$this->getResponse()->setSlot('sidebar', true);
  	
  	// Search for the information about the requested Version
  	$c = new Criteria();
  	$c->addJoin(VersionPeer::PID, PolicyPeer::PID);
  	$c->addJoin(PolicyPeer::CID, CompanyPeer::CID);
  	$c->add(VersionPeer::VID, $request->getParameter('vid'));
  	$this->version = VersionPeer::doSelectOne($c);
  	
  	$this->redirectIf($this->version == null, 'timeline/timeline');

  	// Set the crumbs for this action
  	sfLoader::loadHelpers(array('Url', 'Tag'));
  	$crumbs = array(	link_to('Home', '/'), 
  						link_to($this->version->getPolicy()->getCompany()->getName(), 'organization/show?cid=' . $this->version->getPolicy()->getCompany()->getCid()),
  						link_to($this->version->getPolicy()->getName(), 'policy/show?pid=' . $this->version->getPolicy()->getPid()));
  	$this->getResponse()->setSlot('crumbs', $crumbs);
  	
  	// Set the mission
  	sfLoader::loadHelpers(array('TermsWatch', 'Date'));
  	$mission = array();
  	$mission['image'] = $this->version->getPolicy()->getCompany()->getImageLarge();
  	$mission['title'] = $this->version->getPolicy()->getCompany()->getName();
  	$mission['body'] = "Version recorded " . format_datetime($this->version->getRetrievedat());
  	$this->getResponse()->setSlot('mission', termswatch_generate_mission($mission));
  	
  	return sfView::SUCCESS;
  }
}
