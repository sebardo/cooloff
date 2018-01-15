<?php



class CourseHasServicesMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.CourseHasServicesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('course_has_services');
		$tMap->setPhpName('CourseHasServices');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('COURSE_ID', 'CourseId', 'int' , CreoleTypes::INTEGER, 'course', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SERVICE_ID', 'ServiceId', 'int' , CreoleTypes::INTEGER, 'service', 'ID', true, null);

	} 
} 