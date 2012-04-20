<?php


/**
 * Base class that represents a query for the 'fights' table.
 *
 * Matches between celebrities
 *
 * @method     FightsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     FightsQuery orderByOneid($order = Criteria::ASC) Order by the oneID column
 * @method     FightsQuery orderByTwoid($order = Criteria::ASC) Order by the twoID column
 * @method     FightsQuery orderByOnewins($order = Criteria::ASC) Order by the oneWins column
 * @method     FightsQuery orderByTwowins($order = Criteria::ASC) Order by the twoWins column
 * @method     FightsQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method     FightsQuery groupById() Group by the id column
 * @method     FightsQuery groupByOneid() Group by the oneID column
 * @method     FightsQuery groupByTwoid() Group by the twoID column
 * @method     FightsQuery groupByOnewins() Group by the oneWins column
 * @method     FightsQuery groupByTwowins() Group by the twoWins column
 * @method     FightsQuery groupByActive() Group by the active column
 *
 * @method     FightsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FightsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FightsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FightsQuery leftJoinNamesRelatedByOneid($relationAlias = null) Adds a LEFT JOIN clause to the query using the NamesRelatedByOneid relation
 * @method     FightsQuery rightJoinNamesRelatedByOneid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NamesRelatedByOneid relation
 * @method     FightsQuery innerJoinNamesRelatedByOneid($relationAlias = null) Adds a INNER JOIN clause to the query using the NamesRelatedByOneid relation
 *
 * @method     FightsQuery leftJoinNamesRelatedByTwoid($relationAlias = null) Adds a LEFT JOIN clause to the query using the NamesRelatedByTwoid relation
 * @method     FightsQuery rightJoinNamesRelatedByTwoid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NamesRelatedByTwoid relation
 * @method     FightsQuery innerJoinNamesRelatedByTwoid($relationAlias = null) Adds a INNER JOIN clause to the query using the NamesRelatedByTwoid relation
 *
 * @method     FightsQuery leftJoinPosts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Posts relation
 * @method     FightsQuery rightJoinPosts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Posts relation
 * @method     FightsQuery innerJoinPosts($relationAlias = null) Adds a INNER JOIN clause to the query using the Posts relation
 *
 * @method     FightsQuery leftJoinTourneyFights($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFights relation
 * @method     FightsQuery rightJoinTourneyFights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFights relation
 * @method     FightsQuery innerJoinTourneyFights($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFights relation
 *
 * @method     Fights findOne(PropelPDO $con = null) Return the first Fights matching the query
 * @method     Fights findOneOrCreate(PropelPDO $con = null) Return the first Fights matching the query, or a new Fights object populated from the query conditions when no match is found
 *
 * @method     Fights findOneById(int $id) Return the first Fights filtered by the id column
 * @method     Fights findOneByOneid(int $oneID) Return the first Fights filtered by the oneID column
 * @method     Fights findOneByTwoid(int $twoID) Return the first Fights filtered by the twoID column
 * @method     Fights findOneByOnewins(int $oneWins) Return the first Fights filtered by the oneWins column
 * @method     Fights findOneByTwowins(int $twoWins) Return the first Fights filtered by the twoWins column
 * @method     Fights findOneByActive(int $active) Return the first Fights filtered by the active column
 *
 * @method     array findById(int $id) Return Fights objects filtered by the id column
 * @method     array findByOneid(int $oneID) Return Fights objects filtered by the oneID column
 * @method     array findByTwoid(int $twoID) Return Fights objects filtered by the twoID column
 * @method     array findByOnewins(int $oneWins) Return Fights objects filtered by the oneWins column
 * @method     array findByTwowins(int $twoWins) Return Fights objects filtered by the twoWins column
 * @method     array findByActive(int $active) Return Fights objects filtered by the active column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseFightsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseFightsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Fights', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FightsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FightsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FightsQuery) {
			return $criteria;
		}
		$query = new FightsQuery();
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
	 * @return    Fights|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = FightsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(FightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Fights A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `ONEID`, `TWOID`, `ONEWINS`, `TWOWINS`, `ACTIVE` FROM `fights` WHERE `ID` = :p0';
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
			$obj = new Fights();
			$obj->hydrate($row);
			FightsPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Fights|array|mixed the result, formatted by the current formatter
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
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FightsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FightsPeer::ID, $keys, Criteria::IN);
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
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FightsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the oneID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOneid(1234); // WHERE oneID = 1234
	 * $query->filterByOneid(array(12, 34)); // WHERE oneID IN (12, 34)
	 * $query->filterByOneid(array('min' => 12)); // WHERE oneID > 12
	 * </code>
	 *
	 * @see       filterByNamesRelatedByOneid()
	 *
	 * @param     mixed $oneid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByOneid($oneid = null, $comparison = null)
	{
		if (is_array($oneid)) {
			$useMinMax = false;
			if (isset($oneid['min'])) {
				$this->addUsingAlias(FightsPeer::ONEID, $oneid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($oneid['max'])) {
				$this->addUsingAlias(FightsPeer::ONEID, $oneid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FightsPeer::ONEID, $oneid, $comparison);
	}

	/**
	 * Filter the query on the twoID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwoid(1234); // WHERE twoID = 1234
	 * $query->filterByTwoid(array(12, 34)); // WHERE twoID IN (12, 34)
	 * $query->filterByTwoid(array('min' => 12)); // WHERE twoID > 12
	 * </code>
	 *
	 * @see       filterByNamesRelatedByTwoid()
	 *
	 * @param     mixed $twoid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByTwoid($twoid = null, $comparison = null)
	{
		if (is_array($twoid)) {
			$useMinMax = false;
			if (isset($twoid['min'])) {
				$this->addUsingAlias(FightsPeer::TWOID, $twoid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twoid['max'])) {
				$this->addUsingAlias(FightsPeer::TWOID, $twoid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FightsPeer::TWOID, $twoid, $comparison);
	}

	/**
	 * Filter the query on the oneWins column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOnewins(1234); // WHERE oneWins = 1234
	 * $query->filterByOnewins(array(12, 34)); // WHERE oneWins IN (12, 34)
	 * $query->filterByOnewins(array('min' => 12)); // WHERE oneWins > 12
	 * </code>
	 *
	 * @param     mixed $onewins The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByOnewins($onewins = null, $comparison = null)
	{
		if (is_array($onewins)) {
			$useMinMax = false;
			if (isset($onewins['min'])) {
				$this->addUsingAlias(FightsPeer::ONEWINS, $onewins['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($onewins['max'])) {
				$this->addUsingAlias(FightsPeer::ONEWINS, $onewins['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FightsPeer::ONEWINS, $onewins, $comparison);
	}

	/**
	 * Filter the query on the twoWins column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwowins(1234); // WHERE twoWins = 1234
	 * $query->filterByTwowins(array(12, 34)); // WHERE twoWins IN (12, 34)
	 * $query->filterByTwowins(array('min' => 12)); // WHERE twoWins > 12
	 * </code>
	 *
	 * @param     mixed $twowins The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByTwowins($twowins = null, $comparison = null)
	{
		if (is_array($twowins)) {
			$useMinMax = false;
			if (isset($twowins['min'])) {
				$this->addUsingAlias(FightsPeer::TWOWINS, $twowins['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twowins['max'])) {
				$this->addUsingAlias(FightsPeer::TWOWINS, $twowins['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FightsPeer::TWOWINS, $twowins, $comparison);
	}

	/**
	 * Filter the query on the active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByActive(1234); // WHERE active = 1234
	 * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
	 * $query->filterByActive(array('min' => 12)); // WHERE active > 12
	 * </code>
	 *
	 * @param     mixed $active The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(FightsPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(FightsPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FightsPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query by a related Names object
	 *
	 * @param     Names|PropelCollection $names The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByNamesRelatedByOneid($names, $comparison = null)
	{
		if ($names instanceof Names) {
			return $this
				->addUsingAlias(FightsPeer::ONEID, $names->getId(), $comparison);
		} elseif ($names instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FightsPeer::ONEID, $names->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByNamesRelatedByOneid() only accepts arguments of type Names or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NamesRelatedByOneid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function joinNamesRelatedByOneid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NamesRelatedByOneid');

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
			$this->addJoinObject($join, 'NamesRelatedByOneid');
		}

		return $this;
	}

	/**
	 * Use the NamesRelatedByOneid relation Names object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery A secondary query class using the current class as primary query
	 */
	public function useNamesRelatedByOneidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinNamesRelatedByOneid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'NamesRelatedByOneid', 'NamesQuery');
	}

	/**
	 * Filter the query by a related Names object
	 *
	 * @param     Names|PropelCollection $names The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByNamesRelatedByTwoid($names, $comparison = null)
	{
		if ($names instanceof Names) {
			return $this
				->addUsingAlias(FightsPeer::TWOID, $names->getId(), $comparison);
		} elseif ($names instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FightsPeer::TWOID, $names->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByNamesRelatedByTwoid() only accepts arguments of type Names or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NamesRelatedByTwoid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function joinNamesRelatedByTwoid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NamesRelatedByTwoid');

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
			$this->addJoinObject($join, 'NamesRelatedByTwoid');
		}

		return $this;
	}

	/**
	 * Use the NamesRelatedByTwoid relation Names object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery A secondary query class using the current class as primary query
	 */
	public function useNamesRelatedByTwoidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinNamesRelatedByTwoid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'NamesRelatedByTwoid', 'NamesQuery');
	}

	/**
	 * Filter the query by a related Posts object
	 *
	 * @param     Posts $posts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByPosts($posts, $comparison = null)
	{
		if ($posts instanceof Posts) {
			return $this
				->addUsingAlias(FightsPeer::ID, $posts->getFightid(), $comparison);
		} elseif ($posts instanceof PropelCollection) {
			return $this
				->usePostsQuery()
				->filterByPrimaryKeys($posts->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPosts() only accepts arguments of type Posts or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Posts relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function joinPosts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Posts');

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
			$this->addJoinObject($join, 'Posts');
		}

		return $this;
	}

	/**
	 * Use the Posts relation Posts object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PostsQuery A secondary query class using the current class as primary query
	 */
	public function usePostsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinPosts($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Posts', 'PostsQuery');
	}

	/**
	 * Filter the query by a related TourneyFights object
	 *
	 * @param     TourneyFights $tourneyFights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyFights($tourneyFights, $comparison = null)
	{
		if ($tourneyFights instanceof TourneyFights) {
			return $this
				->addUsingAlias(FightsPeer::ID, $tourneyFights->getGeneralFightId(), $comparison);
		} elseif ($tourneyFights instanceof PropelCollection) {
			return $this
				->useTourneyFightsQuery()
				->filterByPrimaryKeys($tourneyFights->getPrimaryKeys())
				->endUse();
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
	 * @return    FightsQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     Fights $fights Object to remove from the list of results
	 *
	 * @return    FightsQuery The current query, for fluid interface
	 */
	public function prune($fights = null)
	{
		if ($fights) {
			$this->addUsingAlias(FightsPeer::ID, $fights->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseFightsQuery