<?php



class WeekMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.WeekMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('week');
		$tMap->setPhpName('Week');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STARTS_AT', 'StartsAt', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ENDS_AT', 'EndsAt', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('CENTRO_ID', 'CentroId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', false, null);

		$tMap->addColumn('IS_MORNING_SHELTER', 'IsMorningShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('IS_AFTERNOON_SHELTER', 'IsAfternoonShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} 
} 