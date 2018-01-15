<?php



class CourseMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.CourseMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('course');
		$tMap->setPhpName('Course');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STARTS_AT', 'StartsAt', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ENDS_AT', 'EndsAt', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, true, 14);

		$tMap->addColumn('NUMBER_OF_PLACES', 'NumberOfPlaces', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('SUMMER_FUN_CENTER_ID', 'SummerFunCenterId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addColumn('IS_REGISTRATION_OPEN', 'IsRegistrationOpen', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('EXCURSION_ID', 'ExcursionId', 'int', CreoleTypes::INTEGER, 'excursion', 'ID', false, null);

	} 
} 