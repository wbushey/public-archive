<?php



/**
 * This class defines the structure of the 'image' table.
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
class ImageTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.ImageTableMap';

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
		$this->setName('image');
		$this->setPhpName('Image');
		$this->setClassname('Image');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('DATATYPE', 'Datatype', 'VARCHAR', true, 100, 'application/octet-stream');
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('SIZE', 'Size', 'BIGINT', true, 20, null);
		$this->addColumn('DATE_ADDED', 'DateAdded', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ImageData', 'ImageData', RelationMap::ONE_TO_MANY, array('id' => 'image_id', ), 'CASCADE', null, 'ImageDatas');
		$this->addRelation('Ad', 'Ad', RelationMap::ONE_TO_MANY, array('id' => 'image_id', ), 'SET NULL', null, 'Ads');
	} // buildRelations()

} // ImageTableMap
