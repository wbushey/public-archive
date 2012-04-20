<?php


/**
 * Base class that represents a row from the 'fights' table.
 *
 * Matches between celebrities
 *
 * @package    propel.generator.models.om
 */
abstract class BaseFights extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'FightsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FightsPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the oneid field.
	 * @var        int
	 */
	protected $oneid;

	/**
	 * The value for the twoid field.
	 * @var        int
	 */
	protected $twoid;

	/**
	 * The value for the onewins field.
	 * @var        int
	 */
	protected $onewins;

	/**
	 * The value for the twowins field.
	 * @var        int
	 */
	protected $twowins;

	/**
	 * The value for the active field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $active;

	/**
	 * @var        Names
	 */
	protected $aNamesRelatedByOneid;

	/**
	 * @var        Names
	 */
	protected $aNamesRelatedByTwoid;

	/**
	 * @var        array Posts[] Collection to store aggregation of Posts objects.
	 */
	protected $collPostss;

	/**
	 * @var        array TourneyFights[] Collection to store aggregation of TourneyFights objects.
	 */
	protected $collTourneyFightss;

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
	protected $postssScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyFightssScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->active = 1;
	}

	/**
	 * Initializes internal state of BaseFights object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * ID for a fight
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [oneid] column value.
	 * ID for the first celebrity
	 * @return     int
	 */
	public function getOneid()
	{
		return $this->oneid;
	}

	/**
	 * Get the [twoid] column value.
	 * ID for the second celebrity
	 * @return     int
	 */
	public function getTwoid()
	{
		return $this->twoid;
	}

	/**
	 * Get the [onewins] column value.
	 * Wins for the first celebrity
	 * @return     int
	 */
	public function getOnewins()
	{
		return $this->onewins;
	}

	/**
	 * Get the [twowins] column value.
	 * Wins for the second celebrity
	 * @return     int
	 */
	public function getTwowins()
	{
		return $this->twowins;
	}

	/**
	 * Get the [active] column value.
	 * Indicates if the fight is currently active
	 * @return     int
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Set the value of [id] column.
	 * ID for a fight
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FightsPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [oneid] column.
	 * ID for the first celebrity
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setOneid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oneid !== $v) {
			$this->oneid = $v;
			$this->modifiedColumns[] = FightsPeer::ONEID;
		}

		if ($this->aNamesRelatedByOneid !== null && $this->aNamesRelatedByOneid->getId() !== $v) {
			$this->aNamesRelatedByOneid = null;
		}

		return $this;
	} // setOneid()

	/**
	 * Set the value of [twoid] column.
	 * ID for the second celebrity
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setTwoid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->twoid !== $v) {
			$this->twoid = $v;
			$this->modifiedColumns[] = FightsPeer::TWOID;
		}

		if ($this->aNamesRelatedByTwoid !== null && $this->aNamesRelatedByTwoid->getId() !== $v) {
			$this->aNamesRelatedByTwoid = null;
		}

		return $this;
	} // setTwoid()

	/**
	 * Set the value of [onewins] column.
	 * Wins for the first celebrity
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setOnewins($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->onewins !== $v) {
			$this->onewins = $v;
			$this->modifiedColumns[] = FightsPeer::ONEWINS;
		}

		return $this;
	} // setOnewins()

	/**
	 * Set the value of [twowins] column.
	 * Wins for the second celebrity
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setTwowins($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->twowins !== $v) {
			$this->twowins = $v;
			$this->modifiedColumns[] = FightsPeer::TWOWINS;
		}

		return $this;
	} // setTwowins()

	/**
	 * Set the value of [active] column.
	 * Indicates if the fight is currently active
	 * @param      int $v new value
	 * @return     Fights The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = FightsPeer::ACTIVE;
		}

		return $this;
	} // setActive()

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
			if ($this->active !== 1) {
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
			$this->oneid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->twoid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->onewins = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->twowins = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->active = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = FightsPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Fights object", $e);
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

		if ($this->aNamesRelatedByOneid !== null && $this->oneid !== $this->aNamesRelatedByOneid->getId()) {
			$this->aNamesRelatedByOneid = null;
		}
		if ($this->aNamesRelatedByTwoid !== null && $this->twoid !== $this->aNamesRelatedByTwoid->getId()) {
			$this->aNamesRelatedByTwoid = null;
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
			$con = Propel::getConnection(FightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FightsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aNamesRelatedByOneid = null;
			$this->aNamesRelatedByTwoid = null;
			$this->collPostss = null;

			$this->collTourneyFightss = null;

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
			$con = Propel::getConnection(FightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = FightsQuery::create()
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
			$con = Propel::getConnection(FightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				FightsPeer::addInstanceToPool($this);
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

			if ($this->aNamesRelatedByOneid !== null) {
				if ($this->aNamesRelatedByOneid->isModified() || $this->aNamesRelatedByOneid->isNew()) {
					$affectedRows += $this->aNamesRelatedByOneid->save($con);
				}
				$this->setNamesRelatedByOneid($this->aNamesRelatedByOneid);
			}

			if ($this->aNamesRelatedByTwoid !== null) {
				if ($this->aNamesRelatedByTwoid->isModified() || $this->aNamesRelatedByTwoid->isNew()) {
					$affectedRows += $this->aNamesRelatedByTwoid->save($con);
				}
				$this->setNamesRelatedByTwoid($this->aNamesRelatedByTwoid);
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

			if ($this->postssScheduledForDeletion !== null) {
				if (!$this->postssScheduledForDeletion->isEmpty()) {
					PostsQuery::create()
						->filterByPrimaryKeys($this->postssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->postssScheduledForDeletion = null;
				}
			}

			if ($this->collPostss !== null) {
				foreach ($this->collPostss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->tourneyFightssScheduledForDeletion !== null) {
				if (!$this->tourneyFightssScheduledForDeletion->isEmpty()) {
					TourneyFightsQuery::create()
						->filterByPrimaryKeys($this->tourneyFightssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->tourneyFightssScheduledForDeletion = null;
				}
			}

			if ($this->collTourneyFightss !== null) {
				foreach ($this->collTourneyFightss as $referrerFK) {
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

		$this->modifiedColumns[] = FightsPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . FightsPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(FightsPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(FightsPeer::ONEID)) {
			$modifiedColumns[':p' . $index++]  = '`ONEID`';
		}
		if ($this->isColumnModified(FightsPeer::TWOID)) {
			$modifiedColumns[':p' . $index++]  = '`TWOID`';
		}
		if ($this->isColumnModified(FightsPeer::ONEWINS)) {
			$modifiedColumns[':p' . $index++]  = '`ONEWINS`';
		}
		if ($this->isColumnModified(FightsPeer::TWOWINS)) {
			$modifiedColumns[':p' . $index++]  = '`TWOWINS`';
		}
		if ($this->isColumnModified(FightsPeer::ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`ACTIVE`';
		}

		$sql = sprintf(
			'INSERT INTO `fights` (%s) VALUES (%s)',
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
					case '`ONEID`':
						$stmt->bindValue($identifier, $this->oneid, PDO::PARAM_INT);
						break;
					case '`TWOID`':
						$stmt->bindValue($identifier, $this->twoid, PDO::PARAM_INT);
						break;
					case '`ONEWINS`':
						$stmt->bindValue($identifier, $this->onewins, PDO::PARAM_INT);
						break;
					case '`TWOWINS`':
						$stmt->bindValue($identifier, $this->twowins, PDO::PARAM_INT);
						break;
					case '`ACTIVE`':
						$stmt->bindValue($identifier, $this->active, PDO::PARAM_INT);
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aNamesRelatedByOneid !== null) {
				if (!$this->aNamesRelatedByOneid->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNamesRelatedByOneid->getValidationFailures());
				}
			}

			if ($this->aNamesRelatedByTwoid !== null) {
				if (!$this->aNamesRelatedByTwoid->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNamesRelatedByTwoid->getValidationFailures());
				}
			}


			if (($retval = FightsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPostss !== null) {
					foreach ($this->collPostss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTourneyFightss !== null) {
					foreach ($this->collTourneyFightss as $referrerFK) {
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
		$pos = FightsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOneid();
				break;
			case 2:
				return $this->getTwoid();
				break;
			case 3:
				return $this->getOnewins();
				break;
			case 4:
				return $this->getTwowins();
				break;
			case 5:
				return $this->getActive();
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
		if (isset($alreadyDumpedObjects['Fights'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Fights'][$this->getPrimaryKey()] = true;
		$keys = FightsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOneid(),
			$keys[2] => $this->getTwoid(),
			$keys[3] => $this->getOnewins(),
			$keys[4] => $this->getTwowins(),
			$keys[5] => $this->getActive(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aNamesRelatedByOneid) {
				$result['NamesRelatedByOneid'] = $this->aNamesRelatedByOneid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aNamesRelatedByTwoid) {
				$result['NamesRelatedByTwoid'] = $this->aNamesRelatedByTwoid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collPostss) {
				$result['Postss'] = $this->collPostss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collTourneyFightss) {
				$result['TourneyFightss'] = $this->collTourneyFightss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = FightsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOneid($value);
				break;
			case 2:
				$this->setTwoid($value);
				break;
			case 3:
				$this->setOnewins($value);
				break;
			case 4:
				$this->setTwowins($value);
				break;
			case 5:
				$this->setActive($value);
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
		$keys = FightsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOneid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTwoid($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOnewins($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTwowins($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActive($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FightsPeer::DATABASE_NAME);

		if ($this->isColumnModified(FightsPeer::ID)) $criteria->add(FightsPeer::ID, $this->id);
		if ($this->isColumnModified(FightsPeer::ONEID)) $criteria->add(FightsPeer::ONEID, $this->oneid);
		if ($this->isColumnModified(FightsPeer::TWOID)) $criteria->add(FightsPeer::TWOID, $this->twoid);
		if ($this->isColumnModified(FightsPeer::ONEWINS)) $criteria->add(FightsPeer::ONEWINS, $this->onewins);
		if ($this->isColumnModified(FightsPeer::TWOWINS)) $criteria->add(FightsPeer::TWOWINS, $this->twowins);
		if ($this->isColumnModified(FightsPeer::ACTIVE)) $criteria->add(FightsPeer::ACTIVE, $this->active);

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
		$criteria = new Criteria(FightsPeer::DATABASE_NAME);
		$criteria->add(FightsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Fights (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setOneid($this->getOneid());
		$copyObj->setTwoid($this->getTwoid());
		$copyObj->setOnewins($this->getOnewins());
		$copyObj->setTwowins($this->getTwowins());
		$copyObj->setActive($this->getActive());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPostss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPosts($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTourneyFightss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTourneyFights($relObj->copy($deepCopy));
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
	 * @return     Fights Clone of current object.
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
	 * @return     FightsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FightsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Names object.
	 *
	 * @param      Names $v
	 * @return     Fights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNamesRelatedByOneid(Names $v = null)
	{
		if ($v === null) {
			$this->setOneid(NULL);
		} else {
			$this->setOneid($v->getId());
		}

		$this->aNamesRelatedByOneid = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Names object, it will not be re-added.
		if ($v !== null) {
			$v->addFightsRelatedByOneid($this);
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
	public function getNamesRelatedByOneid(PropelPDO $con = null)
	{
		if ($this->aNamesRelatedByOneid === null && ($this->oneid !== null)) {
			$this->aNamesRelatedByOneid = NamesQuery::create()->findPk($this->oneid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aNamesRelatedByOneid->addFightssRelatedByOneid($this);
			 */
		}
		return $this->aNamesRelatedByOneid;
	}

	/**
	 * Declares an association between this object and a Names object.
	 *
	 * @param      Names $v
	 * @return     Fights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNamesRelatedByTwoid(Names $v = null)
	{
		if ($v === null) {
			$this->setTwoid(NULL);
		} else {
			$this->setTwoid($v->getId());
		}

		$this->aNamesRelatedByTwoid = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Names object, it will not be re-added.
		if ($v !== null) {
			$v->addFightsRelatedByTwoid($this);
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
	public function getNamesRelatedByTwoid(PropelPDO $con = null)
	{
		if ($this->aNamesRelatedByTwoid === null && ($this->twoid !== null)) {
			$this->aNamesRelatedByTwoid = NamesQuery::create()->findPk($this->twoid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aNamesRelatedByTwoid->addFightssRelatedByTwoid($this);
			 */
		}
		return $this->aNamesRelatedByTwoid;
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
		if ('Posts' == $relationName) {
			return $this->initPostss();
		}
		if ('TourneyFights' == $relationName) {
			return $this->initTourneyFightss();
		}
	}

	/**
	 * Clears out the collPostss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPostss()
	 */
	public function clearPostss()
	{
		$this->collPostss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPostss collection.
	 *
	 * By default this just sets the collPostss collection to an empty array (like clearcollPostss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPostss($overrideExisting = true)
	{
		if (null !== $this->collPostss && !$overrideExisting) {
			return;
		}
		$this->collPostss = new PropelObjectCollection();
		$this->collPostss->setModel('Posts');
	}

	/**
	 * Gets an array of Posts objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Fights is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Posts[] List of Posts objects
	 * @throws     PropelException
	 */
	public function getPostss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPostss || null !== $criteria) {
			if ($this->isNew() && null === $this->collPostss) {
				// return empty collection
				$this->initPostss();
			} else {
				$collPostss = PostsQuery::create(null, $criteria)
					->filterByFights($this)
					->find($con);
				if (null !== $criteria) {
					return $collPostss;
				}
				$this->collPostss = $collPostss;
			}
		}
		return $this->collPostss;
	}

	/**
	 * Sets a collection of Posts objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $postss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPostss(PropelCollection $postss, PropelPDO $con = null)
	{
		$this->postssScheduledForDeletion = $this->getPostss(new Criteria(), $con)->diff($postss);

		foreach ($postss as $posts) {
			// Fix issue with collection modified by reference
			if ($posts->isNew()) {
				$posts->setFights($this);
			}
			$this->addPosts($posts);
		}

		$this->collPostss = $postss;
	}

	/**
	 * Returns the number of related Posts objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Posts objects.
	 * @throws     PropelException
	 */
	public function countPostss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPostss || null !== $criteria) {
			if ($this->isNew() && null === $this->collPostss) {
				return 0;
			} else {
				$query = PostsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFights($this)
					->count($con);
			}
		} else {
			return count($this->collPostss);
		}
	}

	/**
	 * Method called to associate a Posts object to this object
	 * through the Posts foreign key attribute.
	 *
	 * @param      Posts $l Posts
	 * @return     Fights The current object (for fluent API support)
	 */
	public function addPosts(Posts $l)
	{
		if ($this->collPostss === null) {
			$this->initPostss();
		}
		if (!$this->collPostss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPosts($l);
		}

		return $this;
	}

	/**
	 * @param	Posts $posts The posts object to add.
	 */
	protected function doAddPosts($posts)
	{
		$this->collPostss[]= $posts;
		$posts->setFights($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Fights is new, it will return
	 * an empty collection; or if this Fights has previously
	 * been saved, it will retrieve related Postss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Fights.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Posts[] List of Posts objects
	 */
	public function getPostssJoinUserprofile($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PostsQuery::create(null, $criteria);
		$query->joinWith('Userprofile', $join_behavior);

		return $this->getPostss($query, $con);
	}

	/**
	 * Clears out the collTourneyFightss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTourneyFightss()
	 */
	public function clearTourneyFightss()
	{
		$this->collTourneyFightss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTourneyFightss collection.
	 *
	 * By default this just sets the collTourneyFightss collection to an empty array (like clearcollTourneyFightss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTourneyFightss($overrideExisting = true)
	{
		if (null !== $this->collTourneyFightss && !$overrideExisting) {
			return;
		}
		$this->collTourneyFightss = new PropelObjectCollection();
		$this->collTourneyFightss->setModel('TourneyFights');
	}

	/**
	 * Gets an array of TourneyFights objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Fights is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 * @throws     PropelException
	 */
	public function getTourneyFightss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightss) {
				// return empty collection
				$this->initTourneyFightss();
			} else {
				$collTourneyFightss = TourneyFightsQuery::create(null, $criteria)
					->filterByFights($this)
					->find($con);
				if (null !== $criteria) {
					return $collTourneyFightss;
				}
				$this->collTourneyFightss = $collTourneyFightss;
			}
		}
		return $this->collTourneyFightss;
	}

	/**
	 * Sets a collection of TourneyFights objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $tourneyFightss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTourneyFightss(PropelCollection $tourneyFightss, PropelPDO $con = null)
	{
		$this->tourneyFightssScheduledForDeletion = $this->getTourneyFightss(new Criteria(), $con)->diff($tourneyFightss);

		foreach ($tourneyFightss as $tourneyFights) {
			// Fix issue with collection modified by reference
			if ($tourneyFights->isNew()) {
				$tourneyFights->setFights($this);
			}
			$this->addTourneyFights($tourneyFights);
		}

		$this->collTourneyFightss = $tourneyFightss;
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
	public function countTourneyFightss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTourneyFightss || null !== $criteria) {
			if ($this->isNew() && null === $this->collTourneyFightss) {
				return 0;
			} else {
				$query = TourneyFightsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByFights($this)
					->count($con);
			}
		} else {
			return count($this->collTourneyFightss);
		}
	}

	/**
	 * Method called to associate a TourneyFights object to this object
	 * through the TourneyFights foreign key attribute.
	 *
	 * @param      TourneyFights $l TourneyFights
	 * @return     Fights The current object (for fluent API support)
	 */
	public function addTourneyFights(TourneyFights $l)
	{
		if ($this->collTourneyFightss === null) {
			$this->initTourneyFightss();
		}
		if (!$this->collTourneyFightss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTourneyFights($l);
		}

		return $this;
	}

	/**
	 * @param	TourneyFights $tourneyFights The tourneyFights object to add.
	 */
	protected function doAddTourneyFights($tourneyFights)
	{
		$this->collTourneyFightss[]= $tourneyFights;
		$tourneyFights->setFights($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Fights is new, it will return
	 * an empty collection; or if this Fights has previously
	 * been saved, it will retrieve related TourneyFightss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Fights.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssJoinTourneyRoundStatusRelatedByTourneyId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByTourneyId', $join_behavior);

		return $this->getTourneyFightss($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Fights is new, it will return
	 * an empty collection; or if this Fights has previously
	 * been saved, it will retrieve related TourneyFightss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Fights.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssJoinTourneyRoundStatusRelatedByRoundNumber($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyRoundStatusRelatedByRoundNumber', $join_behavior);

		return $this->getTourneyFightss($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Fights is new, it will return
	 * an empty collection; or if this Fights has previously
	 * been saved, it will retrieve related TourneyFightss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Fights.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssJoinTourneyFightersRelatedByOneid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByOneid', $join_behavior);

		return $this->getTourneyFightss($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Fights is new, it will return
	 * an empty collection; or if this Fights has previously
	 * been saved, it will retrieve related TourneyFightss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Fights.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyFights[] List of TourneyFights objects
	 */
	public function getTourneyFightssJoinTourneyFightersRelatedByTwoid($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyFightsQuery::create(null, $criteria);
		$query->joinWith('TourneyFightersRelatedByTwoid', $join_behavior);

		return $this->getTourneyFightss($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->oneid = null;
		$this->twoid = null;
		$this->onewins = null;
		$this->twowins = null;
		$this->active = null;
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
			if ($this->collPostss) {
				foreach ($this->collPostss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyFightss) {
				foreach ($this->collTourneyFightss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collPostss instanceof PropelCollection) {
			$this->collPostss->clearIterator();
		}
		$this->collPostss = null;
		if ($this->collTourneyFightss instanceof PropelCollection) {
			$this->collTourneyFightss->clearIterator();
		}
		$this->collTourneyFightss = null;
		$this->aNamesRelatedByOneid = null;
		$this->aNamesRelatedByTwoid = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(FightsPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseFights
