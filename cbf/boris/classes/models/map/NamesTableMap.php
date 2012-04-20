<?php



/**
 * This class defines the structure of the 'names' table.
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
class NamesTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.NamesTableMap';

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
		$this->setName('names');
		$this->setPhpName('Names');
		$this->setClassname('Names');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('REFERENCE', 'Reference', 'LONGVARCHAR', true, null, null);
		// validators
		$this->addValidator('NAME', 'unique', 'propel.validator.UniqueValidator', '', 'Celebrity already exists');
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Pics', 'Pics', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'Picss');
		$this->addRelation('FightsRelatedByOneid', 'Fights', RelationMap::ONE_TO_MANY, array('id' => 'oneID', ), 'CASCADE', null, 'FightssRelatedByOneid');
		$this->addRelation('FightsRelatedByTwoid', 'Fights', RelationMap::ONE_TO_MANY, array('id' => 'twoID', ), 'CASCADE', null, 'FightssRelatedByTwoid');
		$this->addRelation('TourneyFighters', 'TourneyFighters', RelationMap::ONE_TO_MANY, array('id' => 'fighter_id', ), 'RESTRICT', null, 'TourneyFighterss');
	} // buildRelations()

} // NamesTableMap
