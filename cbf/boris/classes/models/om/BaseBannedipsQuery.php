<?php


/**
 * Base class that represents a query for the 'bannedIPs' table.
 *
 * IP addresses that have been banned from using the site
 *
 * @method     BannedipsQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     BannedipsQuery orderByShift($order = Criteria::ASC) Order by the shift column
 * @method     BannedipsQuery orderByTtd($order = Criteria::ASC) Order by the ttd column
 *
 * @method     BannedipsQuery groupByIp() Group by the ip column
 * @method     BannedipsQuery groupByShift() Group by the shift column
 * @method     BannedipsQuery groupByTtd() Group by the ttd column
 *
 * @method     BannedipsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BannedipsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BannedipsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Bannedips findOne(PropelPDO $con = null) Return the first Bannedips matching the query
 * @method     Bannedips findOneOrCreate(PropelPDO $con = null) Return the first Bannedips matching the query, or a new Bannedips object populated from the query conditions when no match is found
 *
 * @method     Bannedips findOneByIp(int $ip) Return the first Bannedips filtered by the ip column
 * @method     Bannedips findOneByShift(int $shift) Return the first Bannedips filtered by the shift column
 * @method     Bannedips findOneByTtd(string $ttd) Return the first Bannedips filtered by the ttd column
 *
 * @method     array findByIp(int $ip) Return Bannedips objects filtered by the ip column
 * @method     array findByShift(int $shift) Return Bannedips objects filtered by the shift column
 * @method     array findByTtd(string $ttd) Return Bannedips objects filtered by the ttd column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseBannedipsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBannedipsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Bannedips', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BannedipsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BannedipsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BannedipsQuery) {
			return $criteria;
		}
		$query = new BannedipsQuery();
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
	 * @param     array[$ip, $shift] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Bannedips|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BannedipsPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BannedipsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Bannedips A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `IP`, `SHIFT`, `TTD` FROM `bannedIPs` WHERE `IP` = :p0 AND `SHIFT` = :p1';
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
			$obj = new Bannedips();
			$obj->hydrate($row);
			BannedipsPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    Bannedips|array|mixed the result, formatted by the current formatter
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
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(BannedipsPeer::IP, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(BannedipsPeer::SHIFT, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(BannedipsPeer::IP, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(BannedipsPeer::SHIFT, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the ip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIp(1234); // WHERE ip = 1234
	 * $query->filterByIp(array(12, 34)); // WHERE ip IN (12, 34)
	 * $query->filterByIp(array('min' => 12)); // WHERE ip > 12
	 * </code>
	 *
	 * @param     mixed $ip The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function filterByIp($ip = null, $comparison = null)
	{
		if (is_array($ip) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BannedipsPeer::IP, $ip, $comparison);
	}

	/**
	 * Filter the query on the shift column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByShift(1234); // WHERE shift = 1234
	 * $query->filterByShift(array(12, 34)); // WHERE shift IN (12, 34)
	 * $query->filterByShift(array('min' => 12)); // WHERE shift > 12
	 * </code>
	 *
	 * @param     mixed $shift The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function filterByShift($shift = null, $comparison = null)
	{
		if (is_array($shift)) {
			$useMinMax = false;
			if (isset($shift['min'])) {
				$this->addUsingAlias(BannedipsPeer::SHIFT, $shift['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shift['max'])) {
				$this->addUsingAlias(BannedipsPeer::SHIFT, $shift['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannedipsPeer::SHIFT, $shift, $comparison);
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
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function filterByTtd($ttd = null, $comparison = null)
	{
		if (is_array($ttd)) {
			$useMinMax = false;
			if (isset($ttd['min'])) {
				$this->addUsingAlias(BannedipsPeer::TTD, $ttd['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ttd['max'])) {
				$this->addUsingAlias(BannedipsPeer::TTD, $ttd['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BannedipsPeer::TTD, $ttd, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Bannedips $bannedips Object to remove from the list of results
	 *
	 * @return    BannedipsQuery The current query, for fluid interface
	 */
	public function prune($bannedips = null)
	{
		if ($bannedips) {
			$this->addCond('pruneCond0', $this->getAliasedColName(BannedipsPeer::IP), $bannedips->getIp(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(BannedipsPeer::SHIFT), $bannedips->getShift(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseBannedipsQuery