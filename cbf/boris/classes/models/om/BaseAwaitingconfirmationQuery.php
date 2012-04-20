<?php


/**
 * Base class that represents a query for the 'awaitingConfirmation' table.
 *
 * New users who have not yet confirmed their accounts
 *
 * @method     AwaitingconfirmationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AwaitingconfirmationQuery orderByConfirmnum($order = Criteria::ASC) Order by the confirmNum column
 * @method     AwaitingconfirmationQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     AwaitingconfirmationQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     AwaitingconfirmationQuery orderByTtd($order = Criteria::ASC) Order by the ttd column
 *
 * @method     AwaitingconfirmationQuery groupById() Group by the id column
 * @method     AwaitingconfirmationQuery groupByConfirmnum() Group by the confirmNum column
 * @method     AwaitingconfirmationQuery groupByUsername() Group by the username column
 * @method     AwaitingconfirmationQuery groupByPassword() Group by the password column
 * @method     AwaitingconfirmationQuery groupByTtd() Group by the ttd column
 *
 * @method     AwaitingconfirmationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AwaitingconfirmationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AwaitingconfirmationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AwaitingconfirmationQuery leftJoinAwaitingprofiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Awaitingprofiles relation
 * @method     AwaitingconfirmationQuery rightJoinAwaitingprofiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Awaitingprofiles relation
 * @method     AwaitingconfirmationQuery innerJoinAwaitingprofiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Awaitingprofiles relation
 *
 * @method     Awaitingconfirmation findOne(PropelPDO $con = null) Return the first Awaitingconfirmation matching the query
 * @method     Awaitingconfirmation findOneOrCreate(PropelPDO $con = null) Return the first Awaitingconfirmation matching the query, or a new Awaitingconfirmation object populated from the query conditions when no match is found
 *
 * @method     Awaitingconfirmation findOneById(int $id) Return the first Awaitingconfirmation filtered by the id column
 * @method     Awaitingconfirmation findOneByConfirmnum(string $confirmNum) Return the first Awaitingconfirmation filtered by the confirmNum column
 * @method     Awaitingconfirmation findOneByUsername(string $username) Return the first Awaitingconfirmation filtered by the username column
 * @method     Awaitingconfirmation findOneByPassword(string $password) Return the first Awaitingconfirmation filtered by the password column
 * @method     Awaitingconfirmation findOneByTtd(string $ttd) Return the first Awaitingconfirmation filtered by the ttd column
 *
 * @method     array findById(int $id) Return Awaitingconfirmation objects filtered by the id column
 * @method     array findByConfirmnum(string $confirmNum) Return Awaitingconfirmation objects filtered by the confirmNum column
 * @method     array findByUsername(string $username) Return Awaitingconfirmation objects filtered by the username column
 * @method     array findByPassword(string $password) Return Awaitingconfirmation objects filtered by the password column
 * @method     array findByTtd(string $ttd) Return Awaitingconfirmation objects filtered by the ttd column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseAwaitingconfirmationQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAwaitingconfirmationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Awaitingconfirmation', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AwaitingconfirmationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AwaitingconfirmationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AwaitingconfirmationQuery) {
			return $criteria;
		}
		$query = new AwaitingconfirmationQuery();
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
	 * @return    Awaitingconfirmation|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AwaitingconfirmationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AwaitingconfirmationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Awaitingconfirmation A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `CONFIRMNUM`, `USERNAME`, `PASSWORD`, `TTD` FROM `awaitingConfirmation` WHERE `ID` = :p0';
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
			$obj = new Awaitingconfirmation();
			$obj->hydrate($row);
			AwaitingconfirmationPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Awaitingconfirmation|array|mixed the result, formatted by the current formatter
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
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AwaitingconfirmationPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AwaitingconfirmationPeer::ID, $keys, Criteria::IN);
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
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AwaitingconfirmationPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the confirmNum column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByConfirmnum('fooValue');   // WHERE confirmNum = 'fooValue'
	 * $query->filterByConfirmnum('%fooValue%'); // WHERE confirmNum LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $confirmnum The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByConfirmnum($confirmnum = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($confirmnum)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $confirmnum)) {
				$confirmnum = str_replace('*', '%', $confirmnum);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AwaitingconfirmationPeer::CONFIRMNUM, $confirmnum, $comparison);
	}

	/**
	 * Filter the query on the username column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
	 * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $username The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByUsername($username = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($username)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $username)) {
				$username = str_replace('*', '%', $username);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AwaitingconfirmationPeer::USERNAME, $username, $comparison);
	}

	/**
	 * Filter the query on the password column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
	 * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $password The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByPassword($password = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($password)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $password)) {
				$password = str_replace('*', '%', $password);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AwaitingconfirmationPeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query on the ttd column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTtd('2011-03-14'); // WHERE ttd = '2011-03-14'
	 * $query->filterByTtd('now'); // WHERE ttd = '2011-03-14'
	 * $query->filterByTtd(array('max' => 'yesterday')); // WHERE ttd > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $ttd The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByTtd($ttd = null, $comparison = null)
	{
		if (is_array($ttd)) {
			$useMinMax = false;
			if (isset($ttd['min'])) {
				$this->addUsingAlias(AwaitingconfirmationPeer::TTD, $ttd['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ttd['max'])) {
				$this->addUsingAlias(AwaitingconfirmationPeer::TTD, $ttd['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AwaitingconfirmationPeer::TTD, $ttd, $comparison);
	}

	/**
	 * Filter the query by a related Awaitingprofiles object
	 *
	 * @param     Awaitingprofiles $awaitingprofiles  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function filterByAwaitingprofiles($awaitingprofiles, $comparison = null)
	{
		if ($awaitingprofiles instanceof Awaitingprofiles) {
			return $this
				->addUsingAlias(AwaitingconfirmationPeer::ID, $awaitingprofiles->getId(), $comparison);
		} elseif ($awaitingprofiles instanceof PropelCollection) {
			return $this
				->useAwaitingprofilesQuery()
				->filterByPrimaryKeys($awaitingprofiles->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAwaitingprofiles() only accepts arguments of type Awaitingprofiles or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Awaitingprofiles relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function joinAwaitingprofiles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Awaitingprofiles');

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
			$this->addJoinObject($join, 'Awaitingprofiles');
		}

		return $this;
	}

	/**
	 * Use the Awaitingprofiles relation Awaitingprofiles object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AwaitingprofilesQuery A secondary query class using the current class as primary query
	 */
	public function useAwaitingprofilesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAwaitingprofiles($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Awaitingprofiles', 'AwaitingprofilesQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Awaitingconfirmation $awaitingconfirmation Object to remove from the list of results
	 *
	 * @return    AwaitingconfirmationQuery The current query, for fluid interface
	 */
	public function prune($awaitingconfirmation = null)
	{
		if ($awaitingconfirmation) {
			$this->addUsingAlias(AwaitingconfirmationPeer::ID, $awaitingconfirmation->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAwaitingconfirmationQuery