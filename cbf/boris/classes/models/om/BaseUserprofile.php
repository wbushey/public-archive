<?php


/**
 * Base class that represents a row from the 'userProfile' table.
 *
 * User account information
 *
 * @package    propel.generator.models.om
 */
abstract class BaseUserprofile extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'UserprofilePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserprofilePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * The value for the usertype field.
	 * @var        int
	 */
	protected $usertype;

	/**
	 * The value for the emailaddress field.
	 * @var        string
	 */
	protected $emailaddress;

	/**
	 * The value for the ip field.
	 * @var        string
	 */
	protected $ip;

	/**
	 * @var        array Posts[] Collection to store aggregation of Posts objects.
	 */
	protected $collPostss;

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
	protected $postssScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $tourneyUserActionsScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 * ID for the user account
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [username] column value.
	 * Username for the account
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [password] column value.
	 * Encrypted password for the account
	 * @return     string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the [usertype] column value.
	 * Indicates why type of user a profile belongs to
	 * @return     int
	 */
	public function getUsertype()
	{
		return $this->usertype;
	}

	/**
	 * Get the [emailaddress] column value.
	 * Email address for the account
	 * @return     string
	 */
	public function getEmailaddress()
	{
		return $this->emailaddress;
	}

	/**
	 * Get the [ip] column value.
	 * IP address that the user last logged in with
	 * @return     string
	 */
	public function getIp()
	{
		return $this->ip;
	}

	/**
	 * Set the value of [id] column.
	 * ID for the user account
	 * @param      int $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserprofilePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * Username for the account
	 * @param      string $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserprofilePeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [password] column.
	 * Encrypted password for the account
	 * @param      string $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserprofilePeer::PASSWORD;
		}

		return $this;
	} // setPassword()

	/**
	 * Set the value of [usertype] column.
	 * Indicates why type of user a profile belongs to
	 * @param      int $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setUsertype($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->usertype !== $v) {
			$this->usertype = $v;
			$this->modifiedColumns[] = UserprofilePeer::USERTYPE;
		}

		return $this;
	} // setUsertype()

	/**
	 * Set the value of [emailaddress] column.
	 * Email address for the account
	 * @param      string $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setEmailaddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->emailaddress !== $v) {
			$this->emailaddress = $v;
			$this->modifiedColumns[] = UserprofilePeer::EMAILADDRESS;
		}

		return $this;
	} // setEmailaddress()

	/**
	 * Set the value of [ip] column.
	 * IP address that the user last logged in with
	 * @param      string $v new value
	 * @return     Userprofile The current object (for fluent API support)
	 */
	public function setIp($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ip !== $v) {
			$this->ip = $v;
			$this->modifiedColumns[] = UserprofilePeer::IP;
		}

		return $this;
	} // setIp()

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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->password = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->usertype = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->emailaddress = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ip = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = UserprofilePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Userprofile object", $e);
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
			$con = Propel::getConnection(UserprofilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UserprofilePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collPostss = null;

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
			$con = Propel::getConnection(UserprofilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = UserprofileQuery::create()
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
			$con = Propel::getConnection(UserprofilePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				UserprofilePeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = UserprofilePeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserprofilePeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(UserprofilePeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(UserprofilePeer::USERNAME)) {
			$modifiedColumns[':p' . $index++]  = '`USERNAME`';
		}
		if ($this->isColumnModified(UserprofilePeer::PASSWORD)) {
			$modifiedColumns[':p' . $index++]  = '`PASSWORD`';
		}
		if ($this->isColumnModified(UserprofilePeer::USERTYPE)) {
			$modifiedColumns[':p' . $index++]  = '`USERTYPE`';
		}
		if ($this->isColumnModified(UserprofilePeer::EMAILADDRESS)) {
			$modifiedColumns[':p' . $index++]  = '`EMAILADDRESS`';
		}
		if ($this->isColumnModified(UserprofilePeer::IP)) {
			$modifiedColumns[':p' . $index++]  = '`IP`';
		}

		$sql = sprintf(
			'INSERT INTO `userProfile` (%s) VALUES (%s)',
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
					case '`USERNAME`':
						$stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
						break;
					case '`PASSWORD`':
						$stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
						break;
					case '`USERTYPE`':
						$stmt->bindValue($identifier, $this->usertype, PDO::PARAM_INT);
						break;
					case '`EMAILADDRESS`':
						$stmt->bindValue($identifier, $this->emailaddress, PDO::PARAM_STR);
						break;
					case '`IP`':
						$stmt->bindValue($identifier, $this->ip, PDO::PARAM_STR);
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


			if (($retval = UserprofilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPostss !== null) {
					foreach ($this->collPostss as $referrerFK) {
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
		$pos = UserprofilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getPassword();
				break;
			case 3:
				return $this->getUsertype();
				break;
			case 4:
				return $this->getEmailaddress();
				break;
			case 5:
				return $this->getIp();
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
		if (isset($alreadyDumpedObjects['Userprofile'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Userprofile'][$this->getPrimaryKey()] = true;
		$keys = UserprofilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getPassword(),
			$keys[3] => $this->getUsertype(),
			$keys[4] => $this->getEmailaddress(),
			$keys[5] => $this->getIp(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collPostss) {
				$result['Postss'] = $this->collPostss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = UserprofilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setPassword($value);
				break;
			case 3:
				$this->setUsertype($value);
				break;
			case 4:
				$this->setEmailaddress($value);
				break;
			case 5:
				$this->setIp($value);
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
		$keys = UserprofilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPassword($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUsertype($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmailaddress($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIp($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserprofilePeer::DATABASE_NAME);

		if ($this->isColumnModified(UserprofilePeer::ID)) $criteria->add(UserprofilePeer::ID, $this->id);
		if ($this->isColumnModified(UserprofilePeer::USERNAME)) $criteria->add(UserprofilePeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserprofilePeer::PASSWORD)) $criteria->add(UserprofilePeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserprofilePeer::USERTYPE)) $criteria->add(UserprofilePeer::USERTYPE, $this->usertype);
		if ($this->isColumnModified(UserprofilePeer::EMAILADDRESS)) $criteria->add(UserprofilePeer::EMAILADDRESS, $this->emailaddress);
		if ($this->isColumnModified(UserprofilePeer::IP)) $criteria->add(UserprofilePeer::IP, $this->ip);

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
		$criteria = new Criteria(UserprofilePeer::DATABASE_NAME);
		$criteria->add(UserprofilePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Userprofile (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUsername($this->getUsername());
		$copyObj->setPassword($this->getPassword());
		$copyObj->setUsertype($this->getUsertype());
		$copyObj->setEmailaddress($this->getEmailaddress());
		$copyObj->setIp($this->getIp());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPostss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPosts($relObj->copy($deepCopy));
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
	 * @return     Userprofile Clone of current object.
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
	 * @return     UserprofilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserprofilePeer();
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
		if ('Posts' == $relationName) {
			return $this->initPostss();
		}
		if ('TourneyUserAction' == $relationName) {
			return $this->initTourneyUserActions();
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
	 * If this Userprofile is new, it will return
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
					->filterByUserprofile($this)
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
				$posts->setUserprofile($this);
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
					->filterByUserprofile($this)
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
	 * @return     Userprofile The current object (for fluent API support)
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
		$posts->setUserprofile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Userprofile is new, it will return
	 * an empty collection; or if this Userprofile has previously
	 * been saved, it will retrieve related Postss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Userprofile.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Posts[] List of Posts objects
	 */
	public function getPostssJoinFights($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PostsQuery::create(null, $criteria);
		$query->joinWith('Fights', $join_behavior);

		return $this->getPostss($query, $con);
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
	 * If this Userprofile is new, it will return
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
					->filterByUserprofile($this)
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
				$tourneyUserAction->setUserprofile($this);
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
					->filterByUserprofile($this)
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
	 * @return     Userprofile The current object (for fluent API support)
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
		$tourneyUserAction->setUserprofile($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Userprofile is new, it will return
	 * an empty collection; or if this Userprofile has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Userprofile.
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
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Userprofile is new, it will return
	 * an empty collection; or if this Userprofile has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Userprofile.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array TourneyUserAction[] List of TourneyUserAction objects
	 */
	public function getTourneyUserActionsJoinTourneyFighters($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = TourneyUserActionQuery::create(null, $criteria);
		$query->joinWith('TourneyFighters', $join_behavior);

		return $this->getTourneyUserActions($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->username = null;
		$this->password = null;
		$this->usertype = null;
		$this->emailaddress = null;
		$this->ip = null;
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
			if ($this->collPostss) {
				foreach ($this->collPostss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTourneyUserActions) {
				foreach ($this->collTourneyUserActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collPostss instanceof PropelCollection) {
			$this->collPostss->clearIterator();
		}
		$this->collPostss = null;
		if ($this->collTourneyUserActions instanceof PropelCollection) {
			$this->collTourneyUserActions->clearIterator();
		}
		$this->collTourneyUserActions = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(UserprofilePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseUserprofile
