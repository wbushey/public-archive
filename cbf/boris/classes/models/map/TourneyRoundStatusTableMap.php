<?php



/**
 * This class defines the structure of the 'tourney_round_status' table.
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
class TourneyRoundStatusTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.TourneyRoundStatusTableMap';

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
		$this->setName('tourney_round_status');
		$this->setPhpName('TourneyRoundStatus');
		$this->setClassname('TourneyRoundStatus');
		$this->setPackage('models');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('TOURNEY_ID', 'TourneyId', 'INTEGER' , 'tourney_status', 'ID', true, null, null);
		$this->addPrimaryKey('ROUND_NUMBER', 'RoundNumber', 'INTEGER', true, null, null);
		$this->addColumn('ROUND_START_TIME', 'RoundStartTime', 'TIMESTAMP', false, null, null);
		$this->addColumn('ROUND_END_TIME', 'RoundEndTime', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('TourneyStatus', 'TourneyStatus', RelationMap::MANY_TO_ONE, array('tourney_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('TourneyFightsRelatedByTourneyId', 'TourneyFights', RelationMap::ONE_TO_MANY, array('tourney_id' => 'tourney_id', ), 'CASCADE', null, 'TourneyFightssRelatedByTourneyId');
		$this->addRelation('TourneyFightsRelatedByRoundNumber', 'TourneyFights', RelationMap::ONE_TO_MANY, array('round_number' => 'round_number', ), 'CASCADE', null, 'TourneyFightssRelatedByRoundNumber');
	} // buildRelations()

} // TourneyRoundStatusTableMap
