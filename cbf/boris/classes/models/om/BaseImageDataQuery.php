<?php


/**
 * Base class that represents a query for the 'image_data' table.
 *
 * The binary data of stored images
 *
 * @method     ImageDataQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ImageDataQuery orderByImageId($order = Criteria::ASC) Order by the image_id column
 * @method     ImageDataQuery orderByData($order = Criteria::ASC) Order by the data column
 *
 * @method     ImageDataQuery groupById() Group by the id column
 * @method     ImageDataQuery groupByImageId() Group by the image_id column
 * @method     ImageDataQuery groupByData() Group by the data column
 *
 * @method     ImageDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ImageDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ImageDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ImageDataQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method     ImageDataQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method     ImageDataQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method     ImageData findOne(PropelPDO $con = null) Return the first ImageData matching the query
 * @method     ImageData findOneOrCreate(PropelPDO $con = null) Return the first ImageData matching the query, or a new ImageData object populated from the query conditions when no match is found
 *
 * @method     ImageData findOneById(int $id) Return the first ImageData filtered by the id column
 * @method     ImageData findOneByImageId(int $image_id) Return the first ImageData filtered by the image_id column
 * @method     ImageData findOneByData(resource $data) Return the first ImageData filtered by the data column
 *
 * @method     array findById(int $id) Return ImageData objects filtered by the id column
 * @method     array findByImageId(int $image_id) Return ImageData objects filtered by the image_id column
 * @method     array findByData(resource $data) Return ImageData objects filtered by the data column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseImageDataQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseImageDataQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'ImageData', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ImageDataQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ImageDataQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ImageDataQuery) {
			return $criteria;
		}
		$query = new ImageDataQuery();
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
	 * @return    ImageData|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ImageDataPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ImageDataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ImageData A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `IMAGE_ID`, `DATA` FROM `image_data` WHERE `ID` = :p0';
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
			$obj = new ImageData();
			$obj->hydrate($row);
			ImageDataPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    ImageData|array|mixed the result, formatted by the current formatter
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
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ImageDataPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ImageDataPeer::ID, $keys, Criteria::IN);
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
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ImageDataPeer::ID, $id, $comparison);
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
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterByImageId($imageId = null, $comparison = null)
	{
		if (is_array($imageId)) {
			$useMinMax = false;
			if (isset($imageId['min'])) {
				$this->addUsingAlias(ImageDataPeer::IMAGE_ID, $imageId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($imageId['max'])) {
				$this->addUsingAlias(ImageDataPeer::IMAGE_ID, $imageId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ImageDataPeer::IMAGE_ID, $imageId, $comparison);
	}

	/**
	 * Filter the query on the data column
	 *
	 * @param     mixed $data The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterByData($data = null, $comparison = null)
	{
		return $this->addUsingAlias(ImageDataPeer::DATA, $data, $comparison);
	}

	/**
	 * Filter the query by a related Image object
	 *
	 * @param     Image|PropelCollection $image The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function filterByImage($image, $comparison = null)
	{
		if ($image instanceof Image) {
			return $this
				->addUsingAlias(ImageDataPeer::IMAGE_ID, $image->getId(), $comparison);
		} elseif ($image instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ImageDataPeer::IMAGE_ID, $image->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function joinImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinImage($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Image', 'ImageQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ImageData $imageData Object to remove from the list of results
	 *
	 * @return    ImageDataQuery The current query, for fluid interface
	 */
	public function prune($imageData = null)
	{
		if ($imageData) {
			$this->addUsingAlias(ImageDataPeer::ID, $imageData->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseImageDataQuery