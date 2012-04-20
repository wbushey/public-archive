<?php


/**
 * Base class that represents a query for the 'bannedEmails' table.
 *
 * Email addresses that have been banned from using the site
 *
 * @method     BannedemailsQuery orderByEmailaddress($order = Criteria::ASC) Order by the emailAddress column
 * @method     BannedemailsQuery orderByTtd($order = Criteria::ASC) Order by the ttd column
 *
 * @method     BannedemailsQuery groupByEmailaddress() Group by the emailAddress column
 * @method     BannedemailsQuery groupByTtd() Group by the ttd column
 *
 * @method     BannedemailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BannedemailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BannedemailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Bannedemails findOne(PropelPDO $con = null) Return the first Bannedemails matching the query
 * @method     Bannedemails findOneOrCreate(PropelPDO $con = null) Return the first Bannedemails matching the query, or a new Bannedemails object populated from the query conditions when no match is found
 *
 * @method     Bannedemails findOneByEmailaddress(string $emailAddress) Return the first Bannedemails filtered by the emailAddress column
 * @method     Bannedemails findOneByTtd(string $ttd) Return the first Bannedemails filtered by the ttd column
 *
 * @method     array findByEmailaddress(string $emailAddress) Return Bannedemails objects filtered by the emailAddress column
 * @method     array findByTtd(string $ttd) Return Bannedemails objects filtered by the ttd column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseBannedemailsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBannedemailsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Bannedemails', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BannedemailsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BannedemailsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BannedemailsQuery) {
			return $criteria;
		}
		$query = new BannedemailsQuery();
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
	 * @return    Bannedemails|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BannedemailsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BannedemailsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Bannedemails A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `EMAILADDRESS`, `TTD` FROM `bannedEmails` WHERE `EMAILADDRESS` = :p0';
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
			$obj = new Bannedemails();
			$obj->hydrate($row);
			BannedemailsPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Bannedemails|array|mixed the result, formatted by the current formatter
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
	 * @return    BannedemailsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BannedemailsPeer::EMAILADDRESS, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BannedemailsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BannedemailsPeer::EMAILADDRESS, $keys, Criteria::IN);
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
	 * @return    BannedemailsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BannedemailsPeer::EMAILADDRESS, $emailaddress, $comparison);
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
	 * @return    BannedemailsQuery The current query, for fluid interface
	 */
	public function filterByTtd($ttd = null, $comparison = null)
	{
		if (is_array($ttd)) {
			$useMinMax = false;
			if (isset($ttd['min'])) {
				$this->addUsingAlias(BannedemailsPeer::TTD, $ttd['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ttd['max'])) {
				$this->addUsingAlias(BannedemailsPeer::TTD, $ttd['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannedemailsPeer::TTD, $ttd, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Bannedemails $bannedemails Object to remove from the list of results
	 *
	 * @return    BannedemailsQuery The current query, for fluid interface
	 */
	public function prune($bannedemails = null)
	{
		if ($bannedemails) {
			$this->addUsingAlias(BannedemailsPeer::EMAILADDRESS, $bannedemails->getEmailaddress(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseBannedemailsQuery