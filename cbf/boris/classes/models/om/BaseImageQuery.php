<?php


/**
 * Base class that represents a query for the 'image' table.
 *
 * Metadata for stored images
 *
 * @method     ImageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ImageQuery orderByDatatype($order = Criteria::ASC) Order by the datatype column
 * @method     ImageQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ImageQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method     ImageQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 *
 * @method     ImageQuery groupById() Group by the id column
 * @method     ImageQuery groupByDatatype() Group by the datatype column
 * @method     ImageQuery groupByName() Group by the name column
 * @method     ImageQuery groupBySize() Group by the size column
 * @method     ImageQuery groupByDateAdded() Group by the date_added column
 *
 * @method     ImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ImageQuery leftJoinImageData($relationAlias = null) Adds a LEFT JOIN clause to the query using the ImageData relation
 * @method     ImageQuery rightJoinImageData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ImageData relation
 * @method     ImageQuery innerJoinImageData($relationAlias = null) Adds a INNER JOIN clause to the query using the ImageData relation
 *
 * @method     ImageQuery leftJoinAd($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ad relation
 * @method     ImageQuery rightJoinAd($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ad relation
 * @method     ImageQuery innerJoinAd($relationAlias = null) Adds a INNER JOIN clause to the query using the Ad relation
 *
 * @method     Image findOne(PropelPDO $con = null) Return the first Image matching the query
 * @method     Image findOneOrCreate(PropelPDO $con = null) Return the first Image matching the query, or a new Image object populated from the query conditions when no match is found
 *
 * @method     Image findOneById(int $id) Return the first Image filtered by the id column
 * @method     Image findOneByDatatype(string $datatype) Return the first Image filtered by the datatype column
 * @method     Image findOneByName(string $name) Return the first Image filtered by the name column
 * @method     Image findOneBySize(string $size) Return the first Image filtered by the size column
 * @method     Image findOneByDateAdded(string $date_added) Return the first Image filtered by the date_added column
 *
 * @method     array findById(int $id) Return Image objects filtered by the id column
 * @method     array findByDatatype(string $datatype) Return Image objects filtered by the datatype column
 * @method     array findByName(string $name) Return Image objects filtered by the name column
 * @method     array findBySize(string $size) Return Image objects filtered by the size column
 * @method     array findByDateAdded(string $date_added) Return Image objects filtered by the date_added column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseImageQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseImageQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Image', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ImageQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ImageQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ImageQuery) {
			return $criteria;
		}
		$query = new ImageQuery();
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
	 * @return    Image|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ImagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Image A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `DATATYPE`, `NAME`, `SIZE`, `DATE_ADDED` FROM `image` WHERE `ID` = :p0';
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
			$obj = new Image();
			$obj->hydrate($row);
			ImagePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Image|array|mixed the result, formatted by the current formatter
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
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ImagePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ImagePeer::ID, $keys, Criteria::IN);
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
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ImagePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the datatype column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDatatype('fooValue');   // WHERE datatype = 'fooValue'
	 * $query->filterByDatatype('%fooValue%'); // WHERE datatype LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $datatype The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByDatatype($datatype = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($datatype)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $datatype)) {
				$datatype = str_replace('*', '%', $datatype);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ImagePeer::DATATYPE, $datatype, $comparison);
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
	 * @return    ImageQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ImagePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the size column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySize(1234); // WHERE size = 1234
	 * $query->filterBySize(array(12, 34)); // WHERE size IN (12, 34)
	 * $query->filterBySize(array('min' => 12)); // WHERE size > 12
	 * </code>
	 *
	 * @param     mixed $size The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterBySize($size = null, $comparison = null)
	{
		if (is_array($size)) {
			$useMinMax = false;
			if (isset($size['min'])) {
				$this->addUsingAlias(ImagePeer::SIZE, $size['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($size['max'])) {
				$this->addUsingAlias(ImagePeer::SIZE, $size['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ImagePeer::SIZE, $size, $comparison);
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
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByDateAdded($dateAdded = null, $comparison = null)
	{
		if (is_array($dateAdded)) {
			$useMinMax = false;
			if (isset($dateAdded['min'])) {
				$this->addUsingAlias(ImagePeer::DATE_ADDED, $dateAdded['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateAdded['max'])) {
				$this->addUsingAlias(ImagePeer::DATE_ADDED, $dateAdded['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ImagePeer::DATE_ADDED, $dateAdded, $comparison);
	}

	/**
	 * Filter the query by a related ImageData object
	 *
	 * @param     ImageData $imageData  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByImageData($imageData, $comparison = null)
	{
		if ($imageData instanceof ImageData) {
			return $this
				->addUsingAlias(ImagePeer::ID, $imageData->getImageId(), $comparison);
		} elseif ($imageData instanceof PropelCollection) {
			return $this
				->useImageDataQuery()
				->filterByPrimaryKeys($imageData->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByImageData() only accepts arguments of type ImageData or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ImageData relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function joinImageData($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ImageData');

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
			$this->addJoinObject($join, 'ImageData');
		}

		return $this;
	}

	/**
	 * Use the ImageData relation ImageData object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ImageDataQuery A secondary query class using the current class as primary query
	 */
	public function useImageDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinImageData($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ImageData', 'ImageDataQuery');
	}

	/**
	 * Filter the query by a related Ad object
	 *
	 * @param     Ad $ad  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function filterByAd($ad, $comparison = null)
	{
		if ($ad instanceof Ad) {
			return $this
				->addUsingAlias(ImagePeer::ID, $ad->getImageId(), $comparison);
		} elseif ($ad instanceof PropelCollection) {
			return $this
				->useAdQuery()
				->filterByPrimaryKeys($ad->getPrimaryKeys())
				->endUse();
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
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function joinAd($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useAdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinAd($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Ad', 'AdQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Image $image Object to remove from the list of results
	 *
	 * @return    ImageQuery The current query, for fluid interface
	 */
	public function prune($image = null)
	{
		if ($image) {
			$this->addUsingAlias(ImagePeer::ID, $image->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseImageQuery