<?php


/**
 * Base class that represents a row from the 'image' table.
 *
 * Metadata for stored images
 *
 * @package    propel.generator.models.om
 */
abstract class BaseImage extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ImagePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ImagePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the datatype field.
	 * Note: this column has a database default value of: 'application/octet-stream'
	 * @var        string
	 */
	protected $datatype;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the size field.
	 * @var        string
	 */
	protected $size;

	/**
	 * The value for the date_added field.
	 * @var        string
	 */
	protected $date_added;

	/**
	 * @var        array ImageData[] Collection to store aggregation of ImageData objects.
	 */
	protected $collImageDatas;

	/**
	 * @var        array Ad[] Collection to store aggregation of Ad objects.
	 */
	protected $collAds;

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
	protected $imageDatasScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $adsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->datatype = 'application/octet-stream';
	}

	/**
	 * Initializes internal state of BaseImage object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * ID for the image
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [datatype] column value.
	 * Image type
	 * @return     string
	 */
	public function getDatatype()
	{
		return $this->datatype;
	}

	/**
	 * Get the [name] column value.
	 * Filename of the image
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [size] column value.
	 * Size of the image
	 * @return     string
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Get the [optionally formatted] temporal [date_added] column value.
	 * Date the image was added
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDateAdded($format = 'Y-m-d H:i:s')
	{
		if ($this->date_added === null) {
			return null;
		}


		if ($this->date_added === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->date_added);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_added, true), $x);
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
	 * Set the value of [id] column.
	 * ID for the image
	 * @param      int $v new value
	 * @return     Image The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ImagePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [datatype] column.
	 * Image type
	 * @param      string $v new value
	 * @return     Image The current object (for fluent API support)
	 */
	public function setDatatype($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->datatype !== $v) {
			$this->datatype = $v;
			$this->modifiedColumns[] = ImagePeer::DATATYPE;
		}

		return $this;
	} // setDatatype()

	/**
	 * Set the value of [name] column.
	 * Filename of the image
	 * @param      string $v new value
	 * @return     Image The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ImagePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [size] column.
	 * Size of the image
	 * @param      string $v new value
	 * @return     Image The current object (for fluent API support)
	 */
	public function setSize($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = ImagePeer::SIZE;
		}

		return $this;
	} // setSize()

	/**
	 * Sets the value of [date_added] column to a normalized version of the date/time value specified.
	 * Date the image was added
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Image The current object (for fluent API support)
	 */
	public function setDateAdded($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->date_added !== null || $dt !== null) {
			$currentDateAsString = ($this->date_added !== null && $tmpDt = new DateTime($this->date_added)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->date_added = $newDateAsString;
				$this->modifiedColumns[] = ImagePeer::DATE_ADDED;
			}
		} // if either are not null

		return $this;
	} // setDateAdded()

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
			if ($this->datatype !== 'application/octet-stream') {
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
			$this->datatype = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->size = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->date_added = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = ImagePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Image object", $e);
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
			$con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ImagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collImageDatas = null;

			$this->collAds = null;

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
			$con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ImageQuery::create()
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
			$con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ImagePeer::addInstanceToPool($this);
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

			if ($this->imageDatasScheduledForDeletion !== null) {
				if (!$this->imageDatasScheduledForDeletion->isEmpty()) {
					ImageDataQuery::create()
						->filterByPrimaryKeys($this->imageDatasScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->imageDatasScheduledForDeletion = null;
				}
			}

			if ($this->collImageDatas !== null) {
				foreach ($this->collImageDatas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->adsScheduledForDeletion !== null) {
				if (!$this->adsScheduledForDeletion->isEmpty()) {
					AdQuery::create()
						->filterByPrimaryKeys($this->adsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->adsScheduledForDeletion = null;
				}
			}

			if ($this->collAds !== null) {
				foreach ($this->collAds as $referrerFK) {
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

		$this->modifiedColumns[] = ImagePeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ImagePeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ImagePeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(ImagePeer::DATATYPE)) {
			$modifiedColumns[':p' . $index++]  = '`DATATYPE`';
		}
		if ($this->isColumnModified(ImagePeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(ImagePeer::SIZE)) {
			$modifiedColumns[':p' . $index++]  = '`SIZE`';
		}
		if ($this->isColumnModified(ImagePeer::DATE_ADDED)) {
			$modifiedColumns[':p' . $index++]  = '`DATE_ADDED`';
		}

		$sql = sprintf(
			'INSERT INTO `image` (%s) VALUES (%s)',
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
					case '`DATATYPE`':
						$stmt->bindValue($identifier, $this->datatype, PDO::PARAM_STR);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`SIZE`':
						$stmt->bindValue($identifier, $this->size, PDO::PARAM_INT);
						break;
					case '`DATE_ADDED`':
						$stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
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


			if (($retval = ImagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collImageDatas !== null) {
					foreach ($this->collImageDatas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAds !== null) {
					foreach ($this->collAds as $referrerFK) {
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
		$pos = ImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDatatype();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getSize();
				break;
			case 4:
				return $this->getDateAdded();
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
		if (isset($alreadyDumpedObjects['Image'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Image'][$this->getPrimaryKey()] = true;
		$keys = ImagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDatatype(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getSize(),
			$keys[4] => $this->getDateAdded(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collImageDatas) {
				$result['ImageDatas'] = $this->collImageDatas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collAds) {
				$result['Ads'] = $this->collAds->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = ImagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDatatype($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setSize($value);
				break;
			case 4:
				$this->setDateAdded($value);
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
		$keys = ImagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDatatype($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSize($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDateAdded($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ImagePeer::DATABASE_NAME);

		if ($this->isColumnModified(ImagePeer::ID)) $criteria->add(ImagePeer::ID, $this->id);
		if ($this->isColumnModified(ImagePeer::DATATYPE)) $criteria->add(ImagePeer::DATATYPE, $this->datatype);
		if ($this->isColumnModified(ImagePeer::NAME)) $criteria->add(ImagePeer::NAME, $this->name);
		if ($this->isColumnModified(ImagePeer::SIZE)) $criteria->add(ImagePeer::SIZE, $this->size);
		if ($this->isColumnModified(ImagePeer::DATE_ADDED)) $criteria->add(ImagePeer::DATE_ADDED, $this->date_added);

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
		$criteria = new Criteria(ImagePeer::DATABASE_NAME);
		$criteria->add(ImagePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Image (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setDatatype($this->getDatatype());
		$copyObj->setName($this->getName());
		$copyObj->setSize($this->getSize());
		$copyObj->setDateAdded($this->getDateAdded());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getImageDatas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addImageData($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAds() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAd($relObj->copy($deepCopy));
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
	 * @return     Image Clone of current object.
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
	 * @return     ImagePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ImagePeer();
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
		if ('ImageData' == $relationName) {
			return $this->initImageDatas();
		}
		if ('Ad' == $relationName) {
			return $this->initAds();
		}
	}

	/**
	 * Clears out the collImageDatas collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addImageDatas()
	 */
	public function clearImageDatas()
	{
		$this->collImageDatas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collImageDatas collection.
	 *
	 * By default this just sets the collImageDatas collection to an empty array (like clearcollImageDatas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initImageDatas($overrideExisting = true)
	{
		if (null !== $this->collImageDatas && !$overrideExisting) {
			return;
		}
		$this->collImageDatas = new PropelObjectCollection();
		$this->collImageDatas->setModel('ImageData');
	}

	/**
	 * Gets an array of ImageData objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Image is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ImageData[] List of ImageData objects
	 * @throws     PropelException
	 */
	public function getImageDatas($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collImageDatas || null !== $criteria) {
			if ($this->isNew() && null === $this->collImageDatas) {
				// return empty collection
				$this->initImageDatas();
			} else {
				$collImageDatas = ImageDataQuery::create(null, $criteria)
					->filterByImage($this)
					->find($con);
				if (null !== $criteria) {
					return $collImageDatas;
				}
				$this->collImageDatas = $collImageDatas;
			}
		}
		return $this->collImageDatas;
	}

	/**
	 * Sets a collection of ImageData objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $imageDatas A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setImageDatas(PropelCollection $imageDatas, PropelPDO $con = null)
	{
		$this->imageDatasScheduledForDeletion = $this->getImageDatas(new Criteria(), $con)->diff($imageDatas);

		foreach ($imageDatas as $imageData) {
			// Fix issue with collection modified by reference
			if ($imageData->isNew()) {
				$imageData->setImage($this);
			}
			$this->addImageData($imageData);
		}

		$this->collImageDatas = $imageDatas;
	}

	/**
	 * Returns the number of related ImageData objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ImageData objects.
	 * @throws     PropelException
	 */
	public function countImageDatas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collImageDatas || null !== $criteria) {
			if ($this->isNew() && null === $this->collImageDatas) {
				return 0;
			} else {
				$query = ImageDataQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByImage($this)
					->count($con);
			}
		} else {
			return count($this->collImageDatas);
		}
	}

	/**
	 * Method called to associate a ImageData object to this object
	 * through the ImageData foreign key attribute.
	 *
	 * @param      ImageData $l ImageData
	 * @return     Image The current object (for fluent API support)
	 */
	public function addImageData(ImageData $l)
	{
		if ($this->collImageDatas === null) {
			$this->initImageDatas();
		}
		if (!$this->collImageDatas->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddImageData($l);
		}

		return $this;
	}

	/**
	 * @param	ImageData $imageData The imageData object to add.
	 */
	protected function doAddImageData($imageData)
	{
		$this->collImageDatas[]= $imageData;
		$imageData->setImage($this);
	}

	/**
	 * Clears out the collAds collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAds()
	 */
	public function clearAds()
	{
		$this->collAds = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAds collection.
	 *
	 * By default this just sets the collAds collection to an empty array (like clearcollAds());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initAds($overrideExisting = true)
	{
		if (null !== $this->collAds && !$overrideExisting) {
			return;
		}
		$this->collAds = new PropelObjectCollection();
		$this->collAds->setModel('Ad');
	}

	/**
	 * Gets an array of Ad objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Image is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Ad[] List of Ad objects
	 * @throws     PropelException
	 */
	public function getAds($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collAds || null !== $criteria) {
			if ($this->isNew() && null === $this->collAds) {
				// return empty collection
				$this->initAds();
			} else {
				$collAds = AdQuery::create(null, $criteria)
					->filterByImage($this)
					->find($con);
				if (null !== $criteria) {
					return $collAds;
				}
				$this->collAds = $collAds;
			}
		}
		return $this->collAds;
	}

	/**
	 * Sets a collection of Ad objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $ads A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setAds(PropelCollection $ads, PropelPDO $con = null)
	{
		$this->adsScheduledForDeletion = $this->getAds(new Criteria(), $con)->diff($ads);

		foreach ($ads as $ad) {
			// Fix issue with collection modified by reference
			if ($ad->isNew()) {
				$ad->setImage($this);
			}
			$this->addAd($ad);
		}

		$this->collAds = $ads;
	}

	/**
	 * Returns the number of related Ad objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Ad objects.
	 * @throws     PropelException
	 */
	public function countAds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collAds || null !== $criteria) {
			if ($this->isNew() && null === $this->collAds) {
				return 0;
			} else {
				$query = AdQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByImage($this)
					->count($con);
			}
		} else {
			return count($this->collAds);
		}
	}

	/**
	 * Method called to associate a Ad object to this object
	 * through the Ad foreign key attribute.
	 *
	 * @param      Ad $l Ad
	 * @return     Image The current object (for fluent API support)
	 */
	public function addAd(Ad $l)
	{
		if ($this->collAds === null) {
			$this->initAds();
		}
		if (!$this->collAds->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddAd($l);
		}

		return $this;
	}

	/**
	 * @param	Ad $ad The ad object to add.
	 */
	protected function doAddAd($ad)
	{
		$this->collAds[]= $ad;
		$ad->setImage($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->datatype = null;
		$this->name = null;
		$this->size = null;
		$this->date_added = null;
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
			if ($this->collImageDatas) {
				foreach ($this->collImageDatas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAds) {
				foreach ($this->collAds as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collImageDatas instanceof PropelCollection) {
			$this->collImageDatas->clearIterator();
		}
		$this->collImageDatas = null;
		if ($this->collAds instanceof PropelCollection) {
			$this->collAds->clearIterator();
		}
		$this->collAds = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ImagePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseImage
