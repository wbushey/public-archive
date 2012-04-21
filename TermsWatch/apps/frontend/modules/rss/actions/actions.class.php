<?php

/**
 * rss actions.
 *
 * @package    TermsWatch
 * @subpackage rss
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class rssActions extends sfActions
{
	
	public function executeIndex(sfWebRequest $request){
		$this->forward('rss', 'produce');
	}
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeProduce(sfWebRequest $request){
  	$params = array();
    $c = new Criteria();
    if ($request->hasParameter('cid')){
    	$params['cid'] = $request->getParameter('cid');
    } elseif ($request->hasParameter('pid')){
    	$params['pid'] = $request->getParameter('pid'); 
    }
    
    $this->rsses = VersionPeer::getRssInfo($params);
  }
}
