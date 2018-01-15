<?php



class TpvMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.TpvMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tpv');
		$tMap->setPhpName('Tpv');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('CENTRO_ID', 'CentroId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addColumn('MERCHANT_CODE', 'MerchantCode', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MERCHANT_KEY', 'MerchantKey', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('URL_TPV', 'UrlTpv', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 