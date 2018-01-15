<?php



class GrupoHasProfesorMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.GrupoHasProfesorMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('grupo_has_profesor');
		$tMap->setPhpName('GrupoHasProfesor');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('GRUPO_ID', 'GrupoId', 'int' , CreoleTypes::INTEGER, 'grupo', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PROFESOR_ID', 'ProfesorId', 'int' , CreoleTypes::INTEGER, 'profesor', 'ID', true, null);

	} 
} 