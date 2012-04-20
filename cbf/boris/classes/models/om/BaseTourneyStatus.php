<?php


/**
 * Base class that represents a row from the 'tourney_status' table.
 *
 * General status of the tournament.
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyStatus extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'TourneyStatusPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TourneyStatusPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the active field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $active;

	/**
	 * The value for the start_time field.
	 * @var        string
	 */
	protected $start_time;

	/**
	 * The value for the end_time field.
	 * @var        string
	 */
	protected $end_time;

	/**
	 * The value for the round_number field.
	 * @var        int
	 */
	protected $round_number;

	/**
	 * The value for the root field.
	 * @var        int
	 */
	protected $root;

	/**
	 * @var        array TourneyRoundStatus[] Collection to store aggregation of TourneyRoundStatus objects.
	 */
	protected $collTourneyRoundStatuss;

	/**
	 * @var        array TourneyFighters[] Collection to store aggregation of TourneyFighters objects.
	 */
	protected $collTourneyFighterss;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyRoundStatussScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyFighterssScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->active = false;
	}

	/**
	 * Initializes internal state of BaseTourneyStatus object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * ID Number for the tournament.
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [active] column value.
	 * Indicates if the tourney is active.
	 * @return     boolean
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Get the [optionally formatted] temporal [start_time] column value.
	 * Records when the tournament started.
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getStartTime($format = 'Y-m-d H:i:s')
	{
		if ($this->start_time === null) {
			return null;
		}


		if ($this->start_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->start_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->start_time, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [end_time] column value.
	 * Records when the tournament ended.
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getEndTime($format = 'Y-m-d H:i:s')
	{
		if ($this->end_time === null) {
			return null;
		}


		if ($this->end_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->end_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->end_time, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [round_number] column value.
	 * Indicates which round of the tournament is occuring
	 * @return     int
	 */
	public function getRoundNumber()
	{
		return $this->round_number;
	}

	/**
	 * Get the [root] column value.
	 * ID of the root node of the fight bracket.
	 * @return     int
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * Set the value of [id] column.
	 * ID Number for the tournament.
	 * @param      int $v new value
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TourneyStatusPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Sets the value of the [active] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indicates if the tourney is active.
	 * @param      boolean|integer|string $v The new value
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = TourneyStatusPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Sets the value of [start_time] column to a normalized version of the date/time value specified.
	 * Records when the tournament started.
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setStartTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->start_time !== null || $dt !== null) {
			$currentDateAsString = ($this->start_time !== null && $tmpDt = new DateTime($this->start_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->start_time = $newDateAsString;
				$this->modifiedColumns[] = TourneyStatusPeer::START_TIME;
			}
		} // if either are not null

		return $this;
	} // setStartTime()

	/**
	 * Sets the value of [end_time] column to a normalized version of the date/time value specified.
	 * Records when the tournament ended.
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setEndTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->end_time !== null || $dt !== null) {
			$currentDateAsString = ($this->end_time !== null && $tmpDt = new DateTime($this->end_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->end_time = $newDateAsString;
				$this->modifiedColumns[] = TourneyStatusPeer::END_TIME;
			}
		} // if either are not null

		return $this;
	} // setEndTime()

	/**
	 * Set the value of [round_number] column.
	 * Indicates which round of the tournament is occuring
	 * @param      int $v new value
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setRoundNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->round_number !== $v) {
			$this->round_number = $v;
			$this->modifiedColumns[] = TourneyStatusPeer::ROUND_NUMBER;
		}

		return $this;
	} // setRoundNumber()

	/**
	 * Set the value of [root] column.
	 * ID of the root node of the fight bracket.
	 * @param      int $v new value
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function setRoot($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->root !== $v) {
			$this->root = $v;
			$this->modifiedColumns[] = TourneyStatusPeer::ROOT;
		}

		return $this;
	} // setRoot()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->active !== false) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->active = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
			$this->start_time = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->end_time = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->round_number = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->root = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = TourneyStatusPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating TourneyStatus object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TourneyStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TourneyStatusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collTourneyRoundStatuss = null;

			$this->collTourneyFighterss = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TourneyStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = TourneyStatusQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TourneyStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				TourneyStatusPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->tourneyRoundStatussScheduledForDeletion !== null) {
				if (!$this->tourneyRoundStatussScheduledForDeletion->isEmpty()) {
					TourneyRoundStatusQuery::create()
						->filterByPrimaryKeys($this->tourneyRoundStatussScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyRoundStatussScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyRoundStatuss !== null) {
				foreach ($this->collTourneyRoundStatuss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->tourneyFighterssScheduledForDeletion !== null) {
				if (!$this->tourneyFighterssScheduledForDeletion->isEmpty()) {
					TourneyFightersQuery::create()
						->filterByPrimaryKeys($this->tourneyFighterssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFighterssScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFighterss !== null) {
				foreach ($this->collTourneyFighterss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = TourneyStatusPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . TourneyStatusPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(TourneyStatusPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(TourneyStatusPeer::ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`ACTIVE`';
		}
		if ($this->isColumnModified(TourneyStatusPeer::START_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`START_TIME`';
		}
		if ($this->isColumnModified(TourneyStatusPeer::END_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`END_TIME`';
		}
		if ($this->isColumnModified(TourneyStatusPeer::ROUND_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`ROUND_NUMBER`';
		}
		if ($this->isColumnModified(TourneyStatusPeer::ROOT)) {
			$modifiedColumns[':p' . $index++]  = '`ROOT`';
		}

		$sql = sprintf(
			'INSERT INTO `tourney_status` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`ACTIVE`':
						$stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
						break;
					case '`START_TIME`':
						$stmt->bindValue($identifier, $this->start_time, PDO::PARAM_STR);
						break;
					case '`END_TIME`':
						$stmt->bindValue($identifier, $this->end_time, PDO::PARAM_STR);
						break;
					case '`ROUND_NUMBER`':
						$stmt->bindValue($identifier, $this->round_number, PDO::PARAM_INT);
						break;
					case '`ROOT`':
						$stmt->bindValue($identifier, $this->root, PDO::PARAM_INT);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = TourneyStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTourneyRoundStatuss !== null) {
					foreach ($this->collTourneyRoundStatuss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTourneyFighterss !== null) {
					foreach ($this->collTourneyFighterss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TourneyStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getActive();
				break;
			case 2:
				return $this->getStartTime();
				break;
			case 3:
				return $this->getEndTime();
				break;
			case 4:
				return $this->getRoundNumber();
				break;
			case 5:
				return $this->getRoot();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['TourneyStatus'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['TourneyStatus'][$this->getPrimaryKey()] = true;
		$keys = TourneyStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getActive(),
			$keys[2] => $this->getStartTime(),
			$keys[3] => $this->getEndTime(),
			$keys[4] => $this->getRoundNumber(),
			$keys[5] => $this->getRoot(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collTourneyRoundStatuss) {
				$result['TourneyRoundStatuss'] = $this->collTourneyRoundStatuss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collTourneyFighterss) {
				$result['TourneyFighterss'] = $this->collTourneyFighterss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TourneyStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setActive($value);
				break;
			case 2:
				$this->setStartTime($value);
				break;
			case 3:
				$this->setEndTime($value);
				break;
			case 4:
				$this->setRoundNumber($value);
				break;
			case 5:
				$this->setRoot($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TourneyStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setActive($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStartTime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEndTime($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRoundNumber($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRoot($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TourneyStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(TourneyStatusPeer::ID)) $criteria->add(TourneyStatusPeer::ID, $this->id);
		if ($this->isColumnModified(TourneyStatusPeer::ACTIVE)) $criteria->add(TourneyStatusPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(TourneyStatusPeer::START_TIME)) $criteria->add(TourneyStatusPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(TourneyStatusPeer::END_TIME)) $criteria->add(TourneyStatusPeer::END_TIME, $this->end_time);
		if ($this->isColumnModified(TourneyStatusPeer::ROUND_NUMBER)) $criteria->add(TourneyStatusPeer::ROUND_NUMBER, $this->round_number);
		if ($this->isColumnModified(TourneyStatusPeer::ROOT)) $criteria->add(TourneyStatusPeer::ROOT, $this->root);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TourneyStatusPeer::DATABASE_NAME);
		$criteria->add(TourneyStatusPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TourneyStatus (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setActive($this->getActive());
		$copyObj->setStartTime($this->getStartTime());
		$copyObj->setEndTime($this->getEndTime());
		$copyObj->setRoundNumber($this->getRoundNumber());
		$copyObj->setRoot($this->getRoot());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getTourneyRoundStatuss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyRoundStatus($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTourneyFighterss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFighters($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     TourneyStatus Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     TourneyStatusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TourneyStatusPeer();
		}
		return self::$peer;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('TourneyRoundStatus' == $relationName) {
			return $this->initTourneyRoundStatuss();
		}
		if ('TourneyFighters' == $relationName) {
			return $this->initTourneyFighterss();
		}
	}

	/**
	 * Clears out the collTourneyRoundStatuss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyRoundStatuss()
	 */
	public function clearTourneyRoundStatuss()
	{
		$this->collTourneyRoundStatuss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyRoundStatuss collection.
	 *
	 * By default this just sets the collTourneyRoundStatuss collection to an empty array (like clearcollTourneyRoundStatuss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyRoundStatuss($overrideExisting = true)
	{
		if (null !== $this->collTourneyRoundStatuss && !$overrideExisting) {
			return;
		}
		$this->collTourneyRoundStatuss = new PropelObjectCollection();
		$this->collTourneyRoundStatuss->setModel('TourneyRoundStatus');
	}

	/**
	 * Gets an array of TourneyRoundStatus objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyStatus is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyRoundStatus[] List of TourneyRoundStatus objects
	 * @throws     PropelException
	 */
	public function getTourneyRoundStatuss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyRoundStatuss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyRoundStatuss) {
				// return empty collection
				$this->initTourneyRoundStatuss();
			} else {
				$collTourneyRoundStatuss = TourneyRoundStatusQuery::create(null, $criteria)
					->filterByTourneyStatus($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyRoundStatuss;
				}
				$this->collTourneyRoundStatuss = $collTourneyRoundStatuss;
			}
		}
		return $this->collTourneyRoundStatuss;
	}

	/**
	 * Sets a collection of TourneyRoundStatus objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyRoundStatuss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyRoundStatuss(PropelCollection $tourneyRoundStatuss, PropelPDO $con = null)
	{
		$this->tourneyRoundStatussScheduledForDeletion = $this->getTourneyRoundStatuss(new Criteria(), $con)->diff($tourneyRoundStatuss);

		foreach ($tourneyRoundStatuss as $tourneyRoundStatus) {
			// Fix issue with collection modified by reference
			if ($tourneyRoundStatus->isNew()) {
				$tourneyRoundStatus->setTourneyStatus($this);
			}
			$this->addTourneyRoundStatus($tourneyRoundStatus);
		}

		$this->collTourneyRoundStatuss = $tourneyRoundStatuss;
	}

	/**
	 * Returns the number of related TourneyRoundStatus objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TourneyRoundStatus objects.
	 * @throws     PropelException
	 */
	public function countTourneyRoundStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyRoundStatuss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyRoundStatuss) {
				return 0;
			} else {
				$query = TourneyRoundStatusQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyStatus($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyRoundStatuss);
		}
	}

	/**
	 * Method called to associate a TourneyRoundStatus object to this object
	 * through the TourneyRoundStatus foreign key attribute.
	 *
	 * @param      TourneyRoundStatus $l TourneyRoundStatus
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function addTourneyRoundStatus(TourneyRoundStatus $l)
	{
		if ($this->collTourneyRoundStatuss === null) {
			$this->initTourneyRoundStatuss();
		}
		if (!$this->collTourneyRoundStatuss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyRoundStatus($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyRoundStatus $tourneyRoundStatus The tourneyRoundStatus object to add.
	 */
	protected function doAddTourneyRoundStatus($tourneyRoundStatus)
	{
		$this->collTourneyRoundStatuss[]= $tourneyRoundStatus;
		$tourneyRoundStatus->setTourneyStatus($this);
	}

	/**
	 * Clears out the collTourneyFighterss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFighterss()
	 */
	public function clearTourneyFighterss()
	{
		$this->collTourneyFighterss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFighterss collection.
	 *
	 * By default this just sets the collTourneyFighterss collection to an empty array (like clearcollTourneyFighterss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFighterss($overrideExisting = true)
	{
		if (null !== $this->collTourneyFighterss && !$overrideExisting) {
			return;
		}
		$this->collTourneyFighterss = new PropelObjectCollection();
		$this->collTourneyFighterss->setModel('TourneyFighters');
	}

	/**
	 * Gets an array of TourneyFighters objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyStatus is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFighters[] List of TourneyFighters objects
	 * @throws     PropelException
	 */
	public function getTourneyFighterss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFighterss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFighterss) {
				// return empty collection
				$this->initTourneyFighterss();
			} else {
				$collTourneyFighterss = TourneyFightersQuery::create(null, $criteria)
					->filterByTourneyStatus($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFighterss;
				}
				$this->collTourneyFighterss = $collTourneyFighterss;
			}
		}
		return $this->collTourneyFighterss;
	}

	/**
	 * Sets a collection of TourneyFighters objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFighterss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFighterss(PropelCollection $tourneyFighterss, PropelPDO $con = null)
	{
		$this->tourneyFighterssScheduledForDeletion = $this->getTourneyFighterss(new Criteria(), $con)->diff($tourneyFighterss);

		foreach ($tourneyFighterss as $tourneyFighters) {
			// Fix issue with collection modified by reference
			if ($tourneyFighters->isNew()) {
				$tourneyFighters->setTourneyStatus($this);
			}
			$this->addTourneyFighters($tourneyFighters);
		}

		$this->collTourneyFighterss = $tourneyFighterss;
	}

	/**
	 * Returns the number of related TourneyFighters objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TourneyFighters objects.
	 * @throws     PropelException
	 */
	public function countTourneyFighterss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFighterss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFighterss) {
				return 0;
			} else {
				$query = TourneyFightersQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyStatus($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFighterss);
		}
	}

	/**
	 * Method called to associate a TourneyFighters object to this object
	 * through the TourneyFighters foreign key attribute.
	 *
	 * @param      TourneyFighters $l TourneyFighters
	 * @return     TourneyStatus The current object (for fluent API support)
	 */
	public function addTourneyFighters(TourneyFighters $l)
	{
		if ($this->collTourneyFighterss === null) {
			$this->initTourneyFighterss();
		}
		if (!$this->collTourneyFighterss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFighters($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFighters $tourneyFighters The tourneyFighters object to add.
	 */
	protected function doAddTourneyFighters($tourneyFighters)
	{
		$this->collTourneyFighterss[]= $tourneyFighters;
		$tourneyFighters->setTourneyStatus($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyStatus is new, it will return
	 * an empty collection; or if this TourneyStatus has previously
	 * been saved, it will retrieve related TourneyFighterss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFighters[] List of TourneyFighters objects
	 */
	public function getTourneyFighterssJoinNames($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightersQuery::create(null, $criteria);
		$query->joinWith('Names', $join_behavior);

		return $this->getTourneyFighterss($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->active = null;
		$this->start_time = null;
		$this->end_time = null;
		$this->round_number = null;
		$this->root = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTourneyRoundStatuss) {
				foreach ($this->collTourneyRoundStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyFighterss) {
				foreach ($this->collTourneyFighterss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collTourneyRoundStatuss instanceof PropelCollection) {
			$this->collTourneyRoundStatuss->clearIterator();
		}
		$this->collTourneyRoundStatuss = null;
		if ($this->collTourneyFighterss instanceof PropelCollection) {
			$this->collTourneyFighterss->clearIterator();
		}
		$this->collTourneyFighterss = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(TourneyStatusPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseTourneyStatus
