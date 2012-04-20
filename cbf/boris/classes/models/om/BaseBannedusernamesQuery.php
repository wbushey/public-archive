<?php


/**
 * Base class that represents a query for the 'bannedUsernames' table.
 *
 * Usernames that have banned from using the site
 *
 * @method     BannedusernamesQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     BannedusernamesQuery orderByTtd($order = Criteria::ASC) Order by the ttd column
 *
 * @method     BannedusernamesQuery groupByUsername() Group by the username column
 * @method     BannedusernamesQuery groupByTtd() Group by the ttd column
 *
 * @method     BannedusernamesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BannedusernamesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BannedusernamesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Bannedusernames findOne(PropelPDO $con = null) Return the first Bannedusernames matching the query
 * @method     Bannedusernames findOneOrCreate(PropelPDO $con = null) Return the first Bannedusernames matching the query, or a new Bannedusernames object populated from the query conditions when no match is found
 *
 * @method     Bannedusernames findOneByUsername(string $username) Return the first Bannedusernames filtered by the username column
 * @method     Bannedusernames findOneByTtd(string $ttd) Return the first Bannedusernames filtered by the ttd column
 *
 * @method     array findByUsername(string $username) Return Bannedusernames objects filtered by the username column
 * @method     array findByTtd(string $ttd) Return Bannedusernames objects filtered by the ttd column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseBannedusernamesQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBannedusernamesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Bannedusernames', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BannedusernamesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BannedusernamesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BannedusernamesQuery) {
			return $criteria;
		}
		$query = new BannedusernamesQuery();
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
	 * @return    Bannedusernames|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BannedusernamesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BannedusernamesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Bannedusernames A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `USERNAME`, `TTD` FROM `bannedUsernames` WHERE `USERNAME` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Bannedusernames();
			$obj->hydrate($row);
			BannedusernamesPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Bannedusernames|array|mixed the result, formatted by the current formatter
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
	 * @return    BannedusernamesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BannedusernamesPeer::USERNAME, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BannedusernamesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BannedusernamesPeer::USERNAME, $keys, Criteria::IN);
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
	 * @return    BannedusernamesQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BannedusernamesPeer::USERNAME, $username, $comparison);
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
	 * @return    BannedusernamesQuery The current query, for fluid interface
	 */
	public function filterByTtd($ttd = null, $comparison = null)
	{
		if (is_array($ttd)) {
			$useMinMax = false;
			if (isset($ttd['min'])) {
				$this->addUsingAlias(BannedusernamesPeer::TTD, $ttd['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ttd['max'])) {
				$this->addUsingAlias(BannedusernamesPeer::TTD, $ttd['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannedusernamesPeer::TTD, $ttd, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Bannedusernames $bannedusernames Object to remove from the list of results
	 *
	 * @return    BannedusernamesQuery The current query, for fluid interface
	 */
	public function prune($bannedusernames = null)
	{
		if ($bannedusernames) {
			$this->addUsingAlias(BannedusernamesPeer::USERNAME, $bannedusernames->getUsername(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBannedusernamesQuery