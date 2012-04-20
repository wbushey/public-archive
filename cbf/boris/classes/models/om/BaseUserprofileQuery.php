<?php


/**
 * Base class that represents a query for the 'userProfile' table.
 *
 * User account information
 *
 * @method     UserprofileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     UserprofileQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     UserprofileQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     UserprofileQuery orderByUsertype($order = Criteria::ASC) Order by the userType column
 * @method     UserprofileQuery orderByEmailaddress($order = Criteria::ASC) Order by the emailAddress column
 * @method     UserprofileQuery orderByIp($order = Criteria::ASC) Order by the ip column
 *
 * @method     UserprofileQuery groupById() Group by the id column
 * @method     UserprofileQuery groupByUsername() Group by the username column
 * @method     UserprofileQuery groupByPassword() Group by the password column
 * @method     UserprofileQuery groupByUsertype() Group by the userType column
 * @method     UserprofileQuery groupByEmailaddress() Group by the emailAddress column
 * @method     UserprofileQuery groupByIp() Group by the ip column
 *
 * @method     UserprofileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserprofileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserprofileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserprofileQuery leftJoinPosts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Posts relation
 * @method     UserprofileQuery rightJoinPosts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Posts relation
 * @method     UserprofileQuery innerJoinPosts($relationAlias = null) Adds a INNER JOIN clause to the query using the Posts relation
 *
 * @method     UserprofileQuery leftJoinTourneyUserAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyUserAction relation
 * @method     UserprofileQuery rightJoinTourneyUserAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyUserAction relation
 * @method     UserprofileQuery innerJoinTourneyUserAction($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyUserAction relation
 *
 * @method     Userprofile findOne(PropelPDO $con = null) Return the first Userprofile matching the query
 * @method     Userprofile findOneOrCreate(PropelPDO $con = null) Return the first Userprofile matching the query, or a new Userprofile object populated from the query conditions when no match is found
 *
 * @method     Userprofile findOneById(int $id) Return the first Userprofile filtered by the id column
 * @method     Userprofile findOneByUsername(string $username) Return the first Userprofile filtered by the username column
 * @method     Userprofile findOneByPassword(string $password) Return the first Userprofile filtered by the password column
 * @method     Userprofile findOneByUsertype(int $userType) Return the first Userprofile filtered by the userType column
 * @method     Userprofile findOneByEmailaddress(string $emailAddress) Return the first Userprofile filtered by the emailAddress column
 * @method     Userprofile findOneByIp(string $ip) Return the first Userprofile filtered by the ip column
 *
 * @method     array findById(int $id) Return Userprofile objects filtered by the id column
 * @method     array findByUsername(string $username) Return Userprofile objects filtered by the username column
 * @method     array findByPassword(string $password) Return Userprofile objects filtered by the password column
 * @method     array findByUsertype(int $userType) Return Userprofile objects filtered by the userType column
 * @method     array findByEmailaddress(string $emailAddress) Return Userprofile objects filtered by the emailAddress column
 * @method     array findByIp(string $ip) Return Userprofile objects filtered by the ip column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseUserprofileQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseUserprofileQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'Userprofile', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserprofileQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserprofileQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserprofileQuery) {
			return $criteria;
		}
		$query = new UserprofileQuery();
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
	 * @return    Userprofile|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = UserprofilePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(UserprofilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Userprofile A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USERNAME`, `PASSWORD`, `USERTYPE`, `EMAILADDRESS`, `IP` FROM `userProfile` WHERE `ID` = :p0';
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
			$obj = new Userprofile();
			$obj->hydrate($row);
			UserprofilePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Userprofile|array|mixed the result, formatted by the current formatter
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
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserprofilePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserprofilePeer::ID, $keys, Criteria::IN);
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
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserprofilePeer::ID, $id, $comparison);
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
	 * @return    UserprofileQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserprofilePeer::USERNAME, $username, $comparison);
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
	 * @return    UserprofileQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserprofilePeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query on the userType column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUsertype(1234); // WHERE userType = 1234
	 * $query->filterByUsertype(array(12, 34)); // WHERE userType IN (12, 34)
	 * $query->filterByUsertype(array('min' => 12)); // WHERE userType > 12
	 * </code>
	 *
	 * @param     mixed $usertype The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByUsertype($usertype = null, $comparison = null)
	{
		if (is_array($usertype)) {
			$useMinMax = false;
			if (isset($usertype['min'])) {
				$this->addUsingAlias(UserprofilePeer::USERTYPE, $usertype['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($usertype['max'])) {
				$this->addUsingAlias(UserprofilePeer::USERTYPE, $usertype['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserprofilePeer::USERTYPE, $usertype, $comparison);
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
	 * @return    UserprofileQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserprofilePeer::EMAILADDRESS, $emailaddress, $comparison);
	}

	/**
	 * Filter the query on the ip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
	 * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $ip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByIp($ip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($ip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $ip)) {
				$ip = str_replace('*', '%', $ip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserprofilePeer::IP, $ip, $comparison);
	}

	/**
	 * Filter the query by a related Posts object
	 *
	 * @param     Posts $posts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByPosts($posts, $comparison = null)
	{
		if ($posts instanceof Posts) {
			return $this
				->addUsingAlias(UserprofilePeer::ID, $posts->getPosterid(), $comparison);
		} elseif ($posts instanceof PropelCollection) {
			return $this
				->usePostsQuery()
				->filterByPrimaryKeys($posts->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPosts() only accepts arguments of type Posts or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Posts relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function joinPosts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Posts');

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
			$this->addJoinObject($join, 'Posts');
		}

		return $this;
	}

	/**
	 * Use the Posts relation Posts object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PostsQuery A secondary query class using the current class as primary query
	 */
	public function usePostsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinPosts($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Posts', 'PostsQuery');
	}

	/**
	 * Filter the query by a related TourneyUserAction object
	 *
	 * @param     TourneyUserAction $tourneyUserAction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function filterByTourneyUserAction($tourneyUserAction, $comparison = null)
	{
		if ($tourneyUserAction instanceof TourneyUserAction) {
			return $this
				->addUsingAlias(UserprofilePeer::ID, $tourneyUserAction->getUserId(), $comparison);
		} elseif ($tourneyUserAction instanceof PropelCollection) {
			return $this
				->useTourneyUserActionQuery()
				->filterByPrimaryKeys($tourneyUserAction->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTourneyUserAction() only accepts arguments of type TourneyUserAction or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyUserAction relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function joinTourneyUserAction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyUserAction');

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
			$this->addJoinObject($join, 'TourneyUserAction');
		}

		return $this;
	}

	/**
	 * Use the TourneyUserAction relation TourneyUserAction object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyUserActionQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyUserActionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyUserAction($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyUserAction', 'TourneyUserActionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Userprofile $userprofile Object to remove from the list of results
	 *
	 * @return    UserprofileQuery The current query, for fluid interface
	 */
	public function prune($userprofile = null)
	{
		if ($userprofile) {
			$this->addUsingAlias(UserprofilePeer::ID, $userprofile->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseUserprofileQuery