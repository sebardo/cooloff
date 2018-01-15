<?php



class GrupoMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.GrupoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('grupo');
		$tMap->setPhpName('Grupo');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NOMBRE', 'Nombre', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('CENTRO_ID', 'CentroId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', false, null);

	} 
} 