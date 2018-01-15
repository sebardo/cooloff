<?php



class ServiceScheduleI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ServiceScheduleI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('service_schedule_i18n');
		$tMap->setPhpName('ServiceScheduleI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'service_schedule', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 