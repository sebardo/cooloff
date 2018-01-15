<?php



class InscriptionServiceScheduleMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.InscriptionServiceScheduleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('inscription_service_schedule');
		$tMap->setPhpName('InscriptionServiceSchedule');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('INSCRIPTION_ID', 'InscriptionId', 'int' , CreoleTypes::INTEGER, 'inscription', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_SCHEDULE_ID', 'ServiceScheduleId', 'int' , CreoleTypes::INTEGER, 'service_schedule', 'ID', true, null);

	} 
} 