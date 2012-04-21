<?php

/**
 * about actions.
 *
 * @package    TermsWatch
 * @subpackage about
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class aboutActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request){
  	// This action shows the sidebar
  	$this->getResponse()->setSlot('sidebar', true);
  	
  }
}
