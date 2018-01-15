<?php



class CourseI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.CourseI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('course_i18n');
		$tMap->setPhpName('CourseI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('SCHEDULE', 'Schedule', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'course', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 