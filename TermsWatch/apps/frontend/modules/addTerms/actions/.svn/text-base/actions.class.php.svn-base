<?php

/**
 * addTerms actions.
 *
 * @package    TermsWatch
 * @subpackage addTerms
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class addTermsActions extends sfActions
{
	/*
	 * Values for $_SESSION['terms_operation']:
	 * 		0 - User selects DOM Elements
	 * 		1 - Bayesian Probability is used to select DOM Elements
	 * 		2 - BTE is used
	 * 		3 - Selected Elements are learned by Bayes as TOS
	 * 		4 - Selected Elements are learned by Bayes as Not-TOS
	 */
	
 /**
  * The index action simply shows the initial form that the user uses to choose a URL and operation
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {}
  
  /**
   * Collect the information from the index form and, depending on the choosen operation, push the user
   * on to the next step.
   */
  public function executeSubmitUrl(sfWebRequest $request){
  	$this->redirectUnless('addTerms/index', $request->hasParameter('submit'));
  	
  	$_SESSION['terms_operation'] = $request->getParameter('terms_operation');
  	$_SESSION['requested_terms_url'] = $request->getParameter('terms_url');
  	$_SESSION['need_spoof'] = 0;
  	
  	switch ($request->getParameter('terms_operation')){
  		case 0:
  		case 1:
  		case 3:
  		case 4:
  			$_SESSION['scrape_method'] = PolicyPeer::SM_DOMEL;
  			$this->redirect('/termsElementSelector.cgi?terms_url=' . $request->getParameter('terms_url'));
  			break;
  		case 2:
  			$_SESSION['scrape_method'] = PolicyPeer::SM_BTE;
  			$this->forward('addTerms', 'confirm');
  			break;
  	}
  	
  	
  }
  
  /**
   * The page the user is trying to submit requires the user agent of a 'real' client (i.e. a major browser,)
   * so try again and spoof the user's agent string.
   */
  public function executeSpoof(sfWebRequest $request){
  	$_SESSION['need_spoof'] = 1;
  	switch ($_SESSION['terms_operation']){
  		case 0:
  		case 1:
  		case 3:
  		case 4:
  			$this->redirect('/termsElementSelector.cgi?terms_url=' . $_SESSION['requested_terms_url'] . '&s=' . $_SESSION['need_spoof']);
  			break;
  		case 2:
  			$this->forward('addTerms', 'confirm');
  			break;
  	}
  }
  
  /**
   * Show the user what portion of the requested URL is retrieved using the information they submitted.
   * Ask the user to either OK the results or go back
   */
  public function executeConfirm(sfWebRequest $request){
  	switch ($_SESSION['terms_operation']){
  		case 0:
  		case 1:
  		case 3:
  		case 4:
  			$_SESSION['scrape_data'] = $request->getParameter('selectedElements');
  			break;
  		case 2:
  			$_SESSION['scrape_data'] = null;
  			break;
  	} 
  	
  	$_SESSION['terms_userAgent'] = ($_SESSION['need_spoof'] == 1) ? $_SERVER['HTTP_USER_AGENT'] : 'BerkmanTermsWatch'; 
  	$_SESSION['terms_url'] = $request->getParameter('terms_url');
  	
  	$cmd = sfConfig::get('sf_lib_dir');
  	$cmd .= "/vendor/Berkman/scraper_cli.pl";
  	$cmd .= " \"" . $_SESSION['terms_url'] . "\" \"" . $_SESSION['terms_userAgent'] . "\" " . $_SESSION['scrape_method'] . " \"" . $_SESSION['scrape_data'] . "\" 2>&1";
  	$this->buffer = `$cmd`;	
  	
  	// DEBUGGING
  	$this->cmd = $cmd;
  	$this->scrape_data = $_SESSION['scrape_data'];
  }
  
  /**
   * The user has OK'ed the data from Confirm, so ask for the rest of the information about the policy
   */
  public function executeOk(sfWebRequest $request){
  	$cmd = sfConfig::get('sf_lib_dir');
  	$cmd .= "/vendor/Berkman/learn_tos.pl ";
  	$args = $_SESSION['scrape_method'] . " \"" . $_SESSION['scrape_data'] . "\" \"" . $_SESSION['terms_url'] . "\" \"" . $_SESSION['terms_userAgent'] . "\"";
  	if ($_SESSION['terms_operation'] == 3){
  		$cmd .= "\"-submitTOS\" " . $args;
  		$this->result = `$cmd`;
  		$this->cmd = $cmd;
  	} elseif($_SESSION['terms_operation'] == 4){
  		$cmd .= "\"-submitNONTOS\" " . $args;
  		$this->result = `$cmd`;
  		$this->cmd = $cmd;
  	} else {
  		$this->forward('addTerms', 'getMetadata');
  	}
  }
  
  /**
   * User has canceled adding a Terms
   */
  public function executeCancel(sfWebRequest $request){
  	$this->redirect('addTerms/index');
  }
  
  /**
   * Ask the user for information about the policy
   */
  public function executeGetMetadata(sfWebRequest $request){
   $c = new Criteria();
   $c->addAscendingOrderByColumn(CompanyPeer::NAME);
   $this->companies = CompanyPeer::doSelect($c);
  }
  
  /**
   * Retrieve the metadata from the user, add it to what we know, and save
   */
  public function executeSubmitPolicy(sfWebRequest $request){
  	// Check to see if the user submitted a company name that exists
  	$c = new Criteria();
  	$c->add(CompanyPeer::NAME, $request->getParameter('companyName'));
  	$company = CompanyPeer::doSelectOne($c);
  	if (!$company){
  		// New Company
  		$company = new Company();
  		$company->setName($request->getParameter('companyName'));
  	}
  	
  	$this->savePolicy($company, $request->getParameter('policyName'));
  	
  	$this->companyName = $request->getParameter('companyName');
  	$this->policyName = $request->getParameter('policyName');
  }
  
  /**
   * Saves the new policy to the database
   */
  private function savePolicy(Company $company, $policyName){
  	$p = new Policy();
  	$p->setCompany($company);
  	$p->setName($policyName);
  	$p->setUrl($_SESSION['terms_url']);
  	$p->setScrapedata($_SESSION['scrape_data']);
  	$p->setScrapemethod($_SESSION['scrape_method']);
  	if ($_SESSION['need_spoof'] == 1) $p->setSpoof($_SERVER['HTTP_USER_AGENT']);
  	$p->setPre(0);
  	
  	$p->save();
  }
}
