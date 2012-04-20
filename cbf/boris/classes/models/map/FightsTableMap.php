<?php



/**
 * This class defines the structure of the 'fights' table.
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
class FightsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.FightsTableMap';

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
		$this->setName('fights');
		$this->setPhpName('Fights');
		$this->setClassname('Fights');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ONEID', 'Oneid', 'INTEGER', 'names', 'ID', true, null, null);
		$this->addForeignKey('TWOID', 'Twoid', 'INTEGER', 'names', 'ID', true, null, null);
		$this->addColumn('ONEWINS', 'Onewins', 'INTEGER', true, null, null);
		$this->addColumn('TWOWINS', 'Twowins', 'INTEGER', true, null, null);
		$this->addColumn('ACTIVE', 'Active', 'TINYINT', false, null, 1);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('NamesRelatedByOneid', 'Names', RelationMap::MANY_TO_ONE, array('oneID' => 'id', ), 'CASCADE', null);
		$this->addRelation('NamesRelatedByTwoid', 'Names', RelationMap::MANY_TO_ONE, array('twoID' => 'id', ), 'CASCADE', null);
		$this->addRelation('Posts', 'Posts', RelationMap::ONE_TO_MANY, array('id' => 'fightID', ), 'CASCADE', null, 'Postss');
		$this->addRelation('TourneyFights', 'TourneyFights', RelationMap::ONE_TO_MANY, array('id' => 'general_fight_id', ), 'SET NULL', null, 'TourneyFightss');
	} // buildRelations()

} // FightsTableMap
