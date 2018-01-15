<?php



class sfGuardUserProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('sf_guard_user_profile');
		$tMap->setPhpName('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('PASS', 'Pass', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, false, 10);

	} 
} 