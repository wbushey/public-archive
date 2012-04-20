<?php



/**
 * This class defines the structure of the 'tourney_user_action' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.models.map
 */
class TourneyUserActionTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.TourneyUserActionTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('tourney_user_action');
		$this->setPhpName('TourneyUserAction');
		$this->setClassname('TourneyUserAction');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'userProfile', 'ID', true, null, null);
		$this->addForeignKey('FIGHT_ID', 'FightId', 'INTEGER', 'tourney_fights', 'ID', true, null, null);
		$this->addForeignKey('RESULT', 'Result', 'INTEGER', 'tourney_fighters', 'FIGHTER_ID', true, null, null);
		$this->addColumn('TIME', 'Time', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Userprofile', 'Userprofile', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('TourneyFights', 'TourneyFights', RelationMap::MANY_TO_ONE, array('fight_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('TourneyFighters', 'TourneyFighters', RelationMap::MANY_TO_ONE, array('result' => 'fighter_id', ), 'SET NULL', null);
	} // buildRelations()

} // TourneyUserActionTableMap
