<?php


/**
 * Base class that represents a row from the 'names' table.
 *
 * Names of celebrities
 *
 * @package    propel.generator.models.om
 */
abstract class BaseNames extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'NamesPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        NamesPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the reference field.
	 * @var        string
	 */
	protected $reference;

	/**
	 * @var        array Pics[] Collection to store aggregation of Pics objects.
	 */
	protected $collPicss;

	/**
	 * @var        array Fights[] Collection to store aggregation of Fights objects.
	 */
	protected $collFightssRelatedByOneid;

	/**
	 * @var        array Fights[] Collection to store aggregation of Fights objects.
	 */
	protected $collFightssRelatedByTwoid;

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
	protected $picssScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $fightssRelatedByOneidScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $fightssRelatedByTwoidScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyFighterssScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 * ID for a celebrity
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * Name of a celebrity
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [reference] column value.
	 * The reference link for a celebrity
	 * @return     string
	 */
	public function getReference()
	{
		return $this->reference;
	}

	/**
	 * Set the value of [id] column.
	 * ID for a celebrity
	 * @param      int $v new value
	 * @return     Names The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = NamesPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * Name of a celebrity
	 * @param      string $v new value
	 * @return     Names The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = NamesPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [reference] column.
	 * The reference link for a celebrity
	 * @param      string $v new value
	 * @return     Names The current object (for fluent API support)
	 */
	public function setReference($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->reference !== $v) {
			$this->reference = $v;
			$this->modifiedColumns[] = NamesPeer::REFERENCE;
		}

		return $this;
	} // setReference()

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->reference = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 3; // 3 = NamesPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Names object", $e);
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
			$con = Propel::getConnection(NamesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = NamesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collPicss = null;

			$this->collFightssRelatedByOneid = null;

			$this->collFightssRelatedByTwoid = null;

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
			$con = Propel::getConnection(NamesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = NamesQuery::create()
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
			$con = Propel::getConnection(NamesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				NamesPeer::addInstanceToPool($this);
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

			if ($this->picssScheduledForDeletion !== null) {
				if (!$this->picssScheduledForDeletion->isEmpty()) {
					PicsQuery::create()
						->filterByPrimaryKeys($this->picssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->picssScheduledForDeletion = null;
				}
			}

			if ($this->collPicss !== null) {
				foreach ($this->collPicss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->fightssRelatedByOneidScheduledForDeletion !== null) {
				if (!$this->fightssRelatedByOneidScheduledForDeletion->isEmpty()) {
					FightsQuery::create()
						->filterByPrimaryKeys($this->fightssRelatedByOneidScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->fightssRelatedByOneidScheduledForDeletion = null;
				}
			}

			if ($this->collFightssRelatedByOneid !== null) {
				foreach ($this->collFightssRelatedByOneid as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->fightssRelatedByTwoidScheduledForDeletion !== null) {
				if (!$this->fightssRelatedByTwoidScheduledForDeletion->isEmpty()) {
					FightsQuery::create()
						->filterByPrimaryKeys($this->fightssRelatedByTwoidScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->fightssRelatedByTwoidScheduledForDeletion = null;
				}
			}

			if ($this->collFightssRelatedByTwoid !== null) {
				foreach ($this->collFightssRelatedByTwoid as $referrerFK) {
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

		$this->modifiedColumns[] = NamesPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . NamesPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(NamesPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(NamesPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(NamesPeer::REFERENCE)) {
			$modifiedColumns[':p' . $index++]  = '`REFERENCE`';
		}

		$sql = sprintf(
			'INSERT INTO `names` (%s) VALUES (%s)',
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
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`REFERENCE`':
						$stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);
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


			if (($retval = NamesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPicss !== null) {
					foreach ($this->collPicss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFightssRelatedByOneid !== null) {
					foreach ($this->collFightssRelatedByOneid as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFightssRelatedByTwoid !== null) {
					foreach ($this->collFightssRelatedByTwoid as $referrerFK) {
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
		$pos = NamesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getReference();
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
		if (isset($alreadyDumpedObjects['Names'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Names'][$this->getPrimaryKey()] = true;
		$keys = NamesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getReference(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collPicss) {
				$result['Picss'] = $this->collPicss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collFightssRelatedByOneid) {
				$result['FightssRelatedByOneid'] = $this->collFightssRelatedByOneid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collFightssRelatedByTwoid) {
				$result['FightssRelatedByTwoid'] = $this->collFightssRelatedByTwoid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = NamesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setReference($value);
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
		$keys = NamesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setReference($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(NamesPeer::DATABASE_NAME);

		if ($this->isColumnModified(NamesPeer::ID)) $criteria->add(NamesPeer::ID, $this->id);
		if ($this->isColumnModified(NamesPeer::NAME)) $criteria->add(NamesPeer::NAME, $this->name);
		if ($this->isColumnModified(NamesPeer::REFERENCE)) $criteria->add(NamesPeer::REFERENCE, $this->reference);

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
		$criteria = new Criteria(NamesPeer::DATABASE_NAME);
		$criteria->add(NamesPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Names (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setName($this->getName());
		$copyObj->setReference($this->getReference());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPicss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPics($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFightssRelatedByOneid() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFightsRelatedByOneid($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFightssRelatedByTwoid() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFightsRelatedByTwoid($relObj->copy($deepCopy));
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
	 * @return     Names Clone of current object.
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
	 * @return     NamesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new NamesPeer();
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
		if ('Pics' == $relationName) {
			return $this->initPicss();
		}
		if ('FightsRelatedByOneid' == $relationName) {
			return $this->initFightssRelatedByOneid();
		}
		if ('FightsRelatedByTwoid' == $relationName) {
			return $this->initFightssRelatedByTwoid();
		}
		if ('TourneyFighters' == $relationName) {
			return $this->initTourneyFighterss();
		}
	}

	/**
	 * Clears out the collPicss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPicss()
	 */
	public function clearPicss()
	{
		$this->collPicss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPicss collection.
	 *
	 * By default this just sets the collPicss collection to an empty array (like clearcollPicss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPicss($overrideExisting = true)
	{
		if (null !== $this->collPicss && !$overrideExisting) {
			return;
		}
		$this->collPicss = new PropelObjectCollection();
		$this->collPicss->setModel('Pics');
	}

	/**
	 * Gets an array of Pics objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Names is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Pics[] List of Pics objects
	 * @throws     PropelException
	 */
	public function getPicss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPicss || null !== $criteria) {
			if ($this->isNew() && null === $this->collPicss) {
				// return empty collection
				$this->initPicss();
			} else {
				$collPicss = PicsQuery::create(null, $criteria)
					->filterByNames($this)
					->find($con);
				if (null !== $criteria) {
					return $collPicss;
				}
				$this->collPicss = $collPicss;
			}
		}
		return $this->collPicss;
	}

	/**
	 * Sets a collection of Pics objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $picss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPicss(PropelCollection $picss, PropelPDO $con = null)
	{
		$this->picssScheduledForDeletion = $this->getPicss(new Criteria(), $con)->diff($picss);

		foreach ($picss as $pics) {
			// Fix issue with collection modified by reference
			if ($pics->isNew()) {
				$pics->setNames($this);
			}
			$this->addPics($pics);
		}

		$this->collPicss = $picss;
	}

	/**
	 * Returns the number of related Pics objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Pics objects.
	 * @throws     PropelException
	 */
	public function countPicss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPicss || null !== $criteria) {
			if ($this->isNew() && null === $this->collPicss) {
				return 0;
			} else {
				$query = PicsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByNames($this)
					->count($con);
			}
		} else {
			return count($this->collPicss);
		}
	}

	/**
	 * Method called to associate a Pics object to this object
	 * through the Pics foreign key attribute.
	 *
	 * @param      Pics $l Pics
	 * @return     Names The current object (for fluent API support)
	 */
	public function addPics(Pics $l)
	{
		if ($this->collPicss === null) {
			$this->initPicss();
		}
		if (!$this->collPicss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPics($l);
		}

		return $this;
	}

	/**
	 * @param	Pics $pics The pics object to add.
	 */
	protected function doAddPics($pics)
	{
		$this->collPicss[]= $pics;
		$pics->setNames($this);
	}

	/**
	 * Clears out the collFightssRelatedByOneid collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFightssRelatedByOneid()
	 */
	public function clearFightssRelatedByOneid()
	{
		$this->collFightssRelatedByOneid = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFightssRelatedByOneid collection.
	 *
	 * By default this just sets the collFightssRelatedByOneid collection to an empty array (like clearcollFightssRelatedByOneid());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initFightssRelatedByOneid($overrideExisting = true)
	{
		if (null !== $this->collFightssRelatedByOneid && !$overrideExisting) {
			return;
		}
		$this->collFightssRelatedByOneid = new PropelObjectCollection();
		$this->collFightssRelatedByOneid->setModel('Fights');
	}

	/**
	 * Gets an array of Fights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Names is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Fights[] List of Fights objects
	 * @throws     PropelException
	 */
	public function getFightssRelatedByOneid($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFightssRelatedByOneid || null !== $criteria) {
			if ($this->isNew() && null === $this->collFightssRelatedByOneid) {
				// return empty collection
				$this->initFightssRelatedByOneid();
			} else {
				$collFightssRelatedByOneid = FightsQuery::create(null, $criteria)
					->filterByNamesRelatedByOneid($this)
					->find($con);
				if (null !== $criteria) {
					return $collFightssRelatedByOneid;
				}
				$this->collFightssRelatedByOneid = $collFightssRelatedByOneid;
			}
		}
		return $this->collFightssRelatedByOneid;
	}

	/**
	 * Sets a collection of FightsRelatedByOneid objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $fightssRelatedByOneid A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setFightssRelatedByOneid(PropelCollection $fightssRelatedByOneid, PropelPDO $con = null)
	{
		$this->fightssRelatedByOneidScheduledForDeletion = $this->getFightssRelatedByOneid(new Criteria(), $con)->diff($fightssRelatedByOneid);

		foreach ($fightssRelatedByOneid as $fightsRelatedByOneid) {
			// Fix issue with collection modified by reference
			if ($fightsRelatedByOneid->isNew()) {
				$fightsRelatedByOneid->setNamesRelatedByOneid($this);
			}
			$this->addFightsRelatedByOneid($fightsRelatedByOneid);
		}

		$this->collFightssRelatedByOneid = $fightssRelatedByOneid;
	}

	/**
	 * Returns the number of related Fights objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Fights objects.
	 * @throws     PropelException
	 */
	public function countFightssRelatedByOneid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFightssRelatedByOneid || null !== $criteria) {
			if ($this->isNew() && null === $this->collFightssRelatedByOneid) {
				return 0;
			} else {
				$query = FightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByNamesRelatedByOneid($this)
					->count($con);
			}
		} else {
			return count($this->collFightssRelatedByOneid);
		}
	}

	/**
	 * Method called to associate a Fights object to this object
	 * through the Fights foreign key attribute.
	 *
	 * @param      Fights $l Fights
	 * @return     Names The current object (for fluent API support)
	 */
	public function addFightsRelatedByOneid(Fights $l)
	{
		if ($this->collFightssRelatedByOneid === null) {
			$this->initFightssRelatedByOneid();
		}
		if (!$this->collFightssRelatedByOneid->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddFightsRelatedByOneid($l);
		}

		return $this;
	}

	/**
	 * @param	FightsRelatedByOneid $fightsRelatedByOneid The fightsRelatedByOneid object to add.
	 */
	protected function doAddFightsRelatedByOneid($fightsRelatedByOneid)
	{
		$this->collFightssRelatedByOneid[]= $fightsRelatedByOneid;
		$fightsRelatedByOneid->setNamesRelatedByOneid($this);
	}

	/**
	 * Clears out the collFightssRelatedByTwoid collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFightssRelatedByTwoid()
	 */
	public function clearFightssRelatedByTwoid()
	{
		$this->collFightssRelatedByTwoid = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFightssRelatedByTwoid collection.
	 *
	 * By default this just sets the collFightssRelatedByTwoid collection to an empty array (like clearcollFightssRelatedByTwoid());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initFightssRelatedByTwoid($overrideExisting = true)
	{
		if (null !== $this->collFightssRelatedByTwoid && !$overrideExisting) {
			return;
		}
		$this->collFightssRelatedByTwoid = new PropelObjectCollection();
		$this->collFightssRelatedByTwoid->setModel('Fights');
	}

	/**
	 * Gets an array of Fights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Names is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Fights[] List of Fights objects
	 * @throws     PropelException
	 */
	public function getFightssRelatedByTwoid($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collFightssRelatedByTwoid || null !== $criteria) {
			if ($this->isNew() && null === $this->collFightssRelatedByTwoid) {
				// return empty collection
				$this->initFightssRelatedByTwoid();
			} else {
				$collFightssRelatedByTwoid = FightsQuery::create(null, $criteria)
					->filterByNamesRelatedByTwoid($this)
					->find($con);
				if (null !== $criteria) {
					return $collFightssRelatedByTwoid;
				}
				$this->collFightssRelatedByTwoid = $collFightssRelatedByTwoid;
			}
		}
		return $this->collFightssRelatedByTwoid;
	}

	/**
	 * Sets a collection of FightsRelatedByTwoid objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $fightssRelatedByTwoid A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setFightssRelatedByTwoid(PropelCollection $fightssRelatedByTwoid, PropelPDO $con = null)
	{
		$this->fightssRelatedByTwoidScheduledForDeletion = $this->getFightssRelatedByTwoid(new Criteria(), $con)->diff($fightssRelatedByTwoid);

		foreach ($fightssRelatedByTwoid as $fightsRelatedByTwoid) {
			// Fix issue with collection modified by reference
			if ($fightsRelatedByTwoid->isNew()) {
				$fightsRelatedByTwoid->setNamesRelatedByTwoid($this);
			}
			$this->addFightsRelatedByTwoid($fightsRelatedByTwoid);
		}

		$this->collFightssRelatedByTwoid = $fightssRelatedByTwoid;
	}

	/**
	 * Returns the number of related Fights objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Fights objects.
	 * @throws     PropelException
	 */
	public function countFightssRelatedByTwoid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collFightssRelatedByTwoid || null !== $criteria) {
			if ($this->isNew() && null === $this->collFightssRelatedByTwoid) {
				return 0;
			} else {
				$query = FightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByNamesRelatedByTwoid($this)
					->count($con);
			}
		} else {
			return count($this->collFightssRelatedByTwoid);
		}
	}

	/**
	 * Method called to associate a Fights object to this object
	 * through the Fights foreign key attribute.
	 *
	 * @param      Fights $l Fights
	 * @return     Names The current object (for fluent API support)
	 */
	public function addFightsRelatedByTwoid(Fights $l)
	{
		if ($this->collFightssRelatedByTwoid === null) {
			$this->initFightssRelatedByTwoid();
		}
		if (!$this->collFightssRelatedByTwoid->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddFightsRelatedByTwoid($l);
		}

		return $this;
	}

	/**
	 * @param	FightsRelatedByTwoid $fightsRelatedByTwoid The fightsRelatedByTwoid object to add.
	 */
	protected function doAddFightsRelatedByTwoid($fightsRelatedByTwoid)
	{
		$this->collFightssRelatedByTwoid[]= $fightsRelatedByTwoid;
		$fightsRelatedByTwoid->setNamesRelatedByTwoid($this);
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
	 * If this Names is new, it will return
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
					->filterByNames($this)
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
				$tourneyFighters->setNames($this);
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
					->filterByNames($this)
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
	 * @return     Names The current object (for fluent API support)
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
		$tourneyFighters->setNames($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Names is new, it will return
	 * an empty collection; or if this Names has previously
	 * been saved, it will retrieve related TourneyFighterss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Names.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFighters[] List of TourneyFighters objects
	 */
	public function getTourneyFighterssJoinTourneyStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightersQuery::create(null, $criteria);
		$query->joinWith('TourneyStatus', $join_behavior);

		return $this->getTourneyFighterss($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->reference = null;
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
			if ($this->collPicss) {
				foreach ($this->collPicss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFightssRelatedByOneid) {
				foreach ($this->collFightssRelatedByOneid as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFightssRelatedByTwoid) {
				foreach ($this->collFightssRelatedByTwoid as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyFighterss) {
				foreach ($this->collTourneyFighterss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collPicss instanceof PropelCollection) {
			$this->collPicss->clearIterator();
		}
		$this->collPicss = null;
		if ($this->collFightssRelatedByOneid instanceof PropelCollection) {
			$this->collFightssRelatedByOneid->clearIterator();
		}
		$this->collFightssRelatedByOneid = null;
		if ($this->collFightssRelatedByTwoid instanceof PropelCollection) {
			$this->collFightssRelatedByTwoid->clearIterator();
		}
		$this->collFightssRelatedByTwoid = null;
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
		return (string) $this->exportTo(NamesPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseNames
