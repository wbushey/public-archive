<?php



/**
 * This class defines the structure of the 'tourney_fights' table.
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
class TourneyFightsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.TourneyFightsTableMap';

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
		$this->setName('tourney_fights');
		$this->setPhpName('TourneyFights');
		$this->setClassname('TourneyFights');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('TOURNEY_ID', 'TourneyId', 'INTEGER', 'tourney_round_status', 'TOURNEY_ID', true, null, null);
		$this->addForeignKey('ROUND_NUMBER', 'RoundNumber', 'INTEGER', 'tourney_round_status', 'ROUND_NUMBER', true, null, null);
		$this->addForeignKey('GENERAL_FIGHT_ID', 'GeneralFightId', 'INTEGER', 'fights', 'ID', true, null, null);
		$this->addForeignKey('ONEID', 'Oneid', 'INTEGER', 'tourney_fighters', 'FIGHTER_ID', true, null, null);
		$this->addForeignKey('TWOID', 'Twoid', 'INTEGER', 'tourney_fighters', 'FIGHTER_ID', true, null, null);
		$this->addColumn('ONEWINS', 'Onewins', 'INTEGER', true, null, 0);
		$this->addColumn('TWOWINS', 'Twowins', 'INTEGER', true, null, 0);
		$this->addColumn('CHILD_RIGHT', 'ChildRight', 'INTEGER', false, null, null);
		$this->addColumn('CHILD_LEFT', 'ChildLeft', 'INTEGER', false, null, null);
		$this->addColumn('PARENT', 'Parent', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('TourneyRoundStatusRelatedByTourneyId', 'TourneyRoundStatus', RelationMap::MANY_TO_ONE, array('tourney_id' => 'tourney_id', ), 'CASCADE', null);
		$this->addRelation('TourneyRoundStatusRelatedByRoundNumber', 'TourneyRoundStatus', RelationMap::MANY_TO_ONE, array('round_number' => 'round_number', ), 'CASCADE', null);
		$this->addRelation('Fights', 'Fights', RelationMap::MANY_TO_ONE, array('general_fight_id' => 'id', ), 'SET NULL', null);
		$this->addRelation('TourneyFightersRelatedByOneid', 'TourneyFighters', RelationMap::MANY_TO_ONE, array('oneID' => 'fighter_id', ), 'RESTRICT', null);
		$this->addRelation('TourneyFightersRelatedByTwoid', 'TourneyFighters', RelationMap::MANY_TO_ONE, array('twoID' => 'fighter_id', ), 'RESTRICT', null);
		$this->addRelation('TourneyUserAction', 'TourneyUserAction', RelationMap::ONE_TO_MANY, array('id' => 'fight_id', ), 'CASCADE', null, 'TourneyUserActions');
	} // buildRelations()

} // TourneyFightsTableMap
