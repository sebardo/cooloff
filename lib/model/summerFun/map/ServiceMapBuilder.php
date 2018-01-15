<?php



class ServiceMapBuilder {

	
	const CLASS_NAME = 'lib.model.summerFun.map.ServiceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('service');
		$tMap->setPhpName('Service');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CENTER_ID', 'CenterId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::DECIMAL, true, 14);

	} 
} 