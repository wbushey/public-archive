<?php

class Version extends BaseVersion
{
	/**
	 * Indicates if the Version has been flagged as deleted.
	 */
	public function isDeleted(){
		return (bool)($this->getFlags() & VersionPeer::DELETED);
	}
	
	/**
	 * Indicates if the Version has been flagged as the first version.
	 */
	public function isFirst(){
		return (bool)($this->getFlags() & VersionPeer::FIRST);
	}
	
	/**
	 * Indicates if the Version has been flagged as a pseudo first version.
	 */
	public function isPseudoFirst(){
		return (bool)($this->getFlags() & VersionPeer::PSEUDO_FIRST);
	}
	
	/**
	 * Indicates if the Version has been flagged as a Wayback entry.
	 */
	public function isWayback(){
		return (bool)($this->getFlags() & VersionPeer::WAYBACK);
	}
}
