<?php


/**
 * Base class that represents a query for the 'tourney_fights' table.
 *
 * Listing and recording of tournament fights.
 *
 * @method     TourneyFightsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TourneyFightsQuery orderByTourneyId($order = Criteria::ASC) Order by the tourney_id column
 * @method     TourneyFightsQuery orderByRoundNumber($order = Criteria::ASC) Order by the round_number column
 * @method     TourneyFightsQuery orderByGeneralFightId($order = Criteria::ASC) Order by the general_fight_id column
 * @method     TourneyFightsQuery orderByOneid($order = Criteria::ASC) Order by the oneID column
 * @method     TourneyFightsQuery orderByTwoid($order = Criteria::ASC) Order by the twoID column
 * @method     TourneyFightsQuery orderByOnewins($order = Criteria::ASC) Order by the oneWins column
 * @method     TourneyFightsQuery orderByTwowins($order = Criteria::ASC) Order by the twoWins column
 * @method     TourneyFightsQuery orderByChildRight($order = Criteria::ASC) Order by the child_right column
 * @method     TourneyFightsQuery orderByChildLeft($order = Criteria::ASC) Order by the child_left column
 * @method     TourneyFightsQuery orderByParent($order = Criteria::ASC) Order by the parent column
 *
 * @method     TourneyFightsQuery groupById() Group by the id column
 * @method     TourneyFightsQuery groupByTourneyId() Group by the tourney_id column
 * @method     TourneyFightsQuery groupByRoundNumber() Group by the round_number column
 * @method     TourneyFightsQuery groupByGeneralFightId() Group by the general_fight_id column
 * @method     TourneyFightsQuery groupByOneid() Group by the oneID column
 * @method     TourneyFightsQuery groupByTwoid() Group by the twoID column
 * @method     TourneyFightsQuery groupByOnewins() Group by the oneWins column
 * @method     TourneyFightsQuery groupByTwowins() Group by the twoWins column
 * @method     TourneyFightsQuery groupByChildRight() Group by the child_right column
 * @method     TourneyFightsQuery groupByChildLeft() Group by the child_left column
 * @method     TourneyFightsQuery groupByParent() Group by the parent column
 *
 * @method     TourneyFightsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TourneyFightsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TourneyFightsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TourneyFightsQuery leftJoinTourneyRoundStatusRelatedByTourneyId($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyRoundStatusRelatedByTourneyId relation
 * @method     TourneyFightsQuery rightJoinTourneyRoundStatusRelatedByTourneyId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyRoundStatusRelatedByTourneyId relation
 * @method     TourneyFightsQuery innerJoinTourneyRoundStatusRelatedByTourneyId($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyRoundStatusRelatedByTourneyId relation
 *
 * @method     TourneyFightsQuery leftJoinTourneyRoundStatusRelatedByRoundNumber($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyRoundStatusRelatedByRoundNumber relation
 * @method     TourneyFightsQuery rightJoinTourneyRoundStatusRelatedByRoundNumber($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyRoundStatusRelatedByRoundNumber relation
 * @method     TourneyFightsQuery innerJoinTourneyRoundStatusRelatedByRoundNumber($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyRoundStatusRelatedByRoundNumber relation
 *
 * @method     TourneyFightsQuery leftJoinFights($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fights relation
 * @method     TourneyFightsQuery rightJoinFights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fights relation
 * @method     TourneyFightsQuery innerJoinFights($relationAlias = null) Adds a INNER JOIN clause to the query using the Fights relation
 *
 * @method     TourneyFightsQuery leftJoinTourneyFightersRelatedByOneid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightersRelatedByOneid relation
 * @method     TourneyFightsQuery rightJoinTourneyFightersRelatedByOneid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightersRelatedByOneid relation
 * @method     TourneyFightsQuery innerJoinTourneyFightersRelatedByOneid($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightersRelatedByOneid relation
 *
 * @method     TourneyFightsQuery leftJoinTourneyFightersRelatedByTwoid($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyFightersRelatedByTwoid relation
 * @method     TourneyFightsQuery rightJoinTourneyFightersRelatedByTwoid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyFightersRelatedByTwoid relation
 * @method     TourneyFightsQuery innerJoinTourneyFightersRelatedByTwoid($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyFightersRelatedByTwoid relation
 *
 * @method     TourneyFightsQuery leftJoinTourneyUserAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the TourneyUserAction relation
 * @method     TourneyFightsQuery rightJoinTourneyUserAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TourneyUserAction relation
 * @method     TourneyFightsQuery innerJoinTourneyUserAction($relationAlias = null) Adds a INNER JOIN clause to the query using the TourneyUserAction relation
 *
 * @method     TourneyFights findOne(PropelPDO $con = null) Return the first TourneyFights matching the query
 * @method     TourneyFights findOneOrCreate(PropelPDO $con = null) Return the first TourneyFights matching the query, or a new TourneyFights object populated from the query conditions when no match is found
 *
 * @method     TourneyFights findOneById(int $id) Return the first TourneyFights filtered by the id column
 * @method     TourneyFights findOneByTourneyId(int $tourney_id) Return the first TourneyFights filtered by the tourney_id column
 * @method     TourneyFights findOneByRoundNumber(int $round_number) Return the first TourneyFights filtered by the round_number column
 * @method     TourneyFights findOneByGeneralFightId(int $general_fight_id) Return the first TourneyFights filtered by the general_fight_id column
 * @method     TourneyFights findOneByOneid(int $oneID) Return the first TourneyFights filtered by the oneID column
 * @method     TourneyFights findOneByTwoid(int $twoID) Return the first TourneyFights filtered by the twoID column
 * @method     TourneyFights findOneByOnewins(int $oneWins) Return the first TourneyFights filtered by the oneWins column
 * @method     TourneyFights findOneByTwowins(int $twoWins) Return the first TourneyFights filtered by the twoWins column
 * @method     TourneyFights findOneByChildRight(int $child_right) Return the first TourneyFights filtered by the child_right column
 * @method     TourneyFights findOneByChildLeft(int $child_left) Return the first TourneyFights filtered by the child_left column
 * @method     TourneyFights findOneByParent(int $parent) Return the first TourneyFights filtered by the parent column
 *
 * @method     array findById(int $id) Return TourneyFights objects filtered by the id column
 * @method     array findByTourneyId(int $tourney_id) Return TourneyFights objects filtered by the tourney_id column
 * @method     array findByRoundNumber(int $round_number) Return TourneyFights objects filtered by the round_number column
 * @method     array findByGeneralFightId(int $general_fight_id) Return TourneyFights objects filtered by the general_fight_id column
 * @method     array findByOneid(int $oneID) Return TourneyFights objects filtered by the oneID column
 * @method     array findByTwoid(int $twoID) Return TourneyFights objects filtered by the twoID column
 * @method     array findByOnewins(int $oneWins) Return TourneyFights objects filtered by the oneWins column
 * @method     array findByTwowins(int $twoWins) Return TourneyFights objects filtered by the twoWins column
 * @method     array findByChildRight(int $child_right) Return TourneyFights objects filtered by the child_right column
 * @method     array findByChildLeft(int $child_left) Return TourneyFights objects filtered by the child_left column
 * @method     array findByParent(int $parent) Return TourneyFights objects filtered by the parent column
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyFightsQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTourneyFightsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'cbf', $modelName = 'TourneyFights', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TourneyFightsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TourneyFightsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TourneyFightsQuery) {
			return $criteria;
		}
		$query = new TourneyFightsQuery();
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
	 * @return    TourneyFights|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TourneyFightsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    TourneyFights A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `TOURNEY_ID`, `ROUND_NUMBER`, `GENERAL_FIGHT_ID`, `ONEID`, `TWOID`, `ONEWINS`, `TWOWINS`, `CHILD_RIGHT`, `CHILD_LEFT`, `PARENT` FROM `tourney_fights` WHERE `ID` = :p0';
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
			$obj = new TourneyFights();
			$obj->hydrate($row);
			TourneyFightsPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    TourneyFights|array|mixed the result, formatted by the current formatter
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
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TourneyFightsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TourneyFightsPeer::ID, $keys, Criteria::IN);
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
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TourneyFightsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the tourney_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTourneyId(1234); // WHERE tourney_id = 1234
	 * $query->filterByTourneyId(array(12, 34)); // WHERE tourney_id IN (12, 34)
	 * $query->filterByTourneyId(array('min' => 12)); // WHERE tourney_id > 12
	 * </code>
	 *
	 * @see       filterByTourneyRoundStatusRelatedByTourneyId()
	 *
	 * @param     mixed $tourneyId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyId($tourneyId = null, $comparison = null)
	{
		if (is_array($tourneyId)) {
			$useMinMax = false;
			if (isset($tourneyId['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::TOURNEY_ID, $tourneyId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($tourneyId['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::TOURNEY_ID, $tourneyId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::TOURNEY_ID, $tourneyId, $comparison);
	}

	/**
	 * Filter the query on the round_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRoundNumber(1234); // WHERE round_number = 1234
	 * $query->filterByRoundNumber(array(12, 34)); // WHERE round_number IN (12, 34)
	 * $query->filterByRoundNumber(array('min' => 12)); // WHERE round_number > 12
	 * </code>
	 *
	 * @see       filterByTourneyRoundStatusRelatedByRoundNumber()
	 *
	 * @param     mixed $roundNumber The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByRoundNumber($roundNumber = null, $comparison = null)
	{
		if (is_array($roundNumber)) {
			$useMinMax = false;
			if (isset($roundNumber['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::ROUND_NUMBER, $roundNumber['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($roundNumber['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::ROUND_NUMBER, $roundNumber['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::ROUND_NUMBER, $roundNumber, $comparison);
	}

	/**
	 * Filter the query on the general_fight_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByGeneralFightId(1234); // WHERE general_fight_id = 1234
	 * $query->filterByGeneralFightId(array(12, 34)); // WHERE general_fight_id IN (12, 34)
	 * $query->filterByGeneralFightId(array('min' => 12)); // WHERE general_fight_id > 12
	 * </code>
	 *
	 * @see       filterByFights()
	 *
	 * @param     mixed $generalFightId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByGeneralFightId($generalFightId = null, $comparison = null)
	{
		if (is_array($generalFightId)) {
			$useMinMax = false;
			if (isset($generalFightId['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::GENERAL_FIGHT_ID, $generalFightId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($generalFightId['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::GENERAL_FIGHT_ID, $generalFightId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::GENERAL_FIGHT_ID, $generalFightId, $comparison);
	}

	/**
	 * Filter the query on the oneID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOneid(1234); // WHERE oneID = 1234
	 * $query->filterByOneid(array(12, 34)); // WHERE oneID IN (12, 34)
	 * $query->filterByOneid(array('min' => 12)); // WHERE oneID > 12
	 * </code>
	 *
	 * @see       filterByTourneyFightersRelatedByOneid()
	 *
	 * @param     mixed $oneid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByOneid($oneid = null, $comparison = null)
	{
		if (is_array($oneid)) {
			$useMinMax = false;
			if (isset($oneid['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::ONEID, $oneid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($oneid['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::ONEID, $oneid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::ONEID, $oneid, $comparison);
	}

	/**
	 * Filter the query on the twoID column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwoid(1234); // WHERE twoID = 1234
	 * $query->filterByTwoid(array(12, 34)); // WHERE twoID IN (12, 34)
	 * $query->filterByTwoid(array('min' => 12)); // WHERE twoID > 12
	 * </code>
	 *
	 * @see       filterByTourneyFightersRelatedByTwoid()
	 *
	 * @param     mixed $twoid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTwoid($twoid = null, $comparison = null)
	{
		if (is_array($twoid)) {
			$useMinMax = false;
			if (isset($twoid['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::TWOID, $twoid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twoid['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::TWOID, $twoid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::TWOID, $twoid, $comparison);
	}

	/**
	 * Filter the query on the oneWins column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByOnewins(1234); // WHERE oneWins = 1234
	 * $query->filterByOnewins(array(12, 34)); // WHERE oneWins IN (12, 34)
	 * $query->filterByOnewins(array('min' => 12)); // WHERE oneWins > 12
	 * </code>
	 *
	 * @param     mixed $onewins The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByOnewins($onewins = null, $comparison = null)
	{
		if (is_array($onewins)) {
			$useMinMax = false;
			if (isset($onewins['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::ONEWINS, $onewins['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($onewins['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::ONEWINS, $onewins['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::ONEWINS, $onewins, $comparison);
	}

	/**
	 * Filter the query on the twoWins column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwowins(1234); // WHERE twoWins = 1234
	 * $query->filterByTwowins(array(12, 34)); // WHERE twoWins IN (12, 34)
	 * $query->filterByTwowins(array('min' => 12)); // WHERE twoWins > 12
	 * </code>
	 *
	 * @param     mixed $twowins The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTwowins($twowins = null, $comparison = null)
	{
		if (is_array($twowins)) {
			$useMinMax = false;
			if (isset($twowins['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::TWOWINS, $twowins['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twowins['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::TWOWINS, $twowins['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::TWOWINS, $twowins, $comparison);
	}

	/**
	 * Filter the query on the child_right column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChildRight(1234); // WHERE child_right = 1234
	 * $query->filterByChildRight(array(12, 34)); // WHERE child_right IN (12, 34)
	 * $query->filterByChildRight(array('min' => 12)); // WHERE child_right > 12
	 * </code>
	 *
	 * @param     mixed $childRight The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByChildRight($childRight = null, $comparison = null)
	{
		if (is_array($childRight)) {
			$useMinMax = false;
			if (isset($childRight['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::CHILD_RIGHT, $childRight['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($childRight['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::CHILD_RIGHT, $childRight['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::CHILD_RIGHT, $childRight, $comparison);
	}

	/**
	 * Filter the query on the child_left column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChildLeft(1234); // WHERE child_left = 1234
	 * $query->filterByChildLeft(array(12, 34)); // WHERE child_left IN (12, 34)
	 * $query->filterByChildLeft(array('min' => 12)); // WHERE child_left > 12
	 * </code>
	 *
	 * @param     mixed $childLeft The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByChildLeft($childLeft = null, $comparison = null)
	{
		if (is_array($childLeft)) {
			$useMinMax = false;
			if (isset($childLeft['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::CHILD_LEFT, $childLeft['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($childLeft['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::CHILD_LEFT, $childLeft['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::CHILD_LEFT, $childLeft, $comparison);
	}

	/**
	 * Filter the query on the parent column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByParent(1234); // WHERE parent = 1234
	 * $query->filterByParent(array(12, 34)); // WHERE parent IN (12, 34)
	 * $query->filterByParent(array('min' => 12)); // WHERE parent > 12
	 * </code>
	 *
	 * @param     mixed $parent The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByParent($parent = null, $comparison = null)
	{
		if (is_array($parent)) {
			$useMinMax = false;
			if (isset($parent['min'])) {
				$this->addUsingAlias(TourneyFightsPeer::PARENT, $parent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($parent['max'])) {
				$this->addUsingAlias(TourneyFightsPeer::PARENT, $parent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TourneyFightsPeer::PARENT, $parent, $comparison);
	}

	/**
	 * Filter the query by a related TourneyRoundStatus object
	 *
	 * @param     TourneyRoundStatus|PropelCollection $tourneyRoundStatus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyRoundStatusRelatedByTourneyId($tourneyRoundStatus, $comparison = null)
	{
		if ($tourneyRoundStatus instanceof TourneyRoundStatus) {
			return $this
				->addUsingAlias(TourneyFightsPeer::TOURNEY_ID, $tourneyRoundStatus->getTourneyId(), $comparison);
		} elseif ($tourneyRoundStatus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightsPeer::TOURNEY_ID, $tourneyRoundStatus->toKeyValue('PrimaryKey', 'TourneyId'), $comparison);
		} else {
			throw new PropelException('filterByTourneyRoundStatusRelatedByTourneyId() only accepts arguments of type TourneyRoundStatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyRoundStatusRelatedByTourneyId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function joinTourneyRoundStatusRelatedByTourneyId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyRoundStatusRelatedByTourneyId');

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
			$this->addJoinObject($join, 'TourneyRoundStatusRelatedByTourneyId');
		}

		return $this;
	}

	/**
	 * Use the TourneyRoundStatusRelatedByTourneyId relation TourneyRoundStatus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyRoundStatusRelatedByTourneyIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyRoundStatusRelatedByTourneyId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyRoundStatusRelatedByTourneyId', 'TourneyRoundStatusQuery');
	}

	/**
	 * Filter the query by a related TourneyRoundStatus object
	 *
	 * @param     TourneyRoundStatus|PropelCollection $tourneyRoundStatus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyRoundStatusRelatedByRoundNumber($tourneyRoundStatus, $comparison = null)
	{
		if ($tourneyRoundStatus instanceof TourneyRoundStatus) {
			return $this
				->addUsingAlias(TourneyFightsPeer::ROUND_NUMBER, $tourneyRoundStatus->getRoundNumber(), $comparison);
		} elseif ($tourneyRoundStatus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightsPeer::ROUND_NUMBER, $tourneyRoundStatus->toKeyValue('PrimaryKey', 'RoundNumber'), $comparison);
		} else {
			throw new PropelException('filterByTourneyRoundStatusRelatedByRoundNumber() only accepts arguments of type TourneyRoundStatus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyRoundStatusRelatedByRoundNumber relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function joinTourneyRoundStatusRelatedByRoundNumber($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyRoundStatusRelatedByRoundNumber');

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
			$this->addJoinObject($join, 'TourneyRoundStatusRelatedByRoundNumber');
		}

		return $this;
	}

	/**
	 * Use the TourneyRoundStatusRelatedByRoundNumber relation TourneyRoundStatus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyRoundStatusQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyRoundStatusRelatedByRoundNumberQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyRoundStatusRelatedByRoundNumber($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyRoundStatusRelatedByRoundNumber', 'TourneyRoundStatusQuery');
	}

	/**
	 * Filter the query by a related Fights object
	 *
	 * @param     Fights|PropelCollection $fights The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByFights($fights, $comparison = null)
	{
		if ($fights instanceof Fights) {
			return $this
				->addUsingAlias(TourneyFightsPeer::GENERAL_FIGHT_ID, $fights->getId(), $comparison);
		} elseif ($fights instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightsPeer::GENERAL_FIGHT_ID, $fights->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    TourneyFightsQuery The current query, for fluid interface
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
	 * Filter the query by a related TourneyFighters object
	 *
	 * @param     TourneyFighters|PropelCollection $tourneyFighters The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightersRelatedByOneid($tourneyFighters, $comparison = null)
	{
		if ($tourneyFighters instanceof TourneyFighters) {
			return $this
				->addUsingAlias(TourneyFightsPeer::ONEID, $tourneyFighters->getFighterId(), $comparison);
		} elseif ($tourneyFighters instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightsPeer::ONEID, $tourneyFighters->toKeyValue('PrimaryKey', 'FighterId'), $comparison);
		} else {
			throw new PropelException('filterByTourneyFightersRelatedByOneid() only accepts arguments of type TourneyFighters or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightersRelatedByOneid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function joinTourneyFightersRelatedByOneid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightersRelatedByOneid');

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
			$this->addJoinObject($join, 'TourneyFightersRelatedByOneid');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightersRelatedByOneid relation TourneyFighters object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightersRelatedByOneidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightersRelatedByOneid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightersRelatedByOneid', 'TourneyFightersQuery');
	}

	/**
	 * Filter the query by a related TourneyFighters object
	 *
	 * @param     TourneyFighters|PropelCollection $tourneyFighters The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyFightersRelatedByTwoid($tourneyFighters, $comparison = null)
	{
		if ($tourneyFighters instanceof TourneyFighters) {
			return $this
				->addUsingAlias(TourneyFightsPeer::TWOID, $tourneyFighters->getFighterId(), $comparison);
		} elseif ($tourneyFighters instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TourneyFightsPeer::TWOID, $tourneyFighters->toKeyValue('PrimaryKey', 'FighterId'), $comparison);
		} else {
			throw new PropelException('filterByTourneyFightersRelatedByTwoid() only accepts arguments of type TourneyFighters or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the TourneyFightersRelatedByTwoid relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function joinTourneyFightersRelatedByTwoid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('TourneyFightersRelatedByTwoid');

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
			$this->addJoinObject($join, 'TourneyFightersRelatedByTwoid');
		}

		return $this;
	}

	/**
	 * Use the TourneyFightersRelatedByTwoid relation TourneyFighters object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TourneyFightersQuery A secondary query class using the current class as primary query
	 */
	public function useTourneyFightersRelatedByTwoidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinTourneyFightersRelatedByTwoid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'TourneyFightersRelatedByTwoid', 'TourneyFightersQuery');
	}

	/**
	 * Filter the query by a related TourneyUserAction object
	 *
	 * @param     TourneyUserAction $tourneyUserAction  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function filterByTourneyUserAction($tourneyUserAction, $comparison = null)
	{
		if ($tourneyUserAction instanceof TourneyUserAction) {
			return $this
				->addUsingAlias(TourneyFightsPeer::ID, $tourneyUserAction->getFightId(), $comparison);
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
	 * @return    TourneyFightsQuery The current query, for fluid interface
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
	 * @param     TourneyFights $tourneyFights Object to remove from the list of results
	 *
	 * @return    TourneyFightsQuery The current query, for fluid interface
	 */
	public function prune($tourneyFights = null)
	{
		if ($tourneyFights) {
			$this->addUsingAlias(TourneyFightsPeer::ID, $tourneyFights->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseTourneyFightsQuery