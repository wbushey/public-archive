<?php


/**
 * Base class that represents a query for the 'ad' table.
 *
 * Ad codes
 *
 * @method     AdQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AdQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     AdQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     AdQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method     AdQuery orderByImageId($order = Criteria::ASC) Order by the image_id column
 * @method     AdQuery orderByCode($order = Criteria::ASC) Order by the code column
 *
 * @method     AdQuery groupById() Group by the id column
 * @method     AdQuery groupByName() Group by the name column
 * @method     AdQuery groupByPosition() Group by the position column
 * @method     AdQuery groupByDateAdded() Group by the date_added column
 * @method     AdQuery groupByImageId() Group by the image_id column
 * @method     AdQuery groupByCode() Group by the code column
 *
 * @method     AdQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AdQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AdQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AdQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method     AdQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method     AdQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method     AdQuery leftJoinAdSelectionList($relationAlias = null) Adds a LEFT JOIN clause to the query using the AdSelectionList relation
 * @method     AdQuery rightJoinAdSelectionList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AdSelectionList relation
 * @method     AdQuery innerJoinAdSelectionList($relationAlias = null) Adds a INNER JOIN clause to the query using the AdSelectionList relation
 *
 * @method     Ad findOne(PropelPDO $con = null) Return the first Ad matching the query
 * @method     Ad findOneOrCreate(PropelPDO $con = null) Return the first Ad matching the query, or a new Ad object populated from the query conditions when no match is found
 *
 * @method     Ad findOneById(int $id) Return the first Ad filtered by the id column
 * @method     Ad findOneByName(string $name) Return the first Ad filtered by the name column
 * @method     Ad findOneByPosition(int $position) Return the first Ad filtered by the position column
 * @method     Ad findOneByDateAdded(string $date_added) Return the first Ad filtered by the date_added column
 * @method     Ad findOneByImageId(int $image_id) Return the first Ad filtered by the image_id column
 * @method     Ad findOneByCode(string $code) Return the first Ad filtered by the code column
 *
 * @method     array findById(int $id) Return Ad objects filtered by the id column
 * @method     array findByName(string $name) Return Ad objects filtered by the name column
 * @method     array findByPosition(int $position) Return Ad objects filtered by the position column
 * @method     array findByDateAdded(string $date_added) Return Ad objects filtered by the date_added column
 * @method     array findByImageId(int $image_id) Return Ad objects filtered by the image_id column
 * @method     array findByCode(string $code) Return Ad objects filtered by the code column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseAdQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAdQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Ad', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AdQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AdQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AdQuery) {
			return $criteria;
		}
		$query = new AdQuery();
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
	 * @return    Ad|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AdPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Ad A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `POSITION`, `DATE_ADDED`, `IMAGE_ID`, `CODE` FROM `ad` WHERE `ID` = :p0';
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
			$obj = new Ad();
			$obj->hydrate($row);
			AdPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Ad|array|mixed the result, formatted by the current formatter
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
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AdPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AdPeer::ID, $keys, Criteria::IN);
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
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AdPeer::ID, $id, $comparison);
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
	 * @return    AdQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AdPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the position column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPosition(1234); // WHERE position = 1234
	 * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
	 * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
	 * </code>
	 *
	 * @param     mixed $position The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(AdPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(AdPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the date_added column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDateAdded('2011-03-14'); // WHERE date_added = '2011-03-14'
	 * $query->filterByDateAdded('now'); // WHERE date_added = '2011-03-14'
	 * $query->filterByDateAdded(array('max' => 'yesterday')); // WHERE date_added > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dateAdded The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByDateAdded($dateAdded = null, $comparison = null)
	{
		if (is_array($dateAdded)) {
			$useMinMax = false;
			if (isset($dateAdded['min'])) {
				$this->addUsingAlias(AdPeer::DATE_ADDED, $dateAdded['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateAdded['max'])) {
				$this->addUsingAlias(AdPeer::DATE_ADDED, $dateAdded['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdPeer::DATE_ADDED, $dateAdded, $comparison);
	}

	/**
	 * Filter the query on the image_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByImageId(1234); // WHERE image_id = 1234
	 * $query->filterByImageId(array(12, 34)); // WHERE image_id IN (12, 34)
	 * $query->filterByImageId(array('min' => 12)); // WHERE image_id > 12
	 * </code>
	 *
	 * @see       filterByImage()
	 *
	 * @param     mixed $imageId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByImageId($imageId = null, $comparison = null)
	{
		if (is_array($imageId)) {
			$useMinMax = false;
			if (isset($imageId['min'])) {
				$this->addUsingAlias(AdPeer::IMAGE_ID, $imageId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($imageId['max'])) {
				$this->addUsingAlias(AdPeer::IMAGE_ID, $imageId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdPeer::IMAGE_ID, $imageId, $comparison);
	}

	/**
	 * Filter the query on the code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
	 * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $code The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByCode($code = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($code)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $code)) {
				$code = str_replace('*', '%', $code);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdPeer::CODE, $code, $comparison);
	}

	/**
	 * Filter the query by a related Image object
	 *
	 * @param     Image|PropelCollection $image The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByImage($image, $comparison = null)
	{
		if ($image instanceof Image) {
			return $this
				->addUsingAlias(AdPeer::IMAGE_ID, $image->getId(), $comparison);
		} elseif ($image instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AdPeer::IMAGE_ID, $image->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByImage() only accepts arguments of type Image or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Image relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function joinImage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Image');

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
			$this->addJoinObject($join, 'Image');
		}

		return $this;
	}

	/**
	 * Use the Image relation Image object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ImageQuery A secondary query class using the current class as primary query
	 */
	public function useImageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinImage($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Image', 'ImageQuery');
	}

	/**
	 * Filter the query by a related AdSelectionList object
	 *
	 * @param     AdSelectionList $adSelectionList  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function filterByAdSelectionList($adSelectionList, $comparison = null)
	{
		if ($adSelectionList instanceof AdSelectionList) {
			return $this
				->addUsingAlias(AdPeer::ID, $adSelectionList->getAdId(), $comparison);
		} elseif ($adSelectionList instanceof PropelCollection) {
			return $this
				->useAdSelectionListQuery()
				->filterByPrimaryKeys($adSelectionList->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAdSelectionList() only accepts arguments of type AdSelectionList or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the AdSelectionList relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function joinAdSelectionList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('AdSelectionList');

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
			$this->addJoinObject($join, 'AdSelectionList');
		}

		return $this;
	}

	/**
	 * Use the AdSelectionList relation AdSelectionList object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AdSelectionListQuery A secondary query class using the current class as primary query
	 */
	public function useAdSelectionListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAdSelectionList($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'AdSelectionList', 'AdSelectionListQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Ad $ad Object to remove from the list of results
	 *
	 * @return    AdQuery The current query, for fluid interface
	 */
	public function prune($ad = null)
	{
		if ($ad) {
			$this->addUsingAlias(AdPeer::ID, $ad->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAdQuery