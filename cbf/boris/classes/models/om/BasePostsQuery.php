<?php


/**
 * Base class that represents a query for the 'posts' table.
 *
 * Posts made about celebrity fights
 *
 * @method     PostsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PostsQuery orderByFightid($order = Criteria::ASC) Order by the fightID column
 * @method     PostsQuery orderByPosterid($order = Criteria::ASC) Order by the posterID column
 * @method     PostsQuery orderByPostdate($order = Criteria::ASC) Order by the postDate column
 * @method     PostsQuery orderByPosttext($order = Criteria::ASC) Order by the postText column
 *
 * @method     PostsQuery groupById() Group by the id column
 * @method     PostsQuery groupByFightid() Group by the fightID column
 * @method     PostsQuery groupByPosterid() Group by the posterID column
 * @method     PostsQuery groupByPostdate() Group by the postDate column
 * @method     PostsQuery groupByPosttext() Group by the postText column
 *
 * @method     PostsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PostsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PostsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PostsQuery leftJoinFights($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fights relation
 * @method     PostsQuery rightJoinFights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fights relation
 * @method     PostsQuery innerJoinFights($relationAlias = null) Adds a INNER JOIN clause to the query using the Fights relation
 *
 * @method     PostsQuery leftJoinUserprofile($relationAlias = null) Adds a LEFT JOIN clause to the query using the Userprofile relation
 * @method     PostsQuery rightJoinUserprofile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Userprofile relation
 * @method     PostsQuery innerJoinUserprofile($relationAlias = null) Adds a INNER JOIN clause to the query using the Userprofile relation
 *
 * @method     Posts findOne(PropelPDO $con = null) Return the first Posts matching the query
 * @method     Posts findOneOrCreate(PropelPDO $con = null) Return the first Posts matching the query, or a new Posts object populated from the query conditions when no match is found
 *
 * @method     Posts findOneById(int $id) Return the first Posts filtered by the id column
 * @method     Posts findOneByFightid(int $fightID) Return the first Posts filtered by the fightID column
 * @method     Posts findOneByPosterid(int $posterID) Return the first Posts filtered by the posterID column
 * @method     Posts findOneByPostdate(string $postDate) Return the first Posts filtered by the postDate column
 * @method     Posts findOneByPosttext(string $postText) Return the first Posts filtered by the postText column
 *
 * @method     array findById(int $id) Return Posts objects filtered by the id column
 * @method     array findByFightid(int $fightID) Return Posts objects filtered by the fightID column
 * @method     array findByPosterid(int $posterID) Return Posts objects filtered by the posterID column
 * @method     array findByPostdate(string $postDate) Return Posts objects filtered by the postDate column
 * @method     array findByPosttext(string $postText) Return Posts objects filtered by the postText column
 *
 * @package    propel.generator.models.om
 */
abstract class BasePostsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePostsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Posts', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PostsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PostsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PostsQuery) {
			return $criteria;
		}
		$query = new PostsQuery();
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
	 * @return    Posts|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PostsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PostsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Posts A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `FIGHTID`, `POSTERID`, `POSTDATE`, `POSTTEXT` FROM `posts` WHERE `ID` = :p0';
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
			$obj = new Posts();
			$obj->hydrate($row);
			PostsPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Posts|array|mixed the result, formatted by the current formatter
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
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PostsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PostsPeer::ID, $keys, Criteria::IN);
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
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PostsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the fightID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFightid(1234); // WHERE fightID = 1234
	 * $query->filterByFightid(array(12, 34)); // WHERE fightID IN (12, 34)
	 * $query->filterByFightid(array('min' => 12)); // WHERE fightID > 12
	 * </code>
	 *
	 * @see       filterByFights()
	 *
	 * @param     mixed $fightid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByFightid($fightid = null, $comparison = null)
	{
		if (is_array($fightid)) {
			$useMinMax = false;
			if (isset($fightid['min'])) {
				$this->addUsingAlias(PostsPeer::FIGHTID, $fightid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fightid['max'])) {
				$this->addUsingAlias(PostsPeer::FIGHTID, $fightid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PostsPeer::FIGHTID, $fightid, $comparison);
	}

	/**
	 * Filter the query on the posterID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPosterid(1234); // WHERE posterID = 1234
	 * $query->filterByPosterid(array(12, 34)); // WHERE posterID IN (12, 34)
	 * $query->filterByPosterid(array('min' => 12)); // WHERE posterID > 12
	 * </code>
	 *
	 * @see       filterByUserprofile()
	 *
	 * @param     mixed $posterid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByPosterid($posterid = null, $comparison = null)
	{
		if (is_array($posterid)) {
			$useMinMax = false;
			if (isset($posterid['min'])) {
				$this->addUsingAlias(PostsPeer::POSTERID, $posterid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($posterid['max'])) {
				$this->addUsingAlias(PostsPeer::POSTERID, $posterid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PostsPeer::POSTERID, $posterid, $comparison);
	}

	/**
	 * Filter the query on the postDate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPostdate('2011-03-14'); // WHERE postDate = '2011-03-14'
	 * $query->filterByPostdate('now'); // WHERE postDate = '2011-03-14'
	 * $query->filterByPostdate(array('max' => 'yesterday')); // WHERE postDate > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $postdate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByPostdate($postdate = null, $comparison = null)
	{
		if (is_array($postdate)) {
			$useMinMax = false;
			if (isset($postdate['min'])) {
				$this->addUsingAlias(PostsPeer::POSTDATE, $postdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($postdate['max'])) {
				$this->addUsingAlias(PostsPeer::POSTDATE, $postdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PostsPeer::POSTDATE, $postdate, $comparison);
	}

	/**
	 * Filter the query on the postText column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPosttext('fooValue');   // WHERE postText = 'fooValue'
	 * $query->filterByPosttext('%fooValue%'); // WHERE postText LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $posttext The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByPosttext($posttext = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($posttext)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $posttext)) {
				$posttext = str_replace('*', '%', $posttext);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PostsPeer::POSTTEXT, $posttext, $comparison);
	}

	/**
	 * Filter the query by a related Fights object
	 *
	 * @param     Fights|PropelCollection $fights The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByFights($fights, $comparison = null)
	{
		if ($fights instanceof Fights) {
			return $this
				->addUsingAlias(PostsPeer::FIGHTID, $fights->getId(), $comparison);
		} elseif ($fights instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PostsPeer::FIGHTID, $fights->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByFights() only accepts arguments of type Fights or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Fights relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function joinFights($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Fights');

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
			$this->addJoinObject($join, 'Fights');
		}

		return $this;
	}

	/**
	 * Use the Fights relation Fights object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FightsQuery A secondary query class using the current class as primary query
	 */
	public function useFightsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFights($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Fights', 'FightsQuery');
	}

	/**
	 * Filter the query by a related Userprofile object
	 *
	 * @param     Userprofile|PropelCollection $userprofile The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function filterByUserprofile($userprofile, $comparison = null)
	{
		if ($userprofile instanceof Userprofile) {
			return $this
				->addUsingAlias(PostsPeer::POSTERID, $userprofile->getId(), $comparison);
		} elseif ($userprofile instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PostsPeer::POSTERID, $userprofile->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUserprofile() only accepts arguments of type Userprofile or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Userprofile relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function joinUserprofile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Userprofile');

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
			$this->addJoinObject($join, 'Userprofile');
		}

		return $this;
	}

	/**
	 * Use the Userprofile relation Userprofile object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserprofileQuery A secondary query class using the current class as primary query
	 */
	public function useUserprofileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserprofile($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Userprofile', 'UserprofileQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Posts $posts Object to remove from the list of results
	 *
	 * @return    PostsQuery The current query, for fluid interface
	 */
	public function prune($posts = null)
	{
		if ($posts) {
			$this->addUsingAlias(PostsPeer::ID, $posts->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePostsQuery