<?php


/**
 * Base class that represents a row from the 'tourney_round_status' table.
 *
 * Status of a round of the tournament.
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyRoundStatus extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'TourneyRoundStatusPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TourneyRoundStatusPeer
	 */
	protected static $peer;

	/**
	 * The value for the tourney_id field.
	 * @var        int
	 */
	protected $tourney_id;

	/**
	 * The value for the round_number field.
	 * @var        int
	 */
	protected $round_number;

	/**
	 * The value for the round_start_time field.
	 * @var        string
	 */
	protected $round_start_time;

	/**
	 * The value for the round_end_time field.
	 * @var        string
	 */
	protected $round_end_time;

	/**
	 * @var        TourneyStatus
	 */
	protected $aTourneyStatus;

	/**
	 * @var        array TourneyFights[] Collection to store aggregation of TourneyFights objects.
	 */
	protected $collTourneyFightssRelatedByTourneyId;

	/**
	 * @var        array TourneyFights[] Collection to store aggregation of TourneyFights objects.
	 */
	protected $collTourneyFightssRelatedByRoundNumber;

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
	protected $tourneyFightssRelatedByTourneyIdScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyFightssRelatedByRoundNumberScheduledForDeletion = null;

	/**
	 * Get the [tourney_id] column value.
	 * ID of the parent tournament.
	 * @return     int
	 */
	public function getTourneyId()
	{
		return $this->tourney_id;
	}

	/**
	 * Get the [round_number] column value.
	 * The Round Number.
	 * @return     int
	 */
	public function getRoundNumber()
	{
		return $this->round_number;
	}

	/**
	 * Get the [optionally formatted] temporal [round_start_time] column value.
	 * Records when the current round started.
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getRoundStartTime($format = 'Y-m-d H:i:s')
	{
		if ($this->round_start_time === null) {
			return null;
		}


		if ($this->round_start_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->round_start_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->round_start_time, true), $x);
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
	 * Get the [optionally formatted] temporal [round_end_time] column value.
	 * Indicates when the current round should end.
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getRoundEndTime($format = 'Y-m-d H:i:s')
	{
		if ($this->round_end_time === null) {
			return null;
		}


		if ($this->round_end_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->round_end_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->round_end_time, true), $x);
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
	 * Set the value of [tourney_id] column.
	 * ID of the parent tournament.
	 * @param      int $v new value
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function setTourneyId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tourney_id !== $v) {
			$this->tourney_id = $v;
			$this->modifiedColumns[] = TourneyRoundStatusPeer::TOURNEY_ID;
		}

		if ($this->aTourneyStatus !== null && $this->aTourneyStatus->getId() !== $v) {
			$this->aTourneyStatus = null;
		}

		return $this;
	} // setTourneyId()

	/**
	 * Set the value of [round_number] column.
	 * The Round Number.
	 * @param      int $v new value
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function setRoundNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->round_number !== $v) {
			$this->round_number = $v;
			$this->modifiedColumns[] = TourneyRoundStatusPeer::ROUND_NUMBER;
		}

		return $this;
	} // setRoundNumber()

	/**
	 * Sets the value of [round_start_time] column to a normalized version of the date/time value specified.
	 * Records when the current round started.
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function setRoundStartTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->round_start_time !== null || $dt !== null) {
			$currentDateAsString = ($this->round_start_time !== null && $tmpDt = new DateTime($this->round_start_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->round_start_time = $newDateAsString;
				$this->modifiedColumns[] = TourneyRoundStatusPeer::ROUND_START_TIME;
			}
		} // if either are not null

		return $this;
	} // setRoundStartTime()

	/**
	 * Sets the value of [round_end_time] column to a normalized version of the date/time value specified.
	 * Indicates when the current round should end.
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function setRoundEndTime($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->round_end_time !== null || $dt !== null) {
			$currentDateAsString = ($this->round_end_time !== null && $tmpDt = new DateTime($this->round_end_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->round_end_time = $newDateAsString;
				$this->modifiedColumns[] = TourneyRoundStatusPeer::ROUND_END_TIME;
			}
		} // if either are not null

		return $this;
	} // setRoundEndTime()

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

			$this->tourney_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->round_number = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->round_start_time = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->round_end_time = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = TourneyRoundStatusPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating TourneyRoundStatus object", $e);
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

		if ($this->aTourneyStatus !== null && $this->tourney_id !== $this->aTourneyStatus->getId()) {
			$this->aTourneyStatus = null;
		}
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
			$con = Propel::getConnection(TourneyRoundStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TourneyRoundStatusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTourneyStatus = null;
			$this->collTourneyFightssRelatedByTourneyId = null;

			$this->collTourneyFightssRelatedByRoundNumber = null;

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
			$con = Propel::getConnection(TourneyRoundStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = TourneyRoundStatusQuery::create()
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
			$con = Propel::getConnection(TourneyRoundStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				TourneyRoundStatusPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTourneyStatus !== null) {
				if ($this->aTourneyStatus->isModified() || $this->aTourneyStatus->isNew()) {
					$affectedRows += $this->aTourneyStatus->save($con);
				}
				$this->setTourneyStatus($this->aTourneyStatus);
			}

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

			if ($this->tourneyFightssRelatedByTourneyIdScheduledForDeletion !== null) {
				if (!$this->tourneyFightssRelatedByTourneyIdScheduledForDeletion->isEmpty()) {
					TourneyFightsQuery::create()
						->filterByPrimaryKeys($this->tourneyFightssRelatedByTourneyIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFightssRelatedByTourneyIdScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFightssRelatedByTourneyId !== null) {
				foreach ($this->collTourneyFightssRelatedByTourneyId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->tourneyFightssRelatedByRoundNumberScheduledForDeletion !== null) {
				if (!$this->tourneyFightssRelatedByRoundNumberScheduledForDeletion->isEmpty()) {
					TourneyFightsQuery::create()
						->filterByPrimaryKeys($this->tourneyFightssRelatedByRoundNumberScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFightssRelatedByRoundNumberScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFightssRelatedByRoundNumber !== null) {
				foreach ($this->collTourneyFightssRelatedByRoundNumber as $referrerFK) {
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


		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(TourneyRoundStatusPeer::TOURNEY_ID)) {
			$modifiedColumns[':p' . $index++]  = '`TOURNEY_ID`';
		}
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`ROUND_NUMBER`';
		}
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_START_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`ROUND_START_TIME`';
		}
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_END_TIME)) {
			$modifiedColumns[':p' . $index++]  = '`ROUND_END_TIME`';
		}

		$sql = sprintf(
			'INSERT INTO `tourney_round_status` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`TOURNEY_ID`':
						$stmt->bindValue($identifier, $this->tourney_id, PDO::PARAM_INT);
						break;
					case '`ROUND_NUMBER`':
						$stmt->bindValue($identifier, $this->round_number, PDO::PARAM_INT);
						break;
					case '`ROUND_START_TIME`':
						$stmt->bindValue($identifier, $this->round_start_time, PDO::PARAM_STR);
						break;
					case '`ROUND_END_TIME`':
						$stmt->bindValue($identifier, $this->round_end_time, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aTourneyStatus !== null) {
				if (!$this->aTourneyStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTourneyStatus->getValidationFailures());
				}
			}


			if (($retval = TourneyRoundStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTourneyFightssRelatedByTourneyId !== null) {
					foreach ($this->collTourneyFightssRelatedByTourneyId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTourneyFightssRelatedByRoundNumber !== null) {
					foreach ($this->collTourneyFightssRelatedByRoundNumber as $referrerFK) {
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
		$pos = TourneyRoundStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTourneyId();
				break;
			case 1:
				return $this->getRoundNumber();
				break;
			case 2:
				return $this->getRoundStartTime();
				break;
			case 3:
				return $this->getRoundEndTime();
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
		if (isset($alreadyDumpedObjects['TourneyRoundStatus'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['TourneyRoundStatus'][serialize($this->getPrimaryKey())] = true;
		$keys = TourneyRoundStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTourneyId(),
			$keys[1] => $this->getRoundNumber(),
			$keys[2] => $this->getRoundStartTime(),
			$keys[3] => $this->getRoundEndTime(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aTourneyStatus) {
				$result['TourneyStatus'] = $this->aTourneyStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collTourneyFightssRelatedByTourneyId) {
				$result['TourneyFightssRelatedByTourneyId'] = $this->collTourneyFightssRelatedByTourneyId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collTourneyFightssRelatedByRoundNumber) {
				$result['TourneyFightssRelatedByRoundNumber'] = $this->collTourneyFightssRelatedByRoundNumber->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = TourneyRoundStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTourneyId($value);
				break;
			case 1:
				$this->setRoundNumber($value);
				break;
			case 2:
				$this->setRoundStartTime($value);
				break;
			case 3:
				$this->setRoundEndTime($value);
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
		$keys = TourneyRoundStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTourneyId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRoundNumber($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoundStartTime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRoundEndTime($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TourneyRoundStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(TourneyRoundStatusPeer::TOURNEY_ID)) $criteria->add(TourneyRoundStatusPeer::TOURNEY_ID, $this->tourney_id);
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_NUMBER)) $criteria->add(TourneyRoundStatusPeer::ROUND_NUMBER, $this->round_number);
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_START_TIME)) $criteria->add(TourneyRoundStatusPeer::ROUND_START_TIME, $this->round_start_time);
		if ($this->isColumnModified(TourneyRoundStatusPeer::ROUND_END_TIME)) $criteria->add(TourneyRoundStatusPeer::ROUND_END_TIME, $this->round_end_time);

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
		$criteria = new Criteria(TourneyRoundStatusPeer::DATABASE_NAME);
		$criteria->add(TourneyRoundStatusPeer::TOURNEY_ID, $this->tourney_id);
		$criteria->add(TourneyRoundStatusPeer::ROUND_NUMBER, $this->round_number);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();
		$pks[0] = $this->getTourneyId();
		$pks[1] = $this->getRoundNumber();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{
		$this->setTourneyId($keys[0]);
		$this->setRoundNumber($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getTourneyId()) && (null === $this->getRoundNumber());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TourneyRoundStatus (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setTourneyId($this->getTourneyId());
		$copyObj->setRoundNumber($this->getRoundNumber());
		$copyObj->setRoundStartTime($this->getRoundStartTime());
		$copyObj->setRoundEndTime($this->getRoundEndTime());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getTourneyFightssRelatedByTourneyId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFightsRelatedByTourneyId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTourneyFightssRelatedByRoundNumber() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFightsRelatedByRoundNumber($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
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
	 * @return     TourneyRoundStatus Clone of current object.
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
	 * @return     TourneyRoundStatusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TourneyRoundStatusPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TourneyStatus object.
	 *
	 * @param      TourneyStatus $v
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTourneyStatus(TourneyStatus $v = null)
	{
		if ($v === null) {
			$this->setTourneyId(NULL);
		} else {
			$this->setTourneyId($v->getId());
		}

		$this->aTourneyStatus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TourneyStatus object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyRoundStatus($this);
		}

		return $this;
	}


	/**
	 * Get the associated TourneyStatus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TourneyStatus The associated TourneyStatus object.
	 * @throws     PropelException
	 */
	public function getTourneyStatus(PropelPDO $con = null)
	{
		if ($this->aTourneyStatus === null && ($this->tourney_id !== null)) {
			$this->aTourneyStatus = TourneyStatusQuery::create()->findPk($this->tourney_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aTourneyStatus->addTourneyRoundStatuss($this);
			 */
		}
		return $this->aTourneyStatus;
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
		if ('TourneyFightsRelatedByTourneyId' == $relationName) {
			return $this->initTourneyFightssRelatedByTourneyId();
		}
		if ('TourneyFightsRelatedByRoundNumber' == $relationName) {
			return $this->initTourneyFightssRelatedByRoundNumber();
		}
	}

	/**
	 * Clears out the collTourneyFightssRelatedByTourneyId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFightssRelatedByTourneyId()
	 */
	public function clearTourneyFightssRelatedByTourneyId()
	{
		$this->collTourneyFightssRelatedByTourneyId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFightssRelatedByTourneyId collection.
	 *
	 * By default this just sets the collTourneyFightssRelatedByTourneyId collection to an empty array (like clearcollTourneyFightssRelatedByTourneyId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFightssRelatedByTourneyId($overrideExisting = true)
	{
		if (null !== $this->collTourneyFightssRelatedByTourneyId && !$overrideExisting) {
			return;
		}
		$this->collTourneyFightssRelatedByTourneyId = new PropelObjectCollection();
		$this->collTourneyFightssRelatedByTourneyId->setModel('TourneyFights');
	}

	/**
	 * Gets an array of TourneyFights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyRoundStatus is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 * @throws     PropelException
	 */
	public function getTourneyFightssRelatedByTourneyId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByTourneyId || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByTourneyId) {
				// return empty collection
				$this->initTourneyFightssRelatedByTourneyId();
			} else {
				$collTourneyFightssRelatedByTourneyId = TourneyFightsQuery::create(null, $criteria)
					->filterByTourneyRoundStatusRelatedByTourneyId($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFightssRelatedByTourneyId;
				}
				$this->collTourneyFightssRelatedByTourneyId = $collTourneyFightssRelatedByTourneyId;
			}
		}
		return $this->collTourneyFightssRelatedByTourneyId;
	}

	/**
	 * Sets a collection of TourneyFightsRelatedByTourneyId objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFightssRelatedByTourneyId A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFightssRelatedByTourneyId(PropelCollection $tourneyFightssRelatedByTourneyId, PropelPDO $con = null)
	{
		$this->tourneyFightssRelatedByTourneyIdScheduledForDeletion = $this->getTourneyFightssRelatedByTourneyId(new Criteria(), $con)->diff($tourneyFightssRelatedByTourneyId);

		foreach ($tourneyFightssRelatedByTourneyId as $tourneyFightsRelatedByTourneyId) {
			// Fix issue with collection modified by reference
			if ($tourneyFightsRelatedByTourneyId->isNew()) {
				$tourneyFightsRelatedByTourneyId->setTourneyRoundStatusRelatedByTourneyId($this);
			}
			$this->addTourneyFightsRelatedByTourneyId($tourneyFightsRelatedByTourneyId);
		}

		$this->collTourneyFightssRelatedByTourneyId = $tourneyFightssRelatedByTourneyId;
	}

	/**
	 * Returns the number of related TourneyFights objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TourneyFights objects.
	 * @throws     PropelException
	 */
	public function countTourneyFightssRelatedByTourneyId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByTourneyId || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByTourneyId) {
				return 0;
			} else {
				$query = TourneyFightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyRoundStatusRelatedByTourneyId($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFightssRelatedByTourneyId);
		}
	}

	/**
	 * Method called to associate a TourneyFights object to this object
	 * through the TourneyFights foreign key attribute.
	 *
	 * @param      TourneyFights $l TourneyFights
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function addTourneyFightsRelatedByTourneyId(TourneyFights $l)
	{
		if ($this->collTourneyFightssRelatedByTourneyId === null) {
			$this->initTourneyFightssRelatedByTourneyId();
		}
		if (!$this->collTourneyFightssRelatedByTourneyId->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFightsRelatedByTourneyId($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFightsRelatedByTourneyId $tourneyFightsRelatedByTourneyId The tourneyFightsRelatedByTourneyId object to add.
	 */
	protected function doAddTourneyFightsRelatedByTourneyId($tourneyFightsRelatedByTourneyId)
	{
		$this->collTourneyFightssRelatedByTourneyId[]= $tourneyFightsRelatedByTourneyId;
		$tourneyFightsRelatedByTourneyId->setTourneyRoundStatusRelatedByTourneyId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTourneyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTourneyIdJoinFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('Fights', $join_behavior);

		return $this->getTourneyFightssRelatedByTourneyId($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTourneyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTourneyIdJoinTourneyFightersRelatedByOneid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByOneid', $join_behavior);

		return $this->getTourneyFightssRelatedByTourneyId($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTourneyId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTourneyIdJoinTourneyFightersRelatedByTwoid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByTwoid', $join_behavior);

		return $this->getTourneyFightssRelatedByTourneyId($query, $con);
	}

	/**
	 * Clears out the collTourneyFightssRelatedByRoundNumber collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFightssRelatedByRoundNumber()
	 */
	public function clearTourneyFightssRelatedByRoundNumber()
	{
		$this->collTourneyFightssRelatedByRoundNumber = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFightssRelatedByRoundNumber collection.
	 *
	 * By default this just sets the collTourneyFightssRelatedByRoundNumber collection to an empty array (like clearcollTourneyFightssRelatedByRoundNumber());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFightssRelatedByRoundNumber($overrideExisting = true)
	{
		if (null !== $this->collTourneyFightssRelatedByRoundNumber && !$overrideExisting) {
			return;
		}
		$this->collTourneyFightssRelatedByRoundNumber = new PropelObjectCollection();
		$this->collTourneyFightssRelatedByRoundNumber->setModel('TourneyFights');
	}

	/**
	 * Gets an array of TourneyFights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyRoundStatus is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 * @throws     PropelException
	 */
	public function getTourneyFightssRelatedByRoundNumber($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByRoundNumber || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByRoundNumber) {
				// return empty collection
				$this->initTourneyFightssRelatedByRoundNumber();
			} else {
				$collTourneyFightssRelatedByRoundNumber = TourneyFightsQuery::create(null, $criteria)
					->filterByTourneyRoundStatusRelatedByRoundNumber($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFightssRelatedByRoundNumber;
				}
				$this->collTourneyFightssRelatedByRoundNumber = $collTourneyFightssRelatedByRoundNumber;
			}
		}
		return $this->collTourneyFightssRelatedByRoundNumber;
	}

	/**
	 * Sets a collection of TourneyFightsRelatedByRoundNumber objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFightssRelatedByRoundNumber A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFightssRelatedByRoundNumber(PropelCollection $tourneyFightssRelatedByRoundNumber, PropelPDO $con = null)
	{
		$this->tourneyFightssRelatedByRoundNumberScheduledForDeletion = $this->getTourneyFightssRelatedByRoundNumber(new Criteria(), $con)->diff($tourneyFightssRelatedByRoundNumber);

		foreach ($tourneyFightssRelatedByRoundNumber as $tourneyFightsRelatedByRoundNumber) {
			// Fix issue with collection modified by reference
			if ($tourneyFightsRelatedByRoundNumber->isNew()) {
				$tourneyFightsRelatedByRoundNumber->setTourneyRoundStatusRelatedByRoundNumber($this);
			}
			$this->addTourneyFightsRelatedByRoundNumber($tourneyFightsRelatedByRoundNumber);
		}

		$this->collTourneyFightssRelatedByRoundNumber = $tourneyFightssRelatedByRoundNumber;
	}

	/**
	 * Returns the number of related TourneyFights objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TourneyFights objects.
	 * @throws     PropelException
	 */
	public function countTourneyFightssRelatedByRoundNumber(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByRoundNumber || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByRoundNumber) {
				return 0;
			} else {
				$query = TourneyFightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyRoundStatusRelatedByRoundNumber($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFightssRelatedByRoundNumber);
		}
	}

	/**
	 * Method called to associate a TourneyFights object to this object
	 * through the TourneyFights foreign key attribute.
	 *
	 * @param      TourneyFights $l TourneyFights
	 * @return     TourneyRoundStatus The current object (for fluent API support)
	 */
	public function addTourneyFightsRelatedByRoundNumber(TourneyFights $l)
	{
		if ($this->collTourneyFightssRelatedByRoundNumber === null) {
			$this->initTourneyFightssRelatedByRoundNumber();
		}
		if (!$this->collTourneyFightssRelatedByRoundNumber->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFightsRelatedByRoundNumber($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFightsRelatedByRoundNumber $tourneyFightsRelatedByRoundNumber The tourneyFightsRelatedByRoundNumber object to add.
	 */
	protected function doAddTourneyFightsRelatedByRoundNumber($tourneyFightsRelatedByRoundNumber)
	{
		$this->collTourneyFightssRelatedByRoundNumber[]= $tourneyFightsRelatedByRoundNumber;
		$tourneyFightsRelatedByRoundNumber->setTourneyRoundStatusRelatedByRoundNumber($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByRoundNumber from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByRoundNumberJoinFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('Fights', $join_behavior);

		return $this->getTourneyFightssRelatedByRoundNumber($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByRoundNumber from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByRoundNumberJoinTourneyFightersRelatedByOneid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByOneid', $join_behavior);

		return $this->getTourneyFightssRelatedByRoundNumber($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyRoundStatus is new, it will return
	 * an empty collection; or if this TourneyRoundStatus has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByRoundNumber from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyRoundStatus.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByRoundNumberJoinTourneyFightersRelatedByTwoid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByTwoid', $join_behavior);

		return $this->getTourneyFightssRelatedByRoundNumber($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->tourney_id = null;
		$this->round_number = null;
		$this->round_start_time = null;
		$this->round_end_time = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
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
			if ($this->collTourneyFightssRelatedByTourneyId) {
				foreach ($this->collTourneyFightssRelatedByTourneyId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyFightssRelatedByRoundNumber) {
				foreach ($this->collTourneyFightssRelatedByRoundNumber as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collTourneyFightssRelatedByTourneyId instanceof PropelCollection) {
			$this->collTourneyFightssRelatedByTourneyId->clearIterator();
		}
		$this->collTourneyFightssRelatedByTourneyId = null;
		if ($this->collTourneyFightssRelatedByRoundNumber instanceof PropelCollection) {
			$this->collTourneyFightssRelatedByRoundNumber->clearIterator();
		}
		$this->collTourneyFightssRelatedByRoundNumber = null;
		$this->aTourneyStatus = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(TourneyRoundStatusPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseTourneyRoundStatus
