<?php


/**
 * Base class that represents a query for the 'tourney_fighters' table.
 *
 * List of fighters participating in the tournament.
 *
 * @method     TourneyFightersQuery orderByTourneyId($order = Criteria::ASC) Order by the tourney_id column
 * @method     TourneyFightersQuery orderByFighterId($order = Criteria::ASC) Order by the fighter_id column
 *
 * @method     TourneyFightersQuery groupByTourneyId() Group by the tourney_id column
 * @method     TourneyFightersQuery groupByFighterId() Group by the fighter_id column
 *
 * @method     TourneyFightersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TourneyFightersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TourneyFightersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TourneyFightersQuery leftJoinTourneyStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyStatus relation
 * @method     TourneyFightersQuery rightJoinTourneyStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyStatus relation
 * @method     TourneyFightersQuery innerJoinTourneyStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyStatus relation
 *
 * @method     TourneyFightersQuery leftJoinNames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Names relation
 * @method     TourneyFightersQuery rightJoinNames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Names relation
 * @method     TourneyFightersQuery innerJoinNames($relationAlias = null) Adds a INNER JOIN clause to the query using the Names relation
 *
 * @method     TourneyFightersQuery leftJoinTourneyFightsRelatedByOneid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightsRelatedByOneid relation
 * @method     TourneyFightersQuery rightJoinTourneyFightsRelatedByOneid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightsRelatedByOneid relation
 * @method     TourneyFightersQuery innerJoinTourneyFightsRelatedByOneid($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightsRelatedByOneid relation
 *
 * @method     TourneyFightersQuery leftJoinTourneyFightsRelatedByTwoid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightsRelatedByTwoid relation
 * @method     TourneyFightersQuery rightJoinTourneyFightsRelatedByTwoid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightsRelatedByTwoid relation
 * @method     TourneyFightersQuery innerJoinTourneyFightsRelatedByTwoid($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightsRelatedByTwoid relation
 *
 * @method     TourneyFightersQuery leftJoinTourneyUserAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyUserAction relation
 * @method     TourneyFightersQuery rightJoinTourneyUserAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyUserAction relation
 * @method     TourneyFightersQuery innerJoinTourneyUserAction($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyUserAction relation
 *
 * @method     TourneyFighters findOne(PropelPDO $con = null) Return the first TourneyFighters matching the query
 * @method     TourneyFighters findOneOrCreate(PropelPDO $con = null) Return the first TourneyFighters matching the query, or a new TourneyFighters object populated from the query conditions when no match is found
 *
 * @method     TourneyFighters findOneByTourneyId(int $tourney_id) Return the first TourneyFighters filtered by the tourney_id column
 * @method     TourneyFighters findOneByFighterId(int $fighter_id) Return the first TourneyFighters filtered by the fighter_id column
 *
 * @method     array findByTourneyId(int $tourney_id) Return TourneyFighters objects filtered by the tourney_id column
 * @method     array findByFighterId(int $fighter_id) Return TourneyFighters objects filtered by the fighter_id column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyFightersQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTourneyFightersQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'TourneyFighters', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TourneyFightersQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TourneyFightersQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TourneyFightersQuery) {
			return $criteria;
		}
		$query = new TourneyFightersQuery();
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
	 * @param     array[$tourney_id, $fighter_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    TourneyFighters|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TourneyFightersPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    TourneyFighters A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `TOURNEY_ID`, `FIGHTER_ID` FROM `tourney_fighters` WHERE `TOURNEY_ID` = :p0 AND `FIGHTER_ID` = :p1';
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
			$obj = new TourneyFighters();
			$obj->hydrate($row);
			TourneyFightersPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    TourneyFighters|array|mixed the result, formatted by the current formatter
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
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(TourneyFightersPeer::TOURNEY_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(TourneyFightersPeer::TOURNEY_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(TourneyFightersPeer::FIGHTER_ID, $key[1], Criteria::EQUAL);
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
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByTourneyId($tourneyId = null, $comparison = null)
	{
		if (is_array($tourneyId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyFightersPeer::TOURNEY_ID, $tourneyId, $comparison);
	}

	/**
	 * Filter the query on the fighter_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFighterId(1234); // WHERE fighter_id = 1234
	 * $query->filterByFighterId(array(12, 34)); // WHERE fighter_id IN (12, 34)
	 * $query->filterByFighterId(array('min' => 12)); // WHERE fighter_id > 12
	 * </code>
	 *
	 * @see       filterByNames()
	 *
	 * @param     mixed $fighterId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByFighterId($fighterId = null, $comparison = null)
	{
		if (is_array($fighterId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $fighterId, $comparison);
	}

	/**
	 * Filter the query by a related TourneyStatus object
	 *
	 * @param     TourneyStatus|PropelCollection $tourneyStatus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByTourneyStatus($tourneyStatus, $comparison = null)
	{
		if ($tourneyStatus instanceof TourneyStatus) {
			return $this
				->addUsingAlias(TourneyFightersPeer::TOURNEY_ID, $tourneyStatus->getId(), $comparison);
		} elseif ($tourneyStatus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightersPeer::TOURNEY_ID, $tourneyStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    TourneyFightersQuery The current query, for fluid interface
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
	 * Filter the query by a related Names object
	 *
	 * @param     Names|PropelCollection $names The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByNames($names, $comparison = null)
	{
		if ($names instanceof Names) {
			return $this
				->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $names->getId(), $comparison);
		} elseif ($names instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $names->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByNames() only accepts arguments of type Names or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Names relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function joinNames($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Names');

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
			$this->addJoinObject($join, 'Names');
		}

		return $this;
	}

	/**
	 * Use the Names relation Names object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery A secondary query class using the current class as primary query
	 */
	public function useNamesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinNames($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Names', 'NamesQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights $tourneyFights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightsRelatedByOneid($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $tourneyFights->getOneid(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			return $this
				->useTourneyFightsRelatedByOneidQuery()
				->filterByPrimaryKeys($tourneyFights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyFightsRelatedByOneid() only accepts arguments of type TourneyFights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightsRelatedByOneid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function joinTourneyFightsRelatedByOneid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightsRelatedByOneid');

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
			$this->addJoinObject($join, 'TourneyFightsRelatedByOneid');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightsRelatedByOneid relation TourneyFights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightsRelatedByOneidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightsRelatedByOneid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightsRelatedByOneid', 'TourneyFightsQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights $tourneyFights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightsRelatedByTwoid($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $tourneyFights->getTwoid(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			return $this
				->useTourneyFightsRelatedByTwoidQuery()
				->filterByPrimaryKeys($tourneyFights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyFightsRelatedByTwoid() only accepts arguments of type TourneyFights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightsRelatedByTwoid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function joinTourneyFightsRelatedByTwoid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightsRelatedByTwoid');

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
			$this->addJoinObject($join, 'TourneyFightsRelatedByTwoid');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightsRelatedByTwoid relation TourneyFights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightsRelatedByTwoidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightsRelatedByTwoid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightsRelatedByTwoid', 'TourneyFightsQuery');
	}

	/**
	 * Filter the query by a related TourneyUserAction object
	 *
	 * @param     TourneyUserAction $tourneyUserAction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function filterByTourneyUserAction($tourneyUserAction, $comparison = null)
	{
		if ($tourneyUserAction instanceof TourneyUserAction) {
			return $this
				->addUsingAlias(TourneyFightersPeer::FIGHTER_ID, $tourneyUserAction->getResult(), $comparison);
		} elseif ($tourneyUserAction instanceof PropelCollection) {
			return $this
				->useTourneyUserActionQuery()
				->filterByPrimaryKeys($tourneyUserAction->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyUserAction() only accepts arguments of type TourneyUserAction or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyUserAction relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function joinTourneyUserAction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyUserAction');

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
			$this->addJoinObject($join, 'TourneyUserAction');
		}

		return $this;
	}

	/**
	 * Use the TourneyUserAction relation TourneyUserAction object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyUserActionQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyUserActionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyUserAction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyUserAction', 'TourneyUserActionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     TourneyFighters $tourneyFighters Object to remove from the list of results
	 *
	 * @return    TourneyFightersQuery The current query, for fluid interface
	 */
	public function prune($tourneyFighters = null)
	{
		if ($tourneyFighters) {
			$this->addCond('pruneCond0', $this->getAliasedColName(TourneyFightersPeer::TOURNEY_ID), $tourneyFighters->getTourneyId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(TourneyFightersPeer::FIGHTER_ID), $tourneyFighters->getFighterId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseTourneyFightersQuery