<?php


/**
 * Base class that represents a query for the 'tourney_round_status' table.
 *
 * Status of a round of the tournament.
 *
 * @method     TourneyRoundStatusQuery orderByTourneyId($order = Criteria::ASC) Order by the tourney_id column
 * @method     TourneyRoundStatusQuery orderByRoundNumber($order = Criteria::ASC) Order by the round_number column
 * @method     TourneyRoundStatusQuery orderByRoundStartTime($order = Criteria::ASC) Order by the round_start_time column
 * @method     TourneyRoundStatusQuery orderByRoundEndTime($order = Criteria::ASC) Order by the round_end_time column
 *
 * @method     TourneyRoundStatusQuery groupByTourneyId() Group by the tourney_id column
 * @method     TourneyRoundStatusQuery groupByRoundNumber() Group by the round_number column
 * @method     TourneyRoundStatusQuery groupByRoundStartTime() Group by the round_start_time column
 * @method     TourneyRoundStatusQuery groupByRoundEndTime() Group by the round_end_time column
 *
 * @method     TourneyRoundStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TourneyRoundStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TourneyRoundStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TourneyRoundStatusQuery leftJoinTourneyStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyStatus relation
 * @method     TourneyRoundStatusQuery rightJoinTourneyStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyStatus relation
 * @method     TourneyRoundStatusQuery innerJoinTourneyStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyStatus relation
 *
 * @method     TourneyRoundStatusQuery leftJoinTourneyFightsRelatedByTourneyId($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightsRelatedByTourneyId relation
 * @method     TourneyRoundStatusQuery rightJoinTourneyFightsRelatedByTourneyId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightsRelatedByTourneyId relation
 * @method     TourneyRoundStatusQuery innerJoinTourneyFightsRelatedByTourneyId($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightsRelatedByTourneyId relation
 *
 * @method     TourneyRoundStatusQuery leftJoinTourneyFightsRelatedByRoundNumber($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightsRelatedByRoundNumber relation
 * @method     TourneyRoundStatusQuery rightJoinTourneyFightsRelatedByRoundNumber($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightsRelatedByRoundNumber relation
 * @method     TourneyRoundStatusQuery innerJoinTourneyFightsRelatedByRoundNumber($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightsRelatedByRoundNumber relation
 *
 * @method     TourneyRoundStatus findOne(PropelPDO $con = null) Return the first TourneyRoundStatus matching the query
 * @method     TourneyRoundStatus findOneOrCreate(PropelPDO $con = null) Return the first TourneyRoundStatus matching the query, or a new TourneyRoundStatus object populated from the query conditions when no match is found
 *
 * @method     TourneyRoundStatus findOneByTourneyId(int $tourney_id) Return the first TourneyRoundStatus filtered by the tourney_id column
 * @method     TourneyRoundStatus findOneByRoundNumber(int $round_number) Return the first TourneyRoundStatus filtered by the round_number column
 * @method     TourneyRoundStatus findOneByRoundStartTime(string $round_start_time) Return the first TourneyRoundStatus filtered by the round_start_time column
 * @method     TourneyRoundStatus findOneByRoundEndTime(string $round_end_time) Return the first TourneyRoundStatus filtered by the round_end_time column
 *
 * @method     array findByTourneyId(int $tourney_id) Return TourneyRoundStatus objects filtered by the tourney_id column
 * @method     array findByRoundNumber(int $round_number) Return TourneyRoundStatus objects filtered by the round_number column
 * @method     array findByRoundStartTime(string $round_start_time) Return TourneyRoundStatus objects filtered by the round_start_time column
 * @method     array findByRoundEndTime(string $round_end_time) Return TourneyRoundStatus objects filtered by the round_end_time column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyRoundStatusQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTourneyRoundStatusQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'TourneyRoundStatus', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TourneyRoundStatusQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TourneyRoundStatusQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TourneyRoundStatusQuery) {
			return $criteria;
		}
		$query = new TourneyRoundStatusQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 *
	 * @param     array[$tourney_id, $round_number] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    TourneyRoundStatus|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TourneyRoundStatusPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TourneyRoundStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    TourneyRoundStatus A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `TOURNEY_ID`, `ROUND_NUMBER`, `ROUND_START_TIME`, `ROUND_END_TIME` FROM `tourney_round_status` WHERE `TOURNEY_ID` = :p0 AND `ROUND_NUMBER` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new TourneyRoundStatus();
			$obj->hydrate($row);
			TourneyRoundStatusPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    TourneyRoundStatus|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(TourneyRoundStatusPeer::TOURNEY_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(TourneyRoundStatusPeer::ROUND_NUMBER, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(TourneyRoundStatusPeer::TOURNEY_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(TourneyRoundStatusPeer::ROUND_NUMBER, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the tourney_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTourneyId(1234); // WHERE tourney_id = 1234
	 * $query->filterByTourneyId(array(12, 34)); // WHERE tourney_id IN (12, 34)
	 * $query->filterByTourneyId(array('min' => 12)); // WHERE tourney_id > 12
	 * </code>
	 *
	 * @see       filterByTourneyStatus()
	 *
	 * @param     mixed $tourneyId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyId($tourneyId = null, $comparison = null)
	{
		if (is_array($tourneyId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyRoundStatusPeer::TOURNEY_ID, $tourneyId, $comparison);
	}

	/**
	 * Filter the query on the round_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoundNumber(1234); // WHERE round_number = 1234
	 * $query->filterByRoundNumber(array(12, 34)); // WHERE round_number IN (12, 34)
	 * $query->filterByRoundNumber(array('min' => 12)); // WHERE round_number > 12
	 * </code>
	 *
	 * @param     mixed $roundNumber The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByRoundNumber($roundNumber = null, $comparison = null)
	{
		if (is_array($roundNumber) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyRoundStatusPeer::ROUND_NUMBER, $roundNumber, $comparison);
	}

	/**
	 * Filter the query on the round_start_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoundStartTime('2011-03-14'); // WHERE round_start_time = '2011-03-14'
	 * $query->filterByRoundStartTime('now'); // WHERE round_start_time = '2011-03-14'
	 * $query->filterByRoundStartTime(array('max' => 'yesterday')); // WHERE round_start_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $roundStartTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByRoundStartTime($roundStartTime = null, $comparison = null)
	{
		if (is_array($roundStartTime)) {
			$useMinMax = false;
			if (isset($roundStartTime['min'])) {
				$this->addUsingAlias(TourneyRoundStatusPeer::ROUND_START_TIME, $roundStartTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roundStartTime['max'])) {
				$this->addUsingAlias(TourneyRoundStatusPeer::ROUND_START_TIME, $roundStartTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyRoundStatusPeer::ROUND_START_TIME, $roundStartTime, $comparison);
	}

	/**
	 * Filter the query on the round_end_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoundEndTime('2011-03-14'); // WHERE round_end_time = '2011-03-14'
	 * $query->filterByRoundEndTime('now'); // WHERE round_end_time = '2011-03-14'
	 * $query->filterByRoundEndTime(array('max' => 'yesterday')); // WHERE round_end_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $roundEndTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByRoundEndTime($roundEndTime = null, $comparison = null)
	{
		if (is_array($roundEndTime)) {
			$useMinMax = false;
			if (isset($roundEndTime['min'])) {
				$this->addUsingAlias(TourneyRoundStatusPeer::ROUND_END_TIME, $roundEndTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roundEndTime['max'])) {
				$this->addUsingAlias(TourneyRoundStatusPeer::ROUND_END_TIME, $roundEndTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyRoundStatusPeer::ROUND_END_TIME, $roundEndTime, $comparison);
	}

	/**
	 * Filter the query by a related TourneyStatus object
	 *
	 * @param     TourneyStatus|PropelCollection $tourneyStatus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyStatus($tourneyStatus, $comparison = null)
	{
		if ($tourneyStatus instanceof TourneyStatus) {
			return $this
				->addUsingAlias(TourneyRoundStatusPeer::TOURNEY_ID, $tourneyStatus->getId(), $comparison);
		} elseif ($tourneyStatus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyRoundStatusPeer::TOURNEY_ID, $tourneyStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByTourneyStatus() only accepts arguments of type TourneyStatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyStatus relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function joinTourneyStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyStatus');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'TourneyStatus');
		}

		return $this;
	}

	/**
	 * Use the TourneyStatus relation TourneyStatus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyStatusQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyStatus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyStatus', 'TourneyStatusQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights $tourneyFights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightsRelatedByTourneyId($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(TourneyRoundStatusPeer::TOURNEY_ID, $tourneyFights->getTourneyId(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			return $this
				->useTourneyFightsRelatedByTourneyIdQuery()
				->filterByPrimaryKeys($tourneyFights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyFightsRelatedByTourneyId() only accepts arguments of type TourneyFights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightsRelatedByTourneyId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function joinTourneyFightsRelatedByTourneyId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightsRelatedByTourneyId');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'TourneyFightsRelatedByTourneyId');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightsRelatedByTourneyId relation TourneyFights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightsRelatedByTourneyIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightsRelatedByTourneyId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightsRelatedByTourneyId', 'TourneyFightsQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights $tourneyFights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightsRelatedByRoundNumber($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(TourneyRoundStatusPeer::ROUND_NUMBER, $tourneyFights->getRoundNumber(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			return $this
				->useTourneyFightsRelatedByRoundNumberQuery()
				->filterByPrimaryKeys($tourneyFights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyFightsRelatedByRoundNumber() only accepts arguments of type TourneyFights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightsRelatedByRoundNumber relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function joinTourneyFightsRelatedByRoundNumber($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightsRelatedByRoundNumber');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'TourneyFightsRelatedByRoundNumber');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightsRelatedByRoundNumber relation TourneyFights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightsRelatedByRoundNumberQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightsRelatedByRoundNumber($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightsRelatedByRoundNumber', 'TourneyFightsQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     TourneyRoundStatus $tourneyRoundStatus Object to remove from the list of results
	 *
	 * @return    TourneyRoundStatusQuery The current query, for fluid interface
	 */
	public function prune($tourneyRoundStatus = null)
	{
		if ($tourneyRoundStatus) {
			$this->addCond('pruneCond0', $this->getAliasedColName(TourneyRoundStatusPeer::TOURNEY_ID), $tourneyRoundStatus->getTourneyId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(TourneyRoundStatusPeer::ROUND_NUMBER), $tourneyRoundStatus->getRoundNumber(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseTourneyRoundStatusQuery