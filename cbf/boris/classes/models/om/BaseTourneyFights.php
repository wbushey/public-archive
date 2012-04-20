<?php


/**
 * Base class that represents a row from the 'tourney_fights' table.
 *
 * Listing and recording of tournament fights.
 *
 * @package    propel.generator.models.om
 */
abstract class BaseTourneyFights extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'TourneyFightsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TourneyFightsPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

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
	 * The value for the general_fight_id field.
	 * @var        int
	 */
	protected $general_fight_id;

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
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $onewins;

	/**
	 * The value for the twowins field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $twowins;

	/**
	 * The value for the child_right field.
	 * @var        int
	 */
	protected $child_right;

	/**
	 * The value for the child_left field.
	 * @var        int
	 */
	protected $child_left;

	/**
	 * The value for the parent field.
	 * @var        int
	 */
	protected $parent;

	/**
	 * @var        TourneyRoundStatus
	 */
	protected $aTourneyRoundStatusRelatedByTourneyId;

	/**
	 * @var        TourneyRoundStatus
	 */
	protected $aTourneyRoundStatusRelatedByRoundNumber;

	/**
	 * @var        Fights
	 */
	protected $aFights;

	/**
	 * @var        TourneyFighters
	 */
	protected $aTourneyFightersRelatedByOneid;

	/**
	 * @var        TourneyFighters
	 */
	protected $aTourneyFightersRelatedByTwoid;

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
	protected $tourneyUserActionsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->onewins = 0;
		$this->twowins = 0;
	}

	/**
	 * Initializes internal state of BaseTourneyFights object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * ID of the fight
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [tourney_id] column value.
	 * Tournament that the fight is apart of.
	 * @return     int
	 */
	public function getTourneyId()
	{
		return $this->tourney_id;
	}

	/**
	 * Get the [round_number] column value.
	 * Round number that the fight is in.
	 * @return     int
	 */
	public function getRoundNumber()
	{
		return $this->round_number;
	}

	/**
	 * Get the [general_fight_id] column value.
	 * ID of the non-tournament fight that is related.
	 * @return     int
	 */
	public function getGeneralFightId()
	{
		return $this->general_fight_id;
	}

	/**
	 * Get the [oneid] column value.
	 * ID of fighter one.
	 * @return     int
	 */
	public function getOneid()
	{
		return $this->oneid;
	}

	/**
	 * Get the [twoid] column value.
	 * ID of fighter two.
	 * @return     int
	 */
	public function getTwoid()
	{
		return $this->twoid;
	}

	/**
	 * Get the [onewins] column value.
	 * Wins for fighter one.
	 * @return     int
	 */
	public function getOnewins()
	{
		return $this->onewins;
	}

	/**
	 * Get the [twowins] column value.
	 * Wins for fighter two.
	 * @return     int
	 */
	public function getTwowins()
	{
		return $this->twowins;
	}

	/**
	 * Get the [child_right] column value.
	 * ID of the right child.
	 * @return     int
	 */
	public function getChildRight()
	{
		return $this->child_right;
	}

	/**
	 * Get the [child_left] column value.
	 * ID of the left child.
	 * @return     int
	 */
	public function getChildLeft()
	{
		return $this->child_left;
	}

	/**
	 * Get the [parent] column value.
	 * ID of the parent.
	 * @return     int
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Set the value of [id] column.
	 * ID of the fight
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [tourney_id] column.
	 * Tournament that the fight is apart of.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setTourneyId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tourney_id !== $v) {
			$this->tourney_id = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::TOURNEY_ID;
		}

		if ($this->aTourneyRoundStatusRelatedByTourneyId !== null && $this->aTourneyRoundStatusRelatedByTourneyId->getTourneyId() !== $v) {
			$this->aTourneyRoundStatusRelatedByTourneyId = null;
		}

		return $this;
	} // setTourneyId()

	/**
	 * Set the value of [round_number] column.
	 * Round number that the fight is in.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setRoundNumber($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->round_number !== $v) {
			$this->round_number = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::ROUND_NUMBER;
		}

		if ($this->aTourneyRoundStatusRelatedByRoundNumber !== null && $this->aTourneyRoundStatusRelatedByRoundNumber->getRoundNumber() !== $v) {
			$this->aTourneyRoundStatusRelatedByRoundNumber = null;
		}

		return $this;
	} // setRoundNumber()

	/**
	 * Set the value of [general_fight_id] column.
	 * ID of the non-tournament fight that is related.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setGeneralFightId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->general_fight_id !== $v) {
			$this->general_fight_id = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::GENERAL_FIGHT_ID;
		}

		if ($this->aFights !== null && $this->aFights->getId() !== $v) {
			$this->aFights = null;
		}

		return $this;
	} // setGeneralFightId()

	/**
	 * Set the value of [oneid] column.
	 * ID of fighter one.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setOneid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oneid !== $v) {
			$this->oneid = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::ONEID;
		}

		if ($this->aTourneyFightersRelatedByOneid !== null && $this->aTourneyFightersRelatedByOneid->getFighterId() !== $v) {
			$this->aTourneyFightersRelatedByOneid = null;
		}

		return $this;
	} // setOneid()

	/**
	 * Set the value of [twoid] column.
	 * ID of fighter two.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setTwoid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->twoid !== $v) {
			$this->twoid = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::TWOID;
		}

		if ($this->aTourneyFightersRelatedByTwoid !== null && $this->aTourneyFightersRelatedByTwoid->getFighterId() !== $v) {
			$this->aTourneyFightersRelatedByTwoid = null;
		}

		return $this;
	} // setTwoid()

	/**
	 * Set the value of [onewins] column.
	 * Wins for fighter one.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setOnewins($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->onewins !== $v) {
			$this->onewins = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::ONEWINS;
		}

		return $this;
	} // setOnewins()

	/**
	 * Set the value of [twowins] column.
	 * Wins for fighter two.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setTwowins($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->twowins !== $v) {
			$this->twowins = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::TWOWINS;
		}

		return $this;
	} // setTwowins()

	/**
	 * Set the value of [child_right] column.
	 * ID of the right child.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setChildRight($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->child_right !== $v) {
			$this->child_right = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::CHILD_RIGHT;
		}

		return $this;
	} // setChildRight()

	/**
	 * Set the value of [child_left] column.
	 * ID of the left child.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setChildLeft($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->child_left !== $v) {
			$this->child_left = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::CHILD_LEFT;
		}

		return $this;
	} // setChildLeft()

	/**
	 * Set the value of [parent] column.
	 * ID of the parent.
	 * @param      int $v new value
	 * @return     TourneyFights The current object (for fluent API support)
	 */
	public function setParent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent !== $v) {
			$this->parent = $v;
			$this->modifiedColumns[] = TourneyFightsPeer::PARENT;
		}

		return $this;
	} // setParent()

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
			if ($this->onewins !== 0) {
				return false;
			}

			if ($this->twowins !== 0) {
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
			$this->tourney_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->round_number = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->general_fight_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->oneid = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->twoid = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->onewins = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->twowins = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->child_right = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->child_left = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->parent = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = TourneyFightsPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating TourneyFights object", $e);
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

		if ($this->aTourneyRoundStatusRelatedByTourneyId !== null && $this->tourney_id !== $this->aTourneyRoundStatusRelatedByTourneyId->getTourneyId()) {
			$this->aTourneyRoundStatusRelatedByTourneyId = null;
		}
		if ($this->aTourneyRoundStatusRelatedByRoundNumber !== null && $this->round_number !== $this->aTourneyRoundStatusRelatedByRoundNumber->getRoundNumber()) {
			$this->aTourneyRoundStatusRelatedByRoundNumber = null;
		}
		if ($this->aFights !== null && $this->general_fight_id !== $this->aFights->getId()) {
			$this->aFights = null;
		}
		if ($this->aTourneyFightersRelatedByOneid !== null && $this->oneid !== $this->aTourneyFightersRelatedByOneid->getFighterId()) {
			$this->aTourneyFightersRelatedByOneid = null;
		}
		if ($this->aTourneyFightersRelatedByTwoid !== null && $this->twoid !== $this->aTourneyFightersRelatedByTwoid->getFighterId()) {
			$this->aTourneyFightersRelatedByTwoid = null;
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
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TourneyFightsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aTourneyRoundStatusRelatedByTourneyId = null;
			$this->aTourneyRoundStatusRelatedByRoundNumber = null;
			$this->aFights = null;
			$this->aTourneyFightersRelatedByOneid = null;
			$this->aTourneyFightersRelatedByTwoid = null;
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
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = TourneyFightsQuery::create()
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
			$con = Propel::getConnection(TourneyFightsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				TourneyFightsPeer::addInstanceToPool($this);
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

			if ($this->aTourneyRoundStatusRelatedByTourneyId !== null) {
				if ($this->aTourneyRoundStatusRelatedByTourneyId->isModified() || $this->aTourneyRoundStatusRelatedByTourneyId->isNew()) {
					$affectedRows += $this->aTourneyRoundStatusRelatedByTourneyId->save($con);
				}
				$this->setTourneyRoundStatusRelatedByTourneyId($this->aTourneyRoundStatusRelatedByTourneyId);
			}

			if ($this->aTourneyRoundStatusRelatedByRoundNumber !== null) {
				if ($this->aTourneyRoundStatusRelatedByRoundNumber->isModified() || $this->aTourneyRoundStatusRelatedByRoundNumber->isNew()) {
					$affectedRows += $this->aTourneyRoundStatusRelatedByRoundNumber->save($con);
				}
				$this->setTourneyRoundStatusRelatedByRoundNumber($this->aTourneyRoundStatusRelatedByRoundNumber);
			}

			if ($this->aFights !== null) {
				if ($this->aFights->isModified() || $this->aFights->isNew()) {
					$affectedRows += $this->aFights->save($con);
				}
				$this->setFights($this->aFights);
			}

			if ($this->aTourneyFightersRelatedByOneid !== null) {
				if ($this->aTourneyFightersRelatedByOneid->isModified() || $this->aTourneyFightersRelatedByOneid->isNew()) {
					$affectedRows += $this->aTourneyFightersRelatedByOneid->save($con);
				}
				$this->setTourneyFightersRelatedByOneid($this->aTourneyFightersRelatedByOneid);
			}

			if ($this->aTourneyFightersRelatedByTwoid !== null) {
				if ($this->aTourneyFightersRelatedByTwoid->isModified() || $this->aTourneyFightersRelatedByTwoid->isNew()) {
					$affectedRows += $this->aTourneyFightersRelatedByTwoid->save($con);
				}
				$this->setTourneyFightersRelatedByTwoid($this->aTourneyFightersRelatedByTwoid);
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

		$this->modifiedColumns[] = TourneyFightsPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . TourneyFightsPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(TourneyFightsPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::TOURNEY_ID)) {
			$modifiedColumns[':p' . $index++]  = '`TOURNEY_ID`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::ROUND_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`ROUND_NUMBER`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::GENERAL_FIGHT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`GENERAL_FIGHT_ID`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::ONEID)) {
			$modifiedColumns[':p' . $index++]  = '`ONEID`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::TWOID)) {
			$modifiedColumns[':p' . $index++]  = '`TWOID`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::ONEWINS)) {
			$modifiedColumns[':p' . $index++]  = '`ONEWINS`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::TWOWINS)) {
			$modifiedColumns[':p' . $index++]  = '`TWOWINS`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::CHILD_RIGHT)) {
			$modifiedColumns[':p' . $index++]  = '`CHILD_RIGHT`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::CHILD_LEFT)) {
			$modifiedColumns[':p' . $index++]  = '`CHILD_LEFT`';
		}
		if ($this->isColumnModified(TourneyFightsPeer::PARENT)) {
			$modifiedColumns[':p' . $index++]  = '`PARENT`';
		}

		$sql = sprintf(
			'INSERT INTO `tourney_fights` (%s) VALUES (%s)',
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
					case '`TOURNEY_ID`':
						$stmt->bindValue($identifier, $this->tourney_id, PDO::PARAM_INT);
						break;
					case '`ROUND_NUMBER`':
						$stmt->bindValue($identifier, $this->round_number, PDO::PARAM_INT);
						break;
					case '`GENERAL_FIGHT_ID`':
						$stmt->bindValue($identifier, $this->general_fight_id, PDO::PARAM_INT);
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
					case '`CHILD_RIGHT`':
						$stmt->bindValue($identifier, $this->child_right, PDO::PARAM_INT);
						break;
					case '`CHILD_LEFT`':
						$stmt->bindValue($identifier, $this->child_left, PDO::PARAM_INT);
						break;
					case '`PARENT`':
						$stmt->bindValue($identifier, $this->parent, PDO::PARAM_INT);
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

			if ($this->aTourneyRoundStatusRelatedByTourneyId !== null) {
				if (!$this->aTourneyRoundStatusRelatedByTourneyId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTourneyRoundStatusRelatedByTourneyId->getValidationFailures());
				}
			}

			if ($this->aTourneyRoundStatusRelatedByRoundNumber !== null) {
				if (!$this->aTourneyRoundStatusRelatedByRoundNumber->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTourneyRoundStatusRelatedByRoundNumber->getValidationFailures());
				}
			}

			if ($this->aFights !== null) {
				if (!$this->aFights->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFights->getValidationFailures());
				}
			}

			if ($this->aTourneyFightersRelatedByOneid !== null) {
				if (!$this->aTourneyFightersRelatedByOneid->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTourneyFightersRelatedByOneid->getValidationFailures());
				}
			}

			if ($this->aTourneyFightersRelatedByTwoid !== null) {
				if (!$this->aTourneyFightersRelatedByTwoid->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTourneyFightersRelatedByTwoid->getValidationFailures());
				}
			}


			if (($retval = TourneyFightsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = TourneyFightsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTourneyId();
				break;
			case 2:
				return $this->getRoundNumber();
				break;
			case 3:
				return $this->getGeneralFightId();
				break;
			case 4:
				return $this->getOneid();
				break;
			case 5:
				return $this->getTwoid();
				break;
			case 6:
				return $this->getOnewins();
				break;
			case 7:
				return $this->getTwowins();
				break;
			case 8:
				return $this->getChildRight();
				break;
			case 9:
				return $this->getChildLeft();
				break;
			case 10:
				return $this->getParent();
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
		if (isset($alreadyDumpedObjects['TourneyFights'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['TourneyFights'][$this->getPrimaryKey()] = true;
		$keys = TourneyFightsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTourneyId(),
			$keys[2] => $this->getRoundNumber(),
			$keys[3] => $this->getGeneralFightId(),
			$keys[4] => $this->getOneid(),
			$keys[5] => $this->getTwoid(),
			$keys[6] => $this->getOnewins(),
			$keys[7] => $this->getTwowins(),
			$keys[8] => $this->getChildRight(),
			$keys[9] => $this->getChildLeft(),
			$keys[10] => $this->getParent(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aTourneyRoundStatusRelatedByTourneyId) {
				$result['TourneyRoundStatusRelatedByTourneyId'] = $this->aTourneyRoundStatusRelatedByTourneyId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aTourneyRoundStatusRelatedByRoundNumber) {
				$result['TourneyRoundStatusRelatedByRoundNumber'] = $this->aTourneyRoundStatusRelatedByRoundNumber->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aFights) {
				$result['Fights'] = $this->aFights->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aTourneyFightersRelatedByOneid) {
				$result['TourneyFightersRelatedByOneid'] = $this->aTourneyFightersRelatedByOneid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aTourneyFightersRelatedByTwoid) {
				$result['TourneyFightersRelatedByTwoid'] = $this->aTourneyFightersRelatedByTwoid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = TourneyFightsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTourneyId($value);
				break;
			case 2:
				$this->setRoundNumber($value);
				break;
			case 3:
				$this->setGeneralFightId($value);
				break;
			case 4:
				$this->setOneid($value);
				break;
			case 5:
				$this->setTwoid($value);
				break;
			case 6:
				$this->setOnewins($value);
				break;
			case 7:
				$this->setTwowins($value);
				break;
			case 8:
				$this->setChildRight($value);
				break;
			case 9:
				$this->setChildLeft($value);
				break;
			case 10:
				$this->setParent($value);
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
		$keys = TourneyFightsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTourneyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoundNumber($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGeneralFightId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOneid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTwoid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setOnewins($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTwowins($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setChildRight($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setChildLeft($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setParent($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TourneyFightsPeer::DATABASE_NAME);

		if ($this->isColumnModified(TourneyFightsPeer::ID)) $criteria->add(TourneyFightsPeer::ID, $this->id);
		if ($this->isColumnModified(TourneyFightsPeer::TOURNEY_ID)) $criteria->add(TourneyFightsPeer::TOURNEY_ID, $this->tourney_id);
		if ($this->isColumnModified(TourneyFightsPeer::ROUND_NUMBER)) $criteria->add(TourneyFightsPeer::ROUND_NUMBER, $this->round_number);
		if ($this->isColumnModified(TourneyFightsPeer::GENERAL_FIGHT_ID)) $criteria->add(TourneyFightsPeer::GENERAL_FIGHT_ID, $this->general_fight_id);
		if ($this->isColumnModified(TourneyFightsPeer::ONEID)) $criteria->add(TourneyFightsPeer::ONEID, $this->oneid);
		if ($this->isColumnModified(TourneyFightsPeer::TWOID)) $criteria->add(TourneyFightsPeer::TWOID, $this->twoid);
		if ($this->isColumnModified(TourneyFightsPeer::ONEWINS)) $criteria->add(TourneyFightsPeer::ONEWINS, $this->onewins);
		if ($this->isColumnModified(TourneyFightsPeer::TWOWINS)) $criteria->add(TourneyFightsPeer::TWOWINS, $this->twowins);
		if ($this->isColumnModified(TourneyFightsPeer::CHILD_RIGHT)) $criteria->add(TourneyFightsPeer::CHILD_RIGHT, $this->child_right);
		if ($this->isColumnModified(TourneyFightsPeer::CHILD_LEFT)) $criteria->add(TourneyFightsPeer::CHILD_LEFT, $this->child_left);
		if ($this->isColumnModified(TourneyFightsPeer::PARENT)) $criteria->add(TourneyFightsPeer::PARENT, $this->parent);

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
		$criteria = new Criteria(TourneyFightsPeer::DATABASE_NAME);
		$criteria->add(TourneyFightsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of TourneyFights (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setTourneyId($this->getTourneyId());
		$copyObj->setRoundNumber($this->getRoundNumber());
		$copyObj->setGeneralFightId($this->getGeneralFightId());
		$copyObj->setOneid($this->getOneid());
		$copyObj->setTwoid($this->getTwoid());
		$copyObj->setOnewins($this->getOnewins());
		$copyObj->setTwowins($this->getTwowins());
		$copyObj->setChildRight($this->getChildRight());
		$copyObj->setChildLeft($this->getChildLeft());
		$copyObj->setParent($this->getParent());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

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
	 * @return     TourneyFights Clone of current object.
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
	 * @return     TourneyFightsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TourneyFightsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a TourneyRoundStatus object.
	 *
	 * @param      TourneyRoundStatus $v
	 * @return     TourneyFights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTourneyRoundStatusRelatedByTourneyId(TourneyRoundStatus $v = null)
	{
		if ($v === null) {
			$this->setTourneyId(NULL);
		} else {
			$this->setTourneyId($v->getTourneyId());
		}

		$this->aTourneyRoundStatusRelatedByTourneyId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TourneyRoundStatus object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFightsRelatedByTourneyId($this);
		}

		return $this;
	}


	/**
	 * Get the associated TourneyRoundStatus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TourneyRoundStatus The associated TourneyRoundStatus object.
	 * @throws     PropelException
	 */
	public function getTourneyRoundStatusRelatedByTourneyId(PropelPDO $con = null)
	{
		if ($this->aTourneyRoundStatusRelatedByTourneyId === null && ($this->tourney_id !== null)) {
			$this->aTourneyRoundStatusRelatedByTourneyId = TourneyRoundStatusQuery::create()
				->filterByTourneyFightsRelatedByTourneyId($this) // here
				->findOne($con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aTourneyRoundStatusRelatedByTourneyId->addTourneyFightssRelatedByTourneyId($this);
			 */
		}
		return $this->aTourneyRoundStatusRelatedByTourneyId;
	}

	/**
	 * Declares an association between this object and a TourneyRoundStatus object.
	 *
	 * @param      TourneyRoundStatus $v
	 * @return     TourneyFights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTourneyRoundStatusRelatedByRoundNumber(TourneyRoundStatus $v = null)
	{
		if ($v === null) {
			$this->setRoundNumber(NULL);
		} else {
			$this->setRoundNumber($v->getRoundNumber());
		}

		$this->aTourneyRoundStatusRelatedByRoundNumber = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TourneyRoundStatus object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFightsRelatedByRoundNumber($this);
		}

		return $this;
	}


	/**
	 * Get the associated TourneyRoundStatus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TourneyRoundStatus The associated TourneyRoundStatus object.
	 * @throws     PropelException
	 */
	public function getTourneyRoundStatusRelatedByRoundNumber(PropelPDO $con = null)
	{
		if ($this->aTourneyRoundStatusRelatedByRoundNumber === null && ($this->round_number !== null)) {
			$this->aTourneyRoundStatusRelatedByRoundNumber = TourneyRoundStatusQuery::create()
				->filterByTourneyFightsRelatedByRoundNumber($this) // here
				->findOne($con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aTourneyRoundStatusRelatedByRoundNumber->addTourneyFightssRelatedByRoundNumber($this);
			 */
		}
		return $this->aTourneyRoundStatusRelatedByRoundNumber;
	}

	/**
	 * Declares an association between this object and a Fights object.
	 *
	 * @param      Fights $v
	 * @return     TourneyFights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFights(Fights $v = null)
	{
		if ($v === null) {
			$this->setGeneralFightId(NULL);
		} else {
			$this->setGeneralFightId($v->getId());
		}

		$this->aFights = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Fights object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFights($this);
		}

		return $this;
	}


	/**
	 * Get the associated Fights object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Fights The associated Fights object.
	 * @throws     PropelException
	 */
	public function getFights(PropelPDO $con = null)
	{
		if ($this->aFights === null && ($this->general_fight_id !== null)) {
			$this->aFights = FightsQuery::create()->findPk($this->general_fight_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aFights->addTourneyFightss($this);
			 */
		}
		return $this->aFights;
	}

	/**
	 * Declares an association between this object and a TourneyFighters object.
	 *
	 * @param      TourneyFighters $v
	 * @return     TourneyFights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTourneyFightersRelatedByOneid(TourneyFighters $v = null)
	{
		if ($v === null) {
			$this->setOneid(NULL);
		} else {
			$this->setOneid($v->getFighterId());
		}

		$this->aTourneyFightersRelatedByOneid = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TourneyFighters object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFightsRelatedByOneid($this);
		}

		return $this;
	}


	/**
	 * Get the associated TourneyFighters object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TourneyFighters The associated TourneyFighters object.
	 * @throws     PropelException
	 */
	public function getTourneyFightersRelatedByOneid(PropelPDO $con = null)
	{
		if ($this->aTourneyFightersRelatedByOneid === null && ($this->oneid !== null)) {
			$this->aTourneyFightersRelatedByOneid = TourneyFightersQuery::create()
				->filterByTourneyFightsRelatedByOneid($this) // here
				->findOne($con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aTourneyFightersRelatedByOneid->addTourneyFightssRelatedByOneid($this);
			 */
		}
		return $this->aTourneyFightersRelatedByOneid;
	}

	/**
	 * Declares an association between this object and a TourneyFighters object.
	 *
	 * @param      TourneyFighters $v
	 * @return     TourneyFights The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTourneyFightersRelatedByTwoid(TourneyFighters $v = null)
	{
		if ($v === null) {
			$this->setTwoid(NULL);
		} else {
			$this->setTwoid($v->getFighterId());
		}

		$this->aTourneyFightersRelatedByTwoid = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the TourneyFighters object, it will not be re-added.
		if ($v !== null) {
			$v->addTourneyFightsRelatedByTwoid($this);
		}

		return $this;
	}


	/**
	 * Get the associated TourneyFighters object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     TourneyFighters The associated TourneyFighters object.
	 * @throws     PropelException
	 */
	public function getTourneyFightersRelatedByTwoid(PropelPDO $con = null)
	{
		if ($this->aTourneyFightersRelatedByTwoid === null && ($this->twoid !== null)) {
			$this->aTourneyFightersRelatedByTwoid = TourneyFightersQuery::create()
				->filterByTourneyFightsRelatedByTwoid($this) // here
				->findOne($con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aTourneyFightersRelatedByTwoid->addTourneyFightssRelatedByTwoid($this);
			 */
		}
		return $this->aTourneyFightersRelatedByTwoid;
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
		if ('TourneyUserAction' == $relationName) {
			return $this->initTourneyUserActions();
		}
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
	 * If this TourneyFights is new, it will return
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
					->filterByTourneyFights($this)
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
				$tourneyUserAction->setTourneyFights($this);
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
					->filterByTourneyFights($this)
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
	 * @return     TourneyFights The current object (for fluent API support)
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
		$tourneyUserAction->setTourneyFights($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this TourneyFights is new, it will return
	 * an empty collection; or if this TourneyFights has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFights.
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
	 * Otherwise if this TourneyFights is new, it will return
	 * an empty collection; or if this TourneyFights has previously
	 * been saved, it will retrieve related TourneyUserActions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in TourneyFights.
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
		$this->tourney_id = null;
		$this->round_number = null;
		$this->general_fight_id = null;
		$this->oneid = null;
		$this->twoid = null;
		$this->onewins = null;
		$this->twowins = null;
		$this->child_right = null;
		$this->child_left = null;
		$this->parent = null;
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
			if ($this->collTourneyUserActions) {
				foreach ($this->collTourneyUserActions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collTourneyUserActions instanceof PropelCollection) {
			$this->collTourneyUserActions->clearIterator();
		}
		$this->collTourneyUserActions = null;
		$this->aTourneyRoundStatusRelatedByTourneyId = null;
		$this->aTourneyRoundStatusRelatedByRoundNumber = null;
		$this->aFights = null;
		$this->aTourneyFightersRelatedByOneid = null;
		$this->aTourneyFightersRelatedByTwoid = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(TourneyFightsPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseTourneyFights
