<?php


/**
 * Base static class for performing query and update operations on the 'tourney_fights' table.
 *
 * Listing and recording of tournament fights.
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyFightsPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'cbf';

	/** the table name for this class */
	const TABLE_NAME = 'tourney_fights';

	/** the related Propel class for this table */
	const OM_CLASS = 'TourneyFights';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'models.TourneyFights';

	/** the related TableMap class for this table */
	const TM_CLASS = 'TourneyFightsTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 11;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 11;

	/** the column name for the ID field */
	const ID = 'tourney_fights.ID';

	/** the column name for the TOURNEY_ID field */
	const TOURNEY_ID = 'tourney_fights.TOURNEY_ID';

	/** the column name for the ROUND_NUMBER field */
	const ROUND_NUMBER = 'tourney_fights.ROUND_NUMBER';

	/** the column name for the GENERAL_FIGHT_ID field */
	const GENERAL_FIGHT_ID = 'tourney_fights.GENERAL_FIGHT_ID';

	/** the column name for the ONEID field */
	const ONEID = 'tourney_fights.ONEID';

	/** the column name for the TWOID field */
	const TWOID = 'tourney_fights.TWOID';

	/** the column name for the ONEWINS field */
	const ONEWINS = 'tourney_fights.ONEWINS';

	/** the column name for the TWOWINS field */
	const TWOWINS = 'tourney_fights.TWOWINS';

	/** the column name for the CHILD_RIGHT field */
	const CHILD_RIGHT = 'tourney_fights.CHILD_RIGHT';

	/** the column name for the CHILD_LEFT field */
	const CHILD_LEFT = 'tourney_fights.CHILD_LEFT';

	/** the column name for the PARENT field */
	const PARENT = 'tourney_fights.PARENT';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of TourneyFights objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array TourneyFights[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TourneyId', 'RoundNumber', 'GeneralFightId', 'Oneid', 'Twoid', 'Onewins', 'Twowins', 'ChildRight', 'ChildLeft', 'Parent', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'tourneyId', 'roundNumber', 'generalFightId', 'oneid', 'twoid', 'onewins', 'twowins', 'childRight', 'childLeft', 'parent', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TOURNEY_ID, self::ROUND_NUMBER, self::GENERAL_FIGHT_ID, self::ONEID, self::TWOID, self::ONEWINS, self::TWOWINS, self::CHILD_RIGHT, self::CHILD_LEFT, self::PARENT, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TOURNEY_ID', 'ROUND_NUMBER', 'GENERAL_FIGHT_ID', 'ONEID', 'TWOID', 'ONEWINS', 'TWOWINS', 'CHILD_RIGHT', 'CHILD_LEFT', 'PARENT', ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'tourney_id', 'round_number', 'general_fight_id', 'oneID', 'twoID', 'oneWins', 'twoWins', 'child_right', 'child_left', 'parent', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TourneyId' => 1, 'RoundNumber' => 2, 'GeneralFightId' => 3, 'Oneid' => 4, 'Twoid' => 5, 'Onewins' => 6, 'Twowins' => 7, 'ChildRight' => 8, 'ChildLeft' => 9, 'Parent' => 10, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'tourneyId' => 1, 'roundNumber' => 2, 'generalFightId' => 3, 'oneid' => 4, 'twoid' => 5, 'onewins' => 6, 'twowins' => 7, 'childRight' => 8, 'childLeft' => 9, 'parent' => 10, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TOURNEY_ID => 1, self::ROUND_NUMBER => 2, self::GENERAL_FIGHT_ID => 3, self::ONEID => 4, self::TWOID => 5, self::ONEWINS => 6, self::TWOWINS => 7, self::CHILD_RIGHT => 8, self::CHILD_LEFT => 9, self::PARENT => 10, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TOURNEY_ID' => 1, 'ROUND_NUMBER' => 2, 'GENERAL_FIGHT_ID' => 3, 'ONEID' => 4, 'TWOID' => 5, 'ONEWINS' => 6, 'TWOWINS' => 7, 'CHILD_RIGHT' => 8, 'CHILD_LEFT' => 9, 'PARENT' => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'tourney_id' => 1, 'round_number' => 2, 'general_fight_id' => 3, 'oneID' => 4, 'twoID' => 5, 'oneWins' => 6, 'twoWins' => 7, 'child_right' => 8, 'child_left' => 9, 'parent' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. TourneyFightsPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(TourneyFightsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(TourneyFightsPeer::ID);
			$criteria->addSelectColumn(TourneyFightsPeer::TOURNEY_ID);
			$criteria->addSelectColumn(TourneyFightsPeer::ROUND_NUMBER);
			$criteria->addSelectColumn(TourneyFightsPeer::GENERAL_FIGHT_ID);
			$criteria->addSelectColumn(TourneyFightsPeer::ONEID);
			$criteria->addSelectColumn(TourneyFightsPeer::TWOID);
			$criteria->addSelectColumn(TourneyFightsPeer::ONEWINS);
			$criteria->addSelectColumn(TourneyFightsPeer::TWOWINS);
			$criteria->addSelectColumn(TourneyFightsPeer::CHILD_RIGHT);
			$criteria->addSelectColumn(TourneyFightsPeer::CHILD_LEFT);
			$criteria->addSelectColumn(TourneyFightsPeer::PARENT);
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.TOURNEY_ID');
			$criteria->addSelectColumn($alias . '.ROUND_NUMBER');
			$criteria->addSelectColumn($alias . '.GENERAL_FIGHT_ID');
			$criteria->addSelectColumn($alias . '.ONEID');
			$criteria->addSelectColumn($alias . '.TWOID');
			$criteria->addSelectColumn($alias . '.ONEWINS');
			$criteria->addSelectColumn($alias . '.TWOWINS');
			$criteria->addSelectColumn($alias . '.CHILD_RIGHT');
			$criteria->addSelectColumn($alias . '.CHILD_LEFT');
			$criteria->addSelectColumn($alias . '.PARENT');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Selects one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     TourneyFights
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = TourneyFightsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Selects several row from the DB.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TourneyFightsPeer::populateObjects(TourneyFightsPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      TourneyFights $value A TourneyFights object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A TourneyFights object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TourneyFights) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TourneyFights object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     TourneyFights Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to tourney_fights
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// Invalidate objects in TourneyUserActionPeer instance pool,
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		TourneyUserActionPeer::clearInstancePool();
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * Retrieves the primary key from the DB resultset row
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return (int) $row[$startcol];
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = TourneyFightsPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TourneyFightsPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TourneyFightsPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (TourneyFights object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = TourneyFightsPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = TourneyFightsPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			TourneyFightsPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyRoundStatusRelatedByTourneyId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTourneyRoundStatusRelatedByTourneyId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyRoundStatusRelatedByRoundNumber table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTourneyRoundStatusRelatedByRoundNumber(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Fights table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFights(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyFightersRelatedByOneid table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTourneyFightersRelatedByOneid(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyFightersRelatedByTwoid table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTourneyFightersRelatedByTwoid(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with their TourneyRoundStatus objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTourneyRoundStatusRelatedByTourneyId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		TourneyRoundStatusPeer::addSelectColumns($criteria);

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TourneyFights) to $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByTourneyId($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with their TourneyRoundStatus objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTourneyRoundStatusRelatedByRoundNumber(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		TourneyRoundStatusPeer::addSelectColumns($criteria);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TourneyFights) to $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByRoundNumber($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with their Fights objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFights(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		FightsPeer::addSelectColumns($criteria);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FightsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = FightsPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FightsPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TourneyFights) to $obj2 (Fights)
				$obj2->addTourneyFights($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with their TourneyFighters objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTourneyFightersRelatedByOneid(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		TourneyFightersPeer::addSelectColumns($criteria);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TourneyFightersPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TourneyFightersPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TourneyFightersPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TourneyFights) to $obj2 (TourneyFighters)
				$obj2->addTourneyFightsRelatedByOneid($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with their TourneyFighters objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTourneyFightersRelatedByTwoid(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;
		TourneyFightersPeer::addSelectColumns($criteria);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TourneyFightersPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TourneyFightersPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TourneyFightersPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TourneyFights) to $obj2 (TourneyFighters)
				$obj2->addTourneyFightsRelatedByTwoid($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		FightsPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + FightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol7 = $startcol6 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined TourneyRoundStatus rows

			$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByTourneyId($obj1);
			} // if joined row not null

			// Add objects for joined TourneyRoundStatus rows

			$key3 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TourneyRoundStatusPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyRoundStatusPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyRoundStatus)
				$obj3->addTourneyFightsRelatedByRoundNumber($obj1);
			} // if joined row not null

			// Add objects for joined Fights rows

			$key4 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = FightsPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = FightsPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					FightsPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (Fights)
				$obj4->addTourneyFights($obj1);
			} // if joined row not null

			// Add objects for joined TourneyFighters rows

			$key5 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = TourneyFightersPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$cls = TourneyFightersPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TourneyFightersPeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj5 (TourneyFighters)
				$obj5->addTourneyFightsRelatedByOneid($obj1);
			} // if joined row not null

			// Add objects for joined TourneyFighters rows

			$key6 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = TourneyFightersPeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$cls = TourneyFightersPeer::getOMClass(false);

					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TourneyFightersPeer::addInstanceToPool($obj6, $key6);
				} // if obj6 loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj6 (TourneyFighters)
				$obj6->addTourneyFightsRelatedByTwoid($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyRoundStatusRelatedByTourneyId table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTourneyRoundStatusRelatedByTourneyId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyRoundStatusRelatedByRoundNumber table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTourneyRoundStatusRelatedByRoundNumber(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Fights table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptFights(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyFightersRelatedByOneid table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTourneyFightersRelatedByOneid(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TourneyFightersRelatedByTwoid table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTourneyFightersRelatedByTwoid(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TourneyFightsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects except TourneyRoundStatusRelatedByTourneyId.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTourneyRoundStatusRelatedByTourneyId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		FightsPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + FightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Fights rows

				$key2 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = FightsPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = FightsPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FightsPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (Fights)
				$obj2->addTourneyFights($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key3 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TourneyFightersPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyFightersPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyFighters)
				$obj3->addTourneyFightsRelatedByOneid($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key4 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TourneyFightersPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TourneyFightersPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (TourneyFighters)
				$obj4->addTourneyFightsRelatedByTwoid($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects except TourneyRoundStatusRelatedByRoundNumber.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTourneyRoundStatusRelatedByRoundNumber(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		FightsPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + FightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Fights rows

				$key2 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = FightsPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = FightsPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FightsPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (Fights)
				$obj2->addTourneyFights($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key3 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TourneyFightersPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyFightersPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyFighters)
				$obj3->addTourneyFightsRelatedByOneid($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key4 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TourneyFightersPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TourneyFightersPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (TourneyFighters)
				$obj4->addTourneyFightsRelatedByTwoid($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects except Fights.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptFights(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		TourneyFightersPeer::addSelectColumns($criteria);
		$startcol6 = $startcol5 + TourneyFightersPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ONEID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::TWOID, TourneyFightersPeer::FIGHTER_ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined TourneyRoundStatus rows

				$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByTourneyId($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyRoundStatus rows

				$key3 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TourneyRoundStatusPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyRoundStatusPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyRoundStatus)
				$obj3->addTourneyFightsRelatedByRoundNumber($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key4 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TourneyFightersPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TourneyFightersPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (TourneyFighters)
				$obj4->addTourneyFightsRelatedByOneid($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyFighters rows

				$key5 = TourneyFightersPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = TourneyFightersPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$cls = TourneyFightersPeer::getOMClass(false);

					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					TourneyFightersPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj5 (TourneyFighters)
				$obj5->addTourneyFightsRelatedByTwoid($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects except TourneyFightersRelatedByOneid.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTourneyFightersRelatedByOneid(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		FightsPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + FightsPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined TourneyRoundStatus rows

				$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByTourneyId($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyRoundStatus rows

				$key3 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TourneyRoundStatusPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyRoundStatusPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyRoundStatus)
				$obj3->addTourneyFightsRelatedByRoundNumber($obj1);

			} // if joined row is not null

				// Add objects for joined Fights rows

				$key4 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = FightsPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = FightsPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					FightsPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (Fights)
				$obj4->addTourneyFights($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of TourneyFights objects pre-filled with all related objects except TourneyFightersRelatedByTwoid.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of TourneyFights objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTourneyFightersRelatedByTwoid(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		TourneyFightsPeer::addSelectColumns($criteria);
		$startcol2 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		TourneyRoundStatusPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS;

		FightsPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + FightsPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(TourneyFightsPeer::TOURNEY_ID, TourneyRoundStatusPeer::TOURNEY_ID, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::ROUND_NUMBER, TourneyRoundStatusPeer::ROUND_NUMBER, $join_behavior);

		$criteria->addJoin(TourneyFightsPeer::GENERAL_FIGHT_ID, FightsPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TourneyFightsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TourneyFightsPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = TourneyFightsPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				TourneyFightsPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined TourneyRoundStatus rows

				$key2 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TourneyRoundStatusPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TourneyRoundStatusPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj2 (TourneyRoundStatus)
				$obj2->addTourneyFightsRelatedByTourneyId($obj1);

			} // if joined row is not null

				// Add objects for joined TourneyRoundStatus rows

				$key3 = TourneyRoundStatusPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TourneyRoundStatusPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = TourneyRoundStatusPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TourneyRoundStatusPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj3 (TourneyRoundStatus)
				$obj3->addTourneyFightsRelatedByRoundNumber($obj1);

			} // if joined row is not null

				// Add objects for joined Fights rows

				$key4 = FightsPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = FightsPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$cls = FightsPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					FightsPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (TourneyFights) to the collection in $obj4 (Fights)
				$obj4->addTourneyFights($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseTourneyFightsPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseTourneyFightsPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new TourneyFightsTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean $withPrefix Whether or not to return the path with the class name
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? TourneyFightsPeer::CLASS_DEFAULT : TourneyFightsPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a TourneyFights or Criteria object.
	 *
	 * @param      mixed $values Criteria or TourneyFights object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from TourneyFights object
		}

		if ($criteria->containsKey(TourneyFightsPeer::ID) && $criteria->keyContainsValue(TourneyFightsPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.TourneyFightsPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Performs an UPDATE on the database, given a TourneyFights or Criteria object.
	 *
	 * @param      mixed $values Criteria or TourneyFights object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(TourneyFightsPeer::ID);
			$value = $criteria->remove(TourneyFightsPeer::ID);
			if ($value) {
				$selectCriteria->add(TourneyFightsPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(TourneyFightsPeer::TABLE_NAME);
			}

		} else { // $values is TourneyFights object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the tourney_fights table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += TourneyFightsPeer::doOnDeleteCascade(new Criteria(TourneyFightsPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(TourneyFightsPeer::TABLE_NAME, $con, TourneyFightsPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			TourneyFightsPeer::clearInstancePool();
			TourneyFightsPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a TourneyFights or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or TourneyFights object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof TourneyFights) { // it's a model object
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TourneyFightsPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			// cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
			$c = clone $criteria;
			$affectedRows += TourneyFightsPeer::doOnDeleteCascade($c, $con);
			
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			if ($values instanceof Criteria) {
				TourneyFightsPeer::clearInstancePool();
			} elseif ($values instanceof TourneyFights) { // it's a model object
				TourneyFightsPeer::removeInstanceFromPool($values);
			} else { // it's a primary key, or an array of pks
				foreach ((array) $values as $singleval) {
					TourneyFightsPeer::removeInstanceFromPool($singleval);
				}
			}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			TourneyFightsPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = TourneyFightsPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related TourneyUserAction objects
			$criteria = new Criteria(TourneyUserActionPeer::DATABASE_NAME);
			
			$criteria->add(TourneyUserActionPeer::FIGHT_ID, $obj->getId());
			$affectedRows += TourneyUserActionPeer::doDelete($criteria, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given TourneyFights object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      TourneyFights $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TourneyFightsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TourneyFightsPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(TourneyFightsPeer::DATABASE_NAME, TourneyFightsPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     TourneyFights
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TourneyFightsPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TourneyFightsPeer::DATABASE_NAME);
		$criteria->add(TourneyFightsPeer::ID, $pk);

		$v = TourneyFightsPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TourneyFightsPeer::DATABASE_NAME);
			$criteria->add(TourneyFightsPeer::ID, $pks, Criteria::IN);
			$objs = TourneyFightsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseTourneyFightsPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTourneyFightsPeer::buildTableMap();

