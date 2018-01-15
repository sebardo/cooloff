<?php



class InscriptionCenterConfigurationMapBuilder {

	
	const CLASS_NAME = 'lib.model.inscriptions.map.InscriptionCenterConfigurationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('inscription_center_configuration');
		$tMap->setPhpName('InscriptionCenterConfiguration');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('MORNING_SHELTER', 'MorningShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('AFTERNOON_SHELTER', 'AfternoonShelter', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('TEXT_SHELTER', 'TextShelter', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('TRANSFER_PAYMENT', 'TransferPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CASH_PAYMENT', 'CashPayment', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('SUMMER_FUN_CENTER_ID', 'SummerFunCenterId', 'int', CreoleTypes::INTEGER, 'summer_fun_center', 'ID', true, null);

		$tMap->addColumn('IS_REGISTRATION_OPEN', 'IsRegistrationOpen', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} 
} 