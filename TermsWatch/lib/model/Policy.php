<?php

class Policy extends BasePolicy
{	
	/**
	  * Returns true if the system only has the initial version of the policy.
	  */
	 public function isInitialOnly(){
	 	$c = new Criteria();
	 	$c->add(VersionPeer::PID, $this->getPid());
	 	return (VersionPeer::doCount($c) < 2);
	 }
	 
	 /**
	  * Returns the earliest version of the policy and the timestamp.
	  * 
	  * @return array(0=> Version, 1=> timestamp)
	  */
	 public function getInitialVidAndTimestamp(){
		return VersionPeer::getInitialVidAndTimestamp($this->getPid());	
	 }
	 
	 /**
	  * Returns the latest version of the policy and the timestamp.
	  * 
	  * @return array(0=> Version, 1=> timestamp)
	  */
	 public function getLatestVidAndTimestamp(){
	 	return VersionPeer::getLatestVidAndTimestamp($this->getPid());		 	
	 }
}
