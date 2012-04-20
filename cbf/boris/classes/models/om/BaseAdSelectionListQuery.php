<?php


/**
 * Base class that represents a query for the 'ad_selection_list' table.
 *
 * List used when randomly selecting an ad
 *
 * @method     AdSelectionListQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AdSelectionListQuery orderByAdId($order = Criteria::ASC) Order by the ad_id column
 *
 * @method     AdSelectionListQuery groupById() Group by the id column
 * @method     AdSelectionListQuery groupByAdId() Group by the ad_id column
 *
 * @method     AdSelectionListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AdSelectionListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AdSelectionListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AdSelectionListQuery leftJoinAd($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ad relation
 * @method     AdSelectionListQuery rightJoinAd($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ad relation
 * @method     AdSelectionListQuery innerJoinAd($relationAlias = null) Adds a INNER JOIN clause to the query using the Ad relation
 *
 * @method     AdSelectionList findOne(PropelPDO $con = null) Return the first AdSelectionList matching the query
 * @method     AdSelectionList findOneOrCreate(PropelPDO $con = null) Return the first AdSelectionList matching the query, or a new AdSelectionList object populated from the query conditions when no match is found
 *
 * @method     AdSelectionList findOneById(int $id) Return the first AdSelectionList filtered by the id column
 * @method     AdSelectionList findOneByAdId(int $ad_id) Return the first AdSelectionList filtered by the ad_id column
 *
 * @method     array findById(int $id) Return AdSelectionList objects filtered by the id column
 * @method     array findByAdId(int $ad_id) Return AdSelectionList objects filtered by the ad_id column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseAdSelectionListQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAdSelectionListQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'AdSelectionList', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AdSelectionListQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AdSelectionListQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AdSelectionListQuery) {
			return $criteria;
		}
		$query = new AdSelectionListQuery();
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
	 * @return    AdSelectionList|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AdSelectionListPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AdSelectionListPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    AdSelectionList A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `AD_ID` FROM `ad_selection_list` WHERE `ID` = :p0';
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
			$obj = new AdSelectionList();
			$obj->hydrate($row);
			AdSelectionListPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    AdSelectionList|array|mixed the result, formatted by the current formatter
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
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AdSelectionListPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AdSelectionListPeer::ID, $keys, Criteria::IN);
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
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AdSelectionListPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the ad_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdId(1234); // WHERE ad_id = 1234
	 * $query->filterByAdId(array(12, 34)); // WHERE ad_id IN (12, 34)
	 * $query->filterByAdId(array('min' => 12)); // WHERE ad_id > 12
	 * </code>
	 *
	 * @see       filterByAd()
	 *
	 * @param     mixed $adId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function filterByAdId($adId = null, $comparison = null)
	{
		if (is_array($adId)) {
			$useMinMax = false;
			if (isset($adId['min'])) {
				$this->addUsingAlias(AdSelectionListPeer::AD_ID, $adId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adId['max'])) {
				$this->addUsingAlias(AdSelectionListPeer::AD_ID, $adId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdSelectionListPeer::AD_ID, $adId, $comparison);
	}

	/**
	 * Filter the query by a related Ad object
	 *
	 * @param     Ad|PropelCollection $ad The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function filterByAd($ad, $comparison = null)
	{
		if ($ad instanceof Ad) {
			return $this
				->addUsingAlias(AdSelectionListPeer::AD_ID, $ad->getId(), $comparison);
		} elseif ($ad instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AdSelectionListPeer::AD_ID, $ad->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByAd() only accepts arguments of type Ad or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Ad relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function joinAd($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Ad');

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
			$this->addJoinObject($join, 'Ad');
		}

		return $this;
	}

	/**
	 * Use the Ad relation Ad object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AdQuery A secondary query class using the current class as primary query
	 */
	public function useAdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAd($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Ad', 'AdQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     AdSelectionList $adSelectionList Object to remove from the list of results
	 *
	 * @return    AdSelectionListQuery The current query, for fluid interface
	 */
	public function prune($adSelectionList = null)
	{
		if ($adSelectionList) {
			$this->addUsingAlias(AdSelectionListPeer::ID, $adSelectionList->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAdSelectionListQuery