<?php



class ServiceI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ServiceI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('service_i18n');
		$tMap->setPhpName('ServiceI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'service', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 