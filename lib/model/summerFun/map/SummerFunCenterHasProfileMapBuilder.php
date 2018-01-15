<?php



class SummerFunCenterHasProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.SummerFunCenterHasProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('summer_fun_center_has_profile');
		$tMap->setPhpName('SummerFunCenterHasProfile');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('SUMMER_FUN_CENTER_ID', 'SummerFunCenterId', 'int' , CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PROFILE_ID', 'ProfileId', 'int' , CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

	} 
} 