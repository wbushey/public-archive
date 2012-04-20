<?php



/**
 * This class defines the structure of the 'userProfile' table.
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
class UserprofileTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'models.map.UserprofileTableMap';

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
		$this->setName('userProfile');
		$this->setPhpName('Userprofile');
		$this->setClassname('Userprofile');
		$this->setPackage('models');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 100, null);
		$this->addColumn('PASSWORD', 'Password', 'CHAR', true, 32, null);
		$this->addColumn('USERTYPE', 'Usertype', 'TINYINT', true, null, null);
		$this->addColumn('EMAILADDRESS', 'Emailaddress', 'VARCHAR', true, 100, null);
		$this->addColumn('IP', 'Ip', 'VARCHAR', true, 39, null);
		// validators
		$this->addValidator('EMAILADDRESS', 'match', 'propel.validator.MatchValidator', '/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9])+(\.[a-zA-Z0-9_-]+)+$/', 'Invalid email address');
		$this->addValidator('USERNAME', 'unique', 'propel.validator.UniqueValidator', '', 'Username already exists');
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Posts', 'Posts', RelationMap::ONE_TO_MANY, array('id' => 'posterID', ), 'CASCADE', null, 'Postss');
		$this->addRelation('TourneyUserAction', 'TourneyUserAction', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), 'CASCADE', null, 'TourneyUserActions');
	} // buildRelations()

} // UserprofileTableMap
