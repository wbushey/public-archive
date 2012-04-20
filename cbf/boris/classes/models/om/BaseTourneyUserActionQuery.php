<?php


/**
 * Base class that represents a query for the 'tourney_user_action' table.
 *
 * Recording of users actions within a tournament.
 *
 * @method     TourneyUserActionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TourneyUserActionQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     TourneyUserActionQuery orderByFightId($order = Criteria::ASC) Order by the fight_id column
 * @method     TourneyUserActionQuery orderByResult($order = Criteria::ASC) Order by the result column
 * @method     TourneyUserActionQuery orderByTime($order = Criteria::ASC) Order by the time column
 *
 * @method     TourneyUserActionQuery groupById() Group by the id column
 * @method     TourneyUserActionQuery groupByUserId() Group by the user_id column
 * @method     TourneyUserActionQuery groupByFightId() Group by the fight_id column
 * @method     TourneyUserActionQuery groupByResult() Group by the result column
 * @method     TourneyUserActionQuery groupByTime() Group by the time column
 *
 * @method     TourneyUserActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TourneyUserActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TourneyUserActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TourneyUserActionQuery leftJoinUserprofile($relationAlias = null) Adds a LEFT JOIN clause to the query using the Userprofile relation
 * @method     TourneyUserActionQuery rightJoinUserprofile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Userprofile relation
 * @method     TourneyUserActionQuery innerJoinUserprofile($relationAlias = null) Adds a INNER JOIN clause to the query using the Userprofile relation
 *
 * @method     TourneyUserActionQuery leftJoinTourneyFights($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFights relation
 * @method     TourneyUserActionQuery rightJoinTourneyFights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFights relation
 * @method     TourneyUserActionQuery innerJoinTourneyFights($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFights relation
 *
 * @method     TourneyUserActionQuery leftJoinTourneyFighters($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFighters relation
 * @method     TourneyUserActionQuery rightJoinTourneyFighters($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFighters relation
 * @method     TourneyUserActionQuery innerJoinTourneyFighters($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFighters relation
 *
 * @method     TourneyUserAction findOne(PropelPDO $con = null) Return the first TourneyUserAction matching the query
 * @method     TourneyUserAction findOneOrCreate(PropelPDO $con = null) Return the first TourneyUserAction matching the query, or a new TourneyUserAction object populated from the query conditions when no match is found
 *
 * @method     TourneyUserAction findOneById(int $id) Return the first TourneyUserAction filtered by the id column
 * @method     TourneyUserAction findOneByUserId(int $user_id) Return the first TourneyUserAction filtered by the user_id column
 * @method     TourneyUserAction findOneByFightId(int $fight_id) Return the first TourneyUserAction filtered by the fight_id column
 * @method     TourneyUserAction findOneByResult(int $result) Return the first TourneyUserAction filtered by the result column
 * @method     TourneyUserAction findOneByTime(string $time) Return the first TourneyUserAction filtered by the time column
 *
 * @method     array findById(int $id) Return TourneyUserAction objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return TourneyUserAction objects filtered by the user_id column
 * @method     array findByFightId(int $fight_id) Return TourneyUserAction objects filtered by the fight_id column
 * @method     array findByResult(int $result) Return TourneyUserAction objects filtered by the result column
 * @method     array findByTime(string $time) Return TourneyUserAction objects filtered by the time column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyUserActionQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTourneyUserActionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'TourneyUserAction', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TourneyUserActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TourneyUserActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TourneyUserActionQuery) {
			return $criteria;
		}
		$query = new TourneyUserActionQuery();
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
	 * @return    TourneyUserAction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TourneyUserActionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TourneyUserActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    TourneyUserAction A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `FIGHT_ID`, `RESULT`, `TIME` FROM `tourney_user_action` WHERE `ID` = :p0';
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
			$obj = new TourneyUserAction();
			$obj->hydrate($row);
			TourneyUserActionPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    TourneyUserAction|array|mixed the result, formatted by the current formatter
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
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TourneyUserActionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TourneyUserActionPeer::ID, $keys, Criteria::IN);
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
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyUserActionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUserprofile()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(TourneyUserActionPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(TourneyUserActionPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyUserActionPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the fight_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFightId(1234); // WHERE fight_id = 1234
	 * $query->filterByFightId(array(12, 34)); // WHERE fight_id IN (12, 34)
	 * $query->filterByFightId(array('min' => 12)); // WHERE fight_id > 12
	 * </code>
	 *
	 * @see       filterByTourneyFights()
	 *
	 * @param     mixed $fightId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByFightId($fightId = null, $comparison = null)
	{
		if (is_array($fightId)) {
			$useMinMax = false;
			if (isset($fightId['min'])) {
				$this->addUsingAlias(TourneyUserActionPeer::FIGHT_ID, $fightId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fightId['max'])) {
				$this->addUsingAlias(TourneyUserActionPeer::FIGHT_ID, $fightId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyUserActionPeer::FIGHT_ID, $fightId, $comparison);
	}

	/**
	 * Filter the query on the result column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByResult(1234); // WHERE result = 1234
	 * $query->filterByResult(array(12, 34)); // WHERE result IN (12, 34)
	 * $query->filterByResult(array('min' => 12)); // WHERE result > 12
	 * </code>
	 *
	 * @see       filterByTourneyFighters()
	 *
	 * @param     mixed $result The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByResult($result = null, $comparison = null)
	{
		if (is_array($result)) {
			$useMinMax = false;
			if (isset($result['min'])) {
				$this->addUsingAlias(TourneyUserActionPeer::RESULT, $result['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($result['max'])) {
				$this->addUsingAlias(TourneyUserActionPeer::RESULT, $result['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyUserActionPeer::RESULT, $result, $comparison);
	}

	/**
	 * Filter the query on the time column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTime('2011-03-14'); // WHERE time = '2011-03-14'
	 * $query->filterByTime('now'); // WHERE time = '2011-03-14'
	 * $query->filterByTime(array('max' => 'yesterday')); // WHERE time > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $time The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByTime($time = null, $comparison = null)
	{
		if (is_array($time)) {
			$useMinMax = false;
			if (isset($time['min'])) {
				$this->addUsingAlias(TourneyUserActionPeer::TIME, $time['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($time['max'])) {
				$this->addUsingAlias(TourneyUserActionPeer::TIME, $time['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyUserActionPeer::TIME, $time, $comparison);
	}

	/**
	 * Filter the query by a related Userprofile object
	 *
	 * @param     Userprofile|PropelCollection $userprofile The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByUserprofile($userprofile, $comparison = null)
	{
		if ($userprofile instanceof Userprofile) {
			return $this
				->addUsingAlias(TourneyUserActionPeer::USER_ID, $userprofile->getId(), $comparison);
		} elseif ($userprofile instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyUserActionPeer::USER_ID, $userprofile->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUserprofile() only accepts arguments of type Userprofile or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Userprofile relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function joinUserprofile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Userprofile');

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
			$this->addJoinObject($join, 'Userprofile');
		}

		return $this;
	}

	/**
	 * Use the Userprofile relation Userprofile object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserprofileQuery A secondary query class using the current class as primary query
	 */
	public function useUserprofileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserprofile($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Userprofile', 'UserprofileQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights|PropelCollection $tourneyFights The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByTourneyFights($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(TourneyUserActionPeer::FIGHT_ID, $tourneyFights->getId(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyUserActionPeer::FIGHT_ID, $tourneyFights->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByTourneyFights() only accepts arguments of type TourneyFights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFights relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function joinTourneyFights($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFights');

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
			$this->addJoinObject($join, 'TourneyFights');
		}

		return $this;
	}

	/**
	 * Use the TourneyFights relation TourneyFights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFights($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFights', 'TourneyFightsQuery');
	}

	/**
	 * Filter the query by a related TourneyFighters object
	 *
	 * @param     TourneyFighters|PropelCollection $tourneyFighters The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function filterByTourneyFighters($tourneyFighters, $comparison = null)
	{
		if ($tourneyFighters instanceof TourneyFighters) {
			return $this
				->addUsingAlias(TourneyUserActionPeer::RESULT, $tourneyFighters->getFighterId(), $comparison);
		} elseif ($tourneyFighters instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyUserActionPeer::RESULT, $tourneyFighters->toKeyValue('PrimaryKey', 'FighterId'), $comparison);
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
	 * @return    TourneyUserActionQuery The current query, for fluid interface
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
	 * @param     TourneyUserAction $tourneyUserAction Object to remove from the list of results
	 *
	 * @return    TourneyUserActionQuery The current query, for fluid interface
	 */
	public function prune($tourneyUserAction = null)
	{
		if ($tourneyUserAction) {
			$this->addUsingAlias(TourneyUserActionPeer::ID, $tourneyUserAction->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseTourneyUserActionQuery