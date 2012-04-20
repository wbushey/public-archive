<?php



/**
 * This class defines the structure of the 'tourney_status' table.
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
class TourneyStatusTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.TourneyStatusTableMap';

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
		$this->setName('tourney_status');
		$this->setPhpName('TourneyStatus');
		$this->setClassname('TourneyStatus');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, false);
		$this->addColumn('START_TIME', 'StartTime', 'TIMESTAMP', true, null, null);
		$this->addColumn('END_TIME', 'EndTime', 'TIMESTAMP', false, null, null);
		$this->addColumn('ROUND_NUMBER', 'RoundNumber', 'INTEGER', false, null, null);
		$this->addColumn('ROOT', 'Root', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('TourneyRoundStatus', 'TourneyRoundStatus', RelationMap::ONE_TO_MANY, array('id' => 'tourney_id', ), 'CASCADE', null, 'TourneyRoundStatuss');
		$this->addRelation('TourneyFighters', 'TourneyFighters', RelationMap::ONE_TO_MANY, array('id' => 'tourney_id', ), 'CASCADE', null, 'TourneyFighterss');
	} // buildRelations()

} // TourneyStatusTableMap
