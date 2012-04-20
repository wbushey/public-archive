<?php


/**
 * Base class that represents a query for the 'tourney_status' table.
 *
 * General status of the tournament.
 *
 * @method     TourneyStatusQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TourneyStatusQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     TourneyStatusQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     TourneyStatusQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 * @method     TourneyStatusQuery orderByRoundNumber($order = Criteria::ASC) Order by the round_number column
 * @method     TourneyStatusQuery orderByRoot($order = Criteria::ASC) Order by the root column
 *
 * @method     TourneyStatusQuery groupById() Group by the id column
 * @method     TourneyStatusQuery groupByActive() Group by the active column
 * @method     TourneyStatusQuery groupByStartTime() Group by the start_time column
 * @method     TourneyStatusQuery groupByEndTime() Group by the end_time column
 * @method     TourneyStatusQuery groupByRoundNumber() Group by the round_number column
 * @method     TourneyStatusQuery groupByRoot() Group by the root column
 *
 * @method     TourneyStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TourneyStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TourneyStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TourneyStatusQuery leftJoinTourneyRoundStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyRoundStatus relation
 * @method     TourneyStatusQuery rightJoinTourneyRoundStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyRoundStatus relation
 * @method     TourneyStatusQuery innerJoinTourneyRoundStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyRoundStatus relation
 *
 * @method     TourneyStatusQuery leftJoinTourneyFighters($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFighters relation
 * @method     TourneyStatusQuery rightJoinTourneyFighters($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFighters relation
 * @method     TourneyStatusQuery innerJoinTourneyFighters($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFighters relation
 *
 * @method     TourneyStatus findOne(PropelPDO $con = null) Return the first TourneyStatus matching the query
 * @method     TourneyStatus findOneOrCreate(PropelPDO $con = null) Return the first TourneyStatus matching the query, or a new TourneyStatus object populated from the query conditions when no match is found
 *
 * @method     TourneyStatus findOneById(int $id) Return the first TourneyStatus filtered by the id column
 * @method     TourneyStatus findOneByActive(boolean $active) Return the first TourneyStatus filtered by the active column
 * @method     TourneyStatus findOneByStartTime(string $start_time) Return the first TourneyStatus filtered by the start_time column
 * @method     TourneyStatus findOneByEndTime(string $end_time) Return the first TourneyStatus filtered by the end_time column
 * @method     TourneyStatus findOneByRoundNumber(int $round_number) Return the first TourneyStatus filtered by the round_number column
 * @method     TourneyStatus findOneByRoot(int $root) Return the first TourneyStatus filtered by the root column
 *
 * @method     array findById(int $id) Return TourneyStatus objects filtered by the id column
 * @method     array findByActive(boolean $active) Return TourneyStatus objects filtered by the active column
 * @method     array findByStartTime(string $start_time) Return TourneyStatus objects filtered by the start_time column
 * @method     array findByEndTime(string $end_time) Return TourneyStatus objects filtered by the end_time column
 * @method     array findByRoundNumber(int $round_number) Return TourneyStatus objects filtered by the round_number column
 * @method     array findByRoot(int $root) Return TourneyStatus objects filtered by the root column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyStatusQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTourneyStatusQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'TourneyStatus', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TourneyStatusQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TourneyStatusQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TourneyStatusQuery) {
			return $criteria;
		}
		$query = new TourneyStatusQuery();
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
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    TourneyStatus|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TourneyStatusPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TourneyStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    TourneyStatus A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `ACTIVE`, `START_TIME`, `END_TIME`, `ROUND_NUMBER`, `ROOT` FROM `tourney_status` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new TourneyStatus();
			$obj->hydrate($row);
			TourneyStatusPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    TourneyStatus|array|mixed the result, formatted by the current formatter
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
	 * $objs = $c->findPks(array(12, 56, 832), $con);
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
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TourneyStatusPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TourneyStatusPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyStatusPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByActive(true); // WHERE active = true
	 * $query->filterByActive('yes'); // WHERE active = true
	 * </code>
	 *
	 * @param     boolean|string $active The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_string($active)) {
			$active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(TourneyStatusPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the start_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
	 * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
	 * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $startTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByStartTime($startTime = null, $comparison = null)
	{
		if (is_array($startTime)) {
			$useMinMax = false;
			if (isset($startTime['min'])) {
				$this->addUsingAlias(TourneyStatusPeer::START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($startTime['max'])) {
				$this->addUsingAlias(TourneyStatusPeer::START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyStatusPeer::START_TIME, $startTime, $comparison);
	}

	/**
	 * Filter the query on the end_time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEndTime('2011-03-14'); // WHERE end_time = '2011-03-14'
	 * $query->filterByEndTime('now'); // WHERE end_time = '2011-03-14'
	 * $query->filterByEndTime(array('max' => 'yesterday')); // WHERE end_time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $endTime The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByEndTime($endTime = null, $comparison = null)
	{
		if (is_array($endTime)) {
			$useMinMax = false;
			if (isset($endTime['min'])) {
				$this->addUsingAlias(TourneyStatusPeer::END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($endTime['max'])) {
				$this->addUsingAlias(TourneyStatusPeer::END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyStatusPeer::END_TIME, $endTime, $comparison);
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
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByRoundNumber($roundNumber = null, $comparison = null)
	{
		if (is_array($roundNumber)) {
			$useMinMax = false;
			if (isset($roundNumber['min'])) {
				$this->addUsingAlias(TourneyStatusPeer::ROUND_NUMBER, $roundNumber['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roundNumber['max'])) {
				$this->addUsingAlias(TourneyStatusPeer::ROUND_NUMBER, $roundNumber['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyStatusPeer::ROUND_NUMBER, $roundNumber, $comparison);
	}

	/**
	 * Filter the query on the root column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoot(1234); // WHERE root = 1234
	 * $query->filterByRoot(array(12, 34)); // WHERE root IN (12, 34)
	 * $query->filterByRoot(array('min' => 12)); // WHERE root > 12
	 * </code>
	 *
	 * @param     mixed $root The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByRoot($root = null, $comparison = null)
	{
		if (is_array($root)) {
			$useMinMax = false;
			if (isset($root['min'])) {
				$this->addUsingAlias(TourneyStatusPeer::ROOT, $root['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($root['max'])) {
				$this->addUsingAlias(TourneyStatusPeer::ROOT, $root['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyStatusPeer::ROOT, $root, $comparison);
	}

	/**
	 * Filter the query by a related TourneyRoundStatus object
	 *
	 * @param     TourneyRoundStatus $tourneyRoundStatus  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyRoundStatus($tourneyRoundStatus, $comparison = null)
	{
		if ($tourneyRoundStatus instanceof TourneyRoundStatus) {
			return $this
				->addUsingAlias(TourneyStatusPeer::ID, $tourneyRoundStatus->getTourneyId(), $comparison);
		} elseif ($tourneyRoundStatus instanceof PropelCollection) {
			return $this
				->useTourneyRoundStatusQuery()
				->filterByPrimaryKeys($tourneyRoundStatus->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyRoundStatus() only accepts arguments of type TourneyRoundStatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyRoundStatus relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function joinTourneyRoundStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyRoundStatus');

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
			$this->addJoinObject($join, 'TourneyRoundStatus');
		}

		return $this;
	}

	/**
	 * Use the TourneyRoundStatus relation TourneyRoundStatus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyRoundStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyRoundStatus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyRoundStatus', 'TourneyRoundStatusQuery');
	}

	/**
	 * Filter the query by a related TourneyFighters object
	 *
	 * @param     TourneyFighters $tourneyFighters  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function filterByTourneyFighters($tourneyFighters, $comparison = null)
	{
		if ($tourneyFighters instanceof TourneyFighters) {
			return $this
				->addUsingAlias(TourneyStatusPeer::ID, $tourneyFighters->getTourneyId(), $comparison);
		} elseif ($tourneyFighters instanceof PropelCollection) {
			return $this
				->useTourneyFightersQuery()
				->filterByPrimaryKeys($tourneyFighters->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyFighters() only accepts arguments of type TourneyFighters or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFighters relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function joinTourneyFighters($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFighters');

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
			$this->addJoinObject($join, 'TourneyFighters');
		}

		return $this;
	}

	/**
	 * Use the TourneyFighters relation TourneyFighters object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFighters($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFighters', 'TourneyFightersQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     TourneyStatus $tourneyStatus Object to remove from the list of results
	 *
	 * @return    TourneyStatusQuery The current query, for fluid interface
	 */
	public function prune($tourneyStatus = null)
	{
		if ($tourneyStatus) {
			$this->addUsingAlias(TourneyStatusPeer::ID, $tourneyStatus->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseTourneyStatusQuery