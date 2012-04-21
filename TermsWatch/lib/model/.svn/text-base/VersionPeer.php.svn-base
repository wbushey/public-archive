<?php

/**
 * This has become the holder off a lot of the custom SQL carried over from TOSBack.
 * 
 * Sorry for some of the bad method names.
 * @author Bill Bushey <wbushey@acm.org>
 */

class VersionPeer extends BaseVersionPeer
{
	
	const DELETED = 1;
	const FIRST = 2;
	const PSEUDO_FIRST = 4;
	const WAYBACK = 8;
	
	/**
	 * Returns true if the provided flags indicates a first version
	 */
	public static function isFirst($flags){
		return ($flags & self::FIRST);
	}
	
	/*
	 * Begin *, *_Deleted, *_All methods
	 */
	 
	/**
	 * Does a count on all non-deleted versions
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doCount($criteria, $distinct, $con);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
	 	$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doCountJoinAll($criteria, $distinct, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinPolicy(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
	 	$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doCountJoinPolicy($criteria, $distinct, $con, $join_behavior);
	}
	
	/**
	 * Performs a select on all non-deleted versions
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doSelect($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doSelectJoinAll($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinPolicy(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doSelectJoinPolicy($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doSelectOne($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' = 0', Criteria::CUSTOM);
		return parent::doSelectStmt($criteria, $con);
	}

	/**
	 * Does a count on all deleted versions
	 */
	public static function doCount_Deleted(Criteria $criteria, $distinct = false, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doCount($criteria, $distinct, $con);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinAll_Deleted(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
	 	$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doCountJoinAll($criteria, $distinct, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinPolicy_Deleted(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
	 	$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doCountJoinPolicy($criteria, $distinct, $con, $join_behavior);
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * Performs a select on all non-deleted versions
	 */
	public static function doSelect_Deleted(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doSelect($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinAll_Deleted(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doSelectJoinAll($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinPolicy_Deleted(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doSelectJoinPolicy($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectOne_Deleted(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doSelectOne($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectStmt_Deleted(Criteria $criteria, PropelPDO $con = null){
		$criteria->add(self::FLAGS, self::FLAGS . ' & ' . self::DELETED . ' <> 0', Criteria::CUSTOM);
		return parent::doSelectStmt($criteria, $con);
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////
	 
	/**
	 * Does a count on all versions
	 */
	public static function doCount_All(Criteria $criteria, $distinct = false, PropelPDO $con = null){
		return parent::doCount($criteria, $distinct, $con);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinAll_All(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
		return parent::doCountJoinAll($criteria, $distinct, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doCountJoinPolicy_All(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN){
		return parent::doCountJoinPolicy($criteria, $distinct, $con, $join_behavior);
	}
	
	/**
	 * Performs a select on all non-deleted versions
	 */
	public static function doSelect_All(Criteria $criteria, PropelPDO $con = null){
		return parent::doSelect($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinAll_All(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		return parent::doSelectJoinAll($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectJoinPolicy_All(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN){
		return parent::doSelectJoinPolicy($criteria, $con, $join_behavior);
	}
	
	/**
	 * 
	 */
	public static function doSelectOne_All(Criteria $criteria, PropelPDO $con = null){
		return parent::doSelectOne($criteria, $con);
	}
	
	/**
	 * 
	 */
	public static function doSelectStmt_All(Criteria $criteria, PropelPDO $con = null){
		return parent::doSelectStmt($criteria, $con);
	}
	 
	/*
	 * End *, *_Deleted, *_All methods
	 */
	
	/**
	 * Returns the first version of the provided policy
	 */
	public static function getFirstVersion($pid){
		$c = new Criteria();
		$c->add(self::PID, $pid);
		$c->add(self::FLAGS, self::FLAGS . ' & ' . self::FIRST . ' = 0', Criteria::CUSTOM);
		return self::doSelectOne($c);
	}
	
	/**
	 * Returns the latest version of the provided policy
	 */
	public static function getLatestVersion($pid){
		$c = new Criteria();
		$c->add(self::PID, $pid);
		$c->addDescendingOrderByColumn(self::RETRIEVEDAT);
		return self::doSelectOne($c);
	}
	
	/**
	 * Return a version of a policy, along with its timestamp and outcome.
	 * 
	 * While the other custom SQL functions return regular result arrays, this function returns
	 * a Version object plus a bit of additional information.
	 * 
	 * @return array('version' => Version object, 'timestamp' => scrape timestamp, 'outcome' => scrape outcome)
	 */
	public static function getVersion_Timestamp_Outcome($vid){
		
		// First get the object
		$obj = self::retrieveByPK($vid);
		
		// Now get the scrape info
		$connection = Propel::getConnection();
		$query = 	"SELECT s.timestamp, s.outcome " .
					"FROM version v LEFT JOIN scrape s ON v.vid = s.vid " .
					"WHERE v.vid= :vid";
		$stmt = $connection->prepare($query);
		$stmt->bindParam('vid', $vid);
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('Version_Timestamp_Outcome DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		$row = $stmt->fetch();
		if( !$row ){
			return null;
		}
		
		return array(	'version' => $obj, 
						'timestamp' => $row['timestamp'], 
						'outcome' => $row['outcome']);
	}
	
	/**
	 * Returns all the versions of a policy, along with their timestamp and outcome.
	 */
	public static function getAllVersion_Timestamp_Outcome($pid){
		$connection = Propel::getConnection();
		$query = 	"SELECT v.*, s.timestamp, s.outcome " .
					"FROM version v LEFT JOIN scrape s ON v.vid = s.vid " .
					"WHERE v.pid= :pid AND " .
								"s.outcome IN (" . implode("," , array(ScrapePeer::OUTCOME_FIRSTSCRAPE,
																		ScrapePeer::OUTCOME_CHANGESFOUND,
																		ScrapePeer::ADJUSTED_NEWFIRST,
																		ScrapePeer::WAYBACK)).") " .
					"ORDER BY timestamp DESC";
		$stmt = $connection->prepare($query);
		$stmt->bindParam('pid', $pid);
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('AllVersion_Timestamp_Outcome DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		return $stmt->fetchAll();
	}
	
	/**
	 * A specialized function, this returns an array of associative arrays which contain the following information:
	 * 	company.companyName
	 * 	company.image_small
	 * 	policy.pid
	 * 	policy.policyName
	 * 	scrape.timestamp
	 * 	version.vid
	 * 	scrape.outcome
	 * 
	 * The function will check to see if 'pid' or 'cid' is set in the provided $params array. If either is set then
	 * it will be used duing the database search.
	 */
	public static function getTimelineInformation(array $params){
		$connection = Propel::getConnection();
		
		// Build the query string
		$wheres = "";
		if (array_key_exists('pid', $params)){
		  $wheres = " where p.pid = :pid ";
		} else if (array_key_exists('cid', $params)){
		  $wheres = " where c.cid = :cid ";
		}
		$query = 	"SELECT c.name as companyName, c.image_small, p.pid, p.name as policyName, v.retrievedAt, v.vid, v.flags " .
						"FROM version v LEFT JOIN policy p ON v.pid = p.pid " .
								"LEFT JOIN company c ON p.cid = c.cid " .
						$wheres .
						"ORDER BY retrievedAt DESC LIMIT 20";
		
		// Prepare the statement
		$stmt = $connection->prepare($query);
		if (array_key_exists('pid', $params)){
			$stmt->bindParam(":pid", $params['pid']);
		} else if (array_key_exists('cid', $params)){
			$stmt->bindParam(":cid", $params['cid']);
		}
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('TimelineInformation DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		return $stmt->fetchAll();
	}
	
	/**
	 * Returns the VID and timestamp of the initial version of the provided policy id.
	 * 
	 * @return array('vid' => version ID, 'timestamp' => timestamp)
	 */
	public static function getInitialVidAndTimestamp($pid){
		$connection = Propel::getConnection();
		$query = 	"SELECT v.vid,s.timestamp " .
					"FROM version v LEFT JOIN scrape s ON v.vid = s.vid " .
					"WHERE v.pid = :pid AND s.outcome IN (".implode(",",array(ScrapePeer::OUTCOME_FIRSTSCRAPE, ScrapePeer::ADJUSTED_NEWFIRST, ScrapePeer::WAYBACK)).") " .
					"ORDER BY s.timestamp " .
					"ASC LIMIT 1";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':pid', $pid);
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('InitialVidAndTimestamp DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		return $stmt->fetch();
	}
	
	/**
	 * Returns the VID and timestamp of the latest version of the provided policy id.
	 * 
	 * @return array('vid' => version ID, 'timestamp' => timestamp)
	 */
	public static function getLatestVidAndTimestamp($pid){
		$connection = Propel::getConnection();
		$query = 	"SELECT v.vid,s.timestamp " .
					"FROM version v LEFT JOIN scrape s ON v.vid = s.vid " .
					"WHERE v.pid = :pid AND s.outcome IN (".implode(",",array(ScrapePeer::OUTCOME_FIRSTSCRAPE, ScrapePeer::OUTCOME_CHANGESFOUND, ScrapePeer::ADJUSTED_NEWFIRST, ScrapePeer::WAYBACK)).") " .
					"ORDER BY s.timestamp " .
					"DESC LIMIT 1";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':pid', $pid);
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('InitialVidAndTimestamp DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		return $stmt->fetch();
	}
	
	/**
	 * Returns the VID for the version of the policy indicated by PID previous
	 * to the version indicated by VID.
	 * 
	 * If no previous VID exists than null is returned.
	 */
	public static function getPreviousVid($pid, $vid){
		$connection = Propel::getConnection();
		$query = 	"SELECT v.vid " .
					"FROM version v LEFT JOIN scrape s ON v.vid = s.vid " .
					"WHERE v.pid= :pid AND " .
							"s.outcome != " . ScrapePeer::ADJUSTED_DELETED . " " .
					"ORDER BY s.timestamp";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(':pid', $pid);
		
		// Execut
		if (!$stmt->execute()){
			throw new sfException('PreviousVid DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		
		// Sequential Search for provided VID
		while ($row = $stmt->fetch()){
			if ($row['vid'] == $vid) break;
			$prev_row = $row;
		}
		
		// Return the results
		if ($row){
			return $prev_row['vid'];
		} else {
			return null;
		}
	}
	
	public static function getRssInfo(array $params){
		$connection = Propel::getConnection();
		// Build the query string
		$wheres = "";
		if (array_key_exists('pid', $params)){
		  $wheres = "where p.pid = :pid ";
		} else if (array_key_exists('cid', $params)){
		  $wheres = "where c.cid = :cid ";
		}
		$query = 	"SELECT c.name as companyName, c.image_small, p.pid, p.name as policyName, v.retrievedAt, v.vid, v.flags " .
					"FROM version v LEFT JOIN policy p ON v.pid = p.pid " .
							"LEFT JOIN company c ON p.cid = c.cid " .
					$wheres .
					"ORDER BY retrievedAt DESC LIMIT 20";
					
		// Prepare the statement
		$stmt = $connection->prepare($query);
		if (array_key_exists('pid', $params)){
			$stmt->bindParam(":pid", $params['pid']);
		} else if (array_key_exists('cid', $params)){
			$stmt->bindParam(":cid", $params['cid']);
		}
		
		// Execute and return
		if (!$stmt->execute()){
			throw new sfException('TimelineInformation DB Error: ' . $stmt->errorInfo(), $stmt->errorCode());
		}
		return $stmt->fetchAll();
	}
}
