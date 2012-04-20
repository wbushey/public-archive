<?php



/**
 * This class defines the structure of the 'tourney_fighters' table.
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
class TourneyFightersTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.TourneyFightersTableMap';

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
		$this->setName('tourney_fighters');
		$this->setPhpName('TourneyFighters');
		$this->setClassname('TourneyFighters');
		$this->setPackage('models');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('TOURNEY_ID', 'TourneyId', 'INTEGER' , 'tourney_status', 'ID', true, null, null);
		$this->addForeignPrimaryKey('FIGHTER_ID', 'FighterId', 'INTEGER' , 'names', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('TourneyStatus', 'TourneyStatus', RelationMap::MANY_TO_ONE, array('tourney_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('Names', 'Names', RelationMap::MANY_TO_ONE, array('fighter_id' => 'id', ), 'RESTRICT', null);
		$this->addRelation('TourneyFightsRelatedByOneid', 'TourneyFights', RelationMap::ONE_TO_MANY, array('fighter_id' => 'oneID', ), 'RESTRICT', null, 'TourneyFightssRelatedByOneid');
		$this->addRelation('TourneyFightsRelatedByTwoid', 'TourneyFights', RelationMap::ONE_TO_MANY, array('fighter_id' => 'twoID', ), 'RESTRICT', null, 'TourneyFightssRelatedByTwoid');
		$this->addRelation('TourneyUserAction', 'TourneyUserAction', RelationMap::ONE_TO_MANY, array('fighter_id' => 'result', ), 'SET NULL', null, 'TourneyUserActions');
	} // buildRelations()

} // TourneyFightersTableMap
