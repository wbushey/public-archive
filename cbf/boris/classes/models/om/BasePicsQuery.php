<?php


/**
 * Base class that represents a query for the 'pics' table.
 *
 * Pictures of celebrities
 *
 * @method     PicsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PicsQuery orderByPic($order = Criteria::ASC) Order by the pic column
 *
 * @method     PicsQuery groupById() Group by the id column
 * @method     PicsQuery groupByPic() Group by the pic column
 *
 * @method     PicsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PicsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PicsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PicsQuery leftJoinNames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Names relation
 * @method     PicsQuery rightJoinNames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Names relation
 * @method     PicsQuery innerJoinNames($relationAlias = null) Adds a INNER JOIN clause to the query using the Names relation
 *
 * @method     Pics findOne(PropelPDO $con = null) Return the first Pics matching the query
 * @method     Pics findOneOrCreate(PropelPDO $con = null) Return the first Pics matching the query, or a new Pics object populated from the query conditions when no match is found
 *
 * @method     Pics findOneById(int $id) Return the first Pics filtered by the id column
 * @method     Pics findOneByPic(string $pic) Return the first Pics filtered by the pic column
 *
 * @method     array findById(int $id) Return Pics objects filtered by the id column
 * @method     array findByPic(string $pic) Return Pics objects filtered by the pic column
 *
 * @package    propel.generator.models.om
 */
abstract class BasePicsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePicsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Pics', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PicsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PicsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PicsQuery) {
			return $criteria;
		}
		$query = new PicsQuery();
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
	 * @param     array[$id, $pic] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Pics|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PicsPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PicsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Pics A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `PIC` FROM `pics` WHERE `ID` = :p0 AND `PIC` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Pics();
			$obj->hydrate($row);
			PicsPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    Pics|array|mixed the result, formatted by the current formatter
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
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(PicsPeer::ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(PicsPeer::PIC, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(PicsPeer::ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(PicsPeer::PIC, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
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
	 * @see       filterByNames()
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PicsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the pic column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPic('fooValue');   // WHERE pic = 'fooValue'
	 * $query->filterByPic('%fooValue%'); // WHERE pic LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pic The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function filterByPic($pic = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pic)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pic)) {
				$pic = str_replace('*', '%', $pic);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PicsPeer::PIC, $pic, $comparison);
	}

	/**
	 * Filter the query by a related Names object
	 *
	 * @param     Names|PropelCollection $names The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function filterByNames($names, $comparison = null)
	{
		if ($names instanceof Names) {
			return $this
				->addUsingAlias(PicsPeer::ID, $names->getId(), $comparison);
		} elseif ($names instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PicsPeer::ID, $names->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    PicsQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     Pics $pics Object to remove from the list of results
	 *
	 * @return    PicsQuery The current query, for fluid interface
	 */
	public function prune($pics = null)
	{
		if ($pics) {
			$this->addCond('pruneCond0', $this->getAliasedColName(PicsPeer::ID), $pics->getId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(PicsPeer::PIC), $pics->getPic(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BasePicsQuery