<?php


/**
 * Base class that represents a query for the 'awaitingProfiles' table.
 *
 * Profiles associated with new users who have not yet confirmed their accounts
 *
 * @method     AwaitingprofilesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AwaitingprofilesQuery orderByEmailaddress($order = Criteria::ASC) Order by the emailAddress column
 *
 * @method     AwaitingprofilesQuery groupById() Group by the id column
 * @method     AwaitingprofilesQuery groupByEmailaddress() Group by the emailAddress column
 *
 * @method     AwaitingprofilesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AwaitingprofilesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AwaitingprofilesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AwaitingprofilesQuery leftJoinAwaitingconfirmation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Awaitingconfirmation relation
 * @method     AwaitingprofilesQuery rightJoinAwaitingconfirmation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Awaitingconfirmation relation
 * @method     AwaitingprofilesQuery innerJoinAwaitingconfirmation($relationAlias = null) Adds a INNER JOIN clause to the query using the Awaitingconfirmation relation
 *
 * @method     Awaitingprofiles findOne(PropelPDO $con = null) Return the first Awaitingprofiles matching the query
 * @method     Awaitingprofiles findOneOrCreate(PropelPDO $con = null) Return the first Awaitingprofiles matching the query, or a new Awaitingprofiles object populated from the query conditions when no match is found
 *
 * @method     Awaitingprofiles findOneById(int $id) Return the first Awaitingprofiles filtered by the id column
 * @method     Awaitingprofiles findOneByEmailaddress(string $emailAddress) Return the first Awaitingprofiles filtered by the emailAddress column
 *
 * @method     array findById(int $id) Return Awaitingprofiles objects filtered by the id column
 * @method     array findByEmailaddress(string $emailAddress) Return Awaitingprofiles objects filtered by the emailAddress column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseAwaitingprofilesQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAwaitingprofilesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Awaitingprofiles', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AwaitingprofilesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AwaitingprofilesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AwaitingprofilesQuery) {
			return $criteria;
		}
		$query = new AwaitingprofilesQuery();
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
	 * @return    Awaitingprofiles|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AwaitingprofilesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AwaitingprofilesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Awaitingprofiles A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `EMAILADDRESS` FROM `awaitingProfiles` WHERE `ID` = :p0';
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
			$obj = new Awaitingprofiles();
			$obj->hydrate($row);
			AwaitingprofilesPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Awaitingprofiles|array|mixed the result, formatted by the current formatter
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
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AwaitingprofilesPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AwaitingprofilesPeer::ID, $keys, Criteria::IN);
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
	 * @see       filterByAwaitingconfirmation()
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AwaitingprofilesPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the emailAddress column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEmailaddress('fooValue');   // WHERE emailAddress = 'fooValue'
	 * $query->filterByEmailaddress('%fooValue%'); // WHERE emailAddress LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $emailaddress The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function filterByEmailaddress($emailaddress = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($emailaddress)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $emailaddress)) {
				$emailaddress = str_replace('*', '%', $emailaddress);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AwaitingprofilesPeer::EMAILADDRESS, $emailaddress, $comparison);
	}

	/**
	 * Filter the query by a related Awaitingconfirmation object
	 *
	 * @param     Awaitingconfirmation|PropelCollection $awaitingconfirmation The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function filterByAwaitingconfirmation($awaitingconfirmation, $comparison = null)
	{
		if ($awaitingconfirmation instanceof Awaitingconfirmation) {
			return $this
				->addUsingAlias(AwaitingprofilesPeer::ID, $awaitingconfirmation->getId(), $comparison);
		} elseif ($awaitingconfirmation instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AwaitingprofilesPeer::ID, $awaitingconfirmation->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByAwaitingconfirmation() only accepts arguments of type Awaitingconfirmation or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Awaitingconfirmation relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function joinAwaitingconfirmation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Awaitingconfirmation');

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
			$this->addJoinObject($join, 'Awaitingconfirmation');
		}

		return $this;
	}

	/**
	 * Use the Awaitingconfirmation relation Awaitingconfirmation object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AwaitingconfirmationQuery A secondary query class using the current class as primary query
	 */
	public function useAwaitingconfirmationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAwaitingconfirmation($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Awaitingconfirmation', 'AwaitingconfirmationQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Awaitingprofiles $awaitingprofiles Object to remove from the list of results
	 *
	 * @return    AwaitingprofilesQuery The current query, for fluid interface
	 */
	public function prune($awaitingprofiles = null)
	{
		if ($awaitingprofiles) {
			$this->addUsingAlias(AwaitingprofilesPeer::ID, $awaitingprofiles->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAwaitingprofilesQuery