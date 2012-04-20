<?php



/**
 * This class defines the structure of the 'posts' table.
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
class PostsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.PostsTableMap';

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
		$this->setName('posts');
		$this->setPhpName('Posts');
		$this->setClassname('Posts');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FIGHTID', 'Fightid', 'INTEGER', 'fights', 'ID', true, null, null);
		$this->addForeignKey('POSTERID', 'Posterid', 'INTEGER', 'userProfile', 'ID', true, null, null);
		$this->addColumn('POSTDATE', 'Postdate', 'TIMESTAMP', true, null, null);
		$this->addColumn('POSTTEXT', 'Posttext', 'LONGVARCHAR', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Fights', 'Fights', RelationMap::MANY_TO_ONE, array('fightID' => 'id', ), 'CASCADE', null);
		$this->addRelation('Userprofile', 'Userprofile', RelationMap::MANY_TO_ONE, array('posterID' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // PostsTableMap
