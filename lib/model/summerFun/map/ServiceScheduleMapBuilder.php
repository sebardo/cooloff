<?php



class ServiceScheduleMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ServiceScheduleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('service_schedule');
		$tMap->setPhpName('ServiceSchedule');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ORDEN', 'Orden', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('SERVICE_ID', 'ServiceId', 'int', CreoleTypes::INTEGER, 'service', 'ID', true, null);

	} 
} 