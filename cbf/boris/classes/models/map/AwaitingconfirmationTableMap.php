<?php



/**
 * This class defines the structure of the 'awaitingConfirmation' table.
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
class AwaitingconfirmationTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.AwaitingconfirmationTableMap';

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
		$this->setName('awaitingConfirmation');
		$this->setPhpName('Awaitingconfirmation');
		$this->setClassname('Awaitingconfirmation');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('CONFIRMNUM', 'Confirmnum', 'CHAR', true, 32, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 100, null);
		$this->addColumn('PASSWORD', 'Password', 'CHAR', true, 32, null);
		$this->addColumn('TTD', 'Ttd', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Awaitingprofiles', 'Awaitingprofiles', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // AwaitingconfirmationTableMap
