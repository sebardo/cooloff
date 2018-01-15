<?php



class ScheduleMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ScheduleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('schedule');
		$tMap->setPhpName('Schedule');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('CENTER_ID', 'CenterId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 