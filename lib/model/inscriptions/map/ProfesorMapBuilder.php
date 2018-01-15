<?php



class ProfesorMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.ProfesorMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('profesor');
		$tMap->setPhpName('Profesor');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('CENTRO_ID', 'CentroId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', false, null);

	} 
} 