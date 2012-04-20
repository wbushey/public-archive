<?php



/**
 * This class defines the structure of the 'image_data' table.
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
class ImageDataTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.ImageDataTableMap';

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
		$this->setName('image_data');
		$this->setPhpName('ImageData');
		$this->setClassname('ImageData');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('IMAGE_ID', 'ImageId', 'INTEGER', 'image', 'ID', true, null, null);
		$this->addColumn('DATA', 'Data', 'BLOB', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Image', 'Image', RelationMap::MANY_TO_ONE, array('image_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // ImageDataTableMap
