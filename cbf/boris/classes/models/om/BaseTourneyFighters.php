<?php


/**
 * Base class that represents a row from the 'tourney_fighters' table.
 *
 * List of fighters participating in the tournament.
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyFighters extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'TourneyFightersPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TourneyFightersPeer
	 */
	protected static $peer;

	/**
	 * The value for the tourney_id field.
	 * @var        int
	 */
	protected $tourney_id;

	/**
	 * The value for the fighter_id field.
	 * @var        int
	 */
	protected $fighter_id;

	/**
	 * @var        TourneyStatus
	 */
	protected $aTourneyStatus;

	/**
	 * @var        Names
	 */
	protected $aNames;

	/**
	 * @var        array TourneyFights[] Collection to store aggregation of TourneyFights objects.
	 */
	protected $collTourneyFightssRelatedByOneid;

	/**
	 * @var        array TourneyFights[] Collection to store aggregation of TourneyFights objects.
	 */
	protected $collTourneyFightssRelatedByTwoid;

	/**
	 * @var        array TourneyUserAction[] Collection to store aggregation of TourneyUserAction objects.
	 */
	protected $collTourneyUserActions;

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
	protected $tourneyFightssRelatedByOneidScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyFightssRelatedByTwoidScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyUserActionsScheduledForDeletion = null;

	/**
	 * Get the [tourney_id] column value.
	 * ID of the tournament.
	 * @return     int
	 */
	public function getTourneyId()
	{
		return $this->tourney_id;
	}

	/**
	 * Get the [fighter_id] column value.
	 * ID of a participating fighter.
	 * @return     int
	 */
	public function getFighterId()
	{
		return $this->fighter_id;
	}

	/**
	 * Set the value of [tourney_id] column.
	 * ID of the tournament.
	 * @param      int $v new value
	 * @return     TourneyFighters The current object (for fluent API support)
	 */
	public function setTourneyId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tourney_id !== $v) {
			$this->tourney_id = $v;
			$this->modifiedColumns[] = TourneyFightersPeer::TOURNEY_ID;
		}

		if ($this->aTourneyStatus !== null && $this->aTourneyStatus->getId() !== $v) {
			$this->aTourneyStatus = null;
		}

		return $this;
	} // setTourneyId()

	/**
	 * Set the value of [fighter_id] column.
	 * ID of a participating fighter.
	 * @param      int $v new value
	 * @return     TourneyFighters The current object (for fluent API support)
	 */
	public function setFighterId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->fighter_id !== $v) {
			$this->fighter_id = $v;
			$this->modifiedColumns[] = TourneyFightersPeer::FIGHTER_ID;
		}

		if ($this->aNames !== null && $this->aNames->getId() !== $v) {
			$this->aNames = null;
		}

		return $this;
	} // setFighterId()

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
			$this->fighter_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 2; // 2 = TourneyFightersPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating TourneyFighters object", $e);
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
		if ($this->aNames !== null && $this->fighter_id !== $this->aNames->getId()) {
			$this->aNames = null;
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
			$con = Propel::getConnection(TourneyFightersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TourneyFightersPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTourneyStatus = null;
			$this->aNames = null;
			$this->collTourneyFightssRelatedByOneid = null;

			$this->collTourneyFightssRelatedByTwoid = null;

			$this->collTourneyUserActions = null;

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
			$con = Propel::getConnection(TourneyFightersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = TourneyFightersQuery::create()
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
			$con = Propel::getConnection(TourneyFightersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				TourneyFightersPeer::addInstanceToPool($this);
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

			if ($this->aNames !== null) {
				if ($this->aNames->isModified() || $this->aNames->isNew()) {
					$affectedRows += $this->aNames->save($con);
				}
				$this->setNames($this->aNames);
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

			if ($this->tourneyFightssRelatedByOneidScheduledForDeletion !== null) {
				if (!$this->tourneyFightssRelatedByOneidScheduledForDeletion->isEmpty()) {
					TourneyFightsQuery::create()
						->filterByPrimaryKeys($this->tourneyFightssRelatedByOneidScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFightssRelatedByOneidScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFightssRelatedByOneid !== null) {
				foreach ($this->collTourneyFightssRelatedByOneid as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->tourneyFightssRelatedByTwoidScheduledForDeletion !== null) {
				if (!$this->tourneyFightssRelatedByTwoidScheduledForDeletion->isEmpty()) {
					TourneyFightsQuery::create()
						->filterByPrimaryKeys($this->tourneyFightssRelatedByTwoidScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFightssRelatedByTwoidScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFightssRelatedByTwoid !== null) {
				foreach ($this->collTourneyFightssRelatedByTwoid as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->tourneyUserActionsScheduledForDeletion !== null) {
				if (!$this->tourneyUserActionsScheduledForDeletion->isEmpty()) {
					TourneyUserActionQuery::create()
						->filterByPrimaryKeys($this->tourneyUserActionsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyUserActionsScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyUserActions !== null) {
				foreach ($this->collTourneyUserActions as $referrerFK) {
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
		if ($this->isColumnModified(TourneyFightersPeer::TOURNEY_ID)) {
			$modifiedColumns[':p' . $index++]  = '`TOURNEY_ID`';
		}
		if ($this->isColumnModified(TourneyFightersPeer::FIGHTER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`FIGHTER_ID`';
		}

		$sql = sprintf(
			'INSERT INTO `tourney_fighters` (%s) VALUES (%s)',
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
					case '`FIGHTER_ID`':
						$stmt->bindValue($identifier, $this->fighter_id, PDO::PARAM_INT);
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

			if ($this->aNames !== null) {
				if (!$this->aNames->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNames->getValidationFailures());
				}
			}


			if (($retval = TourneyFightersPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTourneyFightssRelatedByOneid !== null) {
					foreach ($this->collTourneyFightssRelatedByOneid as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTourneyFightssRelatedByTwoid !== null) {
					foreach ($this->collTourneyFightssRelatedByTwoid as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTourneyUserActions !== null) {
					foreach ($this->collTourneyUserActions as $referrerFK) {
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
		$pos = TourneyFightersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFighterId();
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
		if (isset($alreadyDumpedObjects['TourneyFighters'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['TourneyFighters'][serialize($this->getPrimaryKey())] = true;
		$keys = TourneyFightersPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTourneyId(),
			$keys[1] => $this->getFighterId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aTourneyStatus) {
				$result['TourneyStatus'] = $this->aTourneyStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aNames) {
				$result['Names'] = $this->aNames->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collTourneyFightssRelatedByOneid) {
				$result['TourneyFightssRelatedByOneid'] = $this->collTourneyFightssRelatedByOneid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collTourneyFightssRelatedByTwoid) {
				$result['TourneyFightssRelatedByTwoid'] = $this->collTourneyFightssRelatedByTwoid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collTourneyUserActions) {
				$result['TourneyUserActions'] = $this->collTourneyUserActions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = TourneyFightersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFighterId($value);
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
		$keys = TourneyFightersPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTourneyId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFighterId($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TourneyFightersPeer::DATABASE_NAME);

		if ($this->isColumnModified(TourneyFightersPeer::TOURNEY_ID)) $criteria->add(TourneyFightersPeer::TOURNEY_ID, $this->tourney_id);
		if ($this->isColumnModified(TourneyFightersPeer::FIGHTER_ID)) $criteria->add(TourneyFightersPeer::FIGHTER_ID, $this->fighter_id);

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
		$criteria = new Criteria(TourneyFightersPeer::DATABASE_NAME);
		$criteria->add(TourneyFightersPeer::TOURNEY_ID, $this->tourney_id);
		$criteria->add(TourneyFightersPeer::FIGHTER_ID, $this->fighter_id);

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
		$pks[1] = $this->getFighterId();

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
		$this->setFighterId($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getTourneyId()) && (null === $this->getFighterId());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TourneyFighters (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setTourneyId($this->getTourneyId());
		$copyObj->setFighterId($this->getFighterId());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getTourneyFightssRelatedByOneid() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFightsRelatedByOneid($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTourneyFightssRelatedByTwoid() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFightsRelatedByTwoid($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTourneyUserActions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyUserAction($relObj->copy($deepCopy));
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
	 * @return     TourneyFighters Clone of current object.
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
	 * @return     TourneyFightersPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TourneyFightersPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TourneyStatus object.
	 *
	 * @param      TourneyStatus $v
	 * @return     TourneyFighters The current object (for fluent API support)
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
			$v->addTourneyFighters($this);
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
				$this->aTourneyStatus->addTourneyFighterss($this);
			 */
		}
		return $this->aTourneyStatus;
	}

	/**
	 * Declares an association between this object and a Names object.
	 *
	 * @param      Names $v
	 * @return     TourneyFighters The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNames(Names $v = null)
	{
		if ($v === null) {
			$this->setFighterId(NULL);
		} else {
			$this->setFighterId($v->getId());
		}

		$this->aNames = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Names object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFighters($this);
		}

		return $this;
	}


	/**
	 * Get the associated Names object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Names The associated Names object.
	 * @throws     PropelException
	 */
	public function getNames(PropelPDO $con = null)
	{
		if ($this->aNames === null && ($this->fighter_id !== null)) {
			$this->aNames = NamesQuery::create()->findPk($this->fighter_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aNames->addTourneyFighterss($this);
			 */
		}
		return $this->aNames;
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
		if ('TourneyFightsRelatedByOneid' == $relationName) {
			return $this->initTourneyFightssRelatedByOneid();
		}
		if ('TourneyFightsRelatedByTwoid' == $relationName) {
			return $this->initTourneyFightssRelatedByTwoid();
		}
		if ('TourneyUserAction' == $relationName) {
			return $this->initTourneyUserActions();
		}
	}

	/**
	 * Clears out the collTourneyFightssRelatedByOneid collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFightssRelatedByOneid()
	 */
	public function clearTourneyFightssRelatedByOneid()
	{
		$this->collTourneyFightssRelatedByOneid = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFightssRelatedByOneid collection.
	 *
	 * By default this just sets the collTourneyFightssRelatedByOneid collection to an empty array (like clearcollTourneyFightssRelatedByOneid());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFightssRelatedByOneid($overrideExisting = true)
	{
		if (null !== $this->collTourneyFightssRelatedByOneid && !$overrideExisting) {
			return;
		}
		$this->collTourneyFightssRelatedByOneid = new PropelObjectCollection();
		$this->collTourneyFightssRelatedByOneid->setModel('TourneyFights');
	}

	/**
	 * Gets an array of TourneyFights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyFighters is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 * @throws     PropelException
	 */
	public function getTourneyFightssRelatedByOneid($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByOneid || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByOneid) {
				// return empty collection
				$this->initTourneyFightssRelatedByOneid();
			} else {
				$collTourneyFightssRelatedByOneid = TourneyFightsQuery::create(null, $criteria)
					->filterByTourneyFightersRelatedByOneid($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFightssRelatedByOneid;
				}
				$this->collTourneyFightssRelatedByOneid = $collTourneyFightssRelatedByOneid;
			}
		}
		return $this->collTourneyFightssRelatedByOneid;
	}

	/**
	 * Sets a collection of TourneyFightsRelatedByOneid objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFightssRelatedByOneid A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFightssRelatedByOneid(PropelCollection $tourneyFightssRelatedByOneid, PropelPDO $con = null)
	{
		$this->tourneyFightssRelatedByOneidScheduledForDeletion = $this->getTourneyFightssRelatedByOneid(new Criteria(), $con)->diff($tourneyFightssRelatedByOneid);

		foreach ($tourneyFightssRelatedByOneid as $tourneyFightsRelatedByOneid) {
			// Fix issue with collection modified by reference
			if ($tourneyFightsRelatedByOneid->isNew()) {
				$tourneyFightsRelatedByOneid->setTourneyFightersRelatedByOneid($this);
			}
			$this->addTourneyFightsRelatedByOneid($tourneyFightsRelatedByOneid);
		}

		$this->collTourneyFightssRelatedByOneid = $tourneyFightssRelatedByOneid;
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
	public function countTourneyFightssRelatedByOneid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByOneid || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByOneid) {
				return 0;
			} else {
				$query = TourneyFightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyFightersRelatedByOneid($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFightssRelatedByOneid);
		}
	}

	/**
	 * Method called to associate a TourneyFights object to this object
	 * through the TourneyFights foreign key attribute.
	 *
	 * @param      TourneyFights $l TourneyFights
	 * @return     TourneyFighters The current object (for fluent API support)
	 */
	public function addTourneyFightsRelatedByOneid(TourneyFights $l)
	{
		if ($this->collTourneyFightssRelatedByOneid === null) {
			$this->initTourneyFightssRelatedByOneid();
		}
		if (!$this->collTourneyFightssRelatedByOneid->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFightsRelatedByOneid($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFightsRelatedByOneid $tourneyFightsRelatedByOneid The tourneyFightsRelatedByOneid object to add.
	 */
	protected function doAddTourneyFightsRelatedByOneid($tourneyFightsRelatedByOneid)
	{
		$this->collTourneyFightssRelatedByOneid[]= $tourneyFightsRelatedByOneid;
		$tourneyFightsRelatedByOneid->setTourneyFightersRelatedByOneid($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByOneid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByOneidJoinTourneyRoundStatusRelatedByTourneyId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByTourneyId', $join_behavior);

		return $this->getTourneyFightssRelatedByOneid($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByOneid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByOneidJoinTourneyRoundStatusRelatedByRoundNumber($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByRoundNumber', $join_behavior);

		return $this->getTourneyFightssRelatedByOneid($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByOneid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByOneidJoinFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('Fights', $join_behavior);

		return $this->getTourneyFightssRelatedByOneid($query, $con);
	}

	/**
	 * Clears out the collTourneyFightssRelatedByTwoid collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFightssRelatedByTwoid()
	 */
	public function clearTourneyFightssRelatedByTwoid()
	{
		$this->collTourneyFightssRelatedByTwoid = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFightssRelatedByTwoid collection.
	 *
	 * By default this just sets the collTourneyFightssRelatedByTwoid collection to an empty array (like clearcollTourneyFightssRelatedByTwoid());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFightssRelatedByTwoid($overrideExisting = true)
	{
		if (null !== $this->collTourneyFightssRelatedByTwoid && !$overrideExisting) {
			return;
		}
		$this->collTourneyFightssRelatedByTwoid = new PropelObjectCollection();
		$this->collTourneyFightssRelatedByTwoid->setModel('TourneyFights');
	}

	/**
	 * Gets an array of TourneyFights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyFighters is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 * @throws     PropelException
	 */
	public function getTourneyFightssRelatedByTwoid($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByTwoid || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByTwoid) {
				// return empty collection
				$this->initTourneyFightssRelatedByTwoid();
			} else {
				$collTourneyFightssRelatedByTwoid = TourneyFightsQuery::create(null, $criteria)
					->filterByTourneyFightersRelatedByTwoid($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFightssRelatedByTwoid;
				}
				$this->collTourneyFightssRelatedByTwoid = $collTourneyFightssRelatedByTwoid;
			}
		}
		return $this->collTourneyFightssRelatedByTwoid;
	}

	/**
	 * Sets a collection of TourneyFightsRelatedByTwoid objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFightssRelatedByTwoid A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFightssRelatedByTwoid(PropelCollection $tourneyFightssRelatedByTwoid, PropelPDO $con = null)
	{
		$this->tourneyFightssRelatedByTwoidScheduledForDeletion = $this->getTourneyFightssRelatedByTwoid(new Criteria(), $con)->diff($tourneyFightssRelatedByTwoid);

		foreach ($tourneyFightssRelatedByTwoid as $tourneyFightsRelatedByTwoid) {
			// Fix issue with collection modified by reference
			if ($tourneyFightsRelatedByTwoid->isNew()) {
				$tourneyFightsRelatedByTwoid->setTourneyFightersRelatedByTwoid($this);
			}
			$this->addTourneyFightsRelatedByTwoid($tourneyFightsRelatedByTwoid);
		}

		$this->collTourneyFightssRelatedByTwoid = $tourneyFightssRelatedByTwoid;
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
	public function countTourneyFightssRelatedByTwoid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightssRelatedByTwoid || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightssRelatedByTwoid) {
				return 0;
			} else {
				$query = TourneyFightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyFightersRelatedByTwoid($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFightssRelatedByTwoid);
		}
	}

	/**
	 * Method called to associate a TourneyFights object to this object
	 * through the TourneyFights foreign key attribute.
	 *
	 * @param      TourneyFights $l TourneyFights
	 * @return     TourneyFighters The current object (for fluent API support)
	 */
	public function addTourneyFightsRelatedByTwoid(TourneyFights $l)
	{
		if ($this->collTourneyFightssRelatedByTwoid === null) {
			$this->initTourneyFightssRelatedByTwoid();
		}
		if (!$this->collTourneyFightssRelatedByTwoid->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFightsRelatedByTwoid($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFightsRelatedByTwoid $tourneyFightsRelatedByTwoid The tourneyFightsRelatedByTwoid object to add.
	 */
	protected function doAddTourneyFightsRelatedByTwoid($tourneyFightsRelatedByTwoid)
	{
		$this->collTourneyFightssRelatedByTwoid[]= $tourneyFightsRelatedByTwoid;
		$tourneyFightsRelatedByTwoid->setTourneyFightersRelatedByTwoid($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTwoid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTwoidJoinTourneyRoundStatusRelatedByTourneyId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByTourneyId', $join_behavior);

		return $this->getTourneyFightssRelatedByTwoid($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTwoid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTwoidJoinTourneyRoundStatusRelatedByRoundNumber($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByRoundNumber', $join_behavior);

		return $this->getTourneyFightssRelatedByTwoid($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyFightssRelatedByTwoid from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssRelatedByTwoidJoinFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('Fights', $join_behavior);

		return $this->getTourneyFightssRelatedByTwoid($query, $con);
	}

	/**
	 * Clears out the collTourneyUserActions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyUserActions()
	 */
	public function clearTourneyUserActions()
	{
		$this->collTourneyUserActions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyUserActions collection.
	 *
	 * By default this just sets the collTourneyUserActions collection to an empty array (like clearcollTourneyUserActions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyUserActions($overrideExisting = true)
	{
		if (null !== $this->collTourneyUserActions && !$overrideExisting) {
			return;
		}
		$this->collTourneyUserActions = new PropelObjectCollection();
		$this->collTourneyUserActions->setModel('TourneyUserAction');
	}

	/**
	 * Gets an array of TourneyUserAction objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this TourneyFighters is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyUserAction[] List of TourneyUserAction objects
	 * @throws     PropelException
	 */
	public function getTourneyUserActions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyUserActions || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyUserActions) {
				// return empty collection
				$this->initTourneyUserActions();
			} else {
				$collTourneyUserActions = TourneyUserActionQuery::create(null, $criteria)
					->filterByTourneyFighters($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyUserActions;
				}
				$this->collTourneyUserActions = $collTourneyUserActions;
			}
		}
		return $this->collTourneyUserActions;
	}

	/**
	 * Sets a collection of TourneyUserAction objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyUserActions A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyUserActions(PropelCollection $tourneyUserActions, PropelPDO $con = null)
	{
		$this->tourneyUserActionsScheduledForDeletion = $this->getTourneyUserActions(new Criteria(), $con)->diff($tourneyUserActions);

		foreach ($tourneyUserActions as $tourneyUserAction) {
			// Fix issue with collection modified by reference
			if ($tourneyUserAction->isNew()) {
				$tourneyUserAction->setTourneyFighters($this);
			}
			$this->addTourneyUserAction($tourneyUserAction);
		}

		$this->collTourneyUserActions = $tourneyUserActions;
	}

	/**
	 * Returns the number of related TourneyUserAction objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related TourneyUserAction objects.
	 * @throws     PropelException
	 */
	public function countTourneyUserActions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyUserActions || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyUserActions) {
				return 0;
			} else {
				$query = TourneyUserActionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTourneyFighters($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyUserActions);
		}
	}

	/**
	 * Method called to associate a TourneyUserAction object to this object
	 * through the TourneyUserAction foreign key attribute.
	 *
	 * @param      TourneyUserAction $l TourneyUserAction
	 * @return     TourneyFighters The current object (for fluent API support)
	 */
	public function addTourneyUserAction(TourneyUserAction $l)
	{
		if ($this->collTourneyUserActions === null) {
			$this->initTourneyUserActions();
		}
		if (!$this->collTourneyUserActions->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyUserAction($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyUserAction $tourneyUserAction The tourneyUserAction object to add.
	 */
	protected function doAddTourneyUserAction($tourneyUserAction)
	{
		$this->collTourneyUserActions[]= $tourneyUserAction;
		$tourneyUserAction->setTourneyFighters($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyUserAction[] List of TourneyUserAction objects
	 */
	public function getTourneyUserActionsJoinUserprofile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyUserActionQuery::create(null, $criteria);
		$query->joinWith('Userprofile', $join_behavior);

		return $this->getTourneyUserActions($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFighters is new, it will return
	 * an empty collection; or if this TourneyFighters has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFighters.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyUserAction[] List of TourneyUserAction objects
	 */
	public function getTourneyUserActionsJoinTourneyFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyUserActionQuery::create(null, $criteria);
		$query->joinWith('TourneyFights', $join_behavior);

		return $this->getTourneyUserActions($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->tourney_id = null;
		$this->fighter_id = null;
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
			if ($this->collTourneyFightssRelatedByOneid) {
				foreach ($this->collTourneyFightssRelatedByOneid as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyFightssRelatedByTwoid) {
				foreach ($this->collTourneyFightssRelatedByTwoid as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyUserActions) {
				foreach ($this->collTourneyUserActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collTourneyFightssRelatedByOneid instanceof PropelCollection) {
			$this->collTourneyFightssRelatedByOneid->clearIterator();
		}
		$this->collTourneyFightssRelatedByOneid = null;
		if ($this->collTourneyFightssRelatedByTwoid instanceof PropelCollection) {
			$this->collTourneyFightssRelatedByTwoid->clearIterator();
		}
		$this->collTourneyFightssRelatedByTwoid = null;
		if ($this->collTourneyUserActions instanceof PropelCollection) {
			$this->collTourneyUserActions->clearIterator();
		}
		$this->collTourneyUserActions = null;
		$this->aTourneyStatus = null;
		$this->aNames = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(TourneyFightersPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseTourneyFighters
