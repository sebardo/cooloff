<?php



class ExcursionI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.ExcursionI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('excursion_i18n');
		$tMap->setPhpName('ExcursionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'excursion', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 