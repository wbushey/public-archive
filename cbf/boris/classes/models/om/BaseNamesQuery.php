<?php


/**
 * Base class that represents a query for the 'names' table.
 *
 * Names of celebrities
 *
 * @method     NamesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     NamesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     NamesQuery orderByReference($order = Criteria::ASC) Order by the reference column
 *
 * @method     NamesQuery groupById() Group by the id column
 * @method     NamesQuery groupByName() Group by the name column
 * @method     NamesQuery groupByReference() Group by the reference column
 *
 * @method     NamesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     NamesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     NamesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     NamesQuery leftJoinPics($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pics relation
 * @method     NamesQuery rightJoinPics($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pics relation
 * @method     NamesQuery innerJoinPics($relationAlias = null) Adds a INNER JOIN clause to the query using the Pics relation
 *
 * @method     NamesQuery leftJoinFightsRelatedByOneid($relationAlias = null) Adds a LEFT JOIN clause to the query using the FightsRelatedByOneid relation
 * @method     NamesQuery rightJoinFightsRelatedByOneid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FightsRelatedByOneid relation
 * @method     NamesQuery innerJoinFightsRelatedByOneid($relationAlias = null) Adds a INNER JOIN clause to the query using the FightsRelatedByOneid relation
 *
 * @method     NamesQuery leftJoinFightsRelatedByTwoid($relationAlias = null) Adds a LEFT JOIN clause to the query using the FightsRelatedByTwoid relation
 * @method     NamesQuery rightJoinFightsRelatedByTwoid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FightsRelatedByTwoid relation
 * @method     NamesQuery innerJoinFightsRelatedByTwoid($relationAlias = null) Adds a INNER JOIN clause to the query using the FightsRelatedByTwoid relation
 *
 * @method     NamesQuery leftJoinTourneyFighters($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFighters relation
 * @method     NamesQuery rightJoinTourneyFighters($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFighters relation
 * @method     NamesQuery innerJoinTourneyFighters($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFighters relation
 *
 * @method     Names findOne(PropelPDO $con = null) Return the first Names matching the query
 * @method     Names findOneOrCreate(PropelPDO $con = null) Return the first Names matching the query, or a new Names object populated from the query conditions when no match is found
 *
 * @method     Names findOneById(int $id) Return the first Names filtered by the id column
 * @method     Names findOneByName(string $name) Return the first Names filtered by the name column
 * @method     Names findOneByReference(string $reference) Return the first Names filtered by the reference column
 *
 * @method     array findById(int $id) Return Names objects filtered by the id column
 * @method     array findByName(string $name) Return Names objects filtered by the name column
 * @method     array findByReference(string $reference) Return Names objects filtered by the reference column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseNamesQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseNamesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Names', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new NamesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    NamesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof NamesQuery) {
			return $criteria;
		}
		$query = new NamesQuery();
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
	 * @return    Names|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = NamesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(NamesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Names A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `REFERENCE` FROM `names` WHERE `ID` = :p0';
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
			$obj = new Names();
			$obj->hydrate($row);
			NamesPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Names|array|mixed the result, formatted by the current formatter
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
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(NamesPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(NamesPeer::ID, $keys, Criteria::IN);
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
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(NamesPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(NamesPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the reference column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByReference('fooValue');   // WHERE reference = 'fooValue'
	 * $query->filterByReference('%fooValue%'); // WHERE reference LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $reference The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByReference($reference = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($reference)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $reference)) {
				$reference = str_replace('*', '%', $reference);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(NamesPeer::REFERENCE, $reference, $comparison);
	}

	/**
	 * Filter the query by a related Pics object
	 *
	 * @param     Pics $pics  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByPics($pics, $comparison = null)
	{
		if ($pics instanceof Pics) {
			return $this
				->addUsingAlias(NamesPeer::ID, $pics->getId(), $comparison);
		} elseif ($pics instanceof PropelCollection) {
			return $this
				->usePicsQuery()
				->filterByPrimaryKeys($pics->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPics() only accepts arguments of type Pics or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Pics relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function joinPics($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Pics');

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
			$this->addJoinObject($join, 'Pics');
		}

		return $this;
	}

	/**
	 * Use the Pics relation Pics object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PicsQuery A secondary query class using the current class as primary query
	 */
	public function usePicsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinPics($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Pics', 'PicsQuery');
	}

	/**
	 * Filter the query by a related Fights object
	 *
	 * @param     Fights $fights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByFightsRelatedByOneid($fights, $comparison = null)
	{
		if ($fights instanceof Fights) {
			return $this
				->addUsingAlias(NamesPeer::ID, $fights->getOneid(), $comparison);
		} elseif ($fights instanceof PropelCollection) {
			return $this
				->useFightsRelatedByOneidQuery()
				->filterByPrimaryKeys($fights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByFightsRelatedByOneid() only accepts arguments of type Fights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FightsRelatedByOneid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function joinFightsRelatedByOneid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FightsRelatedByOneid');

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
			$this->addJoinObject($join, 'FightsRelatedByOneid');
		}

		return $this;
	}

	/**
	 * Use the FightsRelatedByOneid relation Fights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery A secondary query class using the current class as primary query
	 */
	public function useFightsRelatedByOneidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFightsRelatedByOneid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FightsRelatedByOneid', 'FightsQuery');
	}

	/**
	 * Filter the query by a related Fights object
	 *
	 * @param     Fights $fights  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByFightsRelatedByTwoid($fights, $comparison = null)
	{
		if ($fights instanceof Fights) {
			return $this
				->addUsingAlias(NamesPeer::ID, $fights->getTwoid(), $comparison);
		} elseif ($fights instanceof PropelCollection) {
			return $this
				->useFightsRelatedByTwoidQuery()
				->filterByPrimaryKeys($fights->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByFightsRelatedByTwoid() only accepts arguments of type Fights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FightsRelatedByTwoid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function joinFightsRelatedByTwoid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FightsRelatedByTwoid');

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
			$this->addJoinObject($join, 'FightsRelatedByTwoid');
		}

		return $this;
	}

	/**
	 * Use the FightsRelatedByTwoid relation Fights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery A secondary query class using the current class as primary query
	 */
	public function useFightsRelatedByTwoidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFightsRelatedByTwoid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FightsRelatedByTwoid', 'FightsQuery');
	}

	/**
	 * Filter the query by a related TourneyFighters object
	 *
	 * @param     TourneyFighters $tourneyFighters  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function filterByTourneyFighters($tourneyFighters, $comparison = null)
	{
		if ($tourneyFighters instanceof TourneyFighters) {
			return $this
				->addUsingAlias(NamesPeer::ID, $tourneyFighters->getFighterId(), $comparison);
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
	 * @return    NamesQuery The current query, for fluid interface
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
	 * @param     Names $names Object to remove from the list of results
	 *
	 * @return    NamesQuery The current query, for fluid interface
	 */
	public function prune($names = null)
	{
		if ($names) {
			$this->addUsingAlias(NamesPeer::ID, $names->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseNamesQuery