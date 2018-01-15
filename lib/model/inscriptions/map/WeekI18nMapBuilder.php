<?php



class WeekI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.WeekI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('week_i18n');
		$tMap->setPhpName('WeekI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('MORNING_SHELTER_SCHEDULE', 'MorningShelterSchedule', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('AFTERNOON_SHELTER_SCHEDULE', 'AfternoonShelterSchedule', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SHELTER_DESCRIPTION', 'ShelterDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'week', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 