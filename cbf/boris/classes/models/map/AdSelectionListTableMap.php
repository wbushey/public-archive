<?php



/**
 * This class defines the structure of the 'ad_selection_list' table.
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
class AdSelectionListTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.AdSelectionListTableMap';

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
		$this->setName('ad_selection_list');
		$this->setPhpName('AdSelectionList');
		$this->setClassname('AdSelectionList');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('AD_ID', 'AdId', 'INTEGER', 'ad', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Ad', 'Ad', RelationMap::MANY_TO_ONE, array('ad_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // AdSelectionListTableMap
