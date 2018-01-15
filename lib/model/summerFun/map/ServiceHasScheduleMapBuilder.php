<?php



class ServiceHasScheduleMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ServiceHasScheduleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('service_has_schedule');
		$tMap->setPhpName('ServiceHasSchedule');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'int' , CreoleTypes::INTEGER, 'service', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SCHEDULE_ID', 'ScheduleId', 'int' , CreoleTypes::INTEGER, 'schedule', 'ID', true, null);

	} 
} 