<?php



/**
 * This class defines the structure of the 'bannedEmails' table.
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
class BannedemailsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.BannedemailsTableMap';

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
		$this->setName('bannedEmails');
		$this->setPhpName('Bannedemails');
		$this->setClassname('Bannedemails');
		$this->setPackage('models');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('EMAILADDRESS', 'Emailaddress', 'VARCHAR', true, 100, null);
		$this->addColumn('TTD', 'Ttd', 'TIMESTAMP', true, null, null);
		// validators
		$this->addValidator('EMAILADDRESS', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Invalid email address');
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // BannedemailsTableMap
