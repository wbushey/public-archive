<?php



/**
 * This class defines the structure of the 'awaitingProfiles' table.
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
class AwaitingprofilesTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.AwaitingprofilesTableMap';

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
		$this->setName('awaitingProfiles');
		$this->setPhpName('Awaitingprofiles');
		$this->setClassname('Awaitingprofiles');
		$this->setPackage('models');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'awaitingConfirmation', 'ID', true, null, null);
		$this->addColumn('EMAILADDRESS', 'Emailaddress', 'VARCHAR', true, 100, null);
		// validators
		$this->addValidator('EMAILADDRESS', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Invalid email address');
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Awaitingconfirmation', 'Awaitingconfirmation', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // AwaitingprofilesTableMap
