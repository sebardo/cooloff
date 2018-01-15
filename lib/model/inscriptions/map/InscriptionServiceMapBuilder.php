<?php



class InscriptionServiceMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.InscriptionServiceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('inscription_service');
		$tMap->setPhpName('InscriptionService');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('INSCRIPTION_ID', 'InscriptionId', 'int', CreoleTypes::INTEGER, 'inscription', 'ID', true, null);

		$tMap->addForeignKey('SERVICE_SCHEDULE_ID', 'ServiceScheduleId', 'int', CreoleTypes::INTEGER, 'service_schedule', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 